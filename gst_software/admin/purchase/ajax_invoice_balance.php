<?php
$invoice_no1 = $_GET['invoice_no'];
if($invoice_no1!=''){
$invoice_no2 = explode('|?|',$invoice_no1);
$invoice_no = $invoice_no2[0];
$table_name = $invoice_no2[1];
include("../../connection/connect.php");
$qry1 = "select * from $table_name where invoice_no='$invoice_no' AND invoice_status='Active' and company_code='$company_code'";
$result = mysql_query($qry1);
$s=0;
while($row1 = mysql_fetch_array($result)){
   $invoice_total_paid1[$s] = $row1['invoice_total_paid'];
   $s=$s+1;
}
$invoice_total_paid1 = array_sum($invoice_total_paid1);
if($invoice_total_paid1){
$query="select * from $table_name where invoice_no='$invoice_no' AND invoice_status='Active' and company_code='$company_code' limit 1";
$result=mysql_query($query);
$i=0;
while($row=mysql_fetch_array($result)){
$invoice_total_paid = $row['invoice_total_paid'];
$invoice_due_amount[$i] = $row['invoice_due_amount'];
$transaction_type = $row['transaction_type'];
$i++;
}
 $invoice_due_amount = array_sum($invoice_due_amount);
echo  $invoice_due_amount.'|?|'.$transaction_type.'|?|'.$invoice_total_paid;
}
else
{
$query="select * from $table_name where invoice_no='$invoice_no' AND invoice_status='Active' and company_code='$company_code'";
$result=mysql_query($query);
$i=0;
while($row=mysql_fetch_array($result)){
$invoice_total_paid = $row['invoice_total_paid'];
$invoice_due_amount[$i] = $row['invoice_due_amount'];
$transaction_type = $row['transaction_type'];
$i++;
}
 $invoice_due_amount = array_sum($invoice_due_amount);
echo  $invoice_due_amount.'|?|'.$transaction_type.'|?|'.$invoice_total_paid;	
}
}
?>