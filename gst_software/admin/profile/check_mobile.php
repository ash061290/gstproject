<?php  include("../../attachment/session.php");
 include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
    $mobile1 = $_POST['mobile1'];
    $array  = array("mobile1"=>$mobile1);
   echo $result = $new->check_user_mobile($array);
 ?>