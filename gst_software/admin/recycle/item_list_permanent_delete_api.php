<?php
include("../../attachment/session.php");
$delete_record=$_POST['id'];
 $query="delete from item where s_no='$delete_record' and company_code='$company_code'";
if(mysql_query($query)){
	echo "|?|success|?|";
}
?>