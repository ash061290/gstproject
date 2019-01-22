<?php include("../../attachment/session.php");?>

    <section class="content-header">
      <h1>
        Admin Profile
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin Profile</li>
      </ol>
    </section>
	
	<?php
	$que="select * from invoice_no";
	$run=mysql_query($que);
	while($row=mysql_fetch_array($run)){
	$admin_name = $row['admin_name'];
	$admin_password = $row['admin_password'];
	$admin_contact = $row['admin_contact'];
	$image = $row['image'];
	$admin_place_of_supply = $row['admin_place_of_supply'];

	$path="../../documents/admin/".$image;
    }
    ?>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
	<div class="box-body">
			<form method="post" enctype="multipart/form-data" action="">
			 <div class="col-md-4 ">
			 </div>
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Username</label>
						   <input type="text"  name="admin_name" placeholder="Username" value="<?php echo $admin_name; ?>" class="form-control">
						</div>
						
						<div class="form-group">
						   <label>Designation</label>
						   <input type="text"  name="designation" placeholder="Designation"  value="Admin" class="form-control" readonly>
						</div>
							
						<div class="form-group" style="display:none">
						  <label>Password</label>
						   <input type="text" name="admin_password" placeholder="Password"  value="<?php echo $admin_password; ?>" class="form-control">
						</div>
						<div class="form-group" >
						  <label>Contact</label>
						  <input type="text"  name="admin_contact" placeholder="Contact"  value="<?php echo $admin_contact; ?>" class="form-control">
						</div>
						
						<div class="form-group" >
						  <label>Place Of Supply</label>
						    <select class="form-control select2" name="admin_place_of_supply" style="width:100%">
							<option value="<?php echo $admin_place_of_supply; ?>"><?php echo $admin_place_of_supply; ?></option>
							<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
							<option value="Andhra Pradesh">Andhra Pradesh</option>
							<option value="Assam">Assam</option>
							<option value="Bihar">Bihar</option>
							<option value="Chandigarh">Chandigarh</option>
							<option value="Chattisgarh">Chattisgarh</option>
							<option value="Dadra Nagar Haveli">Dadra Nagar Haveli</option>
							<option value="Daman and Diu">Daman and Diu</option>
							<option value="Delhi">Delhi</option>
							<option value="Goa">Goa</option>
							<option value="Gujrat">Gujrat</option>
							<option value="Haryana">Haryana</option>
							<option value="Himachal Pradesh">Himachal Pradesh</option>
							<option value="Jammu & Kashmir">Jammu & Kashmir</option>
							<option value="Karnataka">Karnataka</option>
							<option value="Kerala">Kerala</option>
							<option value="Lakshadweep">Lakshadweep</option>
							<option value="Madhya Pradesh">Madhya Pradesh</option>
							<option value="Maharashtra">Maharashtra</option>
							<option value="Manipur">Manipur</option>
							<option value="Meghalaya">Meghalaya</option>
							<option value="Mizoram">Mizoram</option>
							<option value="Nagaland">Nagaland</option>
							<option value="Orissa">Orissa</option>
							<option value="Outside India">Outside India</option>
							<option value="Pondicherry">Pondicherry</option>
							<option value="Punjab">Punjab</option>
							<option value="Rajasthan">Rajasthan</option>
							<option value="Sikkim">Sikkim</option>
							<option value="Tamil Nadu">Tamil Nadu</option>
							<option value="Telangana">Telangana</option>
							<option value="Tripura">Tripura</option>
							<option value="Uttar Pradesh">Uttar Pradesh</option>
							<option value="Uttarakhand">Uttarakhand</option>
							<option value="West Bengal">West Bengal</option>
							</select>
						</div>
				
						<div class="form-group">
						  <label>Profile Photo</label>
					      <input type="file"  id="upload_file" name="image"  value="" onchange="check_file_type(this,'upload_file','show_application','all');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc">
					    </div>
						
						<div class="form-group">	
					       <div class="form-group" ><br/>
					       <img src="<?php echo $path; ?>" id="show_application" height="50" width="50" >
					       </div>
				        </div>
				  </div>
				<div class="col-md-4 ">
		        </div>
		    <div class="col-md-12">
		        <center><input type="submit" name="submit" value="Update" class="btn  my_background_color" /></center>
		    </div>
		</form>			
	</div>
      
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
  </div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>

<?php
if(isset($_POST['submit'])){
	$admin_name = $_POST['admin_name'];
	$admin_place_of_supply = $_POST['admin_place_of_supply'];
	$admin_contact = $_POST['admin_contact'];
    $path1="../../documents/admin/";	
	$image_name=$_FILES['image']['name'];            
	$image_temp=$_FILES['image']['tmp_name'];	
	if($image_name==null){
	$image_name=$image;
	}
	else{
	move_uploaded_file($image_temp,$path1.'/'.$image_name);
	}	
	$quer="update invoice_no set admin_name='$admin_name',admin_contact='$admin_contact',image='$image_name',admin_place_of_supply='$admin_place_of_supply'";
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Update');</script>";
	echo "<script>window.open('../../index.php','_self');</script>";
    }
    }

?>
