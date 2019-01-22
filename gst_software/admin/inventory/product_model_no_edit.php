<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
      Edit Product Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Edit Product Details</li>
      </ol>
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$("#my_form").submit(function(e){

        e.preventDefault();
    var formdata = new FormData(this);

        $.ajax({

            url: software_link+"inventory/product_model_no_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
            	alert(detail);
            var res=detail.split("|?|");
         if(res[1]=='success'){
         	
           alert('Successfully Complete');
           get_content('inventory/product_model_no_add');
            }
			if(res[1] == 'Failed'){
			   alert('Same Entry Not Allow');
			   get_content('inventory/product_model_no_edit');
			}
          }
         });
      });
</script>
<script>

function category_select(value)
 {
  $.ajax({
    type:"POST",
    url:software_link+"inventory/ajax_category_subcategory.php",
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
    url:software_link+"inventory/ajax_subcategory.php",
    data:"category_name="+value,
    success:function(detail){
    	
      $("#subcategory_names").html(detail);
    }
  }) 
 }

</script>
      <?php
        $s_no=$_GET['id'];
        $que="select * from product_model_no where product_model_no_id='$s_no'";
        $run=mysql_query($que) or die(mysql_error());
        $serial_no=0;
        while($row=mysql_fetch_array($run))
        {

          $s_no = $row['product_model_no_id'];
          $brand=$row['brand_name'];
          $category = $row['category'];
          $subcategory = $row['subcategory'];
          $model = $row['model_name'];
        }
      ?>

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	     
    <div class="box my_border_top">
        <div class="box-body">
			<form role="form" id="my_form" enctype="multipart/form-data">	
				<div class="col-md-12 box-body table-responsive">
                  <table id="table-data" class="table table-bordered table-striped">
                    <thead class="my_background_color">
				      <div class="col-md-12">
		                <tr>
                    <input class="form-control" type="hidden" name="s_no" value="<?php echo $s_no; ?>"/>
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
           <select name="brand_name" class="form-control select2" width="100%"  onchange="category_select(this.value)" required="true">  
          <option value="<?php echo $brand;?>"><?php echo $brand;?></option>
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
            <option value="<?php echo $category;?>"><?php echo $category;?></option>
          </select>
          </td>

		  <td class="col-md-4">
		  	<select class="form-control" name="subcategory_name" value="<?php echo $subcategory;?>" id="subcategory_names" required>
          <option value="<?php echo $subcategory;?>"><?php echo $subcategory;?></option>
			</select>
		  </td>
				</tr>
				</div>
				<div class="col-md-12">
				<tr>
				  <th class="col-md-4">Modal No</th>
				</tr>
				</div>
				<div class="col-md-12">
				<tr>
				

				<td class="col-md-4">
				<input type="text" class="form-control" name="model_no" value="<?php echo $model;?>" placeholder="Model No" />
				</td>

				</tr>
				</div>
				<tr>
				<td colspan="3"><input type="submit" name="submit" value="Update" class="btn btn-success" /></td>
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
                  </tr>
                </thead>			
				<tbody>
      				<?php
      				$que="select * from product_model_no where company_code='$company_code' ORDER BY date DESC";
      				$run=mysql_query($que) or die(mysql_error());
      				$serial_no=0;
      				while($row=mysql_fetch_array($run)){
      				$s_no=$row['product_model_no_id'];
      				$date=$row['date'];
      				$brand_name=$row['brand_name'];
      				$category = $row['category'];
      				$subcategory=$row['subcategory'];
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
</section>
</div>
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