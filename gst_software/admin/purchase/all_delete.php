<?php
include("../../connection/connect.php");
 if(isset($_GET['receive_payment_delete'])) 
 {
 $m=0;
 $invoice_id = $_GET['receive_payment_delete'];
 $select = "select * from purchase_invoice_info where invoice_no='$invoice_id' and company_code='$company_code'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
	$query="update purchase_invoice_draft_info set invoice_status='Deleted' where invoice_no='$invoice_id' and company_code='$company_code'"; }
else{
$query="update purchase_invoice_info set invoice_status='Deleted' where invoice_no='$invoice_id' and company_code='$company_code'"; }
if(mysql_query($query)){
	$query1="update account_info set account_status='Deleted' where invoice_no='$invoice_id' and company_code='$company_code'";
	mysql_query($query1);
	echo $m = $m+1; }
else{ echo $m; } }
 //advance_payment_page_advance_pay_add
 if(isset($_GET['advance_payment_delete'])){
 $m=0;
 $delete_id = $_GET['advance_payment_delete'];
 $update_table = "update sales_invoice_info set invoice_status='Deactivate' where invoice_no='$delete_id' and company_code='$company_code'";
 if(mysql_query($update_table)) { echo $m = $m+1; }
 else { echo $m; }
 }
 //end
 ?>