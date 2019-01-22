<?php include("../../attachment/session.php");
    $s_no = $_POST['s_no'];
	$que="select * from bank_or_credit_card_info where s_no='$s_no'";
	$run=mysql_query($que);
	while($row=mysql_fetch_array($run)){
	$s_no = $row['s_no'];
	$bank_account_type = $row['bank_account_type'];
	$credit_card_account_name = $row['credit_card_account_name'];
	$credit_card_account_number = $row['credit_card_account_number'];
	$bank_account_name = $row['bank_account_name'];
	$bank_account_number = $row['bank_account_number'];
	if($bank_account_type=='Credit_Card'){
	$name='Credit Card('.$credit_card_account_name.')';
	$account_no=$credit_card_account_number.'XXXXXX';
	$class='fa fa-credit-card-alt';
	}
	else if($bank_account_type=='Bank'){
	$name=$bank_account_type.'('.$bank_account_name.')';
	$account_no=$bank_account_number.'XXXXXX';
	$class='fa fa-university';
	}else {
	$name=$bank_account_type.'('.$bank_account_name.')';
	$account_no='XXXXXXX112323';
	$class='fa fa-money';
	}
	}
   
	$que="select * from account_info where bank_s_no='$s_no' and account_status='Active'";
	$run=mysql_query($que);
	$total_credit_amount=0;
	$total_debit_amount=0;
	$running_amount=0;
	
	while($row=mysql_fetch_array($run)){
	$invoice_total_paid = $row['invoice_total_paid'];
	$transaction_type = $row['transaction_type'];
	if($transaction_type=='Credit'){
	$credit_amount=$invoice_total_paid;
	$debit_amount='';
	$total_credit_amount=$total_credit_amount+$credit_amount;				
	}else{
	$debit_amount=$invoice_total_paid;
	$credit_amount='';
	$total_debit_amount=$total_debit_amount+$debit_amount;
	}
	$running_amount=$total_credit_amount-$total_debit_amount;
	}				
	?>
<div class="row">
  <div class="col-xs-12">
    <div class="box my_border_top">
	   <div class="box-body" id="PrintTable">	
			<div class="col-sm-12">
			   <div class="col-sm-10">
                <h4><i class="<?php echo $class; ?>">&nbsp;<?php echo $name; ?></i></h4>
                <h5><?php echo $account_no; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Running Balance : <b><a style="color:red"><?php echo $running_amount;?></a><b></h5>
              </div>
			</div>
				<div class="col-md-12 box-body table-responsive">
                <table border="1px" cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th style="align:center;width:5%;">S_no</th>
                  <th style="align:center;width:12%;">Date</th>
				  <th style="align:center;width:30%;">Customer/Vendor Name</th>
				  <th style="align:center;width:10%;">Type</th>
				  <th style="align:center;width:10%;">Payment Mode</th>
				  <th style="align:center;width:9%;">Deposit</th>
				  <th style="align:center;width:8%;">Withdrawals</th>
				  <th style="align:center;width:8%;">Running Balance</th>
				  <th style="align:center;width:10%;">Status</th>
                </tr>
                </thead>
				<tbody>
				<?php
				$que="select * from account_info where bank_s_no='$s_no' and account_status='Active' and company_code='$company_code'";
				$run=mysql_query($que);
				$total_credit_amount=0;
				$total_debit_amount=0;
				$running_amount=0;
				$s_no = 1;
				while($row=mysql_fetch_array($run)){
				$reference = $row['reference'];
				$cheque_status = $row['cheque_status'];
			    $customer_id = $row['customer_id'];
				$payment_mode = $row['payment_mode'];
				$select_bank = "select bank_account_type from bank_or_credit_card_info where s_no='$payment_mode'";
				$run2 = mysql_query($select_bank);
				$fetchr = mysql_fetch_array($run2);
				$bank_account_type = $fetchr['bank_account_type'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$date1 = $row['date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];
				if($transaction_type=='Credit'){
				$credit_amount=$invoice_total_paid;
				$debit_amount='';
				$total_credit_amount=$total_credit_amount+$credit_amount;			
				}else{
				$debit_amount=$invoice_total_paid;
				$credit_amount='';
				$total_debit_amount=$total_debit_amount+$debit_amount;
				}
				$running_amount=$total_credit_amount-$total_debit_amount;
				if($reference =='Customers'){
				   $select_company = "select * from contact_new where s_no='$customer_id'";
				$run2=mysql_query($select_company);
				$row1=mysql_fetch_array($run2);
				$contact_name = $row1['customer_name'];
				$customer_mobile = $row1['customer_mobile'];
				$customer_name  = $contact_name."[".$customer_mobile."]";
				}else if($reference =='Office Expense'){
				      $select_customer2 = "select expense_vendor_name,expense_contact_no from shop_details where s_no='$customer_id'";
					  $run3 = mysql_query($select_customer2);
					  $fetchrow = mysql_fetch_array($run3);
					  $expense_vendor_name = $fetchrow['expense_vendor_name'];
					  $expense_contact_no = $fetchrow['expense_contact_no'];
				      $customer_name = $expense_vendor_name."[".$expense_contact_no."]";
				 } else if($reference =='Product Expense'){
				       $select_customer2 = "select expense_type from product_expense_type_new where s_no='$customer_id'";
					  $run3 = mysql_query($select_customer2);
					  $fetchrow = mysql_fetch_array($run3);
					  $expense_type = $fetchrow['expense_type'];
				      $customer_name = $expense_type;
				 }else if($reference =='Transport Expense'){
				     $select_customer2 = "select * from transport_detail_new where s_no='$customer_id'";
					   $run3 = mysql_query($select_customer2);
					  $fetchrow = mysql_fetch_array($run3);
					  $transport_name = $fetchrow['transport_name'];
				      $customer_name = $transport_name;
				 }
				else{
			    $select_customer = "select contact_first_name,contact_last_name,contact_company_name,contact_contact_phone from contact_master where s_no='$customer_id'";
				$run1 = mysql_query($select_customer);
				$numrow = mysql_num_rows($run1);
				if($numrow>0){
			    $select_cust = mysql_fetch_array($run1);
				$contact_first_name = $select_cust['contact_first_name'];
				$contact_last_name = $select_cust['contact_last_name'];
				$contact_company_name = $select_cust['contact_company_name'];
				$contact_contact_phone = $select_cust['contact_contact_phone'];
				$customer_name = $contact_first_name." ".$contact_last_name."[".$contact_contact_phone."]";
				} }
	            ?>
				<tr>
				  <th><?php echo $s_no; ?></th>
				  <th><?php echo $date; ?></th>
                  <th><a href="javascript:get_content('banking/customer_detail')" style="color:#333; text-decoration:none"><?php echo $customer_name; ?></a></th>
				  <th><?php echo $transaction_type; ?></th>
				  <th><?php echo $bank_account_type; ?></th>
				  <th><?php echo $credit_amount; ?></th>
				  <th><?php echo $debit_amount; ?></th>
				  <th><?php echo $running_amount; ?></th>
				    <?php if($cheque_status=='Cleared') { ?>
				  <th style="color:#2E86C1"><?php echo $cheque_status; ?></th>
				  <?php } else { ?>
				  <th><a href='cheque_dd_details.php' style="color:red"><?php echo $cheque_status; ?></a></th>
				  <?php } ?>
		          <?php $s_no++;  } ?>
				</tr>			
				</tbody>
                </table>
                </div>	
		</div>
		  </div>
		   </div>
		     </div>