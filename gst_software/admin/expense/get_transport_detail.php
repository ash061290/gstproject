<?php include("../../attachment/session.php");
   if(isset($_GET['transport_id'])){
   $transport_id = $_GET['transport_id'];
   $select  = "select * from transport_detail_new where s_no='$transport_id' and company_code='$company_code'";
    $run = mysql_query($select);
     $fetchrow = mysql_fetch_array($run);
     echo $fetchrow['from_location']."|?|".$fetchrow['to_location']."|?|".$fetchrow['vehicle_type']."|?|".$fetchrow['transport_charge']."|?|".$fetchrow['extra_charge']."|?|".$fetchrow['remark'];	 
	   } ?>