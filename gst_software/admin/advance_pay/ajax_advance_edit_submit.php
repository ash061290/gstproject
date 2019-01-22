<?php
if(isset($_POST['edit_firm'])){
$invoice_firm_name=$_POST['invoice_firm_name'];
echo "<script>window.open('../contact/contact_edit.php?id=$invoice_firm_name&page=new_invoice_edit&invoice_no=$invoice_no&invoice_type=$invoice_type','_self');</script>";
}

if(isset($_POST['save']) || isset($_POST['save_and_print'])){

date_default_timezone_set('Asia/Calcutta'); 
$invoice_no = $_POST['invoice_no'];
$payment_date=$_POST['payment_date'];
$delivery_date=$_POST['delivery_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$advance_total_amount=$_POST['invoice_total_paid'];
$account_type=$_POST['account_type'];
$remark=$_POST['remark'];
$invoice_payment_mode=$_POST['invoice_payment_mode'];
$account_name=$_POST['account_name'];
$cheque_dd=$_POST['cheque_dd'];
$cheque_dd_no=$_POST['cheque_dd_no'];
$cheque_dd_amount=$_POST['cheque_dd_amount'];
$cheque_dd_issue_date=$_POST['cheque_dd_issue_date'];
$cheque_dd_clearing_date=$_POST['cheque_dd_clearing_date'];
$transaction_type = "Credit";
//PRODUCT
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
$invoice_sub_total=$_POST['invoice_sub_total'];
$total_invoice_discount=$_POST['total_invoice_discount'];
$total_discount_type=$_POST['total_discount_type'];
$invoice_grand_total=$_POST['invoice_grand_total'];
$invoice_total_paid=$_POST['invoice_total_paid'];
$invoice_due_amount=$_POST['invoice_due_amount'];
$invoice_extra_expences = $_POST['invoice_extra_expences'];
$invoice_customer_notes = $_POST['invoice_customer_notes'];
$invoice_terms_and_conditions = $_POST['invoice_terms_and_conditions'];
//
if($invoice_payment_mode==3 || $invoice_payment_mode==4 || $invoice_payment_mode==5){
$payment_mode='Neft';
}elseif($invoice_payment_mode==2){
if($cheque_dd=='Cheque'){
$payment_mode='Cheque';
}else{
$payment_mode='DD';
}
}elseif($invoice_payment_mode==1){
$payment_mode='Cash';
}

if($payment_mode=='Cheque' or $payment_mode=='DD'){
$cheque_status='Uncleared';
}else{
$cheque_status='Cleared';
}
$invoice_delete_items=$_POST['invoice_delete_items'];
$invoice_delete_items_count=$_POST['invoice_delete_items_count'];
$table_name='sales_invoice_info';
$page_name='advance.php';
$stock_quantity_rate_update='';
if($invoice_delete_items!=''){
$invoice_delete_items1=explode(',',$invoice_delete_items);
for($a=0;$a<$invoice_delete_items_count;$a++){
$que5="select * from sales_invoice_info where s_no='$invoice_delete_items1[$a]'";
$res5=mysql_query($que5);
$row5=mysql_fetch_array($res5);
$invoice_quantity=$row5['invoice_quantity'];
$invoice_product_name=$row5['invoice_product_name'];
$que6="select * from item_master where s_no='$invoice_product_name'";
$res6=mysql_query($que6);
$row6=mysql_fetch_array($res6);
$stock_item_quantity=$row6['item_quantity']+$invoice_quantity;
$que7="update item_master set item_quantity='$stock_item_quantity' where s_no='$invoice_product_name'";
mysql_query($que7);
$que4="delete from $table_name where s_no='$invoice_delete_items1[$a]'";
mysql_query($que4);
}
}
$count=count($invoice_s_no);
$count1=count($item_product_name);
$a=0;
$set=0;
for($i=0; $i<$count; $i++){
$query="update $table_name set invoice_no='$invoice_no',invoice_date='$payment_date',invoice_due_date='$delivery_date',invoice_firm_name='$invoice_firm_name',invoice_product_name='$item_product_name[$i]',invoice_description='$item_description[$i]',invoice_hsn='$item_hsn[$i]',invoice_quantity='$item_quantity[$i]',invoice_available_quantity='$item_avail_quantity[$i]',invoice_item_unit='$item_unit[$i]',invoice_rate='$item_price[$i]',invoice_rate1='$item_price1[$i]',invoice_price_fix='$item_price_fix[$i]',invoice_discount='$item_discount[$i]',invoice_discount_type='$item_discount_type[$i]',invoice_taxable='$item_taxable[$i]',invoice_tax_type='$item_tax_type[$i]',invoice_tax='$item_tax_amount[$i]',invoice_cgst='$item_cgst[$i]',invoice_cgst1='$item_cgst1[$i]',invoice_sgst='$item_sgst[$i]',invoice_sgst1='$item_sgst1[$i]',invoice_igst='$item_igst[$i]',invoice_igst1='$item_igst1[$i]',invoice_total='$item_total_amount[$i]',invoice_extra_expences='$invoice_extra_expences',invoice_sub_total='$invoice_sub_total',invoice_total_discount='$total_invoice_discount',invoice_total_discount_type='$total_discount_type',invoice_grand_total='$invoice_grand_total',invoice_payment_mode='$invoice_payment_mode',invoice_total_paid='$invoice_total_paid',remark='$remark',invoice_due_amount='$invoice_due_amount',invoice_customer_notes='$invoice_customer_notes',invoice_terms_and_conditions='$invoice_terms_and_conditions',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date' where s_no='$invoice_s_no[$i]'";
if(mysql_query($query)){
$set=$set+1;
$a=$a+1;
}
$que4p="select * from item_master where s_no='$previous_item_product_name[$i]'";
$res4p=mysql_query($que4p);
$row4p=mysql_fetch_array($res4p);
$stock_item_quantity1=$row4p['item_quantity']+$previous_item_quantity[$i];
$que5p="update item_master set item_quantity='$stock_item_quantity1' where s_no='$previous_item_product_name[$i]'";
mysql_query($que5p);
$que4="select * from item_master where s_no='$item_product_name[$i]'";
$res4=mysql_query($que4);
$row4=mysql_fetch_array($res4);
$stock_item_quantity=$row4['item_quantity'];
$stock_item_quantity=$stock_item_quantity-$item_quantity[$i];
$que5="update item_master set item_quantity='$stock_item_quantity' where s_no='$item_product_name[$i]'";
mysql_query($que5);
}
for($j=$a; $j<$count1; $j++){
$query1="insert into $table_name(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,stock_quantity_rate_update) values('$invoice_no','$payment_date','','$invoice_due_date','$invoice_firm_name','','','','','$item_product_name[$j]','$item_description[$j]','$item_hsn[$j]','$item_quantity[$j]','$item_avail_quantity[$j]','$item_unit[$j]','$item_price[$j]','$item_price1[$j]','$item_price_fix[$j]','$item_discount[$j]','$item_discount_type[$j]','$item_taxable[$j]','$item_tax_type[$j]','$item_tax_amount[$j]','$item_cgst[$j]','$item_cgst1[$j]','$item_sgst[$j]','$item_sgst1[$j]','$item_igst[$j]','$item_igst1[$j]','$item_total_amount[$j]','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$remark','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','Advance','Active','No','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','$stock_quantity_rate_update','','','','')";
if(mysql_query($query1)){
$set=$set+1;
}

$que4="select * from item_master where s_no='$item_product_name[$j]'";
$res4=mysql_query($que4);
$row4=mysql_fetch_array($res4);
$stock_item_quantity=$row4['item_quantity'];
$stock_item_quantity=$stock_item_quantity-$item_quantity[$j];
$que5="update item_master set item_quantity='$stock_item_quantity' where s_no='$item_product_name[$j]'";
mysql_query($que5);

}
$file_count=count($_FILES['upload_file']['name']);
for($i=0;$i<$file_count;$i++)
{
if($upload_file_name[$i] !='')
{
$upload_file_name[$i]=$_FILES['upload_file']['name'][$i];            
$upload_file_temp[$i]=$_FILES['upload_file']['tmp_name'][$i];
move_uploaded_file($upload_file_temp[$i],$path."/$upload_file_name[$i]");
}
}
$upload_file_name = implode(",",$_FILES['upload_file']['name']);
if($file_count=='0')
{
 $upload_file_name=$upload_file1;
}
if($payment_count<=1){
$que3="update account_info set date='$payment_date',customer_id='$invoice_firm_name',payment_mode='$payment_mode',bank_s_no='$invoice_payment_mode',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',invoice_grand_total='$invoice_grand_total',invoice_total_paid='$invoice_total_paid',invoice_due_amount='$invoice_due_amount,'cheque_status='$cheque_status' where invoice_no='$invoice_no'";
mysql_query($que3);
}
if($set>0){
echo "<script>window.open('$page_name','_self');</script>";
}
}
}?>