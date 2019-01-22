<?php  include("../../attachment/session.php"); 
include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
    ?>
    <section class="content-header">
      <h1>
        New Contact
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
		 <li><a href="javascript:post_content('profile/setting','firm_id=<?php echo $id; ?>')"><i class="fa fa-user"></i>User List</a></li>
        <li class="active">New Contact</li>
      </ol>
    </section>	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
<script>
 function copy_address(){
    if ($("#same_as_billing_address").is(":checked")) {
    var attention=document.getElementById("contact_attention").value;
	var address=document.getElementById("contact_address").value;
	var city=document.getElementById("contact_city").value;
	var state=document.getElementById("contact_state").value;
	var zipcode=document.getElementById("contact_zipcode").value;
	var country=document.getElementById("contact_country").value;
	var fax=document.getElementById("contact_fax").value;
	var phone=document.getElementById("contact_phone").value;
	
	document.getElementById("contact_shipping_attention").value=attention;
	document.getElementById("contact_shipping_address").value=address;
	document.getElementById("contact_shipping_city").value=city;
	document.getElementById("contact_shipping_state").value=state;
	document.getElementById("contact_shipping_zipcode").value=zipcode;
	document.getElementById("contact_shipping_country").value=country;
	document.getElementById("contact_shipping_fax").value=fax;
	document.getElementById("contact_shipping_phone").value=phone;
	}else{	
	document.getElementById("contact_shipping_attention").value='';
	document.getElementById("contact_shipping_address").value='';
	document.getElementById("contact_shipping_city").value='';
	document.getElementById("contact_shipping_state").value='';
	document.getElementById("contact_shipping_zipcode").value='';
	document.getElementById("contact_shipping_country").value='';
	document.getElementById("contact_shipping_fax").value='';
	document.getElementById("contact_shipping_phone").value='';
	
	}	  
 }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
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
	function capital_latter(string){
	       var first_name =  string.charAt(0).toUpperCase() + string.slice(1);
		   document.getElementById("first_name").value = first_name;
	}
	function capital_letter2(string){
	      var last_name =  string.charAt(0).toUpperCase() + string.slice(1);
		   document.getElementById("last_name").value = last_name;
	}
	function capital_company(string){
	      var company_name =  string.charAt(0).toUpperCase() + string.slice(1);
		   document.getElementById("company_name").value = company_name;
	}
	function display_name_company(string){
		 var display_name =  string.charAt(0).toUpperCase() + string.slice(1);
		   document.getElementById("display_name").value = display_name;
	}
	function pass_valid(mobile)
{
  var phoneno = /^\d{10}$/;
  if(mobile.length==10)
  {
      return true;
  }
   else
  {
     alert("Not a valid Mobile Number");
	 document.getElementById("mobile").value = "";
     return false;
	  
  }
   if(mobile.length<10)
  {
       alert("Not a valid Mobile Num must 10 digit");
	    document.getElementById("mobile").value = "";
     return false;
	 
  }
  }
  //adhar valid start
  function adhar_valid(string){
	  var adhar = /^\d{12}$/;
  if(string.length==12)
  {
      return true;
  }
   else
  {
     alert("Not a valid Adhar Number");
	 document.getElementById("adhar_no").value="";
     return false;
  }
   if(mobile.length<12)
  {
       alert("Not a valid Mobile Num must 12 digit");
	    document.getElementById("adhar_no").value="";
     return false;
	 
  } }
  function master_admin(value)
  {
	  if(value=="Admin"){
	      document.getElementById("user").checked = true;
		  document.getElementById("sales").checked = true;
		  document.getElementById("purchase").checked = true;
		  document.getElementById("inventory").checked = true;
		  document.getElementById("stock").checked = true;
		  document.getElementById("reminder").checked = true;
		  document.getElementById("expense").checked = true;
		  document.getElementById("packages").checked = true;
		  document.getElementById("banking").checked = true;
	  }
	   if(value=="Employee"){
	      document.getElementById("user").checked = false;
		  document.getElementById("sales").checked = false;
		  document.getElementById("purchase").checked = false;
		  document.getElementById("inventory").checked = false;
		  document.getElementById("stock").checked = false;
		  document.getElementById("reminder").checked = false;
		  document.getElementById("expense").checked = false;
		  document.getElementById("packages").checked = false;
		  document.getElementById("banking").checked = false;
	  }  
  }
  function check_email(value){
	if(value){
		  $.ajax({
			  type:"POST",
			  url: software_link+"profile/ajax_user_status.php",
			  data:"email="+value,
			  success:function(detail){
			    if(detail==1){
				 alert('Email Duplicancy Not Allow');
				 document.getElementById("email").value="";
				}
			  }
		  });
	}
  }
