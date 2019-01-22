<?php
include("../../attachment/session.php");
  	  ?>
    <section class="content-header">
      <h1>
       Payment By NEFT/RTGS
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/neft_details')"><i class="fa fa-list"></i>NEFT/RTGS Details</a></li>
        <li class="active">Add NEFT/RTGS</li>
      </ol>
    </section>

	
<script>
	function myFunction(){   
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	return true;        
	 }            
	else  {      
	return false;
	 }       
	  } 

        function customer_vendor(value){    
            $.ajax({
			  type: "POST",
              url: software_link+"banking/ajax_customer_wise_invoice_details.php?customer_id="+value+"",
              cache: false,
              success: function(detail){
                   var str =detail;
				   $("#invoice_details").html(str); 
				   $("#balance_amount").val('');
				   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
              }
            }); }
        function for_balance(value,company_code){ 
          $.ajax({
			  type: "POST",
              url: software_link+"banking/ajax_invoice_balance.php?invoice_no="+value+"&company_code="+company_code+"",
              cache: false,
              success: function(detail){
			  var res=detail.split('|?|');
		      $("#balance_amount").val(res[0]);
		      $("#invoice_paid_amount").val(res[2]);
			  if(detail!=''){
			  if(res[1]!='Credit'){	
			  $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
		      $("#transaction_type option[value='Credit']").remove();			  
		      $("#transaction_type option[value='']").remove();			  
			  }else if(res[1]!='Debit'){
			  $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
			  $("#transaction_type option[value='Debit']").remove();			  
		      $("#transaction_type option[value='']").remove();	
			  }}else{
			   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
			  }
              }
           });
        }
</script>

<script>
$("#add_neft_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);
 
        $.ajax({
            url: software_link+"banking/neft_add_api.php",
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
				   post_content('banking/neft_add',res[2]);
            }
			}
         });
      });
