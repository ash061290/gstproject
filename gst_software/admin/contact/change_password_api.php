<?php
include("../../attachment/session.php");

	$pass1=mysql_real_escape_string($_POST['confirm_password']);
	$pass2=mysql_real_escape_string($_POST['new_password']);
	$old=mysql_real_escape_string($_POST['old_password']);	
	
	$query="select * from invoice_no";
    $run=mysql_query($query) or die(mysql_error());
    while($row=mysql_fetch_array($run)){
	$admin_password=$row['admin_password'];
	}
	
	$encrypt_pass1=md5($pass1);
	$encrypt_pass2=md5($pass2);
	$encrypt_pass3=md5($old);
		
	if($encrypt_pass1==$encrypt_pass2 && $admin_password==$encrypt_pass3){	
	$login_query="update invoice_no set admin_password='$encrypt_pass1'";	
	$run2=mysql_query($login_query) or die(mysql_error());
	echo "<script>alert('Password Change SuccessFully....')</script>";
	session_start();
    session_destroy();
	echo "<script>window.open('../../../index.php','_self')</script>";
    }
    else{
	echo "<script>alert('Password did not Match')</script>";
	}



?>
