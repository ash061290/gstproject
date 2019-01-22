<?php
include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
	$path1="../../documents/admin/";
    $id = $_POST['id'];	
	$image_name=$_FILES['image']['name'];            
	$image_temp=$_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];	
	$password = md5($_POST['admin_pass']);
	$cpassword = md5($_POST['admin_cpass']);
	$data = array("firm_name"=>$_POST['firm_name'],"admin_name"=>$_POST['admin_name'],"firm_creation_date"=>$_POST['creation_date'],"firm_contact"=>$_POST['admin_contact'],"firm_gst"=>$_POST['admin_gst'],
	"firm_gst_treatment"=>$_POST['admin_gst_treatment'],"firm_email"=>$_POST['admin_email'],"firm_inventory_date"=>$_POST['inventory_date'],"firm_financial_year"=>$_POST['financial_year'],"firm_pass"=>$password,"firm_cpass"=>$cpassword,"firm_web_address"=>$_POST['web_address'],"firm_type"=>$_POST['firm_type'],"firm_address"=>$_POST['firm_address'],"firm_status"=>"Active");
	$table_name = "admin_firm_detail";
	$quer = $new->firm_update($data,$table_name,$id);
	$update_image = $new->camera_code($image_size,$image_name,$image_temp,$id,"firm_logo",$table_name,"id");
	if($update_image == true){
   
	echo "|?|success|?|";
    
	}
?>
