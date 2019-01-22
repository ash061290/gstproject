"<option value="">--select--</option>"
<?php
include("../../attachment/session.php");
 $category_name = $_POST['category_name'];
$brand = $_POST['brand'];
$query="select subcategory_name from subcategory_add where category='$category_name' and brand_name='$brand'";
$result=mysql_query($query) or die(mysql_error());
     
while($row=mysql_fetch_array($result))
{
	echo "<option value=".$row['subcategory_name'].">".$row['subcategory_name']."</option>";

}

?>