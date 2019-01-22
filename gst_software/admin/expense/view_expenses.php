<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Expenses Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('expense/view_expenses')"><i class="fa fa-list"></i>Expenses Details</a></li>
        <li class="active">Expenses Details</li>
      </ol>
    </section>
<script>
	function valid(){   
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	return true;        
	 }            
	else  {      
	return false;
	 }       
	  }           
</script>
<script>
function payment_detail(value){
if(value=='Cheque'){
$('#cheque_or_dd').show();
$('#cheque_dd_no').show();
$('#cheque_dd_issue_date').show();
$('#cheque_dd_clearing_date').show();
}else if(value=='DD'){
$('#cheque_or_dd').show();
$('#cheque_dd_no').show();
$('#cheque_dd_issue_date').show();
$('#cheque_dd_clearing_date').show();
} else {
$('#cheque_or_dd').hide();
$('#cheque_dd_no').hide();
$('#cheque_dd_issue_date').hide();
$('#cheque_dd_clearing_date').hide();
}

}
</script>
<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete this Record !!!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}
</script>
<script>
    function expense_type(value)
	{
		    $.ajax({
			  type: "POST",
              url: software_link+"expense/ajax_filter_expense.php?expense_name="+value+"",
              cache: false,
              success: function(detail){
             $('#search_table').html(detail);
              }
           })
	}
