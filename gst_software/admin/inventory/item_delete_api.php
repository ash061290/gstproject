<?php
include("../../attachment/session.php");
echo $delete_record=$_POST['id'];

$query="update item set item_status='Deleted' where s_no='$delete_record'";

if(mysql_query($query))
{
	echo "|?|success|?|";
}
?>