</script>
 <?php 
      $id = $_GET['user_id'];
	  $firm_id = $_GET['firm_id'];
      $user_row = $new->user_edit($id);
 ?>			
    <div class="box-body">
		<form method='post' onsubmit="return validate();" enctype="multipart/form-data">
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-6 form-horizontal">
				   <div class="form-group">
                   </div>
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Primary User Name</label>
                    <div class="col-sm-2">
                          <select class="form-control" name="contact_tittle_name" style="width:auto;">
						  <option value="Mr.">Mr.</option>
						  <option value="Mrs.">Mrs.</option>
						  <option value="Ms.">Ms.</option>
						  <option value="Miss.">Miss.</option>
						  <option value="Dr.">Dr.</option>					  
						  </select>
                    </div>
					<?php
                        $user_name = $user_row['user_name'];
					    $user_name = explode(" ",$user_name);
      					?>
					<div class="col-sm-3">
                    <input type="text" name="contact_first_name" placeholder="First Name" class="form-control" id="first_name" onkeyup="capital_latter(this.value)" value="<?php echo $user_name[0]; ?>" required >
                    </div>
					<div class="col-sm-3">
                    <input type="text" name="contact_last_name" value="<?php echo $user_name[1]; ?>" placeholder="Last Name" class="form-control" id="last_name" onkeyup="capital_letter2(this.value)" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Oragnization Name</label>
                    <div class="col-sm-8">
                       <select name="company_name" class="form-control select2" style="width:100%">
					   <?php $row2 = $new->active_company_detail($id);
                                 foreach($row2 as $row){ ?>
					      <option value="<?php echo $row['id']; ?>" selected ><?php echo $row['firm_name']; ?></option>
								 <?php } ?>
					   </select>
                    </div>
                    </div>
					</div>
                    <div class="form-group">
					<div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">User Role</label>
                    <div class="col-sm-8">
                       <select name="user_role" class="form-control select2" style="width:100%">
					      <option value="admin">Admin</option>
						  <option value="staff">Company Backend Staff</option>
						  <option value="staff assigned">Company Fronted Staff</option>
						   <option value="timesheet staff">Timesheet Staff</option>
					   </select>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">User Email</label>
                    <div class="col-sm-8">
                       <input type="email" name="user_email" value="<?php echo $user_row['user_email']; ?>" id="email" placeholder="User Email Name" class="form-control" id="display_name" onblur="check_email(this.value)" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">User Mobile </label>
                    <div class="col-sm-8">
                       <input type="number" name="user_mobile" value="<?php echo $user_row['user_mobile']; ?>" placeholder="User Mobile" class="form-control" id="mobile" onchange="pass_valid(this.value)" maxlength="10" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">User Password</label>
                    <div class="col-sm-8">
                       <input type="password" name="user_password" value="" placeholder="User Password" class="form-control" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Adhar Number</label>
                    <div class="col-sm-8">
                       <input type="number" name="user_adhar" id="adhar_no" value="<?php echo $user_row['user_adhar']; ?>" placeholder="Adhar Number" class="form-control" onchange="adhar_valid(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "12" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Description</label>
                    <div class="col-sm-8">
                      <textarea cols="4" rows="6" style="resize:none;" class="form-control" name="description"><?php echo $user_row['description']; ?></textarea>
                    </div>
                    </div>
                    </div>
				</div>
				<div class="col-sm-12">	
			<br/><center><input type="submit" name="submit" value="submit" class="btn btn-primary my_background_color"></center><br/>
		    </div>	
				
		</form>	
	</div>
          </div>
    </div>
</section>
</div>
<?php
if(isset($_POST['submit'])){
	$date = date('Y-m-d');
	$contact_tittle_name = $_POST['contact_tittle_name'];
	$contact_first_name = $_POST['contact_first_name'];
	$contact_last_name = $_POST['contact_last_name'];
	$user_name = $contact_first_name." ".$contact_last_name;
	$company_name = $_POST['company_name'];
	$user_role = $_POST['user_role'];
	$description = $_POST['description'];
	$user_email = $_POST['user_email'];
	$user_mobile = $_POST['user_mobile'];
	$user_password = $_POST['user_password'];
	$user_adhar = $_POST['user_adhar'];
	$user_password = md5($user_password);
	$array = array("date"=>$date,"company_id"=>$company_name,"user_role"=>$user_role,"user_name"=>$user_name,"user_mobile"=>$user_mobile,"user_adhar"=>$user_adhar,"user_email"=>$user_email,"user_password"=>$user_password,"description"=>$description,"status"=>"Active");
	$insert = $new->user_update($array,$id);
	if($insert){
echo "<script> post_content('profile/setting','firm_id=$company_name');</script>";
	}
 } ?>	
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>				
