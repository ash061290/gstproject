<?php include("../../attachment/session.php"); ?>
<section class="content-header">
      <h1>
        Product Attribute
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('../index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Product Attribute</li>
      </ol>
    </section>
<script>
$("#my_form").submit(function(e){ 
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"inventory/product_attribute_add_api.php",
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
           post_content('inventory/product_attribute_add',res[2]);
            }
      }
         });
      });
</script>
<script>
function valid(s_no){  
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_UOM(s_no);
 }            
else  {      
return false;
 }       
  } 
  function delete_UOM(s_no){  
$.ajax({
type: "POST",
url: software_link+"/inventory/product_attribute_delete_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert('Successfully Deleted');
				   get_content('inventory/product_attribute_add');
			   }else{
               alert(detail); 
			   }
}
});
}
</script>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	  <div class="col-xs-12">
    <div class="box my_border_top">
            <div class="box-header with-border ">
            </div>
        <div class="box-body">
			<form role="form" id="my_form" enctype="multipart/form-data">				
				<div class="col-md-6 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th> Attribute</th>
				  <th>Add Product Attribute</th>
                </tr>
                </thead>
				<tbody>
				<tr>
          <input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
				<td><input class="form-control" type="text" name="product_attribute_name" placeholder="Add Product" required /></td>
				<td><input type="submit" name="add_uom" value="Add Product" class="btn btn-success"/></td>
				</tr>			
				</tbody>				
                </table>
                </div>
			
				<div class="col-md-6 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
          		    <th>S No.</th>
                    <th>Product Attribute</th>
                    <th>Status</th>
          		    <th><center>Action</center></th>
                </tr>
                </thead>					
				<tbody>
				<?php
				$que="select * from product_attribute_add where company_code='$company_code'";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
				while($row=mysql_fetch_array($run)){
				$s_no=$row['s_no'];
				$product_attribute_name=$row['product_attribute_name'];
				$serial_no++;
				?>
				<tr align='center'>				
				<th><?php echo $serial_no; ?></th>
				<th><?php echo $product_attribute_name; ?></th>
                <th>Active</th>
				<th><center>
  <a href="javascript:post_content('inventory/product_attribute_edit','<?php echo 'id='.$s_no; ?>')"><i class="fa fa-edit" style="font-size:18px;" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="#" onclick = "valid('<?php echo $s_no;?>');"><i class="fa fa-trash" style="font-size:18px; color:red" ></i></a></center>
          </th></tr>
				<?php } ?>
				</tbody>				
                </table>
                </div>
                </form>
		</div> 
	</div>
    </div>
	  </div>
</section>
</div>
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
</html>