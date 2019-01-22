<?php include("../../attachment/session.php"); ?>
  <section class="content-header">
      <h1>
        Add Bank Or Credit Card
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="javascript:get_content('banking/banking')"><i class="fa fa-list"></i>Banking Overview</a></li>
        <li class="active">Add Bank Or Credit Card</li>
      </ol>
    </section>
<script>
$("#add_bank_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"banking/add_bank_api.php",
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
				   post_content('banking/banking',res[2]);
            }
			}
         });
      });
</script>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

 function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
        }
</script>
<section class="content">
      <div class="row">
	  <div class="col-xs-12">
	       <!-- general form elements disabled -->
          <div class="box my_border_top">
    <div class="box-body">
		<form method='post' id="add_bank_form">
			<div class="row">
				<div class="col-sm-6 form-horizontal">
				   <div class="form-group">
				   <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Select </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		
					<input type="radio" name="bank_account_type" value="Bank" checked onclick="for_banking(this.value);">&nbsp;&nbsp;<b>Bank</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="bank_account_type" value="Credit_Card" onclick="for_banking(this.value);">&nbsp;&nbsp;<b>Credit Card</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="bank_account_type" value="E-Payment" onclick="for_banking(this.value);">&nbsp;&nbsp;<b>E-Payment</b>&nbsp;&nbsp;&nbsp;&nbsp;					
                   </div>
                   </div>
				   
				<div class="" id="for_bank">
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="bank_account_name" placeholder="Account Name" id="bank_account_name" class="form-control" required>
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Bank Name</label>
                    <div class="col-sm-8">
                       <input type="text" name="bank_name" placeholder="Bank Name" id="bank_name" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Number</label>
                    <div class="col-sm-8">
                       <input type="text"  name="bank_account_number" placeholder="Account Number" id="bank_account_number" maxlength="16" class="form-control" onkeypress="return isNumber(event)" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Pan Card No</label>
                    <div class="col-sm-8">
                       <input type="text"  name="pan_card_no" placeholder="Pan Card No" id="pan_card_no" maxlength="10" onkeypress="return blockSpecialChar(event)" class="form-control " required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Ifsc Code</label>
                    <div class="col-sm-8">
                       <input type="text" name="bank_account_code" placeholder="Account Ifsc Code" id="bank_account_code" class="form-control" maxlength="11" onkeypress="return blockSpecialChar(event)" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Type</label>
                    <div class="col-sm-8">
						  <select class="form-control select2" name="account_type" id="account_type" style="width:100%" required>
						  <option value="">--Select--</option>
						  <option value="Purchase Account">Purchase Account</option>
						  <option value="Sales Account">Sales Account</option>
						  <option value="Expense Account">Expense Account</option>
						  <option value="Personal Account">Personal Account</option>  
						  <option value="E-Payment Account">E-Payment Account</option>
						  <option value="Undeposite Account">Other Account</option>
						  </select>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Mobile No</label>
                    <div class="col-sm-8">
                       <input type="text"  name="Mobile_No" placeholder="Mobile No" id="Mobile_No" class="form-control" onkeypress="return isNumber(event)" maxlength="10" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Description</label>
                    <div class="col-sm-8">
                       <input type="text"  name="bank_description_bank" placeholder="Description" id="bank_description_bank" class="form-control" required>
                    </div>
                    </div>
                    </div>
				</div>
				<div class="" id="for_credit_card" style="display:none;">
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Name</label>
                    <div class="col-sm-8">
                       <input type="text" name="credit_card_account_name" placeholder="Account Name" id="account_name1" class="form-control">
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Bank Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="credit_card_bank_name" placeholder="Bank Name" id="bank_name1" class="form-control" >
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Number</label>
                    <div class="col-sm-8">
                     <input type="text" name="credit_card_account_number" placeholder="Account Number" id="account_number1" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Ifsc Code</label>
                    <div class="col-sm-8">
                       <input type="text" name="credit_card_account_code" placeholder="Account Ifsc Code" id="account_code1" class="form-control">
                    </div>
                    </div>
                    </div>
										
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Credit Card No</label>
                    <div class="col-sm-8">
                      <input type="text" name="credit_card_card_number" placeholder="Credit Card No" id="credit_card_card_number1" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Routing No</label>
                    <div class="col-sm-8">
                       <input type="text"  name="credit_card_routing_no" placeholder="Routing No" id="credit_card_routing_no1" class="form-control " >
                    </div>
                    </div>
                    </div>
									
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Description</label>
                    <div class="col-sm-8">
                      <input type="text" name="credit_card_description_bank" placeholder="Description" id="description_bank1" class="form-control">
                    </div>
                    </div>
                    </div>
										
					<input type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
				</div>
				</div>
			<div class="col-sm-12">	
			<br/><center><input type="submit" name="submit" value="submit" class="btn btn-success" ></center><br/>
		    </div>
        </div>			
		</form>	
	
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