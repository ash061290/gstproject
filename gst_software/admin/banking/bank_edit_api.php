<?php  include("../../attachment/session.php");

    $s_no = $_POST['s_no'];
	$bank_account_type = $_POST['bank_account_type'];
	$bank_account_name = $_POST['bank_account_name'];
	$bank_account_code = $_POST['bank_account_code'];
	$bank_account_number = $_POST['bank_account_number'];
	$bank_name = $_POST['bank_name'];
	$Mobile_No = $_POST['Mobile_No'];
	$bank_description_bank = $_POST['bank_description_bank'];	
	$credit_card_account_name = $_POST['credit_card_account_name'];
	$credit_card_bank_name = $_POST['credit_card_bank_name'];
	$credit_card_account_number = $_POST['credit_card_account_number'];
	$credit_card_card_number = $_POST['credit_card_card_number'];
	$credit_card_account_code = $_POST['credit_card_account_code'];
	$credit_card_description_bank = $_POST['credit_card_description_bank'];
	$credit_card_routing_no = $_POST['credit_card_routing_no'];
	$account_type = $_POST['account_type'];
	$pan_card_no = $_POST['pan_card_no'];
    $query="update bank_or_credit_card_info set bank_account_type='$bank_account_type',bank_account_name='$bank_account_name',bank_account_code='$bank_account_code',bank_account_number='$bank_account_number',bank_name='$bank_name',Mobile_No='$Mobile_No',bank_description_bank='$bank_description_bank',credit_card_account_name='$credit_card_account_name',credit_card_bank_name='$credit_card_bank_name',credit_card_account_number='$credit_card_account_number',credit_card_card_number='$credit_card_card_number',credit_card_account_code='$credit_card_account_code',credit_card_description_bank='$credit_card_description_bank',credit_card_routing_no='$credit_card_routing_no',account_type='$account_type',pan_card_no='$pan_card_no' where s_no='$s_no'";
    mysql_query($query);
    if(mysql_query($query)){
	echo "|?|success|?|";
	//echo "<script>alert('Successfully Update');</script>";
	//echo "<script>window.open('banking.php','_self')</script>";
	}

	?>	