<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Sales Invoice List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('sales/new_invoice')"><i class="fa fa-plus"></i> Add Invoice</a></li>
        <li class="active"><i class="fa fa-list"></i> Sales Invoice List</li>
      </ol>
    </section>
	
<script type="text/javascript">
   function search(value){
               
       $.ajax({
			  type: "POST",
              url: software_link+"sales/invoice_search.php?search_by="+value+"",
              cache: false,
              success: function(detail){
			      //alert(detail);  
            $('#search_table').html(detail);
              }
           });
    }
	
	function change_status(value)
	{
	   var inv_id = document.getElementById('payment_invoice_no2').value;
	   $.ajax({
			  type: "POST",
              url: software_link+"sales/ajax_get_status.php?inv_id="+inv_id+"&value="+value+"",
              cache: false,
              success: function(detail){
			   if(detail==1){
				   post_content('sales/sales_invoice_list','inv_id='+inv_id');
			   }
              }
           });
	}
	function recuring_type(value)
	{
		    $.ajax({
			  type: "POST",
              url: software_link+"sales/ajax_requring_invoice.php?sales_invoice="+value+"",
              cache: false,
              success: function(detail){
             $('#search_table').html(detail);
              }
           });
		
	}
</script>

<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete this Record !!!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}

function for_payment(sno){
var inv_no=document.getElementById('invoice_no_'+sno).value;
var inv_type=document.getElementById('invoice_type_'+sno).value;
	$.ajax({
		address: "POST",
		url: software_link+"sales/ajax_get_payment_detail.php?inv_no="+inv_no+"&inv_type="+inv_type+"",
		cache: false,
		success: function(detail){
		var res = detail.split("|?|");
		if(res[1]>0){
		$('#payment_invoice_no').val(inv_no);
		$('#payment_total_amount').val(res[0]);
		$('#payment_mode').val(res[1]);
		
		if(res[1]==1){
		$('#for_remark').show();
		$('#remark').val(res[3]);
		$('#for_paid_amount').show();
		$('#paid_amount').val(res[2]);
		$('#for_account_type').hide();
		$('#account_type').val('');
		$('#for_account_name').hide();
		$('#account_name').val('');
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('');
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('');
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('');
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('');
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('');
		}else if(res[1]==2){
		$('#for_remark').show();
		$('#remark').val(res[3]);
		$('#for_account_type').show();
		$('#account_type').val(res[4]);
		$('#for_account_name').show();
		$('#account_name').val(res[5]);
		$('#for_cheque_dd').show();
		$('#cheque_dd').val(res[6]);
		$('#for_cheque_dd_no').show();
		$('#cheque_dd_no').val(res[7]);
		$('#for_cheque_dd_amount').show();
		$('#cheque_dd_amount').val(res[8]);
		$('#for_cheque_dd_issue_date').show();
		$('#cheque_dd_issue_date').val(res[9]);
		$('#for_cheque_dd_clearing_date').show();
		$('#cheque_dd_clearing_date').val(res[10]);
		$('#for_paid_amount').show();
		$('#paid_amount').val(res[2]);
		}else if(res[1]==3 || res[1]==4 || res[1]==5){
		$('#for_remark').show();
		$('#remark').val(res[3]);
		$('#for_paid_amount').show();
		$('#paid_amount').val(res[2]);
		$('#for_account_type').show();
		$('#account_type').val(res[4]);
		$('#for_account_name').show();
		$('#account_name').val(res[5]);
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('');
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('');
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('');
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('');
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('');
		}
		}else{
		$('#payment_invoice_no').val(inv_no);
		$('#payment_total_amount').val(res[0]);
		
		$('#payment_mode').val('');
		$('#for_remark').hide();
		$('#remark').val('');
		$('#for_account_type').hide();
		$('#account_type').val('');
		$('#for_account_name').hide();
		$('#account_name').val('');
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('');
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('');
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('');
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('');
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('');
		$('#for_paid_amount').hide();
		$('#paid_amount').val('');
		}
		}
	});
}

