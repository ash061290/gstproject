<?php include("../../attachment/session.php");
$delete_record=$_POST['id'];
$query="delete from product_detail where product_detail_id='$delete_record'";
if(mysql_query($query)){
	echo "|?|success|?|";
}
?>