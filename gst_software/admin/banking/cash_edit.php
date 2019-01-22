<?php include("../../attachment/session.php"); ?>
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
       Payment By Cash Edit
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="cash_details.php"><i class="fa fa-list"></i>Cash Details</a></li>
        <li class="active">Edit Cash Details</li>
      </ol>
    </section>
	
<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
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

    <?php
	$account_s_no=$_GET['account_s_no'];
    $que11="select * from account_info where s_no='$account_s_no' and company_code='$company_code'";
    $run11=mysql_query($que11) or die(mysql_error());
    while($row11=mysql_fetch_array($run11)){
    $bank_s_no=$row11['bank_s_no']; 
    $customer_id=$row11['customer_id']; 
    $date=$row11['date']; 
    $invoice_total_paid=$row11['invoice_total_paid']; 
    $invoice_total_paid1=$row11['invoice_total_paid']; 		
    $reference=$row11['reference']; 
    $payment_mode=$row11['payment_mode']; 
    $cheque_dd=$row11['cheque_dd']; 
    $cheque_dd_no=$row11['cheque_dd_no']; 
    $cheque_dd_issue_date=$row11['cheque_dd_issue_date']; 
    $cheque_dd_clearing_date=$row11['cheque_dd_clearing_date']; 
    $remark=$row11['remark']; 
    $transaction_type=$row11['transaction_type']; 
    $upload_file=$row11['upload_file']; 
    $folder_name=$row11['folder_name']; 
    $account_type=$row11['account_type']; 
    $account_name=$row11['account_name']; 
    $invoice_no=$row11['invoice_no']; 
    $invoice_due_amount=$row11['invoice_due_amount'];

    if($transaction_type=='Credit'){
    $table='sales_invoice_info';
	}else{
	$table='purchase_invoice_info';
	}
	if($invoice_no!=''){		
	$que22="select * from $table where invoice_no='$invoice_no' and company_code='$company_code'";
    $run22=mysql_query($que22) or die(mysql_error());
    while($row22=mysql_fetch_array($run22)){
    $purchase_sale_total_paid=$row22['invoice_total_paid'];
    $purchase_sale_due_amount=$row22['invoice_due_amount'];
    }
    } else {
	$purchase_sale_total_paid=0;
	$purchase_sale_due_amount=0;
	}
	

	$path="../../documents/upload_file/".$folder_name;
    }
	?>

 <section class="content">
 <script src="../attachment/file_check.js"></script>
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
                    <h5 style="color:#873600"><b>Edit Cash Details</b></h5>
                    </div>
				    <div class="col-sm-6">
                    <a href="cash_details.php"><i class="fa fa-times" style="margin-left:100%;color:black"></i></a>
                    </div>
                    </div>
					
                    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Account Name</label>
                    <div class="col-sm-7">
					<select class="form-control select2" name="bank_s_no" style="width:100%">
						<option value="<?php echo $bank_s_no; ?>"><?php echo $account_name.'('.$account_type.')'; ?></option>
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
                        <select class="form-control select2" name="customer_id" style="width:100%" onchange="customer_vendor(this.value)">
						<?php
						$que12="select * from contact_master where s_no='$customer_id'";
						$run12=mysql_query($que12);
						while($row12=mysql_fetch_array($run12)){
						$contact_company_name=$row12['contact_company_name'];				
						$contact_contact_type=$row12['contact_contact_type'];	
          				$contact=$contact_company_name.' ('.$contact_contact_type.')';	
						}
	                    ?>
						<option value="<?php echo $customer_id; ?>"><?php echo $contact; ?></option>
						</select>
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group" style="<?php if($invoice_no==''){ echo "display:none"; } ?>">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Invoice#</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="invoice_no" id="invoice_details" style="width:100%" onchange='for_balance(this.value);'>
						<option value="<?php echo $invoice_no ?>"><?php echo $invoice_no ?></option>
						</select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Balance Amount</label>
                    <div class="col-sm-7">
                      <input type="text" name="balance_amount" placeholder="Balance" id="balance_amount" value="<?php echo $invoice_due_amount ?>" class="form-control" readonly />
					  <input type="hidden" name="purchase_sale_total_paid" placeholder="Paid Amount" class="form-control" value="<?php echo $purchase_sale_total_paid ?>" readonly />
					  <input type="hidden" name="purchase_sale_due_amount" placeholder="Paid Amount" class="form-control" value="<?php echo $purchase_sale_due_amount ?>" readonly />
                    </div>
                    </div>
                    </div>

					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Amount</label>
                    <div class="col-sm-7">
                       <input type="text" name="total_amount" value="<?php echo $invoice_total_paid; ?>" Placeholder="Amount" class="form-control">
                    </div>
                    </div>
                    </div>
										
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Date</label>
                    <div class="col-sm-7">
                       <input type="date" name="date" value="<?php echo $date; ?>" class="form-control">
                    </div>
                    </div>
                    </div>
								
					<div class="form-group" id="transaction_hide">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Transaction Type</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="cash_transaction_type" style="width:100%">
					  <option value="<?php echo $transaction_type; ?>"><?php echo $transaction_type; ?></option>
					  <?php if($invoice_no=='') { ?>
					  <option value="Credit">Credit</option>
					  <option value="Debit">Debit</option>
					  <?php } ?>
					  </select>
                    </div>
                    </div>
                    </div>

					<div class="form-group" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Refrence</label>
                    <div class="col-sm-7">
                       <input type="text" name="reference" value="<?php echo $reference; ?>" class="form-control">
                    </div>
                    </div>
                    </div>
										
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Discription</label>
                    <div class="col-sm-7">
                       <input type="text" name="remark" value="<?php echo $remark; ?>" placeholder="Discription" class="form-control">
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
						   <img src="<?php echo $path."/".$upload_file; ?>" id="show_application" height="50" width="50" >
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
			        <a href="cash_details.php"><button type="button" class="btn btn-primary">Cancel</button></a>
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
                  <th>Company Name</th>
                  <th>Account Name</th>
				  <th>Type</th>				  
				  <th>Payment Mode</th>
				  <th>Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				
				<tbody>	
                <?php 
				$date1 = $date;
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];
				?>				
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
                  <th><?php echo $account_name; ?></th>
                  <th><?php echo $transaction_type; ?></th>
                  <th><?php echo $payment_mode; ?></th>
                  <th><?php echo $invoice_total_paid; ?></th>
				  <th><a style="color:green;" class="fa fa-pencil" title="Edit" href='cash_edit.php?account_s_no=<?php echo $account_s_no;?>'></a> &nbsp;&nbsp;&nbsp;&nbsp;<a style="color:Red;" title="Delete" onclick="return myFunction()" class="fa fa-times" href='cash_delete.php?account_s_no=<?php echo $account_s_no;?>&invoice_no=<?php echo $invoice_no;?>&transaction_type=<?php echo $transaction_type;?>&paid_amount=<?php echo $invoice_total_paid;?>'></a>
				  </th>
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
 <?php include("../attachment/link_js.php")?>
