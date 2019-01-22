<?php
include("../../connection/connect.php");
echo "<option value=''>Select</option>";
$invoice_firm_name = $_GET['customer_id'];
if(isset($_GET['customer_id']))
{
$que2="select * from purchase_retainer_invoice where invoice_status='Active' and customer_id='$invoice_firm_name' and company_code='$company_code' order by invoice_no";
$run2=mysql_query($que2);
if(mysql_num_rows($run2)>0){
while($row2=mysql_fetch_array($run2)){
$sales_invoice_no=$row2['invoice_no'];						
$invoice_due_amount=$row2['invoice_due_amount'];
if($invoice_due_amount>0){
echo "<option value='".$sales_invoice_no."'>".$sales_invoice_no."</option>";
}					

}
}
}			
?>
