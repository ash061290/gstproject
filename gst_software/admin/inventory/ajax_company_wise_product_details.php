<?php
include("../../connection/connect.php");
                $company=$_GET['company'];
                $category=$_GET['category'];
				$que="select * from company_wise_product_table where company_name='$company' and category='$category'";
				$run=mysql_query($que) or die(mysql_error());
				while($row=mysql_fetch_array($run)){
				$product_name=$row['product_name'];
				
				?>		
				<tr align='center'>				
				<th><?php echo $product_name; ?></th>
				<th><a href='item_details.php?id=<?php echo $product_name; ?>&company_name=<?php echo $company; ?>&category=<?php echo $category; ?>'><button type="button" class="btn btn-default">Item Details</button></a>
	            </tr>
				<?php }
				 ?>