<?php
   include("../../attachment/session.php");
    $que11="select * from invoice_no";
    $run11=mysql_query($que11) or die(mysql_error());
    while($row11=mysql_fetch_array($run11)){
    $folder_id=$row11['folder_id']; 
    }
    $upload_file='';
    $customer_id = $_POST['customer_id'];
	$bank_s_no = $_POST['bank_s_no'];
	$cheque_transaction_type = $_POST['cheque_transaction_type'];
	$date = $_POST['date'];
	$payment_mode = $_POST['payment_mode'];
	$cheque_dd = $_POST['cheque_or_dd'];
	$cheque_dd_no = $_POST['cheque_dd_no'];
	$cheque_dd_issue_date = $_POST['cheque_dd_issue_date'];
	$cheque_dd_clearing_date = $_POST['cheque_dd_clearing_date'];
	$invoice_total_paid = $_POST['total_amount'];
	$invoice_paid_amount = $_POST['total_amount'];
	$balance_amount = $_POST['balance_amount'];
	$previous_invoice_total_paid=$invoice_paid_amount+$invoice_total_paid;
    $invoice_no = $_POST['invoice_no'];
	$invoice_balance='';
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
		if(!empty($_FILES['image']['type']))
		{
    $folder_id = $folder_id+1;
    $upload_file=$_FILES['image']['name'];
	$upload_file_temp=$_FILES['image']['tmp_name'];	
	$path="../../documents/upload_file/".$folder_id;
	 mkdir($path, 0755, true);
	if(move_uploaded_file($upload_file_temp,$path."/".$upload_file)){
	  }
		}
	$quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,cheque_dd,cheque_dd_no,cheque_dd_issue_date,cheque_dd_clearing_date,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount)
    values('$bank_s_no','$customer_id','$date','$invoice_total_paid','','$cheque_dd','$cheque_dd','$cheque_dd_no','$cheque_dd_issue_date','$cheque_dd_clearing_date','','$cheque_transaction_type','$upload_file','$folder_id','$bank_account_type','$bank_name','$invoice_no','$balance_amount')";
	$quer1="update invoice_no set folder_id='$folder_id'";
	mysql_query($quer1);
	if($invoice_no!=''){
	$quer12="update purcase_invoice_info set payment_count='',invoice_due_amount='$balance_amount',invoice_total_paid='$previous_invoice_total_paid' where invoice_no='$invoice_no'";
	mysql_query($quer12);
	}
	
    if(mysql_query($quer)){
	//echo "<script>alert('Successfully Added');</script>";
    //echo "<script>window.open('payment_received.php','_self');</script>";
}
	   
      ?>