// this code is use for hide and show payment detail -----START-----
  function payment_detail(value){
  if(value!=''){
	$.ajax({
		address: "POST",
		url: software_link+"sales/get_payment_details.php?id="+value+"",
		cache: false,
		success: function(detail){
		var res = detail.split("|?|");
		var myvar=res[0];
		var myvar1=res[1];
		if(parseInt(value)==3 || parseInt(value)==4){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_paid_amount').show();
		$('#paid_amount').val('').prop('required',true);
		
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}else if(parseInt(value)==5){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_paid_amount').show();
		$('#paid_amount').val('').prop('required',true);
		
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}else if(parseInt(value)==2){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_cheque_dd').show();
		$('#cheque_dd').val('').prop('required',true);
		$('#for_cheque_dd_no').show();
		$('#cheque_dd_no').val('').prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_paid_amount').show();
		$('#paid_amount').val('').prop('required',true);
		$('#for_cheque_dd_amount').show();
		$('#cheque_dd_amount').val('').prop('required',true);
		$('#for_cheque_dd_issue_date').show();
		$('#cheque_dd_issue_date').val('').prop('required',true);
		$('#for_cheque_dd_clearing_date').show();
		$('#cheque_dd_clearing_date').val('').prop('required',true);
		}else if(parseInt(value)==1){
		$('#for_account_type').hide();
		$('#account_type').val('').prop('required',false);
		$('#for_account_name').hide();
		$('#account_name').val('').prop('required',false);
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_paid_amount').show();
		$('#paid_amount').val('').prop('required',true);
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}
		}
	});
  }else{
	$('#for_account_type').hide();
	$('#account_type').val('').prop('required',false);
	$('#for_account_name').hide();
	$('#account_name').val('').prop('required',false);
	$('#for_cheque_dd').hide();
	$('#cheque_dd').val('').prop('required',false);
	$('#for_cheque_dd_no').hide();
	$('#cheque_dd_no').val('').prop('required',false);
	$('#for_remark').hide();
	$('#remark').val('');
	$('#for_paid_amount').hide();
	$('#paid_amount').val('').prop('required',false);
	$('#for_cheque_dd_amount').hide();
	$('#cheque_dd_amount').val('').prop('required',false);
	$('#for_cheque_dd_issue_date').hide();
	$('#cheque_dd_issue_date').val('').prop('required',false);
	$('#for_cheque_dd_clearing_date').hide();
	$('#cheque_dd_clearing_date').val('').prop('required',false);
  }
  }
  // this code is use for hide and show payment detail -----END-----

</script>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <!-- /.box -->
 <?php if(empty($_GET['inv_id'])){ ?>     
        <div class="box">
            <div class="box-header">
				  <div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "Invoice type" ?></label>
					  <select name="ledger_month" id="sales_type" onchange="recuring_type(this.value);" class="form-control select2" style="width:100%">
					  <option value="all" selected>All</option>
					  <option value="This Weeks">This Weeks</option>
					  <option value="Month">Month</option>
					  <option value="3 Weeks">3 Weeks</option>
					  <option value="Custom Dates">Custom Dates</option>
					  <option value="Expired">Expired</option>
					  </select>
				 </div>
			    </div>
<a href="javascript:get_content('sales/new_recuring_invoice')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>
		</div>
            <!-- /.box-header -->
			<form method="post" enctype="multipart/form-data">
            <div class="box-body table-responsive" id="search_table">
			<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Invoice No</th>
                  <th>Order No</th>
				  <th>Customer Name</th>
				  <th>Invoice Status</th>
                  <th>Due Date</th>
                  <th>Amount</th>
				  <th>Due Balance</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody >
<?php
	$que="select * from sales_invoice_info where invoice_status='Active' and invoice_status2='Recuring' and company_code='$company_code' GROUP BY invoice_no";
	$run=mysql_query($que) or die(mysql_error());
	$serial_no=0;
	while($row=mysql_fetch_array($run)){
	$s_no=$row['s_no'];
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_due_date1=$row['invoice_due_date'];
	$invoice_due_date2=explode('-',$invoice_due_date1);
	$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$invoice_order_no=$row['invoice_order_no'];
	$invoice_type=$row['invoice_type'];
	$invoice_status=$row['invoice_status'];
	$invoice_status2 = $row['invoice_status2'];
	$serial_no++;
	$que1="select * from contact_master where s_no='$invoice_firm_name'";
	$run1=mysql_query($que1) or die(mysql_error());
	$row1=mysql_fetch_array($run1);
	$contact_company_name=$row1['contact_company_name'];
	$contact_tittle_name=$row1['contact_tittle_name'];
	$contact_first_name=$row1['contact_first_name'];
	$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center'>
	<th><?php echo $invoice_date; ?></th>
	<th><a href="post_content('sales/recuring_invoice','inv_no=<?php echo $invoice_no; ?>');"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $invoice_order_no; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><a href="javascript:post_content('sales/recuring_invoice','inv_no=<?php echo $invoice_no; ?>&inv_type=sales');"><?php echo $invoice_status2; ?></a></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	 <th>
	<center>
   <a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href="javascript:post_content('sales/recuring_delete_api','inv_no=<?php echo $invoice_no; ?>"> Delete</a>
	</center>
</th>
</tr>
<?php } ?>
		</tbody>
            
            </table> 
			
            </div>
			<th colspan="2"><input type="submit" name="download" value="Download all data as Excel" style="float:right; background-color:#00a65a;color:#fff;border:30px;padding: 7px;font-size:12px;"></th>
			
			</form>
            <!-- /.box-body -->
          </div>
		  <?php } ?>
		  <!--single invoice-->
