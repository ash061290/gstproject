<?php
include("../../attachment/session.php");
$delete_record=$_GET['id'];
$query="delete from subcategory_add where s_no='$delete_record' and company_code='$company_code'";
if(mysql_query($query)){
	echo "|?|success|?|";
}
?>