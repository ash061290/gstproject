<?php include("../../attachment/session.php");
     $from_date = $_POST['from_date'];
     $to_date = $_POST['to_date'];
	 $s_no=$_POST['s_no'];
     $total_amount ="";
     $total_paid ="";
     $total_due="";	
?>
 <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>S_no</th>
                  <th>Date</th>
				  <th>Invoice No</th>
                  <th>Product Name</th>
				  <th>Transaction Type</th>
				  <th>Product Quantity</th>
				  <th>Payment Mode</th>
				  <th>Invoice Amount</th>
				  <th>Invoice Payment</th>
				  <th>Invoice Due</th>
                </tr>
                </thead>
				
				<tbody>
				<?php				
				$select = "select account_info.reference,account_info.date,account_info.transaction_type,account_info.invoice_no,account_info.payment_mode,contact_master.contact_status='Active',contact_master.contact_first_name,contact_master.contact_last_name,contact_master.contact_company_name,contact_master.contact_contact_phone,bank_or_credit_card_info.bank_account_type,bank_or_credit_card_info.bank_account_name,bank_or_credit_card_info.bank_name,bank_or_credit_card_info.account_type  from account_info join contact_master on account_info.customer_id=contact_master.s_no join bank_or_credit_card_info on account_info.bank_s_no=bank_or_credit_card_info.s_no where contact_master.s_no='$s_no' and contact_master.contact_status='Active' and account_info.account_status='Active' and bank_or_credit_card_info.bank_status='Active' and contact_master.company_code='$company_code' and account_info.date>='$from_date' and account_info.date<='$to_date' order by account_info.s_no desc";
	$select_run = mysql_query($select);
	 $numrow = mysql_num_rows($select_run);
	if($numrow>0){
	$s_no=1;
	while($fetchrow = mysql_fetch_array($select_run)){
	   $contact_first_name = $fetchrow['contact_first_name'];
	   $contact_last_name = $fetchrow['contact_last_name'];
	   $contact_company_name = $fetchrow['contact_company_name'];
	   $contact_contact_phone = $fetchrow['contact_contact_phone'];
	   $transaction_type = $fetchrow['transaction_type'];
	   $invoice_no = $fetchrow['invoice_no'];
	   $bank_account_type = $fetchrow['bank_account_type'];
	   $bank_account_name = $fetchrow['bank_account_name'];
	   $bank_name = $fetchrow['bank_name'];
	   $account_type = $fetchrow['account_type'];
	   $payment_mode = $bank_account_type;
	   $date = $fetchrow['date'];
	   $date = explode("-",$date);
	   $date = $date[2]."-".$date[1]."-".$date[0];
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
		 // $total_amount +=$invoice_grand_total;
		  $invoice_total_paid = $row1['invoice_total_paid'];
		 // $total_paid += $invoice_total_paid;
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  //$total_due += $invoice_due_amount;
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $product_name = "select item_product_name from item where s_no='$invoice_product_name'";
		  $run2 = mysql_query($product_name);
		  $fetchrow2 = mysql_fetch_array($run2);
		  $item_product_name = $fetchrow2['item_product_name'];
		
	            ?>
				<tr>
				  <th><?php echo $s_no; ?></th>
				  <th><?php echo $date; ?></th>
				  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $item_product_name; ?></th>
				  <th><?php echo $transaction_type; ?></th>
				  <th><?php echo $invoice_quantity; ?></th>
				  <th><?php echo $payment_mode; ?></th>
				  <th><?php echo $invoice_grand_total; ?></th>
				  <th><?php echo $invoice_total_paid; ?></th>
				  <th><?php echo $invoice_due_amount; ?></th>
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