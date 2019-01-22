
<?php
include("../../connection/connect.php");
$delete_record=$_GET['id'];
$query="delete from uom_add where uom_id='$delete_record' and company_code='$company_code'";
if(mysql_query($query)){
	//echo "<script>window.open('uom_add.php','_self')</script>";
}
?>