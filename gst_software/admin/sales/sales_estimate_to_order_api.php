<?php include("../../attachment/session.php");
$item_mrp=$_POST['item_mrp'];
$invoice_no=$_POST['invoice_no'];
$sales_estimate_no=$_POST['sales_estimate_no'];
$sales_order_no = $_POST['sales_order_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_reference=$_POST['invoice_reference'];
$invoice_due_date=$_POST['invoice_due_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$invoice_type="sales";
$invoice_gstin_no=$_POST['invoice_gstin_no'];
$sales_person_name = $_POST['sales_person_name'];
$sales_excutive_name = $_POST['sales_excutive_name'];
//$transport_name = $_POST['transport_name'];
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

//$upload_file_name=$_FILES['upload_file']['name'];            
//$upload_file_temp=$_FILES['upload_file']['tmp_name'];

$invoice_payment_mode='';
$cheque_status='';
$invoice_delete_items=$_POST['invoice_delete_items'];
$invoice_delete_items_count=$_POST['invoice_delete_items_count'];
if($invoice_type=='sales'){
$table_name='sales_order_info';
$page_name='sales_order_list.php';
$stock_quantity_rate_update='';
}
$count=count($item_product_name);
$set=0;
for($j=0; $j<$count; $j++){
	$query1="insert into $table_name(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,estimate_no,sales_person_name,sales_excutive_name,sales_order_status,company_name,company_code,item_mrp) values('$invoice_no','$invoice_date','$invoice_reference','$invoice_due_date','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name[$j]','$item_description[$j]','$item_hsn[$j]','$item_quantity[$j]','$item_avail_quantity[$j]','$item_unit[$j]','$item_price[$j]','$item_price1[$j]','$item_price_fix[$j]','$item_discount[$j]','$item_discount_type[$j]','$item_taxable[$j]','$item_tax_type[$j]','$item_tax_amount[$j]','$item_cgst[$j]','$item_cgst1[$j]','$item_sgst[$j]','$item_sgst1[$j]','$item_igst[$j]','$item_igst1[$j]','$item_total_amount[$j]','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$remark','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','$invoice_type','Active','yes','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','','$sales_estimate_no','$sales_person_name','$sales_excutive_name','No Challan','$company_name','$company_code','$item_mrp[$j]')";
if(mysql_query($query1)){
$set=$set+1;
}

if($invoice_type=='sales'){
	$update_estimate = "update sales_estimate_info set estimate_status='Invoiced',estimate_status2='Invoiced' where invoice_no='$sales_estimate_no' and company_code='$company_code'";
	 $qry_estimate = mysql_query($update_estimate);
	 $que4="select * from item_master where s_no='$item_product_name[$j]' and company_code='$company_code'";
$res4=mysql_query($que4);
$row4=mysql_fetch_array($res4);
$stock_item_quantity=$row4['item_quantity'];
$item_quantity_modify_count=$row4['item_quantity_modify_count']+1;
$stock_item_quantity=$stock_item_quantity-$item_quantity[$j];
$que5="update item_master set item_quantity='$stock_item_quantity',item_quantity_modify_count='$item_quantity_modify_count' where s_no='$item_product_name[$j]' and company_code='$company_code'";
 echo $qry6 = "update sales_estimate_info set invoice_quantity='$item_quantity[$j]',invoice_available_quantity='$stock_item_quantity',estimate_status2='Order' where invoice_no='$sales_estimate_no' and company_code='$company_code'";
mysql_query($qry6);
mysql_query($que5);
} }
	 /* if($number == 0){
	$update_estimate = "update sales_estimate_info set estimate_status='Invoiced',estimate_status2='Invoiced' where invoice_no='$estimate_no' and company_code='$company_code'";
	  }
	  if($number == 1){
		   $update_estimate = "update sales_estimate_draft_info set estimate_status='Invoiced',estimate_status2='Invoiced' where invoice_no='$estimate_no' and company_code='$company_code'";
	  }
	 $qry_estimate = mysql_query($update_estimate); */

/*
if($number==0){
	$qry6 = "update sales_estimate_info set invoice_quantity='$item_quantity[$j]',invoice_available_quantity='$stock_item_quantity',estimate_status2='Order' where invoice_no='$estimate_no' and company_code='$company_code'"; }
if($number==1){
$qry6 = "update $table_name2 set invoice_quantity='$item_quantity[$j]',invoice_available_quantity='$stock_item_quantity',estimate_status2='Order' where invoice_no='$estimate_no' and company_code='$company_code'"; }
mysql_query($qry6);
mysql_query($que5); */ 
/*$path="../../documents/upload_file/".$folder_id;
if(!is_dir($path)){
mkdir($path, 0755, true); }
move_uploaded_file($upload_file_temp,$path."/$upload_file_name");
$que3="insert into account_info(date,customer_id,payment_mode,bank_s_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,invoice_no,invoice_grand_total,invoice_total_paid,invoice_due_amount,folder_name,upload_file,account_status,cheque_status,company_name,company_code) values('$invoice_date','$invoice_firm_name','$invoice_payment_mode','$invoice_payment_mode','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','$invoice_no','$invoice_grand_total','$invoice_total_paid','$invoice_due_amount','','','Active','$cheque_status','$company_name','$company_code')";
mysql_query($que3);
*/
//$folder_id=$folder_id+1;
$sales_order_no=$sales_order_no+1;
$que2="update invoice_no set sales_order_no='$sales_order_no' where company_code='$company_code'";
mysql_query($que2);
if($set>0){
echo "|?|success|?|"; }
?>