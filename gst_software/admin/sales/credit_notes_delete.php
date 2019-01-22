<?php
include("../../connection/connect.php");
include("../../attachment/session.php");
$invoice_no=$_GET['invoice_no'];
$invoice_type=$_GET['invoice_type'];
if($invoice_type=='sales'){
$table_name='sales_delivery_challan_info';
$table2 = 'sales_invoice_info';
$page_name='credit_note.php';
}elseif($invoice_type=='purchase'){
$table_name='purchase_delivery_challan_info';
$page_name='credit_note.php';
}
$qry1 = "update $table2 set invoice_status='Deleted' where challan_no='$invoice_no' and company_code='$company_code'";
$query="update $table_name set invoice_status='Deleted' where invoice_no='$invoice_no' and company_code='$company_code'";
if(mysql_query($query) && mysql_query($qry1)){
	echo "<script>window.open('$page_name','_self')</script>";
}
?>