<?php
include("../../connection/connect.php");
$delete_record=$_GET['id'];
$query="update contact_master set contact_status='Deleted' where s_no='$delete_record'";
if(mysql_query($query)){

echo "<script>window.open('contact_list.php','_self')</script>";

}

?>