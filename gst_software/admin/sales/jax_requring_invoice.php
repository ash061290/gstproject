<?php
include("../../connection/connect.php");
$msg=0;
 if(isset($_GET['status']))
 {
$status=$_GET['status'];
$challan_no = $_GET['challan_no'];
if($status == 'Open Challan')
{
$status = 'Challan Delivered';
}
$query="update sales_delivery_challan_info set invoice_status2='$status' where invoice_no='$challan_no' and company_code='$company_code'";
if(mysql_query($query)){
    $msg=1;
}
echo $msg;
}
if(isset($_GET['challan_id1']))
{
  $challan_no = $_GET['challan_id1'];
  $status = $_GET['status1'];
	 if($status == 'Open Challan')
	 {
	  $status = "Challan Delivered";
	 }
	  if($status == 'Challan Delivered')
	 {
       $status = "Challan Delivered";
	 }
	 $qry = "update sales_delivery_challan_info set invoice_status2='$status' where invoice_no='$challan_no' and company_code='$company_code'";
	 if(mysql_query($qry))
    {	 
    $msg=1;
   echo $msg;
   }
 
}
?>