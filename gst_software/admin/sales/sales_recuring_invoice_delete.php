<?php
 include("../../attachment/session.php");
$invoice_id=$_GET['invoice_id'];
$select = "select * from sales_invoice_info where invoice_no='$invoice_id'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
	$query="update sales_invoice_draft_info set invoice_status='Deleted' where invoice_no='$invoice_id'";
}
else{
$query="update sales_invoice_info set invoice_status='Deleted' where invoice_no='$invoice_id'";
}
if(mysql_query($query)){
	$query1="update account_info set account_status='Deleted' where invoice_no='$invoice_id'";
	mysql_query($query1);
	echo "<script>window.open('recuring_invoice.php','_self')</script>";
}
?>