<?php
include("../../connection/connect.php");
$invoice_id=$_GET['invoice_id'];
$select = "select * from purchase_invoice_info where invoice_no='$invoice_id' and company_code='$company_code'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
	$query="update purchase_invoice_draft_info set invoice_status='Deleted' where invoice_no='$invoice_id' and company_code='$company_code'";
}
else{
$query="update purchase_invoice_info set invoice_status='Deleted' where invoice_no='$invoice_id' and company_code='$company_code'";
}
if(mysql_query($query)){
	$query1="update account_info set account_status='Deleted' where invoice_no='$invoice_id' and company_code='$company_code'";
	mysql_query($query1);
	//echo "<script>window.open('payment_received.php','_self')</script>";
}
?>