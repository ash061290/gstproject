<?php include("../../attachment/session.php"); ?>
<script>
$("#my_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);
         
        $.ajax({
            url: software_link+"inventory/items_edit_api.php",
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
           post_content('inventory/item_list',res[2]);
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
    url:software_link+"inventory/ajax_item_category.php",
    data:"brand_name="+value,
    success:function(detail)
    {
      $("#category_names").html(detail);
    }
  }) 
 }

function subcategory_select(value)
 {
  $.ajax({
    type:"POST",
    url: software_link+"inventory/ajax_item_subcategory.php",
    data:"category_name="+value,
    success:function(detail){
      $("#subcategory_names").html(detail);
    }
  })
 }
 
 function item_total(value)
 {
	 var purchase_price = $("#purchase_price").val();
	  var total_price = (parseFloat(purchase_price)*parseFloat(value));
	   document.getElementById("total_purchase_price").value = total_price;
 }

 function sales_total_amount(value)
 {
	  var sales_price = $("#item_sales_price").val();
	  var total_price = (parseFloat(sales_price)*parseFloat(value));
	   document.getElementById("total_sales_amount").value = total_price;
 }

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript"> 
 function change_gst(value)
 {
   document.getElementById("SGST").value = parseFloat(value);
   var igst = parseFloat(value) + parseFloat(value);
   document.getElementById("IGST").value = parseFloat(igst);   
 }

