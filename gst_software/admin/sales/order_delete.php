<?php
 include("../../attachment/session.php");
$order_no=$_GET['order_no'];
$order_type=$_GET['order_type'];
if($order_type=='sales'){
$table_name='sales_order_info';
$table_name2 = 'sales_order_draft_info';
$page_name='sales_order_list.php';
}elseif($order_type=='purchase'){
$table_name='purchase_order_info';
$page_name='purchase_order_list.php';
}
$select = "select * from $table_name where invoice_no='$order_no' and company_code='$company_code'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
 $query="update $table_name2 set invoice_status='Deleted' where invoice_no='$order_no' and company_code='$company_code'";
}
else{
 $query ="update $table_name set invoice_status='Deleted' where invoice_no='$order_no' and company_code='$company_code'";
}
if(mysql_query($query)){
	echo "<script>window.open('$page_name','_self')</script>";
}
?>