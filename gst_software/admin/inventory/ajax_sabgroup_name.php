"<option value="">--select--</option>"
<?php
$company_name = $_GET['id'];

include("../../connection/connect.php");
$query="select * from company_wise_product_table where company_name='$company_name'";
$result=mysql_query($query);
echo "<option value=''>Select</option>";	
while($row=mysql_fetch_array($result)){
	$product_name = $row['product_name'];					
echo "<option value='".$product_name."'>".$product_name."</option>";			
	}
				
?>
