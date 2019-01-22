<?php include("../../attachment/session.php");
      $transport_name = $_POST['transport_name'];
      $transport_from = $_POST['transport_from'];
      $transport_to = $_POST['transport_to'];
	  $tracking_no = $_POST['tracking_no'];
      $vehicle_type = $_POST['vehicle_type'];
      $vehicle_no = $_POST['vehicle_no'];
      $transport_charge = $_POST['transport_charge'];
      $extra_charge = $_POST['extra_charge'];
      $remark = $_POST['remark'];
	  $date=date("Y-m-d");
	  $insert  = "insert into transport_detail_new(date,transport_name,from_location,to_location,vehicle_type,vehicle_no,tracking_no,transport_charge,extra_charge,status,remark,company_code) values('$date','$transport_name','$transport_from','$transport_to','$vehicle_type','$vehicle_no','$tracking_no','$transport_charge','$extra_charge','Active','$remark','$company_code')";
	  $run = mysql_query($insert);
	  if($run){
	      echo "|?|success|?|";
	   }
	  ?>