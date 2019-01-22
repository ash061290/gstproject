<?php include("../../attachment/session.php");
	
	$product_name = $_POST['product_name'];
	$category = $_POST['category'];
	$brand_name = $_POST['brand_name'];
    $company_code=$_POST['company_code'];
	$insert_date = date('Y-m-d');
     $quer="insert into subcategory_add(insert_date,subcategory_name,category,brand_name,company_code)
    values('$insert_date','$product_name','$category','$brand_name','$company_code')";
	
    if(mysql_query($quer)){
	echo "|?|success|?|";
}

?>