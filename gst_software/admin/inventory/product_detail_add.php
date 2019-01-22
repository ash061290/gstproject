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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	 var brand = document.getElementById('brand').value;
  $.ajax({
    type:"POST",
    url: software_link+"inventory/ajax_subcategory.php",
    data:"category_name="+value+"&brand_name="+brand,
    success:function(detail){
    	alert(detail);
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
			<form role="form" id="my_form" enctype="multipart/form-data">	
				<div class="col-md-12 box-body table-responsive">
                  <table id="table-data" class="table table-bordered table-striped">
                    <thead class="">
				      <div class="col-md-12">
		                <tr>
		                <input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
		                  <th class="col-md-4">Select Brand</th>
						  <th class="col-md-4">Select Category</th>
						  <th class="col-md-4">Select Subcategory</th>
		                </tr>
				      </div>
				</div>
                </thead>
				
				<tbody>
				
				<div class="col-md-12">
				<tr>
          <td class="col-md-4">
           <select name="brand_name" id="brand" class="form-control select2" width="100%"  onchange="category_select(this.value)" required="true">  
          <option value=''>Select brand</option>
          <?php 
          $que="select * from brand_add where company_code='$company_code'";
          $run=mysql_query($que) or die(mysql_error());
          while($row=mysql_fetch_array($run)){
          $brand_name = $row['brand_name'];
          ?>
          <option value="<?php echo $brand_name; ?>"><?php echo $brand_name; ?></option>
          <?php } ?>
          </select>
          </td>

          <td class="col-md-4">
           <select name="category_name" class="form-control select2" width="100%" onchange="subcategory_select(this.value)" id="category_names" required>
		   <option value="">--Select--</option>
          </select>
          </td>

		  <td class="col-md-4">
		  	<select class="form-control" name="subcategory_name" id="subcategory_names" required>
			<option value="">--Select--</option>
			</select>
		  </td>
				</tr>
				</div>
				<div class="col-md-12">
				<tr>
				  <th class="col-md-4">Modal No</th>
				  <th class="col-md-4">Action</th>
				  <th class="col-md-4"></th>
				</tr>
				</div>
				<div class="col-md-12">
				<tr>
				
				<td class="col-md-4">
				<input type="text" class="form-control" name="model_no" placeholder="Model No" />
				</td>
				<td class="col-md-4">
				<input type="submit" name="submit" value="Submit" class="btn btn-success" />
				</td>
				<td class="col-md-4"></td>
				</tr>
				</div>
				<tr>
			
					</tr>				
				</tbody>
				
                </table>
                </div>
		
		</div>
	       </form>
		   <div class="col-md-12 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
				  <th>S No.</th>
				  <th>Date</th>
                  <th>Brand Name</th>
				  <th>Category Name</th>
				  <th>SubCategory Name</th>
				  <th>Model</th>
				  <th>Action</th>
                </tr>
                </thead>			
				<tbody>
				<?php
				$que="select * from product_model_no where company_code='$company_code' ORDER BY date DESC";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
				while($row=mysql_fetch_array($run)){
				$s_no=$row['s_no'];
				$date=$row['date'];
				$brand_name=$row['brand_name'];
				$category = $row['category'];
				$subcategory=$row['subcategory'];
				$quantity=$row['quantity'];
				$modal=$row['model_name'];
				$serial_no++;
				?>		
				<tr align='center'>				
				<th><?php echo $serial_no; ?></th>
				<th><?php echo $date; ?></th>
				<th><?php echo $brand_name; ?></th>
				<th><?php echo $category; ?></th>
				<th><?php echo $subcategory?></th>
				<th><?php echo $modal; ?></th>
				<th>
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
	 </div>
	 </div>
	 </div>
</section>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>