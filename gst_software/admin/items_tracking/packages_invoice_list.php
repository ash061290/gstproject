<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Sales Invoice List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('items_tracking/new_packages')"><i class="fa fa-plus"></i> Add Invoice</a></li>
        <li class="active"><i class="fa fa-list"></i>Packages Invoice List</li>
      </ol>
    </section>
	
<script type="text/javascript">
   function search(value){
               
       $.ajax({
			  type: "POST",
              url: software_link+"item_tracking/invoice_search.php?search_by="+value+"",
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
              url: software_link+"item_tracking/ajax_get_status.php?inv_id="+inv_id+"&value="+value+"",
              cache: false,
              success: function(detail){
			   if(detail==1){
			    window.open('sales_invoice_list.php?inv_id='+inv_id, '_self')
			   }
              }
           });
	}
	function sales_type(value)
	{
		    $.ajax({
			  type: "POST",
              url: software_link+"item_tracking/all_filter.php?sales_invoice="+value+"",
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
	   alert(status);
	   sales_type(status);
	 });
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
		url: software_link+"item_tracking/ajax_get_payment_detail.php?inv_no="+inv_no+"&inv_type="+inv_type+"",
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
		url: software_link+"item_tracking/get_payment_details.php?id="+value+"",
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
  function filter_type(value){
         if(value=='package')
		 {
			 document.getElementById("package").style.display="block";
			 document.getElementById("shift").style.display="none";
		  }
		   if(value=='shift')
		 {
			 document.getElementById("package").style.display="none";
			 document.getElementById("shift").style.display="block";
		  }
  }
  // this code is use for hide and show payment detail -----END-----
</script>
	<script type="text/javascript" src="http://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.css" />
	<script type="text/javascript">
function popup(value) {
    w2popup.open({
        title: 'Package Delivered : '+value,
        body: '<br/><div class="col-md-12"><form method="post"><input type="hidden" name="inv_no" value="'+value+'"><div class="box-body"><div class="col-md-12"><div class="form-group col-md-6"><label>Delivery Date&nbsp;:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="delivery_date" required />&nbsp;&nbsp;</div><div class="form-group col-md-6"><label>Confirmed By&nbsp;:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="confirm_by" value="<?php echo $_SESSION['emp_id']; ?>" readonly />&nbsp;&nbsp;</div></div><br/><div class="col-md-12"><div class="form-group col-md-12"><label>Notes&nbsp;:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows="4" cols="12" name="c_notes" class="form-control" required></textarea>&nbsp;&nbsp;</div></div><div class="col-md-12"><div class="form-group col-md-6"><input type="submit" name="save" value="Save" class="form-control">&nbsp;&nbsp;</div><div class="form-group col-md-6"><input type="reset" name="Cancel" value="cancel" class="form-control">&nbsp;&nbsp;</div></div></div></form></div>'
    });
}
</script>
<?php if(isset($_POST['save'])){
	$inv_no = $_POST['inv_no'];
	$delivery_date = $_POST['delivery_date'];
	$c_notes = $_POST['c_notes'];
	 $qry = "update packages_invoice_info set invoice_due_date='$delivery_date',invoice_customer_notes='$c_notes',order_status='Delivered' where invoice_no='$inv_no'";
	 $run = mysql_query($qry);
	 if($run){
    echo "<script>window.open('packages_invoice_list.php', '_self');</script>";
	 }
 }	?>
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <!-- /.box -->  
        <div class="box container">
            <div class="box-header">
			<div class="col-md-10">
			
  </div>
   <div class="tab-content">
   <!-- <div role="tabpanel" class="tab-pane fade in active" id="package"></div>
    <div role="tabpanel" class="tab-pane fade" id="shift"></div>
    <div role="tabpanel" class="tab-pane fade" id="deliver"></div>-->
  </div>
  <div class="col-md-2">
			<a href="javascript:post_content('items_tracking/new_packages','inv_type=sales')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>
			</div>
		</div>
			
         <div class="box-body table-responsive">
			
               <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <strong style="font-size:15px;">Profile Information</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" style="font-size:15px;">Package Not Shipped</a>
                                </li>
                                <li><a href="#package1" data-toggle="tab" style="font-size:15px;">Shipped</a>
                                </li>
                                <li><a href="#delivery" data-toggle="tab" style="font-size:15px;">Delivered</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <h4>Profile Details</h4>
               <form role="form">
                  <div class="box-body">
				      <!-- /.box-header -->
			<form method="post" enctype="multipart/form-data">
            <div role="tabpanel" class="box-body table-responsive tab-pane fade in active" id="package">
			<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Invoice No</th>
                  <th>Shipping Charge</th>
				  <th>Customer Name</th>
				  <th>Invoice Status</th>
                  <th>Due Date</th>
                  <th>Amount</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody >
<?php
	$que="select * from packages_invoice_info where invoice_status='Active' GROUP BY invoice_no ORDER BY s_no DESC";
	$run=mysql_query($que) or die(mysql_error());
	$serial_no=0;
	while($row=mysql_fetch_array($run)){
	$s_no=$row['s_no'];
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$shipping_no = $row['shipping_no'];
	$delivery_no = $row['delivery_no'];
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_due_date1=$row['invoice_due_date'];
	$invoice_due_date2=explode('-',$invoice_due_date1);
	$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$invoice_shipping_charge=$row['invoice_shipping_charge'];
	$invoice_type=$row['invoice_type'];
	$invoice_status=$row['invoice_status'];
	$order_status = $row['order_status'];
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
	<th><a href="#" <?php if($order_status=='Shipped' || $order_status=='Delivered'){ echo "style='color:#090202'"; }  ?>><?php echo $invoice_no; ?></a><br/>
	<a href="#" <?php if($order_status=='Delivered'){ echo "style='color:#090202'"; }  ?>>
	<?php if($order_status=='Shipped' || $order_status=='Delivered'){ echo $shipping_no; } ?></a></th>
	<th><i class="fa fa-inr">&nbsp;<?php echo $invoice_shipping_charge; ?></i></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><a href="#"><?php echo $order_status; ?></a></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th>
   <center>
	<?php if($order_status == 'Package'){ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-gift" href='package_shift.php?inv_no=<?php echo $invoice_no; ?>'> Shipped </a> &nbsp;&nbsp;&nbsp;
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href=" javascript:post_content('items_tracking/new_invoice_edit',invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>')"> Edit </a> &nbsp;&nbsp;&nbsp;
	<?php } ?>
	<?php if($order_status == "Shipped"){ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-hand-o-right" href="#" onclick="popup('<?php echo $invoice_no; ?>')"> Delivered</a> &nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='sales_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'> Delete</a></center>
</th>
</tr>
 <?php }   ?>
<?php
if(isset($_GET['inv_id'])) {
     $inv_id = $_GET['inv_id'];
	$que="select * from packages_invoice_info where invoice_status='Active' GROUP BY invoice_no";
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
	$invoice_status = $row['invoice_status'];
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
<?php if($order_status == 'Package'){ $page_name = "package_shift.php"; }
          if($order_status == 'Shipped'){ $page_name = "shift_delivered.php"; }
          if($order_status == 'Delivered'){ $page_name = "delivered_to_complete.php"; }	?>
	<th><?php echo $invoice_date; ?></th>
	<th><a href="<?php echo $page_name; ?>?inv_id=<?php echo $invoice_no; ?>"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $invoice_order_no; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><a href="<?php echo $page_name; ?>?inv_id=<?php echo $invoice_no; ?>"><?php echo $order_status; ?></a></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
</tr>
<?php } } ?>
		</tbody>
            </table>
            </div>
			</form>
              </div>
              <!-- /.box-body -->
            </form>
                                </div>
								<!-- security -->
                                <div class="tab-pane fade" id="package1">
                                    <h4>Profile Security</h4>
                                    
                  <form role="form">
                  <div class="box-body">
				      <!-- /.box-header -->
			<form method="post" enctype="multipart/form-data">
            <div role="tabpanel" class="box-body table-responsive tab-pane fade in active" id="package">
			<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Invoice No</th>
                  <th>Shipping Charge</th>
				  <th>Customer Name</th>
				  <th>Invoice Status</th>
                  <th>Due Date</th>
                  <th>Amount</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody >
<?php
	$que="select * from packages_invoice_info where invoice_status='Active' and shipping_no!='' GROUP BY invoice_no ORDER BY s_no DESC";
	$run=mysql_query($que) or die(mysql_error());
	$serial_no=0;
	while($row=mysql_fetch_array($run)){
	$s_no=$row['s_no'];
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$shipping_no = $row['shipping_no'];
	$delivery_no = $row['delivery_no'];
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_due_date1=$row['invoice_due_date'];
	$invoice_due_date2=explode('-',$invoice_due_date1);
	$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$invoice_shipping_charge=$row['invoice_shipping_charge'];
	$invoice_type=$row['invoice_type'];
	$invoice_status=$row['invoice_status'];
	$order_status = $row['order_status'];
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
	<th><a href="#" <?php if($order_status=='Shipped' || $order_status=='Delivered'){ echo "style='color:#090202'"; }  ?>><?php echo $invoice_no; ?></a><br/>
	<a href="#" <?php if($order_status=='Delivered'){ echo "style='color:#090202'"; }  ?>>
	<?php if($order_status=='Shipped' || $order_status=='Delivered'){ echo $shipping_no; } ?></a></th>
	<th><i class="fa fa-inr">&nbsp;<?php echo $invoice_shipping_charge; ?></i></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><a href="#"><?php echo $order_status; ?></a></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th>
   <center>
	<?php if($order_status == 'Package'){ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-gift" href="javascript:post_content('items_tracking/package_shift','inv_no=<?php echo $invoice_no; ?>')"> Shipped </a> &nbsp;&nbsp;&nbsp;
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="javascript:post_content('items_tracking/new_invoice_edit','invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>')"> Edit </a> &nbsp;&nbsp;&nbsp;
	<?php } ?>
	<?php if($order_status == "Shipped"){ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-hand-o-right" href="#" onclick="popup('<?php echo $invoice_no; ?>')"> Delivered</a> &nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='sales_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'> Delete</a></center>
</th>
</tr>
 <?php }   ?>
<?php
if(isset($_GET['inv_id'])) {
     $inv_id = $_GET['inv_id'];
	$que="select * from packages_invoice_info where invoice_status='Active' GROUP BY invoice_no";
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
	$invoice_status = $row['invoice_status'];
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
<?php if($order_status == 'Package'){ $page_name = "package_shift.php"; }
          if($order_status == 'Shipped'){ $page_name = "shift_delivered.php"; }
          if($order_status == 'Delivered'){ $page_name = "delivered_to_complete.php"; }	?>
	<th><?php echo $invoice_date; ?></th>
	<th><a href="<?php echo $page_name; ?>?inv_id=<?php echo $invoice_no; ?>"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $invoice_order_no; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><a href="<?php echo $page_name; ?>?inv_id=<?php echo $invoice_no; ?>"><?php echo $order_status; ?></a></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
</tr>
<?php } } ?>
		</tbody>
            </table>
            </div>
			</form>
              </div>
              <!-- /.box-body -->
            </form>
              <!-- /.box-body session -->
                                </div>
                                <div class="tab-pane fade" id="delivery">
                                    
                                </div>
                               <!-- <div class="tab-pane fade" id="settings">
                                    <h4>Settings Tab</h4>
                                    <p>ashish4</p>
                                </div> -->
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.box-body -->
          </div>
			<!-- shipping-->
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
 $quer="update account_info set payment_mode='$payment_mode1',bank_s_no='$payment_mode',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',invoice_total_paid='$paid_amount',invoice_due_amount='$invoice_due_amount',cheque_status='$cheque_status' where invoice_no='$payment_invoice_no'";
if(mysql_query($quer)){
//update sales_delivery_challan_info_status
   $qry = "select challan_no from sales_invoice_info where invoice_no='$payment_invoice_no'";
   $run = mysql_query($qry);
   $fetchrow = mysql_fetch_array($run);
   $challan_no = $fetchrow['challan_no'];
   $select_delivery_challan = "select order_no from sales_delivery_challan_info where invoice_no='$challan_no'";
   $selectrun = mysql_query($select_delivery_challan);
   $fetchr = mysql_fetch_array($selectrun);
   $order_no = $fetchr['order_no'];
   $update_sales_order = "update sales_order_info set invoice_status2='$status' where invoice_no='$order_no'";
   mysql_query($update_sales_order);
   $update_challan_status = "update sales_delivery_challan_info set invoice_status2 ='$status'";
   mysql_query($update_challan_status);
//end
//sales_order_info_update_status
  
//end
$quer1="update sales_invoice_info set invoice_payment_mode='$payment_mode',invoice_total_paid='$paid_amount',remark='$remark',invoice_due_amount='$invoice_due_amount',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',invoice_status2 ='$status' where invoice_no='$payment_invoice_no'";
if(mysql_query($quer1)){
echo "<script>window.open('sales_invoice_list.php', '_self');</script>";
}
}
}
?>