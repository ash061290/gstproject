<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Product Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Product Details</li>
      </ol>
    </section>

<script>
$("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"inventory/product_detail_add_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
            var res=detail.split("|?|");
         if(res[1]=='success'){
         	
           alert('Successfully Complete');
           get_content('inventory/product_detail_add');
            }
			if(res[1] == 'Failed'){
			   alert('Same Entry Not Allow');
			   get_content('inventory/product_detail_add');
			}
          }
         });
      });
</script>
<script>
function valid(s_no){  
 
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_product_detail(s_no);

 }            
else  {      
return false;
 }       
  } 
function delete_product_detail(s_no){  
$.ajax({
type: "POST",
url: software_link+"inventory/product_detail_delete_api.php",
data: "id="+s_no,
cache: false,

success: function(detail){
    var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Deleted');
           get_content('inventory/product_detail_add');
         }else{
               alert(detail); 
         }
}
});
}

function category_select(value)
 {
  $.ajax({
    type:"POST",
    url: software_link+"inventory/ajax_category_subcategory.php",
    data:"brand_name="+value,
    success:function(detail){
    	
      $("#category_names").html(detail);
    }
  }) 
 }

function subcategory_select(value)
 {
  $.ajax({
    type:"POST",
    url: software_link+"inventory/ajax_subcategory.php",
    data:"category_name="+value,
    success:function(detail){
    	
      $("#subcategory_names").html(detail);
    }
  }) 
 }

</script>

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	     
    <div class="box my_border_top">
        <div class="box-body">
		   <div class="col-md-12 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
				  <th>S No.</th>
				  <th>Insert Date</th>
                  <th>Product Name</th>
				  <th>Product Price</th>
				  <th>Product Quantity</th>
				  <th>Action</th>
                </tr>
                </thead>			
				<tbody>
				<?php
				$que="select * from item where company_code='$company_code' and item_status='Active' ORDER BY s_no DESC";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
				while($row=mysql_fetch_array($run)){
				$s_no=$row['s_no'];
				//$date=$row['date'];
				$brand_name=$row['brand_name'];
				$insert_date = $row['insert_date'];
				$item_name = $row['model_no'];
			    $product_name = "select model_name from product_model_no where s_no='$item_name'";
				$run2 = mysql_query($product_name);
				$fetch_name = mysql_fetch_array($run2);
				$product_name = $fetch_name['model_name'];
				$item_price = $row['item_sales_sales_price'];
				$item_sales_quantity=$row['item_sales_quantity'];
				$serial_no++;
				?>		
				<tr align='center'>				
				<th><?php echo $serial_no; ?></th>
				<th><?php echo $insert_date; ?></th>
				<th><?php echo $product_name; ?></th>
				<th><?php echo $item_price; ?></th>
				<th><?php echo $item_sales_quantity?></th>
				<th>
				 <a href="get_content('inventory/sales_detail')" >Sales Detail</a>&nbsp;&nbsp;&nbsp;&nbsp;
				 <a href="get_content('inventory/purchase_detail')" >Purchase Detail</a>&nbsp;&nbsp;&nbsp;&nbsp;
				 <a href="#" >Active</a>&nbsp;&nbsp;&nbsp;&nbsp;
				 <a href="javascript:post_content('inventory/product_detail_edit','<?php echo 'id='.$s_no; ?>')" ><i class="fa fa-edit" style="font-size:18px;" ></i></a>
				 &nbsp;&nbsp;&nbsp;&nbsp;
				 <a href="#" onclick = "valid('<?php echo $s_no;?>');"><i class="fa fa-trash" style="font-size:18px; color:red" ></i></a></th>
	            </tr>
				<?php } ?>
				</tbody>				
                </table>
                </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  
	 </div>
	 </div>
	 </div>
</section>

<script>
  $(function () {
    $('#example1').DataTable()
  
  })
</script>