<?php 
include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Sales Credit Notes
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
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
			    window.open('../html/admin/sales/sales_invoice_list.php?inv_id='+inv_id, '_self')
			   }
              }
           });
	}
	function sales_type(value)
	{
		    $.ajax({
			  type: "POST",
              url: software_link+"sales/all_filter.php?sales_invoice="+value+"",
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
  function credit_notes_type(value)
  {
   $.ajax({
          type:"POST",
		  url:software_link+"sales/all_filter.php",
		  data:"credit_value="+value,
		  cache:false,
		  success:function(detail){
		  $('#search_table').html(detail);
		  }
     })
  }
</script>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <!-- /.box -->     
        <div class="box">
            <div class="box-header">
				  <div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "Invoice type" ?></label>
					  <select name="ledger_month" id="sales_type" onchange="credit_notes_type(this.value);" class="form-control select2" style="width:100%">
					  <option value="all" selected>All</option>
					  <option value="Credit Order">Credit Order</option>
					  <option value="Refund Order">Refund Order</option>
					  </select>
				 </div>
			    </div>
			<!--<a href='new_invoice.php?inv_type=sales'> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>-->
			
		</div>
			
            <!-- /.box-header -->
			<form method="post" enctype="multipart/form-data">
            <div class="box-body table-responsive" id="search_table">
			<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Credit Note No</th>
				  <th>Referance</th>
				  <th>Customer Name</th>
				  <th>Reason</th>
				   <th>Return Term</th>
                  <th>Amount</th>
				  <th>Due Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody >
<?php
$table_name='sales_delivery_challan_info';
$table_name2 = 'sales_delivery_challan_draft_info';
	$que="select sales_invoice_info.invoice_no,sales_invoice_info.invoice_type,sales_invoice_info.invoice_date,
	sales_invoice_info.invoice_reference,sales_invoice_info.invoice_due_amount,sales_invoice_info.invoice_firm_name,
	sales_invoice_info.invoice_grand_total,sales_invoice_info.challan_no,sales_invoice_info.invoice_status,
	$table_name.invoice_no,$table_name.order_return_reason,
	$table_name.order_return_term from sales_invoice_info join $table_name on sales_invoice_info.challan_no=$table_name.invoice_no where sales_invoice_info.invoice_status='Active' and sales_invoice_info.invoice_status2='Debit Notes' and sales_invoice_info.company_code='$company_code' GROUP BY sales_invoice_info.invoice_no";
	$run=mysql_query($que) or die(mysql_error());
	$numrow = mysql_num_rows($run);
	$number=0;

	$serial_no=0;
	while($row=mysql_fetch_array($run)){
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_type=$row['invoice_type'];
	$reference = $row['invoice_reference'];
	$return_reason = $row['order_return_reason'];
	$order_return_term = $row['order_return_term'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
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
	<th><?php echo $invoice_date; ?></th>
	<th><a href=""><?php echo $invoice_no; ?></a></th>
	<th><?php echo $reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><?php echo $return_reason; ?></th>
	<th><?php echo $order_return_term; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	<th>
	
	<!--<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_invoice_edit.php?invoice_no=<?php //echo $invoice_no; ?>&invoice_type=<?php //echo $invoice_type; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	-->
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:Red;" aria-hidden="true" class="fa fa-trash-o" onclick="if(window.confirm('Do You Want Delete..')){  window.open('credit_notes_delete.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>', '_self'); }" href="#"> Delete</a>
	
	   </th>
</tr>
<?php } ?>

<?php
$table_name='sales_delivery_challan_info';
$table_name2 = 'sales_delivery_challan_draft_info';
$que="select sales_invoice_info.invoice_no,sales_invoice_info.invoice_type,sales_invoice_info.invoice_date,
        sales_invoice_info.invoice_reference,sales_invoice_info.invoice_due_amount,sales_invoice_info.invoice_firm_name,
	sales_invoice_info.invoice_grand_total,sales_invoice_info.challan_no,sales_invoice_info.invoice_status,
	$table_name2.invoice_no,$table_name2.order_return_reason,
	$table_name2.order_return_term from sales_invoice_info join $table_name2 on sales_invoice_info.challan_no=$table_name2.invoice_no where sales_invoice_info.invoice_status='Active' and sales_invoice_info.invoice_status2='Debit Notes' and sales_delivery_challan_draft_info.company_code='$company_code' and sales_invoice_info.company_code='$company_code' GROUP BY sales_invoice_info.invoice_no";
	$run=mysql_query($que) or die(mysql_error());
	$numrow = mysql_num_rows($run);
	$number=0;
	$serial_no=0;
	while($row=mysql_fetch_array($run)){
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_type=$row['invoice_type'];
	$reference = $row['invoice_reference'];
	$return_reason = $row['order_return_reason'];
	$order_return_term = $row['order_return_term'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
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
	<th><?php echo $invoice_date; ?></th>
	<th><a href=""><?php echo $invoice_no; ?></a></th>
	<th><?php echo $reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><?php echo $return_reason; ?></th>
	<th><?php echo $order_return_term; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	<th>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" class="fa fa-trash-o" onclick="if(window.confirm('Do You Want Delete..')){  window.open('credit_notes_delete.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>', '_self'); }" href="#"> Delete</a>
	   </th>
</tr>
<?php } ?>
		</tbody>
            </table> 
            </div>
			</form>
            <!-- /.box-body -->
          </div>
		  
		  <!--single invoice-->		  
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
//update sales_delivery_challan_info_status
   $qry = "select challan_no from sales_invoice_info where invoice_no='$payment_invoice_no' and company_code='$company_code'";
   $run = mysql_query($qry);
   $fetchrow = mysql_fetch_array($run);
   $challan_no = $fetchrow['challan_no'];
   $select_delivery_challan = "select order_no from sales_delivery_challan_info where invoice_no='$challan_no' and company_code='$company_code'";
   $selectrun = mysql_query($select_delivery_challan);
   $fetchr = mysql_fetch_array($selectrun);
   $order_no = $fetchr['order_no'];
   $update_sales_order = "update sales_order_info set invoice_status2='$status' where invoice_no='$order_no' and company_code='$company_code'";
   mysql_query($update_sales_order);
   $update_challan_status = "update sales_delivery_challan_info set invoice_status2 ='$status' and company_code='$company_code'";
   mysql_query($update_challan_status);
//end
//sales_order_info_update_status
  
//end
$quer1="update sales_invoice_info set invoice_payment_mode='$payment_mode',invoice_total_paid='$paid_amount',remark='$remark',invoice_due_amount='$invoice_due_amount',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',invoice_status2 ='$status' where invoice_no='$payment_invoice_no' and company_code='$company_code'";
if(mysql_query($quer1)){
echo "<script>window.open('sales/sales_invoice_list', '_self');</script>";
} } }
?>