<?php
include("../../connection/connect.php");
$invoice_no=$_GET['invoice_no'];
$table_name='purchase_retainer_invoice';
$page_name = "purchase_retainer_invoice.php";
$query="update $table_name set invoice_status='Deleted' where invoice_no='$invoice_no'";
if(mysql_query($query)){
	echo "<script>window.open('$page_name','_self')</script>";
}
?>