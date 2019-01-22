<?php  include("../../attachment/session.php");
   if(isset($_GET['status'])){
   $id =$_GET['status'];
   $select = "update sales_delivery_challan_info set invoice_status2='Delivered' where s_no='$id' and company_code='$company_code'";
   $run = mysql_query($select);
  $s_no=0;
    while($row = mysql_fetch_array($run)){
	   $invoice_no = $row['invoice_no'];
	   $invoice_date = $row['invoice_date'];
	   $invoice_due_date = $row['invoice_due_date'];
	   $invoice_firm_id = $row['invoice_firm_name'];
	   $firm_info = "select * from contact_master where s_no='$invoice_firm_id' and company_code='$company_code'";
	   $run_firm = mysql_query($firm_info);
	   $fetchrow = mysql_fetch_array($run_firm);
	   $customer_name = $fetchrow['contact_first_name']." ".$fetchrow['contact_last_name'];
	   $invoice_shipping_address = $row['invoice_shipping_address'];
	   $invoice_product_id = $row['invoice_product_id'];
	   $product_detail = "select * from item_master where s_no='$invoice_product_id' and company_code='$company_code'";
	   $run_detail = mysql_query($product_detail);
	   $fetch_product = mysql_fetch_array($run_detail);
	   $product_name = $fetch_product['item_product_name'];
	   $product_category = $fetch_product['item_sub_group'];
	   $tax_type = $row['invoice_tax_type'];
	   $invoice_sales_amount = $row['invoice_rate'];
	   $invoice_quantity = $row['invoice_quantity'];
	    $invoice_cgst = $row['invoice_cgst'];
		$invoice_cgst1 = $row['invoice_cgst1'];
		$invoice_sgst = $row['invoice_sgst'];
		$invoice_sgst1 = $row['invoice_sgst1'];
		$invoice_igst = $row['invoice_igst'];
		$invoice_igst11 = $row['invoice_igst1'];
		$invoice_grand_total = $row['invoice_grand_total'];
		$invoice_due_amount = $row['invoice_due_amount'];
		echo $s_no++;
		echo $invoice_no."||".$customer_name."||".$invoice_date."||".$invoice_due_date."||".$invoice_shipping_address."||".$product_name."||".$product_category."||".$tax_type."||".$invoice_sales_amount."||".$invoice_quantity."||".$invoice_cgst."||".$invoice_cgst1."||".$invoice_sgst."||".$invoice_sgst1."||".$invoice_igst."||".$invoice_igst1."||".$invoice_grand_total."||".$invoice_due_amount;
	 }
   }
 ?>