"<option value="">--select--</option>"
<?php
$brand_name = $_POST['brand_name'];
include("../../attachment/session.php");

$query="select category from subcategory_add where brand_name='$brand_name'";

$result=mysql_query($query) or die(mysql_error());

while($row=mysql_fetch_array($result))
{
	echo "<option value=".$row['category'].">".$row['category']."</option>";
}


?>