<?php include("../../attachment/session.php");?>
 <section class="content-header">
      <h1>
        New Contact
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">New Contact</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
	  <div class="col-xs-12">
          <div class="box">
<script>
$("#contact_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: software_link+"contact/contact_api.php",
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
           post_content('contact/contact_list',res[2]);
            }
      }
         });
      });
</script>
<script>
 function copy_address(){
    if ($("#same_as_billing_address").is(":checked")) {
    var attention=document.getElementById("contact_attention").value;
	var contact_address1=document.getElementById("contact_address1").value;
	var contact_address2=document.getElementById("contact_address2").value;
	var city=document.getElementById("contact_city").value;
	var state=document.getElementById("contact_state").value;
	var zipcode=document.getElementById("contact_zipcode").value;
	var country=document.getElementById("contact_country").value;
	var fax=document.getElementById("contact_fax").value;
	var phone=document.getElementById("contact_phone").value;
	document.getElementById("contact_shipping_attention").value=attention;
	document.getElementById("contact_shipping_address1").value=contact_address1;
	document.getElementById("contact_shipping_address2").value=contact_address2;
	document.getElementById("contact_shipping_city").value=city;
	document.getElementById("contact_shipping_state").value=state;
	document.getElementById("contact_shipping_zipcode").value=zipcode;
	document.getElementById("contact_shipping_country").value=country;
	document.getElementById("contact_shipping_fax").value=fax;
	document.getElementById("contact_shipping_phone").value=phone;
	}else{	
	document.getElementById("contact_shipping_attention").value='';
	document.getElementById("contact_shipping_address1").value='';
	document.getElementById("contact_shipping_address2").value='';
	document.getElementById("contact_shipping_city").value='';
	document.getElementById("contact_shipping_state").value='';
	document.getElementById("contact_shipping_zipcode").value='';
	document.getElementById("contact_shipping_country").value='';
	document.getElementById("contact_shipping_fax").value='';
	document.getElementById("contact_shipping_phone").value='';
	}	  
 }
