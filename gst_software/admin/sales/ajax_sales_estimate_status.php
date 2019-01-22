<?php  include("../../attachment/session.php"); 
	 $msg=0;
        if(isset($_GET['status_value']))  {
      $estimate_no=$_GET['status_value'];
	  $select = "select * from sales_estimate_info where invoice_no='$estimate_no' and company_code='$company_code'";
	  $run = mysql_query($select);
	  $numrow = mysql_num_rows($run);
	  $number=0;
	  if($numrow<1){
	        $select = "select * from sales_estimate_draft_info where invoice_no='$estimate_no' and company_code='$company_code'";
			$run = mysql_query($select);
			$number = 1;  }
	    $fetchrow = mysql_fetch_array($run);
	  $s_no = $fetchrow['s_no'];
	  $estimate_status2 = $fetchrow['estimate_status2'];
	    if($number==1){ $table_name = "sales_estimate_draft_info"; } 
		if($number==0){ $table_name = "sales_estimate_info"; }
	  if($estimate_status2 == 'Approved'){
       $update = "update $table_name set estimate_status2='Accepted',estimate_status='Accepted' where invoice_no='$estimate_no' and company_code='$company_code'"; 
	  }
	  if($estimate_status2 == "Accepted") {
		   $update = "update $table_name set estimate_status2='Success',estimate_status='Accepted' where invoice_no='$estimate_no' and company_code='$company_code'"; 
	  }
	 if($estimate_status2 == "Success") {
		   $msg = $msg+1;
			echo $data = $msg.'|'.$s_no;
	  }
	  else{
	  if(mysql_query($update)){
		    $msg = $msg+1;
			echo $data = $msg.'|'.$s_no; }
	       }
	  }	
   ?>