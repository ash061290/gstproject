<?php  include("../../attachment/session.php");
 include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
    ?>
  <?php $id = $_GET['firm_id'];
    $row = $new->fetch_company($id); 
	?>
    <section class="content-header">
      <h1>
        Profile Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascrirpt:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('profile/new_profile')"><i class="fa fa-plus"></i>Add Bank Or Card</a></li>
        <li class="active">Bank Details</li>
      </ol>
    </section>
	
<script type="text/javascript">
   function for_contact(id,value){
   //alert(value);
            if(id=='contact_type'){
			var contact_type1=value;
            var business_type1=document.getElementById('business_type').value; 
            }else if(id=='business_type') {
            var business_type1=value;
            var contact_type1=document.getElementById('contact_type').value;	
            }			
 
       $.ajax({
			  type: "POST",
              url: "ajax_contact_search.php?contact_type="+contact_type1+"&business_type="+business_type1+"",
              cache: false,
              success: function(detail){
			      //alert(detail);  
            $('#search_table').html(detail);
              }
           });
	}
</script>

<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}
</script>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
                <div class="col-sm-12">		
				<div class="col-sm-9">
			    </div>
				<div class="col-sm-3">
			  <a href="javascript:get_content('profile/new_user')"><button style="float:right;" type="button" class="btn btn-success">+ Add New User</button></a>				
			</div>			
			</div>			
            <!-- /.box-header -->
            <div class="box-body">
			
               <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <strong style="font-size:15px;">Profile Information</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" style="font-size:15px;">Profile Info</a>
                                </li>
                                <li><a href="#security" data-toggle="tab" style="font-size:15px;">Security</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab" style="font-size:15px;">Sessions</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <h4>Profile Details</h4>
               <form role="form">
                  <div class="box-body">
				   <div class="col-md-12">
				   <div class="col-md-3">
                <div class="form-group">
                  <label>Creation Date Time &nbsp; : &nbsp;  </label><?php echo $row['firm_creation_date']; ?><br/><br/>
				  <label>Mobile No &nbsp; : &nbsp </label><?php echo $row['firm_contact']; ?><br/><br/>
				  <label>Email Address &nbsp; : &nbsp;</label><?php echo $row['firm_email']; ?><br/><br/>
				  <label>Web Address &nbsp; : &nbsp;</label><?php echo $row['web_address']; ?>
                </div>
				 </div>
				 <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputPassword1"> Company Logo :</label><br/><br/>
                  <img id="show_company_logo" src='<?php if($row['firm_logo']!=''){ echo 'data:image;base64,'.$row['firm_logo']; }else{ echo $image_path."Profile.png"; }  ?>' width='60px' height='60px'></label>
                </div>
				</div>
				<div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputFile">Oragnization Name : </label> &nbsp; <?php echo $row['firm_name']; ?>
				  <br/ >
				  <br/>
				  <strong>Address : </strong> &nbsp;<?php echo $row['firm_address']; ?> 
                </div>
				</div>
				<div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputFile">Industry Type : &nbsp;</label><?php echo $row['firm_type']; ?>
                   <br/>
				   <br/>
				   <label>GST Treatment Type : &nbsp; </label><?php echo $row['firm_gst_type']; ?><br/>
				  <br/>
				  <label>GST No &nbsp : &nbsp <?php echo $row['firm_gst']; ?></label>
                </div>
				</div>
				 </div>
              </div>
              <!-- /.box-body -->
