<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Purchase Invoice List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('purchase/new_invoice')"><i class="fa fa-plus"></i> Add Invoice</a></li>
        <li class="active"><i class="fa fa-list"></i> Purchase Invoice List</li>
      </ol>
    </section>
<script>
function valid(s_no){  
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_purchase_invoice_list(s_no);

 }            
else  {      
return false;
 }       
} 
function delete_purchase_invoice_list(s_no){
$.ajax({
type: "POST",
url: software_link+"purchase/purchase_invoice_list_delete_api.php",
data: "id="+s_no,
cache: false,

success: function(detail){
    var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Deleted');
           get_content('purchase/purchase_invoice_list');
         }else{
               alert(detail); 
         }
}
});
}
</script>	
<script type="text/javascript">

	function change_status2(value,company_code)
	{
	   $.ajax({
			  type: "POST",
              url: software_link+"purchase/ajax_get_status.php?invoice_no="+value+"&company_code="+company_code+"",
              cache: false,
              success: function(detail){
			    if(detail==1){
			    $('#status_'+value).html('Invoiced');
				$('#status1_'+value).html('Invoiced');
			   }
              }
           });
	}
	function purchase_type(value)
	{
		    $.ajax({
			  type: "POST",
              url: software_link+"purchase/all_filter.php?purchase_invoice="+value+"",
              cache: false,
              success: function(detail){
             $('#search_table').html(detail);
              }
           })
		
	}
</script>
<script>
    $(document).ready(function(){
	   var status = document.getElementById('sales_term').value;
	   purchase_type(status);
	 });
