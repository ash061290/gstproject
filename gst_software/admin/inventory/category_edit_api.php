 <?php  include("../../attachment/session.php");
    $s_no  =  $_POST['s_no'];
    $category=$_POST['categories'];
	$brand_name= $_POST['brand_names'];
	$company_code = $_POST['company_code'];
	$quer = "update category_add set category='$category',brand_name='$brand_name' where s_no='$s_no' ORDER BY s_no DESC";
	$run=mysql_query($quer) or die(mysql_error());
    if($run)
    {
	   echo "|?|success|?|";
    }



	

	 
?>