</script>
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
</script>		
    <div class="box-body">
		<form method='post' id="contact_form" onsubmit="return validate();" enctype="multipart/form-data">
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-12 form-horizontal">
				   <div class="form-group">
				   
				   <div class="col-sm-6">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Type:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		
					<input type="radio" name="contact_contact_type" id="" value="Customer" checked>&nbsp;&nbsp;<b>Customer</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="contact_contact_type" id="" value="Vendor">&nbsp;&nbsp;<b>Vendor</b> 
                   </div>
                   </div>
				   </div>
				   	<div class="col-sm-6 form-horizontal">
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Primary Contact</label>
                    <div class="col-sm-2">
                          <select class="form-control" name="contact_tittle_name" style="width:auto;">
						  <option value="Mr.">Mr.</option>
						  <option value="Mrs.">Mrs.</option>
						  <option value="Ms.">Ms.</option>
						  <option value="Miss.">Miss.</option>
						  <option value="Dr.">Dr.</option>					  
						  </select>
                    </div>
					<div class="col-sm-3">
                    <input type="text" name="contact_first_name" value="" placeholder="First Name" class="form-control" style="width:120%;" required >
                    </div>
					<div class="col-sm-3">
                    <input type="text" name="contact_last_name" value="" placeholder="Last Name" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Company Name</label>
                    <div class="col-sm-8">
                       <input type="text" name="company_name" value="" placeholder="Company Name" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Display Name</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_company_name" value="" placeholder="Contact Display Name" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Email</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_email" value="" placeholder="Contact Email" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">PAN Number</label>
                    <div class="col-sm-8">
                       <input type="text" name="pan_no" value="" placeholder="Pan Card Number" class="form-control">
                    </div>
                    </div>
                    </div>
					</div>
						<div class="col-sm-6 form-horizontal">
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Adhar Number</label>
                    <div class="col-sm-8">
                       <input type="text" name="adhar_no" value="" placeholder="Adhar Number" class="form-control">
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Mobile Number</label>
                    <div class="col-sm-8">
                       <input type="number" name="contact_contact_phone" value="" placeholder="Contact Mobile Number" class="form-control" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;"> Work Mobile Number</label>
                    <div class="col-sm-8">
                       <input type="mobile" name="contact_contact_phone2" value="" placeholder="Work Mobile Number" MaxLength="10" class="form-control">
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Website</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_website" value="" placeholder="Website" class="form-control">
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Area</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_area" value="" placeholder="Contact Area" class="form-control">
                    </div>
                    </div>
                    </div>
				</div>
				 
				<div class="col-sm-12 form-horizontal" style="margin-top:30px;">
				<div class="col-sm-12 nav-tabs-custom">
                   <ul class="nav nav-tabs">
                   <li class="active"><a href="#tab_1" data-toggle="tab" style="color:#206D9C">Tax & Payment Details</a></li>
                   <li><a href="#tab_2" data-toggle="tab" style="color:#206D9C">Billing & Shipping Address </a></li>
                   <li><a href="#tab_4" data-toggle="tab" style="color:#206D9C">Contact Persons </a></li>
                   <li><a href="#tab_5" data-toggle="tab" style="color:#206D9C">Transport Details </a></li>
                   <li><a href="#tab_3" data-toggle="tab" style="color:#206D9C">Remarks</a></li>
                   </ul>
                <div class="tab-content">				
                <div class="tab-pane active" id="tab_1">
                <div class="form-group">
				
					<div class="form-group">					
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">Tax Prefereces</label>&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="contact_tax_prefrences" id="" value="Taxable" checked>&nbsp;&nbsp;<b>Taxable</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="contact_tax_prefrences" id="" value="Tax-Exempt">&nbsp;&nbsp;<b>Tax-Exempt</b> 
					</div>
					</div>
				    
				    <div class="form-group">
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">Currency</label>
					<div class="col-sm-8">
					<select name="contact_currency" class="form-control">
					<option value="INR-Indian Rupees">INR-Indian Rupees</option>
					</select>
					</div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">Payment Terms</label>
					<div class="col-sm-8">
					<select name="contact_payment_terms" class="form-control select2" style="width:100%">
					    <option value="Due on receipt">Due on receipt</option>
						<option value="Net-15">Net-15</option>
						<option value="Net-30">Net-30</option>
						<option value="Net-45">Net-45</option>
						<option value="Net-60">Net-60</option>
						<option value="Due end of the month">Due end of the month</option>
						<option value="Due end of the next month">Due end of the next month</option>
					</select>
					</div>
					</div>
					</div>
					
					<div class="form-group">	
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">GST Treatment</label>
					<div class="col-sm-8">
					    <select class="form-control select2" name="contact_gst_treatment" style="width:100%" required>
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

					<div class="form-group">	
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">GST Number </label>
					<div class="col-sm-8">
					 <input type="text"  name="contact_gstin" id="contact_gstin" placeholder="GST Number"  value="" class="form-control">
					</div>
					</div>
					</div>					
					<div class="form-group">	
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">Place of supply</label>
					<div class="col-sm-8">
					    <select class="form-control select2" name="contact_place_of_supply" required  style="width:100%">
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
						<option value="Madhya Pradesh" selected>Madhya Pradesh</option>
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
					</div>
					</div>

                </div>
                </div>
              <div class="tab-pane" id="tab_2">
                <div class="form-group">
				<div class="col-sm-12">
				<div class="col-sm-6">   
				    <h5 class="box-title" style="color:#8C0895"><b>Billing Address</b></h5>
					
						<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Address</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_address1" id="contact_address1" placeholder="Street1"  value="" class="form-control"><br/>
					<input type="text"  name="contact_address2" id="contact_address2" placeholder="Street2"  value="" class="form-control">
					</div>
					</div>
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Country </label>
					<div class="col-sm-8">
					<input type="text"  name="contact_country" id="contact_country" placeholder="Billing Country"  value="Indian" class="form-control">
					</div>
					</div>
                    
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">State</label>
					<div class="col-sm-8">
					    <select class="form-control select2" name="contact_state" id="contact_state" style="width:100%">
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
						<option value="Madhya Pradesh" selected>Madhya Pradesh</option>
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
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">City</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_city" id="contact_city" placeholder="Billing City"  value="" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Zipcode</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_zipcode" id="contact_zipcode" placeholder="Billing Zipcode"  value="" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Landmark</label>
					<div class="col-sm-8">
					 <input type="text"  name="contact_attention" id="contact_attention" placeholder="Billig Landmark"  value="" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Phone</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_phone" id="contact_phone" placeholder="Billing Phone"  value="" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Fax</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_fax" id="contact_fax" placeholder="Billing Fax"  value="" class="form-control">
					</div>
					</div>
					
                </div>
				
				<div class="col-sm-6">   
				   <h5 class="box-title" style="color:#8C0895"><b>Shipping  Address</b>&nbsp;&nbsp;&nbsp;if same </b>
		           <input type="checkbox" onclick="copy_address();" id="same_as_billing_address"></h5>
				  	<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Address</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_address1" id="contact_shipping_address1" placeholder="Shipping Steet1"  value="" class="form-control"><br/>
					<input type="text"  name="contact_shipping_address2" id="contact_shipping_address2" placeholder="Shipping Steet2"  value="" class="form-control">
					</div>
					</div>
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Country </label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_country" id="contact_shipping_country" placeholder="Shipping Country"  value="" class="form-control">
					</div>
					</div>
                    
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">State</label>
					<div class="col-sm-8">
					    <select class="form-control" name="contact_shipping_state" id="contact_shipping_state" style="width:100%">
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
						<option value="Madhya Pradesh" selected>Madhya Pradesh</option>
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
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">City</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_city" id="contact_shipping_city" placeholder="Shipping City"  value="" class="form-control">
					</div>
					</div>
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Zipcode</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_zipcode" id="contact_shipping_zipcode" placeholder="Shipping Zipcode"  value="" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Landmark</label>
					<div class="col-sm-8">
					 <input type="text"  name="contact_shipping_attention" id="contact_shipping_attention" placeholder="Billig Landmark"  value="" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Phone</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_phone" id="contact_shipping_phone" placeholder="Shipping Phone"  value="" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Fax</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_fax" id="contact_shipping_fax" placeholder="Shipping Fax"  value="" class="form-control">
					</div>
					</div>					
                </div>			
                </div>
                </div>
              </div>
			<input type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
                <div class="tab-pane" id="tab_4">
                 <div class="box-body table-responsive">
				   <table  class="table table-bordered" style="background-color:white;">
					  <thead class="my_background_color">
						 <tr>
							<th>#</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Email Address</th>
							<th>Remark</th>
						 </tr>
					  </thead>
					  <tbody>
					      <tr>
					      <td><span class="snm">1.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_1" class="form-control" placeholder="eg: Mr. First Contact Person">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_1" class="form-control" placeholder="eg: 8878444445">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_1" class="form-control" placeholder="eg: example@gmail.com">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_1" class="form-control" placeholder="Remark">
					      </td>
                          </tr>
						  <tr>
					      <td><span class="snm">2.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_2" class="form-control" placeholder="eg: Mr. Second Contact Person">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_2" class="form-control" placeholder="eg: 8878444445">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_2" class="form-control" placeholder="eg: example@gmail.com">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_2" class="form-control" placeholder="Remark">
					      </td>
                          </tr>
						  <tr>
					      <td><span class="snm">3.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_3" class="form-control" placeholder="eg: Mr. Third Contact Person">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_3" class="form-control" placeholder="eg: 8878444445">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_3" class="form-control" placeholder="eg: example@gmail.com">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_3" class="form-control" placeholder="Remark">
					      </td>
                          </tr>
						  <tr>
					      <td><span class="snm">4.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_4" class="form-control" placeholder="eg: Mr. Fourth Contact Person">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_4" class="form-control" placeholder="eg: 8878444445">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_4" class="form-control" placeholder="eg: example@gmail.com">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_4" class="form-control" placeholder="Remark">
					      </td>
                          </tr>
						  <tr>
					      <td><span class="snm">5.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_5" class="form-control" placeholder="eg: Mr. Fifth Contact Person">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_5" class="form-control" placeholder="eg: 8878444445">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_5" class="form-control" placeholder="eg: example@gmail.com">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_5" class="form-control" placeholder="Remark">
					      </td>
                          </tr>
					  </tbody>
				   </table>
                </div>
                </div>			  
                  <div class="tab-pane" id="tab_5">
     <div class="form-group">
 <div class="col-sm-12">
	 <div class="col-sm-6">
	 <label class="control-label" style="text-align:left;">Transport Name </label>     
	<input type="text" name="transport_name" class="form-control" placeholder="Transport Name" />	
              </div>
	 <div class="col-sm-6">
	 <label class="control-label" style="text-align:left;">Transport Mobile</label>
	 <input type="mobile" name="transport_mobile" class="form-control" placeholder="Mobile" />		
                </div>
				  </div>
				  <br/>
				   <br/>
				  <hr/>
	<div class="col-md-12">
	<div class="row">
	<table class="table table">
	<tr><tbody>
	   <th>Select Vehicle</th>
	   <th>Vehicle No</th>
	   <th>Tracking No</th>
	   <th>From Location</th>
	    </tbody></tr>
		
	 <tr>
	     <td><select class="form-control select2" style="width:100%">
		                   <option>--Select--</option>
					       <option value="Full Truck Loader">Full Truck Loader</option> 
                           <option value="Half Truck Loader">Half Truck Loader</option>
                           <option value="Small Pickup loader">Small Pickup loader</option>	
                           <option value="Big Pickup loader">Big Pickup loader</option>
		   </select></td>
	     <td><input type="text" name="vehicle_no" class="form_control" placeholder="Vehicle No" /></td>
	     <td><input type="text" name="tracking_no" class="form_control" placeholder="Tracking No" /></td>
	     <td><input type="text" name="from_location" class="form_control" placeholder="From Location" /></td>
		 </tr>
		 <tr>
		<tbody>
	   <th>To Location</th>
	   <th>Transport Charge</th>
	   <th>Extra Charge</th>
	   <th>Total Amount</th>
	   <tbody>
	</tr>
		 <tr>
	     <td><input type="text" name="to_location" class="form_control" placeholder="To Location" /></td>
	     <td><input type="number" name="teansport_charge" class="form_control" placeholder="Transport Charge" /></td>
	     <td><input type="number" name="Extra_charge" class="form_control" placeholder="Extra Charge" /></td>
	     <td><input type="number" name="Total_Amount" class="form_control" placeholder="Total Amount" /></td>
	 </tr>
	</table>
	</div>
	</div>
    <div class="col-sm-4">
	 <label class="control-label" style="text-align:left;">From Location</label> <input type="text" name="from_location" class="form-control" placeholder="From Location" />	
                    </div>
    <div class="col-sm-4">
	  <label class="control-label" style="text-align:left;">To Location</label> <input type="text" name="to_location" class="form-control" placeholder="To Location" />	
                    </div>					
                </div>
	<div class="col-sm-12">
				<div class="col-sm-4">
				 <label class="control-label" style="text-align:left;">Transport Mobile</label>
				 <input type="mobile" name="transport_mobile" class="form-control" placeholder="Mobile" />		
                </div>
				<div class="col-sm-4">
				 <label class="control-label" style="text-align:left;">Select Vehicle Type</label>
				 <select name="vehicle_type" class="form-control select2" style="width:100%"> 
					       <option>--Select--</option>
					       <option value="Full Truck Loader">Full Truck Loader</option> 
                           <option value="Half Truck Loader">Half Truck Loader</option>
                           <option value="Small Pickup loader">Small Pickup loader</option>	
                           <option value="Big Pickup loader">Big Pickup loader</option>							   
						   </select>							   
                </div>
				<div class="col-sm-4">
				 <label class="control-label" style="text-align:left;">Vehicle No</label>
				 <input type="text" name="vehicle_no" class="form-control" placeholder="Vehicle No" />		
                </div>
				</div>
				<div class="col-sm-12">
				  <div class="col-sm-4">
				  <label class="control-label" style="text-align:left;">Tracking No</label>
				 <input type="text" name="tracking_no" class="form-control" placeholder="Tracking_no" />
				 </div>
				 <div class="col-sm-4">
				  <label class="control-label" style="text-align:left;">Transport Charge</label>
				 <input type="number" name="transport_charge" class="form-control" placeholder="Transport Charge" />
				 </div>
				  <div class="col-sm-4">
				  <label class="control-label" style="text-align:left;">Extra Charge</label>
				 <input type="number" name="extra_charge" class="form-control" placeholder="Extra Charges" />
				 </div>
				</div>
                </div>
				
			
			    </div>		  
                <div class="tab-pane" id="tab_3">
                 
			    </div>
 		
                </div>
				</div>
			</div>
				
			<div class="col-sm-12">	
			<br/><center><input type="submit" name="submit" value="submit" class="btn btn-success"></center><br/>
		    </div>		
		</form>	
	</div>

          </div>
		  </div>
    </div>
</section>
</div>
<script>
  $(function () {
 
    $('.select2').select2()

  })
</script>