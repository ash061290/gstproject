
<?php
include("../../connection/connect.php");
$delete_record=$_GET['id'];
$company=$_GET['company_name'];
$query="delete from company_wise_product_table where company_wise_product_id='$delete_record'";
if(mysql_query($query)){
	echo "<script>window.open('company_wise_product_add.php?company_name=$company','_self')</script>";
}
?>