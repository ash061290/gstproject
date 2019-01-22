<?php include("../../attachment/session.php"); ?>
<script type="text/javascript">
$("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"inventory/barcode_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
				alert(detail);
				$("#form_div").hide();
				$("#barcode_div").html(detail);
          
      }
         });
      });
	  
function category_select(value)
 {
  $.ajax({
    type:"POST",
    url: software_link+"inventory/ajax_item_category.php",
    data:"brand_name="+value,
    success:function(detail){
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

function model_no_select(value)
 {
  $.ajax({
    type:"POST",
    url: software_link+"inventory/ajax_item_model_no.php",
    data:"subcategory="+value,
    success:function(detail){
      $("#model_names").html(detail);
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

   function group_name(value){    
       $.ajax({
			  type: "POST",
              url: software_link+"inventory/ajax_sabgroup_name.php?id="+value+"",
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
              url: software_link+"inventory/ajax_category.php?id="+value+"",
              cache: false,
              success: function(detail){      
                  var str =detail;
		      var res = str.split("|?|");
		      $("#category1").val(res[1]);
              }
           });

    }
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
function change_gst(value)
 {
   document.getElementById("SGST").value = parseFloat(value);
   var igst = parseFloat(value) + parseFloat(value);
   document.getElementById("IGST").value = parseFloat(igst);   
 }
 function item_total(value)
 {
	 var purchase_price = $("#purchase_price").val();
	  var total_price = (parseFloat(purchase_price)*parseFloat(value));
	   document.getElementById("total_purchase_price").value = total_price;
 }
 function discount_check(value)
 {
	 var purchase_price = $("#purchase_price").val();
	 var purchase_mrp = $("#purchase_mrp").val();
	 if(parseFloat(value)>parseFloat(purchase_price))
	 {
		  alert('Invalid Discount');
		 document.getElementById("purchase_discount").value="";
		 return false;
	 }
 }
 function sales_total_amount(value)
 {
	  var sales_price = $("#item_sales_price").val();
	  var total_price = (parseFloat(sales_price)*parseFloat(value));
	   document.getElementById("total_sales_amount").value = total_price;
 }
 function sales_discount(value){
          var sales_price = $("#item_sales_price").val();
		  var sales_mrp = $("#item_sales_mrp").val();
		   if(parseFloat(value)>parseFloat(sales_price))
	 {
		  alert('Invalid Discount');
		 document.getElementById("item_sales_discount").value="";
		 return false;
	 }
 }
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
	<div id="form_div">
    <form role="form" id="my_form" onsubmit="return validate();" enctype="multipart/form-data">
			<input type="hidden" class="form-control" value="<?php echo $company_code; ?>" name="company_code"/>
        <div class="row">
		<div class="col-md-12">

			<div  class="col-md-4">		
				<div class="row form-group">
					<div class="col-sm-12">
						<label>Brand:</label>
						     <select class="form-control select2" name="brand_name" style="width:100%" onchange="category_select(this.value)" required="true">
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
			</div>
			 <div class="col-md-4">	
						<div class=" row form-group">
							<div class="col-sm-12">	
						       <label>Category :</label>
						          <div>
						             <select name="category_name" class="form-control select2" width="100%" onchange="subcategory_select(this.value)" id="category_names" required>
						             
                                     </select>
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
							      </div>
							</div>
						</div>				
			</div>
		</div>
	<div class="col-md-12">
            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Product/Model Name:</label>
						    <div> 
						    	<select class="form-control" name="model_no" placeholder="Product/Model Number" id="model_names" required>			                </select>
						    </div>
					    </div>	
					</div>
			    </div>
				
			<div class="form-group col-md-4">
                   <div class="row form-group">
					    	<div class="col-sm-12">
							   <label>Product HSN No :</label>
							   	<div> 
						            <input type="text"  name="product_hsn_no" id="product_hsn_no" placeholder="Product HSN No" value="" class="form-control" readonly>
						        </div>
							</div>
						</div> 
						</div>
		   <div class="form-group col-md-4">
                   <div class="row form-group">
					    	<div class="col-sm-12">
							   <label>Product Quantity :</label>
							   	<div> 
						            <input type="number"  name="product_quantity" id="product_quantity" placeholder="Product Quantity" value="" class="form-control" readonly>
						        </div>
							</div>
						</div> 
						</div>
		</div>
		<div class="col-md-12">
		   
						<div class="form-group col-md-4">
                   <div class="row form-group">
					    	<div class="col-sm-12">
							   <label>Barcode String :</label>
							   	<div> 
						         <input type="text"  name="barcode_string" id="barcode_string" placeholder="Barcode String" value="" class="form-control">
						        </div>
							</div>
						</div> 
						</div>
		                </div>
						<div class="col-md-12">		    
							<center><input type="submit" name="finish" value="Generate Barcode" class="btn btn-success" />		
						</div>
							</div>
							</div>
							</div>
							<div id="barcode_div"></div>
		            </div>
	            </div>    
					
				</form>				
</div>		
</section>

    
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>