<?php include("../../attachment/session.php");
if(isset($_GET['p_id'])){ 
       $p_id = $_GET['p_id'];
 if(!isset($_GET['check_quantity'])){
	   $select = "Select * from item where s_no='$p_id' and item_status='Active' and company_code='$company_code'";
	   $run = mysql_query($select);
	   $fetchrow = mysql_fetch_array($run);
	   $quantity = $fetchrow['item_purchase_quantity'];
	   $price = $fetchrow['item_sales_price'];
	   echo $quantity."|?|".$price;
}
}
if(isset($_GET['p_id'])){	
if(isset($_GET['check_quantity'])){
     $quantity1 = $_GET['check_quantity'];
      $select = "Select item_purchase_quantity from item where s_no='$p_id' and item_status='Active' and company_code='$company_code'";
	   $run = mysql_query($select);
	   $fetchrow = mysql_fetch_array($run);
	   $m=0;
	   $quantity = $fetchrow['item_purchase_quantity'];	
       if($quantity<$quantity1){
	      $m = $m+1;
		  echo $m."|?|".$quantity;
	     }		   
		 else{ echo $m."|?|".$quantity1; }
} 
} 
  ?>