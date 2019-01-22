<?php include("../../attachment/session.php");
	  include("../../attachment/classes/firm_detail.php");
	  $new = new firm_detail();
    ?>
	<?php $id = $_GET['firm_id']; ?>
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
	 
  }
	        
  }
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
  function permission_view(value)
  {
	   if(value == 'Admin'){
	      document.getElementById("permission_div").style.display="none";
	   }else{
		   document.getElementById("permission_div").style.display="block";
	   }
  }
</script>
<script type="text/javascript">
$("#form_user").submit(function(e){ 
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"profile/new_user_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
				alert(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Complete');
				   post_content('profile/new_user','firm_id='+res[2]);
            }
			}
         });
      });
	  function check_duplicat(value){
	       var first_mobile = $("#mobile").val();
		  if(first_mobile == value){
		      alert('Same Mobile Number Not Allowed');
			  $("#mobile2").val('');
		  }
	   }
	  function check_mobile(value){
		   $.ajax({
			  method:"POST",
			  url: software_link+"profile/check_mobile.php",
			  data:"mobile1="+value+"",
			  success:function(detail){
				   if(detail==1){
				      alert('Mobile no already exist...');
					  $("#mobile").val('');
					  return false;
				   }
				   else{ return true; }
			  }
		   })
	   }
	    function check_useremail(value){
		   $.ajax({
			  method:"POST",
			  url: software_link+"profile/check_email.php",
			  data:"email="+value+"",
			  success:function(detail){
				   if(detail==1){
				      alert('Email already exist...');
					  $("#email").val('');
					  return false;
				   }
				   else{ return true; }
			  }
		   })
		}
