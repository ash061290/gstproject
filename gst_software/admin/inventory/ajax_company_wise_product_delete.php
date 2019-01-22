<?php
include("../../connection/connect.php");
$company=$_GET['company'];				
				$que="select * from company_wise_product_table where company_name='$company'";
				$run=mysql_query($que) or die(mysql_error());
          		while($row=mysql_fetch_array($run)){
				$company_wise_product_id=$row['company_wise_product_id'];
				$product_name=$row['product_name'];
				?>		
				<tr align='center'>				
				<th><?php echo $product_name; ?></th>
				<th><a href='company_wise_product_name_delete.php?id=<?php echo $company_wise_product_id; ?>&company_name=<?php echo $company; ?>'><button type="button" class="btn btn-default" >Delete</button></a>
	            </tr>
				<?php } 
				 ?>