</div>

</body>
</html>

<?php
	if(isset($_POST['Save'])){
	$customer_id = $_POST['customer_id'];
	$bank_s_no = $_POST['bank_s_no'];
	$cash_transaction_type = $_POST['cash_transaction_type'];
	$date = $_POST['date'];
	$invoice_total_paid = $_POST['total_amount'];
	$reference = $_POST['reference'];
	$remark = $_POST['remark'];
	$invoice_no = $_POST['invoice_no'];
    $invoice_total_paid = $_POST['total_amount'];
	$balance_amount = $_POST['balance_amount'];
	$purchase_sale_total_paid = $_POST['purchase_sale_total_paid'];
	$purchase_sale_total_paid=$purchase_sale_total_paid-$invoice_total_paid1+$invoice_total_paid;
	if($invoice_no!=''){
	$invoice_balance=$balance_amount+$invoice_total_paid1-$invoice_total_paid;
	} else {
	$invoice_balance='';
	}
	$purchase_sale_due_amount=$purchase_sale_due_amount+$invoice_total_paid1-$invoice_total_paid;
	
		$que="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$bank_s_no' and company_code='$company_code'";
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

	$upload_file_name=$_FILES['upload_file']['name'];            
	$upload_file_temp=$_FILES['upload_file']['tmp_name'];
	
	if($upload_file_name==null){
	$upload_file_name=$upload_file;
	}
	else{
	move_uploaded_file($upload_file_temp,$path."/$upload_file_name");
	}

	$quer="update account_info set bank_s_no='$bank_s_no',customer_id='$customer_id',date='$date',invoice_total_paid='$invoice_total_paid',reference='$reference',payment_mode='Cash',remark='$remark',transaction_type='$cash_transaction_type',upload_file='$upload_file_name',folder_name='$folder_name',account_type='$bank_account_type',account_name='$bank_name',invoice_no='$invoice_no',invoice_due_amount='$invoice_balance',cheque_status='Cleared' where s_no='$account_s_no'";
	
	if($cash_transaction_type=='Credit'){
    $table_name='sales_invoice_info';
	}else{
	$table_name='purchase_invoice_info';
	}
	if($invoice_no!=''){
	$quer12="update $table_name set invoice_due_amount='$purchase_sale_due_amount',invoice_total_paid='$purchase_sale_total_paid' where invoice_no='$invoice_no'";
	mysql_query($quer12);
	}

    if(mysql_query($quer)){
	echo "<script>alert('Successfully Update');</script>";
    echo "<script>window.open('cash_details.php','_self');</script>";
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