</script>
<script>
function for_payment(sno){
	alert(sno);
var inv_no=document.getElementById('invoice_no_'+sno).value;
var inv_type=document.getElementById('invoice_type_'+sno).value;
	$.ajax({
		address: "POST",
		url: software_link+"purchase/ajax_get_payment_detail.php?inv_no="+inv_no+"&inv_type="+inv_type+"",
		cache: false,
		success: function(detail){
			alert(detail);
		var res = detail.split("|?|");
		if(res[1]>0){
		$('#invoice_no').val(inv_no);
		$('#invoice_total_amount').val(res[0]);
		$('#payment_mode').val(res[1]);
		
		
}
}

// this code is use for hide and show payment detail -----START-----
  function payment_detail(value){
  if(value!=''){
	$.ajax({
		address: "POST",
		url: software_link+"purchase/get_payment_details.php?id="+value+"",
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
					  <select name="ledger_month" id="sales_type" onchange="purchase_type(this.value);" class="form-control select2" id="sales_term" style="width:100%">
					  <option value="all" selected>All</option>
					  <option value="Draft">Draft</option>
					  <option value="Approved">Approved</option>
					  <option value="Advance">Adavance Pay</option>
					  <option value="Retainer">Retainer Invoice</option>
					  <option value="Partially Paid">Partially Paid</option>
					  <option value="Unpaid Invoice">Unpaid</option>
					  <option value="Overdue">Overdue</option>
					  <option value="Paid Invoice">Paid Invoice</option>
					  <option value="Debit Notes">Credit Notes</option>
					  </select>
				 </div>
			    </div>
			<a href="javascript:get_content('purchase/new_invoice')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>
			
		</div>
			
            <!-- /.box-header -->
			<form method="post" enctype="multipart/form-data">
            <div class="box-body table-responsive" id="search_table">
			<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				 <th>S_No</th>
                  <th>Date</th>
				  <th>Invoice No</th>
				  <th>Firm Name</th>
				  <th>Total Amount</th>
                  <th>Payable Amount</th>
				  <th>Due Balance</th>
				  <th>Invoice status</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody >

<?php
	$que="select * from purchase_invoice_new where invoice_status='Active' and company_code='$company_code'";
	$run=mysql_query($que) or die(mysql_error());
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
	$invoice_type=$row['invoice_type'];
	$invoice_status = $row['invoice_status'];
	$invoice_status2= $row['invoice_status2'];
	$serial_no++;
	$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
	$run1=mysql_query($que1) or die(mysql_error());
	$row1=mysql_fetch_array($run1);
	$contact_company_name=$row1['contact_company_name'];
	$contact_tittle_name=$row1['contact_tittle_name'];
	$contact_first_name=$row1['contact_first_name'];
	$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center'>
    <th><?php echo $serial_no; ?></th>
	<th><?php echo $invoice_date; ?></th>
	<th><a href="javascript:post_content('purchase/purchase_invoice_list','<?php echo 'inv_id='.$invoice_no; ?>')"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_total_paid; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	
	<th><a href="#" <?php if($invoice_status2 =='due Amount'){
		echo 'style="color:Red;"';
	}else{
		echo 'style="color:Green;"';
	} ?>onclick="change_status('<?php echo $invoice_no; ?>')"><?php echo $invoice_status2; ?></a></th>&nbsp;&nbsp;
    <th

<a style="color:#555D70;" aria-hidden="true" class="fa fa-hand-o-right" href='#' data-toggle="modal" data-id="<?php echo $invoice_no; ?>" data-target="#view_purchase" ><span onclick="for_payment(<?php echo $invoice_no; ?>);"> view </span></a>

<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="javascript:post_content('purchase/purchase_invoice_list_edit','<?php echo 'id='.$s_no; ?>')"></a>&nbsp;
<a style="color:Red;" aria-hidden="true" onclick = "valid('<?php echo $s_no;?>');" class="fa fa-trash-o">	
	</a>
	
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
<?php 
  error_reporting(0);
   if(isset($_GET['inv_id'])){
     $inv_id = $_GET['inv_id'];  
	  // $inv_draft_id = $_GET['inv_draft'];
?>
    <div class="box">
            
            <!-- /.box-header -->
			<form method="post" enctype="multipart/form-data">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Invoice No</th>
				  <th>Firm Name</th>
                  <th>Total Amount</th>
                  <th>Payable Amount</th>
				  <th>Due Balance</th>
				  <th>Status</S></th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
if($inv_id)
{
$que="select * from purchase_invoice_new where invoice_status='Active' AND invoice_no='$inv_id' and company_code='$company_code' GROUP BY invoice_no";
}
$run=mysql_query($que) or die(mysql_error());
$numrow = mysql_num_rows($run);
if($numrow<1){
          $que ="select * from purchase_invoice_new where invoice_status='Active' AND invoice_no='$inv_id' and company_code='$company_code' GROUP BY invoice_no";
		  $run=mysql_query($que) or die(mysql_error());
}	
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
		//$invoice_type=$row['invoice_type'];
		$invoice_status = $row['invoice_status'];
	$serial_no++;	
$que1="select * from purchase_invoice_new where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_company_name=$row1['contact_company_name'];
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><a href="purchase_invoice_list.php?inv_id=<?php echo $invoice_no; ?>"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_total_paid; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	<th><?php echo $invoice_status; ?></th>
<th>
	<center>
	<input type="hidden" id="<?php echo "invoice_no_".$serial_no; ?>" value="<?php echo $invoice_no; ?>" />
    <input type="hidden" id="<?php echo "invoice_type_".$serial_no; ?>" value="<?php echo $invoice_type; ?>" />
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_invoice_edit.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type;?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='purchase_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'> Delete</a>
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
<!---------------------------view add model--------------------------->
<form method="post" enctype="multipart/form-data">
  <div class="modal fade" id="view_purchase">
          <div class="modal-dialog lg-modal ">
            <div class="modal-content">
              <div class="modal-header">
              	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="invoice_no" >invoice no:</h4>
              </div>
              <div class="modal-body">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Product name</th>
                  <th>Total Amount</th>
                  <th>Payable Amount</th>
				  <th>Due Balance</th>
                </tr>
                </thead>
              	
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    </form>



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