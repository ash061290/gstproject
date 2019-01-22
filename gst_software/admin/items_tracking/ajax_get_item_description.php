<?php
$value=$_GET['value'];
$inv_type=$_GET['inv_type'];
include("../../connection/connect.php");
$query="select * from item_master where s_no='$value'";
$res=mysql_query($query);
$item_intra_state_tax_precentage1=0;
while($row=mysql_fetch_array($res)){
$item_product_name=$row['item_product_name'];
$item_sale_discription=$row['item_sale_discription'];
$item_purchase_discription=$row['item_purchase_discription'];
$item_hsn=$row['item_hsn'];
$item_quantity=$row['item_quantity'];
$item_intra_state_tax_precentage=$row['item_intra_state_tax_precentage'];
$item_intra_state_tax_precentage1=$item_intra_state_tax_precentage/2;
$item_inter_state_tax_precentage=$row['item_inter_state_tax_precentage'];
$item_uom=$row['item_uom'];
$item_sale_price=$row['item_sale_price'];
$item_purchase_price=$row['item_purchase_price'];
}

if($inv_type=='sales'){
echo $item_hsn."|?|".$item_sale_discription."|?|".$item_intra_state_tax_precentage1."|?|".$item_inter_state_tax_precentage."|?|".$item_quantity."|?|".$item_sale_price."|?|".$item_uom."|?|".$item_product_name;
}elseif($inv_type=='purchase'){
echo $item_hsn."|?|".$item_purchase_discription."|?|".$item_intra_state_tax_precentage1."|?|".$item_inter_state_tax_precentage."|?|".$item_quantity."|?|".$item_purchase_price."|?|".$item_uom."|?|".$item_product_name;
}
?>