<?php if(isset($_GET['inv_id'])){
     $inv_id = $_GET['inv_id'];  
?>
    <div class="box">
            <div class="box-header">
				<div class="col-lg-3">
            
				</div>
			
			<a href="javascript:post_content('sales/new_invoice','inv_type=sales' ?>"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>
			
		</div>
			
            <!-- /.box-header -->
			<form method="post" enctype="multipart/form-data">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Invoice No</th>
                  <th>Order No</th>
				  <th>Customer Name</th>
				  <th>Invoice Status</th>
                  <th>Due Date</th>
                  <th>Amount</th>
				  <th>Due Balance</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
$que="select * from sales_invoice_info where invoice_status='Active' AND invoice_no='$inv_id' and invoice_status2='Recuring' and company_code='$company_code'";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$invoice_date1=$row['invoice_date'];
		$invoice_date2=explode('-',$invoice_date1);
		$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
		$invoice_no=$row['invoice_no'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_due_date1=$row['invoice_due_date'];
		$invoice_due_date2=explode('-',$invoice_due_date1);
		$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_due_amount=$row['invoice_due_amount'];
		$invoice_order_no=$row['invoice_order_no'];
		$invoice_type=$row['invoice_type'];
		$invoice_status=$row['invoice_status'];
		$invoice_status2 = $row['invoice_status2'];
	$serial_no++;
	
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_company_name=$row1['contact_company_name'];
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
$que2="delete * from contact_master where invoice_no='$invoice_no'";
$run2=mysql_query($que2) or die(mysql_error());
?>

<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><a href="javascript:post_content('sales/recuring_invoice','inv_id=<?php echo $invoice_no; ?>')"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $invoice_order_no; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><a href='#' ><?php echo $invoice_status2 ?></a></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	
<th>
	<center>
	<input type="hidden" id="<?php echo "invoice_no_".$serial_no; ?>" value="<?php echo $invoice_no; ?>" />
    <input type="hidden" id="<?php echo "invoice_type_".$serial_no; ?>" value="<?php echo $invoice_type; ?>" />
	
	<a style="color:#555D70;" aria-hidden="true" class="fa fa-hand-o-right" href="javascript:post_content('sales/sales_recuring_invoice','inv_no=<?php echo $invoice_no; ?>&inv_type=sales')"><span> Recuring </span></a> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="javascript:post_content('sales/recuring_invoice_edit','invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>')"> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href="javascript:post_content('../../invoice_pdf/shree_lakshya','invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>')"> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='sales_recuring_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'> Delete</a>
	</center>
</th>
</tr>
<?php } ?>
		</tbody>
            
            </table> 
            </div>
			<?php if(empty($_GET['inv_id'])){ ?>
		<th colspan="2"><input type="submit" name="download" value="Download all data as Excel" style="float:right; background-color:#00a65a;color:#fff;border:30px;padding: 7px;font-size:12px;"></th>
			<?php } ?>
			</form>
            <!-- /.box-body -->
          </div>
<?php } ?>		  
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <form method="post" enctype="multipart/form-data">
  <!-- Modal Start -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment Info</h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
			<div class="col-md-6">
			<label>Invoice No</label>
			<input type="text" name="payment_invoice_no" id="payment_invoice_no" class="form-control" placeholder="Invoice" readonly />
			</div>
			<div class="col-md-6">
			<label>Total Amount</label>
			<input type="text" name="payment_total_amount" id="payment_total_amount" class="form-control" placeholder="Amount" readonly />
			</div>
		  </div>
		  <div class="col-md-12">
			<div class="col-md-6">
			<label>Payment Mode</label>
			<select name="payment_mode" id="payment_mode" onchange="payment_detail(this.value);" class="form-control" required >
			<option value="">Select</option>
			<?php
			$query4="select * from bank_or_credit_card_info where bank_status='Active' and company_code='$company_code'";
			$res4=mysql_query($query4);
			while($row4=mysql_fetch_array($res4)){
			$s_no=$row4['s_no'];
			$bank_account_type=$row4['bank_account_type'];
			$bank_account_name=$row4['bank_account_name'];
			$credit_card_account_name=$row4['credit_card_account_name'];
			$payment_method=$bank_account_type.'['.$bank_account_name.']';
			if($bank_account_type=='Credit_Card'){
			$payment_method=$bank_account_type.'['.$credit_card_account_name.']';
			}
			if($bank_account_name=='Undeposited Funds'){
			$payment_method='Cheque/DD';
			}
			?>
			<option value="<?php echo $s_no; ?>"><?php echo $payment_method; ?></option>
			<?php
			}
			?>
			</select>
			</div>
			<div class="col-md-6" id="for_remark" style="display:none;">
			<label > Remarks </label>
			<input type="text" name="remark" id="remark" placeholder="Remarks" value="" class="form-control" />
			</div>
		  
			<div class="col-md-6" id="for_account_type" style="display:none;">
			<label > Account Type </label>
			<input type="text" name="account_type" id="account_type" value="" class="form-control" readonly />
			</div>
			<div class="col-md-6" id="for_account_name" style="display:none;">
			<label > Account Name </label>
			<input type="text" name="account_name" id="account_name" value="" class="form-control" readonly />
			</div>
		  
			<div class="col-md-6" id="for_cheque_dd" style="display:none;">
			<label > Cheque / DD </label>
			<select name="cheque_dd" id="cheque_dd" class="form-control">
			<option value="">Select</option>
			<option value="Cheque">Cheque</option>
			<option value="DD">DD</option>
			</select>
			</div>
			<div class="col-md-6" id="for_cheque_dd_no" style="display:none;">
			<label ><small> Cheque / DD No </small></label>
			<input type="text" name="cheque_dd_no" id="cheque_dd_no" placeholder="Cheque / DD No" value="" class="form-control" />
			</div>
		  
			<div class="col-md-6" id="for_cheque_dd_amount" style="display:none;">
			<label > Cheque / DD Amount </label>
			<input type="number" name="cheque_dd_amount" id="cheque_dd_amount" placeholder="Amount"  value="" class="form-control" />
			</div>
			<div class="col-md-6" id="for_cheque_dd_issue_date" style="display:none;">
			<label > Cheque / DD Issue Date </label>
			<input type="date" name="cheque_dd_issue_date" id="cheque_dd_issue_date" placeholder="Issue Date" value="" class="form-control" />
			</div>
		  
			<div class="col-md-6" id="for_cheque_dd_clearing_date" style="display:none;">
			<label > Cheque / DD Clearing Date </label>
			<input type="date" name="cheque_dd_clearing_date" id="cheque_dd_clearing_date" placeholder="Clearing Date" value="" class="form-control" />
			</div>
			<div class="col-md-6" id="for_paid_amount" style="display:none;">
			<label > Paid Amount </label>
			<input type="number" name="paid_amount" id="paid_amount" placeholder="Paid Amount" value="" class="form-control" />
			</div>
		  </div>
        </div>
        <div class="modal-footer">
		  <input type="submit" class="btn my_background_color" name="submit" value="Submit" />
		  &nbsp;&nbsp;
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal End -->
  </form>
  
  <form method="post" enctype="multipart/form-data">
  <!-- Modal Start -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Invoice Status</h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
			<div class="col-md-6">
			<label>Invoice No</label>
			<input type="text" name="payment_invoice_no" id="payment_invoice_no2" class="form-control" placeholder="Invoice" value="<?php if(isset($_GET['inv_id'])){ echo $inv_id; }?>" readonly />
			</div>
			<div class="col-md-6">
			<label>Update Status</label>
			
			<select name="status" id="status" class="form-control" onchange="change_status(this.value);">
	<?php 
		$select = "select invoice_status2 from sales_invoice_info where invoice_no='$invoice_no' and company_code='$company_code' group by invoice_no"; 
		 $run = mysql_query($select);
		 $fetchrow = mysql_fetch_row($run);
		 ?>
		<option value="<?php echo $fetchrow[0]; ?>" selected><?php echo $fetchrow[0]; ?></option>
	  <option value="Approved"<?php if($fetchrow[0] == 'Approved'){ echo"selected";} ?>>Approved</option>
	  <option value="Void"<?php if($fetchrow[0] == 'Void'){ echo"selected";} ?>>Void</option>
      <option value="Debit Note"<?php if($fetchrow[0] == 'Debit Note'){ echo"selected";} ?>>Debit Note</option>
			    </select>
			</div>
			
		  </div>
		         </div>
        <div class="modal-footer">
		  
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal End -->
  </form>
	