</script>


    <?php
    $que11="select * from invoice_no where company_code='$company_code'";
    $run11=mysql_query($que11) or die(mysql_error());
    while($row11=mysql_fetch_array($run11)){
    $folder_id=$row11['folder_id']; 
    }
	?>
    

 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <div class="col-xs-12">
    <div class="box my_border_top">
            
        <div class="box-body">
		<form role="form" method="post" id="add_neft_form" enctype="multipart/form-data">
       	        			
				<div class="col-md-4 box-body table-responsive" style="background-color:#F2F3F4">
                <table id="" class="table table-bordered table-striped">
                <thead class="">
                </thead>										
		        <tbody>
			    <div class="col-sm-12 form-horizontal">	
                    <div class="col-sm-12">
					<div class="col-sm-6">
                    <h5 style="color:#873600"><b>Add NEFT/RTGS Details</b></h5>
                    </div>
				   <!-- <div class="col-sm-6">
                    <a href="neft_details.php"><i class="fa fa-times" style="margin-left:100%;color:black"></i></a>
                    </div>
                    </div>-->

                    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Account Name</label>
                    <div class="col-sm-7">
					<select class="form-control select2" name="bank_s_no" style="width:100%" required>
						<option value="">Select</option>
						<?php
						$que="select * from bank_or_credit_card_info where bank_status='Active' and company_code='$company_code'";
						$run=mysql_query($que);
						while($row=mysql_fetch_array($run)){
						$bank_s_no=$row['s_no'];
						$bank_account_type=$row['bank_account_type'];
						$bank_account_name=$row['bank_account_name'];
						$credit_card_account_name=$row['credit_card_account_name'];
						if($bank_account_type=='Credit_Card'){
						$name=$credit_card_account_name.'('.$bank_account_type.')';
						$bank_name=$credit_card_account_name;
						}else{
						$name=$bank_account_name.'('.$bank_account_type.')';
						$bank_name=$bank_account_name;
						}
	                    ?>
						<option value="<?php echo $bank_s_no; ?>"><?php echo $name; ?></option>
						<?php } ?>
					</select>
                    </div>
                    </div>
                    </div>
				
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Customer/Vendor </label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="customer_id" style="width:100%" onchange="customer_vendor(this.value)" required>
						<option value="">Select</option>
						<?php
						$que="select * from contact_master where contact_status='Active' and company_code='$company_code'";
						$run=mysql_query($que);
						while($row=mysql_fetch_array($run)){
						$customer_id=$row['s_no'];
						$contact_tittle_name=$row['contact_tittle_name'];
						$contact_first_name=$row['contact_first_name'];
						$contact_last_name=$row['contact_last_name'];
						$contact_company_name=$row['contact_company_name'];
						$contact_contact_phone=$row['contact_contact_phone'];
						$contact_email=$row['contact_email'];
						$contact_gstin=$row['contact_gstin'];					
						$contact_contact_type=$row['contact_contact_type'];	
						$contact_gst_treatment=$row['contact_gst_treatment'];
          				$contact=$contact_company_name.' ('.$contact_contact_type.')';	
						
	                    ?>
						<option value="<?php echo $customer_id; ?>"><?php echo $contact; ?></option>
						<?php } ?>
						</select>
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Invoice#</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="invoice_no" id="invoice_details" style="width:100%" onchange='for_balance(this.value,<?php echo $company_code; ?>);'>
						<option value="">Select</option>
						</select>
                    </div>
                    </div>
                    </div>

					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Balance Amount</label>
                    <div class="col-sm-7">
                      <input type="text" name="balance_amount" placeholder="Balance" id="balance_amount" class="form-control" readonly />
                      <input type="hidden" name="invoice_paid_amount" placeholder="Paid Amount" id="invoice_paid_amount" class="form-control" value="0" readonly />
                    </div>
                    </div>
                    </div>
				                   
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Amount</label>
                    <div class="col-sm-7">
                       <input type="text" name="total_amount" value="" Placeholder="Amount" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="transaction_hide">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Transaction Type</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="neft_transaction_type" style="width:100%" id="transaction_type" required>
					  <option value="">Select</option>
					  <option value="Credit">Credit</option>
					  <option value="Debit">Debit</option>
					  </select>
                    </div>
                    </div>
                    </div>
										
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Date</label>
                    <div class="col-sm-7">
                       <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                    </div>
                    </div>
                    </div>
 
					
					<div class="form-group" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Refrence</label>
                    <div class="col-sm-7">
                       <input type="text" name="reference" value="" class="form-control">
                    </div>
                    </div>
                    </div>
									
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">NEFT/RTGS</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="payment_mode" style="width:100%" required>
					  <option value="">Select</option>
					  <option value="Neft">Neft</option>
					  <option value="RTGS">RTGS</option>
					  <option value="Paytm">Paytm</option>
					  </select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Discription</label>
                    <div class="col-sm-7">
                       <input type="text" name="remark" value="" placeholder="Discription" class="form-control">
                    </div>
                    </div>
                    </div>
					
                        <div class="form-group">
				    <div class="col-sm-12">
				    	 <label class="col-sm-5 control-label" style="text-align:left;">Choose Image</label>
				    	 
                     	<div class="col-md-7">	
				
					  <input type="file" name="upload_file" id="upload_file" placeholder="" onchange="check_file_type(this,'upload_file','neft_image','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
				</div>
			</div>
		</div>
					<div class="form-group">
				    <div class="col-sm-12">
				    	<div class="col-md-5"></div>
				<div class="col-md-1">	
					   <img id="neft_image" src=<?php echo $image_path."Profile.png"; ?> width='60px' height='60px'>
					</div>
				</div>
			</div>
					<input type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
					<div class="col-sm-12">	
					<div class="col-sm-2">
                    </div>					
					<div class="col-sm-3">	
			        <input type="submit" name="Submit" id="Submit" value="Submit" class="btn btn-success"><br/>
		            </div>
					<div class="col-sm-1"></div>
					<div class="col-sm-3">	
			        <a href="javascript:post_content('banking/neft_details','id=<?php echo $bank_s_no; ?>')"><button type="button" class="btn btn-success">Cancel</button></a>
		            </div>
					<div class="col-sm-3">
                    </div>	
		            </div>	
			    </div>
	            </tbody>				
                </table>
                </div>		   
				<div class="col-md-8 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>Date</th>
                  <th>Company Name</th>
                  <th>Account Name</th>
                  <th>NEFT/RTGS Details</th>
				  <th>Type</th>				  
				  <th>Payment Mode</th>
				  <th>Amount</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from account_info where payment_mode='Neft' and account_status='Active' or payment_mode='RTGS' and account_status='Active'  or payment_mode='Paytm' and account_status='Active' and company_code='$company_code'";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['reference'];
				$customer_id = $row['customer_id'];
				$payment_mode = $row['payment_mode'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$account_name = $row['account_name'];
				$cheque_dd = $row['cheque_dd'];
				$cheque_dd_no = $row['cheque_dd_no'];
				$invoice_no = $row['invoice_no'];
				$remark = $row['remark'];
				$date1 = $row['date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];				 
				 
				$que1="select * from contact_master where s_no='$customer_id' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
                  <th><?php echo $account_name; ?></th>
                  <th><?php echo $remark; ?></th>
                  <th><?php echo $transaction_type; ?></th>
                  <th><?php echo $payment_mode; ?></th>
                  <th><?php echo $invoice_total_paid; ?></th>
				  <?php } } ?>
				</tr>					
				</tbody>
                </table>
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
<script>
  $(function () {
    $('#example1').DataTable()
   
  })
</script>
