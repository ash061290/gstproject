<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("../attachment/link_css.php")?>

</head>
<script src="ready_function_ajax_jquery.js"></script>
<script>
function searchKeyPress(e)
{
    e = e || window.event;
    if (e.keyCode == 13)
    {
        document.getElementById('popup_click').click();
        return false;
    }
    return true;
}

function searchKeyPress1(e1)
{
    e1 = e1 || window.event;
    if (e1.keyCode == 13)
    {
        document.getElementById('popup_click1').click();
        return false;
    }
    return true;
}

function get_barcode(){
var code=document.getElementById('barcode_no1').value;
document.getElementById('barcode_no').value=code;
}

function get_serial_no_barcode(){
var code=document.getElementById('scan_item_serial_no1').value;
document.getElementById('scan_item_serial_no').value=code;
}

</script>
<script type="text/javascript">
   function group_name(value){    
       $.ajax({
			  type: "POST",
              url: "ajax_sabgroup_name.php?id="+value+"",
              cache: false,
              success: function(detail){
                   var str =detail;                
                  $("#subgroup_name").html(str);
                  $("#taxable_div").show();
				  $("#category1").val('');
              }
           });

    }
	
	function for_category(value){    
       $.ajax({
			  type: "POST",
              url: "ajax_category.php?id="+value+"",
              cache: false,
              success: function(detail){      
                  var str =detail;
		      var res = str.split("|?|");
		      $("#category1").val(res[1]);
              }
           });

    }
</script>