<?php
if(isset($_POST['download'])){
echo "<script>window.open('download_all_item_as_a_excel_sheet.php','_self');</script>";
}	
?>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<?php
if(isset($_POST['submit'])){
$invoice_due_amount=0;
$payment_invoice_no=$_POST['payment_invoice_no'];
$payment_total_amount=$_POST['payment_total_amount'];
$payment_mode=$_POST['payment_mode'];
$remark=$_POST['remark'];
$account_type=$_POST['account_type'];
$account_name=$_POST['account_name'];
$cheque_dd=$_POST['cheque_dd'];
$cheque_dd_no=$_POST['cheque_dd_no'];
$cheque_dd_amount=$_POST['cheque_dd_amount'];
$cheque_dd_issue_date=$_POST['cheque_dd_issue_date'];
$cheque_dd_clearing_date=$_POST['cheque_dd_clearing_date'];
$paid_amount=$_POST['paid_amount'];
$invoice_due_amount=$payment_total_amount-$paid_amount;
if($payment_mode==3 || $payment_mode==4 || $payment_mode==5){
$payment_mode1='Neft';
}elseif($payment_mode==2){
if($cheque_dd=='Cheque'){
$payment_mode1='Cheque';
}else{
$payment_mode1='DD';
}
}elseif($payment_mode==1){
$payment_mode1='Cash';
}

if($payment_mode1=='Cheque' or $payment_mode1=='DD'){
$cheque_status='Uncleared';
}else{
$cheque_status='Cleared';
}
if($payment_total_amount == $paid_amount)
 {
  $status = "Paid Invoice";  
 }
 if($payment_total_amount>$paid_amount)
 {
  $status = "Partially Paid";
 }
 $quer="update account_info set payment_mode='$payment_mode1',bank_s_no='$payment_mode',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',invoice_total_paid='$paid_amount',invoice_due_amount='$invoice_due_amount',cheque_status='$cheque_status' where invoice_no='$payment_invoice_no' and company_code='$company_code'";
if(mysql_query($quer)){
$quer1="update sales_invoice_info set invoice_payment_mode='$payment_mode',invoice_total_paid='$paid_amount',remark='$remark',invoice_due_amount='$invoice_due_amount',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',invoice_status2 ='$status' where invoice_no='$payment_invoice_no' and company_code='$company_code'";
if(mysql_query($quer1)){
echo "<script>window.open('sales_invoice_list.php', '_self');</script>";
} } }
?>