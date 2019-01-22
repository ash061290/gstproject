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
{ echo " Purchase Retainer Invoice List"; }	 ?>
       
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
{ $link = "new_retainer_invoice.php?inv_type=purchase";
 $cont = "Add Retainer Invoice"; }	 ?>
        <li><a href="<?php echo $link; ?>"><i class="fa fa-plus"></i><?php  echo $cont; ?> </a></li>
        <li class="active"><i class="fa fa-list"></i> Purchase Retainer Invoice List</li>
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
	function convert_invoice(value1,value2){
	       $.ajax({
			       type: "POST",
				   url: software_link+"purchase/ajax_retainer_convert_invoice.php",
				   data: "invoice_no="+value1+"&inv_type="+value2,
				   cache:false,
				   success:function(detail){
					window.open('purchase_retainer_invoice.php','_self');
				   }
		   })
	}
	
</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <span id="hide1" style="display:none;"></span>
          <!-- /.box -->
        <div class="box">
            <div class="box-header">
				<div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "Invoice type" ?></label>
					  <select name="ledger_month" id="extimate_type" onchange="delivery_challan_type(this.value);" class="form-control select2" style="width:100%">
					  <option value="all" selected>All</option>
					  <option value="Draft">Draft</option>
					   <option value="Invoiced">Invoiced</option>
					  <option value="Delivered">Delivered</option>
					  <option value="Return">Returned</option>
					   <!--<option value="Sales Order">Sales Order</option>-->
					   <option value="No Invoice">No-Invoice</option>
					  <option value="Partially Paid">Partially Invoice</option>
					  </select>
				 </div>
			    </div>
			
			<a href='new_retainer_invoice.php?inv_type=purchase'> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>  
		</div>
			
            <!-- /.box-header -->
            <div class="box-body table-responsive" id="search_table">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Reference</th>
                  <th>Customer Name</th>
				  <th>Service Type</th>
				   <th>Service Fees</th>
				   <th>Due Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody >
<?php
$que="select * from purchase_retainer_invoice where invoice_status='Active' group by invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$invoice_no=$row['invoice_no'];
		$service_type = $row['service_type'];
		$date = $row['invoice_date'];
		$date = explode("-",$date);
		$date = $date[2]."-".$date[1]."-".$date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$service_fees=$row['invoice_grand_total'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_due_amount = $row['invoice_due_amount'];
	    $invoice_type = $row['transaction_type'];
		$invoice_status2 = $row['invoice_status2'];
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];

  ?>
<tr  align='center'>
	<th><?php echo $date; ?></th>
	<th><a href="sales_delivery_challan_list.php?invoice_no=<?php echo $invoice_no; ?>"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th style="color:#606125;"><?php echo $service_type; ?></th>
	<th><?php echo $service_fees; ?></th>
    <th><?php echo $invoice_due_amount; ?></th>
	<th>
	    <center>
		<?php if($invoice_status2 == "Retainer"){ ?>
		<a style="color:Green;" aria-hidden="true" onclick="convert_invoice('<?php echo $invoice_no; ?>','<?php echo"sales"; ?>')" class="fa fa-refresh" href='#'><span id="convert_id">&nbsp; Convert Invoice</span> </a> &nbsp;&nbsp;&nbsp;&nbsp;
		<?php }
		else{ ?>
		<!--<a style="color:Green;" aria-hidden="true" class="" href='purchase_retainer_invoice_payment.php?invoice_no=<?php //echo $invoice_no; ?>&inv_type=<?php //echo $invoice_type; ?>'> Payment </a> &nbsp;&nbsp;&nbsp;&nbsp;-->
         <a style="color:Green;" aria-hidden="true" class="fa fa-refresh" href='#'><span id="convert_id">&nbsp;  Invoiced</span> </a> &nbsp;&nbsp;&nbsp;&nbsp;
		 <?php	} ?>
		 <?php if($invoice_status2 == "Retainer") { ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='purchase_retainer_edit.php?invoice_no=<?php echo $invoice_no; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	
		 <?php } ?>
	<!--<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php //echo $invoice_no; ?>&invoice_type=<?php //echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;-->
	
	<a style="color:Red;" aria-hidden="true" href='retainer_delete.php?invoice_no=<?php  echo $invoice_no; ?> 'class="fa fa-trash-o"> Delete</a>
	</center>
	  
	  </th>
</tr>
<?php  $serial_no++; } ?>
		</tbody>
            
             </table>
            </div>
            <!-- /.box-body -->
          </div>
		 

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
