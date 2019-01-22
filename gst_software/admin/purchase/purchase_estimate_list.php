<?php 
include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Purchase Estimate List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:post_content('purchase/new_estimate','inv_type=sales')"><i class="fa fa-plus"></i> Add Estimate</a></li>
        <li class="active"><i class="fa fa-list"></i> Purchase Estimate List</li>
      </ol>
    </section>
	
<script type="text/javascript">
		function estimate_type(value){
		    $.ajax({
			  type: "POST",
              url: software_link+"purchase/all_filter.php?estimate_by="+value+"",
              cache: false,
              success: function(detail){
            $('#search_table').html(detail);
              }
           });
		}
		function status_change(value)
		{
			   $.ajax({
				       type:"POST",
					   url:software_link+"purchase/ajax_purchase_estimate_status.php?status_value="+value+"",
					   cache:false,
					   success:function(detail){ 
					   alert(detail);
     					   var res = detail.split("|");
						  if(res[0]==1)
						  {
							 window.open('purchase_estimate_list.php', '_self');    
						  }
					   }
			   })
		}
		function status_draft(value)
		{
			  $.ajax({
				      type:"POST",
					  url:software_link+"purchase/ajax_estimate_draft_status.php",
					  data:"status_draft_value="+value,
					  cache:false,
					  success:function(detail){
						  var res = detail.split("|");
						  alert(detail);
						  if(res[0]==1)
						  {
							 window.open('sales_estimate_list.php', '_self');
                            							 
						  }
					  }
			  })
		}
    
</script>

