<?php 
include("../../connection/connect.php");
$company_code = $_POST['company_code'];
$invoice_id = $_POST['invoice_id'];
if(isset($invoice_id) && isset($company_code))
{
	 $select = "select purchase_invoice_info.invoice_firm_name,purchase_invoice_info.invoice_product_name,purchase_invoice_info.transaction_type,purchase_invoice_info.invoice_grand_total,purchase_invoice_info.invoice_due_amount,purchase_invoice_info.invoice_date from purchase_invoice_info join account_info on purchase_invoice_info.invoice_no=account_info.invoice_no where purchase_invoice_info.invoice_no='$invoice_id' and account_info.invoice_no='$invoice_id'";
	$run = mysql_query($select);
	$row = mysql_fetch_array($run);
	$invoice_firm_name = $row['invoice_firm_name'];
	$product_name = $row['invoice_product_name'];
	$select_p = "select * from item_master where s_no='$product_name'";
	$run_p = mysql_query($select_p);
	$fetch_p = mysql_fetch_array($run_p);
	$product_name = $fetch_p['item_product_name']; 
	$select = "select * from contact_master where s_no='$invoice_firm_name'";
	$run = mysql_query($select);
	$select_r = mysql_fetch_array($run);
	$invoice_firm_name = $select_r['contact_company_name'];
	$tanasction_type = $row['transaction_type'];
	if($tanasction_type == "Debit")
	{
	echo $product_name."|?|".$invoice_firm_name."|?|".$row['invoice_grand_total']."|?|".$row['invoice_due_amount']."|?|".$row['invoice_date'];
	}
}