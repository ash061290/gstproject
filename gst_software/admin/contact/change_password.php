<?php
include("../../attachment/session.php");
  	  ?>
    <section class="content-header">
      <h1>
        Change Password
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
	  <div class="col-xs-12">
          <div class="box">
        <div class="box-body">
	<div class="col-md-4">
	</div>
			
            <div class="col-md-4 ">
	            <br><br><br>
				  <!-- /.login-logo -->
				<div class="login-box-body">
					<p class="login-box-msg"><b>Change Your Password</b></p>

				<form  method="post">
					<div class="form-group has-feedback">
					  <input type="text" name="old_password" required placeholder="Old Password"  value="" class="form-control" >
					   <span class="glyphicon glyphicon-phone form-control-feedback"></span>
					</div>
								
					<div class="form-group has-feedback">
					   <input type="password" name="new_password" required placeholder="New Password"  value="" class="form-control" >
					   <span class="glyphicon glyphicon-phone form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
					   <input type="password" name="confirm_password" required placeholder="Re Password"  value="" class="form-control" >
					   <span class="glyphicon glyphicon-phone form-control-feedback"></span>
					</div>
				
					    <div class="row">
						<div class="col-xs-4">						 					
						</div>
					
						<div class="col-xs-4">
						  <button type="submit" name="submit"  class="btn btn-success">Submit</button>
						</div>
						<div class="col-xs-4">						 					
						</div>					
					    </div>
			    </form>
				</div>
            </div>
		<div class="col-md-4">
		</div>		
   
          </div>
    </div>
	</div>
	</div>
</section>
