<?php include("../../attachment/session.php");
if(isset($_POST['cheque_type'])){
$cheque_type=$_POST['cheque_type'];
  if($cheque_type == 'Cleared Cheque')
  {
	?>
	 <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Issue Date</th>
                  <th>Clearing Date</th>
                  <th>Company Name</th>
                  <th>Account Name</th>
                  <th>Cheque/DD No</th>
				  <th>Type</th>				  
				  <th>Payment Mode</th>
				  <th>Amount</th>
				  <th>Action</th>
				  <th>Cheque Status</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from account_info where payment_mode='Cheque' and account_status='Active' and cheque_status='Cleared' or payment_mode='DD' and account_status='Active' and cheque_status='Cleared' and company_code='$company_code'";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['reference'];
				$customer_id = $row['customer_id'];
				$cheque_status = $row['cheque_status'];
				$payment_mode = $row['payment_mode'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$account_name = $row['account_name'];
				$cheque_dd = $row['cheque_dd'];
				$cheque_dd_no = $row['cheque_dd_no'];
				$cheque_dd_issue_date1 = $row['cheque_dd_issue_date'];
				$cheque_dd_issue_date2 = explode("-",$cheque_dd_issue_date1);
				$cheque_dd_issue_date=$cheque_dd_issue_date2[2]."-".$cheque_dd_issue_date2[1]."-".$cheque_dd_issue_date2[0];
				$cheque_dd_clearing_date1 = $row['cheque_dd_clearing_date'];
				$cheque_dd_clearing_date2 = explode("-",$cheque_dd_clearing_date1);
				$cheque_dd_clearing_date=$cheque_dd_clearing_date2[2]."-".$cheque_dd_clearing_date2[1]."-".$cheque_dd_clearing_date2[0];
				$date1 = $row['date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];
				
				$que1="select * from contact_master where s_no='$customer_id' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $cheque_dd_issue_date; ?></th>
                  <th><?php echo $cheque_dd_clearing_date; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
                  <th><?php echo $account_name; ?></th>
                  <th><?php echo $cheque_dd_no; ?></th>
                  <th><?php echo $payment_mode; ?></th>
                  <th><?php echo $transaction_type; ?></th>				  
                  <th><?php echo $invoice_total_paid; ?></th>
				  <th>
				  <ul class="nav nav-tabs">
				  <li class="dropdown">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Status
				  <span class="fa fa-caret-down"></span></button>
				  <ul class="dropdown-menu">
				  <li><a href='cheque_clear.php?id=<?php echo $account_s_no; ?>&cheque=Uncleared' onclick="return clear_cheque()">Cheque Uncleared</a></li>
				  <li><a href='cheque_clear.php?id=<?php echo $account_s_no; ?>&cheque=Bounced' onclick="return bounce_cheque()">Cheque Bounced</a></li>
				  </ul>
				  </li>
				  </ul>				
				  </th>
                  <th><?php echo $cheque_status; ?></th>				  
				  <?php } } ?>
				</tr>					
				</tbody>
                </table>
	
<?php	
  }
   if($cheque_type == 'Bounced Cheque')
  {
	  
  }
}
?>	