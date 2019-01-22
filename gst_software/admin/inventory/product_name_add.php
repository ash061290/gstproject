<?php include("../../attachment/session.php"); ?>

    <section class="content-header">
      <h1>
        Add Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Add Product</li>
      </ol>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$("#my_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"inventory/product_name_add_api.php",
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
           get_content('inventory/product_name_add');
            }
      }
         });
      });
</script>

<script>
function valid(s_no){
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
product_delete(s_no);
 }            
else  {      
return false;
 }       
  } 
  function product_delete(s_no){  
    
$.ajax({
type: "POST",
url: software_link+"inventory/product_name_delete_api.php",
data: "id="+s_no,
cache: false,

success: function(detail){
    
    var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Deleted');
           get_content('inventory/product_name_add');
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
    url: software_link+"inventory/ajax_category.php",
    data:"brand_name="+value,
    success:function(detail){
      $("#category_name").html(detail);
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
                <thead class="my_background_color">
                <tr>
                  <th class="col-md-4">Brand</th>
                  <th class="col-md-4">Category</th>
                  <th class="col-md-4">Add Subcategory</th>
                </tr>
                </thead>
        
        <tbody>
        <div class="col-md-12">
        <tr>
          <input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
          <td class="col-md-4">
           <select name="brand_name" class="form-control select2" width="100%"  onchange="category_select(this.value)" required="true">  
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
           <select name="category" class="form-control select2" width="100%" id="category_name" required>
          
          </select>
              
          </td>
 <!------------------------------add subCategory ------------------------------>
        <td class="col-md-4">
          <input class="form-control" type="text" name="product_name" placeholder="SubCategory" required />
        </td>
        <td><input type="submit" name="add_product_name" value="Add Subcategory" class="btn btn-success" required /></td>
        </tr>
               </div>       
        </tbody>
                </table>
                </div>
        <div class="col-md-12 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>S No.</th>
				  <th>Date</th>
                  <th>Brand</th>
                  <th>Category</th>
                  <th>SubCategory</th>
                  <th>Action</th>
                </tr>
                </thead>
                    
        <tbody>
        <?php
        $que="select * from subcategory_add where company_code='$company_code' order by subcategory_name_id desc";
        $run=mysql_query($que) or die(mysql_error());
        $serial_no=0;
        while($row=mysql_fetch_array($run)){
        $subcategory_id=$row['subcategory_name_id'];
		$insert_date = $row['insert_date'];
        $subcategory_name=$row['subcategory_name'];
        $brand_name=$row['brand_name'];
        $category=$row['category'];
        $serial_no++;
        ?>
        
        <tr align='center'>       
        <th><?php echo $serial_no; ?></th>
		<th><?php echo $insert_date; ?></th>
        <th><?php echo $brand_name; ?></th>
        <th><?php echo $category; ?></th>
        <th><?php echo $subcategory_name;?></th>
        <th><center>

          <a href="#" onclick = "valid('<?php echo $subcategory_id;?>');"><i class="fa fa-trash" style="font-size:18px; color:red" ></i></a></center>
        </th>
              </tr>
        <?php } ?>
        </tbody>        
                </table>
                </div>
        </form>
        
    </div>
         
  </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
      <!-- /.box-body -->
    
    </div>
      </div>
</section>
<script src="select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
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