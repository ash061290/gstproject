 <?php include("../../attachment/session.php");

	$s_no = $_POST['s_no'];
	$brand_name = $_POST['brand_name'];
	$company_code = $_POST['company_code'];
	

	$quer = "update brand_add set brand_name='$brand_name' where s_no='$s_no'";

    if(mysql_query($quer)){
	echo "|?|success|?|";
}

?>	