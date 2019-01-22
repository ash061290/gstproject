<html>
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Samsung Smart Plaza</title>
		<meta name="keywords" content=""/>
	   <meta name="description" content=""/>
    <link rel="shortcut icon" type="image/icon" href="images/favicon.png"/>
	<meta property="article:publisher" content="https://www.facebook.com/simplegst/" />
	<meta name="msvalidate.01" content="C676B6D610F3665D3D6AFE5BFA86FAC5" />
<meta name="twitter:site" content="@simplegst" />
<META NAME="ROBOTS" CONTENT="ALL">
<meta name="author" content="simple gst tech pvt ltd">
<meta name="designer" content="http://www.simple.com">
<meta name="robots" content="default, follow, all">
<meta name="rating" content="General">
<meta name="classification" content="Simption School Management Software"/>
<meta name="Language" content="us-en"/>
<meta name="Audience" content="All"/>
<meta name="distribution" content="Global"/>
<meta name="googlebot" content="index, follow"/>
<meta name="Revisit-After" content="1 days"/>
<meta name="google-site-verification" content="googleffc254dfcdc26a00" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta name="category" content="Simption School Management Software is a best software For School Management. Simption School Software Contains various panel like Student management, Hostel management Software,Fees Management,Staff Management,Examination Management ,Attendance Management ,Account Management,Enquiry Management,Reminder Management ,Homework Management,Time Table Management,Complaint Management,SMS Service,Gallery,Stock Management,Certificate Management,Govt. Requirements,Leave Management ,Holiday Management ,Paper Setter,Sports Management ,Event Management ,Downloads,Bus Management ,Session Management,Library Management ,Hostel Management,Backup Management,Offline Facility,Teacher Panel,Account Panel,Library Panel,Bus Panel,Hostel Panel,Management Panel,Student/Parent Android
Application,Teacher Android Application,Bus Driver Android Application." />
 <link rel="canonical" href="http://simptiontechpvtltd.blogspot.in/2017/07/new-latest-gst-software-updated-for.html"/>
<meta property="og:url"           content="http://www.school.simption.com" />
	<meta property="og:type"      content="website" />
	<meta property="og:title"     content="Simption School Management Software" />
	<meta property="og:description"   content="Simption School Management Software is a best software For School Management. Simption School Software Contains various panel like Student management, Hostel management Software,Fees Management,Staff Management,Examination Management ,Attendance Management ,Account Management,Enquiry Management,Reminder Management ,Homework Management,Time Table Management,Complaint Management,SMS Service,Gallery,Stock Management,Certificate Management,Govt. Requirements,Leave Management ,Holiday Management ,Paper Setter,Sports Management ,Event Management ,Downloads,Bus Management ,Session Management,Library Management ,Hostel Management,Backup Management,Offline Facility,Teacher Panel,Account Panel,Library Panel,Bus Panel,Hostel Panel,Management Panel,Student/Parent Android
Application,Teacher Android Application,Bus Driver Android Application." />
	<meta property="og:image"  content="https://lh3.googleusercontent.com/-bJcXHC79Mdo/WGzq4GKuqiI/AAAAAAAAAfQ/IzvLYf3eib0gTEPzMP5TayWQtE8RhicCwCJoC/w426-h298/simptionbanner.jpg" />
 <link rel="stylesheet" href="../gst_software/assests/css/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../gst_software/assests/css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../gst_software/assests/css/AdminLTE.min.css">
