<?php
include("../../connection/connect.php");
$delete_record=$_GET['id'];

$query="update item_master set item_status='Deleted' where s_no='$delete_record' and company_code='$company_code'";

if(mysql_query($query)){
echo "<script>window.open('item_list.php','_self')</script>";
}
?>