<?php include("../../attachment/session.php");?>

<?php 
if(isset($_POST['save']) || isset($_POST['save_and_print'])){
$invoice_no=$_POST['invoice_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_reference=$_POST['invoice_reference'];
$invoice_due_date=$_POST['invoice_due_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$invoice_type=$_POST['invoice_type'];
$invoice_gstin_no=$_POST['invoice_gstin_no'];
$sales_person_name = $_POST['sales_person_name'];
$sales_excutive_name = $_POST['sales_excutive_name'];
$transport_name = $_POST['transport_name'];
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
$remark=$_POST['remark'];
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
$upload_file_name=$_FILES['upload_file']['name'];            
$upload_file_temp=$_FILES['upload_file']['tmp_name'];
$invoice_payment_mode='';
$cheque_status='';
$invoice_delete_items=$_POST['invoice_delete_items'];
$invoice_delete_items_count=$_POST['invoice_delete_items_count'];
if(isset($_POST['save']) || isset($_POST['save_and_print'])){
if($invoice_type=='sales'){
$table_name='sales_invoice_info';
$page_name='sales_delivery_challan_list.php';
$stock_quantity_rate_update='';
}elseif($invoice_type=='purchase'){
$table_name='purchase_invoice_info';
$page_name='purchase_invoice_list.php';
$stock_quantity_rate_update='No';
}
$count=count($item_product_name);
$set=0;
for($j=0; $j<$count; $j++){
$query1="update $table_name set invoice_no='$invoice_no',invoice_date='$invoice_date',invoice_reference='$invoice_reference',invoice_due_date='$invoice_due_date',invoice_firm_name='$invoice_firm_name',invoice_billing_address='$invoice_billing_address',invoice_shipping_address='$invoice_shipping_address',invoice_gstin_no='$invoice_gstin_no',invoice_place_of_supply='$invoice_place_of_supply',invoice_product_name='$item_product_name[$i]',invoice_description='$item_description[$i]',invoice_hsn='$item_hsn[$i]',invoice_quantity='$item_quantity[$i]',invoice_available_quantity='$item_avail_quantity[$i]',invoice_item_unit='$item_unit[$i]',invoice_rate='$item_price[$i]',invoice_rate1='$item_price1[$i]',invoice_price_fix='$item_price_fix[$i]',invoice_discount='$item_discount[$i]',invoice_discount_type='$item_discount_type[$i]',invoice_taxable='$item_taxable[$i]',invoice_tax_type='$item_tax_type[$i]',invoice_tax='$item_tax_amount[$i]',invoice_cgst='$item_cgst[$i]',invoice_cgst1='$item_cgst1[$i]',invoice_sgst='$item_sgst[$i]',invoice_sgst1='$item_sgst1[$i]',invoice_igst='$item_igst[$i]',invoice_igst1='$item_igst1[$i]',invoice_total='$item_total_amount[$i]',invoice_extra_expences='$invoice_extra_expences',invoice_sub_total='$invoice_sub_total',invoice_total_discount='$total_invoice_discount',invoice_total_discount_type='$total_discount_type',invoice_grand_total='$invoice_grand_total',invoice_payment_mode='$invoice_payment_mode',invoice_total_paid='$invoice_total_paid',remark='$remark',invoice_due_amount='$invoice_due_amount',invoice_customer_notes='$invoice_customer_notes',invoice_terms_and_conditions='$invoice_terms_and_conditions',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',transaction_type='$transaction_type',stock_quantity_rate_update='$stock_quantity_rate_update',challan_no='',advance_no='$advance_no',shipping_date='',order_status='Package',sales_person_name='$sales_person_name',sales_excutive_name='$sales_excutive_name',transport_name='$transport_name',invoice_status2='Unpaid Invoice' where invoice_no='$advance_no'";
if(mysql_query($query1)){
$set=$set+1;
}
if($invoice_type=='sales'){
$que4="select * from item_master where s_no='$item_product_name[$j]'";
$res4=mysql_query($que4);
$row4=mysql_fetch_array($res4);
$stock_item_quantity=$row4['item_quantity'];
$item_quantity_modify_count=$row4['item_quantity_modify_count']+1;
$stock_item_quantity=$stock_item_quantity-$item_quantity[$j];
$que5="update item_master set item_quantity='$stock_item_quantity',item_quantity_modify_count='$item_quantity_modify_count' where s_no='$item_product_name[$j]'";
mysql_query($que5);
}
}
$path="../../documents/upload_file/".$folder_id;
if(!is_dir($path)){
mkdir($path, 0755, true);
}
move_uploaded_file($upload_file_temp,$path."/$upload_file_name");
$que3="insert into account_info(date,customer_id,payment_mode,bank_s_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,invoice_no,invoice_grand_total,invoice_total_paid,invoice_due_amount,folder_name,upload_file,account_status,cheque_status) values('$invoice_date','$invoice_firm_name','$invoice_payment_mode','$invoice_payment_mode','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','$invoice_no','$invoice_grand_total','$invoice_total_paid','$invoice_due_amount','$folder_id','$upload_file_name','Active','$cheque_status')";
mysql_query($que3);
$folder_id=$folder_id+1;
$sales_invoice_no=$sales_invoice_no+1;
$que2="update invoice_no set folder_id='$folder_id',sales_invoice_no='$sales_invoice_no'";
mysql_query($que2);
if($set>0){
echo "<script>window.open('$page_name','_self');</script>";
}
}
}
?>