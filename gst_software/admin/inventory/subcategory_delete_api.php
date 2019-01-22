<?php
include("../../attachment/session.php");
$delete_record=$_POST['id'];
$query="delete from subcategory_add where s_no='$delete_record'";
if(mysql_query($query)){
	echo "|?|success|?|";
}
?>