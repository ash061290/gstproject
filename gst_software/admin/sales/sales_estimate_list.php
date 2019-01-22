<?php  include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Sales Estimate List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="javascript:post_content('sales/new_estimate','inv_type=sales')"><i class="fa fa-plus"></i>Add Estimate</a></li>
        <li class="active"><i class="fa fa-list"></i> Sales Estimate List</li>
      </ol>
    </section>
<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete this Record !!!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
}

</script>
<script type="text/javascript">
		function estimate_type(value,company_code){
		    $.ajax({
			  type: "POST",
              url: software_link+"sales/all_filter.php?estimate_by="+value+"&company_code="+company_code+"",
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
					   url:software_link+"sales/ajax_sales_estimate_status.php?status_value="+value+"",
					   cache:false,
					   success:function(detail){ 
     					   var res = detail.split("|");
						  if(res[0]==1)
						  {
							 get_content('sales/sales_estimate_list');    
						  }
					   }
			   })
		}
</script>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
           </div>
		   <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
				<div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "Invoice type"; ?></label>
					  <select name="ledger_month" id="extimate_type" onchange="estimate_type(this.value,'<?php echo $company_code; ?>');" class="form-control select2" style="width:100%">
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
			
			<a href="javascript:post_content('sales/new_estimate','inv_type=sales')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>  
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
           
				  <th>Expiry Date</th>
                  <th>Amount</th>
				  <th>Estimate Status</th>
                </tr>
                </thead>
				<tbody>
<?php
$que="select * from sales_estimate_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no ORDER BY invoice_date DESC";
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
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $estimate_date; ?></th>
	<th><a href="javascript:post_content('sales/sales_estimate_list_action','sales_id=<?php echo $s_no; ?>')"><?php echo $estimate_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	
	<th><?php echo $estimate_expire; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><a href="javascript:status_change('<?php echo $estimate_no; ?>')"><?php echo $estimate_status2; ?></a></th>
</tr>
<?php    
} ?>
	<?php
$que="select * from sales_estimate_draft_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no ORDER BY invoice_date DESC";
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
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $estimate_date; ?></th>
	<th><a href="javascript:post_content('sales/sales_estimate_list_action','sales_id=<?php echo $s_no; ?>')"><?php echo $estimate_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>

	<th><?php echo $estimate_expire; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><a href="#" onclick="status_change('<?php echo $estimate_no; ?>','<?php echo $company_code; ?>')"><?php echo $estimate_status2; ?></a></th>
</tr>
<?php    
}
	?>
		</tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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