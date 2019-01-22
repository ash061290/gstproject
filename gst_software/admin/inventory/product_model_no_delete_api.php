<?php
include("../../attachment/session.php");
$delete_record=$_POST['id'];
$query="delete from product_model_no where product_model_no_id='$delete_record'";
if(mysql_query($query)){
	echo "|?|success|?|";
}
?>