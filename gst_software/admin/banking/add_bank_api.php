 <?php include("../../attachment/session.php");
 
 
    $account_type = $_POST['account_type'];
	$bank_account_type = $_POST['bank_account_type'];
	$bank_account_name = $_POST['bank_account_name'];
	$bank_account_code = $_POST['bank_account_code'];
	$bank_account_number = $_POST['bank_account_number'];
	$pan_card_no = $_POST['pan_card_no'];
	$bank_name = $_POST['bank_name'];
	$Mobile_No = $_POST['Mobile_No'];
	$company_code = $_POST['company_code'];
	$bank_description_bank = $_POST['bank_description_bank'];	
	$credit_card_account_name = $_POST['credit_card_account_name'];
	$credit_card_bank_name = $_POST['credit_card_bank_name'];
	$credit_card_account_number = $_POST['credit_card_account_number'];
	$credit_card_card_number = $_POST['credit_card_card_number'];
	$credit_card_account_code = $_POST['credit_card_account_code'];
	$credit_card_description_bank = $_POST['credit_card_description_bank'];
	$credit_card_routing_no = $_POST['credit_card_routing_no'];
 $quer="insert into bank_or_credit_card_info(bank_account_type,bank_account_name,bank_account_code,bank_account_number,bank_name,Mobile_No,bank_description_bank,credit_card_account_name,credit_card_bank_name,credit_card_account_number,credit_card_card_number,credit_card_account_code,credit_card_description_bank,credit_card_routing_no,account_type,pan_card_no,company_code)
  values('$bank_account_type','$bank_account_name','$bank_account_code','$bank_account_number','$bank_name','$Mobile_No','$bank_description_bank','$credit_card_account_name','$credit_card_bank_name','$credit_card_account_number','$credit_card_card_number','$credit_card_account_code','$credit_card_description_bank','$credit_card_routing_no','$account_type','$pan_card_no','$company_code')";
if(mysql_query($quer)){
		echo "|?|success|?|";
	//echo "<script>alert('Successfully Complete');</script>";
	//echo "<script>window.open('banking.php','_self')</script>";
	
	}
	

	?>	