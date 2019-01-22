<?php include("../../attachment/session.php"); 
      $brand_name = $_POST['brand_name'];
       if($brand_name==1)
       {
   	    $que="select * from item where item_status='Active'";
        $run=mysql_query($que) or die(mysql_error());

        $serial_no=1;
        while($row=mysql_fetch_array($run))
        {
	        echo "<tr align='center'>"; 
	        echo "<th>".$serial_no."</th>";
	        echo "<th>".$row['item_product_name']."</th>";
	        echo "<th>".$row['item_date']."</th>";
	        echo "<th>".$row['item_purchase_price']."</th>";
	        echo "<th>".$row['item_sales_price']."</th>";
	        echo "<th>".$row['item_purchase_quantity']."</th>";
	        echo "<th>".$row['item_category']."</th>";
	        echo "<th>".$row['item_subcategory']."</th>";
	        echo "</tr>";
			$serial_no++;
         }
   }
   else
   {
		$category = "select * from category_add where brand_name='$brand_name' and company_code='$company_code'";
		$fetch_cat = mysql_query($category);
		$i=0;
	    $numrow = mysql_num_rows($fetch_cat);
        while($fetch_row = mysql_fetch_array($fetch_cat)){
		   $row1[$i] = "<option value='".$fetch_row['category']."'>".$fetch_row['category']."</option>";
		  $i = $i+1;
		}
        $serial_no=1;
		$j = 0;
		$que="select * from item where item_brand='$brand_name' and item_status='Active'";
        $run=mysql_query($que) or die(mysql_error());
        while($row=mysql_fetch_array($run))
        {
	         $row2[$j] ="<tr align='center'>
			   <th>".$serial_no."</th>
			   <th>".$row['item_product_name']."</th>
	           <th>".$row['item_date']."</th>
	           <th>".$row['item_purchase_price']."</th>
	           <th>".$row['item_sales_price']."</th>
	           <th>".$row['item_purchase_quantity']."</th>
	           <th>".$row['item_category']."</th>
	           <th>".$row['item_subcategory']."</th> 
		       </tr>";
			   $j = $j+1;
			   $serial_no++;
         }
		 $option = implode(" ",$row1);
		 $table_row = implode(" ",$row2);
		 if($numrow>0){ $select_option ="<option value=''>--Select--</option>"; }
		 if(isset($select_option)){
		     $option = $select_option.$option;
		 }
         echo $option."|?|".$table_row;
   }
   
?>
