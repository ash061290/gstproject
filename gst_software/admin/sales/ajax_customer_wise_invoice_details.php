<?php include("../../attachment/session.php");
$invoice_firm_name = $_GET['customer_id'];
$inv_type = $_GET['inv_type'];
echo "<option value=''>Select</option>";
if(isset($_GET['customer_id']))
{
 $que2="select * from sales_invoice_new where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' and invoice_status2='$inv_type' and company_code='$company_code'";
}
if($inv_type == 'Order')
{
$que2="select * from sales_invoice_new where invoice_status='Active' and invoice_firm_name='$invoice_firm_name' and company_code='$company_code'";	
}
$run2=mysql_query($que2);
if(mysql_num_rows($run2)>0){
while($row2=mysql_fetch_array($run2)){
$sales_invoice_no=$row2['invoice_no'];						
$sales_payment_count=$row2['payment_count'];
$invoice_due_amount=$row2['invoice_due_amount'];
if($invoice_due_amount>0){
echo "<option value='".$sales_invoice_no.'|?|sales_invoice_new|?|'.$sales_payment_count."'>".$sales_invoice_no."</option>";
}
}
}	
?>
