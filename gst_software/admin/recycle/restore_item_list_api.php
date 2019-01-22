<?php
include("../../attachment/session.php");
$restore_record=$_POST['id'];
$query="update item set invoice_status='Active' where s_no='$restore_record' and company_code='$company_code'";
if(mysql_query($query)){
	echo "|?|success|?|";
}
?>