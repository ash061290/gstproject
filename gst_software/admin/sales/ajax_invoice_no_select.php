<?php include("../../attachment/session.php");
      $sales_type = $_POST['sales_type'];
	   $select = "select sales_estimate_no from invoice_no where company_code='$company_code'";
	   $run = mysql_query($select);
	   $fetch = mysql_fetch_array($run);
	  echo $estimate_no = $fetch['sales_estimate_no'];
?>