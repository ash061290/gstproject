<?php  include("../../attachment/session.php");

    $s_no  =  $_POST['s_no'];	
	$product_attribute_name = $_POST['product_attribute_name'];
	
	
	$quer = "update product_attribute_add set product_attribute_name='$product_attribute_name' where s_no='$s_no'";
	
    if(mysql_query($quer)){
	echo "|?|success|?|";
}
?>