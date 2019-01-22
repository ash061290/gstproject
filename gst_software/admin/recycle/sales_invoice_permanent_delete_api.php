<?php
include("../../attachment/session.php");
$delete_record=$_POST['id'];
echo $query="delete from sales_invoice_new where s_no='$delete_record'";
if(mysql_query($query)){
	echo "|?|success|?|";
}
?>