<?php include("../../attachment/session.php");
$inv_no=$_GET['inv_no'];
$inv_type=$_GET['inv_type'];
if($inv_type=='sales'){
$table_name='sales_invoice_info';
}elseif($inv_type=='purchase'){
$table_name='purchase_invoice_info';
}

$query="select * from $table_name where invoice_no='$inv_no' and company_code='$company_code'";
$res=mysql_query($query);
while($row=mysql_fetch_array($res)){
$invoice_payment_mode=$row['invoice_payment_mode'];
$invoice_grand_total=$row['invoice_grand_total'];
$invoice_total_paid=$row['invoice_total_paid'];
$invoice_due = $row['invoice_due_amount'];
$remark=$row['remark'];
$account_type=$row['account_type'];
$account_name=$row['account_name'];
$cheque_dd=$row['cheque_dd'];
$cheque_dd_no=$row['cheque_dd_no'];
$cheque_dd_amount=$row['cheque_dd_amount'];
$cheque_dd_issue_date=$row['cheque_dd_issue_date'];
$cheque_dd_clearing_date=$row['cheque_dd_clearing_date'];
}
echo $invoice_grand_total."|?|".$invoice_payment_mode."|?|".$invoice_total_paid."|?|".$remark."|?|".$account_type."|?|".$account_name."|?|".$cheque_dd."|?|".$cheque_dd_no."|?|".$cheque_dd_amount."|?|".$cheque_dd_issue_date."|?|".$cheque_dd_clearing_date."|?|".$invoice_due;
?>