<?php
$id=$_GET['id'];
include("../../connection/connect.php");
$query="select * from contact_master where s_no='$id'";
$res=mysql_query($query);
if(mysql_num_rows($res)>0){
while($row=mysql_fetch_array($res)){
$contact_company_name=$row['contact_company_name'];
$payment_term=$row['contact_payment_terms'];
$contact_shipping_address=$row['contact_shipping_address'];
$contact_shipping_city=$row['contact_shipping_city'];
$contact_shipping_state=$row['contact_shipping_state'];
$contact_shipping_zipcode=$row['contact_shipping_zipcode'];
$contact_shipping_country=$row['contact_shipping_country'];
$contact_place_of_supply=$row['contact_place_of_supply'];
$contact_gstin=$row['contact_gstin']; }
echo $contact_gstin."|?|".$contact_place_of_supply."|?|".$contact_shipping_address." ".$contact_shipping_city." ".$contact_shipping_state." (".$contact_shipping_zipcode.") ".$contact_shipping_country."|?|".$contact_company_name."|?|".$payment_term;
}
?>