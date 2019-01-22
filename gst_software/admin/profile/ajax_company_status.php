<?php  include("../../attachment/session.php");
	  include("../../attachment/classes/firm_detail.php");
	  $new = new firm_detail();
	  if(isset($_POST['firm_id']))
	  {
	  $firm_id = $_POST['firm_id'];
      $row = $new->company_satatus_update($firm_id);
      print_r($row);
	  }
	  if(isset($_POST['sess_id'])){
	   $firm_id = $_POST['sess_id'];
	   $active_row = $new->company_session_update($firm_id);
	   $active_row = $new->fetch_company($firm_id);
	  $company_name = $active_row['firm_name'];
	  $company_id = $active_row['id'];
	  $_SESSION['firm_name']=$company_name;
	  $_SESSION['firm_id'] = $company_id;
	   if($_SESSION['firm_name'])
	   {
		    echo "1";
	   }
	  }
	  if(isset($_POST['user_name']))
	  {
		   $user_name = $_POST['user_name'];
		   $rowcount = $new->user_company($user_name);
		    $m=0;
		   if($rowcount>0){
		      echo $m=1;
		   }
		   else{
		       echo $m;
		   }
	  }
	  	  if(isset($_POST['user_email']))
	  {
		   $user_email = $_POST['user_email'];
		   $rowcount = $new->email_company($user_email);
		    $m=0;
		   if($rowcount>0){
		      echo $m=1;
		   }
		   else{
		       echo $m;
		   }
	  }
	  if(isset($_POST['delete_id']))
	  {
		  $del_id = $_POST['delete_id'];
		  $sql = "update admin_firm_detail set firm_status='Deleted' where id='".$del_id."' and firm_session='0'";
		  $run = mysql_query($sql);
		  $m=0;
		  if($run)
		  {
			  echo $m=1;
		  }
		  else{ echo $m; }
	  }
	  //user
	  if(isset($_POST['user_id']))
	  {
		  $user_id = $_POST['user_id'];
		  $sql = "select * from user_detail where user_id='".$user_id."'";
		  $run = mysql_query($sql);
		  $fetchrow = mysql_fetch_array($run);
		  if($fetchrow['status']=='Active'){ 
		  $sql1 = "update user_detail set status='Deactive' where user_id='".$user_id."'";
		  $run = mysql_query($sql1);
		   }
		   if($fetchrow['status']=='Deactive'){  
		  $sql1 = "update user_detail set status='Active' where user_id='".$user_id."'";
		  $run = mysql_query($sql1);      }
		  $m=0;
		  if($run)
		  {
			  echo $m=1;
		  }
		  else{ echo $m; }
	  }
	    if(isset($_POST['user_delete']))
	  {
		  $user_id = $_POST['user_delete'];
		  $sql1 = "update user_detail set status='Deleted' where user_id='".$user_id."'";
		  $run = mysql_query($sql1);
		  $m=0;
		  if($run)
		  {
			  echo $m=1;
		  }
		  else{ echo $m; }
	  }
	?>