</head>
<style>
body {
    background-image: url("../gst_software/images/background.jpg");
}
</style>
<body>
		 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	<div class="col-md-4">
	</div>
            <div class="col-md-4 ">
	            <br> <br> <br> <br> <br>
				<div class="login-logo">
					<a href="" style="color:red;"><b>Samsung Smart Plaza </b></a>
				</div>
				  <!-- /.login-logo -->
				<div class="login-box-body">
					<p class="login-box-msg">Enter Your Login Information</p>
				<form  method="post">
					    <div class="form-group has-feedback">
						   <input type="text" name="admin_name" required placeholder="Admin ID"  value="" class="form-control" >
						   <span class="glyphicon glyphicon-phone form-control-feedback"></span>
						</div>
					    <div class="form-group has-feedback">
						   <input type="password" name="password" required placeholder="Password"  value="" class="form-control" >
						   <span class="glyphicon glyphicon-phone form-control-feedback"></span>
						</div>
					    <div class="row">
						<div class="col-xs-4">
						</div>
						<div class="col-xs-4">
						  <button type="submit" name="login"  class="btn btn-primary btn-block btn-flat">Login</button>
						</div>
						<div class="col-xs-4">
						</div>
					    </div>
			    </form>
				</div>
            </div>
		<div class="col-md-4">
		</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
      <?php
      if(isset($_POST['login'])){

      //  include("../gst_software/attachemnt/classes/firm_detail.php");
        include("../gst_software/attachment/classes/firm_detail.php");
        $user_name=$_POST['admin_name'];
      	$user_pass=$_POST['password'];
      	$encrypt=md5($user_pass);
        $admin_table = "admin_firm_detail";
        $employee_table="user_detail";
        $data = array("admin_name"=>"'$user_name'"," and firm_pass"=>"'$encrypt'"," and firm_status"=>"'Active'");
        $result = $login->admin_login($admin_table,$data);
         print_r($result);
         if($result['admin_id']){
            	echo "<script>window.open('main.php','_self')</script>";
         }
        /*
       $result = $login->employee_login();
          $query="select * from admin_firm_detail where admin_name='$user_name' and firm_pass='$encrypt' and firm_status='Active'";
          $run=mysql_query($query) or die(mysql_error());
           $numrow1 = mysql_num_rows($run);
      	 $fetchrow = mysql_fetch_array($run);
          if($numrow1>0){
      		 $select = "select admin_name from admin_firm_detail where firm_session='1'";
      		 $run = mysql_query($select);
      		 while($fetchrow2 = mysql_fetch_array($run))
      		 {
      		  $update3 = "update admin_firm_detail set firm_session='0' where admin_name='".$fetchrow2['admin_name']."'";
      		  mysql_query($update3);
      		 }
      		 $update = "update admin_firm_detail set firm_session='1' where admin_name='$user_name'";
      		 mysql_query($update);
      	$_SESSION['firm_name'] = $fetchrow['firm_name'];
      	$_SESSION['firm_id'] = $fetchrow['id'];
          $_SESSION['emp_id']=$user_name;
      	$_SESSION['user_role'] = "Main_Admin";
      	$_SESSION['admin'] = "dashboard";
      	$_SESSION['sales'] = "Sales";
      	$_SESSION['purchase'] = "Purchase";
      	$_SESSION['expense'] = "Expense";
      	$_SESSION['inventory'] = "Inventory";
      	$_SESSION['banking'] = "Banking";
      	$_SESSION['items_tracking'] = "Items_Tracking";
      	$_SESSION['recycle'] = "Recycle";
      	$_SESSION['contact'] = "Contact";
      	$_SESSION['report'] = "Report";
      	//$_SESSION['outstanding'] = "Outstanding";
      	$_SESSION['change_password'] = "Change_Password";
      	$_SESSION['profile'] = "profile";
      	echo "<script>window.open('main.php','_self')</script>";
          }
           else{
      	      $qry2 = "select company_code,user_role,user_permission from user_detail where user_mobile='$user_name' and user_password='$encrypt' and status='Active'";
      		   $run2 = mysql_query($qry2) or die(mysql_error());
      		   $numrow2 = mysql_num_rows($run2);
      		   $fetchrow2 = mysql_fetch_array($run2);
      		   if($numrow2>0)
      		   {
      			   $_SESSION['emp_id'] = $user_name;
      			   $_SESSION['firm_id'] = $fetchrow2['company_code'];
      			   $_SESSION['user_role'] = $fetchrow2['user_role'];
      			   $_SESSION['admin'] = "dashboard";
      			   $permission = $fetchrow2['user_permission'];
      			   if($fetchrow2['user_role'] == 'Admin'){
      			      $_SESSION['permission'] = "All";
      				  $select_company = "select * from admin_firm_detail where id='".$fetchrow2['company_code']."'";
      			   $run3 = mysql_query($select_company) or die(mysql_error());
      			   $fetchrow3 = mysql_fetch_array($run3);
      			   $_SESSION['firm_name']  = $fetchrow3['firm_name'];
      			   $_SESSION['profile'] = "profile";
      			    echo "<script>window.open('main.php','_self')</script>";
      			   }else{
      			   if($fetchrow2['user_role'] == 'Employee'){
      				   $permission = json_decode($permission);
      				   if(in_array("Sales",$permission)){
      				     $_SESSION['sales'] = "Sales";
      				   }
      				    if(in_array("Purchase",$permission)){
      				     $_SESSION['purchase'] = "Purchase";
      				   }
      				    if(in_array("Inventory",$permission)){
      				     $_SESSION['inventory'] = "Inventory";
      				   }
      				    if(in_array("Items_Tracking",$permission)){
      				     $_SESSION['items_tracking'] = "Items_Tracking";
      				   }
      				   if(in_array("Banking",$permission)){
      				     $_SESSION['banking'] = "Banking";
      				   }
      				   if(in_array("Contact",$permission)){
      				     $_SESSION['contact'] = "Contact";
      				   }
      				    if(in_array("Expenses",$permission)){
      				     $_SESSION['expense'] = "Expenses";
      				   }
      				   if(in_array("Change_Password",$permission)){
      				     $_SESSION['change_password'] = "Change_Password";
      				   }
      				    if(in_array("Recycle",$permission)){
      				     $_SESSION['recycle'] = "Recycle";
      				   }
      				    if(in_array("Report",$permission)){
      				     $_SESSION['report'] = "Report";
      				   }

      				    $select_company = "select * from admin_firm_detail where id='".$fetchrow2['company_code']."'";
      			   $run3 = mysql_query($select_company) or die(mysql_error());
      			   $fetchrow3 = mysql_fetch_array($run3);
      			   $_SESSION['firm_name']  = $fetchrow3['firm_name'];
      			    echo "<script>window.open('main.php','_self')</script>";
      			   }
      		   }
      		   }

      	 }
         */
      	}
      ?>

          </div>
</section>
</body>
</html>
