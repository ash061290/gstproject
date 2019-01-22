<?php include("../../attachment/session.php");
include("../../attachment/classes/firm_detail.php");
$new = new firm_detail();
  $date2 = date('Y-m-d');     

                    $warehouse_name_array = array("warehouse_name"=>$_POST['warehouse_name'],"date2"=>$date2,"warehouse_state"=>$_POST['warehouse_state'],"city_name"=>$_POST['city_name'],"zip_code"=>$_POST['zip_code'],"phone"=>$_POST['phone_num'],"address"=>$_POST['address'],"status"=>"Active","company_code"=>$company_code);
				$warehouse_insert = $new->warehouse_insert($warehouse_name_array);
					if($warehouse_insert)
					{
					echo "|?|success|?|";
					}
					else{ echo "|?|invalid|?|"; }
  	
?>  