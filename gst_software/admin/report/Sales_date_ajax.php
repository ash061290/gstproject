<?php include("../../attachment/session.php"); ?>
     <div class="box-body table-responsive">
         <table id="printTable" class="table table-bordered table-striped">
        <thead>
		 <tr>
		  <th>Invoice Date</th>
		  <th>Customer Name</th>
		  <th>Invoice No</th>
		  <th>Product Name</th>
		  <th>Sale MRP</th>
		  <th>Sales Quantity</th>
		  <th>Total Amount</th>
		  <th>Due Amount</th>
		  <th>Pay Amount</th>
		  <th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
if(isset($_GET['from_date'])&& isset($_GET['to_date']))
{
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
 echo $query1="SELECT * FROM sales_invoice_new where invoice_status = 'Active' and company_code='$company_code' and invoice_date>='$from_date' and invoice_date<='$to_date' GROUP BY invoice_no";
 }
$serial_no=0;
$income_total_amount=0;
$res1 = mysql_query($query1) or die(mysql_error());
while($row3 = mysql_fetch_array($res1))
{
	$select = "select contact_first_name,contact_last_name,contact_company_name ,contact_payment_terms,contact_contact_phone from contact_master where s_no='".$row3['invoice_firm_name']."'";
	$runq = mysql_query($select);
	$row4 = mysql_fetch_array($runq);
$contact_name = $row4['contact_first_name']." ".$row4['contact_last_name'];
$date = $row3['invoice_date'];
$company_name = $row4['contact_company_name'];
$contact_mobile = $row4['contact_contact_phone'];
$pay_term = $row4['contact_payment_terms'];
$invoice_no = $row3['invoice_no'];
$due_date2 = $row3['invoice_due_date'];
$invoice_due_amount = $row3['invoice_due_amount'];
$invoice_total_paid = $row3['invoice_total_paid'];
$invoice_grand_total = $row3['invoice_grand_total'];
$transaction_type = $row3['transaction_type'];
$account_name = $row3['account_name'];
$transaction_type = $row3['transaction_type'];
$date = explode("-",$date);
$date = $date[2]."-".$date[1]."-".$date[0];
?>
<tr>
<th><?php echo $date; ?></th>
<th><?php echo $company_name."[".$contact_name."]"; ?></th>
<th><?php echo $invoice_no; ?></th>
<th><?php echo $contact_mobile; ?></th>
<?php if (isset($_GET['default_from_date']) && isset($_GET['default_to_date'])) { $a ="Ago"; }  else { $a ="Left"; } ?>
<th style="color:red"><?php echo $due_date."&nbsp;".$a; ?></th>
<th><?php echo $due_date2; ?></th>
<th>
<a href="contact_detail.php?<?php if(isset($_GET['debit_from_date'])){ echo "did=".$invoice_no; } else { echo "cid=".$invoice_no; } ?>"><?php echo $contact_name; ?></a>
</th>
<th><?php echo $invoice_grand_total; ?></th>
<a href="#">
<th style="color:#2E86C1"><?php echo $invoice_due_amount; ?>
</a></th>
<th><?php echo $invoice_total_paid; ?></th>
<th><a aria-hidden='true' class='fa fa-trash' style="color:red;" onclick="return confirm('Do U Want Delete')" href='advance_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'><span style='color:red; font-size:15px;'> Delete </span></a></th>
</tr> <?php }  ?>
</tbody>
</table>
        </div> 
		<script>
$(function () {
$('#example4').DataTable()

})
</script>