<?php
include("../../connection/connect.php");
$invoice_no = $_POST['invoice_no'];
$invoice_type = $_POST['inv_type'];
$select = "select * from purchase_retainer_invoice where invoice_no='$invoice_no'";
$run = mysql_query($select);
$fetchrow = mysql_fetch_array($run);
if($fetchrow){
echo $query="insert into purchase_invoice_info(invoice_no,invoice_date,invoice_reference,
invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,
invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,
invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,
invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,
invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,
invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,
invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,
invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,
invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,
account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,
cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,
stock_quantity_rate_update,payment_count,challan_no,shipping_date,
order_status,sales_person_name,sales_excutive_name,transport_name,invoice_status2) values('".$fetchrow['invoice_no']."','".$fetchrow['invoice_date']."','".$fetchrow['invoice_reference']."',
'".$fetchrow['invoice_due_date']."','".$fetchrow['invoice_firm_name']."','".$fetchrow['invoice_billing_address']."','".$fetchrow['invoice_shipping_address']."',
'".$fetchrow['invoice_gstin_no']."','".$fetchrow['invoice_place_of_supply']."','".$fetchrow['invoice_product_name']."','".$fetchrow['invoice_description']."',
'".$fetchrow['invoice_hsn']."','".$fetchrow['invoice_quantity']."','".$fetchrow['invoice_available_quantity']."','".$fetchrow['invoice_rate']."','".$fetchrow['invoice_rate1']."',
'".$fetchrow['invoice_price_fix']."','".$fetchrow['invoice_price_fix']."','".$fetchrow['invoice_discount']."','".$fetchrow['invoice_discount_type']."','".$fetchrow['invoice_taxable']."',
'".$fetchrow['invoice_tax_type']."','".$fetchrow['invoice_tax']."','".$fetchrow['invoice_cgst']."','".$fetchrow['invoice_cgst1']."','".$fetchrow['invoice_sgst']."','".$fetchrow['invoice_sgst1']."',
'".$fetchrow['invoice_igst']."','".$fetchrow['invoice_igst1']."','".$fetchrow['invoice_total']."','".$fetchrow['invoice_extra_expences']."','".$fetchrow['invoice_sub_total']."',
'".$fetchrow['invoice_total_discount']."','".$fetchrow['invoice_total_discount_type']."','".$fetchrow['invoice_grand_total']."','".$fetchrow['invoice_payment_mode']."',
'".$fetchrow['invoice_total_paid']."','".$fetchrow['remark']."','".$fetchrow['invoice_due_amount']."','".$fetchrow['invoice_customer_notes']."','".$fetchrow['invoice_terms_and_conditions']."',
'".$fetchrow['invoice_type']."','Active','No','".$fetchrow['account_type']."','".$fetchrow['account_name']."','".$fetchrow['cheque_dd']."','".$fetchrow['cheque_dd_no']."','".$fetchrow['cheque_dd_amount']."',
'".$fetchrow['cheque_dd_issue_date']."','".$fetchrow['cheque_dd_clearing_date']."','".$fetchrow['transaction_type']."','','1','','','Package','".$fetchrow['sales_person_name']."',
'".$fetchrow['sales_excutive_name']."','".$fetchrow['transport_name']."','Retainer')";
$insert = mysql_query($query);
if($insert){
      $update_retainer = "UPDATE purchase_retainer_invoice set invoice_status2='Invoiced' where invoice_no='$invoice_no'";
	  $run = mysql_query($update_retainer);
}
}
?>