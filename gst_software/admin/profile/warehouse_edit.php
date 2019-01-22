<?php include("../../attachment/session.php");
	include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
	$warehouse_detail = $new->fetch_company_warehouse($_GET['id'],$company_code);
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
$("#company_edit").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"profile/company_edit_api.php",
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
				   post_content('profile/setting',res[2]);
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
			<form method="post" enctype="multipart/form-data" onsubmit="return validate();" id="company_edit">
			
			 <div class="col-md-12">
			 <div class="row">
			 <div class="col-md-4">
						<div class="form-group">
						   <label>Warehouse Name</label>
						   <input type="text"  name="warehouse_name" id="warehouse_name" placeholder="Warehouse Name" onkeyup="capital_latter(this.value)" value="<?php echo $warehouse_detail['warehouse_name']; ?>" class="form-control" required>
						   <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
						</div>
							</div>
							
			 <div class="col-md-4">
						<div class="form-group">
						  <label>Insertion Date</label>
						   <input type="date"  name="insert_date" onchange="check_data(this.value)" value="<?php echo $warehouse_detail['date2']; ?>" id="insert_date"  class="form-control" required>
						</div>
						</div>
			<div class="col-md-4">
						<div class="form-group" style="display:block">
						  <label>Mobile</label>
						   <input type="number" name="warehouse_mobile" value="<?php echo $warehouse_detail['phone']; ?>"  class="form-control">
						</div>
						</div>
						</div>
						</div>
						<br/>
						<div class="col-md-12">
						<div class="row">
						<div class="col-md-4">
						<div class="form-group" >
						  <label>Zip Code</label>
					<input type="number"  name="warehouse_zipcode" placeholder="Zipcode" value="<?php echo $warehouse_detail['zip_code']; ?>"  class="form-control" required>
						</div>
						  </div>
						   <div class="col-md-4">
						<div class="form-group">
						  <label>Warehouse Address</label>
						<textarea class="form-control" name="warehouse_address" cols="3" rows="3" style="resize:none;"  ><?php echo $warehouse_detail['address']; ?></textarea>
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

