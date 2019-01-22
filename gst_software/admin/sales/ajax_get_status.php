<?php include("../../attachment/session.php");
$msg=0;
 if(isset($_GET['s_no']))
 {
$s_no=$_GET['s_no'];
$value = $_GET['value'];
$query="update sales_estimate_info set estimate_status = '$value' where s_no='$s_no' and company_code='$company_code'";
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