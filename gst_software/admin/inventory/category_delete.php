<?php
include("../../attachment/session.php");
$delete_record=$_GET['id'];
$query="update category_add set status='Deleted' where category_id='$delete_record' and company_code='$company_code'";
if(mysql_query($query)){
echo "<script>window.open('category_add.php','_self')</script>";
}
?>