<?php include("../../attachment/session.php");
$msg=0;
 if(isset($_POST['invoice_no']) && isset($_POST['order_return_reason']) && isset($_POST['order_term']))
 {
  $invoice_no=$_POST['invoice_no'];
  $order_return_reason = $_POST['order_return_reason'];
  $order_term = $_POST['order_term'];
  $update_challan_invoice = "update sales_delivery_challan_info SET order_return_reason='$order_return_reason',order_return_term='$order_term',invoice_status2='Return' where invoice_no='$invoice_no'";
  $run = mysql_query($update_challan_invoice);
   if($run) {
        echo $msg = $msg+1;}   
  else {
       echo $msg; }
 }
?>