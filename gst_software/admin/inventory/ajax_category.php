"<option value="">--select--</option>"
<?php
$brand_name = $_POST['brand_name'];
 include("../../attachment/session.php");
$query="select category from category_add where brand_name='$brand_name'";
echo $result=mysql_query($query) or die(mysql_error());
     
while($row=mysql_fetch_array($result))
{
	echo "<option value=".$row['category'].">".$row['category']."</option>";

}

?>