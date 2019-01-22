<?php include("../../attachment/session.php");
$value=$_GET['value'];
$query="select * from item where s_no='$value' and company_code='$company_code'";
$res=mysql_query($query);
$item_intra_state_tax_precentage1=0;
if($row=mysql_fetch_array($res)){
$item_product_name=$row['item_product_name'];
$item_purchase_discription=$row['item_purchase_description'];
$item_hsn=$row['item_hsn_no'];
$item_quantity=$row['item_purchase_quantity'];
$item_mrp = $row['item_purchase_mrp'];
$item_intra_state_tax_precentage=$row['item_tax_igst'];
$item_intra_state_tax_precentage1=$item_intra_state_tax_precentage/2;
$item_inter_state_tax_precentage=$row['item_tax_cgst'];
$item_uom=$row['item_attribute'];
$item_purchase_price=$row['item_purchase_price'];
}
echo $item_hsn."|?|".$item_purchase_discription."|?|".$item_intra_state_tax_precentage1."|?|".$item_inter_state_tax_precentage."|?|".$item_quantity."|?|".$item_purchase_price."|?|".$item_uom."|?|".$item_product_name."|?|".$item_mrp;
?>