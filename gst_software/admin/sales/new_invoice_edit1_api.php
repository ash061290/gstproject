
<?php
if(isset($_POST['edit_firm'])){
$invoice_firm_name=$_POST['invoice_firm_name'];
echo "<script>window.open('../contact/contact_edit.php?id=$invoice_firm_name&page=new_invoice_edit&invoice_no=$invoice_no&invoice_type=$invoice_type','_self');</script>";
}
if(isset($_POST['save']) || isset($_POST['save_and_print'])){
$invoice_no=$_POST['invoice_no'];
$item_mrp = $_POST['item_mrp'];
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
$previous_item_product_name=$_POST['previous_item_product_name'];
$item_description=$_POST['item_description'];
$item_hsn=$_POST['item_hsn'];
$item_quantity=$_POST['item_quantity'];
$previous_item_quantity=$_POST['previous_item_quantity'];
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
$sales_person_name = $_POST['sales_person_name'];
$sales_excutive_name = $_POST['sales_excutive_name'];
$transport_name = $_POST['transport_name'];
$invoice_extra_expences=$_POST['invoice_extra_expences'];
$invoice_sub_total=$_POST['invoice_sub_total'];
$total_invoice_discount=$_POST['total_invoice_discount'];
$total_discount_type=$_POST['total_discount_type'];
$invoice_grand_total=$_POST['invoice_grand_total'];
$invoice_payment_mode="";
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
$invoice_delete_items=$_POST['invoice_delete_items'];
$invoice_delete_items_count=$_POST['invoice_delete_items_count'];
if(isset($_POST['save']) || isset($_POST['save_and_print'])){
if($invoice_type=='sales'){
$table_name='sales_invoice_info';
$table_name2 = 'sales_invoice_draft_info';
$page_name='sales_invoice_list.php';
$stock_quantity_rate_update='';
}elseif($invoice_type=='purchase'){
$table_name='purchase_invoice_info';
$table_name2 = 'purchase_invoice_draft_info';
$page_name='purchase_invoice_list.php';
$stock_quantity_rate_update='No';
}
if($invoice_delete_items!=''){
$invoice_delete_items1=explode(',',$invoice_delete_items);
for($a=0;$a<$invoice_delete_items_count;$a++){

if($invoice_type=='sales'){
	if($number==0){
$que5="select * from $table_name where s_no='$invoice_delete_items1[$a]' and company_code='$company_code'";
	}
	if($number==1){
	$que5="select * from $table_name2 where s_no='$invoice_delete_items1[$a]' and company_code='$company_code'";
	}
$res5=mysql_query($que5);
$row5=mysql_fetch_array($res5);
$invoice_quantity=$row5['invoice_quantity'];
$invoice_product_name=$row5['invoice_product_name'];
$que6="select * from item_master where s_no='$invoice_product_name' and company_code='$company_code'";
$res6=mysql_query($que6);
$row6=mysql_fetch_array($res6);
$stock_item_quantity=$row6['item_quantity']+$invoice_quantity;
$que7="update item_master set item_quantity='$stock_item_quantity' where s_no='$invoice_product_name' and company_code='$company_code'";
mysql_query($que7);
}
if($number==0){
$que4="delete from $table_name where s_no='$invoice_delete_items1[$a]' and company_code='$company_code'";
}
if($number==1){
	$que4="delete from $table_name2 where s_no='$invoice_delete_items1[$a]' and company_code='$company_code'";
}
mysql_query($que4);
}
}
$count=count($invoice_s_no);
$count1=count($item_product_name);
$a=0;
$set=0;
		if($number==1){ $table_name = $table_name2; }
		else { $table_name = $table_name; }
		for($i=0; $i<$count; $i++){
$query="update $table_name set invoice_no='$invoice_no',invoice_date='$invoice_date',invoice_reference='$invoice_reference',invoice_due_date='$invoice_due_date',invoice_firm_name='$invoice_firm_name',invoice_billing_address='$invoice_billing_address',invoice_shipping_address='$invoice_shipping_address',invoice_gstin_no='$invoice_gstin_no',invoice_place_of_supply='$invoice_place_of_supply',invoice_product_name='$item_product_name[$i]',invoice_description='$item_description[$i]',invoice_hsn='$item_hsn[$i]',invoice_quantity='$item_quantity[$i]',invoice_available_quantity='$item_avail_quantity[$i]',invoice_item_unit='$item_unit[$i]',invoice_rate='$item_price[$i]',invoice_rate1='$item_price1[$i]',invoice_price_fix='$item_price_fix[$i]',invoice_discount='$item_discount[$i]',invoice_discount_type='$item_discount_type[$i]',invoice_taxable='$item_taxable[$i]',invoice_tax_type='$item_tax_type[$i]',invoice_tax='$item_tax_amount[$i]',invoice_cgst='$item_cgst[$i]',invoice_cgst1='$item_cgst1[$i]',invoice_sgst='$item_sgst[$i]',invoice_sgst1='$item_sgst1[$i]',invoice_igst='$item_igst[$i]',invoice_igst1='$item_igst1[$i]',invoice_total='$item_total_amount[$i]',invoice_extra_expences='$invoice_extra_expences',invoice_sub_total='$invoice_sub_total',invoice_total_discount='$total_invoice_discount',invoice_total_discount_type='$total_discount_type',invoice_grand_total='$invoice_grand_total',invoice_payment_mode='$invoice_payment_mode',invoice_total_paid='$invoice_total_paid',remark='$remark',invoice_due_amount='$invoice_due_amount',invoice_customer_notes='$invoice_customer_notes',invoice_terms_and_conditions='$invoice_terms_and_conditions',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',sales_person_name='$sales_person_name',sales_excutive_name='$sales_excutive_name',transport_name='$transport_name' where s_no='$invoice_s_no[$i]' and company_code='$company_code'";
if(mysql_query($query)){
$set=$set+1;
$a=$a+1;
}

if($invoice_type=='sales'){
$que4p="select * from item_master where s_no='$previous_item_product_name[$i]' and company_code='$company_code'";
$res4p=mysql_query($que4p);
$row4p=mysql_fetch_array($res4p);
$stock_item_quantity1=$row4p['item_quantity']+$previous_item_quantity[$i];
$que5p="update item_master set item_quantity='$stock_item_quantity1' where s_no='$previous_item_product_name[$i]' and company_code='$company_code'";
mysql_query($que5p);

$que4="select * from item_master where s_no='$item_product_name[$i]' and company_code='$company_code'";
$res4=mysql_query($que4);
$row4=mysql_fetch_array($res4);
$stock_item_quantity=$row4['item_quantity'];
$stock_item_quantity=$stock_item_quantity-$item_quantity[$i];
$que5="update item_master set item_quantity='$stock_item_quantity' where s_no='$item_product_name[$i]' and company_code='$company_code'";
mysql_query($que5);
} }
		for($j=$a; $j<$count1; $j++){
 $query1="insert into $table_name(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,stock_quantity_rate_update,payment_count,challan_no,shipping_date,
order_status,sales_person_name,sales_excutive_name,transport_name,invoice_status2,company_name,company_code,item_mrp) values('$invoice_no','$invoice_date','$invoice_reference','$invoice_due_date','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name[$j]','$item_description[$j]','$item_hsn[$j]','$item_quantity[$j]','$item_avail_quantity[$j]','$item_unit[$j]','$item_price[$j]','$item_price1[$j]','$item_price_fix[$j]','$item_discount[$j]','$item_discount_type[$j]','$item_taxable[$j]','$item_tax_type[$j]','$item_tax_amount[$j]','$item_cgst[$j]','$item_cgst1[$j]','$item_sgst[$j]','$item_sgst1[$j]','$item_igst[$j]','$item_igst1[$j]','$item_total_amount[$j]','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$remark','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','$invoice_type','Active','$invoice_order_no','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','$stock_quantity_rate_update','1','','','Package',
'$sales_person_name',
'$sales_excutive_name','$transport_name','Invoiced','$company_name','$company_code','$item_mrp')";
if(mysql_query($query1)){
$set=$set+1;
}

if($invoice_type=='sales'){
$que4="select * from item_master where s_no='$item_product_name[$j]' and company_code='$company_code'";
$res4=mysql_query($que4);
$row4=mysql_fetch_array($res4);
$stock_item_quantity=$row4['item_quantity'];
$stock_item_quantity=$stock_item_quantity-$item_quantity[$j];
$que5="update item_master set item_quantity='$stock_item_quantity' where s_no='$item_product_name[$j]' and company_code='$company_code'";
mysql_query($que5);
} }
if($upload_file_name!=''){
move_uploaded_file($upload_file_temp,$path."/$upload_file_name");
}else{
$upload_file_name=$upload_file1;
}
if($payment_count<=1){
$que3="update account_info set date='$invoice_date',customer_id='$invoice_firm_name',payment_mode='',bank_s_no='$invoice_payment_mode',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',invoice_grand_total='$invoice_grand_total',invoice_total_paid='$invoice_total_paid',invoice_due_amount='$invoice_due_amount',upload_file='$upload_file_name',cheque_status='' where invoice_no='$invoice_no' and company_code='$company_code'";
mysql_query($que3);
}
if($set>0){
echo "<script>window.open('$page_name','_self');</script>";
} } }
?>