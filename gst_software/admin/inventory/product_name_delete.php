<?php include("../../attachment/session.php");
$delete_record=$_GET['id'];
$query="delete from product_name_add where product_name_id='$delete_record' and company_code='$company_code'";
if(mysql_query($query)){
	echo "<script>window.open('product_name_add.php','_self')</script>";
}
?>