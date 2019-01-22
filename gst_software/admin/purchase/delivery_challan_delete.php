<?php
include("../../connection/connect.php");
$challan_no=$_GET['challan_no'];
$challan_type=$_GET['challan_type'];
if($challan_type=='sales'){
$table_name='sales_delivery_challan_info';
$table_name2 ='sales_delivery_challan_draft_info';
$page_name='sales_delivery_challan_list.php';
}elseif($challan_type=='purchase'){
$table_name='purchase_delivery_challan_info';
$table_name2='purchase_delivery_challan_draft_info';
$page_name='purchase_delivery_challan_list.php';
}
$select ="select * from $table_name where invoice_no='$challan_no'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
	$query="update $table_name2 set invoice_status='Deleted' where invoice_no='$challan_no'";
}
else{
	$query="update $table_name set invoice_status='Deleted' where invoice_no='$challan_no'";
}
if(mysql_query($query)){
	echo "<script>window.open('$page_name','_self')</script>";
}
?>