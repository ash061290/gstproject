<?php 
include("../../attachment/session.php"); ?>
     <div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped">
        <thead class="btn-success">
     <tr>
	  <th>S_No</th>
      <th>Invoice Date</th>
      <th>Invoice No</th>
	   <th>Vendor Name</th>
       <th>Product Name</th>
      <!--<th>Purchase MRP</th>-->
      <th>Purchase Quantity</th>
      <th>Pay Amount</th>
      <th>Due Amount</th>
      <th>Total Amount</th>
    </tr>
  </thead>
  <tbody>
<?php
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
if(isset($_GET['current_year']))
{
$current_year = $_GET['current_year'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
 }
$que="SELECT * FROM purchase_invoice_new where invoice_status='Active' and company_code='$company_code' and invoice_date >= '$from_date' and invoice_date <= '$to_date' GROUP BY invoice_no ";
$serial_no=1;
$income_total_amount=0;
$res1 = mysql_query($que) or die(mysql_error());
while($row3 = mysql_fetch_array($res1))
{
	$firm_id = $row3['invoice_firm_name'];
	$select_contact = "select contact_first_name,contact_last_name,contact_company_name from contact_master where s_no='$firm_id'";
$run = mysql_query($select_contact);
$fetch_row = mysql_fetch_array($run);
$contact_name = $fetch_row['contact_first_name']." ".$fetch_row['contact_last_name'];
$company_name = $fetch_row['contact_company_name'];
$date = $row3['invoice_date'];
$date = explode("-",$date);
$date = $date[2]."-".$date[1]."-".$date[0];
$invoice_no = $row3['invoice_no']."<br>";
$invoice_product_name = $row3['invoice_product_name'];
//$item_mrp = $row3['item_mrp'];
$invoice_quantity = $row3['invoice_quantity'];
$invoice_total_paid = $row3['invoice_total_paid'];
$invoice_due_amount = $row3['invoice_due_amount'];
$invoice_grand_total = $row3['invoice_grand_total'];

$que1="select item_product_name from item where s_no='$invoice_product_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$invoice_product_name =$row1['item_product_name'];
?>
<tr>
<th><?php echo $serial_no; ?></th>
<th><?php echo $date; ?></th>
<th><?php echo $invoice_no; ?></th>
<th><?php echo $company_name."[".$contact_name."]"; ?></th>
<th><?php echo $invoice_product_name; ?></th>
<!--<th><?php //echo $item_mrp; ?></th>-->
<th><?php echo $invoice_quantity; ?></th>
<th><?php echo $invoice_total_paid; ?></th>
<th><?php echo $invoice_due_amount; ?></th>
<th><?php echo $invoice_grand_total; ?></th>
</tr> <?php $serial_no++; }  ?>
</tbody>
</table>
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