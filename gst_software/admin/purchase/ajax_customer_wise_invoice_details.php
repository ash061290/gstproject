<?php
include("../../connection/connect.php");
echo "<option value=''>Select</option>";
if(isset($_GET['customer_id']))
{
$invoice_firm_name = $_GET['customer_id'];
$que2="select * from purchase_invoice_info where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' and company_code='$company_code' and advance_no!=''";
}
if(isset($_GET['customer_id2']))
{
$invoice_firm_name = $_GET['customer_id2'];
 $que2="select * from purchase_invoice_info where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' and company_code='$company_code' GROUP BY invoice_no";
}
if(isset($_GET['customer_id3']))
{
 $invoice_firm_name = $_GET['customer_id3'];
 $que2="select * from purchase_invoice_info where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' and company_code='$company_code' and challan_no!=''";
}					

$run2=mysql_query($que2);
if(mysql_num_rows($run2)>0){
while($row2=mysql_fetch_array($run2)){
$sales_invoice_no=$row2['invoice_no'];						
$sales_payment_count=$row2['payment_count'];
$invoice_due_amount=$row2['invoice_due_amount'];
if($invoice_due_amount>0){
echo "<option value='".$sales_invoice_no.'|?|purchase_invoice_info|?|'.$sales_payment_count."'>".$sales_invoice_no."</option>";
}
}
}			
?>
