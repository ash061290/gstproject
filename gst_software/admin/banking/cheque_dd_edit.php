<?php
include("../../attachment/session.php");
  	  ?>
    <section class="content-header">
      <h1>
       Payment By Cheque/DD Edit
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/cheque_dd_details')"><i class="fa fa-list"></i>Cheque/DD Details</a></li>
        <li class="active">Edit Cheque/DD</li>
      </ol>
    </section>
<script>
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
            });

            } 
			

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
    <?php
	$account_s_no=$_GET['id'];
    $que11="select * from account_info where s_no='$account_s_no' and company_code='$company_code'";
    $run11=mysql_query($que11) or die(mysql_error());
    while($row11=mysql_fetch_array($run11)){
	$account_s_no=$row11['s_no'];
    $bank_s_no=$row11['bank_s_no']; 
    $customer_id=$row11['customer_id']; 
    $date=$row11['date']; 
    $invoice_total_paid=$row11['invoice_total_paid']; 
    $invoice_total_paid1=$row11['invoice_total_paid']; 
    $reference=$row11['reference']; 
    $payment_mode=$row11['payment_mode']; 
    $cheque_dd=$row11['cheque_dd']; 
    $cheque_dd_no=$row11['cheque_dd_no']; 
    $cheque_dd_issue_date=$row11['cheque_dd_issue_date']; 
    $cheque_dd_clearing_date=$row11['cheque_dd_clearing_date']; 
    $remark=$row11['remark']; 
    $transaction_type=$row11['transaction_type']; 
    $upload_file=$row11['upload_file']; 
    $folder_name=$row11['folder_name']; 
    $account_type=$row11['account_type']; 
    $account_name=$row11['account_name']; 
    $invoice_no=$row11['invoice_no']; 
    $invoice_due_amount=$row11['invoice_due_amount'];

    if($transaction_type=='Credit'){
    $table='sales_invoice_info';
	}else{
	$table='purchase_invoice_info';
	}
	if($invoice_no!=''){		
	$que22="select * from $table where invoice_no='$invoice_no' and company_code='$company_code'";
    $run22=mysql_query($que22) or die(mysql_error());
    while($row22=mysql_fetch_array($run22)){
    $purchase_sale_total_paid=$row22['invoice_total_paid'];
    $purchase_sale_due_amount=$row22['invoice_due_amount'];
    }
    } else {
	$purchase_sale_total_paid=0;
	$purchase_sale_due_amount=0;
	}

	$path="../../documents/upload_file/".$folder_name;
    }
	?>
<script>
    $("#cheque_edit").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: software_link+"banking/cheque_dd_edit_api.php",
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
				   post_content('banking/cheque_dd_add',res[2]);
            }
			}
         });
      });
</script>

 <script src="http://localhost:8080/core/html/attachment/assets/js/file_check.js"></script>
