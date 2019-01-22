<?php  include("../../attachment/session.php");
 include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
    $email = $_POST['email'];
    $array  = array("email"=>$email);
   echo $result = $new->check_user_email($array);
 ?>