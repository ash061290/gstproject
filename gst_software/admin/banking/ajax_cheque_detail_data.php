<?php include("../../attachment/session.php");
 $account_id = $_POST['invoice_id'];
$sql = "select * from account_info where s_no='$account_id' and account_status='Active' and cheque_status='Uncleared' and company_code='$company_code'";
$run = mysql_query($sql);
$fetchrow = mysql_fetch_array($run);
$invoice_no = $fetchrow['invoice_no'];
$transaction_type = $fetchrow['transaction_type'];
if($transaction_type == "Credit"){
   $table_name = "sales_invoice_info";
   $sql = "select invoice_date,invoice_due_date,invoice_grand_total,invoice_due_amount from $table_name where invoice_status='Active' and company_code='$company_code'";
   $selectrow = mysql_fetch_array($sql);
   $invoice_date = $selectrow['invoice_date'];
   $invoice_due_date = $selectrow['invoice_due_date'];
   $invoice_grand_total = $selectrow['invoice_grand_total'];
   $invoice_due_amount = $selectrow['invoice_due_amount'];
}
else{
	 $table_name = "purchase_invoice_info";
   $sql = "select invoice_date,invoice_due_date,invoice_grand_total,invoice_due_amount from $table_name where invoice_status='Active' and company_code='$company_code'";
   $selectrow = mysql_fetch_array($sql);
   $invoice_date = $selectrow['invoice_date'];
   $invoice_due_date = $selectrow['invoice_due_date'];
   $invoice_grand_total = $selectrow['invoice_grand_total'];
   $invoice_due_amount = $selectrow['invoice_due_amount'];
    
}
$result = 
?>