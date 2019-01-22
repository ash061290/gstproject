<?php   
 include("../../attachment/session.php");
if(isset($_POST['status_draft_value']))
			$msg=0;
   {
      $estimate_no=$_POST['status_draft_value'];
	  $select = "select * from sales_estimate_draft_info where invoice_no = '$estimate_no' and company_code='$company_code'";
	  $run = mysql_query($select);
	  $fetchrow = mysql_fetch_array($run);
	  $s_no = $fetchrow['s_no'];
	  $estimate_status2 = $fetchrow['estimate_status2'];
	  if($estimate_status2 == 'Approved')
	  {
       $update = "update sales_estimate_draft_info set estimate_status2='Accepted',estimate_status='Accepted' where invoice_no='$estimate_no' and company_code='$company_code'";
	  }
	  if($estimate_status2 == "Accepted")
	  {
		$update = "update sales_estimate_draft_info set estimate_status2='Sent',estimate_status='Accepted' where invoice_no='$estimate_no' and company_code='$company_code'"; 
	  }
	  if(mysql_query($update))
	  {
		    $msg = $msg+1;
			echo $data = $msg.'|'.$s_no;
	  }
	  
   }	   ?>