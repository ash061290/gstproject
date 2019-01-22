<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("../attachment/link_css.php")?>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php include("../attachment/header.php"); ?>
  <?php include("../attachment/sidebar.php"); ?>
  <?phpinclude("../../attachment/session.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	 <?php if(isset($_GET['inv_type']))
{
  echo " New Retainer Invoice ";
}
else
{ echo " Sales Retainer Invoice List";}	 ?>
       
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
		 <?php if(isset($_GET['inv_type']))
{
   $link = "purchase_retainer_invoice.php";
   $cont = "Retainer Invoice List";
}
else
{ $link = "purchase_retainer_invoice.php?inv_type=sales";
 $cont = "Add Retainer Invoice"; }	 ?>
        <li><a href="<?php echo $link; ?>"><i class="fa fa-plus"></i><?php  echo $cont; ?> </a></li>
        <li class="active"><i class="fa fa-list"></i> Sales Retainer Invoice List</li>
      </ol>
    </section>
	
<script type="text/javascript">
	function order_return(value)
	{
	
	  if(value == 'Credit Amount')
	  {
	    var invoice_no = document.getElementById('invoice_no2').value;
		var order_return2 = document.getElementById('order_return2').value;
		var order_term = value;
		$.ajax({
		        type:"POST",
				url:software_link+"purchase/ajax_delivery_challan_return_submit.php",
				data:"invoice_no="+invoice_no+"&order_return_reason="+order_return2+"&order_term="+order_term,
				cache:false,
				success:function(detail){
				alert(detail);
				 if(detail==1)
				 {
	             if(window.confirm('Invoice Payment Save Us Future...'))
	             window.open('sales_challan_to_advance.php?invoice_no='+invoice_no+'&invoice_type=sales','_self');
				 }
				}
		     });
		
	   }
	   else
	   { return false; }
	}
	function delivery_challan_type(value)
	{
	   $.ajax({
			  type: "POST",
              url: software_link+"purchase/all_filter.php?sales_delivery_challan_status="+value+"",
              cache: false,
              success: function(detail){
			  $('#search_table').html(detail);   
            }
           }); 
	}
	
</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->
		<?php
if(isset($_GET['invoice_no']))
{
$invoice_no = $_GET['invoice_no'];
$inv_type = $_GET['inv_type'];
 if($inv_type=="sales")
 {
	 $table = "sales_retainer_invoice";
 }
 else{ $table = "purchase_retainer_invoice"; }
  $qry = "select * from $table where invoice_no='$invoice_no' and invoice_status='Active'";
 $run = mysql_query($qry);
 if($fetchrow = mysql_fetch_assoc($run)){
  $firm_name = $fetchrow['customer_id'];
  $referance = $fetchrow['referance'];
  $service_type = $fetchrow['service_type'];
  $service_fees = $fetchrow['service_fees'];
 }
?>
<form method="POST" enctype="multipart/form-data">
 <div class="box box-primary my_border_top">
 <div class="box-body">
	             <br/>
              <div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label>Firm Name <span style="color:red;">*</span></label>
					   <select name="invoice_firm_name" class="form-control select2" id="invoice_firm_name" style="width:100%" required>
					 
					  <option value="">Select Firm</option>
					        <?php
							 $qry= "select * from contact_master where contact_status='Active'";
							$rest=mysql_query($qry);
							while($row22=mysql_fetch_array($rest)){
							$s_no=$row22['s_no'];
							$contact_company_name=$row22['contact_company_name'];
							$contact_first_name=$row22['contact_first_name'];
							$contact_last_name=$row22['contact_last_name'];
							?>
							<option <?php if($s_no==$firm_name){ echo "selected"; } ?> value="<?php echo $s_no; ?>"><?php echo $contact_company_name; ?><?php echo "[".$contact_first_name." ".$contact_last_name."]"; ?></option>
							<?php
							}
							?>
					   </select>
					</div>
				</div>
				<div class="col-lg-12">
					<?php
					$query2="select * from invoice_no";
					$res2=mysql_query($query2);
					while($row2=mysql_fetch_array($res2)){
					$folder_id=$row2['folder_id'];
					$sales_invoice_no=$row2['sales_invoice_no'];
					$sales_invoice_draft_no=$row2['sales_invoice_draft_no'];
					$val=substr($sales_invoice_no, 1);
					}
					?>
					<?php if($inv_type=='sales'){ ?>
					<div class="form-group col-lg-5">
					  <label>Invoice No.</label>
					   <input type="text" name="invoice_no" placeholder="" value="<?php echo 'RET-'.$val; ?>" class="form-control" readonly>
					</div>
					<?php } else { ?>
					<div class="form-group col-lg-5">
					  <label>Invoice No.</label>
					   <input type="text" name="invoice_no" placeholder="Invoice No." value="<?php echo $invoice_no; ?>" class="form-control" readonly>
					</div>
					<?php } ?>
				</div>
				
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label>Invoice Date</label>
					  <input type="date" name="invoice_date" id="invoice_date" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
				</div>
				
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label>Reference</label>
						   <input type="text" name="invoice_reference" placeholder="Add Reference" value="<?php echo $referance; ?>" class="form-control">
					</div>
				</div>
				
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label >Service Type</label>
				<div class="dropdown">
				<select name="service_type" id="sales_person_name" class="form-control select2" style="width:100%">
							   	<option <?php if($service_type == 'Marketing Service'){ echo "selected"; } ?> 
								value="Marketing Service" >
								  <a class="dropdown-item" href="#">Marketing Service</a>
								  </option>
								  <option <?php if($service_type == 'Execlusive Service'){ echo "selected"; } ?> 
								  value="Exclutive Service">
								  <a class="dropdown-item" href="#">Execlusive Service</a></option>
								  <option  <?php if($service_type == 'Other Service'){ echo "selected"; } ?> 
								   value="Other Service" >
								  <a class="dropdown-item" href="#">Other Service</a></option>
								  </select> 
								</div>
							  </div>
					</div>
				
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label >Service Fees</label>
					  <input type="number" name="service_fees" placeholder="Sercive Fees" id="transport_name" value="<?php echo $service_fees; ?>" class="form-control">
					</div>
				</div>
				<div class="col-lg-12">
				<br/>
					<div class="form-group col-lg-5">
				    <input type="submit" style="background-color:#00a65a" name="save_and_send" value="Save and Send" class="form-control btn-info">
				
					</div>
				</div>
	</div>
	</div>
	</form>
	<?php if(isset($_POST["save_and_send"]))
{
$invoice_no = $_POST['invoice_no'];
$invoice_date = $_POST['invoice_date'];
$invoice_referance = $_POST['invoice_reference'];
 $service_type = $_POST['service_type'];
 $customer_id = $_POST['invoice_firm_name'];
 $service_fees = $_POST['service_fees'];
 $invoice_type="Service Invoice";
 $transaction_type="purchase";
 $invoice_grand_total = $service_fees;
 $invoice_due_amount = $service_fees;
 $invoice_status = "Active";
 echo $update = "update purchase_retainer_invoice set invoice_date='$invoice_date',bank_s_no='',customer_id='$customer_id',transaction_type='$transaction_type',invoice_grand_total='$invoice_grand_total',invoice_total_paid='',invoice_due_amount='$invoice_due_amount',referance='$invoice_referance',service_type='$service_type',service_fees='$invoice_grand_total' where invoice_no = '$invoice_no'";
if(mysql_query($update))
echo "<script>window.open('purchase_retainer_invoice.php','_self');</script>";
}  ?>
<?php
}	
 ?>

          <!-- /.box -->
		  <!-- status update -->
		  
		  <!--end-->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/../attachment/link_js.php")?>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>
