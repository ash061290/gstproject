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

  <?php include("../attachment/header.php")?>
  <?php include("../attachment/sidebar.php")?>
  <?php include("../../connection/connect.php")?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Payment By Cash
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="cash_details.php"><i class="fa fa-list"></i>Cash Details</a></li>
        <li class="active">Add Cash Details</li>
      </ol>
    </section>
	
<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
<!-- Main content -->
	
<script>
	function myFunction(value)
			{
			  $.ajax({
			   type:"POST",
			   url:software_link+"purchase/all_delete.php?advance_payment_delete="+value+"",
			   cache:false,
			   success:function(detail)
			   {
			    if(detail==1)
				{
			
				 window.open('advance_pay_add.php','_self');
				}
			   }
			   })
			}

        function customer_vendor(value){  		
            $.ajax({
			  type: "POST",
              url: software_link+"purchase/ajax_purchase_retainer_pay.php?customer_id="+value+"",
              cache: false,
              success: function(detail){
                   var str =detail;
				   $("#invoice_details").html(str); 
				   $("#balance_amount").val('');
				   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
              }
            });

            }
        
        function for_balance(value){ 
          $.ajax({
			  type: "POST",
              url: software_link+"purchase/ajax_purchase_balance.php?invoice_no="+value+"",
              cache: false,
              success: function(detail){
				   alert(detail);
				   var res=detail.split('|?|');
		      $("#balance_amount").val(res[0]);
		      $("#invoice_paid_amount").val(res[2]);
			  if(detail!=''){
				  alert(res[1]);
			  if(res[1]!='Credit'){	
			  $("#transaction_type").html("<option value=''>Select</option><option value='Debit'>Debit</option>");
		      $("#transaction_type option[value='Credit']").remove();			  
		      $("#transaction_type option[value='']").remove();			  
			  }else if(res[1]!='Debit'){
			  $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option>");
			  $("#transaction_type option[value='Debit']").remove();			  
		      $("#transaction_type option[value='']").remove();	
			  }}else{
			   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
			  }
			 
              }
           });
        }
		
</script>
    <?php
    $que11="select * from invoice_no";
    $run11=mysql_query($que11) or die(mysql_error());
    while($row11=mysql_fetch_array($run11)){
    $folder_id=$row11['folder_id']; 
    }
	$invoice_no = $_GET['invoice_no'];
	$type = $_GET['inv_type'];
	$qry12 = "select * from purchase_retainer_invoice where invoice_no='$invoice_no'";
	{
		$run = mysql_query($qry12);
		$fetchrow = mysql_fetch_array($run);
		$invoice_due_amount = $fetchrow['invoice_due_amount'];
		$invoice_grand_total = $fetchrow['invoice_grand_total'];
		$transaction_type = $fetchrow['transaction_type'];
		$customer_id = $fetchrow['customer_id'];
	}
	?>
