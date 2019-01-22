<?php
include("../../attachment/session.php");
 $category_name=$_POST['category_name'];
 $query="select * from item where category='$category_name' and item_status='Deleted'";
$run = mysql_query($query) or die(mysql_error());

       $serial_no=0;
       while($row=mysql_fetch_array($run))
        {
	        echo "<tr align='center'>"; 
	        echo "<th>".$row['s_no']."</th>";
	        echo "<th>".$row['model_no']."</th>";
	        echo "<th>".$row['date']."</th>";
	        echo "<th>".$row['item_purchase_purchase_price']."</th>";
	        echo "<th>".$row['item_sales_sales_price']."</th>";
	        echo "<th>".$row['item_sales_quantity']."</th>";
	        echo "<th>".$row['category']."</th>";
	        echo "<th>".$row['subcategory']."</th>";
	        echo "<th>".$row['item_status']."</th>";
	        echo "</tr>";
         } 
?>