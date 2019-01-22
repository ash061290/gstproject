<?php include("../../attachment/session.php");?>
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
       Expense Transaction Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="banking.php"><i class="fa fa-list"></i>Bank Details</a></li>
        <li class="active">Expense Transaction Details</li>
      </ol>
    </section>
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
<script>
function myFunction(){   
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	return true;        
	 }            
	else  {      
	return false;
	 }       
	  } 

        function customer_vendor(value){    
            $.ajax({
			  type: "POST",
              url: "ajax_customer_wise_invoice_details.php?customer_id="+value+"",
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
              url: "ajax_invoice_balance.php?invoice_no="+value+"",
              cache: false,
              success: function(detail){
			  var res=detail.split('|?|');
		      $("#balance_amount").val(res[0]);
		      $("#invoice_paid_amount").val(res[2]);
			  if(detail!=''){
			  if(res[1]!='Credit'){	
			  $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
		      $("#transaction_type option[value='Credit']").remove();			  
		      $("#transaction_type option[value='']").remove();			  
			  }else if(res[1]!='Debit'){
			  $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
			  $("#transaction_type option[value='Debit']").remove();			  
		      $("#transaction_type option[value='']").remove();	
			  }}else{
			   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
			  }
              }
           });
        }  
</script>
<script>
function payment_detail(value){
if(value=='Cheque'){
$('#cheque_dd_no').show();
$('#cheque_dd_issue_date').show();
$('#cheque_dd_clearing_date').show();
$('#cheque_dd_no1').prop("required", true);
$('#cheque_dd_issue_date1').prop("required", true);
$('#cheque_dd_clearing_date1').prop("required", true);
}else if(value=='DD'){
$('#cheque_dd_no').show();
$('#cheque_dd_issue_date').show();
$('#cheque_dd_clearing_date').show();
$('#cheque_dd_no1').prop("required", true);
$('#cheque_dd_issue_date1').prop("required", true);
$('#cheque_dd_clearing_date1').prop("required", true);
} else {
$('#cheque_dd_no').hide();
$('#cheque_dd_issue_date').hide();
$('#cheque_dd_clearing_date').hide();
$('#cheque_dd_no1').prop("required", false);
$('#cheque_dd_issue_date1').prop("required", false);
$('#cheque_dd_clearing_date1').prop("required", false);
$('#cheque_dd_no1').val('');
$('#cheque_dd_issue_date1').val('');
$('#cheque_dd_clearing_date1').val('');
}

}
</script>
<?php
    $que11="select * from invoice_no where company_code='$company_code'";
    $run11=mysql_query($que11) or die(mysql_error());
    while($row11=mysql_fetch_array($run11)){
    $folder_id=$row11['folder_id']; 
    }
  ?>	
	
    <?php
	$s_no=$_GET['id'];
	$que="select * from bank_or_credit_card_info where s_no='$s_no' and company_code='$company_code'";
	$run=mysql_query($que);
	while($row=mysql_fetch_array($run)){
	$s_no = $row['s_no'];
	$bank_account_type = $row['bank_account_type'];
	$credit_card_account_name = $row['credit_card_account_name'];
	$credit_card_account_number = $row['credit_card_account_number'];
	$bank_account_name = $row['bank_account_name'];
	$bank_account_number = $row['bank_account_number'];
	if($bank_account_type=='Credit_Card'){
	$name='Credit Card('.$credit_card_account_name.')';
	$account_no=$credit_card_account_number.'XXXXXX';
	$class='fa fa-credit-card-alt';
	$bank_name=$credit_card_account_name;
	}
	else if($bank_account_type=='Bank'){
	$name=$bank_account_type.'('.$bank_account_name.')';
	$account_no=$bank_account_number.'XXXXXX';
	$class='fa fa-university';
	$bank_name=$bank_account_name;
	}else {
	$name=$bank_account_type.'('.$bank_account_name.')';
	$account_no='XXXXXXX112323';
	$class='fa fa-money';
	$bank_name=$bank_account_name;
	}
	}
	
	$que="select * from account_info where bank_s_no='$s_no' and account_status='Active' and company_code='$company_code'";
	$run=mysql_query($que);
	$total_credit_amount=0;
	$total_debit_amount=0;
	$running_amount=0;
	while($row=mysql_fetch_array($run)){
	$invoice_total_paid = $row['invoice_total_paid'];
	$transaction_type = $row['transaction_type'];
	if($transaction_type=='Credit'){
	$credit_amount=$invoice_total_paid;
	$debit_amount='';
	$total_credit_amount=$total_credit_amount+$credit_amount;				
	}else{
	$debit_amount=$invoice_total_paid;
	$credit_amount='';
	$total_debit_amount=$total_debit_amount+$debit_amount;
	}
	$running_amount=$total_credit_amount-$total_debit_amount;
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
<!------------------------------------------------Start Registration form--------------------------------------------------->
        <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">				
			<div class="col-sm-12">
			<div class="col-sm-6">
                <h4><i class="<?php echo $class; ?>">&nbsp;<?php echo $name; ?></i></h4>
                <h5><?php echo $account_no; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Running Balance : <b><a style="color:red"><?php echo $running_amount;?></a></b></h5>
            </div>
			<div class="col-sm-4" style="margin-left:55px">			
                <div class="input-group-btn">
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Add Transaction
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu" style="background-color:#F8F9F9;">
                    <li style="color:#DC7633"><b>MONEY OUT</b></li>
                    <li><a href="expence_transaction_details.php?id=<?php echo $s_no; ?>">Expense</a></li>					
					<li style="color:#DC7633"><b>MONEY IN</b></li>
					<li><a href="income_transaction_details.php?id=<?php echo $s_no; ?>">Income</a></li>
                  </ul>
                </div>         
            </div>
			</div>
				<div class="col-md-8 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Refrence</th>
				  <th>Type</th>				  
				  <th>Payment Mode</th>
				  <th>Withdrawals</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody>
				<?php				
				$que="select * from account_info where bank_s_no='$s_no' and transaction_type='Debit' and account_status='Active' and company_code='$company_code'";
				$run=mysql_query($que);
				$total_credit_amount=0;
				$total_debit_amount=0;
				$running_amount=0;
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['reference'];
				$invoice_no = $row['invoice_no'];
				$customer_id = $row['customer_id'];
				$payment_mode = $row['payment_mode'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$date1 = $row['date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];
				$que1="select * from contact_master where s_no='$customer_id' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
				  <th>Debit</th>
				  <th><?php echo $payment_mode; ?></th>
				  <th><?php echo $invoice_total_paid; ?></th>
				  <th><a style="color:green;" class="fa fa-pencil" title="Edit" href='expence_transaction_edit.php?id=<?php echo $s_no; ?>&account_s_no=<?php echo $account_s_no;?>'></a> &nbsp;&nbsp;&nbsp;&nbsp;<a style="color:Red;" title="Delete" onclick="return myFunction()" class="fa fa-times" href='expence_transaction_delete.php?id=<?php echo $s_no; ?>&account_s_no=<?php echo $account_s_no;?>&invoice_no=<?php echo $invoice_no;?>&transaction_type=<?php echo $transaction_type;?>&paid_amount=<?php echo $invoice_total_paid;?>'></a>
				  </th>
				  <?php } } ?>
				</tr>					
				</tbody>
				
                </table>
                </div>
          <!-----------------------------------Expence Details Start----------------------------------------------->
          <!--------------------------------###########################------------------------------------------->	        			
				<div class="col-md-4 box-body table-responsive" style="background-color:#F2F3F4">
                <table id="" class="table table-bordered table-striped">
                <thead class="">
                </thead>
										
		        <tbody>
			    <div class="col-sm-12 form-horizontal">	
                    <div class="col-sm-12">
					<div class="col-sm-6">
                    <h5 style="color:#2E8B9E"><b>Expense</b></h5>
                    </div>
				    <div class="col-sm-6">
                    <a href="transaction_details.php?id=<?php echo $s_no; ?>"><i class="fa fa-times" style="margin-left:140px;color:black"></i></a>
                    </div>
                    </div>
					
                    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Expense Account</label>
                    <div class="col-sm-7">
                       <input type="text" name="bank_s_no" value="<?php echo $name; ?>" class="form-control" readonly>
                    </div>
                    </div>
                    </div>
				
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Customer/Vendor </label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="customer_id" style="width:100%" onchange="customer_vendor(this.value)" required>
						<option value="">Select</option>
						<?php
						$que="select * from contact_master where contact_status='Active' and company_code='$company_code'";
						$run=mysql_query($que);
						while($row=mysql_fetch_array($run)){
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
						<option value="<?php echo $customer_id; ?>"><?php echo $contact; ?></option>
						<?php } ?>
						</select>
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Invoice#</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="invoice_no" id="invoice_details" style="width:100%" onchange='for_balance(this.value);'>
						<option value="">Select</option>
						</select>
                    </div>
                    </div>
                    </div>

					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Balance Amount</label>
                    <div class="col-sm-7">
                      <input type="text" name="balance_amount" placeholder="Balance" id="balance_amount" class="form-control" readonly />
                      <input type="hidden" name="invoice_paid_amount" placeholder="Paid Amount" id="invoice_paid_amount" class="form-control" value="0" readonly />
                    </div>
                    </div>
                    </div>
				                   
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Amount</label>
                    <div class="col-sm-7">
                       <input type="text" name="total_amount" value="" Placeholder="Amount" class="form-control" required>
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
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Refrence</label>
                    <div class="col-sm-7">
                       <input type="text" name="reference" value="" class="form-control">
                    </div>
                    </div>
                    </div>
									
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Payment Mode</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="payment_mode" onchange="payment_detail(this.value)" style="width:100%" required>
					  <option value="">Select</option>
					  <option value="Cash">Cash</option>
					  <option value="Neft">Neft</option>
					  <option value="Cheque">Cheque</option>
					  <option value="DD">DD</option>
					  </select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Cheque/DD</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="cheque_or_dd" style="width:100%">
					  <option value="">Select</option>
					  <option value="Cheque">Cheque</option>
					  <option value="DD">DD</option>
					  </select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="cheque_dd_no" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Cheque/DD No</label>
                    <div class="col-sm-7">
                       <input type="text" name="cheque_dd_no" id="cheque_dd_no1" value="" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="cheque_dd_issue_date" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Cheque/DD Issue Date</label>
                    <div class="col-sm-7">
                       <input type="date" name="cheque_dd_issue_date" id="cheque_dd_issue_date1" value="" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group"  id="cheque_dd_clearing_date" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Cheque/DD Clearing Date</label>
                    <div class="col-sm-7">
                       <input type="date" name="cheque_dd_clearing_date" id="cheque_dd_clearing_date1" value="" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="remark">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Discription</label>
                    <div class="col-sm-7">
                       <input type="text" name="remark" value="" class="form-control">
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
			        <a href="transaction_details.php?id=<?php echo $s_no; ?>"><button type="button" class="btn btn-primary">Cancel</button></a>                 
		            </div>
		            </div>	
        <!-----------------------------------Expence Details Start----------------------------------------------->					
			    </div>
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
 <?php include("../attachment/link_js.php")?>
</div>

</body>
</html>

<?php

	if(isset($_POST['Save'])){
	$customer_id = $_POST['customer_id'];
	$date = $_POST['date'];
	$invoice_total_paid = $_POST['total_amount'];
	$reference = $_POST['reference'];
	$payment_mode = $_POST['payment_mode'];
	$cheque_dd = $_POST['cheque_or_dd'];
	$cheque_dd_no = $_POST['cheque_dd_no'];
	$cheque_dd_issue_date = $_POST['cheque_dd_issue_date'];
	$cheque_dd_clearing_date = $_POST['cheque_dd_clearing_date'];
	$remark = $_POST['remark'];
	
	$invoice_total_paid = $_POST['total_amount'];
	$invoice_paid_amount = $_POST['invoice_paid_amount'];
	$balance_amount = $_POST['balance_amount'];
	$previous_invoice_total_paid=$invoice_paid_amount+$invoice_total_paid;
	$invoice_no1 = $_POST['invoice_no'];
	if($invoice_no1!=''){
	$invoice_balance=$balance_amount-$invoice_total_paid;
	$invoice_no2 = explode('|?|',$invoice_no1);
	$invoice_no = $invoice_no2[0];
	$table_name = $invoice_no2[1];
	$payment_count = $invoice_no2[2]+1;
	}else{
	$invoice_no = '';
	$invoice_balance='';
	}

	if($payment_mode=='Cheque'){
	$cheque_dd='Cheque';
	}elseif($payment_mode=='DD'){
	$cheque_dd='DD';
	}	
	if($payment_mode=='Cheque' or $payment_mode=='DD'){
	$cheque_status='Uncleared';
	}else{
	$cheque_status='Cleared';
	}
	
	$folder_id=$folder_id+1;

	$upload_file=$_FILES['upload_file']['name'];
	$upload_file_temp=$_FILES['upload_file']['tmp_name'];	
	$path="../../documents/upload_file/".$folder_id;
    mkdir($path, 0755, true);
	move_uploaded_file($upload_file_temp,$path."/".$upload_file);

	
	$quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,cheque_dd,cheque_dd_no,cheque_dd_issue_date,cheque_dd_clearing_date,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount,cheque_status,company_name,company_code)
    values('$s_no','$customer_id','$date','$invoice_total_paid','$reference','$payment_mode','$cheque_dd','$cheque_dd_no','$cheque_dd_issue_date','$cheque_dd_clearing_date','$remark','Debit','$upload_file','$folder_id','$bank_account_type','$bank_name','$invoice_no','$invoice_balance','$cheque_status','$company_name','$company_code')";
	
	$quer1="update invoice_no set folder_id='$folder_id'";
	mysql_query($quer1);
	if($invoice_no1!=''){
	$quer12="update $table_name set payment_count='$payment_count',invoice_due_amount='$invoice_balance',invoice_total_paid='$previous_invoice_total_paid' where invoice_no='$invoice_no'";
	mysql_query($quer12);
	}
	
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Added');</script>";
    echo "<script>window.open('transaction_details.php?id=$s_no','_self');</script>";
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