</script>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -- Start Registration form-->
        <?php if(empty($_GET['expenses_id'])){ ?>
		<div class="box-body">
		<form method="post" enctype="multipart/form-data">				
			<div class="col-sm-12">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">	
         <div class="form-group" >
					<label><?php echo "Expenses Types" ?></label>
	            <select name="ledger_month" id="sales_type" onchange="expense_type(this.value);" 
	                class="form-control select2" style="width:100%">
					  <option value="all" selected>All</option>
					  <option value="Unreported Expenses">Unreported Expenses</option>
					  <option value="Unsubmitted Expenses">Unsubmitted Expenses</option>
					  <option value="Reimbursed Expenses">Reimbursed Expenses</option>
					  </select>
				 </div>			  
            </div>	
			</div>
			 <div class="box-body table-responsive" id="search_table"> 
                <table class="table table-bordered table-striped" id="example1">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Expense No</th>
				  <th>Excutive</th>
				  <th>Pay Type</th>
                  <th>Category</th>
				  <th>Report</th>
				  <th>Status</th>
				  <th>Amount</th>
				   <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody>
<?php
 $que="select * from add_expense where company_code='$company_code' and (expense_status='1' or expense_status='2')";
$run=mysql_query($que)or die(mysql_error());
while($row=mysql_fetch_array($run)){
$date = $row['insert_date'];
$date = explode("-",$date);
$date = array($date[2],$date[1],$date[0]);
$date = implode("-",$date);
$merchant = $row['m_name'];
$rem = $row['rem'];
$id = $row['id'];
$expense_no = $row['expense_no'];
$category = $row['category'];
$amount = $row['amount'];
$ref = $row['ref_name'];
$report_id = $row['report_id'];
$expense_status = $row['expense_status'];
$select_excutive = "select * from user_detail where user_id='$merchant' and company_code='$company_code' and status='Active'";
$run2 = mysql_query($select_excutive)or die(mysql_error());
$select2 = mysql_fetch_array($run2);
$merchant = $select2['user_name'];
$select_category = "select category_name from expense_category where id='$category' and company_code='$company_code'";
$runcat2 = mysql_query($select_category)or die(mysql_error());
$fetch_cat = mysql_fetch_array($runcat2);
$category = $fetch_cat['category_name'];
$select_report = "select title from add_report where report_id='$report_id' and company_code='$company_code'";
$runreport = mysql_query($select_report)or die(mysql_error());
$fetchreport = mysql_fetch_array($runreport);
$report_title = $fetchreport['title'];

?>
<tr>
<th><?php echo $date; ?></th>
<th><?php echo $expense_no; ?></th>
<th><?php echo $merchant; ?></th>
<th><?php echo $rem; ?></th>
<th><?php echo $category; ?></th>
<th><?php echo $report_title; ?></th>
<?php if($expense_status == '1' && $report_id=='') 
  { ?>
<th style="color:#AC5B18;"><a href="view_expenses.php?expenses_id=<?php echo $row['id']; ?>" style="color:#AC5B18;">
<?php echo "UNREPORTED"; ?></a></th>
<?php } else  if($expense_status == '1' && $report_id !=''){ ?>
<th><a href="view_expenses.php?expenses_id=<?php echo $row['id']; ?>" style="color:#18562F;">
<?php echo "UNSUBMITTED"; ?></a></th>
<?php } else  if($expense_status == '2' && $report_id !='')
 { ?>
<th><a href="view_expenses.php?expenses_id=<?php echo $row['id']; ?>" style="color:#44965A;">
<?php echo "VERIFY"; ?></a></th>
<?php } else{ ?> 
<th><a href="#" style="color:#44965A;">
<?php echo "Add Report"; ?></a></th>
<?php } ?>
<th><?php echo "&#8377;&nbsp;".$amount; ?></th>
<th>
<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="exp_edit.php?expenses_id=<?php echo $row['id']; ?>"> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href="expenses_delete.php?expenses_id=<?php echo $row['id']; ?>" > Delete</a>
</th>
</tr>	
<?php } ?>				
</tbody>
</table> 
 </div>	
	</form>
		</div>
		<?php } ?>
		<!--single-->
		 <?php if(isset($_GET['expenses_id'])){
               $id = $_GET['expenses_id'];	 ?>
		<div class="box-body">
		<form method="post" enctype="multipart/form-data">				
			 <div class="box-body table-responsive" id="search_table"> 
                <table class="table table-bordered table-striped" id="example1">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Expense No</th>
				  <th>Excutive</th>
				  <th>Pay Type</th>
                  <th>Category</th>
				  <th>Report</th>
				  <th>Status</th>
				  <th>Amount</th>
				   <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody>
<?php
 $que="select * from add_expense where id='$id' and company_code='$company_code'";
$run=mysql_query($que);
while($row=mysql_fetch_array($run)){
$date = $row['insert_date'];
$date = explode("-",$date);
$date = array($date[2],$date[1],$date[0]);
$date = implode("-",$date);
$merchant = $row['m_name'];
$expense_no = $row['expense_no'];
$rem = $row['rem'];
$id = $row['id'];
$category = $row['category'];
$category_select = "select category_name from expense_category where id='$category' and company_code='$company_code'";
$runcat = mysql_query($category_select);
$fetch_cat = mysql_fetch_array($runcat);
$category = $fetch_cat['category_name'];
$amount = $row['amount'];
$ref = $row['ref_name'];
$report_id = $row['report_id'];
$select_report = "select title from add_report where report_id='$report_id' and company_code='$company_code'";
$runreport = mysql_query($select_report);
$fetchreport = mysql_fetch_array($runreport);
$report_title = $fetchreport['title'];
$expense_status = $row['expense_status'];
$select_employee = "select * from user_detail where user_id='$merchant' and company_code='$company_code' and status='Active'";
$run2 = mysql_query($select_employee);
$fetchrow = mysql_fetch_array($run2);
$merchant = $fetchrow['user_name'];
?>
<tr>
<th><?php echo $date; ?></th>
<th><?php echo $expense_no; ?></th>
<th><?php echo $merchant; ?></th>
<th><?php echo $rem; ?></th>
<th><?php echo $category; ?></th>
<th><?php echo $report_title; ?></th>
<?php if($expense_status == '1' && $report_id=='') 
  { ?>
<th style="color:#AC5B18;"><a href="#" style="color:#AC5B18;">
<?php echo "UNREPORTED"; ?></a></th>
<?php } else  if($expense_status == '1' && $report_id !=''){ ?>
<th><a href="#" style="color:#18562F;">
<?php echo "UNSUBMITTED"; ?></a></th>
<?php } else  if($expense_status == '2' && $report_id !='')
 { ?>
<th><a href="expenses_report.php?expenses_id=<?php echo $row['id']; ?>" style="color:#44965A;">
<?php echo "VERIFY"; ?></a></th>
<?php } else { ?> <a href="#" style="color:#44965A;">
<?php echo "Add Report"; ?></a> <?php } ?>
<th><?php echo "&#8377;&nbsp;".$amount; ?></th>
<th>
<?php 
if($expense_status == '2')
{
?>
<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href="expenses_delete.php?expenses_id=<?php echo $row['id']; ?>" > Delete</a>
<?php
}
else
if($rem == "Non-Reimbursable")
{
  ?>
<strong>
<a aria-hidden="true" href='#' data-toggle="modal" data-target="#myModal1" class="fa fa-verify" > Verify </a>
</strong> &nbsp;&nbsp;&nbsp;&nbsp;
<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="expenses_edit.php?expenses_id=<?php echo $row['id']; ?>"> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href="expenses_delete.php?expenses_id=<?php echo $row['id']; ?>" > Delete</a>
<?php }     
else if($rem == "Reimbursable") 
{ ?>
<?php
if($report_id !=''){	?>
<a aria-hidden="true" href='#' data-toggle="modal" data-target="#myModal1" class="fa fa-verify" ><strong> Verify </strong> </a><?php } else{ ?><a aria-hidden="true" href='#' class="fa fa-verify" ><strong>Add Report </strong> </a> <?php } ?>
 &nbsp;&nbsp;&nbsp;&nbsp;
<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="exp_edit.php?expenses_id=<?php echo $row['id']; ?>"> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href="expenses_delete.php?expenses_id=<?php echo $row['id']; ?>" > Delete</a>
<?php  } ?>

</th>
<?php } ?>
</tr>					
</tbody>
</table> 
 </div>	
	</form>
		</div>
		<?php } ?>
		
   </div>
    </div>
