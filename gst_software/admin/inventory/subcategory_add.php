<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Add Category & Subcategory
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Add Category & Subcategory</li>
      </ol>
    </section>
<script type="text/javascript">
        function sub_group_add(){
              var c = document.getElementById("count_num").value;
              var count = c++;
              var count = c;
             $('#row_1').after('<tr id="row_'+count+'"><td><input class="form-control" type="text" name="subcategory[]" id="category_'+count+'" placeholder="Add Sub Group" required /></td><td><button type="button" name="remove" id="'+count+'" class="btn btn-danger btn_remove">X</button></td></tr>');
             var count = count++;
             document.getElementById("count_num").value = count;
            $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");  
            $('#row_'+button_id+'').remove();  
            }); 
        }     
</script> 
<script>
$("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"inventory/subcategory_add_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
              alert(detail);
              $("#existing_data").html(detail);
            var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Complete');
           get_content('inventory/subcategory_add');
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
url: software_link+"inventory/subcategory_delete_api.php",
data: "id="+s_no,
cache: false,

success: function(detail){
    
    var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Deleted');
           get_content('inventory/subcategory_add');
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
    url:software_link+"inventory/ajax_category.php",
    data:"brand_name="+value,
    success:function(detail){
      $("#category_names").html(detail);
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
          <div class="col-md-5 box-body table-responsive">
              <table id="table-data" class="table table-striped table-borderless">
                <thead>
                  <tr>
                    <th class="col-md-12">Brand</th>
                  </tr>
                </thead>

                  <tr>
                    <input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
                    <td class="col-md-12">
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
                  </tr>

                <thead>
                  <tr>
                    <th class="col-md-12">Category</th>
                  </tr>
                </thead>
                <tr>
                    <td class="col-md-12">
                      <select class="form-control select2" type="text" width="100%" name="category_name" placeholder="SubCategory" id="category_names" width="100%" required />
                    </select>
                    </td>
                </tr>

                <thead>
                  <tr>
                    <th class="col-md-8">Add Subcategory</th>
                  </tr>
                </thead>
                <tr id="row_1">
                    <input type="hidden" id="count_num" value="1" />
                    <td class="col-md-8"><input class="form-control" type="text" name="subcategory[]" id="subcategory_1" placeholder="Add Sub Group" required /></td>
                </tr>
                <tr class="text-danger" id="existing_data"></tr>
          
        <tr>
            <td><input style="float:left;" type="button" name="more_category" value="Add More" onclick="sub_group_add()" class="btn  my_background_color" />

            <input type="submit"  name="add_product_name" value="Add Subcategory" class="btn btn-success pull-right" required /></td>
        </tr>
            </table>
          </div>

      <div class="col-md-7">
        <div class="col-md-12 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>S No.</th>
                  <th>Brand</th>
                  <th>Category</th>
                  <th>SubCategory</th>
                  <th>Action</th>
                </tr>
                </thead>
                    
        <tbody>
        <?php
        $que="select * from subcategory_add where company_code='$company_code' ORDER BY s_no DESC";
        $run=mysql_query($que) or die(mysql_error());
        $serial_no=0;
        while($row=mysql_fetch_array($run)){
        $s_no=$row['s_no'];
        $subcategory_name=$row['subcategory_name'];
                $brand_name=$row['brand_name'];
        $category=$row['category'];
        $serial_no++;
        ?>
        
        <tr align='center'>       
        <th><?php echo $serial_no; ?></th>
        <th><?php echo $brand_name; ?></th>
        <th><?php echo $category; ?></th>
        <th><?php echo $subcategory_name;?></th>
        <th><center>
          <a href="javascript:post_content('inventory/subcategory_edit','<?php echo 'id='.$s_no; ?>')"><i class="fa fa-edit" style="font-size:18px;" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick = "valid('<?php echo $s_no;?>');"><i class="fa fa-trash" style="font-size:18px; color:red" ></i></a></center>
        </th>
              </tr>
        <?php } ?>
        </tbody>        
        </table>
        </div>
      </div>
        </form>
        
    </div>
         
  </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
      <!-- /.box-body -->
    
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