<?php include("../../attachment/session.php");
$id=$_GET['id'];
$company_code = $_GET['company_code'];
$query="select * from bank_or_credit_card_info where s_no='$id' and company_code='$company_code'";
$res=mysql_query($query);
if(mysql_num_rows($res)>0){
while($row=mysql_fetch_array($res)){
$bank_account_type=$row['bank_account_type'];
$bank_account_name=$row['bank_account_name'];
$credit_card_account_name=$row['credit_card_account_name'];
$credit_card_bank_name=$row['credit_card_bank_name'];
}
if($bank_account_name==''){
$bank_account_name=$credit_card_account_name;
}
echo $bank_account_type."|?|".$bank_account_name;
}
?>