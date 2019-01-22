<?php 
    include("../../attachment/session.php"); 
   if(isset($_POST['new_title']))
   {
	   $title = $_POST['new_title'];
	   $select_report = "SELECT * FROM add_report WHERE title='$title' and company_code='$company_code'";
	   $run = mysql_query($select_report);
	   $fetchr = mysql_fetch_array($run);
	   $report_title = $fetchr['title'];
	   $r_id = $fetchr['report_id'];
	   echo  "<option value='".$r_id."' selected>".$report_title."</option>";
   }
	   ?>
		