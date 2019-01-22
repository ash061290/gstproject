<?php
 include("../../attachment/session.php");
$delete_record=$_POST['id'];
$query="delete from contact_master where s_no='$delete_record' and company_code ='$company_code'";
$run=mysql_query($query) or die(mysql_error());
	if($run){
echo "|?|success|?|";

}

?>