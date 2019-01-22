<?php include("../../attachment/session.php");
	include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
    ?>
    <section class="content-header">
      <h1>
        Admin Profile Detail
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascripr:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin Profile</li>
      </ol>
    </section>
	<script>
	    function check_data(value)
		{
			if(value==""){
			   alert('Field Required..');
			 } 
			 $.ajax({
				     type:"POST",
					 url: software_link+"profile/ajax_company_status.php",
					 data:"user_name="+value,
					 success:function(detail){
					      if(detail==1)
						  {
							  alert('Username Already Exist..');
							  document.getElementById('user_name').value='';
						  }
					 }
			 });
			 
		}
		 function validate(){
	var gst=document.getElementById('contact_gstin').value;
	var gst = gst.toUpperCase();
	var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
	if(gst==''){
	var val=confirm('Do You Want To Continue Without GST number !!!');
	if(val==true){
	return true;
	}else{
	return false;
	}
	}else{
    if(gst!=''){
    if (gstinformat.test(gst)) {
     return true;
    } else {
        alert('Please Enter Valid GSTIN Number or Left Blank');
        $("#contact_gstin").focus();
		return false;
    }
	}
	}
	}
		 function check_email(value)
		{
			if(value==""){
			   alert('Field Required..');
			 } 
			 $.ajax({
				     type:"POST",
					 url: software_link+"profile/ajax_company_status.php",
					 data:"user_email="+value,
					 success:function(detail){
					      if(detail==1)
						  {
							  alert('Email Already Exist..');
							  document.getElementById('email_name').value='';
						  }
					 }
			 });
			 
		}
		function capital_latter(string){
	       var first_name =  string.charAt(0).toUpperCase() + string.slice(1);
		   document.getElementById("firm_name").value = first_name;
	}
	</script>
	<script>
$("#form_profile").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"profile/new_profile_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Complete');
				   post_content('profile/new_profile',res[2]);
            }
			}
         });
      });
	
</script>
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	  <div class="col-xs-12">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
	<div class="box-body">
			<form method="post" enctype="multipart/form-data" id="form_profile" onsubmit="return validate();" action="">
			
			 <div class="col-md-12">
			 <div class="row">
			 <div class="col-md-4">
						<div class="form-group">
						   <label>Firm Name</label>
						   <input type="text"  name="firm_name" id="firm_name" placeholder="Firm Name" onkeyup="capital_latter(this.value)" class="form-control" required>
						</div>
							</div>
			 <div class="col-md-4">
						<div class="form-group">
						  <label>Admin Name</label>
						   <input type="text"  name="admin_name" placeholder="Username" onchange="check_data(this.value)" id="user_name"  class="form-control" required>
						</div>
						</div>
			<div class="col-md-4">
						<div class="form-group" style="display:block">
						  <label>Firm Creation Date</label>
						   <input type="date" name="creation_date" value="<?php echo date('Y-m-d'); ?>"  class="form-control">
						</div>
						</div>
						</div>
						</div>
						<br/>
						<div class="col-md-12">
						<div class="row">
						<div class="col-md-4">
						<div class="form-group" >
						  <label>Mobile No</label>
						  <input type="number"  name="admin_contact" placeholder="Contact"  class="form-control" required>
						</div>
						  </div>
						  <div class="col-md-4">
						<div class="form-group">
						  <label>Gst No.</label>
					      <input type="text" id="contact_gstin" name="admin_gst" placeholder="Gst No"  value=""  class="form-control" maxlength="15" >
					    </div>
						  </div>
						   <div class="col-md-4">
						<div class="form-group">
						  <label>Gst Treatment Type</label>
						 <select class="form-control select2" name="admin_gst_treatment" style="width:100%" required>
						<option value="Registered-Business-Regular">Registered-Business-Regular</option>
						<option value="Registered-Business-Composition">Registered-Business-Composition</option>
						<option value="Unregistered-Business">Unregistered-Business</option>
						<option value="Customer">Customer</option>
						<option value="Overseas">Overseas</option>
						<option value="Special-Economic-Zone">Special-Economic-Zone</option>	
					    </select>
					    </div>
						  </div>
						  </div>
						  </div>
						  <br/>
						  <div class="col-md-12">
						  <div class="row">
						   <div class="col-md-4">
						<div class="form-group">
						  <label>Email Address</label>
						  <input type="email" id="admin_email" name="admin_email" placeholder="Firm Email"  class="form-control" onchange="check_email(this.value)" id="email_name" required>
					    </div>
						  </div>
						  <div class="col-md-4">
						<div class="form-group">
						  <label>Inventory Start Date</label>
						  <input type="date" id="inventory_date" name="inventory_date"  class="form-control" >
					    </div>
						  </div>
						  <div class="col-md-4">
						<div class="form-group">
						  <label>Financial Year</label>
						 <select class="form-control select2" name="financial_year" style="width:100%">
						 <option value="jan-dec">Jan-Dec</option>
						 <option value="feb-jan">Feb-Jan</option>
						 <option value="Apr-March" selected>Apr-March</option>
						 </select>
					    </div>
						  </div>
				  </div>
				  </div><br/>
				  <div class="col-md-12">
				  <div class="row">
						 <div class="col-md-4">
						<div class="form-group">
						  <label>Password</label>
						  <input type="password" id="password" name="admin_pass"  value=""  class="form-control" required >
					    </div>
						  </div>
						  <div class="col-md-4">
						<div class="form-group">
						  <label>Confirm Password</label>
						  <input type="password" id="cpassword" name="admin_cpass"  value=""  class="form-control" required >
					    </div>
						  </div>
						   <div class="col-md-4">
						<div class="form-group">
						  <label>Web Address</label>
						  <input type="url" id="web_url" name="web_address"  value="" placeholder="Web Url"  class="form-control" >
					    </div>
						  </div>
				  </div></div><br/>
				  <div class="col-md-12">
				  <div class="row">
				      <div class="col-md-3">
						<div class="form-group">
						  <label>Profile Photo</label>
					      <input type="file"  id="upload_file" name="image"  value="" onchange="check_file_type(this,'upload_file','show_bill_upload','image');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc" required>
					    </div>
						<div class="form-group">	
					       <div class="form-group" ><br/>
					       </div>
				        </div>
						  </div>
						  <div class="col-md-1">	
				      <img id="show_bill_upload" src=<?php echo $image_path."Profile.png"; ?> width='60px' height='60px'>
					</div>
						<div class="col-md-4">
						<div class="form-group">
						  <label>Firm Type</label>
						 <select class="form-control select2" style="width:100%" name="firm_type">
						 <option value="agriBusiness">AgriBusiness</option>
						  <option value="purchase/sales">Purchase/Sales Service</option>
						 <option value="market research">Market Research</option>
						 <option value="food service">Food Service</option>
						 </select>
					    </div>
						  </div>
						   <div class="col-md-4">
						<div class="form-group">
						  <label>Firm Address</label>
						<textarea class="form-control" name="firm_address" cols="3" rows="3" style="resize:none;"  ></textarea>
					    </div>
						  </div>
				   </div>
				   </div>
		    <div class="col-md-12">
		        <center><input type="submit" name="submit" value="Submit" class="btn  my_background_color" /></center>
		    </div>
		</form>			
	</div>
          </div>
    </div>
	 </div>
</div>
</section>
 
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

