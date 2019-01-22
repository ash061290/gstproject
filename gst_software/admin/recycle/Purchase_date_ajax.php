<?php include("../../attachment/session.php"); ?>
     <div class="box-body table-responsive">
         <table id="example4" class="table table-bordered table-striped">
        <thead>
		 <tr>
		      <th>Invoice Date</th>
		      <th>Invoice No</th>
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
if(isset($_GET['from_date'])&& isset($_GET['to_date']))
{
echo $from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
 echo $que="SELECT * FROM purchase_invoice_new where invoice_status='Active' and company_code='$company_code' and invoice_date >= '$from_date' and invoice_date <= '$to_date' GROUP BY invoice_no ";
 }
$serial_no=0;
$income_total_amount=0;
$res1 = mysql_query($que) or die(mysql_error());
while($row3 = mysql_fetch_array($res1))
{
$date = $row3['invoice_date'];
$invoice_no = $row3['invoice_no']."<br>";
$invoice_product_name = $row3['invoice_product_name'];
//$item_mrp = $row3['item_mrp'];
$invoice_quantity = $row3['invoice_quantity'];
$invoice_total_paid = $row3['invoice_total_paid'];
$invoice_due_amount = $row3['invoice_due_amount'];
$invoice_grand_total = $row3['invoice_grand_total'];

$que1="select model_no from item where s_no='$invoice_product_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$invoice_product_name =$row1['model_no'];
?>
<tr>
<th><?php echo $date; ?></th>
<th><?php echo $invoice_no; ?></th>
<th><?php echo $invoice_product_name; ?></th>
<!--<th><?php //echo $item_mrp; ?></th>-->
<th><?php echo $invoice_quantity; ?></th>
<th><?php echo $invoice_total_paid; ?></th>
<th><?php echo $invoice_due_amount; ?></th>
<th><?php echo $invoice_grand_total; ?></th>
</tr> <?php }  ?>
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