<?php
session_start();
if(isset($_SESSION['emp_id']))
{
	$company_name = $_SESSION['firm_name'];
	$company_code = $_SESSION['firm_id'];
}
    include_once("../../noc73/con37.php");
?>

    <section class="content-header">
      <h1>
        Add Product Company Wise
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Add Product Company Wise</li>
      </ol>
    </section>
	<script>
	function valid(){   
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	return true;        
	 }            
	else  {      
	return false;
	 }       
	  }

      function for_product_add(value){ 
             $.ajax({
			  type: "POST",
              url: "ajax_company_wise_product_add.php?company="+value+"",
              cache: false,
              success: function(detail){
              $('#example1').html(detail);
              }
           });
            }	
      function for_product_delete(value){ 
             $.ajax({
			  type: "POST",
              url: "ajax_company_wise_product_delete.php?company="+value+"",
              cache: false,
              success: function(detail){
              $('#example2').html(detail);
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
			<form role="form" method="post" enctype="multipart/form-data">				
				<div class="col-sm-6 box-body table-responsive">               
				<div class="col-sm-12">
				  <div class="form-group">
				    <label>Company Name</label>
					<select name="company_name" class="form-control select2" id="company_name1" onchange='for_product_add(this.value);for_product_delete(this.value);' required>
					<?php 
					if(isset($_GET['company_name'])){
							$company_name=$_GET['company_name'];
					?>
					<option value="<?php echo $company_name; ?>" ><?php echo $company_name; ?></option>
					<?php } else { ?>
					<option value=''>Select</option>
					<?php }
					$que="select * from company_add";
					$run=mysql_query($que) or die(mysql_error());
					while($row=mysql_fetch_array($run)){
					$company_name = $row['company_name'];
					?>
					<option value="<?php echo $company_name; ?>" ><?php echo $company_name; ?></option>
					<?php } ?>
					</select>				
				  </div>
				</div>
				
				<div class="col-sm-12">
				<table  class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Product Name</th>
				  <th>Add Product</th>
                </tr>
                </thead>				
				<tbody id="example1">
				
				</tbody>				
                </table>
				</div>	
				
                </div>
			
				<div class="col-md-6 box-body table-responsive">
				<br><br><br>
                <table id="" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>Product Name</th>
				  <th>Delete</th>
                </tr>
                </thead>
										
				<tbody id="example2">
				
				</tbody>				
                </table>
                </div>
		</div>
	       </form>
	</div>
    </div>
	</div>
	</div>
</section>
 
</body>


<script>
var company_name2=document.getElementById("company_name1").value;
if(company_name2!=''){

for_product_add(company_name2);
for_product_delete(company_name2);
}
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
