"<option value="">--select--</option>"
<?php
include("../../attachment/session.php"); 
$brand_name = $_POST['brand_name'];

$query="select category from subcategory_add where brand_name='$brand_name' GROUP BY category";
$result=mysql_query($query);
     
while($row=mysql_fetch_array($result))
{
	echo "<option value=".$row['category'].">".$row['category']."</option>";

}

?>