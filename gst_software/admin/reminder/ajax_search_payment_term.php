<?php include("../../attachment/session.php");?>
<div class="box-body table-responsive">
  <table id="example4" class="table table-bordered table-striped">
   <thead class="my_background_color">
		 <tr>
		  <th>Invoice Date</th>
		  <th>Invoice No</th>
		  <th>Mobile</th>
		  <th>Due Days Left</th>
		  <th>Due Date</th>
		  <th>Customer Name</th>
		  <th>Total Amount</th>
		  <th>Due Amount</th>
		  <th>Pay Amount</th>
		   <th>Action</th>
		</tr>
	</thead>
	<tbody >
<?php
    if(isset($_GET['payment_term']))
	{
	     if($_GET['payment_term'] == 'Net-15')
		 {
		   $payment_term = $_GET['payment_term'];
		 }
		 if($_GET['payment_term'] == 'Net-30')
		 {
		   $payment_term = $_GET['payment_term'];
		 }
		 if($_GET['payment_term'] == 'Net-45')
		 {
		   $payment_term = $_GET['payment_term'];
		 }
		 if($_GET['payment_term'] == 'Net-60')
		 {
		   $payment_term = $_GET['payment_term'];
		 }
		 if($_GET['payment_term'] == 'Due end of the month')
		 {
		   $payment_term = $_GET['payment_term'];
		 }
		  if($_GET['payment_term'] == 'Due end of the next month')
		 {
		   $payment_term = $_GET['payment_term'];
		 }
		  if($_GET['payment_term'] == 'Due on receipt')
		 {
		   $payment_term = $_GET['payment_term'];
		 }
	}
 if(isset($_GET['from_date']) && isset($_GET['to_date']))
 {
 $from_date=$_GET['from_date'];
 $to_date=$_GET['to_date'];
 $payment_term = $_GET['payment_term'];
 $query1="SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id`  JOIN `sales_invoice_info` ON `sales_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE `sales_invoice_info`.`invoice_due_date`> CURDATE() AND `account_info`.`invoice_due_amount` !='' AND `contact_master`.`contact_payment_terms`='$payment_term' AND `contact_master`.`contact_status`='Active' AND `sales_invoice_info`.`invoice_date` >= '$from_date' AND `sales_invoice_info`.`invoice_date` <= '$to_date' and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code' GROUP BY `account_info`.`invoice_no` ORDER BY `account_info`.`s_no` DESC";
 }  else
if(isset($_GET['current_year'])) 
{
  $from_date = $_GET['from_date'];
  $to_date = $_GET['to_date'];
 $query1="SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id`  JOIN `sales_invoice_info` ON `sales_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE `account_info`.`invoice_due_amount` !='' AND `sales_invoice_info`.`invoice_due_date`> CURDATE() AND `sales_invoice_info`.`invoice_date` >= '$from_date' AND `sales_invoice_info`.`invoice_date` <= '$to_date' AND `contact_master`.`contact_payment_terms`='$payment_term' AND `contact_master`.`contact_status`='Active' and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code' GROUP BY `account_info`.`invoice_no` ORDER BY `account_info`.`s_no` DESC";
}
if(isset($_GET['pay_term']))
{
 $payment_term = $_GET['pay_term'];
 $query1="SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id` JOIN `sales_invoice_info` ON `sales_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE `sales_invoice_info`.`invoice_due_date`> CURDATE() AND `account_info`.`invoice_due_amount` !='' AND `contact_master`.`contact_status`='Active' AND `contact_master`.`contact_payment_terms`='$payment_term' and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code' GROUP BY `account_info`.`invoice_no` ORDER BY `account_info`.`s_no` DESC";
}
$serial_no=0;
$income_total_amount=0;
$res1 = mysql_query($query1) or die(mysql_error());
while($row3 = mysql_fetch_array($res1))
{
$contact_name = $row3['contact_first_name']."".$row3['contact_last_name'];
$date = $row3['invoice_date'];
$company_name = $row3['contact_company_name'];
$contact_mobile = $row3['contact_contact_phone'];
$pay_term = $row3['contact_payment_terms'];
$invoice_no = $row3['invoice_no'];
$due_date2 = $row3['invoice_due_date'];
$invoice_due_amount = $row3['invoice_due_amount'];
$invoice_total_paid = $row3['invoice_total_paid'];
$invoice_grand_total = $row3['invoice_grand_total'];
$transaction_type = $row3['transaction_type'];
$account_name = $row3['account_name'];
$transaction_type = $row3['transaction_type'];
$date_c = date('Y-m-d');
if($pay_term == 'Due end of the month')
{
$date1 = new DateTime("$date_c");
$date2 = new DateTime("$due_date2");
$diff = $date2->diff($date1)->format("%a Days");
$due_date = $diff;
}
if($pay_term == 'Due end of the next month')
{
$date1 = new DateTime("$date_c");
$date2 = new DateTime("$due_date2");
$diff = $date2->diff($date1)->format("%a Days");
$due_date = $diff;
}
if($pay_term == 'Due on receipt')
{
$date1 = new DateTime("$date_c");
$date2 = new DateTime("$due_date2");
$diff = $date2->diff($date1)->format("%a Days");
$due_date = $diff;
}
if($pay_term =='Net-15' || $pay_term =='Net-30' || $pay_term =='Net-45' || $pay_term =='Net-60')
{
list($y,$m,$d) = explode("-",$date);
list($net,$day) = explode("-",$pay_term);
$due_date = strtotime($date);
$due_date = strtotime("+$day day", $due_date);
$due_date2 =  date('Y-m-d', $due_date);
$date1 = new DateTime("$date_c");
$date2 = new DateTime("$due_date2");
$diff = $date2->diff($date1)->format("%a Days");
$due_date = $diff;
	}
$date = date_create($date);
$date = date_format($date,"d-m-Y");	
$due_date2 = date_create($due_date2);
$due_date2 = date_format($due_date2,"d-m-Y");
	?>
<tr>
<th><?php echo $date; ?></th>
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
</tr> <?php } ?>
</tbody>
</table>
</div>
<script>
$(function () {
$('#example4').DataTable()
})
</script>
<?php  ?>