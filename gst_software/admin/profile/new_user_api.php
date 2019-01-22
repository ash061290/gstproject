<?php include("../../attachment/session.php");
	include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
	$id = $_POST['firm_id'];
	$date = date('Y-m-d');
	$contact_tittle_name = $_POST['contact_tittle_name'];
	$contact_first_name = $_POST['contact_first_name'];
	$contact_last_name = $_POST['contact_last_name'];
	$user_password = $_POST['user_password'];
	$user_password = md5($user_password);
	$user_name = $contact_first_name." ".$contact_last_name;
	$company_name = $_POST['company_name'];
	$user_role = $_POST['user_role'];
	if(isset($_POST['permission'])){ 
	$permission = $_POST['permission']; } 
	else{ $permission=''; }
	empty($permission)?$permission="All":$permission=json_encode($permission);
	$user_address = $_POST['user_address'];
	$user_email = $_POST['user_email'];
	$user_mobile = $_POST['user_mobile'];
	$user_mobile2 = $_POST['user_mobile2'];
	$user_date_of_birth = $_POST['user_date_of_birth'];
	$user_father_name = $_POST['user_father_name'];
	$user_salary = $_POST['user_salary'];
	$user_adhar = $_POST['user_adhar'];
	 $filename = $_FILES['upload_file']['name'];
	     if($filename !=''){
	     $tmp_name =  $_FILES['upload_file']['tmp_name'];
	     $size =  $_FILES['upload_file']['size'];
		 }
		 else{ $tmp_name =""; $size=""; }
	$array = array("date"=>$date,"company_id"=>$company_name,"user_role"=>$user_role,"user_name"=>$user_name,"date_of_birth"=>$user_date_of_birth,"user_father_name"=>$user_father_name,"user_email"=>$user_email,"profile_image"=>"","user_mobile"=>$user_mobile,"user_mobile2"=>$user_mobile2,"user_adhar"=>$user_adhar,"user_login_id"=>"","user_salary"=>$user_salary"user_password"=>$user_password,"user_permission"=>$permission,"user_address"=>$user_address,"status"=>"Active","filename"=>$filename,"tmp_name"=> $tmp_name,"size"=>$size);
   $insert = $new->user_insert($array);
	if($insert){
	 echo"|?|success|?|$id";
	}
 ?>	