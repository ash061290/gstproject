<?php include("../../attachment/session.php");
$msg=0;
 if(isset($_GET['challan_no']));
 {
   $challan_no = $_GET['challan_no'];
   $select = "select sales_invoice_info.invoice_due_amount,sales_invoice_info.invoice_grand_total from sales_invoice_info join sales_delivery_challan_info on sales_invoice_info.challan_no=sales_delivery_challan_info.invoice_no where sales_invoice_info.invoice_status='Active' AND sales_delivery_challan_info.invoice_no='$challan_no' and sales_delivery_challan_info.company_code='$company_code' GROUP BY sales_delivery_challan_info.invoice_no";
   $run = mysql_query($select);
   $fetchrun = mysql_fetch_array($run);
   $due_amount = $fetchrun['invoice_due_amount'];
   $invoice_grand_total = $fetchrun['invoice_grand_total'];
  $select_sales_order = "select order_no from sales_delivery_challan_info where invoice_no='$challan_no' and company_code='$company_code'";
  $run = mysql_query($select_sales_order);
  $fetch = mysql_fetch_array($run);
  $order_no = $fetch['order_no'];
  $qry_sales_order = "update sales_order_info set sales_order_status='Delivered' where invoice_no='$order_no' and company_code='$company_code'";
  mysql_query($qry_sales_order);
   $fetch = "select * from sales_delivery_challan_info where invoice_no='$challan_no' and company_code='$company_code'";
   $run = mysql_query($fetch);
   $numrow = mysql_num_rows($run);
   if($numrow<1){
   $qry = "update sales_delivery_challan_draft_info set invoice_status2='Delivered' where invoice_no='$challan_no' and company_code='$company_code'";
   }
   else{
	  $qry = "update sales_delivery_challan_info set invoice_status2='Delivered' where invoice_no='$challan_no' and company_code='$company_code'";  
   }
   $qry2 ="update sales_invoice_info set order_status='Delivered' where challan_no='$challan_no' and company_code='$company_code'";
   mysql_query($qry2);
   if(mysql_query($qry)){
   echo "success";
   }
  
//end

}

?>