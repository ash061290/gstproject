<?php
include("../../attachment/session.php");
	$company_code = mysql_real_escape_string($_POST['company_code']);
	$brand = mysql_real_escape_string($_POST['brand_name']);
	$category_name=$_POST['category_name'];
	$subcategory_name=$_POST['subcategory_name'];
	$company_date = date('d-m-Y');
	$modal_no=$_POST['model_no'];

	$quer="insert into product_model_no(company_code,date,brand_name,category,subcategory,	model_name) values('$company_code','$company_date','$brand','$category_name','$subcategory_name','$modal_no')";
    $run=mysql_query($quer) or die(mysql_error());
    
    if($run)
    {
	echo "|?|success|?|";
    }

?>