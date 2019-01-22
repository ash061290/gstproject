<?php
include("../../connection/connect.php");
	$company_name = $_GET['company_name'];
	$product_name = $_GET['id'];
	$category = $_GET['category'];

	
	$quer="insert into company_wise_product_table(company_name,product_name,category)
    values('$company_name','$product_name','$category')";
	
    if(mysql_query($quer)){
	echo "<script>alert('Product Successfully Added');</script>";
	echo "<script>window.open('company_wise_product_add.php?company_name=$company_name','_self')</script>";
}


?>


