<?php include("../../attachment/session.php");
$company_code = $_POST['company_code'];
$query="select * from invoice_no where company_code='$company_code'";
$res=mysql_query($query);
while($row=mysql_fetch_array($res)){
$admin_place_of_supply=$row['admin_place_of_supply'];
}
echo ' |?|'.$admin_place_of_supply;
?>