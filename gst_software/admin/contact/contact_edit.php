<?php include("../../attachment/session.php");?>

</head>
<body class="hold-transition skin-green sidebar-mini">

    <section class="content-header">
      <h1>
        Contact Edit
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
		<li><a href="javascript:get_content('contact/contact')"><i class="fa fa-list"></i>Contact List</a></li>
        <li class="active">Contact Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	   <div class="col-xs-12">
          <div class="box">
        
<script>
$("#Contact_edit_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);
     
        $.ajax({
            url: software_link+"contact/contact_edit_api.php",
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
<?php
$s_no=$_GET['id'];
$que="select * from contact_master where s_no='$s_no'";
$run=mysql_query($que);
$serial_no=0;
while($row=mysql_fetch_array($run)){
	$s_no = $row['s_no'];
	$contact_tittle_name = $row['contact_tittle_name'];
	$contact_first_name = $row['contact_first_name'];
	$contact_last_name = $row['contact_last_name'];
	$company_name = $row['company_name'];
	$contact_company_name = $row['contact_company_name'];
	$contact_contact_phone = $row['contact_contact_phone'];
	$contact_contact_phone2 = $row['contact_contact_phone2'];
	$contact_website = $row['contact_website'];
	$contact_area = $row['contact_area'];
	$contact_contact_type = $row['contact_contact_type'];
	$contact_gst_treatment = $row['contact_gst_treatment'];
	$contact_gstin = $row['contact_gstin'];
	$contact_place_of_supply = $row['contact_place_of_supply'];
	$contact_currency = $row['contact_currency'];
	$contact_payment_terms = $row['contact_payment_terms'];
	$contact_tax_prefrences = $row['contact_tax_prefrences'];
	$contact_attention = $row['contact_attention'];
	$contact_address =  $row['contact_address'];
	$contact_city = $row['contact_city'];
	$contact_state = $row['contact_state'];
	$contact_zipcode = $row['contact_zipcode'];
	$contact_country = $row['contact_country'];
	$contact_fax = $row['contact_fax'];
	$contact_phone = $row['contact_phone'];
	$contact_shipping_attention = $row['contact_shipping_attention'];
	$contact_shipping_address = $row['contact_shipping_address'];
	$contact_shipping_city = $row['contact_shipping_city'];
	$contact_shipping_state = $row['contact_shipping_state'];
	$contact_shipping_zipcode = $row['contact_shipping_zipcode'];
	$contact_shipping_country = $row['contact_shipping_country'];
	$contact_shipping_fax = $row['contact_shipping_fax'];
	$contact_shipping_phone = $row['contact_shipping_phone'];
    $contact_email = $row['contact_email'];
	$contact_pan_no = $row['contact_pan'];
	$contact_adhar_no = $row['contact_adhar'];
	$contact_remark = $row['contact_remark'];
	$contact_transport_name = $row['contact_transport_name'];
	$contact_transport_mobile = $row['contact_transport_mobile'];
	$contact_transport_mobile2 = $row['contact_transport_mobile2'];
    $contact_transport_address = $row['contact_transport_address'];
	$contact_transport_details = $row['contact_transport_details'];
	$contact_person_name_1 = $row['contact_person_name_1'];
	$contact_person_number_1 = $row['contact_person_number_1'];
	$contact_person_email_1 = $row['contact_person_email_1'];
	$contact_person_remark_1 = $row['contact_person_remark_1'];
	$contact_person_name_2 = $row['contact_person_name_2'];
	$contact_person_number_2 = $row['contact_person_number_2'];
	$contact_person_email_2 = $row['contact_person_email_2'];
	$contact_person_remark_2 = $row['contact_person_remark_2'];
	$contact_person_name_3 = $row['contact_person_name_3'];
	$contact_person_number_3 = $row['contact_person_number_3'];
	$contact_person_email_3 = $row['contact_person_email_3'];
	$contact_person_remark_3 = $row['contact_person_remark_3'];
	$contact_person_name_4 = $row['contact_person_name_4'];
	$contact_person_number_4 = $row['contact_person_number_4'];
	$contact_person_email_4 = $row['contact_person_email_4'];
	$contact_person_remark_4 = $row['contact_person_remark_4'];
	$contact_person_name_5 = $row['contact_person_name_5'];
	$contact_person_number_5 = $row['contact_person_number_5'];
	$contact_person_email_5 = $row['contact_person_email_5'];
	$contact_person_remark_5 = $row['contact_person_remark_5'];
}
?>
			
    <div class="box-body">
		<form method='post' id="Contact_edit_form" onsubmit="return validate();" enctype="multipart/form-data">
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-12 form-horizontal">
				   <div class="form-group">
				   <div class="col-sm-6">
				   	<input type="hidden" name="s_no" value="<?php echo $s_no; ?>" >
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Type:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		
					<input type="radio" name="contact_contact_type" id="" value="Customer" <?php if($contact_contact_type=='Customer') { ?> checked <?php } ?>>&nbsp;&nbsp;<b>Customer</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="contact_contact_type" id="" value="Vendor" <?php if($contact_contact_type=='Vendor') { ?> checked <?php } ?>>&nbsp;&nbsp;<b>Vendor</b> 
                   </div>
                   </div>
				   </div>
				   <div class="col-sm-6 form-horizontal">
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Primary Contact</label>
                    <div class="col-sm-2">
                          <select class="form-control" name="contact_tittle_name">
						  <option value="Mr.">Mr.</option>
						  <option value="<?php echo $contact_tittle_name; ?>"><?php echo $contact_tittle_name; ?></option>
						  <option value="Mrs.">Mrs.</option>
						  <option value="Ms.">Ms.</option>
						  <option value="Miss.">Miss.</option>
						  <option value="Dr.">Dr.</option>					  
						  </select>
                    </div>
					<div class="col-sm-3">
                    <input type="text" name="contact_first_name" value="<?php echo $contact_first_name; ?>" placeholder="First Name" class="form-control">
                    </div>
					<div class="col-sm-3">
                    <input type="text" name="contact_last_name" value="<?php echo $contact_last_name; ?>" placeholder="Last Name" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Company Name</label>
                    <div class="col-sm-8">
                       <input type="text" name="company_name" value="<?php echo $company_name; ?>" placeholder="Company Name" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Display Name</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_company_name" value="<?php echo $contact_company_name; ?>" placeholder="Contact Display Name" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Email</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_email" value="<?php echo $contact_email; ?>" placeholder="Contact Email" class="form-control">
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">PAN Number</label>
                    <div class="col-sm-8">
                       <input type="text" name="pan_no" value="<?php echo $contact_pan_no; ?>" placeholder="Pan Card Number" class="form-control">
                    </div>
                    </div>
                    </div>
					</div>
						<div class="col-sm-6 form-horizontal">
							<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Adhar Number</label>
                    <div class="col-sm-8">
                       <input type="text" name="adhar_no" value="<?php echo $contact_adhar_no; ?>" placeholder="Adhar Number" class="form-control">
                    </div>
                    </div>
                    </div>
						
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Mobile Number</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_contact_phone" value="<?php echo $contact_contact_phone; ?>" placeholder="Contact Mobile Number" class="form-control">
                    </div>
                    </div>
                    </div>
						<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;"> Work Mobile Number</label>
                    <div class="col-sm-8">
                       <input type="mobile" name="contact_contact_phone2" value="<?php echo $contact_contact_phone2; ?>" placeholder="Work Mobile Number" MaxLength="10" class="form-control">
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Website</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_website" value="<?php echo $contact_website; ?>" placeholder="Website" class="form-control">
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Contact Area</label>
                    <div class="col-sm-8">
                       <input type="text" name="contact_area" value="<?php echo $contact_area; ?>" placeholder="Contact Area" class="form-control">
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
					<input type="radio" name="contact_tax_prefrences" id="" value="Taxable" <?php if($contact_tax_prefrences=='Taxable') { ?> checked <?php } ?>>&nbsp;&nbsp;<b>Taxable</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="contact_tax_prefrences" id="" value="Tax-Exempt" <?php if($contact_tax_prefrences=='Tax-Exempt') { ?> checked <?php } ?>>&nbsp;&nbsp;<b>Tax-Exempt</b> 
					</div>
					</div>
				    
				    <div class="form-group">
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">Currency</label>
					<div class="col-sm-8">
					<select name="contact_currency" class="form-control">
					<option value="<?php echo $contact_currency; ?>"><?php echo $contact_currency; ?></option>
					</select>
					</div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">Payment Terms</label>
					<div class="col-sm-8">
					<select name="contact_payment_terms" class="form-control select2" style="width:100%">
					    <option value="<?php echo $contact_payment_terms; ?>"><?php echo $contact_payment_terms; ?></option>
						<option value="Net-15">Net-15</option>
						<option value="Net-30">Net-30</option>
						<option value="Net-45">Net-45</option>
						<option value="Net-60">Net-60</option>
						<option value="Due end of the month">Due end of the month</option>
						<option value="Due end of the next month">Due end of the next month</option>
						<option value="Due on receipt">Due on receipt</option>
					</select>
					</div>
					</div>
					</div>
					
					<div class="form-group">	
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">GST Treatment</label>
					<div class="col-sm-8">
					    <select class="form-control select2" name="contact_gst_treatment" style="width:100%">
						<option value="<?php echo $contact_gst_treatment; ?>"><?php echo $contact_gst_treatment; ?></option>
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
					 <input type="text"  name="contact_gstin" id="contact_gstin" placeholder="GST Number" value="<?php echo $contact_gstin; ?>" class="form-control">
					</div>
					</div>
					</div>					
					<div class="form-group">	
					<div class="col-sm-6">
					<label class="col-sm-4 control-label" style="text-align:left;">Place of supply</label>
					<div class="col-sm-8">
					    <select class="form-control select2" name="contact_place_of_supply" style="width:100%">
						<option value="<?php echo $contact_place_of_supply; ?>"><?php echo $contact_place_of_supply; ?></option>
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
					<textarea col="8" rows="4" name="contact_address" class="form-control"><?php echo $contact_address; ?></textarea>
					</div>
					</div>
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Country </label>
					<div class="col-sm-8">
					<input type="text"  name="contact_country" id="contact_country" placeholder="Billing Country"  value="<?php echo $contact_country; ?>" class="form-control">
					</div>
					</div>
                    
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">State</label>
					<div class="col-sm-8">
					    <select class="form-control select2" name="contact_state" id="contact_state" style="width:100%">
						<option value="<?php echo $contact_state; ?>"><?php echo $contact_state; ?></option>
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
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">City</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_city" id="contact_city" placeholder="Billing City"  value="<?php echo $contact_city; ?>" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Zipcode</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_zipcode" id="contact_zipcode" placeholder="Billing Zipcode"  value="<?php echo $contact_zipcode; ?>" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Landmark</label>
					<div class="col-sm-8">
					 <input type="text"  name="contact_attention" id="contact_attention" placeholder="Billig Landmark"  value="<?php echo $contact_attention; ?>" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Phone</label>
					<div class="col-sm-8">
					<input type="text" name="contact_phone" id="contact_phone" placeholder="Billing Phone"  value="<?php echo $contact_phone; ?>" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Fax</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_fax" id="contact_fax" placeholder="Billing Fax"  value="<?php echo $contact_fax; ?>" class="form-control">
					</div>
					</div>
					
                </div>			
				<div class="col-sm-6">   
				   <h5 class="box-title" style="color:#8C0895"><b>Shipping  Address</b>&nbsp;&nbsp;&nbsp;if same </b>
		           <input type="checkbox" onclick="copy_address();" id="same_as_billing_address"></h5>
                    <div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Address</label>
					<div class="col-sm-8">
					<textarea col="4" rows="4" name="contact_shipping_address" class="form-control"><?php echo $contact_shipping_address; ?></textarea>
					</div>
					</div>
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Country </label>
					<div class="col-sm-8">
					<input type="text" name="contact_shipping_country" id="contact_shipping_country" placeholder="Shipping Country"  value="<?php echo $contact_shipping_country; ?>" class="form-control">
					</div>
					</div>
                    
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">State</label>
					<div class="col-sm-8">
					    <select class="form-control" name="contact_shipping_state" id="contact_shipping_state" style="width:100%">
						<option value="<?php echo $contact_shipping_state; ?>"><?php echo $contact_shipping_state; ?></option>
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
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">City</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_city" id="contact_shipping_city" placeholder="Shipping City"  value="<?php echo $contact_shipping_city; ?>" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Zipcode</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_zipcode" id="contact_shipping_zipcode" placeholder="Shipping Zipcode"  value="<?php echo $contact_shipping_zipcode; ?>" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Landmark</label>
					<div class="col-sm-8">
					 <input type="text"  name="contact_shipping_attention" id="contact_shipping_attention" placeholder="Billig Landmark"  value="<?php echo $contact_shipping_attention; ?>" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Phone</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_phone" id="contact_shipping_phone" placeholder="Shipping Phone"  value="<?php echo $contact_shipping_phone; ?>" class="form-control">
					</div>
					</div>
					
					<div class="form-group">
					<label class="col-sm-4 control-label" style="text-align:left;">Fax</label>
					<div class="col-sm-8">
					<input type="text"  name="contact_shipping_fax" id="contact_shipping_fax" placeholder="Shipping Fax"  value="<?php echo $contact_shipping_fax; ?>" class="form-control">
					</div>
					</div>					
                </div>		
                </div>
                </div>
              </div>				
                <div class="tab-pane" id="tab_4">
                 <div class="box-body table-responsive">
				   <table  class="table table-bordered" style="background-color:white;">
					  <thead class="my_background_color">
						 <tr>
							<th>S no</th>
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
                             <input type="text" name="contact_person_name_1" class="form-control" placeholder="eg: Mr. First Contact Person" value="<?php echo $contact_person_name_1; ?>">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_1" class="form-control" placeholder="eg: 8878444445" value="<?php echo $contact_person_number_1; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_1" class="form-control" placeholder="eg: example@gmail.com" value="<?php echo $contact_person_email_1; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_1" class="form-control" placeholder="Remark" value="<?php echo $contact_person_remark_1; ?>">
					      </td>
                          </tr>
						  <tr>
					      <td><span class="snm">2.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_2" class="form-control" placeholder="eg: Mr. Second Contact Person" value="<?php echo $contact_person_name_2; ?>">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_2" class="form-control" placeholder="eg: 8878444445" value="<?php echo $contact_person_number_2; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_2" class="form-control" placeholder="eg: example@gmail.com" value="<?php echo $contact_person_email_2; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_2" class="form-control" placeholder="Remark" value="<?php echo $contact_person_remark_2; ?>">
					      </td>
                          </tr>
						  <tr>
					      <td><span class="snm">3.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_3" class="form-control" placeholder="eg: Mr. Third Contact Person" value="<?php echo $contact_person_name_3; ?>">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_3" class="form-control" placeholder="eg: 8878444445" value="<?php echo $contact_person_number_3; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_3" class="form-control" placeholder="eg: example@gmail.com" value="<?php echo $contact_person_email_3; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_3" class="form-control" placeholder="Remark" value="<?php echo $contact_person_remark_3; ?>">
					      </td>
                          </tr>
						  <tr>
					      <td><span class="snm">4.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_4" class="form-control" placeholder="eg: Mr. Fourth Contact Person" value="<?php echo $contact_person_name_4; ?>">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_4" class="form-control" placeholder="eg: 8878444445" value="<?php echo $contact_person_number_4; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_4" class="form-control" placeholder="eg: example@gmail.com" value="<?php echo $contact_person_email_4; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_4" class="form-control" placeholder="Remark" value="<?php echo $contact_person_remark_4; ?>">
					      </td>
                          </tr>
						  <tr>
					      <td><span class="snm">5.</span></td>
						  <td>
                             <input type="text" name="contact_person_name_5" class="form-control" placeholder="eg: Mr. Fifth Contact Person" value="<?php echo $contact_person_name_5; ?>">
					      </td>
						  <td>
                             <input type="number" name="contact_person_number_5" class="form-control" placeholder="eg: 8878444445" value="<?php echo $contact_person_number_5; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_email_5" class="form-control" placeholder="eg: example@gmail.com" value="<?php echo $contact_person_email_5; ?>">
					      </td>
						  <td>
                             <input type="text" name="contact_person_remark_5" class="form-control" placeholder="Remark" value="<?php echo $contact_person_remark_5; ?>">
					      </td>
                          </tr>
					  </tbody>
				   </table>
                </div>
                </div>			  
                <div class="tab-pane" id="tab_5">
				<div class="form-group">
				<div class="col-sm-6">
				 <label class="col-sm-4 control-label" style="text-align:left;">Transport Name  </label>
                 <div class="col-sm-8">
				<input type="text" name="contact_transport_name" value="<?php echo $contact_transport_name; ?>" class="form-control" placeholder="Transport Name" />			
                </div>
                </div>
                </div>
				
				<div class="form-group">
				<div class="col-sm-6">
				 <label class="col-sm-4 control-label" style="text-align:left;">Transport Mobile</label>
                 <div class="col-sm-8">
				 <input type="mobile" name="contact_transport_mobile" value="<?php echo $contact_transport_mobile; ?>" class="form-control" placeholder="Mobile" />		
                </div>
                </div>
                </div>
				<div class="form-group">
				<div class="col-sm-6">
				 <label class="col-sm-4 control-label" style="text-align:left;">Transport Work Mobile</label>
                 <div class="col-sm-8">
				<input type="mobile" name="contact_transport_mobile2" value="<?php echo $contact_transport_mobile2; ?>" class="form-control" placeholder="Work Mobile" />			
                </div>
                </div>
                </div>
				<div class="form-group">
				<div class="col-sm-6">
				 <label class="col-sm-4 control-label" style="text-align:left;">Transport Address</label>
                 <div class="col-sm-8">
				 <textarea rows="4" cols="50" style="resize:none;" name="contact_transport_address"><?php echo $contact_transport_address; ?></textarea>				
                </div>
                </div>
                </div>
                <div class="form-group">
				<div class="col-sm-6">
				 <label class="col-sm-4 control-label" style="text-align:left;">Transport Details  </label>
                 <div class="col-sm-8">
				 <textarea rows="4" cols="50"  style="resize:none;" name="contact_transport_details"><?php echo $contact_transport_details; ?></textarea>				
                </div>
                </div>
                </div>
			    </div>			  
                <div class="tab-pane" id="tab_3">
                <div class="form-group">
				<div class="col-sm-6">
				 <label class="col-sm-4 control-label" style="text-align:left;">Remarks (for internal use) </label>
                 <div class="col-sm-8">
				 <textarea rows="4" cols="50"  style="resize:none;" name="contact_remark"><?php echo $contact_remark; ?></textarea>			
                </div>
                </div>
                </div>
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
  </div>
  </div>
</section>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
})
</script>				