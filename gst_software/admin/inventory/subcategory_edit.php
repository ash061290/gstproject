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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 

<script>
$("#my_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);
    alert(formdata);
        $.ajax({
            url: software_link+"inventory/subcategory_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
      
            processData: false,
            success: function(detail){
              //alert(detail);
            var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Complete');
           get_content('inventory/subcategory_add');
            }
      }
         });
      });

</script>
<?php
        $s_no=$_GET['id'];
        $que="select * from subcategory_add where s_no='$s_no'";
        $run=mysql_query($que) or die(mysql_error());
        $serial_no=0;
        while($row=mysql_fetch_array($run))
        {
        $s_no = $row['s_no'];
        $subcatgory =$row['subcategory_name'];
        $category = $row['category'];
        $brand_name = $row['brand_name'];
        $company_code = $row['company_code'];
       
        
        }
      ?>

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
                    <input class="form-control" type="hidden" value="<?php echo $s_no; ?>" name="s_no"/>
                    <input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
                    <td class="col-md-12">
                         <select name="brand_name" class="form-control select2" width="100%"  onchange="category_select(this.value)" required="true">  
                            <option value='<?php echo $brand_name?>'><?php echo $brand_name?></option>
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
                      <input class="form-control" type="text" value="<?php echo $category;?>" name="category_name" placeholder="Category" required />
                    </td>
                </tr>

                <thead>
                  <tr>
                    <th class="col-md-8">Add Subcategory</th>
                  </tr>
                </thead>
                <tr>
                  <td class="col-md-12">
                   <input class="form-control" type="text" value="<?php echo  $subcatgory;?>" name="subcategory_name" placeholder="Subcategory" required /> 
                 </td>
                </tr>
          
        <tr>
            <td>

            <input type="submit"  name="add_product_name" value="Update" class="btn btn-success" required /></td>
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
                </tr>
                </thead>
                    
        <tbody>
        <?php
        $que="select * from subcategory_add where company_code='$company_code'";
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