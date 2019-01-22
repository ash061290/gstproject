<?phpinclude("../../attachment/session.php");
    $customer_id = $_POST['customer_id'];
	$invoice_no = $_POST['invoice_no'];
	$bank_s_no = $_POST['bank_s_no'];
	$company_code = $_POST['company_code'];
	$cash_transaction_type = $_POST['cash_transaction_type'];
	$date = $_POST['date'];
	$remark = $_POST['remark'];
	$invoice_total_paid = $_POST['total_amount'];
	$invoice_paid_amount = $_POST['total_amount'];
	$balance_amount = $_POST['balance_amount'];
	$invoice_balance = $balance_amount - $invoice_paid_amount;
	$previous_invoice_total_paid=$invoice_paid_amount+$invoice_total_paid;
	$invoice_no1 = $_POST['invoice_no'];
	$contact_transport_name = $row['contact_transport_name'];
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
		$select_table = "select s_no from purchase_invoice_info where invoice_no='$invoice_no' and company_code='$company_code'";
	$run = mysql_query($select_table);
	$fetchrow = mysql_fetch_array($run);
	 $s_no = $fetchrow['s_no'];
	$quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount,cheque_status,company_code)
    values('$bank_s_no','$customer_id','$date','$invoice_total_paid','','Cash','$remark','$cash_transaction_type','','','$bank_account_type','$bank_name','$invoice_no','$invoice_balance','Cleared','$company_code')";
	$update_sales_table = "update puchase_invoice_info set invoice_payment_mode='$bank_s_no' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$select_payment_mode = "select bank_account_type from bank_or_credit_card_info where s_no='$bank_s_no' and company_code='$company_code'";
	$run_q = mysql_query($select_payment_mode);
	$fetchdata = mysql_fetch_array($run_q);
	$bank_account_name = $fetchdata['bank_account_type'];
	$update_sales_table = "update purchase_invoice_info set invoice_due_amount='$invoice_balance',invoice_total_paid='$previous_invoice_total_paid',invoice_payment_mode='$bank_account_type' where s_no='$s_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$quer1="update invoice_no set where company_code='$company_code'";
	mysql_query($quer1);
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Added');</script>";
    echo "<script>window.open('payment_received.php','_self');</script>";
}
	   
      ?>