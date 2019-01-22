<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Expenses Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('expense/view_expenses')"><i class="fa fa-plus"></i>Expenses</a></li>
        <li class="active">View Report</li>
      </ol>
    </section>
<script>
// this code is use for hide and show payment detail -----START-----
  function payment_detail(value){
  if(value!=''){
	$.ajax({
		address: "POST",
		url: software_link+"expense/get_payment_details.php?id="+value+"",
		cache: false,
		success: function(detail){
		var res = detail.split("|?|");
		var myvar=res[0];
		var myvar1=res[1];
		if(parseInt(value)==3 || parseInt(value)==4){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_paid_amount').show();
	//	$('#paid_amount').val('').prop('required',true);
		
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_cheque_dd_amount').hide();
		//$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}else if(parseInt(value)==5){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_paid_amount').show();
		//$('#paid_amount').val('').prop('required',true);
		
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_cheque_dd_amount').hide();
		//$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}else if(parseInt(value)==2){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_cheque_dd').show();
		$('#cheque_dd').val('').prop('required',true);
		$('#for_cheque_dd_no').show();
		$('#cheque_dd_no').val('').prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_paid_amount').show();
		//$('#paid_amount').val('').prop('required',true);
		$('#for_cheque_dd_amount').show();
		//$('#cheque_dd_amount').val('').prop('required',true);
		$('#for_cheque_dd_issue_date').show();
		$('#cheque_dd_issue_date').val('').prop('required',true);
		$('#for_cheque_dd_clearing_date').show();
		$('#cheque_dd_clearing_date').val('').prop('required',true);
		}else if(parseInt(value)==1){
		$('#for_account_type').hide();
		$('#account_type').val('').prop('required',false);
		$('#for_account_name').hide();
		$('#account_name').val('').prop('required',false);
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_paid_amount').show();
		//$('#paid_amount').val('').prop('required',true);
		$('#for_cheque_dd_amount').hide();
		//$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}
		}
	});
  }else{
	$('#for_account_type').hide();
	$('#account_type').val('').prop('required',false);
	$('#for_account_name').hide();
	$('#account_name').val('').prop('required',false);
	$('#for_cheque_dd').hide();
	$('#cheque_dd').val('').prop('required',false);
	$('#for_cheque_dd_no').hide();
	$('#cheque_dd_no').val('').prop('required',false);
	$('#for_remark').hide();
	$('#remark').val('');
	$('#for_paid_amount').hide();
	//$('#paid_amount').val('').prop('required',false);
	$('#for_cheque_dd_amount').hide();
	//$('#cheque_dd_amount').val('').prop('required',false);
	$('#for_cheque_dd_issue_date').hide();
	$('#cheque_dd_issue_date').val('').prop('required',false);
	$('#for_cheque_dd_clearing_date').hide();
	$('#cheque_dd_clearing_date').val('').prop('required',false);
  }
  }
  // this code is use for hide and show payment detail -----END-----
  var totalamount = document.getElementById('payment_total_amount').value;
   document.getElementById('cheque_dd_amount').value = totalamount;
   document.getElementById('paid_amount').value = totalamount;
</script>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
	<?php
	$id ="";
	if(isset($_GET['expenses_id']))
	{
	$id = $_GET['expenses_id'];
	$que1="SELECT * FROM `add_expense` WHERE `id`='$id'";
	$run1=mysql_query($que1);
	if($row1=mysql_fetch_array($run1)){
	$insert_date = $row1['insert_date'];
	$m_name = $row1['m_name'];
	$category = $row1['category'];
	 $category_select = "select category from category_add where category_id='$category'";
	 $runcat = mysql_query($category_select);
	 $fetch_cat = mysql_fetch_array($runcat);
	 $category = $fetch_cat['category'];
	$amount = $row1['amount'];
    $rem = $row1['rem'];
	$tax_type = $row1['tax_type'];
	$ref_name  = $row1['ref_name'];
	$paid_through = $row1['paid_through'];
	$select_account = "select bank_account_name,bank_account_type,credit_card_account_name from bank_or_credit_card_info where s_no='$paid_through'";
	$run_account = mysql_query($select_account);
	$fetch_account = mysql_fetch_array($run_account);
	$bank_account_name = $fetch_account['bank_account_name'];
	$bank_account_type = $fetch_account['bank_account_type'];
	if($bank_account_type=='Credit_Card')
	{
	$bank_account_name = $fetch_account['credit_card_account_name'];
	}
	$descr = $row1['description'];
	$report_id = $row1['report_id'];
	$expense_status = $row1['expense_status'];
	$select_report = "select title from add_report where report_id='$report_id'";
$runreport = mysql_query($select_report);
$fetchreport = mysql_fetch_array($runreport);
$report_title = $fetchreport['title'];
	}
	?>
<div class="box">
<div class="box-header">
<div class="col-sm-12">		
<div class="col-sm-3">
<div class="form-group">
</div>
</div>
<div class="col-sm-3">
<div class="form-group" >
</div>
</div>
<div class="col-sm-3">
<div class="form-group" >
</div>
</div>
</div>			
</div>			
<!-- /.box-header -->
<div class="box-body table-responsive"> 
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th>Category</th>
<th>Amount</th>
<th>reimbursable</th>
<th>Date</th>
<th>Merchant name</th>
<th>Report name</th>
<th>Status</th>
<th>Paid Through</th>
<th>Ref</th>
<th>Description</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<tr align='center'>
<th><b><?php echo $category; ?></b></th>
<th><span><b>&nbsp;&#8377;&nbsp;</b></span><strong><?php echo $amount ?></strong></th>
<th><?php echo $rem; ?></th>
<th><?php echo $insert_date; ?></th>
<th><?php echo $m_name; ?></th>	
<th><?php echo $report_title;?></th>	
<th><a href='#' title="Details"><?php //if($expense_status == '1'){ echo "UNREPORTED";} 
if($expense_status == '1'){ echo "UNSUBMITTED";} 
if($expense_status == '2'){ echo "VERIFY";}?></a>
</th>					
<th><?php 
if($bank_account_name){
echo $bank_account_name."(".$bank_account_type.")"; } ?></th>	
<th><?php echo $ref_name; ?></th>
<th><?php echo $descr; ?></th>
<th>
<?php 
if($expense_status == '2')
{
?>
<button type="button" class="btn btn-success">Verify </button>
<a href="expenses_edit.php?expenses_id=<?php echo $id; ?>">
<button type="button" class="btn btn-success">Edit</button></a>
<a href="expenses_delete.php?expenses_id=<?php echo $id; ?>">
<button type="button" class="btn btn-success" onclick="confirm('Do U Want Delete Data..')">Delete</button>
</a>
<?php
}
else
if($rem == "Non-Reimbursable")
{ ?>
<a aria-hidden="true" href='#' data-toggle="modal" data-target="#myModal1" >
<button type="button" class="btn btn-success">Verify </button>
</a>
<a href="expenses_edit.php?expenses_id=<?php echo $id; ?>">  
<button type="button" class="btn btn-success">Edit</button>
</a>
<a href="expenses_delete.php?expenses_id=<?php echo $id; ?>">
<button type="button" class="btn btn-success" onclick="confirm('Do U Want Delete Data..')">Delete</button>
</a>
<?php }     
else if($rem == "Reimbursable") 
{ ?>
<a aria-hidden="true" href='#' data-toggle="modal" data-target="#myModal1" >
<button type="button" class="btn btn-success">Verify </button></a>
<a href="expenses_edit.php?expenses_id=<?php echo $id; ?>"> 
<button type="button" name="Edit" class="btn btn-success">Edit</button></a>
<a href="expenses_delete.php?expenses_id=<?php echo $id; ?>">
<button type="button" class="btn btn-success" onclick="confirm('Do U Want Delete Data..')">Delete</button>
</a>
<?php  } ?>

</th>
</tr>
</tbody>
</table>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</div>
<!-- /.col -->
<!-- /.row -->
</section>
<!-- /.content -->
</div>
  
  <?php   
$qry ="select * from add_report where title ='$report_title'";
$runq  = mysql_query($qry) or die(mysql_error());
if($row3 = mysql_fetch_array($runq)){
$business_purpose = $row3['business_purpose'];
$start_date = $row3['start_date'];
$end_date = $row3['end_date'];} ?>
  <!-- modal report -->
<form method="post" enctype="multipart/form-data">
  <!-- Modal Start -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Report Info</h4>
</div>
<div class="modal-body">
<div class="col-md-12">
<div class="col-md-6">
<label>Report Name</label>
<input type="text" name="report_name" value="<?php echo $report_title; ?>" id="payment_invoice_no" class="form-control" readonly />
</div>
<div class="col-md-6">
<label>Total Amount</label>
<input type="text" name="payment_total_amount" id="payment_total_amount" class="form-control" value="<?php echo $amount; ?>"readonly />
</div>
</div>
<div class="col-md-12">
<div class="col-md-6">
<label>Payment Mode</label>
<select name="payment_mode" id="payment_mode" onchange="payment_detail(this.value);" class="form-control" required >
<option value="">Select</option>
<?php
$query4="select * from bank_or_credit_card_info where bank_status='Active'";
$res4=mysql_query($query4);
while($row4=mysql_fetch_array($res4)){
$s_no=$row4['s_no'];
$bank_account_type=$row4['bank_account_type'];
$bank_account_name=$row4['bank_account_name'];
$credit_card_account_name=$row4['credit_card_account_name'];
$payment_method=$bank_account_type.'['.$bank_account_name.']';
if($bank_account_type=='Credit_Card'){
$payment_method=$bank_account_type.'['.$credit_card_account_name.']';
}
if($bank_account_name=='Undeposited Funds'){
$payment_method='Cheque/DD';
}
?>
<option value="<?php echo $s_no; ?>"><?php echo $payment_method; ?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-6" id="for_remark" style="display:none;">
<label> Remarks </label>
<input type="text" name="remark" id="remark" placeholder="Remarks" value="" class="form-control" />
</div>

<div class="col-md-6" id="for_account_type" style="display:none;">
<label > Account Type </label>
<input type="text" name="account_type" id="account_type" value="" class="form-control" readonly />
</div>
<div class="col-md-6" id="for_account_name" style="display:none;">
<label > Account Name </label>
<input type="text" name="account_name" id="account_name" value="" class="form-control" readonly />
</div>
<div class="col-md-6" id="for_cheque_dd" style="display:none;">
<label > Cheque / DD </label>
<select name="cheque_dd" id="cheque_dd" class="form-control">
<option value="">Select</option>
<option value="Cheque">Cheque</option>
<option value="DD">DD</option>
</select>
</div>
<div class="col-md-6" id="for_cheque_dd_no" style="display:none;">
<label ><small> Cheque / DD No </small></label>
<input type="text" name="cheque_dd_no" id="cheque_dd_no" placeholder="Cheque / DD No" value="" class="form-control" />
</div>

<div class="col-md-6" id="for_cheque_dd_amount" style="display:none;">
<label > Cheque / DD Amount </label>
<input type="number" name="cheque_dd_amount" id="cheque_dd_amount" class="form-control" 
value="<?php echo $amount; ?>" readonly />
</div>
<div class="col-md-6" id="for_cheque_dd_issue_date" style="display:none;">
<label > Cheque / DD Issue Date </label>
<input type="date" name="cheque_dd_issue_date" id="cheque_dd_issue_date" placeholder="Issue Date" value="" class="form-control" />
</div>

<div class="col-md-6" id="for_cheque_dd_clearing_date" style="display:none;">
<label > Cheque / DD Clearing Date </label>
<input type="date" name="cheque_dd_clearing_date" id="cheque_dd_clearing_date" placeholder="Clearing Date" value="" class="form-control" />
</div>
<div class="col-md-6" id="for_paid_amount">
<label > Paid Amount </label>
<input type="number" name="paid_amount" id="paid_amount" class="form-control" value="<?php echo $amount; ?>" readonly />
</div>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn my_background_color" name="submit" value="Submit" />
&nbsp;&nbsp;
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
      
    </div>
  </div>
  <!-- Modal End -->
  </form>
  <?php
  if(isset($_POST['submit'])){
$report_name = $_POST['report_name'];
$payment_total_amount=$_POST['payment_total_amount'];
$payment_mode=$_POST['payment_mode'];
$remark=$_POST['remark'];
$account_type=$_POST['account_type'];
$account_name=$_POST['account_name'];
$cheque_dd=$_POST['cheque_dd'];
$cheque_dd_no=$_POST['cheque_dd_no'];
$cheque_dd_amount=$_POST['cheque_dd_amount'];
$cheque_dd_issue_date=$_POST['cheque_dd_issue_date'];
$cheque_dd_clearing_date=$_POST['cheque_dd_clearing_date'];
$paid_amount=$_POST['paid_amount'];
$invoice_due_amount="";
if($payment_mode==3 || $payment_mode==4 || $payment_mode==5){
$payment_mode1='Neft';
} else 
 if($payment_mode==2){ 
 if($cheque_dd=='Cheque'){
  $payment_mode1='Cheque';} else {
  $payment_mode1='DD';}
  } else if($payment_mode==1){
  $payment_mode1='Cash';}
 if($payment_mode1=='Cheque' or $payment_mode1=='DD'){
 $cheque_status='Uncleared';} else {
$cheque_status='Cleared';}
$qr = "SELECT * FROM `bank_or_credit_card_info` WHERE `bank_account_name`='$account_name'";
 $runq = mysql_query($qr);
 $fetchr = mysql_fetch_row($runq);
 $bank_id = $fetchr[0];
if($bank_id == '') {
$qr = "SELECT * FROM `bank_or_credit_card_info` WHERE `credit_card_account_name`='$account_name'";
$runq = mysql_query($qr);
$fetchr = mysql_fetch_row($runq);
$bank_id = $fetchr[0];}
date_default_timezone_set('Asia/Calcutta'); 
$date = date("Y-m-d H:i:s"); 
 $transaction = "INSERT INTO `account_info`(`date`,`bank_s_no`,`customer_id`,`account_type`, `account_name`,`cheque_dd`,`cheque_dd_amount`,`cheque_dd_no`,`cheque_dd_issue_date`, `cheque_dd_clearing_date`,`transaction_type`,`invoice_no`,`invoice_grand_total`, `invoice_total_paid`,`invoice_due_amount`,`account_status`,`payment_mode`,`reference`, `remark`,`folder_name`,`upload_file`,`cheque_status`) VALUES ('$date','$bank_id','','$account_type','$account_name','$cheque_dd','$cheque_dd_amount','$cheque_dd_no','$cheque_dd_issue_date','$cheque_dd_clearing_date','Debit','','$amount','$amount','$invoice_due_amount','Active','$payment_mode1','$ref_name','$remark','','','$cheque_status')";
$runtransaction = mysql_query($transaction);
$qry = "UPDATE `add_expense` SET `expense_status`='2',`paid_through`='$account_name' Where id='$id'";
$runq = mysql_query($qry) or die(mysql_error());
if($runq){ 
echo "<script>alert('Your Request is Successfully Updated !');</script>";
echo "<script>window.open('expenses_report.php?expenses_id="+$id+"', '_self');</script>"; }
		} }  ?>
<script>
  $(function () {
    $('#example1').DataTable()
   
  })
</script>
