<?php
include("../../attachment/session.php");
    $s_no = $_POST['s_no'];
	$company_code = mysql_real_escape_string($_POST['company_code']);
	$brand = mysql_real_escape_string($_POST['brand_name']);
	$category_name=$_POST['category_name'];
	$subcategory_name=$_POST['subcategory_name'];
	$company_date = date('d-m-Y');
	$modal_no=$_POST['model_no'];

	$quer="update product_model_no set company_code='$company_code',date='$company_date',brand_name='$brand',category='$category_name',subcategory='$subcategory_name',model_name='$modal_no' where product_model_no_id='$s_no'";

    $run=mysql_query($quer) or die(mysql_error());
    
    if($run)
    {
	echo "|?|success|?|";
    }

?>