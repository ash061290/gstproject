<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Payment By Cash
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="cash_details.php"><i class="fa fa-list"></i>Cash Details</a></li>
        <li class="active">Add Cash Details</li>
      </ol>
    </section>
	
<script>
	function myFunction(value)
			{
			  $.ajax({
			   type:"POST",
			   url: software_link+"purchase/all_delete.php?advance_payment_delete="+value+"",
			   cache:false,
			   success:function(detail)
			   {
			    if(detail==1)
				{
				 window.open('advance_pay_add.php','_self');
				}
			   }
			   })
			}
        function customer_vendor(value){  		
            $.ajax({
			  type: "POST",
              url: software_link+"purchase/ajax_customer_wise_invoice_details.php?customer_id2="+value+"",
              cache: false,
              success: function(detail){
                   var str =detail;
				   $("#invoice_details").html(str); 
				   $("#balance_amount").val('');
				   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
              }
            }); }
        function for_balance(value){ 
          $.ajax({
			  type: "POST",
              url: software_link+"purchase/ajax_invoice_balance.php?invoice_no="+value+"",
              cache: false,
              success: function(detail){
				   var res=detail.split('|?|');
		      $("#balance_amount").val(res[0]);
		      $("#invoice_paid_amount").val(res[2]);
			  if(detail!=''){
				  //alert(res[1]);
			  if(res[1]!='Credit'){	
			  $("#transaction_type").html("<option value=''>Select</option><option value='Debit'>Debit</option>");
		      $("#transaction_type option[value='Credit']").remove();			  
		      $("#transaction_type option[value='']").remove();			  
			  }else if(res[1]!='Debit'){
			  $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option>");
			  $("#transaction_type option[value='Debit']").remove();			  
		      $("#transaction_type option[value='']").remove();	
			  }}else{
			   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
			  }
              }
           });
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
            <div class="box-header with-border">
			 <div class="col-md-12">
			      <div class="row">
				 <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Invoices Payments</a></li>
    <li><a data-toggle="tab" href="#order">Orders Payments</a></li>
  </ul>
			  </div>
			  <br/>
            </div>
            <!-- /.box-header -->
        <!--------------------------------------Start Registration form----------------------------------------->
		<div class="tab-content">
        <div id="home" class="tab-pane fade in active">
		<form role="form" method="post" enctype="multipart/form-data">
      	        			
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
                    <a href="#"><i class="fa fa-times" style="margin-left:100%;color:black"></i></a>
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
                    <label class="col-sm-5 control-label" style="text-align:left;">Customer/Vendor </label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="customer_id" style="width:100%" onchange="customer_vendor(this.value,<?php echo $company_code; ?>,'Invoiced')" required>
						<option value="">Select</option>
						<?php
						 $select_advance_sales = "select * from purchase_invoice_info where invoice_status='Active' and invoice_due_amount>0 and invoice_status2='Invoiced' and company_code='$company_code' group by invoice_no";
						  $run = mysql_query($select_advance_sales);
						  while($fetchrow = mysql_fetch_array($run))
						  {
						 $contact_firm_name=$fetchrow['invoice_firm_name'];
						 $que="select * from contact_master where contact_status='Active' and s_no='$contact_firm_name'";
						$run2=mysql_query($que);
						$row=mysql_fetch_array($run2);
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
          				$contact=$contact_company_name.'('.$contact_contact_type.')'				
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
                       <input type="text" name="total_amount" id="total_amount" value="" Placeholder="Amount" class="form-control" required>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="transaction_hide">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Transaction Type</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="cash_transaction_type" style="width:100%" id="transaction_type" required>
					  <option value="Credit" selected>Debit</option>
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
                    <label class="col-sm-5 control-label" style="text-align:left;">Discription</label>
                    <div class="col-sm-7">
                    <input type="text" name="remark" value="" placeholder="Discription" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Upload File</label>
                    <div class="col-sm-7">
                        <div class="form-group">
						  <label>Profile Photo</label>
					      <input type="file"  id="upload_file" name="upload_file" value="" onchange="check_file_type(this,'upload_file','show_application','all');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc">
						   <img src="" id="show_application" height="50" width="50" />
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
			        <a href="#"><button type="button" class="btn btn-primary">Cancel</button></a>
		            </div>
		            </div>	
			    </div>
	            </tbody>				
                </table>
                </div>		   
				<div class="col-md-8 box-body table-responsive">
                <table id="example3" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Referance</th>				  
				  <th>Customer Name</th>
				  <th>Payment Mode</th>
				  <th>Amount</th>
				  <th>Due Amount</th>
                </tr>
                </thead>
				<tbody>				
				<?php				
				$que="select * from purchase_invoice_info where invoice_due_amount>0 and invoice_status='Active' and company_code='$company_code' and invoice_status2='Invoiced' GROUP BY invoice_no";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['invoice_reference'];
				$invoice_no = $row['invoice_no'];
				$invoice_grand_total = $row['invoice_grand_total'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$invoice_due_amount = $row['invoice_due_amount'];
				$invoice_firm_name = $row['invoice_firm_name'];
				$transaction_type = $row['transaction_type'];
				$account_name = $row['account_name'];
				$cheque_dd = $row['cheque_dd'];
				$cheque_dd_no = $row['cheque_dd_no'];
				$invoice_payment_mode = $row['invoice_payment_mode'];
				if(empty($invoice_payment_mode))
				{
				 $invoice_payment_mode = "No Payment";
				}
				$remark = $row['remark'];
				$date1 = $row['invoice_date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];				 
				$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $reference; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
				  <th><?php echo $invoice_payment_mode; ?></th>
				  <th><?php echo $invoice_grand_total; ?></th>
				  <th><?php echo $invoice_due_amount; ?></th>
				  <?php } } ?>
				</tr>					
				</tbody>
                </table>
                </div>
  		 </form>
		</div>
		<?php
	if(isset($_POST['Save'])){
	$customer_id = $_POST['customer_id'];
	$bank_s_no = $_POST['bank_s_no'];
	$cash_transaction_type = $_POST['cash_transaction_type'];
	$date = $_POST['date'];
	$reference = $_POST['reference'];
	$remark = $_POST['remark'];
	$invoice_total_paid = $_POST['total_amount'];
	$invoice_paid_amount = $_POST['invoice_paid_amount'];
	$balance_amount = $_POST['balance_amount'];
	$previous_invoice_total_paid=$invoice_paid_amount+$invoice_total_paid;
	$invoice_no1 = $_POST['invoice_no'];
	if($invoice_no1!=''){
	 $invoice_balance=$balance_amount-$invoice_total_paid;
	$invoice_no2 = explode('|?|',$invoice_no1);
	$invoice_no = $invoice_no2[0];
	$table_name = $invoice_no2[1];
	$payment_count = $invoice_no2[2]+1;
	}else{
	$invoice_no = '';
	$invoice_balance='';
	}
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
		} }
	$upload_file=$_FILES['upload_file']['name'];
	$upload_file_temp=$_FILES['upload_file']['tmp_name'];	
	$path="../../documents/upload_file/".$folder_id;
    mkdir($path, 0755, true);
	move_uploaded_file($upload_file_temp,$path."/".$upload_file);
	$select_table = "select s_no from sales_invoice_info where invoice_no='$invoice_no' and company_code='$company_code'";
	$run = mysql_query($select_table);
	$fetchrow = mysql_fetch_array($run);
	 $s_no = $fetchrow['s_no'];
	 $quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount,cheque_status,company_name,company_code)
    values('$bank_s_no','$customer_id','$date','$invoice_total_paid','$reference','Cash','$remark','$cash_transaction_type','$upload_file','$folder_id','$bank_account_type','$bank_name','$invoice_no','$invoice_balance','Cleared','$company_name','$company_code')";
	$update_sales_table = "update purchase_invoice_info set invoice_payment_mode='$bank_s_no' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$select_payment_mode = "select bank_account_type from bank_or_credit_card_info where s_no='$bank_s_no' and company_code='$company_code'";
	$run_q = mysql_query($select_payment_mode);
	$fetchdata = mysql_fetch_array($run_q);
	$bank_account_name = $fetchdata['bank_account_type'];
	$update_sales_table = "update purchase_invoice_info set invoice_payment_mode='$bank_account_type' where s_no='$s_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$quer1="update invoice_no set folder_id='$folder_id' and company_code='$company_code'";
	mysql_query($quer1);
	if($invoice_no1!=''){
	echo $quer12="update $table_name set payment_count='$payment_count',invoice_due_amount='$invoice_balance',invoice_total_paid='$previous_invoice_total_paid' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($quer12);
	}
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Added');</script>";
    echo "<script>window.open('invoice_payment_add.php','_self');</script>"; } }
