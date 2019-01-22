  
    <section class="content-header">
      <h1>
       Payment By Cash
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('sales/cash_details')"><i class="fa fa-list"></i>Cash Details</a></li>
        <li class="active">Add Cash Details</li>
      </ol>
    </section>
	
<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
<!-- Main content -->
	
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
              url: software_link+"sales/ajax_customer_wise_invoice_details.php?customer_id3="+value+"",
              cache: false,
              success: function(detail){
                   var str =detail;
				   $("#invoice_details").html(str); 
				   $("#balance_amount").val('');
				   $("#transaction_type").html("<option value='Credit' selected>Credit</option>");
              }
            });

            }
        
        function for_balance(value){ 
          $.ajax({
			  type: "POST",
              url: software_link+"sales/ajax_invoice_balance.php?invoice_no="+value+"",
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
		function valid_amount(value)
		{
		 var paid_amount = value;
		 var invoice_amount = document.getElementById("balance_amount").value;
		 if(paid_amount>invoice_amount)
		 {
		 alert('Paid Amount Not Valid');
		 return false;
		 }
		 else
		 {
		   return true;
		 }
		}
</script>
    <?php
    $que11="select * from invoice_no where company_code='$company_code'";
    $run11=mysql_query($que11) or die(mysql_error());
    while($row11=mysql_fetch_array($run11)){
    $folder_id=$row11['folder_id']; 
    }
	?>
<script src="../attachment/file_check.js"></script>
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
        <!--------------------------------------Start Registration form----------------------------------------->
        <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
        <!-----------------------------------Expence Details Start---------------------------------------------->
        <!--------------------------------###########################------------------------------------------->	        			
				<div class="col-md-4 box-body table-responsive" style="background-color:#F2F3F4">
                <table id="" class="table table-bordered table-striped">
                <thead class="">
                </thead>										
		        <tbody>
			    <div class="col-sm-12 form-horizontal">	
                    <div class="col-sm-12">
					<div class="col-sm-6">
                    <h5 style="color:#873600"><b>Add Cash Details</b></h5>
                    </div>
				    <div class="col-sm-6">
                    <a href="cash_details.php"><i class="fa fa-times" style="margin-left:100%;color:black"></i></a>
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
						$run2=mysql_query($que);
						while($row=mysql_fetch_array($run2))
						{
						$s_no = $row['s_no'];
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
                    <label class="col-sm-5 control-label" style="text-align:left;">Reason</label>
                    <div class="col-sm-7">
					<textarea cols="4" rows="4"  name="payment_reason" class="form-control" style="resize:none;" required ></textarea>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Payment Notes</label>
                    <div class="col-sm-7">
		<textarea cols="4" rows="4"  name="payment_notes" class="form-control" required></textarea>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Amount</label>
                    <div class="col-sm-7">
                       <input type="text" name="invoice_paid_amount" id="total_amount" value="" onchange="valid_amount(this.value)" Placeholder="Amount" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="transaction_hide">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Transaction Type</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="cash_transaction_type" style="width:100%" id="transaction_type" required>
					  <option value="Credit" selected>Credit</option>
					  <!--<option value="Debit">Debit</option>-->
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
 					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Refrence</label>
                    <div class="col-sm-7">
                       <input type="text" name="reference" placeholder="Reference" value="" class="form-control" />
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Description</label>
                    <div class="col-sm-7">
                       <input type="text" name="description" value="" placeholder="Description" class="form-control">
                    </div>
                    </div>
                    </div>
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
                    <label class="col-sm-5 control-label" style="text-align:left;">Upload File</label>
                    <div class="col-sm-7">
                        <div class="form-group">
						  <label>Profile Photo</label>
					      <input type="file"  id="upload_file" name="upload_file"  value="" onchange="check_file_type(this,'upload_file','show_application','all');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc">
						   <img src="" id="show_application" height="50" width="50" >
					    </div>
                    </div>
                    </div>
                    </div>
					<div class="col-sm-12">	
					<div class="col-sm-3">
                    </div>					
					<div class="col-sm-3">	
			        <input type="submit" name="Save" value="Save" class="btn btn-primary my_background_color"><br/>
		            </div>
					<div class="col-sm-3">	
			        <a href="cash_details.php?id=<?php echo $s_no; ?>"><button type="button" class="btn btn-primary">Cancel</button></a>
		            </div>
		            </div>	
			    </div>
	            </tbody>				
                </table>
                </div>	
	       <!-----------------------------------Expence Details Start----------------------------------->		   
				<div class="col-md-8 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Type</th>
				  <th>Referance</th>				  
				  <th>Customer Name</th>
				  <th>Mode Of Payment</th>
				   <th>Total Amount</th>
				    <th>Action</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from account_info where invoice_no='Other Payment' and account_status='Active' and company_code='$company_code'";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['reference'];
				$invoice_firm_name = $row['customer_id'];
				$invoice_grand_total = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$invoice_due_amount = $row['invoice_due_amount'];
				$bank_s_no = $row['bank_s_no'];
				$payment_term = "Other Payment";
				$date1 = $row['date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];				 
				$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $payment_term; ?></th>
                  <th><?php echo $reference; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
				  <th><?php echo $bank_account_type; ?></th>
				  <th><?php echo $invoice_grand_total; ?></th>
				  <th>	 
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='sales_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'> Delete</a></th>
				  <?php } } ?>
				</tr>					
				</tbody>
                </table>
                </div>
  		
		</div>
	    </form>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
    </div>
</section>
  </div>
<?php
	if(isset($_POST['Save'])){
	$customer_id = $_POST['customer_id'];
	$bank_s_no = $_POST['bank_s_no'];
	$payment_notes = $_POST['payment_notes'];
	$payment_reason = $_POST['payment_reason'];
	$description = $_POST['description'];
	$cash_transaction_type = $_POST['cash_transaction_type'];
	$date = $_POST['date'];
	$reference = $_POST['reference'];
	$invoice_total_paid = $_POST['invoice_paid_amount'];
	$folder_id=$folder_id+1;
	
		$que="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$bank_s_no' and company_code='$company_code'";
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
		}

	$upload_file=$_FILES['upload_file']['name'];
	$upload_file_temp=$_FILES['upload_file']['tmp_name'];	
	$path="../../documents/upload_file/".$folder_id;
    mkdir($path, 0755, true);
	move_uploaded_file($upload_file_temp,$path."/".$upload_file);
	$quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount,cheque_status,company_name,company_code)
    values('$bank_s_no','$customer_id','$date','$invoice_total_paid','$reference','Cash','','$cash_transaction_type','$upload_file','$folder_id','$bank_account_type','$bank_name','Other Payment','0','Cleared','$company_name','$company_code')";
    $quer2="insert into sales_other_payment(bank_s_no,referance,invoice_firm_name,payment_reason,payment_notes,payment_amount,transaction_type,payment_date,description,account_name,account_type,invoice_no,invoice_due_amount,status,company_name,company_code)
    values('$bank_s_no','$reference','$customer_id','$payment_reason','$payment_notes','$invoice_total_paid','Cash','$date','$description','$bank_account_type','$bank_name','Other Payment','0','Active','$company_name','$company_code')";
	mysql_query($quer2);
	$quer1="update invoice_no set folder_id='$folder_id' where company_code='$company_code'";
	mysql_query($quer1);
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Added');</script>";
    echo "<script>window.open('payment_received.php','_self');</script>";
}
}

?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
