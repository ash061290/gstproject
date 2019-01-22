<?php include("../../attachment/session.php");
 $category_name=$_POST['category_name'];
 $brand_name = $_POST['brand_name'];
 $query="select * from item where item_category='$category_name' and item_status='Active' and item_brand='$brand_name'";
 $run = mysql_query($query) or die(mysql_error());
       $serial_no=0;
       while($row=mysql_fetch_array($run))
        {
			?>
	        <tr align="center">"; 
	        <th><?php echo $row['s_no'];?></th>;
	        <th><?php echo $row['item_product_name']; ?></th>
	        <th><?php echo $row['item_date']; ?></th>
	        <th><?php echo $row['item_purchase_price'];?></th>
	        <th><?php echo $row['item_sales_price']; ?></th>
	        <th><?php echo $row['item_purchase_quantity']; ?></th>
	        <th><?php echo $row['item_category']; ?></th>
	        <th><?php echo $row['item_subcategory']; ?></th>";
	        </tr>
			<?php 
         } 
?>