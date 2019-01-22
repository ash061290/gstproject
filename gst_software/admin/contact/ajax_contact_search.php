<?php
include("../../attachment/session.php");
$contact_type=$_GET['contact_type'];
$business_type=$_GET['business_type'];
echo "<script>post_content('contact/contact_list','contact_type=$contact_type&business_type=$business_type','_self')</script>";
?>	
	