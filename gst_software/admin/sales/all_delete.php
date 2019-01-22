<?php
include("../../connection/connect.php");
include("../../attachment/session.php");
 if(isset($_GET['receive_payment_delete'])) 
 {
 $m=0;
 $delete_id = $_GET['receive_payment_delete'];
 $select = "select * from sales_invoice_info where invoice_no='$invoice_id' and company_code='$company_code'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
	$query="update sales_invoice_draft_info set invoice_status='Deleted' where invoice_no='$invoice_id' and company_code='$company_code'"; }
else{
$query="update sales_invoice_info set invoice_status='Deleted' where invoice_no='$invoice_id' and company_code='$company_code'"; }
 if(mysql_query($update_table)) {
 echo $m = $m+1;  }
 else {
 echo $m; } }
 //advance_payment_page_advance_pay_add
 
 if(isset($_GET['advance_payment_delete']))  {
 $m=0;
 $delete_id = $_GET['advance_payment_delete'];
 $update_table = "update sales_invoice_info set invoice_status='Deleted' where invoice_no='$delete_id' and company_code='$company_code'";
 if(mysql_query($update_table)) {
 echo $m = $m+1; }
 else {
 echo $m;
 }
 }
 //end
 ?>