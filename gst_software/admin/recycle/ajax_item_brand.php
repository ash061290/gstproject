<?php
include("../../attachment/session.php"); 
  $brand_name = $_POST['brand_name'];
   if($brand_name==1)
   {
   	    $que="select * from item where item_status='Deleted'";
        $run=mysql_query($que) or die(mysql_error());

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
	        echo "<th><a href='#'onclick='valid('$s_no;');'>".$row['item_status']."</a></th>";
	        echo "</tr>";
         } 
   }
   else
   {
   	    $que="select * from item where brand_name='$brand_name' and item_status='Deleted'";
        $run=mysql_query($que) or die(mysql_error());

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
	        echo "<th><a href='#'onclick='valid('$s_no;');'>".$row['item_status']."</a></th>";
	        echo "</tr>";
         } 

   }
   
?>
<script>
function valid(s_no){
	alert(s_no);
 
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_item_list(s_no);

 }            
else  {      
return false;
 }
  } 
  function delete_item_list(s_no){  
    alert(s_no);
$.ajax({
type: "POST",
url: software_link+"recycle/item_permanent_delete_api.php",
data: "id="+s_no,
cache: false,

success: function(detail){
  alert(detail);
    var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Deleted');
           get_content('inventory/item_list');
         }else{
               alert(detail); 
         }
}
});
}
</script>