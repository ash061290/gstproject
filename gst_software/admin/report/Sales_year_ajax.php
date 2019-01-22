<?php  include("../../attachment/session.php"); ?>
     <div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="0" cellspacing="0">
        <thead class="btn-success">
		 <tr>
		  <th>Invoice Date</th>
		  <th>Customer Name</th>
		  <th>Invoice No</th>
		  <th>Product Name</th>
		  <th>Sale MRP</th>
		  <th>Sales Quantity</th>
		  <th>Total Amount</th>
		  <th>Pay Amount</th>
		  <th>Due Amount</th>
		 
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
 $que="SELECT * FROM sales_invoice_new where invoice_status='Active' and company_code='$company_code' and invoice_date >= '$from_date' and invoice_date<='$to_date' GROUP BY invoice_no";
$serial_no=0;
$income_total_amount=0;
$res1 = mysql_query($que) or die(mysql_error());
$total_paid = "";
$total_due = "";
$total_amount = "";
$total_quantity="";
while($row3 = mysql_fetch_array($res1))
{
$date = $row3['invoice_date'];
$invoice_no = $row3['invoice_no'];
$reference = $row3['invoice_reference'];
$invoice_product_name = $row3['invoice_product_name'];
$item_mrp = $row3['item_mrp'];
$invoice_quantity = $row3['invoice_quantity'];
$invoice_total_paid = $row3['invoice_total_paid'];
$invoice_due_amount = $row3['invoice_due_amount'];
$invoice_grand_total = $row3['invoice_grand_total'];
$total_quantity += $invoice_quantity;
$total_amount += $invoice_grand_total;
$total_paid  += $invoice_total_paid;
$total_due   += $invoice_due_amount;
$firm_id = $row3['invoice_firm_name'];
if($reference == 'Vendors'){
$select_contact = "select contact_first_name,contact_last_name,contact_company_name from contact_master where s_no='$firm_id'";
$run = mysql_query($select_contact);
$fetch_row = mysql_fetch_array($run);
$contact_name = $fetch_row['contact_first_name']." ".$fetch_row['contact_last_name'];
$company_name = $fetch_row['contact_company_name'];
$customer_name = $contact_name."[".$company_name."]";
} else if($reference == 'Customers'){
$select_contact1 = "select * from contact_new where customer_id='$firm_id'";
$run1 = mysql_query($select_contact1);
$fetch_row1 = mysql_fetch_array($run1);
$contact_name = $fetch_row1['customer_name'];
$customer_mobile = $fetch_row1['customer_mobile'];
$customer_name = $contact_name."[".$customer_mobile."]";
}
$que1="select item_product_name from item where s_no='$invoice_product_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$invoice_product_name =$row1['item_product_name'];
$date = explode("-",$date);
$date = $date[2]."-".$date[1]."-".$date[0];
?>
<tr>
<th><?php echo $date; ?></th>
<th><?php echo $customer_name; ?></th>
<th><?php echo $invoice_no; ?></th>
<th><?php echo $invoice_product_name; ?></th>
<th><?php echo $item_mrp; ?></th>
<th><?php echo $invoice_quantity; ?></th>
<th><?php echo $invoice_grand_total; ?></th>
<th><?php echo $invoice_total_paid; ?></th>
<th><?php echo $invoice_due_amount; ?></th>
</tr> <?php }  ?>
</tbody>
<tr>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <th>Total : </th>
   <th style="color:#8E231D;"><?php echo $total_quantity; ?></th>
   <th  style="color:#56509C;"><?php echo $total_amount; ?></th>
   <th style="color:#317B26;" ><?php echo $total_paid; ?></th>
   <th style="color:#8E231D;"><?php echo $total_due; ?></th>
</tr>
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