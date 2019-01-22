<?php include("../../attachment/session.php");
$year = $_POST['year'];
$month = $_POST['month'];
$to_date = $_POST['to_date'];
$date = explode("-",$to_date);
$from_date = $_POST['from_date'];
 $sql = "SELECT * FROM purchase_invoice_new WHERE YEAR(invoice_date) = $date[0] AND MONTH(invoice_date) = $date[1]";
$run = mysql_query($sql);
?>
<table class="table table-stripped" id="printTable" border="1px" cellpadding='0' cellspacing='0'>
		    <tbody>
			   <th width="5%" style="align:center">S_No</th>
			   <th width="10%" style="align:center">Invoice Date</th>
			   <th width="10%" style="align:center">Invoice No</th>
			   <th width="20%" style="align:center">Vendor Name</th>
			   <th width="20%" style="align:center">Product Name</th>
			   <th width="5%" style="align:center">Quantity</th>
			   <th width="10%" style="align:center">Invoice Amount</th>
			   <th width="10%" style="align:center">Pay Amount</th>
			   <th width="10%" style="align:center">Due Amount</th>
			 </tbody>
			 <?php
			 $s_no=1;
while($fetchrow = mysql_fetch_array($run)){
	  $p_id = $fetchrow['invoice_product_name'];
	  $firm_name = $fetchrow['invoice_firm_name'];
	  $select_firm = "select contact_first_name,contact_last_name,contact_company_name from contact_master where s_no='$firm_name' and contact_status='Active' and company_code='$company_code'";
	  $run3 = mysql_query($select_firm);
	  $select_firm_name = mysql_fetch_array($run3);
	  $contact_first_name = $select_firm_name['contact_first_name'];
	  $contact_last_name = $select_firm_name['contact_last_name'];
	  $contact_company_name = $select_firm_name['contact_company_name'];
	  $firm_name = $contact_company_name."[".$contact_first_name." ".$contact_last_name."]";
	  $select_p = "select item_product_name from item where s_no='$p_id' and item_status='Active' and company_code='$company_code'";
	  $run2 = mysql_query($select_p);
	  $fetchproduct = mysql_fetch_array($run2);
	  $product_name = $fetchproduct['item_product_name'];
     ?>
			    <td align='center'><?php echo $s_no; ?>
			    <td align='center'><?php echo $fetchrow['invoice_date']; ?></td>
			    <td align='center'><?php echo $fetchrow['invoice_no']; ?></td>
			    <td align='center'><?php echo $firm_name; ?></td>
			    <td align='center'><?php echo $product_name; ?></td>
			    <td align='center'><?php echo $fetchrow['invoice_quantity']; ?></td>
			    <td align='center'><?php echo $fetchrow['invoice_grand_total']; ?></td>
			    <td align='center'><a href='' style='text-decoration:none;'><?php echo $fetchrow['invoice_total_paid']; ?></a></td>
			    <td align='center' style="color:red"><?php echo $fetchrow['invoice_due_amount']; ?></td>
				</tr>
<?php  $s_no++; } ?>
		</table>