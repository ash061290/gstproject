<?php
 class session{
          public $session_data;
          protected function session_data(){
            return $this->session_data = $_SESSION[];
          }
 }
echo $session = new session($_SESSION[]);
/*
if(!isset($_SESSION['admin_id'])){
 echo "<script>window.open('index.php','_self')</script>";
}
if(isset($_SESSION['admin_id']))
{
	if(isset($_SESSION['user_id']))
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
*/
?>
