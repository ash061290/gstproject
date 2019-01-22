<?php
include("../../attachment/session.php");
$delete_record=$_POST['id'];
$select = "select * from sales_invoice_new where invoice_no='$invoice_no' and company_code='$company_code'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
	$query="update sales_invoice_new set invoice_status='Deleted' where s_no='$delete_record' and company_code='$company_code'";
}
else{
$query="update sales_invoice_new set invoice_status='Deleted' where s_no='$delete_record' and company_code='$company_code'";
}
if(mysql_query($query)){
	$query1="update account_info set account_status='Deleted' where s_no='$delete_record' and company_code='$company_code'";
	mysql_query($query1);
}
 echo "|?|success|?|";
?>