<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Referance</th>				  
				  <th>Customer Name</th>
				  <th>Mode Of Payment</th>
				  <th>Amount</th>
				  <th>Due Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody>		
<?php 
include("../../connection/connect.php");
include("../../attachment/session.php");
  if(isset($_POST['payment_type'])){
       $invoice_payment_type = $_POST['payment_type'];
	   $select = "select * from sales_invoice_info where invoice_status2='$invoice_payment_type' and invoice_status='Active' and company_code='$company_code' group by invoice_no";
	   $run = mysql_query($select);
	   $serial_no=0;
	while($row = mysql_fetch_array($run)){
	$s_no=$row['s_no'];
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_due_date1=$row['invoice_due_date'];
	$invoice_due_date2=explode('-',$invoice_due_date1);
	$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$invoice_order_no=$row['invoice_order_no'];
	$invoice_type=$row['invoice_type'];
	$reference = $row['invoice_reference'];
	$invoice_status=$row['invoice_status'];
	$invoice_status2 = $row['invoice_status2'];
	$invoice_payment_mode = $row['invoice_payment_mode'];
	if($invoice_payment_mode == ''){ $invoice_payment_mode ="Unpaid Invoice"; }
	$serial_no++;
	$que1="select * from contact_master where s_no='$invoice_firm_name'";
	$run1=mysql_query($que1) or die(mysql_error());
	$row1=mysql_fetch_array($run1);
	$contact_company_name=$row1['contact_company_name'];
	$contact_tittle_name=$row1['contact_tittle_name'];
	$contact_first_name=$row1['contact_first_name'];
	$contact_last_name=$row1['contact_last_name'];
			?>
				<tr>
				  <th><?php echo $invoice_date; ?></th>
                  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $reference; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
				  <th><?php echo $invoice_payment_mode; ?></th>
				  <th><?php echo $invoice_grand_total; ?></th>
				  <th><?php echo $invoice_due_amount; ?></th>
				  <th>
				     <a style="color:Red;" aria-hidden="true" onclick="if(window.confirm(' Do You Want Deleted..'))return myFunction('<?php echo $invoice_no; ?>')" class="fa fa-trash-o" style="font-size:48px;" href='#'></a>
				    </th>
				</tr>	
				  <?php } } ?>

         <?php  
  		 $select = "select * from sales_invoice_draft_info where invoice_status2='$invoice_payment_type' and invoice_status='Active' and company_code='$company_code' group by invoice_no ";
	   $run = mysql_query($select);
	   $serial_no=0;
	while($row = mysql_fetch_array($run)){
	$s_no=$row['s_no'];
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_due_date1=$row['invoice_due_date'];
	$invoice_due_date2=explode('-',$invoice_due_date1);
	$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$invoice_order_no=$row['invoice_order_no'];
	$invoice_type=$row['invoice_type'];
	$reference = $row['invoice_reference'];
	$invoice_status=$row['invoice_status'];
	$invoice_status2 = $row['invoice_status2'];
	$invoice_payment_mode = $row['invoice_payment_mode'];
	if($invoice_payment_mode == ''){ $invoice_payment_mode ="Unpaid Invoice"; }
	$serial_no++;
	$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
	$run1=mysql_query($que1) or die(mysql_error());
	$row1=mysql_fetch_array($run1);
	$contact_company_name=$row1['contact_company_name'];
	$contact_tittle_name=$row1['contact_tittle_name'];
	$contact_first_name=$row1['contact_first_name'];
	$contact_last_name=$row1['contact_last_name'];
			?>
				<tr>
				  <th><?php echo $invoice_date; ?></th>
                  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $reference; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
				  <th><?php echo $invoice_payment_mode; ?></th>
				  <th><?php echo $invoice_grand_total; ?></th>
				  <th><?php echo $invoice_due_amount; ?></th>
				  <th>
				     <a style="color:Red;" aria-hidden="true" onclick="if(window.confirm(' Do You Want Deleted..'))return myFunction('<?php echo $invoice_no; ?>')" class="fa fa-trash-o" style="font-size:48px;" href='#'></a>
				    </th>
				</tr>		
  <?php } ?>				

				</tbody>
                </table>	