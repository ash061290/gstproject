<?php include("../../attachment/session.php");
$delete_record=$_GET['id'];
$query="update bank_or_credit_card_info set bank_status='Deleted' where s_no='$delete_record'";
if(mysql_query($query)){

echo "<script>window.open('banking.php','_self')</script>";

}

?>