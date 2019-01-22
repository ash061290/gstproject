 <?php include("../../attachment/session.php");
$invoice_no = $_POST['inv_no'];
$credit_no = $_POST['credit_no'];
$reason_return = $_POST['reason_return'];
$credit_notes_reason = $_POST['credit_notes_reason'];
$order_return_term = $_POST['order_return_term'];
$order_return_type = $_POST['order_return_type'];
$credit_no1 = $_POST['credit_note_no'];
$select ="select * from sales_delivery_challan_info where invoice_no='$invoice_no' and company_code='$company_code'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
	$select = "select * from where challan_no='$invoice_no' and company_code='$company_code'";
	$run = mysql_query($select);
	$fetchdata = mysql_fetch_array($run);
	$invoice2 = $fetchdata['invoice_no'];
      $update_order = "update sales_delivery_challan_draft_info,sales_invoice_info set sales_delivery_challan_draft_info.order_return_reason='$reason_return',sales_delivery_challan_draft_info.order_return_type='$order_return_type',sales_delivery_challan_draft_info.invoice_no='$credit_no',sales_delivery_challan_draft_info.credit_note_reason='$credit_notes_reason',
sales_invoice_info.invoice_status2='Debit Notes',sales_invoice_info.challan_no='$credit_no',
sales_invoice_info.order_status='Cancel',sales_delivery_challan_draft_info.invoice_status2='Return',sales_delivery_challan_draft_info.order_return_term='$order_return_term' where sales_delivery_challan_draft_info.invoice_no='$invoice_no' and sales_invoice_info.invoice_no='$invoice2' and sales_delivery_challan_draft_info.company_code='$company_code' and sales_invoice_info.company_code='$company_code'";
$number=1;
}
else{
	$number=0;
    $select = "select * from sales_invoice_info where challan_no='$invoice_no'";
	$run = mysql_query($select);
	$fetchdata = mysql_fetch_array($run);
	$invoice2 = $fetchdata['invoice_no'];
 $update_order = "update sales_delivery_challan_info,sales_invoice_info set sales_delivery_challan_info.order_return_reason='$reason_return',sales_delivery_challan_info.order_return_type='$order_return_type',sales_delivery_challan_info.credit_note_reason='$credit_notes_reason',sales_delivery_challan_info.invoice_no='$credit_no',
sales_invoice_info.invoice_status2='Debit Notes',sales_invoice_info.challan_no='$credit_no',
sales_invoice_info.order_status='Cancel',sales_delivery_challan_info.invoice_status2='Return',sales_delivery_challan_info.order_return_term='$order_return_term' where sales_delivery_challan_info.invoice_no='$invoice_no' and sales_invoice_info.invoice_no='$invoice2'
 and sales_invoice_info.company_code='$company_code' and sales_delivery_challan_info.company_code='$company_code'";
}

$select = "select * from sales_delivery_challan_info where invoice_no='$invoice_no' and company_code='$company_code'";
$run = mysql_query($select);
$fetchrow = mysql_fetch_array($run);
$order_return_term = $fetchrow['order_return_term'];
if($order_return_term == 'Refund Order')
{
	if($number==1){ $table_name2 = "sales_delivery_challan_draft_info"; } else{ $table_name2 ="sales_delivery_challan_info"; }
     $select_challan_invoice = "update sales_invoice_info,$table_name2,account_info SET sales_invoice_info.transaction_type='Debit',sales_invoice_info.invoice_due_amount='0',sales_invoice_info.challan_no='$credit_no',sales_invoice_info.order_status='Cancel',account_info.transaction_type='Debit',
	 sales_invoice_info.invoice_status2='Debit Notes',$table_name2.invoice_status2='Return',$table_name2.invoice_due_amount='0',$table_name2.invoice_no='$credit_no',$table_name2.transaction_type='Debit' where sales_invoice_info.challan_no=$table_name2.invoice_no AND sales_invoice_info.invoice_no = account_info.invoice_no AND sales_invoice_info.invoice_status='Active' and $table_name2.invoice_no='$invoice_no' and $table_name2.company_code='$company_code' and sales_invoice_info.company_code='$company_code'";
  $run = mysql_query($select_challan_invoice);
 //update stock
    $select = "select * from $table_name2 where invoice_no='$invoice_no' and company_code='$company_code'";
	$run = mysql_query($select);
	$fetchrow = mysql_fetch_array($run);
	$product_id = $fetchrow['invoice_product_name'];
	$order_id = $fetchrow['order_no'];
	$update_status_sales_order_info = "update sales_order_info set sales_order_status='Return' where invoice_no='$order_id' and company_code='$company_code'";
	mysql_query($update_status_sales_order_info);
	$invoice_quantity = $fetchrow['invoice_quantity'];
	$product_select = "select * from item_master where s_no='$product_id' and company_code='$company_code'";
	$runp = mysql_query($product_select);
	$fetch_product = mysql_fetch_array($runp);
	$item_quantity = $fetch_product['item_quantity'];
	$item_actual_quantity = $item_quantity + $invoice_quantity;
	echo $update_product = "update item_master set item_quantity='$item_actual_quantity' where s_no='$product_id' and company_code='$company_code'";
	mysql_query($update_product);
 //end
echo "|?|success|?|".$invoice_no."|?|"; 
}
$credit_no1 = $credit_no1+1;
$update_table = "update invoice_no set credit_no='$credit_no1' where company_code='$company_code'";
$update = mysql_query($update_table);
if(mysql_query($update_order))
echo "|?|success|?|".$invoice_no."|?|";
 ?>