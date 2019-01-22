<?php
include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
	$path1="../../documents/admin/";	
	$image_name=$_FILES['image']['name'];            
	$image_temp=$_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];	
	$password = md5($_POST['admin_pass']);
	$cpassword = md5($_POST['admin_cpass']);
	$data = array("firm_name"=>$_POST['firm_name'],"admin_name"=>$_POST['admin_name'],"firm_creation_date"=>$_POST['creation_date'],"firm_contact"=>$_POST['admin_contact'],"firm_gst"=>$_POST['admin_gst'],
	"firm_gst_treatment"=>$_POST['admin_gst_treatment'],"firm_email"=>$_POST['admin_email'],"firm_inventory_date"=>$_POST['inventory_date'],"firm_financial_year"=>$_POST['financial_year'],"firm_pass"=>$password,"firm_cpass"=>$cpassword,"firm_web_address"=>$_POST['web_address'],"firm_type"=>$_POST['firm_type'],"firm_address"=>$_POST['firm_address'],"firm_status"=>"Active");
	$table_name = "admin_firm_detail";
	$quer = $new->firm_insert($data,$table_name);
	$update_image = $new->camera_code($image_size,$image_name,$image_temp,$quer,"firm_logo",$table_name,"id");
	if($update_image == true){
    $invoice_no_data = array("firm_name"=>$_POST['firm_name'],"firm_contact"=>$_POST['admin_contact'],"firm_email"=>$_POST['admin_email'],"firm_pass"=>$password,"firm_address"=>$_POST['firm_address'],"recuring_no"=>"100001","sales_invoice_no"=>"100001","purchase_estimate_no"=>"100001","sales_estimate_no"=>"100001","sales_order_no"=>"100001","delivery_challan_no"=>"100001","firm_logo"=>"","advance_invoice_no"=>"100001","purchase_invoice_no"=>"100001","purchase_order_no"=>"100001","purchase_delivery_challan_no"=>"100001","retainer_invoice_no"=>"100001","retainer_purchase_invoice_no"=>"100001","credit_no"=>"100001","package_invoice_no"=>"100001","shipping_invoice_no"=>"100001","expense_no"=>"100","company_name"=>$_POST['firm_name'],"company_code"=>$quer);
	$result = $new->insert_invoice_no($invoice_no_data);
    if($result){
	echo "|?|success|?|";
    }
	}
?>
