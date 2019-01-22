<?php include("../../attachment/image_compression_upload.php");
$expense_vendor_name             =$_POST['vendor_name'];
$expense_date                    =$_POST['expense_date'];
$expense_contact_no              =$_POST['expense_contact_no'];
$expense_place_of_supply         =$_POST['invoice_place_of_supply'];
$expense_billing_address         =$_POST['invoice_billing_address'];
$company_code                    =$_POST['company_code'];
$insert_data = "insert into shop_details(expense_vendor_name,expense_date,expense_contact_no,expense_place_of_supply,expense_billing_address,expense_status,company_code) values('$expense_vendor_name','$expense_date','$expense_contact_no','$expense_place_of_supply','$expense_billing_address','Active','$company_code')";
  $run = mysql_query($insert_data);
  $last_id = mysql_insert_id();
$expense_shop_details            =$last_id;
$expense_invoice_no              =$_POST['expense_invoice_no'];
$expense_no                      =$_POST['invoice_no'];
$expense_date                    =$_POST['expense_date'];
$expense_product_name            =$_POST['product_name'];
$expense_quantity                =$_POST['quantity'];
$expense_price                   =$_POST['price'];
$expense_total_amount            =$_POST['total_amount'];
$expense_item_description        =$_POST['item_description'];
$expense_payment_mode            =$_POST['invoice_payment_mode'];
$expense_total_paid              =$_POST['invoice_total_paid'];
$expense_due_amount              ='0';
$expense_terms_and_conditions    =$_POST['invoice_terms_and_conditions'];
$expense_customer_notes          =$_POST['invoice_customer_notes'];
$expense_sub_total               =$_POST['sub_total'];
$expense_grand_total             =$_POST['grand_total'];
$expense_type                    =$_POST['expense_type'];
$company_code                    =$_POST['company_code'];
$referance = "Office Expense";
$save=0;
$count=count($expense_product_name);
for($i=0; $i<$count; $i++){
 $query="insert into expense_new(expense_no,expense_date,expense_product_name,expense_quantity,expense_price,expense_total_amount,expense_item_description,expense_payment_mode,expense_total_paid,expense_due_amount,expense_terms_and_conditions,expense_customer_notes,expense_sub_total,expense_grand_total,expense_type,expense_shop_details,expense_status,company_code)values('$expense_no','$expense_date','$expense_product_name[$i]','$expense_quantity[$i]','$expense_price[$i]','$expense_total_amount[$i]','$expense_item_description','$expense_payment_mode','$expense_total_paid','$expense_due_amount','$expense_terms_and_conditions','$expense_customer_notes','$expense_sub_total','$expense_total_paid','$expense_type','$expense_shop_details','Active','$company_code')";

$run=mysql_query($query) or die(mysql_error());
    if($run)
    {
    	$save++;
}
}
$select_bank = "select bank_account_type,account_type,bank_account_name from bank_or_credit_card_info where s_no='$expense_payment_mode'";
$run = mysql_query($select_bank);
$fetch_bank = mysql_fetch_array($run);
$bank_account_name = $fetch_bank['bank_account_name'];
$bank_account_type = $fetch_bank['bank_account_type'];
$account_type = $fetch_bank['account_type'];
$expense_invoice_no=$expense_invoice_no+1;
$que2="update invoice_no set expense_no='$expense_invoice_no' where company_code='$company_code'";
mysql_query($que2);
$que_account="insert into account_info(date,customer_id,bank_s_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,invoice_no,invoice_grand_total,invoice_total_paid,invoice_due_amount,account_status,payment_mode,reference,remark,folder_name,upload_file,cheque_status,company_name,company_code)values('$expense_date','$expense_shop_details','$expense_payment_mode','$account_type','$bank_account_name','','','','','','Debit','$expense_no','$expense_total_paid','$expense_total_paid','$expense_due_amount','Active','$expense_payment_mode','$expense_type','','','','Cleared','$company_name','$company_code')";
if(mysql_query($que_account)){
	 $id = mysql_insert_id();
		$upload_file = $_FILES['upload_file']['name'];				
		if($upload_file!=''){
	$imagename = $_FILES['upload_file']['name'];
	$size = $_FILES['upload_file']['size'];
    $imgData  = $_FILES['upload_file']['tmp_name'];
    camera_code($size,$imagename,$imgData,$id,"upload_file","account_info","s_no");
	}
	if($save>0){
     echo "|?|success|?|";
    }
}

?>