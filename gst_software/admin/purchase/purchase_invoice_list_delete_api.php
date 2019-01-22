<?php
include("../../attachment/session.php");
$delete_record=$_POST['id'];
$query="update purchase_invoice_new set invoice_status='Deleted' where s_no='$delete_record'";
$run = mysql_query($query) or die(mysql_error());
if($run){
	echo "|?|success|?|";
}
?>