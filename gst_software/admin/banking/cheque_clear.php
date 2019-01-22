<?php
include("../../attachment/session.php");
$clear_cheque=$_GET['id'];
$cheque=$_GET['cheque'];
$query="update account_info set cheque_status='$cheque' where s_no='$clear_cheque'";
if(mysql_query($query)){

if($cheque=='Uncleared'){
echo "<script>window.open('cheque_dd_details.php','_self')</script>";
}
if($cheque=='Cleared'){
echo "<script>window.open('clear_cheque_details.php','_self')</script>";
}
if($cheque=='Bounced'){
echo "<script>window.open('bounce_cheque_details.php','_self')</script>";
}
}
?>