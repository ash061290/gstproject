<?php 
 include("../../attachment/session.php");
?>
    <section class="content-header">
      <h1>
        Edit Brand
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('../index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Add Brand</li>
      </ol>
    </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$("#my_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: software_link+"inventory/brand_edit_api.php",
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
           post_content('inventory/brand_add',res[2]);
            }
          }
         });
      });
</script>

      <?php
        $s_no=$_GET['id'];
        $que="select * from brand_add where s_no='$s_no'";
        $run=mysql_query($que) or die(mysql_error());
        $serial_no=0;
        while($row=mysql_fetch_array($run)){

          $s_no = $row['s_no'];
          $brand_name = $row['brand_name'];
        }
      ?>

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	     <div class="col-xs-12">
    <div class="box my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
        <div class="box-body">
			<form role="form" id="my_form" enctype="multipart/form-data">				
				<div class="col-md-6 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Brand Name</th>
				          <th>Edit Brand</th>
                </tr>
                </thead>
				
				<tbody>
				<tr>
          <input type="hidden" name="s_no" value="<?php echo $s_no; ?>">
          <input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
				<td><input class="form-control" type="text" value="<?php echo $brand_name;?>" name="brand_name" placeholder="Add Brand Name" required /></td>
				<td><input type="submit" name="add_brand" value="Update Brand" class="btn btn-success" /></td>
				</tr>					
				</tbody>
				
                </table>
                </div>
			
				<div class="col-md-6 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
				            <th>S No.</th>
                    <th>Brand Name</th>
                </tr>
                </thead>
										
				<tbody>
				<?php
				$que="select * from brand_add where company_code='$company_code'";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
				while($row=mysql_fetch_array($run)){
				$s_no=$row['s_no'];
				$brand_name=$row['brand_name'];
				$serial_no++;
				?>		
				
				<tr align='center'>				
				<th><?php echo $serial_no; ?></th>
				<th><?php echo $brand_name; ?></th>
	            </tr>
				<?php } ?>
				</tbody>				
                </table>
                </div>
		</div>
	       </form>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!--/box-body-->
    </div>
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




