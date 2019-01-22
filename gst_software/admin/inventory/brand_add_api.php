<?php include("../../attachment/session.php");	
	$brand_name = $_POST['brand_name'];
	$company_code = $_POST['company_code'];
    $sql_b ="SELECT * FROM brand_add WHERE brand_name= '$brand_name' ";
    $res_b = mysql_query($sql_b);
    if(mysql_num_rows($res_b) > 0)
    {
	   echo 'Brand Name Already Exist';
    } 
   else
   {
	   	$quer="insert into brand_add(brand_name,company_code)
	    values('$brand_name','$company_code')";
		
	    if(mysql_query($quer))
	    {
		    echo "|?|success|?|";
	    }

   }
?>