<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("link_css.php")?>

</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">


  
  <?php include("../attachment/header.php")?>
  <?php include("../attachment/sidebar.php")?>
  
 <?php
$s_no=$_GET['id'];

include("../../connection/connect.php");

$que="select * from item_group_table where s_no='$s_no'";
$run=mysql_query($que);
$serial_no=0;
while($row=mysql_fetch_array($run)){
	$s_no = $row['s_no'];
	$product_type = $row['product_type'];
	$item_group = $row['item_group'];
	$description = $row['description'];
	$uom = $row['uom'];
	$manufacturer = $row['manufacturer'];
	$brand_name = $row['brand_name'];
	$tax_prefrences = $row['tax_prefrences'];
}
?>

  
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       New Item
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title"><b>Add New Item</b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data">
			
			<div class="col-md-12 ">
				<div class="col-md-4 ">
					 <div class="form-group">
					  <label >Product Type:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
							<input type="radio" name="product_type" id="optionsRadios2" <?php if($product_type=='Product') echo "checked";?> value="Product">&nbsp;&nbsp;<b>Product</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="product_type" id="optionsRadios2" <?php if($product_type=='Service') echo "checked";?> value="Service">&nbsp;&nbsp;<b>Service</b> 
				</div>
			</div>
			
			
			<div class="col-md-8 ">				
					<div class="form-group">
					  <label >Tax Preferences:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
							<input type="radio" name="tax_prefrences" id="optionsRadios2" <?php if($tax_prefrences=='Taxable') echo "checked";?>  value="Taxable">&nbsp;&nbsp;<b>Taxable</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="tax_prefrences" id="optionsRadios2" <?php if($tax_prefrences=='Non-Taxable') echo "checked";?> value="Non-Taxable">&nbsp;&nbsp;<b>Non-Taxable</b> 
					</div>
			</div>
			</div>
						
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Product Group Name :</label>
					  <input type="text"  name="item_group" placeholder="Add Product Group Name" value="<?php echo $item_group; ?>" class="form-control">
					</div>
				</div>
				
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Description :</label>
					  <input type="text"  name="description" placeholder="Add Description" value="<?php echo $description; ?>" class="form-control">
					</div>
				</div>
				
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >UOM :</label>
					   <select class="form-control">
				<option value="<?php echo $uom; ?>"><?php echo $uom; ?></option>
					  <option>Piece</option>
					  <option>Dugen</option>
					  </select>
					</div>
				</div>
				
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Manufacturer :</label>
					  <input type="text"  name="manufacturer" placeholder="Add Manufacturer" value="<?php echo $manufacturer; ?>" class="form-control">
					</div>
			</div>
						
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Brand :</label>
					  <input type="text"  name="brand_name" placeholder="Add Brand" value="<?php echo $brand_name; ?>" class="form-control">
					</div>
				</div>
	
			
	</div>
			<br>
			
		<div class="col-md-12">
		    
			<center><input type="submit" name="finish" value="Submit" class="btn  my_background_color" />
			<button type="button" class="btn btn-primary">Cancel</button></center>
			
		 </div>	
		 
		 
				
	</form>	
	
<?php



include("../../connection/connect.php");

if(isset($_POST['finish'])){
	$s_no = $_POST['s_no'];
	$product_type = $_POST['product_type'];
	$item_group = $_POST['item_group'];
	$description = $_POST['description'];
	$uom = $_POST['uom'];
	$manufacturer = $_POST['manufacturer'];
	$brand_name = $_POST['brand_name'];
	$tax_prefrences = $_POST['tax_prefrences'];
	

    $quer="update item_group_table set product_type='$product_type',item_group='$item_group',description='$description',uom='$uom',manufacturer='$manufacturer',brand_name='$brand_name',tax_prefrences='$tax_prefrences' where s_no='$s_no'";
 
 if(mysql_query($quer)){
	echo "<script>window.open('item_group_list.php','_self');</script>";
}
 }

?>	

<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          
		  </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("link_js.php")?>
</body>
</html>
