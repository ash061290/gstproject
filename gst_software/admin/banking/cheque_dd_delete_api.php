<?php
 include("../../attachment/session.php");
$delete_record=$_POST['account_s_no'];
$invoice_no=$_POST['invoice_no'];
$transaction_type=$_POST['transaction_type'];
$paid_amount=$_POST['paid_amount'];
$company_code=$_POST['company_code'];
$query="update account_info set account_status='Deleted' where s_no='$delete_record'";
if(mysql_query($query)){

if($transaction_type=='Credit'){
    $table='sales_invoice_info';
	}else{
	$table='purchase_invoice_info';
	}
	if($invoice_no!=''){
    $que1="select * from $table where invoice_no='$invoice_no' and company_code='$company_code'";
	$run1=mysql_query($que1);
	while($row1=mysql_fetch_array($run1)){
	$invoice_due_amount = $row1['invoice_due_amount'];
	$invoice_total_paid = $row1['invoice_total_paid'];
	$invoice_due_amount =$invoice_due_amount+$paid_amount;
	$invoice_total_paid =$invoice_total_paid-$paid_amount;
	}
    $query1="update $table set invoice_due_amount='$invoice_due_amount',invoice_total_paid='$invoice_total_paid' where company_code='$company_code' and invoice_no='$invoice_no'";
    mysql_query($query1);
}
    echo "|?|success|?|";
   //echo "<script>window.open('cheque_dd_details.php','_self')</script>";


}


?>