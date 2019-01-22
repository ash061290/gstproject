<?php
include("../../attachment/session.php");
	if(isset($_POST['Save'])){
	$customer_id = $_POST['customer_id'];
	$bank_s_no = $_POST['bank_s_no'];
	$neft_transaction_type = $_POST['neft_transaction_type'];
	$date = $_POST['date'];
	$reference = $_POST['reference'];
	$payment_mode = $_POST['payment_mode'];
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

	
	$quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount,cheque_status)
    values('$bank_s_no','$customer_id','$date','$invoice_total_paid','$reference','$payment_mode','$remark','$neft_transaction_type','$upload_file','$folder_id','$bank_account_type','$bank_name','$invoice_no','$invoice_balance','Cleared')";
	
	$quer1="update invoice_no set folder_id='$folder_id'";
	mysql_query($quer1);
	if($invoice_no1!=''){
	$quer12="update $table_name set payment_count='$payment_count',invoice_due_amount='$invoice_balance',invoice_total_paid='$previous_invoice_total_paid' where invoice_no='$invoice_no'";
	mysql_query($quer12);
	}
	
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Added');</script>";
    echo "<script>window.open('neft_details.php','_self');</script>";
}
}

?>