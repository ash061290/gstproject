<?php
include("../../connection/connect.php");
$invoice_no=$_GET['invoice_id'];
$qry1 = "select * from sales_invoice_info where invoice_no='$invoice_no' and company_code='$company_code'";
$select = mysql_query($qry1);
$numrow = mysql_num_rows($select);
if($numrow<1){
	$query="update purchase_invoice_draft_info set invoice_status='Deleted' where invoice_no='$invoice_no' and company_code='$company_code'";
}
else{
$query="update purchase_invoice_info set invoice_status='Deleted' where invoice_no='$invoice_no' and company_code='$company_code'";
}
if(mysql_query($query)){
	$query1="update account_info set account_status='Deleted' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($query1);
	echo "<script>window.open('purchase_invoice_list.php','_self')</script>";
}
?>