"<option value="">--select--</option>"
<?php
  $subcategory_name = $_POST['category_name'];
  $brand=$_POST['brand'];

include("../../attachment/session.php");

   $query="select subcategory_name from subcategory_add where category='$subcategory_name' and brand_name='$brand'";

$result=mysql_query($query) or die(mysql_error());

while($row=mysql_fetch_array($result))
{
	echo "<option value=".$row['subcategory_name'].">".$row['subcategory_name']."</option>";
}

?>