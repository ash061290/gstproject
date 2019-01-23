<?php  session_start();
if(!isset($_SESSION['firm_id'])){
  echo $_SESSION['firm_id'];
 //echo "<script>window.open('index.php','_self')</script>";
}
if(isset($_SESSION['firm_id']))
{
	if(isset($_SESSION['user_role']))
	{
 $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
 $array = explode("/",$actual_link);
 end($array);
 $folder = prev($array);
  if(in_array($folder,$array)){
	  if(!isset($_SESSION[$folder])){
	  echo "<script>window.open('main.php','_self')</script>"; }
  }
	}
 $company_name = $_SESSION['firm_name'];
 $company_code = $_SESSION['firm_id'];
 $image_path = "../gst_software/images/";
}
/*
$con371="../../../con73/con37.php";
$con372="../../con73/con37.php";
$con373="../con73/con37.php";
if(file_exists($con371)){
	include($con371);
}else if(file_exists($con372)){
	include($con372);
}else if(file_exists($con373)){
	include($con373);
}else{
	echo "no database";
}
*/
?>
