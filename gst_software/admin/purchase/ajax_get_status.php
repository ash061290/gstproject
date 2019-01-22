<?php
include("../../connection/connect.php");
$msg=0;
//purchase invoice_info status change
 if(isset($_GET['invoice_no']))
 {
 $company_code=$_GET['company_code'];
$invoice_no=$_GET['invoice_no'];
$query="update purchase_invoice_info set invoice_status2 = 'Invoiced' where invoice_no='$invoice_no' and company_code='$company_code'";
if(mysql_query($query)){
    $msg=1;
}
echo $msg;
}
//sale_invoice_list
if(isset($_GET['inv_id']))
{
 $inv_id = $_GET['inv_id'];
 $value = $_GET['value'];
 $query="update sales_invoice_info set invoice_status2 = '$value' where invoice_no='$inv_id' and company_code='$company_code'";
if(mysql_query($query)){
    $msg=1;
}
echo $msg;
 
}
?>