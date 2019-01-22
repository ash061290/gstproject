<?php include("../../attachment/session.php");?>

<script src="select2.min.css"></script>
    <section class="content-header">
      <h1>
        Sales Delivery Challan List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="new_delivery_challan.php?inv_type=sales"><i class="fa fa-plus"></i> Add Delivery Challan</a></li>
        <li class="active"><i class="fa fa-list"></i> Sales Delivery Challan List</li>
      </ol>
    </section>	
    <!-- Main content -->
	<form method="post" enctype="multipart/form-data">
     <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- /.box -->
        <div class="box">
            <div class="box-header">
				
			<a href='add_payment.php?inv_type=sales'> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>
		</div>
            <!-- /.box-header -->
			
            <div class="box-body table-responsive">
              <table id="example4" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
		          <th>#</th>
                  <th>Date</th>
				  <th>Invoice No</th>
				  <th>Customer Name</th>
                  <th>Delivery Date</th>
                  <th>Amount</th>
				  <th>Due Balance</th>
				  <th>Pay Through</th>
				  <th><center>Action</center></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$que="select * from sales_invoice_info where invoice_status='Active' AND invoice_status2='Advance' and company_code='$company_code' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$invoice_date1=$row['invoice_date'];
		$invoice_date2=explode('-',$invoice_date1);
		$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
		$invoice_no=$row['invoice_no'];
		$account_name = $row['account_name']."(".$row['account_type'].")";
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_due_date1=$row['invoice_due_date'];
		$invoice_due_date2=explode('-',$invoice_due_date1);
	 $invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_due_amount=$row['invoice_due_amount'];
		$invoice_order_no=$row['invoice_order_no'];
		$invoice_type=$row['invoice_type'];
	$serial_no++;
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_company_name=$row1['contact_company_name'];
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
$contact_gst_treatment=$row1['contact_gst_treatment'];
?>		  
<tr>
<th><?php echo $serial_no; ?></th>
	<th><?php echo $invoice_date; ?></th>
	<th><?php echo $invoice_no; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	<th><?php echo $account_name; ?></th>
<th>
<a aria-hidden='true' class='fa fa-print' href='#'><span style='color:#2eb82e;font-size:15px;'> Print </span></a> &nbsp;&nbsp;&nbsp;&nbsp;
<a aria-hidden='true' class='fa fa-trash' style="color:red;" onclick="return confirm('Do U Want Delete')" href='advance_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'><span style='color:red; font-size:15px;'> Delete </span></a>
</th>
</tr>
<?php  } ?>
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
	</form>
	 </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
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

