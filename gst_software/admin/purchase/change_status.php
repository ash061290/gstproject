<?php
include("../../connection/connect.php");
$msg=0;
 if(isset($_GET['challan_no']));
 {
   $challan_no = $_GET['challan_no'];
   $select = "select purchase_invoice_info.invoice_due_amount,purchase_invoice_info.invoice_grand_total from purchase_invoice_info join purchase_delivery_challan_info on purchase_invoice_info.challan_no=purchase_delivery_challan_info.invoice_no where purchase_invoice_info.invoice_status='Active' AND purchase_delivery_challan_info.invoice_no='$challan_no' and purchase_invoice_info.company_code='$company_code' and purchase_delivery_challan_info.company_code='$company_code' GROUP BY purchase_delivery_challan_info.invoice_no";
   $run = mysql_query($select);
   $fetchrun = mysql_fetch_array($run);
   $due_amount = $fetchrun['invoice_due_amount'];
   $invoice_grand_total = $fetchrun['invoice_grand_total'];
   $select_sales_order = "select order_no from purchase_delivery_challan_info where invoice_no='$challan_no' and company_code='$company_code'";
   $run = mysql_query($select_sales_order);
   $fetch = mysql_fetch_array($run);
   $order_no = $fetch['order_no'];
   $qry_sales_order = "update purchase_order_info set purchase_order_status='Delivered' where invoice_no='$order_no' and company_code='$company_code'";
  mysql_query($qry_sales_order);
   $qry = "update purchase_delivery_challan_info set invoice_status2='Delivered' where invoice_no='$challan_no' and company_code='$company_code'";
   $qry2 ="update purchase_invoice_info set order_status='Delivered' where challan_no='$challan_no' and company_code='$company_code'";
   mysql_query($qry2);
   if(mysql_query($qry)){
 echo "<script>window.open('purchase_delivery_challan_list.php','_self');</script>";
   }
  
//end

}

?>