<script> 
$( document ).ready(function() { 
tax_preference('Taxable');
});
function tax_preference(value){
if(value=='Taxable'){
$('#item_intra_state_tax_precentage').val('0');
$('#item_inter_state_tax_precentage').val('0');
$('#taxable_div').show();
} else {
$('#item_intra_state_tax_precentage').val('0');
$('#item_inter_state_tax_precentage').val('0');
$('#taxable_div').hide();
}
}
</script>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php include("../attachment/header.php"); ?>
  <?php include("../attachment/sidebar.php"); ?>
  <?php include("../../connection/connect.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Add Item
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="item_list.php"><i class="fa fa-list"></i>Inventory List</a></li>
        <li class="active">Add Item</li>
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
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			
    <div class="box-body">
    <form role="form" method="post" onsubmit="return validate();" enctype="multipart/form-data">
			<div class="col-md-12">
			    <div class="form-group col-md-4">
				<label>Item Type:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					
				<input type="radio" name="item_product_type" id="" value="Product" checked>&nbsp;&nbsp;<b>Product</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="item_product_type" id="" value="Service">&nbsp;&nbsp;<b>Service</b>
				</div>
				<div class="form-group col-md-4">
				 <label>UOM :</label>
				  <select class="form-control select2" name="item_uom" style="width:100%" required>
				  <option value="">Select</option>					  
				  <?php
				  $que="select * from uom_add";
				  $run=mysql_query($que) or die(mysql_error());
				  while($row=mysql_fetch_array($run)){
				  $uom_name = $row['uom_name'];
				  ?>
				  <option value="<?php echo $uom_name; ?>" ><?php echo $uom_name; ?></option>
				  <?php } ?>
				  </select>
				  </div>
				<div class="form-group col-md-4">
				<label>Tax Preferences:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
				<input type="radio" name="item_tax_preferences" id="" onclick="tax_preference(this.value);" value="Taxable" checked>&nbsp;&nbsp;<b>Taxable</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="item_tax_preferences" id="" onclick="tax_preference(this.value);" value="Non-Taxable">&nbsp;&nbsp;<b>Non-Taxable</b>
				</div>
				
			</div>
			<div class="col-md-12">				
			    <div class="form-group col-md-4">
				<label>Group Name :</label>
				    <select name="item_group" class="form-control select2" style="width:100%;" onchange='group_name(this.value);' required>
				    <option value="">Select</option>
					<?php					
						$query="select * from company_add";
						$res=mysql_query($query);
						while($row=mysql_fetch_array($res)){
						$company_name_id=$row['company_name_id'];
						$company_name=$row['company_name'];
						?>
						<option value="<?php echo $company_name; ?>"><?php echo $company_name; ?></option>
						<?php } ?>
			        </select>
				</div>
				<div class="form-group col-md-4">
				 <label>Sub Group Name :</label>
				    <select name="item_sub_group" class="form-control select2" id="subgroup_name" onchange='for_category(this.value);' style="width:100%">
				    <option value="">Select</option>
				    </select>
				</div>
				<div class="form-group col-md-4">
				<label>Item Name :</label>
				  <input type="text"  name="item_product_name" placeholder="Item Name"  value="" class="form-control">
				</div>
			</div>
			<div class="col-md-12" style="display:none;">				
				<div class="form-group col-md-5">
				<label>Category :</label>
				<input type="text" name="category" placeholder="category" id="category1" class="form-control" readonly />
				</div>
			</div>
			<div class="col-md-12">	
<fieldset>
<legend>Stock Info</legend>			
				<div class="form-group col-md-4">
				  <label >HSN NO :</label>
				  <input type="text" name="item_hsn" placeholder="Add HSN"  value="" class="form-control">
				</div>
				<div class="form-group col-md-4">
				  <label>Opening Stock Price :</label>
				  <input type="text" name="item_opening_stock_value" placeholder="Add Opening Stock Price"  value="" class="form-control">
				</div>
				<div class="form-group col-md-4">
				  <label>Closeing Stock Price :</label>
				  <input type="text" name="item_closeing_stock_value" placeholder="Closeing Opening Stock Price"  value="" class="form-control">
				</div>
				</fieldset>
			</div>
<div class="col-md-12">	
<fieldset>
<legend>Product Purchase Info</legend>			
				<div class="form-group col-md-4">
				  <label >Quantity :</label>
				  <input type="text" name="item_hsn" placeholder="Add HSN"  value="" class="form-control">
				</div>
				<div class="form-group col-md-4">
				  <label>Purchase Price :</label>
				  <input type="text" name="item_closeing_stock_value" placeholder="Closeing Opening Stock Price"  value="" class="form-control">
				</div>
				<div class="form-group col-md-4">
				  <label>Total Price :</label>
				  <input type="text" name="item_closeing_stock_value" placeholder="Closeing Opening Stock Price"  value="" class="form-control">
				</div>
				</fieldset>
			</div>				
			<div class="col-md-12">	
<fieldset>
<legend>Product sale Info</legend>			
				<div class="form-group col-md-4">
				  <label >Quantity :</label>
				  <input type="text" name="item_hsn" placeholder="Add HSN"  value="" class="form-control">
				</div>
				<div class="form-group col-md-4">
				  <label>Mrp :</label>
				  <input type="text" name="item_opening_stock_value" placeholder="Add Opening Stock Price"  value="" class="form-control">
				</div>
				<div class="form-group col-md-4">
				  <label>Sales Price :</label>
				  <input type="text" name="item_closeing_stock_value" placeholder="Closeing Opening Stock Price"  value="" class="form-control">
				</div>
				</fieldset>
			</div>	
			<div class="col-md-12">	
<fieldset>
<legend>Product Tax Info</legend>			
				<div class="form-group col-md-4">
				  <label >Igst :</label>
				  <input type="text" name="item_hsn" placeholder="Add HSN"  value="" class="form-control">
				</div>
				<div class="form-group col-md-4">
				  <label>Cgst :</label>
				  <input type="text" name="item_opening_stock_value" placeholder="Add Opening Stock Price"  value="" class="form-control">
				</div>
				<div class="form-group col-md-4">
				  <label>Sgst:</label>
				  <input type="text" name="item_closeing_stock_value" placeholder="Closeing Opening Stock Price"  value="" class="form-control">
				</div>
				</fieldset>
			</div>	
            <div class="col-md-12">		
			
				<div class="form-group col-md-4">
				  <label>Brand Name :</label>
				  <input type="text"  name="item_brand" placeholder="Brand Name"  value="" class="form-control">
				</div>
			</div>
            <div class="col-md-12">				
				<div class="form-group col-md-5" style="display:none;">
				  <label>Manufacturer :</label>
				  <input type="text"  name="item_manufacturer" placeholder="Manufacturer"  value="" class="form-control">
				</div>
			</div>
			<div class="col-md-12">				
				<div class="form-group col-md-5" style="display:none;">
				  <label >Manufacturer's Part Number :</label>
				  <input type="text"  name="item_mpn" placeholder="Manufacturer's Part Number :"  value="" class="form-control">
				</div>
		    </div>			
			<div class="col-md-12">				
				<div class="form-group col-md-5" style="display:none;" >
				  <label >European Article Number :</label>
				  <input type="text"  name="item_ean" placeholder="European Article Number"  value="" class="form-control">
				</div>
		    </div>
			<div class="col-md-12">				
				<div class="form-group col-md-5" style="display:none;" >
				  <label >International Standard Book Number :</label>
				  <input type="text"  name="item_isbn" placeholder="Add ISBN"  value="" class="form-control">
				</div>
			</div>
			<div class="col-md-12 ">				
				<div class="form-group col-md-5" >
				  <label >Opening Stock :</label>
				  <input type="text"  name="item_opening_stock" placeholder="Add Opening Stock"  value="" class="form-control">
				</div>
			</div>				
			<div class="col-md-12 ">				
				<div class="form-group col-md-5" >
				  <label >Opening Stock Price :</label>
				  <input type="text"  name="item_opening_stock_value" placeholder="Add Opening Stock Price"  value="" class="form-control">
				</div>
			</div>
			<div class="col-md-12">							
				<div class="form-group col-md-2">
				  <label>Scan Item Part No :</label>
				  <input type="text"  name="barcode_no" id="barcode_no" placeholder="Scan Item Part No"  value="" class="form-control" required>
			    </div>						
				<div class="form-group col-md-3">
				  <label>Scan Item Serial No :</label>
				  <input type="text"  name="scan_item_serial_no" id="scan_item_serial_no" placeholder="Scan Item Serial No"  value="" class="form-control" required>
			    </div>
			
			</div>
	
			<div class="col-md-12">
				<div class="form-group col-md-2">
					<button type="button" style="margin-top:15px;" class="btn btn-default my_background_color" data-toggle="modal" data-target="#modal-default">
			         Get Part No</button>
		        </div>
				<div class="form-group col-md-3">
					<button type="button" style="margin-top:15px;" class="btn btn-default my_background_color" data-toggle="modal" data-target="#modal-default1">
			         Get Serial No</button>
		        </div>
			</div>	

			<div class="col-md-12">				
			    <div class="box-header with-border ">
				 <h1 class="box-title" style="color:red"><b>Sales Information</b>
				</div>
			</div>
			<div class="col-md-12">				
					<div class="form-group col-md-5" >
					  <label >Sale Price :</label>
					  <input type="number"  name="item_sale_price" placeholder="Add Sale Price"  value="" class="form-control">
					</div>
			</div>
              <div class="col-md-12">				
					<div class="form-group col-md-5" >
					  <label >Product MRP :</label>
					  <input type="number"  name="item_mrp_price" placeholder="Add Mrp Price"  value="" class="form-control">
					</div>
			</div>			
				<div class="col-md-12">				
					<div class="form-group col-md-5" >
					  <label >Description :</label>
					  <input type="text"  name="item_sale_discription" placeholder="Add Sale Description"  value="" class="form-control">
					</div>
				</div>
			<div class="col-md-12">				
			    <div class="box-header with-border ">
				  <h1 class="box-title" style="color:red"><b>Purchase Information</b>
				</div>
			</div>
			<div class="col-md-12">				
				<div class="form-group col-md-5" >
				  <label >Purchase Price :</label>
				  <input type="number" name="item_purchase_price" placeholder="Add Purchase Price"  value="" class="form-control">
				</div>
			</div>
			<div class="col-md-12">				
				<div class="form-group col-md-5" >
				  <label >Description :</label>
				  <input type="text"  name="item_purchase_discription" placeholder="Add Purchase Description"  value="" class="form-control">
				</div>
			</div>
			<div class="col-md-12" id="taxable_div" style="display:none">			
			   <div class="box-header with-border">
               <h1 class="box-title" style="color:red;"><b>Tax Rates</b>
               </div>
			   <div class="col-md-12">				
					<div class="form-group col-md-2" name="item_intra_state_tax_type">
					    <label>CGST&SGST :</label>
						<select class="form-control" name="item_intra_state_tax_type">
						<option value="CGST&SGST">CGST&SGST</option>
						</select>
						</div>
						<div class="col-md-2">
						<div class="form-group">
					    <label>CGST&SGST. (%) :</label>
						 <select class="form-control" name="item_intra_state_tax_precentage" id="item_intra_state_tax_precentage">
							  <option value="0">0</option>
							  <option value="0.125">0.125</option>
							  <option value="1.5">1.5</option>
							  <option value="2.5">2.5</option>
							  <option value="5">5</option>
							  <option value="6">6</option>
							  <option value="9">9</option>
							  <option value="12">12</option>
							  <option value="14">14</option>
							  <option value="16">16</option>
							  <option value="18">18</option>
							  <option value="20">20</option>
							  <option value="24">24</option>
							  <option value="28">28</option>
					  </select>
					</div>
					</div>
				</div>
			   <div class="col-md-12 ">				
					<div class="form-group col-md-2">
					    <label >IGST :</label>
					    <select class="form-control">
						<option value="IGST">IGST</option>
					    </select>
						</div>
						<div class="form-group col-md-2">
						<label >IGST (%) :</label>
						<select class="form-control" name="item_intra_state_tax_precentage" id="item_intra_state_tax_precentage">
							  <option value="0">0</option>
							  <option value="0.125">0.125</option>
							  <option value="1.5">1.5</option>
							  <option value="2.5">2.5</option>
							  <option value="5">5</option>
							  <option value="6">6</option>
							  <option value="9">9</option>
							  <option value="12">12</option>
							  <option value="14">14</option>
							  <option value="16">16</option>
							  <option value="18">18</option>
							  <option value="20">20</option>
							  <option value="24">24</option>
							  <option value="28">28</option>
					  </select>
					 
					</div>
				</div>
			 </div>
			<div class="col-md-12">		    
				<center><input type="submit" name="finish" value="Save Item" class="btn  my_background_color" />		
			</div>	
	</form>	
	
<!---------------------------------------------Get Part No Start----------------------------------------->

				<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header my_background_color">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Scan Item Part No</h4>
				</div>
				<div class="modal-body"> 
				<div class="form-group" >
				<label>Scan Item Part No. :</label>
				<input type="text"  name="barcode_no" id="barcode_no1" placeholder="Scan Item Part No." autofocus  onkeypress="return searchKeyPress(event);" value="" class="form-control">
				</div>
				</div>
				<div class="modal-footer ">
				<button type="button" class="btn btn-primary my_background_color" id="popup_click" onclick="get_barcode();" data-dismiss="modal">Done</button>
				</div>
				</div>
				</div>
				</div>
<!---------------------------------------------Get Part No End---------------------------------------->

<!---------------------------------------------Get Serial No Start----------------------------------------->

				<div class="modal fade" id="modal-default1">
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header my_background_color">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Scan Item Serial No</h4>
				</div>
				<div class="modal-body"> 
				<div class="form-group" >
				<label>Scan Item Serial No. :</label>
				<input type="text" name="scan_item_serial_no" id="scan_item_serial_no1" placeholder="Scan Item Serial No" autofocus  onkeypress="return searchKeyPress1(event);" value="" class="form-control">

				</div>
				</div>
				<div class="modal-footer ">
				<button type="button" class="btn btn-primary my_background_color" id="popup_click1" onclick="get_serial_no_barcode();" data-dismiss="modal">Done</button>
				</div>
				</div>
				</div>
				</div>
<!---------------------------------------------Get Serial No End---------------------------------------->
<?php
if(isset($_POST['finish'])){
	$item_product_type = $_POST['item_product_type'];
	$item_product_name = $_POST['item_product_name'];
	$item_hsn = $_POST['item_hsn'];
	$item_uom = $_POST['item_uom'];
	$item_tax_preferences = $_POST['item_tax_preferences'];
	$item_group = $_POST['item_group'];
	$item_sub_group = $_POST['item_sub_group'];
	$category = $_POST['category'];
	$item_manufacturer = $_POST['item_manufacturer'];
	$item_brand = $_POST['item_brand'];
	$item_upc = $_POST['item_upc'];
	$item_mpn = $_POST['item_mpn'];
	$item_ean = $_POST['item_ean'];
	$item_isbn = $_POST['item_isbn'];
	$item_sale_price = $_POST['item_sale_price'];
	$item_mrp_price = $_POST['item_mrp_price'];
	$item_sale_discription = $_POST['item_sale_discription'];
	$item_purchase_price = $_POST['item_purchase_price'];
	$item_purchase_discription = $_POST['item_purchase_discription'];
	$item_intra_state_tax_type = $_POST['item_intra_state_tax_type'];
	$item_intra_state_tax_precentage = $_POST['item_intra_state_tax_precentage'];
	$item_inter_state_tax_type = $_POST['item_inter_state_tax_type'];
	$item_inter_state_tax_precentage = $_POST['item_inter_state_tax_precentage'];
	$item_opening_stock = $_POST['item_opening_stock'];
	$item_opening_stock_value = $_POST['item_opening_stock_value'];
	$barcode_no = $_POST['barcode_no'];
	$scan_item_serial_no = $_POST['scan_item_serial_no'];
    if($item_product_type == 'Product'){
		$table_name = "item_master"; }
	else{ $table_name ="service_master"; }
    $quer="insert into $table_name(item_product_type,item_product_name,item_hsn,item_uom,item_tax_preferences,item_group,item_sub_group,item_manufacturer,item_brand,item_upc,item_mpn,item_ean,item_isbn,item_sale_price,item_mrp_price,item_sale_discription,item_purchase_price,item_purchase_discription,item_intra_state_tax_type,item_intra_state_tax_precentage,item_inter_state_tax_type,item_inter_state_tax_precentage,item_quantity,item_opening_stock,item_opening_stock_value,barcode_no,scan_item_serial_no,category)values('$item_product_type','$item_product_name','$item_hsn','$item_uom','$item_tax_preferences','$item_group','$item_sub_group','$item_manufacturer','$item_brand','$item_upc','$item_mpn','$item_ean','$item_isbn','$item_sale_price','$item_mrp_price','$item_sale_discription','$item_purchase_price','$item_purchase_discription','$item_intra_state_tax_type','$item_intra_state_tax_precentage','$item_inter_state_tax_type','$item_inter_state_tax_precentage','$item_opening_stock','$item_opening_stock','$item_opening_stock_value','$barcode_no','$scan_item_serial_no','$category')";
 
 if(mysql_query($quer)){
    echo "<script>alert('Item Successfully Added');</script>";
	echo "<script>window.open('item_list.php','_self');</script>";
}

 }

?>	

<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          
		  
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>
</body>
</html>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>