<script src="../attachment/file_check.js"></script>
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
        <!--------------------------------------Start Registration form----------------------------------------->
        <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
        <!-----------------------------------Expence Details Start---------------------------------------------->
        <!--------------------------------###########################------------------------------------------->	        			
				<div class="col-md-4 box-body table-responsive" style="background-color:#F2F3F4">
                <table id="" class="table table-bordered table-striped">
                <thead class="">
                </thead>										
		        <tbody>
			    <div class="col-sm-12 form-horizontal">	
                    <div class="col-sm-12">
					<div class="col-sm-6">
                    <h5 style="color:#873600"><b>Add Cash Details</b></h5>
                    </div>
				    <div class="col-sm-6">
                    <a href="cash_details.php"><i class="fa fa-times" style="margin-left:100%;color:black"></i></a>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Account Name</label>
                    <div class="col-sm-7">
					<select class="form-control select2" name="bank_s_no" style="width:100%" required>
						<option value="">Select</option>
						<?php
						$que="select * from bank_or_credit_card_info where bank_status='Active'";
						$run=mysql_query($que);
						while($row=mysql_fetch_array($run)){
						$bank_s_no=$row['s_no'];
						$bank_account_type=$row['bank_account_type'];
						$bank_account_name=$row['bank_account_name'];
						$credit_card_account_name=$row['credit_card_account_name'];
						if($bank_account_type=='Credit_Card'){
						$name=$credit_card_account_name.'('.$bank_account_type.')';
						$bank_name=$credit_card_account_name;
						}else{
						$name=$bank_account_name.'('.$bank_account_type.')';
						$bank_name=$bank_account_name;
						}
	                    ?>
						<option value="<?php echo $bank_s_no; ?>"><?php echo $name; ?></option>
						<?php } ?>
					</select>
                    </div>
                    </div>
                    </div>
				
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Customer/Vendor </label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="customer_id" style="width:100%" required>
						<?php
						  $contact_firm_name=$customer_id;
						$que="select * from contact_master where contact_status='Active' and s_no='$contact_firm_name'";
						$run2=mysql_query($que);
						$row=mysql_fetch_array($run2);
						$customer_id=$row['s_no'];
						$contact_tittle_name=$row['contact_tittle_name'];
						$contact_first_name=$row['contact_first_name'];
						$contact_last_name=$row['contact_last_name'];
						$contact_company_name=$row['contact_company_name'];
						$contact_contact_phone=$row['contact_contact_phone'];
						$contact_email=$row['contact_email'];
						$contact_gstin=$row['contact_gstin'];					
						$contact_contact_type=$row['contact_contact_type'];	
						$contact_gst_treatment=$row['contact_gst_treatment'];
          				$contact=$contact_company_name.' ('.$contact_contact_type.')';						
	                    ?>
						
						<option value="<?php echo $customer_id; ?>" selected ><?php echo $contact; ?></option>
						<?php  ?>
						</select>
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Invoice#</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="invoice_no" id="invoice_details" style="width:100%">
						<option  value="<?php echo $invoice_no; ?>"><?php echo $invoice_no; ?></option>
						</select>
                    </div>
                    </div>
                    </div>

					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Balance Amount</label>
                    <div class="col-sm-7">
                      <input type="text" name="balance_amount" value="<?php echo $invoice_due_amount; ?>" placeholder="Balance" id="balance_amount" class="form-control" readonly />
                      <input type="hidden" name="invoice_paid_amount" placeholder="Paid Amount" id="invoice_paid_amount" class="form-control" value="0" readonly />
                    </div>
                    </div>
                    </div>
				                   
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Amount</label>
                    <div class="col-sm-7">
                       <input type="text" name="total_amount" id="total_amount" value="" Placeholder="Amount" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="transaction_hide">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Transaction Type</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="cash_transaction_type" style="width:100%" id="transaction_type" required>
					 <!-- <option value="Credit" selected>Credit</option>-->
					  <option value="Debit">Debit</option>
					  </select>
                    </div>
                    </div>
                    </div>
										
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Date</label>
                    <div class="col-sm-7">
                       <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                    </div>
                    </div>
                    </div>
 					
					<div class="form-group" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Refrence</label>
                    <div class="col-sm-7">
                       <input type="text" name="reference" value="" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Discription</label>
                    <div class="col-sm-7">
                       <input type="text" name="remark" value="" placeholder="Discription" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Upload File</label>
                    <div class="col-sm-7">
                        <div class="form-group">
						  <label>Profile Photo</label>
					      <input type="file"  id="upload_file" name="upload_file"  value="" onchange="check_file_type(this,'upload_file','show_application','all');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc">
						   <img src="" id="show_application" height="50" width="50" >
					    </div>
                    </div>
                    </div>
                    </div>
					
					<div class="col-sm-12">	
					<div class="col-sm-3">
                    </div>					
					<div class="col-sm-3">	
			        <input type="submit" name="Save" value="Save" class="btn btn-primary my_background_color"><br/>
		            </div>
					<div class="col-sm-3">	
			        <a href="cash_details.php?id=<?php echo $s_no; ?>"><button type="button" class="btn btn-primary">Cancel</button></a>
		            </div>
		            </div>	
			    </div>
	            </tbody>				
                </table>
                </div>	
	       <!-----------------------------------Expence Details Start----------------------------------->		   
				<div class="col-md-8 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Referance</th>				  
				  <th>Customer Name</th>
				  <th>Mode Of Payment</th>
				   <th>Amount</th>
				    <th>Due Amount</th>
				     <th>Action</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from purchase_retainer_invoice where invoice_due_amount>0 and invoice_status='Active' GROUP BY invoice_no";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['referance'];
				$invoice_no = $row['invoice_no'];
				$invoice_grand_total=$row['invoice_grand_total'];
				$invoice_firm_name = $row['customer_id'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$account_name = $row['account_name'];
				
				$invoice_payment_mode = $row['payment_mode'];
				$invoice_due_amount = $row['invoice_due_amount'];
				if(empty($invoice_payment_mode))
				{
				 $invoice_payment_mode = "No Payment";
				}
				
				$date1 = $row['invoice_date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];				 
				 
				$que1="select * from contact_master where s_no='$invoice_firm_name'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $reference; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
				  <th><?php echo $invoice_payment_mode; ?></th>
				  <th><?php echo $invoice_grand_total; ?></th>
				  <th><?php echo $invoice_due_amount; ?></th>
				  <th>
				     <a style="color:Red;" aria-hidden="true" onclick="if(window.confirm(' Do You Want Deleted..'))return myFunction('<?php echo $invoice_no; ?>')" class="fa fa-trash-o" href='#'> Delete</a>
				    </th>
				  
				  <?php } } ?>
				</tr>					
				</tbody>
				
                </table>
                </div>
  		
		</div>
	    </form>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
 <?php include("../attachment/../attachment/link_js.php")?>