</script>
    <div class="box-body">
		<form method='post' name="form_user" id="form_user" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="firm_id" value="<?php //echo $id; ?>" />
			<div class="row">
				<div class="col-md-12">
				     <div class="col-md-6">
					<div class="form-group">
                    <label class="col-md-3 control-label" style="text-align:left;">Company Name</label>
                    <div class="col-md-9">
                       <select name="company_name" class="form-control select2" style="width:100%">
					   <?php $company_row = $new->company_detail();
                             foreach($company_row as $row){	  ?>
					      <option value="<?php echo $row['id']; ?>"><?php echo $row['firm_name']; ?></option>
							 <?php } ?>
					   </select>
                    </div>
                    </div>
					</div>
				    <div class="col-md-6">
					 <div class="form-group">
                    <label class="col-md-3 control-label" style="text-align:left;">User Name &nbsp;<i style="color:red">&#9733;</i></label>
                    <div class="col-md-1">
                          <select class="form-control" name="contact_tittle_name" style="width:auto;">
						  <option value="Mr.">Mr.</option>
						  <option value="Mrs.">Mrs.</option>
						  <option value="Ms.">Ms.</option>
						  <option value="Miss.">Miss.</option>
						  <option value="Dr.">Dr.</option>					  
						  </select>
                    </div>
					<div class="col-md-4">
                    <input type="text" name="contact_first_name" value="" placeholder="First Name" class="form-control" id="first_name" onkeyup="capital_latter(this.value)" required >
                    </div>
					<div class="col-md-4">
                    <input type="text" name="contact_last_name" value="" placeholder="Last Name" class="form-control" id="last_name" onkeyup="capital_letter2(this.value)" required>
                    </div>
                    </div>
					</div>
				  
                    </div>
					
					<div class="col-md-12">
					<div class="col-md-4">
					      <label class="control-label">Father Name </label>
                       <input type="text" id="user_father_name" name="user_father_name" value="" placeholder="User Ftaher's Name" class="form-control">
                    </div>
					<div class="col-md-4">
					      <label class="control-label">Date Of Birth </label>
                       <input type="date" id="date_of_birth" name="user_date_of_birth" class="form-control">
                    </div>
				    <div class="col-md-4">
                    <label class="control-label">User Email &nbsp;<i style="color:red">&#9733;</i></label>
                       <input type="email" name="user_email" value="" id="email" placeholder="User Email" class="form-control" oninput="check_useremail(this.value)" required>
                    </div>
                    </div>
		       <div class="col-md-12">
				  <div class="col-md-4">
                    <label class="control-label">User Primary Mobile &nbsp;<i style="color:red">&#9733;</i></label>
                       <input type="number" name="user_mobile" value="" placeholder="User Mobile First" class="form-control" id="mobile" onchange="check_mobile(this.value)" maxlength="10" required />
                    </div> 
					<div class="col-md-4">
                    <label class="control-label">User Secoundry Mobile</label>
                       <input type="number" name="user_mobile2" value="" placeholder="User Mobile Secound" class="form-control" id="mobile2" oninput="check_duplicat(this.value)" maxlength="10" />
                    </div> 
				    <div class="col-md-4">
                    <label class="control-label">Adhar Number</label>
                       <input type="number" name="user_adhar" id="adhar_no" value="" placeholder="Adhar Number" class="form-control" onchange="adhar_valid(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "12">
                    </div>
                    </div>
					 <div class="col-md-12">
					 <div class="col-md-4">
                    <label class="control-label">User Role &nbsp;<i style="color:red">&#9733;</i></label>				
                       <select name="user_role" class="form-control select2" style="width:100%" onchange="permission_view(this.value)" required>
					   <option value="">--Select--</option>
					      <option value="Admin">Admin</option>
						  <option value="Employee">Employee</option>
					   </select>
                    </div>
				         <div class="col-md-4">
					      <label class="control-label">User Salary/month</label>
                       <input type="number" name="user_salary" value="" placeholder="User Salary" class="form-control">
                    </div>
					<div class="col-md-4">
                    <label class="control-label">User Address</label>
                      <textarea cols="4" rows="3" style="resize:none;" class="form-control" name="user_address"></textarea>
                    </div>
                      </div>
					  <div class="col-md-12">
					        <div class="col-md-4">
					         <label class="control-label">Password &nbsp;<i style="color:red">&#9733;</i></label>
                              <input type="text" name="user_password" value="" placeholder="User Password" class="form-control" required>
                        </div>
					<div class="form-group  col-md-3">
				    	 <label class="control-label" style="text-align:left;">User Image</label>
					     <input type="file" name="upload_file" id="upload_file" placeholder="" onchange="check_file_type(this,'upload_file','upload_image','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					  </div>
				    <div class="col-md-1">	
				      <img id="upload_image" src=<?php echo $image_path."Profile.png"; ?> width='60px' height='60px'>
					</div>
					  </div>
				        </div>
				   <hr/>
				<div class="col-sm-12" id="permission_div">  
					<div class="form-group">
                    <h4><label class="col-sm-2">User Permission:</label><label class="col-sm-8 control-label"> <hr/>
					 <input type="checkbox" name="permission[]" value="Banking"><label>&nbsp;Banking</label>&nbsp;&nbsp;&nbsp;
					  <input type="checkbox" name="permission[]" value="Inventory"><label>&nbsp;Inventory</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  <input type="checkbox" name="permission[]" value="Sales"><label>&nbsp;Sales</label>&nbsp;&nbsp;&nbsp;
					    <input type="checkbox" name="permission[]" value="Purchase"><label>&nbsp;Purchase</label>&nbsp;&nbsp;&nbsp;
						 <input type="checkbox" name="permission[]" value="Expenses"><label>&nbsp;Expenses</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="permission[]" value="Report"><label>&nbsp;Report</label><br/><br/>
						<input type="checkbox" name="permission[]" value="Contact"><label>&nbsp;Contact</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="permission[]" value="Recycle"><label>&nbsp;RecycleBin</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="permission[]" value="Items_Tracking"><label>&nbsp;Items Tracking</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="permission[]" value="Change_Password"><label>&nbsp;Change Pssword</label>&nbsp;&nbsp;&nbsp;	</label><label class="col-sm-2"></label></h4>
                    </div>
					</div>
				<div class="col-sm-12">	
			<br/><center><input type="submit" name="submit" value="submit" class="btn btn-primary my_background_color"></center><br/>
		    </div>		
		</form>	
		</div>
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