</section>
  </div>
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
			<label>Pay Through</label>
			<select name="pay_through" class="form-control" required >
			<option value="">Select</option>
			<?php
			$query4="select * from bank_or_credit_card_info where bank_status='Active' and company_code='$company_code'";
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
			<div class="col-md-6">
			<label>Payment Mode</label>
			<select name="payment_mode" class="form-control" required >
			<option value="">Select</option>
			<option value="Cash">Cash</option>
			<option value="Neft">Neft</option>
			<option value="DD">DD</option>
			<option value="Cheque">Cheque</option>
			</select>
			</div>
			<div class="col-md-6" id="for_remark" style="display:none;">
			<label> Remarks </label>
			<input type="text" name="remark" id="remark" placeholder="Remarks" value="" class="form-control" />
			</div>
		  
			<div class="col-md-6" id="for_account_type" style="display:none;">
			<label>Account Type </label>
			<input type="text" name="account_type" id="account_type" value="" class="form-control" readonly />
			</div>
			<div class="col-md-6" id="for_account_name" style="display:none;">
			<label>Account Name </label>
			<input type="text" name="account_name" id="account_name" value="" class="form-control" readonly />
			</div>
			<div class="col-md-6" id="for_cheque_dd" style="display:none;">
			<label>Cheque / DD </label>
			<select name="cheque_dd" id="cheque_dd" class="form-control">
			<option value="">Select</option>
			<option value="Cheque">Cheque</option>
			<option value="DD">DD</option>
			</select>
			</div>
			<div class="col-md-6" id="for_cheque_dd_no" style="display:none;">
			<label><small>Cheque / DD No </small></label>
			<input type="text" name="cheque_dd_no" id="cheque_dd_no" placeholder="Cheque / DD No" value="" class="form-control" />
			</div>
		  
			<div class="col-md-6" id="for_cheque_dd_amount" style="display:none;">
			<label>Cheque / DD Amount </label>
			<input type="number" name="cheque_dd_amount" id="cheque_dd_amount" class="form-control" 
			value="<?php echo $amount; ?>" readonly />
			</div>
			<div class="col-md-6" id="for_cheque_dd_issue_date" style="display:none;">
			<label>Cheque / DD Issue Date </label>
			<input type="date" name="cheque_dd_issue_date" id="cheque_dd_issue_date" placeholder="Issue Date" value="" class="form-control" />
			</div>
		  
			<div class="col-md-6" id="for_cheque_dd_clearing_date" style="display:none;">
			<label>Cheque / DD Clearing Date </label>
			<input type="date" name="cheque_dd_clearing_date" id="cheque_dd_clearing_date" placeholder="Clearing Date" value="" class="form-control" />
			</div>
			<div class="col-md-6" id="for_paid_amount">
			<label>Paid Amount </label>
			<input type="number" name="paid_amount" id="paid_amount" class="form-control" value="<?php echo $amount; ?>" readonly />
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
</div>
<?php
if(isset($_POST['submit'])) {
 $select_customer = "select * from add_expense where id='$id' and company_code='$company_code'";
 $run12 = mysql_query($select_customer);
 $row12 = mysql_fetch_array($run12);
 $cutomer_id = $row12['m_name'];
$report_name = $_POST['report_name'];
$payment_total_amount=$_POST['payment_total_amount'];
$pay_through=$_POST['pay_through'];
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
$invoice_due_amount=$payment_total_amount-$paid_amount;
if($payment_mode=='Cheque' or $payment_mode=='DD') {
$cheque_status='Uncleared'; 
} else {
$cheque_status='Cleared';
}

date_default_timezone_set('Asia/Calcutta'); 
$date = date("Y-m-d H:i:s"); 
 $transaction = "INSERT INTO `account_info`(`date`,`bank_s_no`,`customer_id`,`account_type`, `account_name`,`cheque_dd`,`cheque_dd_amount`,`cheque_dd_no`,`cheque_dd_issue_date`, `cheque_dd_clearing_date`,`transaction_type`,`invoice_no`,`invoice_grand_total`, `invoice_total_paid`,`invoice_due_amount`,`account_status`,`payment_mode`,`reference`, `remark`,`folder_name`,`upload_file`,`cheque_status`,`company_name`,`company_code`) VALUES ('$date','$pay_through','$cutomer_id','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','Debit','$report_name','$amount','$amount','$invoice_due_amount','Active','$payment_mode','$ref_name','$remark','','','$cheque_status','$company_name','$company_code')";
$runtransaction = mysql_query($transaction);
$qry = "UPDATE `add_expense` SET `expense_status`='2',`paid_through`='$account_name' Where id='$id'";
$runq = mysql_query($qry) or die(mysql_error());
if($runq)
{
echo "<script>window.open('view_expenses.php?expenses_id=$id', '_self');</script>";
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
  
  })
</script>
