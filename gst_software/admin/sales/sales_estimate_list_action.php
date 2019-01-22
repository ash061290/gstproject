<?php include("../../attachment/session.php");
 $s_no=$_GET['sales_id']; ?>
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
<script type="text/javascript">
  
	function estimate_status_change(value)
		{
			alert(value);
			   $.ajax({
				       type:"POST",
					   url:software_link+"sales/ajax_sales_estimate_status.php?status_value="+value+"",
					   cache:false,
					   success:function(detail)
					   {
						  var res = detail.split("|");
						  alert(res[0]);
						  if(res[0]==1)
						  {
					 get_content('sales/sales_estimate_list');
					   
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
        <div class="box">
            <div class="box-header">
				<div class="col-lg-3">
				</div>
		</div>
			<?php 
			if(empty($_GET['estimate_type']))
			{				?>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Date</th>
                  <th>Estimate No</th>
                  <th>Refrence</th>
				  <th>Customer Name</th>
             
				  <th>Expire Date</th>
                  <th>Amount</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
$que="select * from sales_estimate_info where invoice_status='Active' AND s_no='$s_no' and company_code='$company_code' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$numrow = mysql_num_rows($run);
if($numrow<1)
{
 $que = "select * from sales_estimate_draft_info where invoice_status='Active' AND s_no='$s_no' and company_code='$company_code' GROUP BY invoice_no";
$run = mysql_query($que) or die(mysql_error()); 
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
		$estimate_status = $row['estimate_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$estimate_type=$row['invoice_type'];
		$estimate_status2 = $row['estimate_status2'];
		$estimate_expire = $row['invoice_due_date'];
		$end_date = explode("-",$estimate_expire);
		$estimate_expire = $end_date[2]."-".$end_date[1]."-".$end_date[0];
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
	<th><a><?php echo $estimate_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><?php echo $estimate_expire; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>

<th>
	<center>
	<?php if($estimate_status2 == 'Accepted' || $estimate_status2 == 'Sent') { ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href="javascript:post_content('sales/sales_estimate_to_order','estimate_id=<?php echo $estimate_no; ?>&estimate_type=<?php echo "sales"; ?>')"><span>&nbsp;Order</span></a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php  } ?>
	<?php if($estimate_status2 !='Order'){ ?>
	<a href="javascript:estimate_status_change('<?php echo $estimate_no; ?>')" style="color:#606125;" aria-hidden="true" class="fa fa-hand-o-right"><?php echo $estimate_status2; ?></a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="javascript:post_content('sales/new_estimate_edit','estimate_no=<?php echo $estimate_no; ?>&estimate_type=<?php echo $estimate_type; ?>')"> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='#'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" class="fa fa-trash-o" onclick="return delete_data()"  href="javascript:post_content('sales/estimate_delete','estimate_no=<?php  echo $estimate_no; ?>&estimate_type=<?php echo $estimate_type; ?>')"> Delete</a></center>
</th>
</tr>
<?php } ?>
		</tbody>
             </table>
            </div>
			<?php }
             ?>
			
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
