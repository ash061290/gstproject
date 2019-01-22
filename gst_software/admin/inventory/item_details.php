 <?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Generate Barcode
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Generate Barcode</li>
      </ol>
    </section>
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
					  <th>Date</th>
	                  <th>Brand Name</th>
					  <th>Category Name</th>
					  <th>SubCategory Name</th>
					  <th>Modal No</th>
					  <th>Sales Quantity</th>
					  <th><center>Barcode</center></th>
	                </tr>
                </thead>			
				<tbody>
				<?php
				$que="select * from item where item_status='Active' and company_code='$company_code'";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
				while($row=mysql_fetch_array($run)){
				$s_no=$row['s_no'];
				$date=$row['item_date'];
				$brand_name=$row['item_brand'];
				$category = $row['item_category'];
				$subcategory=$row['item_subcategory'];
				$modal=$row['item_product_name'];
				$sales_quantity=$row['item_sales_quantity'];
				$serial_no++;
				?>		
				<tr align='center'>				
				<th><?php echo $serial_no; ?></th>
				<th><?php echo $date; ?></th>
				<th><?php echo $brand_name; ?></th>
				<th><?php echo $category; ?></th>
				<th><?php echo $subcategory?></th>
				<th><?php echo $modal; ?></th>
				<th><center><?php echo $sales_quantity;?></center></th>
				<th>
				<a href="javascript:post_content('inventory/generate_barcode','<?php echo 'id='.$s_no; ?>')">Generate Barcode</a>
			    </th>
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