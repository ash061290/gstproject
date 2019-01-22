<?php include("../../attachment/session.php"); 
$company_code                 =$_POST['company_code'];
$invoice_no                   =$_POST['invoice_no'];
$sales_order_no               = $_POST['sales_order_no'];
$item_mrp                     = $_POST['item_mrp'];
$invoice_date                 =$_POST['invoice_date'];
$invoice_transport_name       =$_POST['transport_name'];
$invoice_form_location        =$_POST['form_location'];
$invoice_to_location          =$_POST['to_location'];
//$invoice_reference          =$_POST['invoice_reference'];
//$invoice_due_date           =$_POST['invoice_due_date'];
$invoice_firm_name            =$_POST['invoice_firm_name'];
$invoice_type                 ="sales order";
$invoice_gstin_no             =$_POST['invoice_gstin_no'];
$invoice_place_of_supply      =$_POST['invoice_place_of_supply'];
$invoice_billing_address      =$_POST['invoice_billing_address'];
$invoice_shipping_address     =$_POST['invoice_shipping_address'];
$item_product_name            =$_POST['item_product_name'];
$item_description             =$_POST['item_description'];
$item_hsn                     =$_POST['item_hsn'];
$item_quantity                =$_POST['item_quantity'];
$item_avail_quantity          =$_POST['item_avail_quantity'];
$item_unit                    =$_POST['item_unit'];
$item_price                   =$_POST['item_price'];
$item_price1                  =$_POST['item_price1'];
$item_price_fix               =$_POST['item_price_fix'];
$item_discount                =$_POST['item_discount'];
$item_discount_type           =$_POST['item_discount_type'];
$item_taxable                 =$_POST['item_taxable'];
$item_tax_type                =$_POST['item_tax_type'];
$item_tax_amount              =$_POST['item_tax_amount'];
$item_cgst                    =$_POST['item_cgst'];
$item_cgst1                   =$_POST['item_cgst1'];
$item_sgst                    =$_POST['item_sgst'];
$item_sgst1                   =$_POST['item_sgst1'];
$item_igst                    =$_POST['item_igst'];
$item_igst1                   =$_POST['item_igst1'];
$item_total_amount            =$_POST['item_total_amount'];
//$sales_person_name          = $_POST['sales_person_name'];
//$sales_excutive_name        = $_POST['sales_excutive_name'];
$invoice_extra_expences       =$_POST['invoice_extra_expences'];
$invoice_sub_total            =$_POST['invoice_sub_total'];
$total_invoice_discount       =$_POST['total_invoice_discount'];
$total_discount_type          =$_POST['total_discount_type'];
$invoice_grand_total          =$_POST['invoice_grand_total'];
$invoice_payment_mode         =$_POST['invoice_payment_mode'];
$invoice_total_paid           =$_POST['invoice_total_paid'];
$remark                       ="";
$invoice_due_amount           =$_POST['invoice_due_amount'];
$invoice_customer_notes       =$_POST['invoice_customer_notes'];
$invoice_terms_and_conditions =$_POST['invoice_terms_and_conditions'];
$account_type                 =$_POST['account_type'];
$account_name                 =$_POST['account_name'];
$cheque_dd                    =$_POST['cheque_dd'];
$cheque_dd_no                 =$_POST['cheque_dd_no'];
$cheque_dd_amount             =$_POST['cheque_dd_amount'];
$cheque_dd_issue_date         =$_POST['cheque_dd_issue_date'];
$cheque_dd_clearing_date      =$_POST['cheque_dd_clearing_date'];
$transaction_type             ='Credit';
$save=0;
$count=count($item_product_name);
if($invoice_type=='sales'){
$table_name='sales_invoice_new';
//$page_name='sales_order_list.php';

}
$save=0;
$count=count($item_product_name);
for($i=0; $i<$count; $i++){
echo $query="insert into sales_invoice_new(invoice_no,invoice_date,invoice_transport_name,invoice_form_location,invoice_to_location,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,order_status,transaction_type,company_name,company_code,item_mrp) values('$invoice_no','$invoice_date','$invoice_transport_name','$invoice_form_location','$invoice_to_location','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name[$i]','$item_description[$i]','$item_hsn[$i]','$item_quantity[$i]','$item_avail_quantity[$i]','$item_unit[$i]','$item_price[$i]','$item_price1[$i]','$item_price_fix[$i]','$item_discount[$i]','$item_discount_type[$i]','$item_taxable[$i]','$item_tax_type[$i]','$item_tax_amount[$i]','$item_cgst[$i]','$item_cgst1[$i]','$item_sgst[$i]','$item_sgst1[$i]','$item_igst[$i]','$item_igst1[$i]','$item_total_amount[$i]','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$remark','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','$invoice_type','Active','No','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','Package','$transaction_type','$company_name','$company_code','$item_mrp[$i]')";

$run=mysql_query($query) or die(mysql_error());

 if($run){
$save++;
} }
$sales_order_no=$sales_order_no+1;
$que2="update invoice_no set sales_order_no='$sales_order_no' where company_code='$company_code'";
mysql_query($que2);
if($save>0){
echo "|?|success|?|";
} 
?>