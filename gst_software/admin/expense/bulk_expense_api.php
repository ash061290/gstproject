<?php error_reporting(0);
$exp_no = $_POST['exp_no'];
$exp_no = $exp_no+1;
$rem = $_POST["rem"];
$query2="select * from add_expense where company_code='$company_code'";
$res2=mysql_query($query2);
while($row2=mysql_fetch_array($res2)){
$folder_id=$row2['id']; }
$date = $_POST['date'];
$mname = $_POST['mname'];
$cat_id = $_POST['cat'];
$report_id = $_POST['report'];
$amount = $_POST['amount'];
$j=0;
for($i=1; $i<count($date) || $i==count($date);$i++){
 $rem[$j] = $_POST['rem_'.$i];
 $pay_id[$j] = $_POST['pay_'.$i];
 if(empty($_POST['pay_'.$i])){
   $pay_id[$j] =""; }
 if(empty($_POST['rem_'.$i])){
  $rem[$j] = "Non-Reimbursable"; }
 $j=$j+1; }
$descr = $_POST['descr'];
$expense_no = $_POST['exp_name'];
$ref = $_POST['ref'];
$filename = $_FILES['upload_file']['name'];
$tmp_name = $_FILES['upload_file']['tmp_name'];
$count2 = count($filename);
$count = count($date);
$folder_name = '0';
for($i=0; $i<$count; $i++){
$expense_status[$i] = '1';   
if($rem[$i]=='Non-Reimbursable'){
date_default_timezone_set('Asia/Calcutta'); 
$date2 = date("Y-m-d"); 
$paid_through  = $pay_id[$i];
 $bank ="SELECT bank_account_name,bank_account_type,credit_card_account_name FROM bank_or_credit_card_info WHERE s_no='$paid_through' and company_code='$company_code'";
$runq = mysql_query($bank);
if($bankrow = mysql_fetch_array($runq)) {
 $bank_account_name = $bankrow['bank_account_name'];
 $account_type = $bankrow['bank_account_type'];
 if($account_type == 'Credit_Card'){ 
  $bank_account_name = $bankrow['credit_card_account_name']; }
   }
$transaction = "INSERT INTO `account_info`(`date`,`bank_s_no`,`customer_id`,`account_type`, `account_name`,`cheque_dd`,`cheque_dd_amount`,`cheque_dd_no`,`cheque_dd_issue_date`, `cheque_dd_clearing_date`,`transaction_type`,`invoice_no`,`invoice_grand_total`, `invoice_total_paid`,`invoice_due_amount`,`account_status`,`payment_mode`,`reference`, `remark`,`folder_name`,`upload_file`,`cheque_status`,`company_name`,`company_code`) VALUES ('$date2','$paid_through','$mname[$i]',' $account_type','$bank_account_name','','','','','','Debit','','$amount[$i]','$amount[$i]','','Active','Cash','$ref[$i]','','','','Cleared','$company_name','$company_code')";
$qry_run = mysql_query($transaction);
if($qry_run){ $expense_status[$i]='2'; }
}
 echo $qry_exp = "INSERT INTO `add_expense`(`expense_no`,`insert_date`, `m_name`, `category`, `amount`, `tax_type`, `rem`, `ref_name`, `paid_through`, `description`,`folder_name`, `file_name`,`report_id`,`expense_status`,`company_name`,`company_code`) VALUES ('$expense_no[$i]','$date[$i]','$mname[$i]','$cat_id[$i]','$amount[$i]','','$rem[$i]','$ref[$i]','$pay_id[$i]','$descr[$i]','$folder_name','$filename[$i]','$report_id[$i]','$expense_status[$i]','$company_name','$company_code')";
   $result = mysql_query($qry_exp);	
   if($result){ 
 $qry2 = "update invoice_no set expense_no='$exp_no' where company_code='$company_code'";
 $runq2 = mysql_query($qry2);   
	$qry_select = "SELECT * FROM `add_expense` where company_code='$company_code' ORDER BY ID DESC LIMIT 1";
	  $runq = mysql_query($qry_select) or die(mysql_error());
	  if($row = mysql_fetch_array($runq)) {
	  $folder_id = $row['id']; }
	 $path="../../documents/expenses_file/".$folder_id;
if(!is_dir($path)){
		 mkdir($path, 0755, true); }
		$move = move_uploaded_file($tmp_name[$i],$path."/$filename[$i]");
 if($move){ $qry = "UPDATE `add_expense` SET `folder_name`='$folder_id' WHERE `id`='$folder_id' and company_code='$company_code'";
		$runq = mysql_query($qry);}
		
	  }
	}
	 if($result){ 
	 echo "|?|success|?|";
	 }
	//for loop end	 
	?>