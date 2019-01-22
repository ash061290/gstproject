<?php include("../../attachment/session.php"); ?>
<script>
$("#my_form").submit(function(e){   
        e.preventDefault();
    var formdata = new FormData(this);
         
        $.ajax({
            url: software_link+"inventory/items_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
           
            processData: false,
            success: function(detail){
            $("#exiting").html(detail);
            //alert(detail);
            var res=detail.split("|?|");
            if(res[1]=='success'){
           alert('Successfully Complete');
           post_content('inventory/items',res[2]);
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
    success:function(detail){
      $("#category_names").html(detail);
    }
  }) 
 }

function subcategory_select(value)
 {
 	var brand = document.getElementById("brand").value;
  $.ajax({
    type:"POST",
    url: software_link+"inventory/ajax_item_subcategory.php",
    data:"category_name="+value+"&brand="+brand+"",
    success:function(detail){

      $("#subcategory_names").html(detail);
    }
  })
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


<script> 
 function change_gst(value)
 {
   document.getElementById("SGST").value = parseFloat(value);
   var igst = parseFloat(value) + parseFloat(value);
   document.getElementById("IGST").value = parseFloat(igst);   
 }

</script>

    <section class="content-header">
      <h1>
       Add Item
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="javascript:get_content('inventory/item_list')"><i class="fa fa-list"></i>Inventory List</a></li>
        <li class="active">Add Item</li>
      </ol>
    </section>		
    <section class="content">
      <!-- Small boxes (Stat box) -->
	   <div class="col-xs-12">
        <div class="box my_border_top">
    <div class="box-body">
    <form role="form" method="post" id="my_form">
			<input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code" />
		<div class="col-md-12">
			<div  class="col-md-4">		
				<div class="form-group">
						<label>Brand:</label>
						     <select class="form-control select2" id="brand" name="brand_name" style="width:100%" onchange="category_select(this.value)" required="true">
								<option value="">Select Brand</option>					  
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


			
			 <div class="col-md-4">	
						<div class="form-group">
							
						       <label>Category :</label>
						          <div>
						             <select name="category_name" class="form-control select2" width="100%" onchange="subcategory_select(this.value)" id="category_names" required>
						             	
                                     </select>
						             <!--<input type="text"  name="item_category" placeholder="category"  value="" class="form-control">-->
						          </div>
							
						</div>
			</div>

			<div class="form-group col-md-4">
		          <div class="form-group">
					    	
								<label>Subcategory:</label>
								  <div >
								  		<select class="form-control select2" name="subcategory_name" id="subcategory_names" width="100%" required>
			                        </select>
							      </div>
						
						</div>				
			</div>
		</div>
	<div class="col-md-12">
            <div class="col-md-4">
			    <div class="form-group">
					
						<label>Product Name:</label>
						    <input type="text"  name="model_no" placeholder="Product/Model Name" class="form-control" required>
					
				</div>	
			</div>
			    

			<div class="form-group col-md-4">
		            <div class="form-group">
					   
							<label >Product Attribute :</label>
							    <div >
								    <select class="form-control select2" name="item_product_attribute" style="width:100%" required>
										<option value="">Select</option>					  
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

				<div class="form-group col-md-4">
		          <div class="form-group">
					    	
							   <label>Product HSN No :</label>
							   	<div> 
						            <input type="text"  name="item_product" placeholder="Product HSN No" value="" class="form-control">
						        </div>
						
						</div>  				
					</div>
		</div>
		<div class="col-md-12">		
		<div class="form-group col-md-4">
			        <div class="form-group">
						
						    <label>Purchase Quantity:</label>
								<div>
									<input type="number" name="item_purchase_quantity" class="form-control" onkeyup="item_total(this.value)" placeholder="Purchase Quantity" />
								</div>
			
					</div>  				
				</div>
				 <div class="form-group col-md-4">
							<div class="col-sm-12">
								<div>
							        <label>Description :</label>
							    </div>
								    <div>
									<textarea class="form-control" name="item_sales_description" cols="3" rows="3" style="resize:none;"></textarea>
								 
								    </div>
							</div>
						</div>
				</div>
						
			    <div class="box-header with-border">
				  <h1 class="box-title" style="color:red"><b>Purchase Information</b></h1>
				</div>
				<div class="col-md-12">	
				        <div class="form-group col-md-3">
							
							        <label>Purchase Price :</label> 
							        <div>
							            <input type="number"  name="item_purchase" id="purchase_price" placeholder="Add Purchase Price" class="form-control">
							        </div>
						    
						</div>
						<div class=" form-group col-md-3">
							
							      <label>Purchase Mrp :</label> 
							        <div>
							            <input type="number" placeholder="Add Purchase Mrp" id="purchase_mrp" name="item_purchase_purchase_mrp" class="form-control">
							        </div>
						   
						</div>
						<div class=" form-group col-md-3">
							
							        <label>Purchase Discount :</label> 
							        <div>
							            <input type="number"  name="item_purchase_discount" placeholder="Purchase Total Discount"  name="item_purchase_discount" class="form-control">
							        </div>
						    
						
				 </div>
				 <div class="form-group col-md-3">
							        <label> Total Purchase Amount :</label> 
							        <div>
							            <input type="number" placeholder="Total Purchase Amount" id="total_purchase_price" name="item_purchase_total_amount" class="form-control" readonly>
							        </div>
						
				 </div>
			</div>
			<div class="col-md-12">				
			    <div class="box-header with-border ">
				  <h1 class="box-title" style="color:red"><b>Sales Information</b></h1>
				</div>
				
				<div class="form-group col-md-3">
							
							        <label>Sales Price :</label> 
							        <div>
							            <input type="number"  name="item_sales_sales_price" id="item_sales_price" placeholder="Add Sales Price"  value="" class="form-control">
							        </div>
						   
						</div>
						<div class="form-group col-md-3">
							
							        <label>Purchase Mrp :</label> 
							        <div>
							            <input type="number"  name="item_sales_purchase_mrp" placeholder="Add Sales Mrp" id="item_sales_mrp" value="" class="form-control">
							        </div>
						   
						</div>
						<div class="form-group col-md-3">
							
							        <label>Sales Discount :</label> 
							        <div>
							            <input type="number"  name="item_sales_discount" placeholder="Sales Total Discount"  value="" class="form-control">
							        </div>
						    
						
				 </div>
				 <div class="form-group col-md-3">
							
							        <label> Total Sales Amount :</label> 
							        <div>
							            <input type="number"  name="item_sales_total_amount" placeholder="Total Sales Amount" id="total_sales_amount" class="form-control" readonly>
							        </div>
				 </div>
			</div>
		  
			<div class="col-md-12">				
				    <div class="box-header with-border ">
					 <h1 class="box-title" style="color:red">
			  <label>Tax Preferences:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				<input type="radio" name="item_tax_preferences" id="" onclick="tax_preference(this.value);" value="Taxable" checked>&nbsp;&nbsp;<b style="color:#333;">Taxable</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="item_tax_preferences" id="" onclick="tax_preference(this.value);" value="Non-Taxable">&nbsp;&nbsp;<b style="color:#333;">Non-Taxable</b>
				</h1>
					</div>
					 <div class="row form-group col-md-4">
								<div class="col-sm-12">
									<div name="item_intra_state_tax_type">
								       <label>CGST:</label>
								    </div>
								    <div>
										<select class="form-control" name="item_tax_cgst" id="item_intra_state_tax_precentage">
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
				</div>
            		
						<div class="col-md-12">		    
							<center><input type="submit" name="finish" value="Save Item" class="btn btn-success" />		
						</div>
							
				</form>	
			    </div>
				</div>
				</div>
				
</section> 
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

  })
</script>