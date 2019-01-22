<?php
   include("../../attachment/session.php");
	
	$brand_name = $_POST['brand_name'];
	$category = $_POST['category_name'];
	$company_code=$_POST['company_code'];
    $number = count($_POST['subcategory']);
    for($i=0; $i<$number; $i++)
    {
        echo $sql_query ="SELECT * FROM subcategory_add WHERE subcategory_name= '".$_POST["subcategory"][$i]."'";
	    $result = mysql_query($sql_query) or die(mysql_error());
    }
	if(mysql_num_rows($result) > 0)
	{
		echo 'Subcategory Name Already Exist';
	}
   
    else
    {
	    if($number>0)
	    {
			for($i=0; $i<$number; $i++)  
			      {  
			           if(trim($_POST["subcategory"][$i] != ''))  
			           {  
			                 $quer = "INSERT INTO subcategory_add(brand_name,category,subcategory_name,company_code) VALUES('$brand_name','$category','".$_POST["subcategory"][$i]."','$company_code')";
			                $run = mysql_query($quer) or die(mysql_error());
			                if($run)
			                {
			                	echo "|?|success|?|";
			                }
			                else
			                {
			                	echo "something went wrong";
			                }
			           }
		               else
			           {
			               echo "Please add subcategory";
			           }    
			           
			      }      	
		}
		else
		{
			echo "Please Enter subcategory";
		}
		

    }
  
?>