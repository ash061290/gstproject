<?php include("../../attachment/session.php");
$id=$_GET['id'];

$query="select * from transport_detail_new where s_no='$id' and company_code='$company_code'";
$res=mysql_query($query);
if(mysql_num_rows($res)>0){
while($row=mysql_fetch_array($res)){

$from_location    =$row['from_location'];
$to_location      =$row['to_location'];

 }
echo $from_location."|?|".$to_location;
}
?>