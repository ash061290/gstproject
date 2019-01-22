<?php
echo "<option value=''>--select--</option>";
include("../../attachment/session.php");
$subcategory = $_POST['subcategory'];
$query="select model_name,s_no from product_model_no where subcategory='$subcategory'";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	echo "<option value=".$row['s_no'].">".$row['model_name']."</option>";
}
?>