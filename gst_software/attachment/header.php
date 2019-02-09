<?php
if(!$_SESSION['user_role']){
echo "<script>window.location('main.php')</script>";
}
?>
<?php
	include("classes/firm_detail.php");
	$new = new firm_detail();
    ?>
<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Logout!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
}
function status_change(value){
       $.ajax({
			  type: "POST",
              url: software_link+"profile/ajax_company_status.php",
			  data: "sess_id="+value,
              cache: false,
              success: function(detail){
           if(detail==1){
						  window.location ="main.php";
						  }
              }
           });
 }
</script>

<header class="main-header">
    <!-- Logo -->
    <a href="javascript:get_content('index')" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Admin</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
            <?php
			 $firm_id = $_SESSION['firm_id'];
			/*if(isset($_SESSION['user_role'])) {
                   $row1 = $new->fetch_company($firm_id);  } */
				    if($_SESSION['user_role'] =='Admin' || $_SESSION['user_role']=='Employee'){
					      ?>
	 <li class="dropdown user user-menu">
		  <?php $row3 = $new->fetch_company($firm_id);	?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img id="show_company_logo" src='<?php if($row3['firm_logo']!=''){ echo 'data:image;base64,'.$row3['firm_logo']; }else{ echo $image_path."Profile.png"; }  ?>' width='15px' height='15px'>
              <span class="hidden-xs">&nbsp;<?php echo $row3['firm_name']; ?></span>
            </a>
				 <?php  ?>
            <ul class="dropdown-menu">
              <!-- User image -->
			  <?php $row4 = $new->fetch_company($firm_id);;
                   	?>
              <li class="user-header">
               <img id="show_company_logo" src='<?php if($row4['firm_logo']!=''){ echo 'data:image;base64,'.$row4['firm_logo']; }else{ echo $image_path."Profile.png"; }  ?>' width='15px' height='15px'>
                <p>
                  <?php echo $row4['firm_name']; ?>&nbsp;&nbsp;<?php //echo $designation; ?>
                  <small><?php echo $row4['firm_email']; ?></small>
                </p>
				<br/>
				<br/>
				 <!--<div class="pull-left  user-footer">
                  <a href="javascript:post_content('profile/profile','firm_id=<?php //echo $row4['id']; ?>')" class="btn btn-default btn-flat" style="border:none; border-radius:10px;">My Account</a>
                </div>-->
                <div class="pull-right user-footer">
                  <a href="javascript:get_content('contact/logout')" class="btn btn-default btn-flat" onclick="return myFunction()" style="border:none; border-radius:10px;">Sign out</a>
                </div>
              </li>
			  </ul> </li>

						  <?php }else{ ?>
					  <?php
				 if($_SESSION['user_role']=='Main_Admin'){ ?>
		  <li class="dropdown user user-menu">
		  <?php $row3 = $new->fetch_company($firm_id);	?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img id="show_company_logo" src='<?php if($row3['firm_logo']!=''){ echo 'data:image;base64,'.$row3['firm_logo']; }else{ echo $image_path."Profile.png"; }  ?>' width='15px' height='15px'>
              <span class="hidden-xs">&nbsp;<?php echo $row3['firm_name']; ?></span>
            </a>
				 <?php  ?>
            <ul class="dropdown-menu">
              <!-- User image -->
			  <?php $row4 = $new->fetch_company($firm_id);;
                   	?>
              <li class="user-header">
               <img id="show_company_logo" src='<?php if($row4['firm_logo']!=''){ echo 'data:image;base64,'.$row4['firm_logo']; }else{ echo $image_path."Profile.png"; }  ?>' width='15px' height='15px'>
                <p>
                  <?php echo $row4['firm_name']; ?>&nbsp;&nbsp;<?php //echo $designation; ?>
                  <small><?php echo $row4['firm_email']; ?></small>
                </p>
				<br/>
				<br/>
				 <div class="pull-left  user-footer">
                  <a href="javascript:post_content('profile/profile','firm_id=<?php echo $row4['id']; ?>')" class="btn btn-default btn-flat" style="border:none; border-radius:10px;">My Account</a>
                </div>
                <div class="pull-right user-footer">
                  <a href="javascript:get_content('contact/logout')" class="btn btn-default btn-flat" onclick="return myFunction()" style="border:none; border-radius:10px;">Sign out</a>
                </div>
              </li>
					 <?php  ?>
			   <li style="padding:10px; font-size:16px;"><strong><span>My Organization</span><span style="float:right; font-size:18px; padding-right:10px; color:red"><a href="javascript:get_content('profile/setting')" ><i class="fa fa-gear" ></i></a></span></strong></li>
			    <?php echo $result = $new->deactive_company_detail();
					          print_r($result); exit;
                     foreach($result as $row){	?>
			  <li class="user-header" style="border-bottom:1px solid #f9f9f9;">
               <img id="show_company_logo" src='<?php if($row['firm_logo']!=''){ echo 'data:image;base64,'.$row['firm_logo']; }else{ echo $image_path."Profile.png"; }  ?>' width='15px' height='15px'>
                <p>
                  <?php echo $row['firm_name']; ?>&nbsp;&nbsp;<?php //echo $designation; ?>
                  <small><?php echo $row['firm_email']; ?></small>
                </p>
				<br/>
				<br/>
				<center>
				 <div class="pull-left user-footer">
                  <a href="javascript:post_content('profile/profile','firm_id=<?php echo $row['id']; ?>')" class="btn btn-default btn-flat" style="border:none; border-radius:10px;">My Account</a>
                </div>
				</center>
                <div class="pull-right user-footer">
                  <a class="btn btn-default btn-flat" onclick="status_change('<?php echo $row['id']; ?>')" style="border:none; border-radius:10px;">Active</a>
                </div>
              </li>
					 <?php } ?>
            </ul>
          </li>
						  <?php  } }  ?>
		  <!-- User Detail -->

		  <!-- end -->
          <!-- Control Sidebar Toggle Button -->
		  <?php if($_SESSION['user_role']=='Main_Admin'){ ?>
          <li>
            <a href="javascript:get_content('profile/warehouse_setting')"><i class="fa fa-gear" style="font-size:18px;" ></i></a>
          </li>
		  <?php } ?>
        </ul>
      </div>
    </nav>
  </header>
