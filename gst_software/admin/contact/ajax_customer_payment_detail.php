<?php include("../../attachment/session.php");
     $from_date = $_POST['from_date'];
     $to_date = $_POST['to_date'];
	 $s_no_new=$_POST['s_no'];
     $total_amount ="";
     $total_paid ="";
     $total_due="";	
?>
 <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>S_no</th>
                  <th>Date</th>
				  <th>Customer Id</th>
                  <th>Customer Name</th>
				  <th>Customer Mobile</th>
				  <th>Invoice No</th>
				  <th>Product Name</th>
				  <th>Quantity</th>
				  <th>Invoice Amount</th>
                </tr>
                </thead>
				
				<tbody>
				<?php				
				$select = "select account_info.reference,account_info.date,account_info.transaction_type,account_info.invoice_no,account_info.payment_mode,contact_new.customer_name,contact_new.customer_mobile,contact_new.customer_id,contact_new.customer_date,bank_or_credit_card_info.bank_account_type,bank_or_credit_card_info.bank_account_name,bank_or_credit_card_info.bank_name,bank_or_credit_card_info.account_type  from account_info join contact_new on account_info.customer_id=contact_new.customer_id join bank_or_credit_card_info on account_info.bank_s_no=bank_or_credit_card_info.s_no where contact_new.s_no='$s_no_new' and contact_new.status='Active' and account_info.account_status='Active' and bank_or_credit_card_info.bank_status='Active' and contact_new.company_code='$company_code' and account_info.date>='$from_date' and account_info.date<='$to_date' order by account_info.s_no desc";
	$select_run = mysql_query($select);
	 $numrow = mysql_num_rows($select_run);
	if($numrow>0){
	$s_no=1;
	while($fetchrow = mysql_fetch_array($select_run)){
	   $customer_name = $fetchrow['customer_name'];
	   $customer_mobile = $fetchrow['customer_mobile'];
	   $customer_id = $fetchrow['customer_id'];
	   $customer_date = $fetchrow['customer_date'];
	   $transaction_type = $fetchrow['transaction_type'];
	   $invoice_no = $fetchrow['invoice_no'];
	   $bank_account_type = $fetchrow['bank_account_type'];
	   $bank_account_name = $fetchrow['bank_account_name'];
	   $bank_name = $fetchrow['bank_name'];
	   $account_type = $fetchrow['account_type'];
	   $payment_mode = $bank_account_type;
	   $date1 = explode("-",$customer_date);
	   $customer_date = $date1[2]."-".$date1[1]."-".$date1[0];
	   $reference = $fetchrow['reference'];
	   if($transaction_type == 'Credit'){
	   $select_invoice = "select invoice_no,invoice_date,invoice_reference,invoice_product_name,invoice_quantity,invoice_grand_total,invoice_total_paid,invoice_due_amount from sales_invoice_new where invoice_no='$invoice_no' and invoice_status='Active' and company_code='$company_code'";
	    $run_invoice = mysql_query($select_invoice);
	   }
	   if($transaction_type == 'Debit' && $account_type !='Expense Account'){
	    $select_invoice = "select invoice_no,invoice_date,invoice_reference,invoice_product_name,invoice_quantity,invoice_grand_total,invoice_total_paid,invoice_due_amount from purchase_invoice_new where invoice_no='$invoice_no' and company_code='$company_code'";
		 $run_invoice = mysql_query($select_invoice);
	   }
	 //  echo $run_invoice;
	      while($row1 = mysql_fetch_array($run_invoice)){
		  $invoice_date = $row1['invoice_date'];
		  $invoice_product_name = $row1['invoice_product_name'];
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_grand_total = $row1['invoice_grand_total'];
		  $invoice_total_paid = $row1['invoice_total_paid'];
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $product_name = "select item_product_name from item where s_no='$invoice_product_name'";
		  $run2 = mysql_query($product_name);
		  $fetchrow2 = mysql_fetch_array($run2);
		  $item_product_name = $fetchrow2['item_product_name']; ?>
				<tr>
				<th><?php echo $s_no; ?></th>
				<th><?php echo $customer_date; ?></th>
				<th><?php echo $customer_id; ?></th>
				<th><?php echo $customer_name; ?></th>
			     <th><?php echo $customer_mobile; ?></th>
			     <th><?php echo $invoice_no; ?></th>
				<th><?php echo $item_product_name; ?></th>
				<th><?php echo $invoice_quantity; ?></th>
				<th><?php echo $invoice_total_paid; ?></th>
	<?php $s_no = $s_no+1; } }  ?>
				</tr>					
				</tbody>
				
                </table>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
<?php		  
	}
	
?>