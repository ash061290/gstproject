<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>S.No</th>
				  <th>Product Name</th>
                  <th>Product Type</th>
				  <th>Product Brand</th>
				  
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody id="search_table">


<?php
include("../../connection/connect.php");

$item_sub_group=$_GET['item_sub_group'];

	if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;

	$setLimit = 20;
	$pageLimit = ($page * $setLimit) - $setLimit;
	
$que="select * from item_master where item_status='Active' and item_sub_group='$item_sub_group' LIMIT $pageLimit , $setLimit ";
$run=mysql_query($que) or die(mysql_error());
$serial_no=$pageLimit;
while($row=mysql_fetch_array($run)){
	$s_no=$row['s_no'];
	$item_product_name=$row['item_product_name'];
	$item_sub_group=$row['item_sub_group'];
	$item_group=$row['item_group'];
	
		

$serial_no++;
	
?>

<tr  align='center' >

	
	<th><?php echo $serial_no; ?></th>
	<th><?php echo $item_product_name; ?></th>
	<th><?php echo $item_sub_group; ?></th>
	<th><?php echo $item_group; ?></th>
	
	
<th>
	<center><a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-times" href='item_delete.php?id=<?php echo $s_no; ?>'> Delete</a></center>
	
</th>

</tr>
<?php } ?>
		</tbody>
            
             </table>