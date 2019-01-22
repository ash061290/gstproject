<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Sales Invoice List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:post_content('sales/new_invoice','inv_type=sales')"><i class="fa fa-plus"></i>Add Invoice</a></li>
        <li class="active"><i class="fa fa-list"></i> Sales Invoice List</li>
      </ol>
    </section>


<script>
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
</script>
<script>
function valid(s_no){ 
alert(s_no);
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_sales_invoice(s_no);       
 }            
else  {      
return false;
  }       
} 
  function delete_sales_invoice(s_no){
$.ajax({
type: "POST",
url: software_link+"sales/sales_invoice_delete_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Deleted');
				   get_content('sales/sales_invoice_list');
			   }else{
               alert(detail); 
			   }
}
});
}
</script>
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
					  <select name="ledger_month" id="sales_type" onchange="sales_type(this.value);" class="form-control select2" id="sales_term" style="width:100%">
					  <option value="all" selected>All</option>
					  <option value="sales_order">Sales Order</option>
					  <option value="due_payment">Due Payment</option>
					  <option value="debit_notes">Debit Notes</option>
					  </select>
				 </div>
			    </div>
		<div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "From Date" ?></label>
					  <input type="date" name="from_date" id="from_date" class="form-control" value="" />
				 </div>
			    </div>
		<div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "To Date" ?></label>
					  <input type="date" name="to_date" class="form-control" id="to_date" value="" />
				 </div>
			    </div>
		<div class="col-md-4">
				<div class="form-group" >
	<input type="button" name="pdf" value="Print Pdf" onclick="for_print()" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="excel" value="Print Excel" onclick="exportTableToExcel('example1', 'Inventory Report')" class="btn btn-success">
				 </div>
			    </div>
		<div class="col-md-2 ">
			<a href="javascript:post_content('sales/new_invoice','inv_type=sales')"> <button style="float:right;"  type="button" class="btn btn-success">+ Add New</button></a>
			</div>
		</div>
            <!-- /.box-header -->
			
            <div class="box-body table-responsive" id="search_table">
			<table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                   <th>Date</th>
				   <th>Invoice No</th>
				   <th>Customer Name</th>
				   <th>Invoice Amount</th>
				   <th>Total Paid</th>
                   <th>Due Amount</th>
				   <th>Action</th>
                </tr>
                </thead>
				<tbody >
<?php
$que="SELECT * FROM sales_invoice_new where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no ORDER BY s_no DESC";
	$run=mysql_query($que) or die(mysql_error());
	//$numrow = mysql_num_rows($run);
	$serial_no=0;
	while($row=mysql_fetch_array($run)){
	$s_no=$row['s_no'];
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_total_paid=$row['invoice_total_paid'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$invoice_status = $row['invoice_status'];
	$invoice_reference = $row['invoice_reference'];
	$serial_no++;
	if($invoice_reference == 'Vendors'){
	$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
	$run1=mysql_query($que1) or die(mysql_error());
	//$numrow = mysql_num_rows($run1);
	
	$row1=mysql_fetch_array($run1);
	$contact_company_name=$row1['contact_company_name'];
	$contact_tittle_name=$row1['contact_tittle_name'];
	$contact_first_name=$row1['contact_first_name'];
	$contact_last_name=$row1['contact_last_name'];
	$contact_name = $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name;
	}
	else if($invoice_reference == 'Customers'){
	 $que2="select * from contact_new where customer_id='$invoice_firm_name' and company_code='$company_code'";
	$run2=mysql_query($que2) or die(mysql_error());
	$fetchr = mysql_fetch_array($run2);
    $contact_name = $fetchr['customer_name'];
    $contact_mobile = $fetchr['customer_mobile'];
    $contact_name = $contact_name."[".$contact_mobile."]";	
	}
?>
<tr  align='center'>
	<th><?php echo $invoice_date; ?></th>
	<th><a href="javascript:post_content('sales/sales_invoice_list','inv_id=<?php echo $invoice_no; ?>')"><?php echo $invoice_no; ?></a></th>
	<!--<th><?php //echo $invoice_order_no; ?></th>-->
    <th><?php echo $contact_name; ?></th>
    <th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_total_paid; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	<th><a href="#"><?php echo $invoice_status ?></a></th>
</tr>
<?php } ?>

		</tbody>
            </table> 
            </div>
            <!-- /.box-body -->
          </div>
		  <?php } ?>
		  <!--single invoice-->
<?php 
   if(isset($_GET['inv_id'])){
     $inv_id = $_GET['inv_id'];
?>
    <div class="box">
            <div class="box-header">
				<div class="col-lg-3">
				</div>		
			<a href="javascript:post_content('sales/new_invoice','inv_type=sales')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>
		</div>
            <!-- /.box-header -->
			<form method="post" enctype="multipart/form-data">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
               <tr>
                  <th>Date</th>
				  <th>Invoice No</th>
				  <th>Customer Name</th>
                   <th>Invoice Amount</th>
				   <th>Total Paid</th>
                  <th>Due Amount</th>
				  <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
if($inv_id)
{
$que="SELECT * FROM `contact_master` join sales_invoice_new on sales_invoice_new.invoice_firm_name=contact_master.s_no where sales_invoice_new.invoice_status='Active' and sales_invoice_new.invoice_no='$inv_id'";
}
$run=mysql_query($que) or die(mysql_error());
$num = mysql_num_rows($run);
$serial_no=0;
while($row=mysql_fetch_array($run)){
        $s_no=$row['s_no'];
		$invoice_date1=$row['invoice_date'];
		$invoice_date2=explode('-',$invoice_date1);
		$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
		$invoice_no=$row['invoice_no'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_total_paid=$row['invoice_total_paid'];
		$invoice_due_amount=$row['invoice_due_amount'];
		$invoice_status = $row['invoice_status'];
		$challan_no = $row['challan_no'];
	    $serial_no++;
        $que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
        $run1=mysql_query($que1) or die(mysql_error());
        $row1=mysql_fetch_array($run1);
        $contact_company_name=$row1['contact_company_name'];
        $contact_tittle_name=$row1['contact_tittle_name'];
        $contact_first_name=$row1['contact_first_name'];
        $contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><a href="#"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
    <th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_total_paid; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	<th><a href='#'><?php echo $invoice_status; ?></a></th>
<th>
   <center>
	<input type="hidden" id="<?php echo "invoice_no_".$serial_no; ?>" value="<?php echo $invoice_no; ?>" />
    <input type="hidden" id="<?php echo "invoice_type_".$serial_no; ?>" value="<?php echo $invoice_type; ?>" />
	<?php if($challan_no == ''){ ?>
	 
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="javascript:post_content('sales/new_invoice_edit','inv_id=<?php echo $inv_id; ?>')">Edit</a> &nbsp;&nbsp;&nbsp;
	<?php } ?>
	<?php if($challan_no){ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-hand-o-right" href="#">Delivered</a> &nbsp;&nbsp;&nbsp;
	<?php } ?>
    
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;
	
	<a href="#" onclick="valid('<?php echo $s_no;?>');" style="color:Red;" aria-hidden="true" class="fa fa-trash-o"> Delete</a></center>
	
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
          </div>
<?php } ?>		  
        </div>
      </div>
    </section>
  </div>	
</div>
</div>
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
