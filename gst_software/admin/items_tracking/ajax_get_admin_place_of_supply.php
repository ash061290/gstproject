<?php
include("../../attachment/session.php");
$query="select * from invoice_no";
$res=mysql_query($query);
while($row=mysql_fetch_array($res)){
$admin_place_of_supply=$row['admin_place_of_supply'];
}
echo ' |?|'.$admin_place_of_supply;
?>