<section class="content">

      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <div class="col-xs-12">
    <div class="box my_border_top">
        <div class="box-body">
		<form role="form" method="post" id="cheque_edit" enctype="multipart/form-data">
              			
				<div class="col-md-4 box-body table-responsive" style="background-color:#F2F3F4">
                <table id="" class="table table-bordered table-striped">
                <thead class="">
                </thead>										
		        <tbody>
			    <div class="col-sm-12 form-horizontal">	
                    <div class="col-sm-12">
					<div class="col-sm-6">
                    <h5 style="color:#873600"><b>Edit Cheque/DD</b></h5>
                    </div>
                    </div>

                    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Account Name</label>
                    <div class="col-sm-7">
					<select class="form-control select2" name="bank_s_no" style="width:100%">
						<option value="<?php echo $bank_s_no; ?>"><?php echo $account_name.'('.$account_type.')'; ?></option>
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
                        <select class="form-control select2" name="customer_id" style="width:100%" onchange="customer_vendor(this.value)">
						<?php
						$que12="select * from contact_master where s_no='$customer_id' and company_code='$company_code'";
						$run12=mysql_query($que12);
						while($row12=mysql_fetch_array($run12)){
						$contact_company_name=$row12['contact_company_name'];				
						$contact_contact_type=$row12['contact_contact_type'];	
          				$contact=$contact_company_name.' ('.$contact_contact_type.')';	
						}
	                    ?>
						<option value="<?php echo $customer_id; ?>"><?php echo $contact; ?></option>
						</select>
                    </div>										
                    </div>
                    </div>
					
					<div class="form-group" style="<?php if($invoice_no==''){ echo "display:none"; } ?>">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Invoice#</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="invoice_no" id="invoice_details" style="width:100%" onchange='for_balance(this.value,<?php echo $company_code; ?>);'>
						<option value="<?php echo $invoice_no ?>"><?php echo $invoice_no ?></option>
						</select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Balance Amount</label>
                    <div class="col-sm-7">
                      <input type="text" name="balance_amount" placeholder="Balance" id="balance_amount" value="<?php echo $invoice_due_amount ?>" class="form-control" readonly />
					  <input type="hidden" name="purchase_sale_total_paid" placeholder="Paid Amount" class="form-control" value="<?php echo $purchase_sale_total_paid ?>" readonly />
					  <input type="hidden" name="purchase_sale_due_amount" placeholder="Paid Amount" class="form-control" value="<?php echo $purchase_sale_due_amount ?>" readonly />
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Date</label>
                    <div class="col-sm-7">
                       <input type="date" name="date" value="<?php echo $date; ?>" class="form-control">
                    </div>
                    </div>
                    </div>
                    
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Amount</label>
                    <div class="col-sm-7">
                       <input type="text" name="total_amount" value="<?php echo $invoice_total_paid; ?>" Placeholder="Amount" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="transaction_hide">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Transaction Type</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="cheque_transaction_type" style="width:100%">
					  <option value="<?php echo $transaction_type; ?>"><?php echo $transaction_type; ?></option>
					  <?php if($invoice_no=='') { ?>
					  <option value="Credit">Credit</option>
					  <option value="Debit">Debit</option>
					  <?php } ?>
					  </select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Refrence</label>
                    <div class="col-sm-7">
                       <input type="text" name="reference" value="<?php echo $reference; ?>" class="form-control">
                    </div>
                    </div>
                    </div>
									
					<div class="form-group" style="display:none">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Payment Mode</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="payment_mode" style="width:100%">
					  <option value="<?php echo $payment_mode; ?>"><?php echo $payment_mode; ?></option>
					  <option value="Cash">Cash</option>
					  <option value="Neft">Neft</option>
					  <option value="Cheque">Cheque</option>
					  <option value="DD">DD</option>
					  </select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Cheque/DD</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="cheque_or_dd" style="width:100%">
					  <option value="<?php echo $cheque_dd; ?>"><?php echo $cheque_dd; ?></option>
					  <option value="Cheque">Cheque</option>
					  <option value="DD">DD</option>
					  </select>
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Cheque/DD No</label>
                    <div class="col-sm-7">
                       <input type="text" name="cheque_dd_no" value="<?php echo $cheque_dd_no; ?>" placeholder="Cheque/DD No" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Cheque/DD Issue Date</label>
                    <div class="col-sm-7">
                       <input type="date" name="cheque_dd_issue_date" value="<?php echo $cheque_dd_issue_date; ?>" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Cheque/DD Clearing Date</label>
                    <div class="col-sm-7">
                       <input type="date" name="cheque_dd_clearing_date" value="<?php echo $cheque_dd_clearing_date; ?>" class="form-control">
                    </div>
                    </div>
                    </div>
					
					<div class="form-group" id="remark">
				    <div class="col-sm-12">
                    <label class="col-sm-5 control-label" style="text-align:left;">Discription</label>
                    <div class="col-sm-7">
                       <input type="text" name="remark" value="<?php echo $remark; ?>" placeholder="Discription" class="form-control">
                    </div>
                    </div>
                    </div>
				          <div class="form-group">
				    <div class="col-sm-12">
				    	 <label class="col-sm-5 control-label" style="text-align:left;">Choose Image</label>
				    	 
                     	<div class="col-md-7">	
				
					  <input type="file" name="upload_file" id="upload_file" placeholder="" onchange="check_file_type(this,'upload_file','show_bill_upload','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					
				</div>
			</div>
		</div>
          <div class="form-group">
            <div class="col-sm-12">
              <div class="col-md-5"></div>
        <div class="col-md-1"> 
		
	     <img  src="<?php if($upload_file!=''){ echo 'data:image;base64,'.$upload_file; }else{ echo "/html/images/Profile.png"; }  ?>" id="show_bill_upload" height="50" width="50" style="margin-top:10px;">
           
          </div>
        </div>
      </div>
	   <input type="hidden" value="<?php echo $account_s_no; ?>" name="account_s_no" />
					<div class="col-sm-12">	
					<div class="col-sm-3">
                    </div>					
					<div class="col-sm-3">	
			        <input type="submit" name="Save" value="Save" class="btn btn-success"><br/>
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
                  <th>Issue Date</th>
                  <th>Clearing Date</th>
                  <th>Cheque/DD No</th>		  
				  <th>Payment Mode</th>
				  <th>Type</th>		
				  <th>Amount</th>
                </tr>
                </thead>
				
				<tbody>	
                <?php 
				$cheque_dd_issue_date1 =$cheque_dd_issue_date;
				$cheque_dd_issue_date2 = explode("-",$cheque_dd_issue_date1);
				$cheque_dd_issue_date=$cheque_dd_issue_date2[2]."-".$cheque_dd_issue_date2[1]."-".$cheque_dd_issue_date2[0];
				$cheque_dd_clearing_date1 = $cheque_dd_clearing_date;
				$cheque_dd_clearing_date2 = explode("-",$cheque_dd_clearing_date1);
				$cheque_dd_clearing_date=$cheque_dd_clearing_date2[2]."-".$cheque_dd_clearing_date2[1]."-".$cheque_dd_clearing_date2[0];
				$date1 = $date;
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];
				?>				
				<tr>
				  <th><?php echo $cheque_dd_issue_date; ?></th>
                  <th><?php echo $cheque_dd_clearing_date; ?></th>
                  <th><?php echo $cheque_dd_no; ?></th>
                  <th><?php echo $payment_mode; ?></th>
                  <th><?php echo $transaction_type; ?></th>				  
                  <th><?php echo $invoice_total_paid; ?></th>
				 
				  <?php  ?>
				</tr>					
				</tbody>
				
                </table>
                </div>
  		
		</div>
	    </form>
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
