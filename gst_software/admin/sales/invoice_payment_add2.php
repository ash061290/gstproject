<?php 
include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Payment By Cash
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="#"><i class="fa fa-list"></i>Payment Details</a></li>
        <li class="active">Add Cash Details</li>
      </ol>
    </section>
	
<!-- Main content -->
	
<script>
	function myFunction(value)
			{
			  $.ajax({
			   type:"POST",
			   url:software_link+"sales/all_delete.php?advance_payment_delete="+value+"",
			   cache:false,
			   success:function(detail)
			   {
			    if(detail==1)
				{
			
				 window.open('sales/advance_pay_add','_self');
				}
			   }
			   })
			}
			function draft_invoice(value){
				 $.ajax({
			  type: "POST",
              url: software_link+"sales/ajax_customer_wise_invoice_details2.php?customer_id2="+value+"",
              cache: false,
              success: function(detail){
                   var str =detail;
				   $("#invoice_details").html(str); 
				   $("#balance_amount").val('');
				   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
              }
            });
			}
function inv_type3(value)
	{
		var value = value;
		  $.ajax({
			  type: "POST",
              url: software_link+"sales/payment_type_filter.php",
			  data:"payment_type="+value,
              cache: false,
              success: function(detail){
				  alert(detail);
             $('#search_table').html(detail);
			 var invoice_type3 = document.getElementById("inv_type2").value;
			   inv_cust3(invoice_type3);
              }
           })
	  
	}
	function inv_cust3(value)
	{
		$.ajax({
			    type:"POST",
				url:software_link+"sales/payment_type_filter2.php",
				data:"payment_type="+value,
				cache:false,
				success: function(detail){
				         $('#customer_sel2').html(detail); 
				}
		})
	}
</script>
<script>
    $(document).ready(function(){
	   var status = document.getElementById('inv_type2').value;
	   inv_type3(status);
	 });
 </script>
 <script>
        function customer_vendor(value){    
            $.ajax({
			  type: "POST",
              url: software_link+"sales/ajax_customer_wise_invoice_details.php?customer_id="+value+"",
              cache: false,
              success: function(detail){
                   var str =detail;		
				   $("#invoice_details").html(str); 
				   $("#balance_amount").val('');
				   $("#transaction_type").html("<option value=''>Select</option><option value='Credit'>Credit</option><option value='Debit'>Debit</option>");
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
			      <form method="post" class="gorm-horizontal">
				     <div class="col-md-12">
					   <div class="col-md-4"></div>
					   <div class="col-md-4">
				      <center><div class="form-group">
                       <h4>Select Invoice Type :</h4>
                            <select name="inv_type" class="form-control select2" id="inv_type2" onchange="inv_type3(this.value)" style="width:100%;">
								    <option value="Invoiced" selected>Primary Invoice</option>
									<option value="Retainer">Retainer Invoice</option>
									<option value="Recuring">Recuring Invoice</option>
									<option value="Advance">Advance Invoice</option>
								  </select>  							  
					   </div>
					   </center>
					   </div>
					   <div class="col-md-4"></div>
					   </div>
				   </form>
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
                        <select class="form-control select2" name="invoice_no" id="invoice_details" style="width:100%" onchange='for_balance(this.value);'>
						<option value="">Select</option>
						</select>
                    </div>
                    </div>
                    </div>

					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Balance Amount</label>
                    <div class="col-sm-7">
                      <input type="text" name="balance_amount" placeholder="Balance" id="balance_amount" class="form-control" />
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
	       <!-----------------------------------Expence Details Start----------------------------------->		   
				<div class="col-md-8 box-body table-responsive" id="search_table">
                </div>
		</div>
	    </form>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
    </div>
</section> 
</body>
</html>
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
		}
		}
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
    values('$bank_s_no','$customer_id','$date','$invoice_total_paid','$reference','Cash','$remark','$cash_transaction_type','$upload_file','$folder_id','$bank_account_type','$bank_name','$invoice_no','$invoice_balance','$cheque_status','$company_name','$company_code')";
	$update_sales_table = "update sales_invoice_info set invoice_payment_mode='$bank_s_no' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$select_payment_mode = "select bank_account_type from bank_or_credit_card_info where s_no='$bank_s_no' and company_code='$company_code'";
	$run_q = mysql_query($select_payment_mode);
	$fetchdata = mysql_fetch_array($run_q);
	$bank_account_name = $fetchdata['bank_account_type'];
	$update_sales_table = "update sales_invoice_info set invoice_payment_mode='$bank_account_type' where s_no='$s_no' and company_code='$company_code'";
	mysql_query($update_sales_table);
	$quer1="update invoice_no set folder_id='$folder_id' where company_code='$company_code'";
	mysql_query($quer1);
	if($invoice_no1!=''){
	echo $quer12="update $table_name set payment_count='$payment_count',invoice_due_amount='$invoice_balance',invoice_total_paid='$previous_invoice_total_paid' where invoice_no='$invoice_no' and company_code='$company_code'";
	mysql_query($quer12);
	}
    if(mysql_query($quer)){
	 echo "<script>alert('Successfully Added');</script>";
     echo "<script>window.open('sales/payment_received','_self');</script>";
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
