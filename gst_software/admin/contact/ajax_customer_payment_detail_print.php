<?php include("../../attachment/session.php");
     $from_date = $_POST['from_date'];
     $to_date = $_POST['to_date'];
	 $s_no_new=$_POST['s_no'];
     $total_amount ="";
     $total_paid ="";
     $total_due="";	
	 $select1 = "select account_info.reference,account_info.date,account_info.transaction_type,account_info.invoice_no,account_info.payment_mode,contact_new.customer_name,contact_new.customer_mobile,contact_new.customer_id,contact_new.customer_date,bank_or_credit_card_info.bank_account_type,bank_or_credit_card_info.bank_account_name,bank_or_credit_card_info.bank_name,bank_or_credit_card_info.account_type  from account_info join contact_new on account_info.customer_id=contact_new.customer_id join bank_or_credit_card_info on account_info.bank_s_no=bank_or_credit_card_info.s_no where contact_new.s_no='$s_no_new' and contact_new.status='Active' and account_info.account_status='Active' and bank_or_credit_card_info.bank_status='Active' and contact_new.company_code='$company_code' and account_info.date>='$from_date' and account_info.date<='$to_date' order by account_info.s_no DESC";
	$select_run1 = mysql_query($select1);
	$s_no=1;
	while($fetchrow1 = mysql_fetch_array($select_run1)){
	   $customer_name = $fetchrow1['customer_name'];
	   $customer_mobile = $fetchrow1['customer_mobile'];
	   $customer_id = $fetchrow1['customer_id'];
	   $customer_date = $fetchrow1['customer_date'];
	   $transaction_type = $fetchrow1['transaction_type'];
	   $invoice_no = $fetchrow1['invoice_no'];
	   $bank_account_type = $fetchrow1['bank_account_type'];
	   $bank_account_name = $fetchrow1['bank_account_name'];
	   $bank_name = $fetchrow1['bank_name'];
	   $account_type = $fetchrow1['account_type'];
	   $payment_mode = $bank_account_type;
	   $date = $fetchrow1['date'];
	    $date1 = explode("-",$customer_date);
	   $customer_date = $date1[2]."-".$date1[1]."-".$date1[0];
	   $reference = $fetchrow1['reference'];
	   if($transaction_type == 'Credit'){
	   $select_invoice1 = "select invoice_no,invoice_date,invoice_reference,invoice_product_name,invoice_quantity,invoice_grand_total,invoice_total_paid,invoice_due_amount from sales_invoice_new where invoice_no='$invoice_no' and invoice_status='Active' and company_code='$company_code'";
	   }
	   if($transaction_type == 'Debit' && $account_type !='Expense Account' ){
	    $select_invoice1 = "select invoice_no,invoice_date,invoice_reference,invoice_product_name,invoice_quantity,invoice_grand_total,invoice_total_paid,invoice_due_amount from purchase_invoice_new where invoice_no='$invoice_no' and company_code='$company_code'";
	   }
	   $run_invoice1 = mysql_query($select_invoice1);
	    while($row1 = mysql_fetch_array($run_invoice1)){
		  $invoice_date = $row1['invoice_date'];
		  $invoice_product_name = $row1['invoice_product_name'];
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_grand_total = $row1['invoice_grand_total'];
		  $total_amount +=$invoice_grand_total;
		  $invoice_total_paid = $row1['invoice_total_paid'];
		  $total_paid += $invoice_total_paid;
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $total_due += $invoice_due_amount;
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $product_name = "select item_product_name from item where s_no='$invoice_product_name'";
		  $run2 = mysql_query($product_name);
		  $fetchrow2 = mysql_fetch_array($run2);
		  $item_product_name = $fetchrow2['item_product_name'];
	} }
		  ?>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box my_border_top" id="printTable">
	     	<table border="1" style="width:100%" cellpadding="0" cellspacing="0">
			  <tbody>
			  <th style="align:center; width:25%">Date Range</th>
			  <th style="align:center; width:15%">Customer Id</th>
			  <th style="align:center; width:25%">Customer Name</th>
			  <th style="align:center; width:20%">Customer Mobile</th>
			  <th style="align:center; width:15%">Total Amount</th>
			  </tbody>
			  <tr>
		<?php $from_date1 = explode("-",$from_date);
               $from_date1 = $from_date1[2]."-".$from_date1[1]."-".$from_date1[0];
                $to_date1 = explode("-",$to_date);
                $to_date1 = $to_date1[2]."-".$to_date1[1]."-".$to_date1[0]; ?>
			     <th style="align:center; width:18%">
				    <p><?php echo $from_date1 ?> - <?php echo $to_date1; ?></p>
				   </th>
				   <th style="align:center; width:22%">
				      <strong><?php echo  $customer_id; ?><strong>
				   </th>
				   <th style="align:center; width:22%">
				      <strong><?php echo  $customer_name; ?><strong>
				   </th>
				   <th style="align:center; width:15%">
				      <strong><?php echo  $customer_mobile; ?><strong>
				   </th>
				    <th style="align:center; width:15%">
				      <strong><?php echo $total_amount; ?><strong>
				   </th>
			  </tr>
			 </table>
		  <hr/>
			<div class="box-body">	
			    <table  class="table table-bordered table-striped" border="1" cellpadding="0" cellspacing="0">
                <thead class="btn-success">
                <tr>
                  <th style="align:center;width:5%">S_no</th>
                  <th style="align:center;width:9%">Date</th>
				  <th style="align:center;width:12%">Invoice No</th>
                  <th style="align:center;width:26%">Product Name</th>
				  <th style="align:center;width:8%">Transaction Type</th>
				  <th style="align:center;width:5%">Product Quantity</th>
				  <th style="align:center;width:10%">Payment Mode</th>
				  <th style="align:center;width:8%">Invoice Amount</th>
				  <th style="align:center;width:8%">Invoice Payment</th>
				 
                </tr>
                </thead>
				
				<tbody>
				<?php				
				 $select = "select account_info.reference,account_info.date,account_info.transaction_type,account_info.invoice_no,account_info.payment_mode,contact_new.customer_name,contact_new.customer_mobile,contact_new.customer_id,contact_new.customer_date,bank_or_credit_card_info.bank_account_type,bank_or_credit_card_info.bank_account_name,bank_or_credit_card_info.bank_name,bank_or_credit_card_info.account_type  from account_info join contact_new on account_info.customer_id=contact_new.customer_id join bank_or_credit_card_info on account_info.bank_s_no=bank_or_credit_card_info.s_no where contact_new.s_no='$s_no_new' and contact_new.status='Active' and account_info.account_status='Active' and bank_or_credit_card_info.bank_status='Active' and contact_new.company_code='$company_code' and account_info.date>='$from_date' and account_info.date<='$to_date' order by account_info.s_no DESC";
	$select_run = mysql_query($select);
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
	   $date = $fetchrow['date'];
	   $reference = $fetchrow['reference'];
	   if($transaction_type == 'Credit'){
	   $select_invoice = "select invoice_no,invoice_date,invoice_reference,invoice_product_name,invoice_quantity,invoice_grand_total,invoice_total_paid,invoice_due_amount from sales_invoice_new where invoice_no='$invoice_no' and invoice_status='Active' and company_code='$company_code'";
	   }
	   if($transaction_type == 'Debit' && $account_type !='Expense Account' ){
	    $select_invoice = "select invoice_no,invoice_date,invoice_reference,invoice_product_name,invoice_quantity,invoice_grand_total,invoice_total_paid,invoice_due_amount from purchase_invoice_new where invoice_no='$invoice_no' and company_code='$company_code'";
	   }
	   $run_invoice = mysql_query($select_invoice);
	    while($row1 = mysql_fetch_array($run_invoice)){
		  $invoice_date = $row1['invoice_date'];
		  $invoice_product_name = $row1['invoice_product_name'];
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_grand_total = $row1['invoice_grand_total'];
		  $total_amount +=$invoice_grand_total;
		  $invoice_total_paid = $row1['invoice_total_paid'];
		  $total_paid += $invoice_total_paid;
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $total_due += $invoice_due_amount;
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $product_name = "select item_product_name from item where s_no='$invoice_product_name'";
		  $run2 = mysql_query($product_name);
		  $fetchrow2 = mysql_fetch_array($run2);
		  $item_product_name = $fetchrow2['item_product_name'];
		
	            ?>
				<tr>
				  <th style="align:center;width:5%"><?php echo $s_no; ?></th>
				  <th style="align:center;width:9%"><?php echo $date; ?></th>
				  <th style="align:center;width:12%"><?php echo $invoice_no; ?></th>
                  <th style="align:center;width:26%"><?php echo $item_product_name; ?></th>
				  <th style="align:center;width:8%"><?php echo $transaction_type; ?></th>
				  <th style="align:center;width:5%"><?php echo $invoice_quantity; ?></th>
				  <th style="align:center;width:10%"><?php echo $payment_mode; ?></th>
				  <th style="align:center;width:8%"><?php echo $invoice_grand_total; ?></th>
				  <th style="align:center;width:8%"><?php echo $invoice_total_paid; ?></th>
				  <?php $s_no = $s_no+1; } } ?>
				</tr>			
				</tbody>
				
                </table>
			 </div>
			   </div>
			     </div>
			       </div>
				     </section>