<script>
function delete_data() {
    var txt=confirm("Are You Sure Want to Delete this Record !!!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}
</script>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->
<?php if(empty($_GET['purchase_id'])) { ?>
        <div class="box">
            <div class="box-header">
				<div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "Invoice type"; ?></label>
					  <select name="ledger_month" id="extimate_type" onchange="estimate_type(this.value);" class="form-control select2" style="width:100%">
					  <option value="all" selected>All</option>
					  <option value="Draft">Draft</option>
					  <option value="Approved">Approved</option>
					  <option value="Sent">Sent</option>
					  <option value="Accepted">Accepted</option>
					  <option value="Invoiced">Invoiced</option>
					  <option value="Declined">Declined</option>
					  <option value="Expired">Expired</option>
					  </select>
				 </div>
			    </div>
			<a href="javascript:post_content('purchase/new_estimate','inv_type=sales')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>  
		</div>
			
            <!-- /.box-header -->
            <div class="box-body table-responsive" id="search_table">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				<th>Date</th>
                  <th>Estimate No</th>
                  <th>Refrence</th>
				  <th>Customer Name</th>
                  <th>Status</th>
				  <th>Expiry Date</th>
                  <th>Amount</th>
				  <th>Estimate Status</th>
                </tr>
                </thead>
				<tbody id="search_table">


<?php
$que="select * from purchase_estimate_info where invoice_status='Active' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$estimate_no=$row['invoice_no'];
		$estimate_date = $row['invoice_date'];
		$start_date = explode("-",$estimate_date);
		$estimate_date = $start_date[2]."-".$start_date[1]."-".$start_date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$estimate_type=$row['invoice_type'];
		$estimate_status = $row['estimate_status'];
		$estimate_status2 = $row['estimate_status2'];
		$estimate_expire = $row['invoice_due_date'];
		$start_date = explode("-",$estimate_expire);
		$estimate_expire = $start_date[2]."-".$start_date[1]."-".$start_date[0];
	$serial_no++;
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<?php
$date1=date_create($estimate_date);
$date2=date_create($estimate_expire);
$diff=date_diff($date1,$date2);
 $diff_days =  $diff->format("%a");
if($diff_days>0 && $diff_days<=4)
{
$update_estimate = "update sales_estimate_info set estimate_status='Declined',estimate_status2='Declined' where invoice_no='$estimate_no'";	
mysql_query($update_estimate); 
}
if($diff_days =='0')
{
	$update_estimate = "update sales_estimate_info set estimate_status='Expired',estimate_status2='Expired' where invoice_no='$estimate_no'";
mysql_query($update_estimate);	
}
?>

<tr  align='center' >
	<th><?php echo $estimate_date; ?></th>
	<th><a href="javascript:post_content('purchase/purchase_estimate_list','<?php echo 'purchase_id='.$estimate_no; ?>')"><?php echo $estimate_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $estimate_status; ?></span></th>
	<th><?php echo $estimate_expire; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><a href="#" onclick="status_change('<?php echo $estimate_no; ?>')"><?php echo $estimate_status2; ?></a></th>
</tr>
<?php } ?>
<?php
$que="select * from purchase_estimate_draft_info where invoice_status='Active' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$estimate_no=$row['invoice_no'];
		$estimate_date = $row['invoice_date'];
		$start_date = explode("-",$estimate_date);
		$estimate_date = $start_date[2]."-".$start_date[1]."-".$start_date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$estimate_type=$row['invoice_type'];
		$estimate_status = $row['estimate_status'];
		$estimate_status2 = $row['estimate_status2'];
		$estimate_expire = $row['invoice_due_date'];
		$start_date = explode("-",$estimate_expire);
		$estimate_expire = $start_date[2]."-".$start_date[1]."-".$start_date[0];
	$serial_no++;
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<?php
$date1=date_create($estimate_date);
$date2=date_create($estimate_expire);
$diff=date_diff($date1,$date2);
 $diff_days =  $diff->format("%a");
if($diff_days>0 && $diff_days<=4)
{
$update_estimate = "update sales_estimate_info set estimate_status='Declined',estimate_status2='Declined' where invoice_no='$estimate_no'";	
mysql_query($update_estimate); 
}
if($diff_days =='0')
{
	$update_estimate = "update sales_estimate_info set estimate_status='Expired',estimate_status2='Expired' where invoice_no='$estimate_no'";
mysql_query($update_estimate);	
}
?>

<tr  align='center' >
	<th><?php echo $estimate_date; ?></th>
<th><a href="javascript:post_content('purchase/purchase_estimate_list','<?php echo 'purchase_id='.$estimate_no; ?>')"><?php echo $estimate_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $estimate_status; ?></span></th>
	<th><?php echo $estimate_expire; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><a href="#" onclick="status_change('<?php echo $estimate_no; ?>')"><?php echo $estimate_status2; ?></a></th>
</tr>
<?php } ?>
		</tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
		  <?php } 
              if(isset($_GET['purchase_id']))
			  {
				  $invoice_no = $_GET['purchase_id'];
				  ?>
		<div class="box">
            <div class="box-header">
				<div class="col-lg-3">
				</div>
			<a href="javascript:post_content('purchase/new_estimate','inv_type=sales')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>  
		</div>
			    <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				<th>Date</th>
                  <th>Estimate No</th>
                  <th>Refrence</th>
				  <th>Customer Name</th>
                  <th>Status</th>
				  <th>Expiry Date</th>
                  <th>Amount</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
$que="select * from purchase_estimate_info where invoice_status='Active' and invoice_no='$invoice_no' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$numrow = mysql_num_rows($run);
if($numrow<1){
	$que="select * from purchase_estimate_draft_info where invoice_status='Active' and invoice_no='$invoice_no' GROUP BY invoice_no";
    $run=mysql_query($que) or die(mysql_error());
}
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$estimate_no=$row['invoice_no'];
		$estimate_date = $row['invoice_date'];
		$start_date = explode("-",$estimate_date);
		$estimate_date = $start_date[2]."-".$start_date[1]."-".$start_date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$estimate_type=$row['invoice_type'];
		$estimate_status = $row['estimate_status'];
		$estimate_status2 = $row['estimate_status2'];
		$estimate_expire = $row['invoice_due_date'];
		$start_date = explode("-",$estimate_expire);
		$estimate_expire = $start_date[2]."-".$start_date[1]."-".$start_date[0];
	$serial_no++;
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center' >
	<th><?php echo $estimate_date; ?></th>
	<th><a href="javascript:post_content('purchase/purchase_estimate_list','<?php echo 's_no='.$s_no; ?>')"><?php echo $estimate_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $estimate_status; ?></span></th>
	<th><?php echo $estimate_expire; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th>
	<center>
	<?php if($estimate_status2 == 'Accepted' || $estimate_status2 == 'Sent') { ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href="estimate_to_order.php?estimate_no=<?php echo $estimate_no; ?>&estimate_type=<?php echo "purchase"; ?>">
	<span>&nbsp;Order</span></a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php  } ?>
	<?php if($estimate_status2 !='Order Create'){ ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-hand-o-right" href="#">
	<span onclick="status_change('<?php echo $estimate_no; ?>')">&nbsp;<?php echo $estimate_status2; ?></span></a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_estimate_edit.php?estimate_no=<?php echo $estimate_no; ?>&estimate_type=<?php echo $estimate_type; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='#'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" onclick="return delete_data()" class="fa fa-trash-o" href='estimate_delete.php?estimate_no=<?php  echo $estimate_no; ?>&estimate_type=<?php echo $estimate_type; ?>'> Delete</a></center>
	
</th>
</tr>
<?php } ?>
		</tbody>
            
             </table>
			
            </div>
            <!-- /.box-body -->
          </div>
		 <?php
			  } ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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