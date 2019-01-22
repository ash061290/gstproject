<?php
 include("../../attachment/session.php");?
$invoice_id=$_GET['invoice_id'];
$query="update sales_invoice_info set invoice_status='Deleted' where invoice_no='$invoice_id'";
if(mysql_query($query)){
	$query1="update account_info set account_status='Deleted' where invoice_no='$invoice_id'";
	mysql_query($query1);
	echo "<script>window.open('advance.php','_self')</script>";
}
?>