<?php include("../../attachment/session.php"); ?>
 <form method="POST">
	 <table class="table">	
<?php
	   $from_date = $_GET['from_date']; 
       $to_date = $_GET['to_date'];
$que12="SELECT * FROM sales_invoice_info WHERE order_status='Package' AND invoice_status='Active' AND invoice_date >= '$from_date' AND invoice_date <= '$to_date' GROUP BY invoice_no ORDER BY invoice_date DESC";
$run12=mysql_query($que12) or die(mysql_error());
$serial=0;
$i = 0;
while($row12=mysql_fetch_array($run12)){
$s_no = $row12['s_no'];
$s_no_array[$i] = $row12['s_no'];
$order_id = $row12['invoice_no'];
$invoice_date = $row12['invoice_date'];
$invoice_quantity = $row12['invoice_quantity'];
$customer_id = $row12['invoice_firm_name'];
$select_customer = "select contact_first_name,contact_last_name from contact_master where s_no='$customer_id'";
$runq = mysql_query($select_customer);
$row_fetch = mysql_fetch_array($runq);
$customer_name = $row_fetch['contact_first_name']." ".$row_fetch['contact_last_name'];
$invoice_quantity=$row12['invoice_quantity'];
$order_status = $row12['order_status'];
$total = $row12['invoice_grand_total'];
$serial++;
$serial_array[$i] = $serial;
$i++;
?>			        
 <tr>
 <td>
<input type="checkbox" name="select_checkbox[]" value="<?php echo $serial; ?>" class="all_check2"/>
 <input type="hidden" name="s_no[]" value="<?php echo $s_no; ?>" />
 </td>
 <td><?php echo $customer_name; ?> <br/>
 <a href="#">#<?php echo $order_id; ?></a><br/>
 <?php echo $invoice_date; ?></td>
 <td></td>
 <td><?php echo $invoice_quantity; ?></td>
 <td>&#8377;&nbsp;<?php echo $total; ?></td>
 </tr>
 <?php } ?>
  <tr> 
<td colspan="2">						  
 <button type="submit" name="submit1" class="btn my_background_color">Shipped </button>
 </td>
 <td colspan="2">
  <button type="submit" name="delivered1" class="btn my_background_color">Delivered </button>
  </td>
  <td colspan="2">
   <button type="submit" name="cancel1" class="btn my_background_color">Cancel </button>
   </td>
	 </tr> 
	 </table>
	 </form>
	 