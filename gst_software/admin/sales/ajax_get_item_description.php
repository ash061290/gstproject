<?php include("../../attachment/session.php");
 $value=$_GET['value'];
 if($value){
 $query="select * from item join purchase_invoice_new on item.s_no=purchase_invoice_new.invoice_product_name where item.s_no='$value' and item.company_code='$company_code' group by item.item_product_name";
$res=mysql_query($query);
$item_intra_state_tax_precentage1=0;
while($row=mysql_fetch_array($res)){
$item_product_name=$row['item_product_name'];
$item_sale_discription=$row['item_sales_description'];
$item_hsn=$row['item_hsn_no'];
$item_mrp = $row['item_sales_mrp'];
$item_purchase_quantity=$row['item_purchase_quantity'];
$item_intra_state_tax_precentage=$row['item_tax_igst'];
$item_intra_state_tax_precentage1=$item_intra_state_tax_precentage/2;
$item_inter_state_tax_precentage=$row['item_tax_cgst'];
$item_uom=$row['item_attribute'];
$item_sale_price=$row['item_sales_price'];
}
echo $item_hsn."|?|".$item_sale_discription."|?|".$item_intra_state_tax_precentage1."|?|".$item_inter_state_tax_precentage."|?|".$item_purchase_quantity."|?|".$item_sale_price."|?|".$item_uom."|?|".$item_product_name."|?|".$item_mrp;
 }
 else{
 echo "failed";
 }
?>