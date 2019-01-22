 <?php include("../../attachment/session.php");

	$s_no = $_POST['s_no'];
	$brand_name = $_POST['brand_name'];
	$category = $_POST['category_name'];
    $subcatgory =$_POST['subcategory_name'];
    $company_code = $_POST['company_code'];
	

	 $quer = "update subcategory_add set brand_name='$brand_name',category='$category',subcategory_name='$subcatgory' where s_no='$s_no'";

    if(mysql_query($quer)){
	echo "|?|success|?|";
}


?>	