<?php
include("../../attachment/session.php");
$invoice_firm_name = $_GET['customer_id'];

echo "<option value=''>Select</option>";
$que1="select * from purchase_invoice_info where invoice_firm_name='$invoice_firm_name' and invoice_status='Active' GROUP BY invoice_no";
$run1=mysql_query($que1);
if(mysql_num_rows($run1)>0){
while($row1=mysql_fetch_array($run1)){
$purchase_invoice_no=$row1['invoice_no'];
$purchase_payment_count=$row1['payment_count'];
$invoice_due_amount=$row1['invoice_due_amount'];
if($invoice_due_amount>0){
echo "<option value='".$purchase_invoice_no.'|?|purchase_invoice_info|?|'.$purchase_payment_count."'>".$purchase_invoice_no."</option>";
}
}
}						
$que2="select * from sales_invoice_info where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' GROUP BY invoice_no";
$run2=mysql_query($que2);
if(mysql_num_rows($run2)>0){
while($row2=mysql_fetch_array($run2)){
$sales_invoice_no=$row2['invoice_no'];						
$sales_payment_count=$row2['payment_count'];
$invoice_due_amount=$row2['invoice_due_amount'];
if($invoice_due_amount>0){
echo "<option value='".$sales_invoice_no.'|?|sales_invoice_info|?|'.$sales_payment_count."'>".$sales_invoice_no."</option>";
}
}
}			
?>
