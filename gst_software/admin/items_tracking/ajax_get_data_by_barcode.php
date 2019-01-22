<?php
$barcode_no = $_GET['barcode'];
include("../../attachment/session.php");
echo "<option value=''>Select</option>";
$que1="select * from item_master where barcode_no='$barcode_no' or scan_item_serial_no='$barcode_no' and item_status='Active'";
$run1=mysql_query($que1);
if(mysql_num_rows($run1)>0){
while($row1=mysql_fetch_array($run1)){
$s_no=$row1['s_no'];
$item_product_name=$row1['item_product_name'];
$barcode_no=$row1['barcode_no'];
echo "<option value=".$s_no.">".'['.$barcode_no.']'.$item_product_name."</option>";
}
}
?>