<?php include("../../attachment/session.php");
if(isset($_POST['edit_firm'])){
$invoice_firm_name=$_POST['invoice_firm_name'];
echo "<script>window.open('../contact/contact_edit.php?id=$invoice_firm_name&page=new_delivery_challan_edit&challan_no=$challan_no&challan_type=$challan_type','_self');</script>";
}
$invoice_no=$_POST['invoice_no'];
$sales_invoice_no = $_POST['sales_invoice_no'];
$sales_challan_no = $_POST['challan_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_reference=$_POST['invoice_reference'];
$invoice_due_date=$_POST['invoice_due_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$invoice_type=$_POST['invoice_type'];
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
$item_mrp = $_POST['item_mrp'];
$transaction_type = "Credit";
if($invoice_type=='sales'){
	$table_name='sales_delivery_challan_info';
	//if($number == 0){
$table_name='sales_delivery_challan_info';
	//}
	//if($number == 1){
	// $table_name='sales_delivery_challan_draft_info';
	//}
$page_name='sales_delivery_challan_list.php';
}elseif($invoice_type=='purchase'){
$table_name='purchase_delivery_challan_info';
$page_name='purchase_delivery_challan_list.php';
}
if($invoice_delete_items!=''){
$invoice_delete_items1=explode(',',$invoice_delete_items);
for($a=0;$a<$invoice_delete_items_count;$a++){
$que4="update $table_name set invoice_status2='Deleted' where s_no='$invoice_delete_items1[$a]' and company_code='$company_name' ";
mysql_query($que4);
}
}
$count=count($invoice_s_no);
$count1=count($item_product_name);
$a=0;
$set=0;
for($i=0; $i<$count; $i++){
	
	$query1="insert into sales_invoice_info (invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,stock_quantity_rate_update,payment_count,challan_no,shipping_date,order_status,invoice_status2,company_name,company_code,item_mrp) values('$invoice_no','$invoice_date','','','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name[$i]','$item_description[$i]','$item_hsn[$i]','$item_quantity[$i]','$item_avail_quantity[$i]','$item_unit[$i]','$item_price[$i]','$item_price1[$i]','$item_price_fix[$i]','$item_discount[$i]','$item_discount_type[$i]','$item_taxable[$i]','$item_tax_type[$i]','$item_tax_amount[$i]','$item_cgst[$i]','$item_cgst1[$i]','$item_sgst[$i]','$item_sgst1[$i]','$item_igst[$i]','$item_igst1[$i]','$item_total_amount[$i]','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','','Active','No','','','','','','','','$transaction_type','','1','$sales_challan_no','','Package','Active','$company_name','$company_code','$item_mrp[$i]')";
	//update table
	$query="update $table_name set invoice_no='$sales_challan_no',invoice_date='$invoice_date',invoice_reference='$invoice_reference',invoice_due_date='$invoice_due_date',invoice_firm_name='$invoice_firm_name',invoice_billing_address='$invoice_billing_address',invoice_shipping_address='$invoice_shipping_address',invoice_gstin_no='$invoice_gstin_no',invoice_place_of_supply='$invoice_place_of_supply',invoice_product_name='$item_product_name[$i]',invoice_description='$item_description[$i]',invoice_hsn='$item_hsn[$i]',invoice_quantity='$item_quantity[$i]',invoice_available_quantity='$item_avail_quantity[$i]',invoice_item_unit='$item_unit[$i]',invoice_rate='$item_price[$i]',invoice_rate1='$item_price1[$i]',invoice_price_fix='$item_price_fix[$i]',invoice_discount='$item_discount[$i]',invoice_discount_type='$item_discount_type[$i]',invoice_taxable='$item_taxable[$i]',invoice_tax_type='$item_tax_type[$i]',invoice_tax='$item_tax_amount[$i]',invoice_cgst='$item_cgst[$i]',invoice_cgst1='$item_cgst1[$i]',invoice_sgst='$item_sgst[$i]',invoice_sgst1='$item_sgst1[$i]',invoice_igst='$item_igst[$i]',invoice_igst1='$item_igst1[$i]',invoice_total='$item_total_amount[$i]',invoice_extra_expences='$invoice_extra_expences',invoice_sub_total='$invoice_sub_total',invoice_total_discount='$total_invoice_discount',invoice_total_discount_type='$total_discount_type',invoice_grand_total='$invoice_grand_total',invoice_payment_mode='$invoice_payment_mode',invoice_total_paid='$invoice_total_paid',remark='$remark',invoice_due_amount='$invoice_due_amount',invoice_customer_notes='$invoice_customer_notes',invoice_terms_and_conditions='$invoice_terms_and_conditions',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',invoice_status2='Delivered',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date' where s_no='$invoice_s_no[$i]'";
	if(mysql_query($query1) && mysql_query($query)){
$set=$set+1;
$a=$a+1;
} }
$sales_invoice_no=$sales_invoice_no+1;
$que2="update invoice_no set sales_invoice_no='$sales_invoice_no' where company_code='$company_code'";
mysql_query($que2);
  if($set>0){
echo "|?|success|?|";
}  ?>