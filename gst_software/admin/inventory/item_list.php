<?php include("../../attachment/session.php"); ?>
 <section class="content-header">
      <h1>
        Product List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('../../index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="javascript:get_content('inventory/items')"><i class="fa fa-plus"></i>Item Add</a></li>
        <li class="active">Inventory List</li>
      </ol>
    </section>
<script>
function valid(s_no){
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
url: software_link+"inventory/item_delete_api.php",
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
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">       			
          <!-- /.box -->
          <div class="box">
          <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>S.No</th>
                  <th>DATE</th>
                  <th>PRODUCT NAME</th>
                  <th>QUANTITY</th>
				  <th>PURCHASE PRICE</th>
                  <th>SALE PRICE</th>
                  <th>CATEGORY</th>
				  <th>SUB CATEGORY</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody id="">
				<?php
				$que="select * from item where item_status='Active'";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
				while($row=mysql_fetch_array($run)){
						$s_no=$row['s_no'];
						$item_product_name=$row['item_product_name'];
                        $date=$row['item_date'];
					    $item_purchase_price=$row['item_purchase_price'];
						$item_sale_price=$row['item_sales_price'];
                        $item_purchase_quantity=$row['item_purchase_quantity'];
						$item_group=$row['item_category'];			
                        $item_sub_group=$row['item_subcategory'];	
					    $serial_no++;
				?>
				<tr align='center'>
				<th><?php echo $serial_no; ?></th>
                <th><?php echo $date; ?></th>
				<th><?php echo $item_product_name; ?></th>
                <th><?php echo $item_purchase_quantity; ?></th>
				<th><?php echo $item_purchase_price; ?></th>
				<th><?php echo $item_sale_price; ?></th>
				<th><?php echo $item_group; ?></th>
				<th><?php echo $item_sub_group; ?></th>	
				<th>
        <center> 
				<a style="color:Green;" aria-hidden="true"href="javascript:post_content('inventory/items_edit','<?php echo 'id='.$s_no; ?>')"><i class="fa fa-edit" style="font-size:18px;" ></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
				<a style="color:Red;" aria-hidden="true" onclick = "valid('<?php echo $s_no;?>');"  href='#'><i class="fa fa-trash" style="font-size:18px; color:red" ></i></a></center>
				</th>
				</tr>
				<?php } ?>
		        </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>