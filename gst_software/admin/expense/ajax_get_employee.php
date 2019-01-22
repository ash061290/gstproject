<?php include("../../attachment/session.php");
    if(isset($_POST['emp_id'])){
	$emp_id = $_POST['emp_id'];
    $emp_data = "select * from user_detail where user_id='$emp_id' and company_code='$company_code'";
	$run = mysql_query($emp_data);
	$fetch = mysql_fetch_array($run);
	echo $fetch['upload_file']."|?|".$fetch['date']."|?|".$fetch['user_role']."|?|".$fetch['user_name']."|?|".$fetch['user_mobile']."|?|".$fetch['user_email']."|?|".$fetch['user_salary']."|?|".$fetch['user_address'];
	} 
?>