</div>

</body>
</html>

<?php
	if(isset($_POST['Save'])){
	$customer_id = $_POST['customer_id'];
	$bank_s_no = $_POST['bank_s_no'];
	$cash_transaction_type = $_POST['cash_transaction_type'];
	$date = $_POST['date'];
	$reference = $_POST['reference'];
	$remark = $_POST['remark'];
	$invoice_total_paid = $_POST['total_amount'];
	$invoice_paid_amount = $_POST['invoice_paid_amount'];
	$balance_amount = $_POST['balance_amount'];
	$previous_invoice_total_paid=$invoice_paid_amount+$invoice_total_paid;
	$invoice_no1 = $_POST['invoice_no'];
	if($invoice_no1!=''){
	$invoice_balance=$balance_amount-$invoice_total_paid;
	$table_name="purchase_retainer_invoice";
	$payment_count = $invoice_no2[2]+1;
	}else{
	$invoice_no = '';
	$invoice_balance='';
	}
	$folder_id=$folder_id+1;
	
		$que="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$bank_s_no'";
		$run=mysql_query($que);
		while($row=mysql_fetch_array($run)){
		$bank_s_no=$row['s_no'];
		$bank_account_type=$row['bank_account_type'];
		$bank_account_name=$row['bank_account_name'];
		$credit_card_account_name=$row['credit_card_account_name'];
		if($bank_account_type=='Credit_Card'){
		$name=$credit_card_account_name.'('.$bank_account_type.')';
		$bank_name=$credit_card_account_name;
		}else{
		$name=$bank_account_name.'('.$bank_account_type.')';
		$bank_name=$bank_account_name;
		}
		}

	$upload_file=$_FILES['upload_file']['name'];
	$upload_file_temp=$_FILES['upload_file']['tmp_name'];	
	$path="../../documents/upload_file/".$folder_id;
    mkdir($path, 0755, true);
	move_uploaded_file($upload_file_temp,$path."/".$upload_file);
	$select_table = "select s_no from purchase_invoice_info where invoice_no='$invoice_no'";
	$run = mysql_query($select_table);
	$fetchrow = mysql_fetch_array($run);
	 $s_no = $fetchrow['s_no'];
	$quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount,cheque_status)
    values('$bank_s_no','$customer_id','$date','$invoice_total_paid','$reference','Cash','$remark','$cash_transaction_type','$upload_file','$folder_id','$bank_account_type','$bank_name','$invoice_no','$invoice_balance','Cleared')";
	$update_sales_table = "update puchase_invoice_info set invoice_payment_mode='$bank_s_no' where invoice_no='$invoice_no'";
	mysql_query($update_sales_table);
	$select_payment_mode = "select bank_account_type from bank_or_credit_card_info where s_no='$bank_s_no'";
	$run_q = mysql_query($select_payment_mode);
	$fetchdata = mysql_fetch_array($run_q);
	$bank_account_name = $fetchdata['bank_account_type'];
	$update_sales_table = "update purchase_invoice_info set invoice_payment_mode='$bank_account_type' where s_no='$s_no'";
	mysql_query($update_sales_table);
	
	
	$quer1="update invoice_no set folder_id='$folder_id'";
	mysql_query($quer1);
	if($invoice_no1!=''){
	$quer12="update $table_name set invoice_due_amount='$invoice_balance',invoice_total_paid='$previous_invoice_total_paid' where invoice_no='$invoice_no'";
	mysql_query($quer12);
	}
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Added');</script>";
    echo "<script>window.open('purchase_retainer_invoice.php','_self');</script>";
}
}

?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
