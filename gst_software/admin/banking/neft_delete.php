<?php include("../../attachment/session.php");
$delete_record=$_GET['account_s_no'];
$invoice_no=$_GET['invoice_no'];
$transaction_type=$_GET['transaction_type'];
$paid_amount=$_GET['paid_amount'];
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
    $query1="update $table set invoice_due_amount='$invoice_due_amount',invoice_total_paid='$invoice_total_paid' where invoice_no='$invoice_no'";
    mysql_query($query1);
}
echo "<script>window.open('neft_details.php','_self')</script>";


}
?>