</script>
<body class="hold-transition skin-green sidebar-mini">
	<?php
	$s_no=$_GET['id'];
	$que="select * from item where s_no='$s_no'";
	$run=mysql_query($que);
	$serial_no=0;
	while($row=mysql_fetch_array($run)){
		$s_no = $row['s_no'];
		$company_code                   = $row['company_code'];
		$date                           = date('d-m-Y');
		$brand_name                     = $row['item_brand'];
		$category_name                  = $row['item_category'];
		$subcategory_name               = $row['item_subcategory'];
	    $model_no                       = $row['item_product_name'];
		$item_product_attribute         = $row['item_attribute'];
		$item_product_hsn_no            = $row['item_hsn_no'];
		$item_purchase_purchase_price   = $row['item_purchase_price'];
		$item_purchase_purchase_mrp     = $row['item_purchase_mrp'];
	$item_purchase_discount         = $row['item_purchase_discount'];
	$item_purcahse_quantity         = $row['item_purchase_quantity'];
 $item_purchase_total_amount     = $row['item_purchase_total_amount'];
	$item_purchase_description      = $row['item_purchase_description'];
	$item_sales_sales_price         = $row['item_sales_price'];
	$item_sales_purchase_mrp        = $row['item_sales_mrp'];
		$item_sales_discount            = $row['item_sales_discount'];
		$item_sales_quantity            = $row['item_sales_quantity'];
	$item_sales_total_amount        = $row['item_sales_total_amount'];
	$item_sales_description         = $row['item_sales_description'];
		$item_tax_cgst                  = $row['item_tax_cgst'];
		$item_tax_sgst                  = $row['item_tax_sgst'];
		$item_tax_igst                  = $row['item_tax_igst'];
	}
	?>

    <section class="content-header">
      <h1>
       Edit Item
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="item_list.php"><i class="fa fa-list"></i>Inventory List</a></li>
        <li class="active">Edit Item</li>
      </ol>
    </section>		
	
   <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	   <div class="col-xs-12">
          <div class="box my_border_top">
            <div class="box-header with-border ">
            </div>
     
    <div class="box-body">
    <form role="form" id="my_form" onsubmit="return validate();" enctype="multipart/form-data">
			<!--<div class="col-md-12">				
			    <div class="form-group col-md-6">
				<label>Item Type:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					
				<input type="radio" name="item_product_type" id="" value="Product" checked>&nbsp;&nbsp;<b>Product</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="item_product_type" id="" value="Service">&nbsp;&nbsp;<b>Service</b>
				</div>
			</div>-->
			<input type="hidden" name="s_no" value="<?php echo $s_no;?>">
			<input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
        <div class="row">
		<div class="col-md-12">

			<div  class="col-md-4">		
				<div class="row form-group">
					<div class="col-sm-12">
						<label>Brand:</label>
						     <select class="form-control select2" name="brand_name" style="width:100%" onchange="category_select(this.value)" required="true">
								<option value="<?php echo $brand_name;?>"><?php echo $brand_name;?></option>					  
									<?php
									$que="select * from brand_add where company_code='$company_code'";
										$run=mysql_query($que) or die(mysql_error());
									    while($row=mysql_fetch_array($run)){
											  $brand_name = $row['brand_name'];
											  ?>
								<option value="<?php echo $brand_name; ?>" ><?php echo $brand_name; ?>
								</option>
									        <?php } ?>
							 </select>
					</div>
				</div>
			</div>


			<!--<div class="form-group col-md-4">
			  <label>Tax Preferences:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				<input type="radio" name="item_tax_preferences" id="" onclick="tax_preference(this.value);" value="Taxable" checked>&nbsp;&nbsp;<b>Taxable</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="item_tax_preferences" id="" onclick="tax_preference(this.value);" value="Non-Taxable">&nbsp;&nbsp;<b>Non-Taxable</b>
				
			</div>-->
			 <div class="col-md-4">	
						<div class=" row form-group">
							<div class="col-sm-12">	
						       <label>Category :</label>
						          <div>
						             <select name="category_name" class="form-control select2" width="100%" onchange="subcategory_select(this.value)" id="category_names" >
						             	<option value="<?php echo $category_name;?>"><?php echo $category_name;?></option>
                                     </select>
						             <!--<input type="text"  name="item_category" placeholder="category"  value="" class="form-control">-->
						          </div>
							</div>
						</div>
			</div>

			<div class="form-group col-md-4">
		          <div class="row form-group">
					    	<div class="col-sm-12">
								<label>Subcategory:</label>
								  <div >
								  		<select class="form-control" name="subcategory_name" id="subcategory_names">
								  			<option value="<?php echo $subcategory_name;?>"><?php echo $subcategory_name;?></option>
			                        </select>
							      </div>
							</div>
						</div>				
			</div>
		</div>
	<div class="col-md-12">
            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Product/Model No:</label>
						     <div>
						        <input type="text"  name="model_no" placeholder="Product/Model Number" value="<?php echo $model_no;?>" class="form-control">
						    </div>
					    </div>	
					</div>
			    </div>




			<div class="form-group col-md-4">
		            <div class="row form-group">
					    <div class="col-sm-12">
							<label >Product Attribute :</label>
							    <div >
								    <select class="form-control select2" value="<?php $item_product_attribute;?>" name="item_product_attribute" style="width:100%">
										<option value="<?php echo $item_product_attribute;?>"><?php echo $item_product_attribute;?></option>					  
										    <?php
											 $que="select * from product_attribute_add where company_code='$company_code'";
											 $run=mysql_query($que) or die(mysql_error());
											 while($row=mysql_fetch_array($run)){
											 $product_attribute_name = $row['product_attribute_name'];
											 ?>
											 <option value="<?php echo $product_attribute_name; ?>" ><?php echo $product_attribute_name; ?>
										</option>
									         <?php } ?>
									</select>
								</div>
						</div>
					</div>  				
			</div>

				<div class="form-group col-md-4">
		          <div class="row form-group">
					    	<div class="col-sm-12">
							   <label>Product HSN No :</label>
							   	<div> 
						            <input type="text"  name="item_product" placeholder="Product HSN No" value="<?php echo $item_product_hsn_no; ?>" class="form-control">
						        </div>
							</div>
						</div>  				
					</div>
						
			<!-----
				
			--------->

		</div>
			<!---
			<div class="col-md-12">
				
			----->
	

			<div class="col-md-12">				
			    <div class="box-header with-border ">
				  <h1 class="box-title" style="color:red"><b>Purchase Information</b>
				</div>
				
				        <div class="row form-group col-md-4">
							<div class="col-sm-12">
							        <label>Purchase Price :</label> 
							        <div>
							            <input type="number"  name="item_purchase" placeholder="Add Purchase Price" id="purchase_price" value="<?php echo $item_purchase_purchase_price;?>" class="form-control">
							        </div>
						    </div>
						</div>
						<div class="row form-group col-md-4">
							<div class="col-sm-12">
							        <label>Purchase Mrp :</label> 
							        <div>
							            <input type="number" placeholder="Add Purchase Mrp" id="purchase_mrp" name="item_purchase_purchase_mrp" value="<?php echo $item_purchase_purchase_mrp;?>" class="form-control">
							        </div>
						    </div>
						</div>
						<div class="row form-group col-md-4">
							<div class="col-sm-12">
							        <label> Discount :</label> 
							        <div>
							            <input type="number"  name="item_purchase_discount" placeholder="Purchase Total Discount"  name="item_purchase_discount" value="<?php echo $item_purchase_discount;?>" class="form-control">
							        </div>
						    </div>
						
				 </div>
			</div>
			<div class="col-md-12">

				<div class="row form-group col-md-4">
			        <div class="form-group">
						<div class="col-sm-12">
						    <label>Purchase Quantity:</label>
								<div>
									<input type="number" value="<?php echo $item_purcahse_quantity?>" name="item_purchase_quantity" onkeyup="item_total(this.value)" class="form-control" placeholder="Purchase Quantity" />
								</div>
						</div>
					</div>  				
				</div>
				 <div class="row form-group col-md-4">
							<div class="col-sm-12">
							        <label> Total Purchase Amount :</label> 
							        <div>
							            <input type="number" placeholder="Total Purchase Amount" value="<?php echo $item_purchase_total_amount;?>" name="item_purchase_total_amount" id="total_purchase_price" class="form-control" readonly>
							        </div>
						    </div>
						
				 </div>
				 <div class="row form-group col-md-4">
							<div class="col-sm-12">
								<div>
							        <label>Description :</label>
							    </div>
								    <div>
								        <input type="text"  name="item_description" value="<?php echo $item_purchase_description;?>" placeholder="Add Purchase Description" class="form-control">
								    </div>
							</div>
				</div>
			</div>

			<div class="col-md-12">				
			    <div class="box-header with-border ">
				  <h1 class="box-title" style="color:red"><b>Sales Information</b>
				</div>
				
				<div class="row form-group col-md-4">
							<div class="col-sm-12">
							        <label>Sales Price :</label> 
							        <div>
							            <input type="number"  name="item_sales_sales_price" placeholder="Add Sales Price" id="item_sales_price" value="<?php echo $item_sales_sales_price; ?>" class="form-control">
							        </div>
						    </div>
						</div>
						<div class="row form-group col-md-4">
							<div class="col-sm-12">
							        <label>Purchase Mrp :</label> 
							        <div>
							            <input type="number"  name="item_sales_purchase_mrp" id="item_sales_mrp" placeholder="Add Sales Mrp"  value="<?php echo $item_sales_purchase_mrp;?>" class="form-control">
							        </div>
						    </div>
						</div>
						<div class="row form-group col-md-4">
							<div class="col-sm-12">
							        <label> Discount :</label> 
							        <div>
							            <input type="number"  name="item_sales_discount" placeholder="Sales Total Discount"  value="<?php echo $item_sales_discount?>" class="form-control">
							        </div>
						    </div>
						
				 </div>
			</div>
			<div class="col-md-12">
				<div class="row form-group col-md-4">
			        <div class="form-group">
						<div class="col-sm-12">
						    <label>Sales Quantity:</label>
								<div>
									<input type="number" name="item_sales_quantity" class="form-control" id="item_sales_quantity" onkeyup="sales_total_amount(this.value)" value="<?php echo $item_sales_quantity?>" placeholder="Sales Quantity" />
								</div>
						</div>
					</div>  				
				</div>

				 <div class="row form-group col-md-4">
							<div class="col-sm-12">
							        <label> Total Sales Amount :</label> 
							        <div>
							            <input type="number"  name="item_sales_total_amount" placeholder="Total Sales Amount" id="total_sales_amount" value="<?php echo $item_sales_total_amount;?>" class="form-control" readonly>
							        </div>
						    </div>
						
				 </div>
				 <div class="row form-group col-md-4">
							<div class="col-sm-12">
								<div>
							        <label>Description :</label>
							    </div>
								    <div>
								        <input type="text"  name="item_sales_description" placeholder="Add Sales Description" value="<?php echo $item_sales_description; ?>" class="form-control">
								    </div>
							</div>
						</div>
			</div>
			

			
			
			<div class="col-md-12">				
				    <div class="box-header with-border ">
					 <h1 class="box-title" style="color:red"><b>Tax Rates</b>
					</div>
					 <div class="row form-group col-md-4">
								<div class="col-sm-12">
									<div name="item_intra_state_tax_type">
								       <label>CGST:</label>
								    </div>
								    <div>
										<select class="form-control" name="item_tax_cgst" id="item_intra_state_tax_precentage">
											      <option value="<?php echo $item_tax_cgst;?>"><?php echo $item_tax_cgst;?></option>
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
							<div class="row form-group col-md-4">
								<div class="col-sm-12">
									<div name="item_intra_state_tax_type">
								       <label>SGST:</label>
								    </div>
								    <div>
										<select class="form-control" name="item_tax_sgst" id="item_intra_state_tax_precentage">
											      <option value="<?php echo $item_tax_sgst;?>"><?php echo $item_tax_sgst;?></option>
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
							<div class="row form-group col-md-4">
								<div class="col-sm-12">
									<div name="item_intra_state_tax_type">
								       <label>IGST:</label>
								    </div>
								    <div>
										<select class="form-control" name="item_tax_igst" id="item_inter_state_tax_precentage">
											      <option value="<?php echo $item_tax_igst;?>"><?php echo $item_tax_igst;?></option>
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
							<center><input type="submit" name="finish" value="Update Item" class="btn btn-success" />		
						</div>
					
			  </form>	

</section>

 <?php include("link_js.php")?>
</body>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>