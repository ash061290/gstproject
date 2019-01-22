 <?php include("../../attachment/session.php");
	
	$product_attribute_name = $_POST['product_attribute_name'];
	$company_code = $_POST['company_code'];
	
	
	$quer = "insert into product_attribute_add(product_attribute_name,company_code) values('$product_attribute_name','$company_code')";
	
    if(mysql_query($quer)){
	echo "|?|success|?|";
}

?>	