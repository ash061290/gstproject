<?php
include("../../attachment/session.php");
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
	
	$upload_file_name=$_FILES['upload_file']['name'];            
	$upload_file_temp=$_FILES['upload_file']['tmp_name'];
	
	if($upload_file_name==null){
	$upload_file_name=$upload_file;
	}
	else{
	move_uploaded_file($upload_file_temp,$path."/$upload_file_name");
	}
	
	$quer="update account_info set bank_s_no='$s_no',customer_id='$customer_id',date='$date',invoice_total_paid='$invoice_total_paid',reference='$reference',payment_mode='$payment_mode',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',remark='$remark',transaction_type='Debit',upload_file='$upload_file_name',folder_name='$folder_name',account_type='$bank_account_type',account_name='$bank_name',invoice_no='$invoice_no',cheque_status='$cheque_status',invoice_due_amount='$invoice_balance' where s_no='$account_s_no'";
	
	if($invoice_no!=''){
	$quer12="update purchase_invoice_info set invoice_due_amount='$purchase_sale_due_amount',invoice_total_paid='$purchase_sale_total_paid' where invoice_no='$invoice_no'";
	mysql_query($quer12);
	}
	
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Update');</script>";
    echo "<script>window.open('expence_transaction_details.php?id=$s_no','_self');</script>";
}
}

?>