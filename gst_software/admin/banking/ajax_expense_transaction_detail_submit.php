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
	$quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,cheque_dd,cheque_dd_no,cheque_dd_issue_date,cheque_dd_clearing_date,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount,cheque_status)
    values('$s_no','$customer_id','$date','$invoice_total_paid','$reference','$payment_mode','$cheque_dd','$cheque_dd_no','$cheque_dd_issue_date','$cheque_dd_clearing_date','$remark','Debit','$upload_file','$folder_id','$bank_account_type','$bank_name','$invoice_no','$invoice_balance','$cheque_status')";
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