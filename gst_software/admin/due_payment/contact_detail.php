<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
      Detail Payment
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#"><i class="fa fa-plus"></i>Payment Detail</a></li>
        <li class="active">Contact List</li>
      </ol>
    </section>
 
    <!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
<!-- /.box -->
    <div class="box">
<!-- /.box-header -->
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
	     <thead class="my_background_color">
	      <tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>Invoice Date</th>
		  <th>Payment Term</th>
		  <th>Invoice Due Date</th>
		  <th>Company Name</th>
		  <th>Invoice Num</th>
		  <th>Invoice Amount</th>
		  <th>Amount Pay</th>
		  <th> Due Amount</th>
		  <th><center>Action</center></th>
	       </tr>
	    </thead>
<tbody id="search_table">
<?php
if(isset($_GET['cid']))
 {					
$id=$_GET['cid'];
$que="SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id` JOIN `sales_invoice_info` ON `sales_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE `account_info`.`invoice_due_amount` !='' AND `contact_master`.`contact_status`='Active' AND `sales_invoice_info`.`invoice_no`='$id' and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code'";
}
if(isset($_GET['did']))
{
$id=$_GET['did'];
$que="SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id` JOIN `purchase_invoice_info` ON `purchase_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE `account_info`.`invoice_due_amount` !='' AND `contact_master`.`contact_status`='Active' AND `purchase_invoice_info`.`invoice_no`='$id' and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code'"; 
}
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;	
while($row=mysql_fetch_array($run)){
$s_no=$row[0];
$invoice_num = $row['invoice_no'];
$invoice_date = $row['invoice_date'];
$invoice_due_date = $row['invoice_due_date'];
$invoice_amount = $row['invoice_grand_total'];
$amount_pay = $row['invoice_total_paid'];
$contact_tittle_name=$row['contact_tittle_name'];
$contact_first_name=$row['contact_first_name'];
$contact_last_name=$row['contact_last_name'];
$contact_company_name=$row['contact_company_name'];
$contact_contact_phone=$row['contact_contact_phone'];
$contact_email=$row['contact_email'];
$pay_term = $row['contact_payment_terms'];
$contact_gstin=$row['contact_gstin'];					
$contact_contact_type=$row['contact_contact_type'];	
$contact_gst_treatment=$row['contact_gst_treatment'];
$due_amount = $row['invoice_due_amount'];					
$serial_no++;
$date = date_create($invoice_date);
$invoice_date = date_format($date,"d-m-Y");	
$due_date2 = date_create($invoice_due_date);
$invoice_due_date = date_format($due_date2,"d-m-Y");					
				?>
<tr  align='center' >
<th><?php echo $serial_no; ?></th>
<th><?php echo $contact_tittle_name ."     ".$contact_first_name ."     ".$contact_last_name; ?></th>
<th><?php echo $invoice_date; ?></th>
<th><?php echo $pay_term; ?></th>
<th><?php echo $invoice_due_date; ?></th>
<th><?php echo $contact_company_name; ?></th>
<th><?php echo $invoice_num; ?></th>
<th><?php echo $invoice_amount; ?></th>
<th><?php echo $amount_pay; ?></th>	
<th style="color:red;"><?php echo  $due_amount; ?></th>
<th>
 <!--<a aria-hidden='true' class='fa fa-edit' href='#'><span style='color:#2eb82e;font-size:15px;'> Edit </span></a> &nbsp;&nbsp;&nbsp;&nbsp;-->
<a aria-hidden='true' class='fa fa-trash' style="color:red;" onclick="return confirm('Do U Want Delete')" href='advance_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'><span style='color:red; font-size:15px;'> Delete </span></a>	
</th>
</tr>
<?php } ?>
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
<script>
  $(function () {
    $('#example1').DataTable()
   
  })
</script>

