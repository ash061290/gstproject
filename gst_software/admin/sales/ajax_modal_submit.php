<?php include("../../attachment/session.php");
    if(isset($_POST['sales_man']) && isset($_POST['sales_excutive']) && isset($_POST['transport_name']))
		{
	    $sales_man = $_POST['sales_man'];
	    $sales_excutive = $_POST['sales_excutive'];
	    $transport = $_POST['transport_name'];
	    $insert_custom = "insert into custom_detail(sales_person_name,sales_excutive_name,transport_name) values('$sales_man','$sales_excutive','$transport')";
	     if(mysql_query($insert_custom))
		 {
		 echo "1";
		 }
	  
		}

?>