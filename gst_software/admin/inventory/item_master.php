<?php include("../../attachment/session.php"); ?>

<script>
$("#my_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"inventory/item_master_api.php",
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
           post_content('inventory/item_master',res[2]);
            }
      }
         });
      });
</script>
<script>
$("#my_brand").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"inventory/brand_add_api.php",
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
           post_content('inventory/item_master',res[2]);
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
 	var brand = document.getElementById("brand_").value;
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
      <div class="row">
	   <div class="col-xs-12">
          <div class="box my_border_top">
            <div class="box-header with-border ">
            </div>
     
    <div class="box-body">
    <form role="form" id="my_form" onsubmit="return validate();" enctype="multipart/form-data">
	
    		<input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
        <div class="row">
		<div class="col-md-12">

			<div  class="col-md-4">		
				<div class="row">
					<div class="col-sm-12">
						<label>Brand:</label>
						    <select class="form-control select2" name="brand_name" id="brand_" style="width:100%" onchange="category_select(this.value)" required="true">
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
							</select><button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-item-brand"><i class="fa fa-plus" aria-hidden="true"></i>
					  	</button>
					</div>
				</div>
			</div>
			

			 <div class="col-md-4">	
						<div class=" row form-group">
							<div class="col-sm-12">	
						       <label>Category :</label>
						          <div>
						             <select name="category_name" class="form-control select2" width="100%" onchange="subcategory_select(this.value)" id="category_names" required>
						             	
                                     </select>
                                     <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-item-category"><i class="fa fa-plus" aria-hidden="true"></i>
					  	</button>
						          </div>
							</div>
						</div>
			</div>

			<div class="form-group col-md-4">
		          <div class="row form-group">
					    	<div class="col-sm-12">
								<label>Subcategory:</label>
								  <div >
								  		<select class="form-control" name="subcategory_name" id="subcategory_names" onchange="model_no_select(this.value)" required>
			                        </select>
			                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-item-subcategory"><i class="fa fa-plus" aria-hidden="true"></i>
							      </div>
							</div>
						</div>				
			</div>
		</div>
	<div class="col-md-12">
            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Scan Barcode :</label>
						    <input type="text"  name="item_scan_barcode" placeholder="Scan Barcode" class="form-control" required>
					</div>
				</div>	
			</div>
			    

            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Product/Model No:</label>
						    <input type="text"  name="model_no" placeholder="Product/Model Number" class="form-control" required>
					</div>
				</div>	
			</div>

			<div class="form-group col-md-4">
		            <div class="row form-group">
					    <div class="col-sm-12">
							<label >UOM No :</label>
							    <div >
								    <select class="form-control select2" name="uom_no" style="width:100%" required>
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
			</div>
					
						
			<!-----
				
			--------->

		</div>

	<div class="col-md-12">
            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>HSN No:</label>
						    <input type="text"  name="hsn_no" placeholder="HSN No" class="form-control" required>
					</div>
				</div>	
			</div>
            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Item Code:</label>
						    <input type="text"  name="item_code" placeholder="Item Code" class="form-control" required>
					</div>
				</div>	
			</div>
			    

            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Serial No:</label>
						    <input type="text"  name="serial_no" placeholder="Serial No" class="form-control" required>
					</div>
				</div>	
			</div>
		
	</div>
	<div class="col-md-12">
			<div class="form-group col-md-4">
		        <div class="row form-group">
					<div class="col-sm-12">
					    <label>IMEI No :</label>
							<div> 
						        <input type="text"  name="imei_no" placeholder="IMEI No" value="" class="form-control">
						        </div>
					</div>
				</div>  				
			</div>

            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Opening Stock Quantity:</label>
						    <input type="text"  name="opening_stock_quantity" placeholder="Opening Stock Quantity" class="form-control" required>
					</div>
				</div>	
			</div>
			    

            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Opening Stock Price:</label>
						    <input type="text"  name="opening_stock_price" placeholder="Opening Stock Price" class="form-control" required>
					</div>
				</div>	
			</div>
	</div>

	<div class="col-md-12">
			<div class="form-group col-md-4">
		         <div class="row form-group">
					  <div class="col-sm-12">
							<label>Product MRP :</label>
							   <div> 
						           <input type="text"  name="product_mrp" placeholder="Product MRP" value="" class="form-control">
						       </div>
					  </div>
				  </div>  				
			</div>

            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Description:</label>
						    <input type="text"  name="description" placeholder="Description" class="form-control" required>
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

</div>
            		
						<div class="col-md-12">		    
							<center><input type="submit" name="finish" value="Save Item" class="btn btn-success" />	</center>	
						</div>
					
				</form>

</div>
</div>

</div>
</div>
</section>
<!---------------------------Brand add model--------------------------->
        <div class="modal fade" id="add-item-brand">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Brand</h4>
              </div>
              <div class="modal-body">
                
                 <form role="form" id="my_brand" enctype="multipart/form-data">
					<div class="box-body table-responsive">
		                <table id="table-data" class="table table-bordered table-striped">
		                    <thead class="my_background_color">
				                <tr>
				                   <th>Brand Name</th>
								   <th>Add Brand</th>
				                </tr>
		                    </thead>
						
							<tbody>
								<tr>
				                   <input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
								   <td><input class="form-control" type="text" name="brand_name" placeholder="Add Brand Name" required /></td>
								   <td><input type="submit" name="add_brand" value="Add Brand" class="btn btn-success" /></td>
				                  <tr class="text-danger" id="existing_data"></tr>
								</tr>					
							</tbody>
						
		                </table>
		            </div>
		        </form>

            </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<!---------------------------category add model--------------------------->
        <div class="modal fade" id="add-item-category">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Brand</h4>
              </div>
              <div class="modal-body">
             
                <form role="form" id="my_form" enctype="multipart/form-data">
						<div class="box-body table-responsive">
		                <table id="table-data" class="table table-bordered table-striped">
		                <thead class="my_background_color">
		                <tr>
		                  <th>Brand Name</th>
		                  <th>Category</th>
						          <th>Add Category</th>
		                </tr>
		                </thead>
						
						<tbody>
						<tr>
		          <input class="form-control" type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>

		          <td>
		          
		           <select name="brand_name" class="form-control select2" required>
		                
		          <option value=''>Select</option>
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
		  				<td>
		            <input class="form-control" type="text" name="category" placeholder="Add Category" required />
		          </td>
						<td><input type="submit" name="add_category" value="Add Category" class="btn btn-success" /></td>
						</tr>					
						</tbody>
						
		                </table>
		                </div>
		        </form>

            </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


<!---------------------------Subcategory add model--------------------------->
        <div class="modal fade" id="add-item-subcategory">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Brand</h4>
              </div>
              <div class="modal-body">
             
		      <form role="form" id="my_form" enctype="multipart/form-data">
		          <div class="box-body table-responsive">
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
			                      <select class="form-control" type="text" width="100%" name="category_name" placeholder="SubCategory" id="category_names" required>
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
		        </form>

            </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 
 <!----------------subcategory model script------------------------->
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>