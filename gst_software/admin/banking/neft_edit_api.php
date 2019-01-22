<?php include("../../attachment/session.php");
include("../../attachment/image_compression_upload.php");

	$customer_id = $_POST['customer_id'];
	$s_no = $_POST['account_s_no'];
    $bank_s_no = $_POST['bank_s_no'];
	$neft_transaction_type = $_POST['neft_transaction_type'];
	$date = $_POST['date'];
	$reference = $_POST['reference'];
	$payment_mode = $_POST['payment_mode'];
	$remark = $_POST['remark'];
	$invoice_no = $_POST['invoice_no'];
    $invoice_total_paid = $_POST['total_amount'];
	$balance_amount = $_POST['balance_amount'];
	$purchase_sale_due_amount = $_POST['purchase_sale_due_amount'];
	$purchase_sale_total_paid = $_POST['purchase_sale_total_paid'];
	$purchase_sale_total_paid=$purchase_sale_total_paid+$invoice_total_paid;
	if($invoice_no!=''){
	$invoice_balance=$balance_amount-$invoice_total_paid;
	} else {
	$invoice_balance='';
	$invoice_due_amount='';
	}
	$purchase_sale_due_amount=$purchase_sale_due_amount-$invoice_total_paid;
		
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
      $quer="update account_info set bank_s_no='$bank_s_no',customer_id='$customer_id',date='$date',invoice_total_paid='$invoice_total_paid',reference='$reference',payment_mode='$payment_mode',remark='$remark',transaction_type='$neft_transaction_type',folder_name='',account_type='$bank_account_type',account_name='$bank_name',invoice_no='$invoice_no',invoice_due_amount='$invoice_balance',cheque_status='Cleared' where s_no='$s_no'";
		
		
		if($neft_transaction_type=='Credit'){
    $table_name='sales_invoice_info';
	}else{
	$table_name='purchase_invoice_info';
	}
	
	    if($invoice_no!=''){
	$quer12="update $table_name set invoice_due_amount='$purchase_sale_due_amount',invoice_total_paid='$purchase_sale_total_paid' where invoice_no='$invoice_no'";
	mysql_query($quer12);
	}
	 
	 if(mysql_query($quer)){
	 $id = $s_no;
		 $upload_file = $_FILES['upload_file']['name'];				
		 if($upload_file!=''){
	$imagename = $_FILES['upload_file']['name'];
	$size = $_FILES['upload_file']['size'];
    $imgData  = $_FILES['upload_file']['tmp_name'];
    camera_code($size,$imagename,$imgData,$id,"upload_file","account_info","s_no");
	
	}
	
	echo "|?|success|?|";
	}

 
    
	
?>
