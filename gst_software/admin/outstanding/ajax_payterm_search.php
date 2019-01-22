<?php include("../../attachment/session.php");?>
<div class="box-body table-responsive">
  <table id="example4" class="table table-bordered table-striped">
<thead class="my_background_color">
	<tr>
	<th>Invoice Date</th>
	 <th>Invoice No</th>
	 <th>Due Days Left</th>
	 <th>Due Date</th>
	 <th>Customer Name</th>
	 <th>Total Amount</th>
	 <th>Due Amount</th>
	 <th>Pay Amount</th>
	 <th>Mobile</th>
	 <th>Action</th>
	 </tr>
</thead>
<tbody>
<?php
if(isset($_POST['pay_term_credit']))
{
$pay_term = $_POST['pay_term_credit'];
 $que = "SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id` JOIN `sales_invoice_info` ON `sales_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE `sales_invoice_info`.`invoice_due_date`> CURDATE() AND `account_info`.`invoice_due_amount` !='' AND `contact_master`.`contact_status`='Active' AND `account_info`.`transaction_type`='Credit' AND `contact_master`.`contact_payment_terms`='$pay_term' and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code' GROUP BY `sales_invoice_info`.`invoice_no`";
}
if(isset($_POST['pay_term_debit']))
{
$pay_term = $_POST['pay_term_debit']; 
$que = "SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id` JOIN `purchase_invoice_info` ON `purchase_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE  `account_info`.`invoice_due_amount` !='' AND `contact_master`.`contact_status`='Active' AND `account_info`.`transaction_type`='Debit'  AND `contact_master`.`contact_payment_terms`='$pay_term' and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code' GROUP BY `account_info`.`invoice_no`";
}
if(isset($_POST['pay_term_default']))
{
$pay_term = $_POST['pay_term_default'];
$que = "SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id` JOIN `sales_invoice_info` ON `sales_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE `sales_invoice_info`.`invoice_due_date`< CURDATE() AND `account_info`.`invoice_due_amount` !='' AND `contact_master`.`contact_status`='Active' AND `account_info`.`transaction_type`='Credit' AND `contact_master`.`contact_payment_terms`='$pay_term' and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code' GROUP BY `account_info`.`invoice_no`";
}
$run3=mysql_query($que);
$total_credit_amount=0;
$total_debit_amount=0;
$running_amount=0;
while($row3=mysql_fetch_array($run3))
{
$contact_name = $row3['contact_first_name']."".$row3['contact_last_name'];
$date = $row3['invoice_date'];
$company_name = $row3['contact_company_name'];
$contact_mobile = $row3['contact_contact_phone'];
$pay_term = $row3['contact_payment_terms'];
$invoice_no = $row3['invoice_no'];
$invoice_due_amount = $row3['invoice_due_amount'];
$invoice_total_paid = $row3['invoice_total_paid'];
$invoice_grand_total = $row3['invoice_grand_total'];
$transaction_type = $row3['transaction_type'];
$account_name = $row3['account_name'];
$transaction_type = $row3['transaction_type'];
$due_date2 = $row3['invoice_due_date'];
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
$due_date2 = date('Y-m-d', $due_date);
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
<th style="color:red"><?php echo $due_date."&nbsp;Left"; ?></th>
<th><?php echo $due_date2; ?></th>
<th><a href="contact_detail.php?cid=<?php echo $invoice_no; ?>"><?php echo $contact_name; ?></a></th>
<th><?php  echo $invoice_grand_total; ?></th>
<a href="#"><th style="color:#2E86C1"><?php echo $invoice_due_amount; ?></a></th>
<th><?php echo $invoice_total_paid; ?></th>
<th><?php echo $contact_mobile; ?></th>
<th><a aria-hidden='true' class='fa fa-trash' style="color:red;" onclick="return confirm('Do U Want Delete')" href='advance_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'><span style='color:red; font-size:15px;'> Delete </span></a></th>
</tr>
<?php } ?>
</tbody>
</table>
	  <script>
  $(function () {
    $('#example4').DataTable()

  })
</script>	     	 
		