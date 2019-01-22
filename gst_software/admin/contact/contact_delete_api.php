<?php
 include("../../attachment/session.php");
$delete_record=$_POST['id'];
$query="update contact_master set contact_status='Deleted' where s_no='$delete_record'";
if(mysql_query($query)){

echo "|?|success|?|";

}

?>