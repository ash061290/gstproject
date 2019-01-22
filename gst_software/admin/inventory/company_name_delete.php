
<?php
include("../../connection/connect.php");
$delete_record=$_GET['id'];
 $query2="update category_add set status='Deleted' where group_id='$delete_record' and company_code='$company_code'";
 if(mysql_query($query2)){
 $query="update company_add set status='Deleted' where company_name_id='$delete_record' and company_code='$company_code'";
if(mysql_query($query)){
echo "<script>window.open('category_add.php','_self')</script>";
}
 }
?>