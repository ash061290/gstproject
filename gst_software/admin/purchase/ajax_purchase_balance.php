<?php
$invoice_no1 = $_GET['invoice_no'];
if($invoice_no1!=''){

include("../../connection/connect.php");
$query="select * from purchase_retainer_invoice where invoice_no='$invoice_no1' AND invoice_status='Active'";
$result=mysql_query($query);
$i=0;
while($row=mysql_fetch_array($result)){
$invoice_total_paid = $row['invoice_grand_total'];
$invoice_due_amount[$i] = $row['invoice_due_amount'];
$transaction_type = $row['transaction_type'];
$i++;
}
 $invoice_due_amount = array_sum($invoice_due_amount);
echo  $invoice_due_amount.'|?|'.$transaction_type.'|?|'.$invoice_total_paid;
}
?>