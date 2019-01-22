<?php  include("../../attachment/image_compression_upload.php");
$purchase_invoice_no=$_POST['purchase_invoice_no'];
$invoice_no=$_POST['invoice_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$invoice_gstin_no=$_POST['invoice_gstin_no'];
$invoice_place_of_supply=$_POST['invoice_place_of_supply'];
$invoice_billing_address=$_POST['invoice_billing_address'];
$invoice_shipping_address=$_POST['invoice_shipping_address'];
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
$payment_mode=$_POST['invoice_payment_mode'];
$payment_mode1=$_POST['invoice_payment_mode'];
$invoice_total_paid=$_POST['invoice_total_paid'];
$item_mrp = $_POST['item_mrp'];
$account_type = $_POST['account_type'];
$account_name = $_POST['account_name'];
$cheque_dd = $_POST['cheque_dd'];
$cheque_dd_no = $_POST['cheque_dd_no'];
$cheque_dd_amount = $_POST['cheque_dd_amount'];
$cheque_dd_issue_date=$_POST['cheque_dd_issue_date'];
$cheque_dd_clearing_date=$_POST['cheque_dd_clearing_date'];
$invoice_due_amount=$_POST['invoice_due_amount'];
$invoice_customer_notes=$_POST['invoice_customer_notes'];
$invoice_terms_and_conditions=$_POST['invoice_terms_and_conditions'];
$bank_s_no="";
$cheque_dd = $_POST['cheque_dd'];
if($cheque_dd == 'Cheque' or $cheque_dd == 'DD'){ $payment_mode = $cheque_dd; }
if($payment_mode=='Cheque' or $payment_mode=='DD'){
$cheque_status='Uncleared';
}else{
$cheque_status='Cleared';
}
$table_name='purchase_invoice_new';
//$page_name='sales_invoice_list.php';
$transaction_type='Debit';
$save=0;
$count=count($item_product_name);
for($i=0; $i<$count; $i++){
 $check = "select item.item_product_name from item join purchase_invoice_new on item.s_no=purchase_invoice_new.invoice_product_name where item.company_code='$company_code' and item.s_no='$item_product_name[$i]'";
 $run_check = mysql_query($check);
 $numrow = mysql_num_rows($run_check);
if($numrow>0){ $num = $numrow;}else{ $num = 0;} 
 $query="insert into $table_name(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,stock_quantity_rate_update,payment_count,challan_no,shipping_date,order_status,invoice_status2,company_name,company_code,item_mrp) values('$invoice_no','$invoice_date','','','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name[$i]','$item_description[$i]','$item_hsn[$i]','$item_quantity[$i]','$item_avail_quantity[$i]','$item_unit[$i]','$item_price[$i]','$item_price1[$i]','$item_price_fix[$i]','$item_discount[$i]','$item_discount_type[$i]','$item_taxable[$i]','$item_tax_type[$i]','$item_tax_amount[$i]','$item_cgst[$i]','$item_cgst1[$i]','$item_sgst[$i]','$item_sgst1[$i]','$item_igst[$i]','$item_igst1[$i]','$item_total_amount[$i]','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$payment_mode','$invoice_total_paid','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','','Active','No','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','','1','','','','Invoiced','$company_name','$company_code','$item_mrp[$i]')";
if(mysql_query($query)){
$save++;
//update quantity
$select = "select * from item where item_status='Active' and s_no='$item_product_name[$i]'";
 $select_run = mysql_query($select);
 $fetch_item = mysql_fetch_array($select_run);
 $s_no = $fetch_item['s_no'];
 if($num>0){
	 $purchase_quantity = $fetch_item['item_purchase_quantity']+$item_quantity[$i];
	 $update_item = "update item set item_purchase_quantity='$purchase_quantity' where s_no='$s_no'";
	 mysql_query($update_item);
 }
 else{
	 $update_item = "update item set item_purchase_quantity='$item_quantity[$i]' where s_no='$s_no'";
	 mysql_query($update_item);
 }
//end
}
}
$purchase_invoice_no = $purchase_invoice_no+1;
$que2="update invoice_no set purchase_invoice_no='$purchase_invoice_no' where company_code='$company_code'";
mysql_query($que2);
 $que_account="insert into account_info(date,customer_id,payment_mode,bank_s_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,invoice_no,invoice_grand_total,invoice_total_paid,invoice_due_amount,folder_name,upload_file,account_status,cheque_status,company_name,company_code) values('$invoice_date','$invoice_firm_name','$payment_mode','$payment_mode1','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','$invoice_no','$invoice_grand_total','$invoice_total_paid','$invoice_due_amount','','','Active','$cheque_status','$company_name','$company_code')";
mysql_query($que_account);
	 $id = mysql_insert_id();
		$upload_file = $_FILES['upload_file']['name'];				
			if($upload_file!=''){
	$imagename = $_FILES['upload_file']['name'];
	$size = $_FILES['upload_file']['size'];
    $imgData  = $_FILES['upload_file']['tmp_name'];
    camera_code($size,$imagename,$imgData,$id,"upload_file","account_info","s_no");
	}
	if($save>0){
     echo "|?|success|?|";
    }
?>
