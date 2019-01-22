 <?php include("../../attachment/session.php");
	$customer_id = $_POST['customer_id'];
	$bank_s_no = $_POST['bank_s_no'];
	$cheque_dd = $_POST['cheque_or_dd'];
	$cheque_dd_no = $_POST['cheque_dd_no'];
	$cheque_dd_issue_date = $_POST['cheque_dd_issue_date'];
	$cheque_dd_clearing_date = $_POST['cheque_dd_clearing_date'];
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
	$invoice_no2 = explode('|?|',$invoice_no1);
	$invoice_no = $invoice_no2[0];
	$table_name = $invoice_no2[1];
	$payment_count = $invoice_no2[2]+1;
	}else{
	$invoice_no = '';
	$invoice_balance='';
	}
	if($cheque_dd !=''){ $cheque_dd_amount=$invoice_total_paid; $cheque_status='Unclear';}else{ $cheque_dd_amount =""; $cheque_status = "Clear"; }
	  $que="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$bank_s_no' and company_code='$company_code'";
		$run=mysql_query($que);
		while($row=mysql_fetch_array($run)){
		$bank_s_no=$row['s_no'];
		$account_type = $row['bank_account_type'];
		$bank_account_type=$row['bank_account_type'];
		$bank_account_name=$row['bank_account_name'];
		$credit_card_account_name=$row['credit_card_account_name'];
		if($bank_account_type=='Credit_Card'){
		$name=$credit_card_account_name.'('.$bank_account_type.')';
		$bank_name=$credit_card_account_name;
		}else if($bank_account_type =='E-Payment'){
		        $name = $bank_account_name.'('.$bank_account_type.')';
				$bank_name=$bank_account_name;
		}else{
		$name=$bank_account_name.'('.$bank_account_type.')';
		$bank_name=$bank_account_name;
		} }
	$select_table = "select s_no from sales_invoice_new where invoice_no='$invoice_no' and company_code='$company_code'";
	$run = mysql_query($select_table);
	$fetchrow = mysql_fetch_array($run);
	 $s_no = $fetchrow['s_no'];
	 if($cheque_dd =='Cheque'){ $payment_mode ="Cheque"; } else if( $cheque_dd =='DD'){ $payment_mode="DD"; }else{ $payment_mode = $account_type; }
	$quer="insert into account_info(date,bank_s_no,customer_id,account_type,account_name,cheque_dd,cheque_dd_amount,cheque_dd_no,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,invoice_no,invoice_grand_total,invoice_total_paid,invoice_due_amount,account_status,payment_mode,reference,remark,upload_file,cheque_status,company_name,company_code)
    values('$date','$bank_s_no','$customer_id','$account_type','$bank_name','$cheque_dd','$cheque_dd_amount','$cheque_dd_no','$cheque_dd_issue_date','$cheque_dd_clearing_date','Credit','$invoice_no','$invoice_balance','$invoice_total_paid','$invoice_balance','Active','$payment_mode','$reference','$remark','','$cheque_status','$company_name','$company_code')";
	/*
	$update_sales_table ="update sales_invoice_new set invoice_payment_mode='$bank_s_no' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$select_payment_mode = "select bank_account_type from bank_or_credit_card_info where s_no='$bank_s_no' and company_code='$company_code'";
	$run_q = mysql_query($select_payment_mode);
	$fetchdata = mysql_fetch_array($run_q);
	$bank_account_name = $fetchdata['bank_account_type'];
	$update_sales_table = "update sales_invoice_new set invoice_payment_mode='$bank_account_type' where s_no='$s_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	*/
	if($invoice_no1!=''){
    $quer12="update $table_name set payment_count='$payment_count',invoice_due_amount='$invoice_balance',invoice_total_paid='$previous_invoice_total_paid' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($quer12);
	}
    if(mysql_query($quer)){
	echo "|?|success|?|";
   }
?>