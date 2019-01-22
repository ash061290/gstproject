<?php include("../../attachment/session.php"); ?>
     <div class="box-body table-responsive">
         <table id="example4" class="table table-bordered table-striped">
        <thead>
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
if(isset($_GET['contact_area']))
{
$s_no = $_GET['contact_area'];
if($s_no == "all"){
$query1="SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id`  JOIN `sales_invoice_info` ON `sales_invoice_info`.`invoice_no`=`account_info`.`invoice_no` and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code' GROUP BY `contact_master`.`contact_area` ORDER BY `sales_invoice_info`.`invoice_date` DESC";
}
else {
 $select_area= "select * from contact_master where s_no='$s_no'";
 $run = mysql_query($select_area);
 $fetchrow = mysql_fetch_array($run);
 $contact_area = $fetchrow['contact_area'];
 $query1="SELECT * FROM `contact_master` JOIN `account_info` ON `contact_master`.`s_no`=`account_info`.`customer_id`  JOIN `sales_invoice_info` ON `sales_invoice_info`.`invoice_no`=`account_info`.`invoice_no` WHERE `contact_master`.`contact_area`='$contact_area' GROUP BY `contact_master`.`contact_area` and `contact_master`.`company_code`='$company_code' and `account_info`.`company_code`='$company_code' ORDER BY `sales_invoice_info`.`invoice_date` DESC";
 }
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
<th><?php echo $contact_mobile; ?></th>
<th><a aria-hidden='true' class='fa fa-trash' style="color:red;" onclick="return confirm('Do U Want Delete')" href='due_payment_delete.php?invoice_id=<?php echo $invoice_no; ?>'><span style='color:red; font-size:15px;'> Delete </span></a></th>
</tr> <?php }  ?>
</tbody>
</table>
        </div> 
		<script>
$(function () {
$('#example4').DataTable()

})
</script>