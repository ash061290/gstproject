<?php
include("../../attachment/session.php");
$contact_type=$_GET['contact_type'];
$business_type=$_GET['business_type'];
echo "<script>window.open('due_payment.php?contact_type=$contact_type&business_type=$business_type','_self')</script>";
?>	