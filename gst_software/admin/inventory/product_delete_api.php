<?php include("../../attachment/session.php");
$delete_record=$_POST['id'];
$query="delete from product_name_add where product_name_id='$delete_record'";
if(mysql_query($query)){
	echo "|?|success|?|";
}
?>