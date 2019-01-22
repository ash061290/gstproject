  <?php
include("../../attachment/session.php");
  	  ?>
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
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
            <div class="col-xs-12">
          <div class="box my_border_top">
     
<script src="ready_function_ajax_jquery.js"></script>

<script>
    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: software_link+"banking/bank_edit_api.php",
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
<?php
	$s_no=$_GET['id'];
	$que="select * from bank_or_credit_card_info where s_no='$s_no'";
	$run=mysql_query($que);
	while($row=mysql_fetch_array($run)){
    $bank_account_type = $row['bank_account_type'];
	$bank_account_name = $row['bank_account_name'];
	$bank_account_code = $row['bank_account_code'];
	$bank_account_number = $row['bank_account_number'];
	$bank_name = $row['bank_name'];
	$Mobile_No = $row['Mobile_No'];
	$bank_description_bank = $row['bank_description_bank'];	
	$credit_card_account_name = $row['credit_card_account_name'];
	$credit_card_bank_name = $row['credit_card_bank_name'];
	$credit_card_account_number = $row['credit_card_account_number'];
	$credit_card_card_number = $row['credit_card_card_number'];
	$credit_card_account_code = $row['credit_card_account_code'];
	$credit_card_description_bank = $row['credit_card_description_bank'];
	$credit_card_routing_no = $row['credit_card_routing_no'];
	$pan_card_no = $row['pan_card_no'];
	$account_type = $row['account_type'];
    }
?>	
    <div class="box-body">
		<form method='post' id="my_form">
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-6 form-horizontal">
				   <div class="form-group">
				   <div class="col-sm-12">
				   <input type="hidden" name="s_no" value="<?php echo $s_no; ?>">
                    <label class="col-sm-4 control-label" style="text-align:left;">Select Account Type:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="bank_account_type" class="banking" value="Bank" <?php if($bank_account_type=='Bank') { ?> checked <?php } ?> onclick="for_banking(this.value);">&nbsp;&nbsp;<b>Bank</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="bank_account_type" class="banking" value="Credit_Card" <?php if($bank_account_type=='Credit_Card') { ?> checked <?php } ?> onclick="for_banking(this.value);">&nbsp;&nbsp;<b>Credit Card</b>
                   </div>
                   </div>
				   
				<div class="" id="for_bank">
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="bank_account_name" placeholder="Account Name" id="bank_account_name" class="form-control" value="<?php echo $bank_account_name; ?>">
						<input type="hidden" name="" placeholder="Account Name" id="s_no" class="form-control" value="<?php echo $s_no; ?>">
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Bank Name</label>
                    <div class="col-sm-8">
                       <input type="text" name="bank_name" placeholder="Bank Name" id="bank_name" class="form-control" value="<?php echo $bank_name; ?>">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Number</label>
                    <div class="col-sm-8">
                       <input type="text"  name="bank_account_number" placeholder="Account Number" id="bank_account_number" class="form-control" value="<?php echo $bank_account_number; ?>">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Pan Card No</label>
                    <div class="col-sm-8">
                       <input type="text"  name="pan_card_no" placeholder="Pan Card No" id="pan_card_no" class="form-control" value="<?php echo $pan_card_no; ?>">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Ifsc Code</label>
                    <div class="col-sm-8">
                       <input type="text"  name="bank_account_code" placeholder="Account Ifsc Code" id="bank_account_code" class="form-control" value="<?php echo $bank_account_code; ?>">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Type</label>
                    <div class="col-sm-8">
						  <select class="form-control" name="account_type" id="account_type">
						  <option value="<?php echo $account_type; ?>"><?php echo $account_type; ?></option>
						  <option value="Current Account">Current Account</option>
						  <option value="Saving Account">Saving Account</option>
						  <option value="CC Account">CC Account</option>
						  <option value="Loan Account">Loan Account</option>			  
						  </select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Mobile No</label>
                    <div class="col-sm-8">
                       <input type="text"  name="Mobile_No" placeholder="Mobile No" id="Mobile_No" class="form-control" value="<?php echo $Mobile_No; ?>">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Description</label>
                    <div class="col-sm-8">
                       <input type="text"  name="bank_description_bank" placeholder="Description" id="bank_description_bank" class="form-control" value="<?php echo $bank_description_bank; ?>">
                    </div>
                    </div>
                    </div>
				</div>
				<div class="" id="for_credit_card" style="display:none">
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Name</label>
                    <div class="col-sm-8">
                       <input type="text" name="credit_card_account_name" placeholder="Account Name" id="account_name1" class="form-control" value="<?php echo $credit_card_account_name; ?>">
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Bank Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="credit_card_bank_name" placeholder="Bank Name" id="bank_name1" class="form-control" value="<?php echo $credit_card_bank_name; ?>">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Number</label>
                    <div class="col-sm-8">
                     <input type="text" name="credit_card_account_number" placeholder="Account Number" id="account_number1" class="form-control" value="<?php echo $credit_card_account_number; ?>">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Account Ifsc Code</label>
                    <div class="col-sm-8">
                       <input type="text" name="credit_card_account_code" placeholder="Account Ifsc Code" id="account_code1" class="form-control" value="<?php echo $credit_card_account_code; ?>">
                    </div>
                    </div>
                    </div>
										
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Credit Card No</label>
                    <div class="col-sm-8">
                      <input type="text" name="credit_card_card_number" placeholder="Credit Card No" id="credit_card_card_number1" class="form-control" value="<?php echo $credit_card_card_number; ?>">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Routing No</label>
                    <div class="col-sm-8">
                       <input type="text"  name="credit_card_routing_no" placeholder="Routing No" id="credit_card_routing_no1" class="form-control" value="<?php echo $credit_card_routing_no; ?>">
                    </div>
                    </div>
                    </div>
									
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Description</label>
                    <div class="col-sm-8">
                      <input type="text" name="credit_card_description_bank" placeholder="Description" id="description_bank1" class="form-control" value="<?php echo $credit_card_description_bank; ?>">
                    </div>
                    </div>
                    </div>
				</div>
				</div>
		
			<div class="col-sm-12">	
			<br/><center><input type="submit" name="submit" value="submit" class="btn btn-Success"></center><br/>
		    </div>		
		</form>	
	</div>
		  <!-- /.box-body -->
          </div>
    </div>
	</div>
</section>
  </div>
</div>