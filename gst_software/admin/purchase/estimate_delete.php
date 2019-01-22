<?php
include("../../connection/connect.php");
$estimate_no=$_GET['estimate_no'];
$estimate_type=$_GET['estimate_type'];
if($estimate_type=='sales'){
$table_name='sales_estimate_info';
$page_name='sales_estimate_list.php';
}elseif($estimate_type=='purchase'){
$table_name='purchase_estimate_info';
$table_name2 ='purchase_estimate_draft_info';
$page_name='purchase_estimate_list.php';
}
$select = "select * from $table_name where invoice_no='$estimate_no'";
$run = mysql_query($select);
$numrow = mysql_num_rows($run);
if($numrow<1){
 $query="update $table_name2 set invoice_status='Deleted' where invoice_no='$estimate_no'";  
}
else{
$query="update $table_name set invoice_status='Deleted' where invoice_no='$estimate_no'";
}
if(mysql_query($query)){
	echo "<script>window.open('$page_name','_self')</script>";
}
?>