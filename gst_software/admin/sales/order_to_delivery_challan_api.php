<?php include("../../attachment/session.php");
$item_mrp=$_POST['item_mrp'];
$invoice_no=$_POST['invoice_no'];
$delivery_challan_no = $_POST['delivery_challan_no'];
$invoice_order_no = $_POST['invoice_order_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_reference=$_POST['invoice_reference'];
$invoice_due_date=$_POST['invoice_due_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$invoice_type="sales";
$invoice_gstin_no=$_POST['invoice_gstin_no'];
$invoice_place_of_supply=$_POST['invoice_place_of_supply'];
$invoice_billing_address=$_POST['invoice_billing_address'];
$invoice_shipping_address=$_POST['invoice_shipping_address'];
$invoice_s_no=$_POST['invoice_s_no'];
$item_product_name=$_POST['item_product_name'];
$item_description=$_POST['item_description'];
$item_hsn=$_POST['item_hsn'];
$item_quantity=$_POST['item_quantity'];
$item_avail_quantity=$_POST['item_avail_quantity'];
$item_unit=$_POST['item_unit'];
$item_price=$_POST['item_price'];
$item_price1=$_POST['item_price1'];
$item_price_fix=$_POST['item_price_fix'];
$item_discount=$_POST['item_discount'];
$item_discount_type=$_POST['item_discount_type'];
$item_taxable=$_POST['item_taxable'];
$item_tax_type=$_POST['item_tax_type'];
$item_tax_amount=$_POST['item_tax_amount'];
$item_cgst=$_POST['item_cgst'];
$item_cgst1=$_POST['item_cgst1'];
$item_sgst=$_POST['item_sgst'];
$item_sgst1=$_POST['item_sgst1'];
$item_igst=$_POST['item_igst'];
$item_igst1=$_POST['item_igst1'];
$item_total_amount=$_POST['item_total_amount'];
$challan_type = $_POST['challan_type'];
$invoice_extra_expences=$_POST['invoice_extra_expences'];
$invoice_sub_total=$_POST['invoice_sub_total'];
$total_invoice_discount=$_POST['total_invoice_discount'];
$total_discount_type=$_POST['total_discount_type'];
$invoice_grand_total=$_POST['invoice_grand_total'];
$invoice_payment_mode=$_POST['invoice_payment_mode'];
$invoice_total_paid=$_POST['invoice_total_paid'];
$remark="";
$invoice_due_amount=$_POST['invoice_due_amount'];
$invoice_customer_notes=$_POST['invoice_customer_notes'];
$invoice_terms_and_conditions=$_POST['invoice_terms_and_conditions'];
$account_type=$_POST['account_type'];
$account_name=$_POST['account_name'];
$cheque_dd=$_POST['cheque_dd'];
$cheque_dd_no=$_POST['cheque_dd_no'];
$cheque_dd_amount=$_POST['cheque_dd_amount'];
$cheque_dd_issue_date=$_POST['cheque_dd_issue_date'];
$cheque_dd_clearing_date=$_POST['cheque_dd_clearing_date'];
$invoice_delete_items=$_POST['invoice_delete_items'];
$invoice_delete_items_count=$_POST['invoice_delete_items_count'];
if($invoice_type=='sales'){
$table_name='sales_delivery_challan_info';
$page_name='sales_delivery_challan_list.php';
$transaction_type = "credit";
}elseif($invoice_type=='purchase'){
$table_name='purchase_delivery_challan_info';
$page_name='purchase_delivery_challan_list.php';
}
$count=count($item_product_name);
$set=0;
for($j=0; $j<$count; $j++){
 $query1="insert into $table_name(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,challan_type,order_no,invoice_status2,company_name,company_code,item_mrp) values('$invoice_no','$invoice_date','$invoice_reference','$invoice_due_date','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name[$j]','$item_description[$j]','$item_hsn[$j]','$item_quantity[$j]','$item_avail_quantity[$j]','$item_unit[$j]','$item_price[$j]','$item_price1[$j]','$item_price_fix[$j]','$item_discount[$j]','$item_discount_type[$j]','$item_taxable[$j]','$item_tax_type[$j]','$item_tax_amount[$j]','$item_cgst[$j]','$item_cgst1[$j]','$item_sgst[$j]','$item_sgst1[$j]','$item_igst[$j]','$item_igst1[$j]','$item_total_amount[$j]','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$remark','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','$invoice_type','Active','$invoice_order_no','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','$challan_type','$invoice_order_no','No Invoice','$company_name','$company_code','$item_mrp[$j]')";
  echo $update_sales_order = "update sales_order_info set sales_order_status='Challan Created' where invoice_no='$invoice_order_no' and company_code='$company_code'";
 mysql_query($update_sales_order);
if(mysql_query($query1)){
$set=$set+1;
} }
$delivery_challan_no=$delivery_challan_no+1;
$que2="update invoice_no set delivery_challan_no='$delivery_challan_no' where company_code='$company_code'";
mysql_query($que2);
if($set>0){
echo "|?|success|?|";
} 
?>
