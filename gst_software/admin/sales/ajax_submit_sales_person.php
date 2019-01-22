<?php  include("../../attachment/session.php");
	      $sales_person_name = $_GET['sales_person_name'];
		 echo $insert = "insert into new_custom(sales_person_name,sales_excutive_name) value('$sales_person_name','')";
		  $run = mysql_query($insert);

?>