<?php include("../../attachment/session.php");
echo "<option value=''>Select</option>";
//draft
if(isset($_GET['customer_id']))
{
$invoice_firm_name = $_GET['customer_id'];
$que3="select * from sales_invoice_draft_info where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' and advance_no!='' and company_code='$company_code'";
}
if(isset($_GET['customer_id2']))
{
$invoice_firm_name = $_GET['customer_id2'];
 $que3="select * from sales_invoice_draft_info where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' and company_code='$company_code' GROUP BY invoice_no";
}
if(isset($_GET['customer_id3']))
{
 $invoice_firm_name = $_GET['customer_id3'];
 $que3="select * from sales_invoice_draft_info where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' and challan_no!='' and company_code='$company_code'";
}					
$run3 = mysql_query($que3);
if(mysql_num_rows($run3)>0){
while($row3=mysql_fetch_array($run3)){
$sales_invoice_no2=$row3['invoice_no'];						
$sales_payment_count2=$row3['payment_count'];
$invoice_due_amount2=$row3['invoice_due_amount'];
if($invoice_due_amount2>0){
echo "<option value='".$sales_invoice_no.'|?|sales_invoice_info|?|'.$sales_payment_count."'>".$sales_invoice_no."</option>";
} } }	
?>