?>
		<!-- ORDERS -->
		<div id="order" class="tab-pane fade">
		<form role="form" method="post" enctype="multipart/form-data">   			
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
                 <a href="#"><i class="fa fa-times" style="margin-left:100%;color:black"></i>
				    </a>
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
                    <label class="col-sm-5 control-label" style="text-align:left;">Customer/Vendor </label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="customer_id" style="width:100%" onchange="customer_vendor(this.value,<?php echo $company_code; ?>,'Advance')" required>
						<option value="">Select</option>
						<?php
						 $select_advance_sales = "select * from purchase_invoice_info where invoice_status='Active' and invoice_due_amount>0 and invoice_status2='Order' and company_code='$company_code' group by invoice_no";
						  $run = mysql_query($select_advance_sales);
						  while($fetchrow = mysql_fetch_array($run))
						  {
						 $contact_firm_name=$fetchrow['invoice_firm_name'];
						 $que="select * from contact_master where contact_status='Active' and s_no='$contact_firm_name'";
						$run2=mysql_query($que);
						$row=mysql_fetch_array($run2);
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
          				$contact=$contact_company_name.' ('.$contact_contact_type.')';	?>
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
                        <select class="form-control select2" name="invoice_no" id="invoice_details2" style="width:100%" onchange='for_balance(this.value,<?php echo $company_code; ?>,"Order");'>
						<option value="">Select</option>
						</select>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Balance Amount</label>
                    <div class="col-sm-7">
                      <input type="text" name="balance_amount" placeholder="Balance" id="balance_amount2" class="form-control" readonly />
                      <input type="hidden" name="invoice_paid_amount" placeholder="Paid Amount" id="invoice_paid_amount2" class="form-control" value="0" readonly />
                    </div>
                    </div>
                    </div>        
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Amount</label>
                    <div class="col-sm-7">
                       <input type="text" name="total_amount" id="total_amount2" value="" Placeholder="Amount" class="form-control" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group" id="transaction_hide2">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Transaction Type</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="cash_transaction_type" style="width:100%" id="transaction_type2" required>
					  <option value="Credit" selected>Credit</option>
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
                    <label class="col-sm-5 control-label" style="text-align:left;">Discription</label>
                    <div class="col-sm-7">
                       <input type="text" name="remark" value="" placeholder="Discription" class="form-control">
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
			        <input type="submit" name="Save2" value="Save" class="btn btn-primary my_background_color"><br/>
		            </div>
					<div class="col-sm-3">	
			        <a href="#"><button type="button" class="btn btn-primary">Cancel</button></a>
		            </div>
		            </div>	
			    </div>
	            </tbody>				
                </table>
                </div>	
	       <!-----------------------------------Expence Details Start----------------------------------->		   
				<div class="col-md-8 box-body table-responsive">
                <table id="example4" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Referance</th>				  
				  <th>Customer Name</th>
				  <th>Mode Of Payment</th>
				  <th>Amount</th>
				  <th>Due Amount</th>
                </tr>
                </thead>
				<tbody>				
				<?php				
				$que="select * from purchase_invoice_info where invoice_due_amount>0 and invoice_status='Active' and company_code='$company_code' and invoice_status2='Order' GROUP BY invoice_no";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['invoice_reference'];
				$invoice_no = $row['invoice_no'];
				$invoice_grand_total = $row['invoice_grand_total'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$invoice_due_amount = $row['invoice_due_amount'];
				$invoice_firm_name = $row['invoice_firm_name'];
				$transaction_type = $row['transaction_type'];
				$account_name = $row['account_name'];
				$cheque_dd = $row['cheque_dd'];
				$cheque_dd_no = $row['cheque_dd_no'];
				$invoice_payment_mode = $row['invoice_payment_mode'];
				if(empty($invoice_payment_mode))
				{
				 $invoice_payment_mode = "No Payment";
				}
				$remark = $row['remark'];
				$date1 = $row['invoice_date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];				 
				$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $reference; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
				  <th><?php echo $invoice_payment_mode; ?></th>
				  <th><?php echo $invoice_grand_total; ?></th>
				  <th><?php echo $invoice_due_amount; ?></th>
				  <?php } } ?>
				</tr>					
				</tbody>
				
                </table>
                </div>
  		 </form>
		</div>
		<?php
	if(isset($_POST['Save2'])){
	$customer_id = $_POST['customer_id'];
	$bank_s_no = $_POST['bank_s_no'];
	$cash_transaction_type = $_POST['cash_transaction_type'];
	$date = $_POST['date'];
	$reference = $_POST['reference'];
	$remark = $_POST['remark'];
	$invoice_total_paid = $_POST['total_amount'];
	$invoice_paid_amount = $_POST['invoice_paid_amount'];
	$balance_amount = $_POST['balance_amount'];
	$previous_invoice_total_paid=$invoice_paid_amount+$invoice_total_paid;
	$invoice_no1 = $_POST['invoice_no'];
	if($invoice_no1!=''){
	 $invoice_balance=$balance_amount-$invoice_total_paid;
	$invoice_no2 = explode('|?|',$invoice_no1);
	$invoice_no = $invoice_no2[0];
	$table_name = $invoice_no2[1];
	$payment_count = $invoice_no2[2]+1;
	}else{
	$invoice_no = '';
	$invoice_balance='';
	}
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
		} }
	$upload_file=$_FILES['upload_file']['name'];
	$upload_file_temp=$_FILES['upload_file']['tmp_name'];	
	$path="../../documents/upload_file/".$folder_id;
    mkdir($path, 0755, true);
	move_uploaded_file($upload_file_temp,$path."/".$upload_file);
	$select_table = "select s_no from purchase_invoice_info where invoice_no='$invoice_no' and company_code='$company_code'";
	$run = mysql_query($select_table);
	$fetchrow = mysql_fetch_array($run);
	 $s_no = $fetchrow['s_no'];
	 $quer="insert into account_info(bank_s_no,customer_id,date,invoice_total_paid,reference,payment_mode,remark,transaction_type,upload_file,folder_name,account_type,account_name,invoice_no,invoice_due_amount,cheque_status,company_name,company_code)
    values('$bank_s_no','$customer_id','$date','$invoice_total_paid','$reference','Cash','$remark','$cash_transaction_type','$upload_file','$folder_id','$bank_account_type','$bank_name','$invoice_no','$invoice_balance','Cleared','$company_name','$company_code')";
	$update_sales_table = "update sales_invoice_info set invoice_payment_mode='$bank_s_no' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$select_payment_mode = "select bank_account_type from bank_or_credit_card_info where s_no='$bank_s_no' and company_code='$company_code'";
	$run_q = mysql_query($select_payment_mode);
	$fetchdata = mysql_fetch_array($run_q);
	$bank_account_name = $fetchdata['bank_account_type'];
	$update_sales_table = "update purchase_invoice_info set invoice_payment_mode='$bank_account_type' where s_no='$s_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$quer1="update invoice_no set folder_id='$folder_id' and company_code='$company_code'";
	mysql_query($quer1);
	if($invoice_no1!=''){
	echo $quer12="update $table_name set payment_count='$payment_count',invoice_due_amount='$invoice_balance',invoice_total_paid='$previous_invoice_total_paid' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($quer12);
	}
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Added');</script>";
    echo "<script>window.open('invoice_payment_add.php','_self');</script>"; } }
?>
		<!-- END -->
		
		</div>
		</div>
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
<script>
  $(function () {
    $('#example3').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
   $(function () {
    $('#example4').DataTable()
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
