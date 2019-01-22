<?php
$value=$_GET['value'];
$company_code = $_GET['company_code'];
include("../../connection/connect.php");
$query="select * from item_master where s_no='$value' and company_code='$company_code'";
$res=mysql_query($query);
$numrow = mysql_num_rows($res);
if($numrow>0)
{
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
}
else
{
$item_product_name="";
$item_sale_discription="";
$item_purchase_discription="";
$item_hsn="";
$item_quantity="0";
$item_intra_state_tax_precentage="0";
$item_intra_state_tax_precentage1="0";
$item_inter_state_tax_precentage="0";
$item_uom="";
$item_sale_price="0";
$item_purchase_price="0";
}
echo $item_hsn."|?|".$item_sale_discription."|?|".$item_intra_state_tax_precentage1."|?|".$item_inter_state_tax_precentage."|?|".$item_quantity."|?|".$item_sale_price."|?|".$item_uom."|?|".$item_product_name;
?>