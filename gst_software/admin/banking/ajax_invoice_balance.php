<?php include("../../attachment/session.php");

$invoice_no1 = $_GET['invoice_no'];
$company_code = $_GET['company_code'];
if($invoice_no1!=''){
$invoice_no2 = explode('|?|',$invoice_no1);
$invoice_no = $invoice_no2[0];
$table_name = $invoice_no2[1];


$query="select * from $table_name where invoice_no='$invoice_no' and company_code='$company_code'";
$result=mysql_query($query);
while($row=mysql_fetch_array($result)){
$invoice_due_amount = $row['invoice_due_amount'];
$transaction_type = $row['transaction_type'];
$invoice_total_paid = $row['invoice_total_paid'];
}
echo $invoice_due_amount.'|?|'.$transaction_type.'|?|'.$invoice_total_paid;
}
?>