<?php
include("../../attachment/session.php");
	
	$category = $_POST['category'];
	$brand_name=$_POST['brand_name'];
	$company_code=$_POST['company_code'];

	
	$quer="insert into category_add(brand_name,category,company_code)
    values('$brand_name','$category','$company_code')";
	
	$run = mysql_query($quer) or die(mysql_error());
    if($run){
	echo "|?|success|?|";
}


?>
