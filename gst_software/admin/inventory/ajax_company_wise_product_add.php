<?php
include("../../connection/connect.php");
$company=$_GET['company'];
				$que="select * from product_name_add";
				$run=mysql_query($que) or die(mysql_error());
				while($row=mysql_fetch_array($run)){
				$product_name_id=$row['product_name_id'];
				$product_name=$row['product_name'];
				$category=$row['category'];
				
				$que1="select * from company_wise_product_table where product_name='$product_name' and company_name='$company'";
				$run1=mysql_query($que1) or die(mysql_error());
                if(mysql_num_rows($run1)>0){
				
				}else{
				?>		
				<tr align='center'>				
				<th><?php echo $product_name; ?></th>
				<th><a href='company_wise_product_insert.php?id=<?php echo $product_name; ?>&company_name=<?php echo $company; ?>&category=<?php echo $category; ?>'><button type="button" class="btn btn-default">Add Product</button></a>
	            </tr>
				<?php } }
				 ?>