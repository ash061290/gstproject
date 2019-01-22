<?php include("../../attachment/session.php");
if(isset($_GET['expenses_id']))
{
$id=$_GET['expenses_id'];
$table_name='add_expense';
$page_name="view_expenses.php";
 $query="UPDATE `add_expense` SET `expense_status`='0' WHERE `id`='$id'";
if(mysql_query($query))
{
	echo "<script>window.open('$page_name','_self')</script>";
}
}
 echo "<script>window.open('view_expenses.php','_self')</script>";
?>