</form>
		</div>
		<!-- security -->
		<div class="tab-pane fade" id="security">
			<h4>Profile Security</h4>
	   <?php $firm_pass = $row['firm_pass'];	   ?>  
	  <div class="box-body">
	   <div class="col-md-12">
	   <form role="form" method="post">
	   <div class="col-md-4" style="border-right:1px solid">
		<h4>Change Password</h4>
	<div class="form-group">
	  <label>Current Password &nbsp; : &nbsp;  
	  <input type="password" name="password" value="<?php echo $firm_pass; ?>" class="form-control" style="border:none;" disabled  >
	   </label><br/><br/>
	 <label id="new_pass">New Password&nbsp; : &nbsp </label>
	 <input type="password" name="new_pass" class="form-control" id="new_pass" /><br/><br/>
	 <label id="new_pass_reenter">Re-enter Password &nbsp; : &nbsp;</label>
	 <input type="password" name="c_pass" class="form-control"  id="new_pass_reenter" /><br/><br/><br/>
	 <center><input type="submit" name="submit_pass" value="Submit" class="btn btn-success" /></center>
	</div>
	 </div>
	 </form>
				 <?php if(isset($_POST['submit_pass'])){
					       $pass = md5($_POST['new_pass']);
						   $cpass = md5($_POST['c_pass']);
				           $update_result = $new->update_firm_pass($pass,$cpass,$id); 
                           if($update_result == true){
						      echo"<script>alert('Password Updated Success..')</script>";
							  echo "<script>window.open('profile.php?firm_id=$id','_self');</script>";
						   }							   
				 }	?>
				 <form role="form" method="post">
				 <div class="col-md-4" style="border-right:1px solid">
				 <h4>Two Factor Authentication</h4>
                <div class="form-group">
                  <label for="exampleInputPassword1"> Mobile No &nbsp; : &nbsp;</label><input type="number" name="mobile" class="form-control" placeholder="Confirm Mobile" value="<?php echo $row['firm_contact']; ?>" maxlength="10" /><br/><br/>
                  <label>Select Verification Type :</label><br/><br/>
				  <input type="radio" name="auth" value="voice call"> &nbsp; Voice Sms<br/><br/>
				  <input type="radio" name="auth" value="otp" checked>&nbsp;OTP 
                </div>
				
				<br/>
				<br/>
				<br/>
				<br/>
				<center><input type="submit" name="submit_mobile" class="btn btn-success" /></center>
				</div>
				</form>
				<form method="post">
				<div class="col-md-4" >
				<h4>Security Question</h4>
                <div class="form-group">
                  <label for="exampleInputFile">Select Security Question :</label>
                  <center><select name="question" class="form-control">
				       <option value="question1">1</option>
					   <option value="question2">2</option>
					   <option value="question3">3</option>
				  </select></center>
				  <br/> <strong>Enter Answer : </strong> <br/>
				       <textarea class="form-control" cols="4" rows="6" name="enter_answer"></textarea>
                </div>
				<br/>
				<br/>
				<center><input type="submit" name="submit_answer" class="btn btn-success" /></center>
				</div>
				</form>
				 </div>
              </div>
              <!-- /.box-body session -->
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4>Session Activity</h4>
                                   <div class="box-body">
				   <div class="col-md-12">
				   <form role="form" method="post">
				   <div class="col-md-4">
				    <h4>Active Session</h4>
                <div class="form-group">
                  <label>Session Status&nbsp; : &nbsp;  
				   </label>Active<br/><br/>
				   <label>Session Active Date Time&nbsp; : &nbsp;  
				   </label>19-09-19<br/><br/>
                </div>
				 </div>
				 </form>
				 
				<form method="post">
				<div class="col-md-4" >
				<h4>Login History</h4>
                <div class="form-group">
				  <label> Login Ip address :</label> <br/><br/>
				  <label> Login Date Time :</label>
                </div>
				<br/>
				<br/>
				</div>
				</form>
				<form method="post">
				<div class="col-md-4" >
				<h4>Activity History</h4>
                <div class="form-group">
				  <label> Session Time Count :</label> <br/><br/>
				  <label> Other Activity :</label>
                </div>
				<br/>
				<br/>
				</div>
				</form>
				 </div>
              </div>
                                </div>
                               <!-- <div class="tab-pane fade" id="settings">
                                    <h4>Settings Tab</h4>
                                    <p>ashish4</p>
                                </div> -->
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		</div>
        <!-- /.col -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
<script>
  $(function () {
    $('#example1').DataTable()
  
  })
</script>
</body>
</html>
