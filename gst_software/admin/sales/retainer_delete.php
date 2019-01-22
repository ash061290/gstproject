<?php
include("../../connection/connect.php");
include("../../attachment/session.php");
$invoice_no=$_GET['invoice_no'];
$table_name='sales_retainer_invoice';
$page_name = "retainer_invoice.php";
$query="update $table_name set invoice_status='Deleted' where invoice_no='$invoice_no' and company_code='$company_code'";
if(mysql_query($query)){
	echo "<script>window.open('$page_name','_self')</script>";
}
?>