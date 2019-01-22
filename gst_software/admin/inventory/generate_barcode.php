<?php include("../../attachment/session.php"); ?>
<script>
function myFunction() {
    window.print();
}
</script>

<script>
$("#my_form").submit(function(e){
           
        e.preventDefault();

    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"inventory/generate_barcode_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
      
            processData: false,
            success: function(detail){
              $("#form_div").hide();
              $("#barcode_div").html(detail);
              $("#print_div").html(detail);
          
      }
         });
      });
</script>
<?php
        $s_no=$_GET['id'];
        $que="select * from item where item_status='Active' and company_code='$company_code' and s_no='$s_no'";
        $run=mysql_query($que) or die(mysql_error());
        $serial_no=0;
        while($row=mysql_fetch_array($run))
        {

          $s_no = $row['s_no'];
          $brand_name=$row['item_brand'];
          $category = $row['item_category'];
          $subcategory = $row['item_subcategory'];
          $model_no = $row['item_product_name'];
          $product_attribute=$row['item_attribute'];
          $quantity=$row['item_sales_quantity'];
        }
?>
    <section class="content-header">
      <h1>
       Generate Barcode
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="javascript:get_content('inventory/item_details')"><i class="fa fa-list"></i>Product Details</a></li>
        <li class="active">Generate Barcode</li>
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
    <form role="form" id="my_form" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="item_id" value="<?php echo $s_no;?>">	
        
        <div class="row">
		<div class="col-md-12">
            <input type="hidden" name="id">
			<div  class="col-md-4">		
				<div class="row form-group">
					<div class="col-sm-12">
						<label>Brand:</label>
						     <input type="text" name="brand" value="<?php echo $brand_name;?>" class="form-control" readonly>
					</div>
				</div>
			</div>

			 <div class="col-md-4">	
				<div class=" row form-group">
					<div class="col-sm-12">	
						<label>Category :</label>
						    <div>
						        <input type="text" name="category" value="<?php echo $category;?>" class="form-control" readonly>
						    </div>
					</div>
				</div>
			</div>

			<div class="form-group col-md-4">
		        <div class="row form-group">
					<div class="col-sm-12">
						<label>Subcategory:</label>
						<div >
						    <input type="text" name="subcategory" value="<?php echo $subcategory;?>" class="form-control" readonly>
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
						   	<input type="text" name="model" value="<?php echo $model_no;?>" class="form-control" readonly>
						   </div>
					</div>	
				</div>
			</div>




			<div class="form-group col-md-4">
		            <div class="row form-group">
					    <div class="col-sm-12">
							<label >Product Attribute :</label>
							    <div >
							    	<input type="text" name="product_attribute" value="<?php echo $product_attribute; ?>" class="form-control" readonly>
								</div>
						</div>
					</div>  				
			</div>

				<div class="form-group col-md-4">
		            <div class="row form-group">
					    <div class="col-sm-12">
							<label>Barcode string:</label>
							   	<div> 
						            <input type="text" name="string" placeholder="Barcode string" value="<?php echo @$_POST['string'];?>" class="form-control">
						        </div>
						</div>
					</div>  				
				</div>
		</div>
		
<div class="col-md-12">
            <div class="col-md-4">
			    <div class="row form-group">
					<div class="col-sm-12">
						<label>Code Type:</label>
						    <div> 
								<select name="type" id="type" class="form-control">
		                            <option value="codabar" <?php (@$_POST['type'] == 'codabar' ? print 'selected="selected"' : '') ?>>Codabar</option>
		                            <option value="code128" <?php (@$_POST['type'] == 'code128' ? print 'selected="selected"' : '') ?>>Code128</option>
		                            <option value="code2of5" <?php (@$_POST['type'] == 'code2of5' ? print 'selected="selected"' : '') ?>>Code2of5</option>
		                            <option value="code39" <?php (@$_POST['type'] == 'code39' ? print 'selected="selected"' : '') ?>>Code39</option>
		                        </select> 
						    </div>
					    </div>	
					</div>
			    </div>




			<div class="form-group col-md-4">
		            <div class="row form-group">
					    <div class="col-sm-12">
							<label >Orientation:</label>
							    <div >
								    <select name="orientation" class="form-control" required>
			                            <option value="horizontal" <?php (@$_POST['orientation'] == 'horizontal' ? print 'selected="selected"' : '') ?>>Horizontal</option>
			                            <option value="vertical" <?php (@$_POST['orientation'] == 'vertical' ? print 'selected="selected"' : '') ?>>Vertical</option>
			                        </select>
								</div>
						</div>
					</div>  				
			</div>

				<div class="form-group col-md-4">
		            <div class="row form-group">
					    <div class="col-sm-12">
							<label>Size:</label>
							   	<div> 
						            <input type="number"  name="size" id="size" placeholder="Barcode width"  class="form-control" min="10" max="400" step="10" value="<?php (@$_POST['size'] != '' ? print @$_POST['size'] : print '20') ?>" required>
						        </div>
						</div>
					</div>  				
				</div>

		</div>


<div class="col-md-12">
           
			<div class="form-group col-md-4">
		            <div class="row form-group">
					    <div class="col-sm-12">
							<label >Print:</label>
							    <div >
								    <select name="print" id="print" class="form-control" required>
			                            <option value="true" selected="selected">True</option>
			                            <option value="false">False</option>
			                        </select>
								</div>
						</div>
					</div>  				
			</div>

				<div class="form-group col-md-4">
		            <div class="row form-group">
					    <div class="col-sm-12">
							<label>Quantity:</label>
							   	<div> 
						            <input type="number"  name="quantity" placeholder="Number of Barcode to be print" class="form-control" value="<?php echo $quantity;?>" id="size_number" required readonly>
						        </div>
						</div>
					</div>  				
				</div>

		</div>        		
		<div class="col-md-12">	    
			<center><input type="submit" id="" name="submit" value="Generate Barcode" class="btn btn-success" /></center>		
		</div>
			</div>		
    </form>
  </div>




  <div class="col-md-12" id="barcode_div"></div>
  <div class="col-md-6"><a style="color:#94450A;" aria-hidden="true" class="fa fa-print" onclick="myFunction()">Print</a></div>
 
 </div>
 </div>
 </div>
</div>
</section>    
