<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="search_script.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("../attachment/link_css.php")?>
<script src="select2.min.css"></script>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">


  
  <?php include("../attachment/header.php")?>
  <?php include("../attachment/sidebar.php")?>

  
  <script type="text/javascript">

			var deleteRow = function (link) {

			var row = link.parentNode.parentNode;

			var table = row.parentNode; 

			table.removeChild(row); 

			}

			</script>
  
  <script>
  // this code is use for fetch the rowwise data -----START-----
   function item_desc(value,sno){
  var place_of_supply=document.getElementById('invoice_place_of_supply').value;
  $.ajax({
			address: "POST",
			url: software_link+"purchase/ajax_get_item_description.php?value="+value+"",
			cache: false,
			success: function(detail){
			var str =detail;                
			var res = detail.split("|?|");
			$("#desc_"+sno).show();
			$("#for_desc_"+sno).show();
			$("#hsn_"+sno).show();
			$("#abl_quantity_"+sno).show();
			$("#unit_"+sno).show();
			$("#for_abl_quantity_"+sno).show();
			$("#for_unit_"+sno).show();
			$("#for_cgst_"+sno).show();
			$("#for_sgst_"+sno).show();
			$("#for_igst_"+sno).show();
			$("#for_hsn_"+sno).show();
			$("#cgst_"+sno).show();
			$("#sgst_"+sno).show();
			$("#igst_"+sno).show();
			$("#desc_"+sno).val(res[1]);
			$("#hsn_"+sno).val(res[0]);
			
			$("#abl_quantity_"+sno).val(res[4]);
			$("#unit_"+sno).val('Per '+res[6]);
			$("#price_"+sno).val(res[5]);
			$("#price1_"+sno).val(res[5]);
			if(place_of_supply=='Delhi'){
			$("#tax_type_"+sno).val('CGST&SGST');
			$("#cgst_"+sno).val(res[2]);
			$("#sgst_"+sno).val(res[2]);
			$("#igst_"+sno).val('0');
			$("#igst_"+sno).prop("readonly", true);			
			}else{
			$("#tax_type_"+sno).val('IGST');
			$("#cgst_"+sno).val('0');
			$("#cgst_"+sno).prop("readonly", true);
			$("#sgst_"+sno).val('0');
			$("#sgst_"+sno).prop("readonly", true);
			$("#igst_"+sno).val(res[3]);
			}
			$("#cgst1_"+sno).val(res[2]);
			$("#sgst1_"+sno).val(res[2]);
			$("#igst1_"+sno).val(res[3]);
			$('#click_'+sno).click();
			$('#click_total').click();
			}
			});
  }
  // this code is use for fetch the rowwise data -----END-----
  
  // this code is use for rowwise total calculation -----START-----
  function for_total(sno){
  var quantity=document.getElementById('quantity_'+sno).value;
  var price=document.getElementById('price_'+sno).value;
  var discount=document.getElementById('discount_'+sno).value;
  
  var tax_type=document.getElementById('tax_type_'+sno).value;
  var cgst=document.getElementById('cgst_'+sno).value;
  var sgst=document.getElementById('sgst_'+sno).value;
  var igst=document.getElementById('igst_'+sno).value;
  
  if(quantity>0 && price>0){
  
  if(discount>0){
  
  var discount_type=document.getElementById('discount_type_'+sno).value;
  if(discount_type=='%'){
  var disc_amt=parseFloat(quantity)*parseFloat(price)*parseFloat(discount)/100;
  document.getElementById('taxable_'+sno).value=(parseFloat(quantity)*parseFloat(price)-parseFloat(disc_amt)).toFixed(2);
  
  if(tax_type=='CGST&SGST'){
  var for_tax=parseFloat(parseFloat(parseFloat(quantity)*parseFloat(price))-parseFloat(disc_amt))*parseFloat(parseFloat(cgst)+parseFloat(sgst));
  document.getElementById('tax_amount_'+sno).value=(for_tax/100).toFixed(2);
  document.getElementById('item_total_'+sno).value=(parseFloat(parseFloat(quantity)*parseFloat(price))-parseFloat(disc_amt)+parseFloat(parseFloat(for_tax)/100)).toFixed(2);
  }else if(tax_type=='IGST'){
  var for_tax0=parseFloat(parseFloat(parseFloat(quantity)*parseFloat(price))-parseFloat(disc_amt))*parseFloat(igst);
  document.getElementById('tax_amount_'+sno).value=(for_tax0/100).toFixed(2);
  document.getElementById('item_total_'+sno).value=(parseFloat(parseFloat(quantity)*parseFloat(price))-parseFloat(disc_amt)+parseFloat(parseFloat(for_tax0)/100)).toFixed(2);
  }
  }else if(discount_type=='Rs'){
  var disc_amt=discount;
   document.getElementById('taxable_'+sno).value=(parseFloat(quantity)*parseFloat(price)-parseFloat(disc_amt)).toFixed(2);
  
  if(tax_type=='CGST&SGST'){
  var for_tax=parseFloat(parseFloat(parseFloat(quantity)*parseFloat(price))-parseFloat(disc_amt))*parseFloat(parseFloat(cgst)+parseFloat(sgst));
  document.getElementById('tax_amount_'+sno).value=(for_tax/100).toFixed(2);
  document.getElementById('item_total_'+sno).value=(parseFloat(parseFloat(quantity)*parseFloat(price))-parseFloat(disc_amt)+parseFloat(parseFloat(for_tax)/100)).toFixed(2);
  }else if(tax_type=='IGST'){
  var for_tax0=parseFloat(parseFloat(parseFloat(quantity)*parseFloat(price))-parseFloat(disc_amt))*parseFloat(igst);
  document.getElementById('tax_amount_'+sno).value=(for_tax0/100).toFixed(2);
  document.getElementById('item_total_'+sno).value=(parseFloat(parseFloat(quantity)*parseFloat(price))-parseFloat(disc_amt)+parseFloat(parseFloat(for_tax0)/100)).toFixed(2);
  }
  }
  }else{
  document.getElementById('taxable_'+sno).value=(parseFloat(quantity)*parseFloat(price)).toFixed(2);
  if(tax_type=='CGST&SGST'){
  var for_tax3=parseFloat(quantity)*parseFloat(price)*parseFloat(parseFloat(cgst)+parseFloat(sgst));
  document.getElementById('tax_amount_'+sno).value=(for_tax3/100).toFixed(2);
  document.getElementById('item_total_'+sno).value=(parseFloat(parseFloat(quantity)*parseFloat(price))+parseFloat(parseFloat(for_tax3)/100)).toFixed(2);
  }else if(tax_type=='IGST'){
  var for_tax4=parseFloat(quantity)*parseFloat(price)*parseFloat(igst);
  document.getElementById('tax_amount_'+sno).value=(for_tax4/100).toFixed(2);
  document.getElementById('item_total_'+sno).value=(parseFloat(parseFloat(quantity)*parseFloat(price))+parseFloat(parseFloat(for_tax4)/100)).toFixed(2);
  }
  }
  $('#click_total').click();
  }else{
  document.getElementById('taxable_'+sno).value=0;
  document.getElementById('tax_amount_'+sno).value=0;
  document.getElementById('item_total_'+sno).value=0;
  document.getElementById('invoice_grand_total').value=0;
  }
  }
  // this code is use for rowwise total calculation -----END-----
  
  // this code is use for click the hidden button -----START-----
  function for_click(sno){
  $('#click_'+sno).click();
  }
  // this code is use for click the hidden button -----END-----
  
  // this code is use for change the tax type functionality -----START-----
  function for_tax(sno){
 
  var cgst1=document.getElementById('cgst1_'+sno).value;
  var sgst1=document.getElementById('sgst1_'+sno).value;
  var igst1=document.getElementById('igst1_'+sno).value;
  var tax_type=document.getElementById('tax_type_'+sno).value;
  if(tax_type=='CGST&SGST'){
  $("#cgst_"+sno).prop("readonly", false);
  $("#sgst_"+sno).prop("readonly", false);
  $("#cgst_"+sno).val(cgst1);
  $("#sgst_"+sno).val(sgst1);
  $("#igst_"+sno).val('0');
  $("#igst_"+sno).prop("readonly", true);
  }else if(tax_type=='IGST'){
  $("#cgst_"+sno).prop("readonly", true);
  $("#sgst_"+sno).prop("readonly", true);
  $("#cgst_"+sno).val('0');
  $("#sgst_"+sno).val('0');
  $("#igst_"+sno).val(igst1);
  $("#igst_"+sno).prop("readonly", false);
  }
   var fix_price=document.getElementById('price_fix_'+sno).value;
            if(fix_price!=''){
			fix_rate(sno,fix_price);
			}
  $('#click_'+sno).click();
  }
  // this code is use for change the tax type functionality -----END-----
  
  // this code is use for grand total calculation -----START-----
  function for_grandtotal(){
	 var add = 0;
	 $('.amt').each(function() {
	 add += Number($(this).val());
	 });
	 
	 var extra_expence=document.getElementById('invoice_extra_expences').value;
	 if(extra_expence>0){
	 document.getElementById('invoice_sub_total').value=(parseFloat(add)-parseFloat(extra_expence)).toFixed(2);
	 }else{
	 document.getElementById('invoice_sub_total').value=add.toFixed(2);
	 }
	 
	 var discount_amount=document.getElementById('total_invoice_discount').value;
	 var paid_amount=document.getElementById('invoice_total_paid').value;
	 if(discount_amount>0){
	 
	 var invoice_discount=document.getElementById('total_discount_type').value;
	 if(invoice_discount=='%'){
	 var disc_amt11=parseFloat(add)*parseFloat(discount_amount)/100;
	 document.getElementById('invoice_grand_total').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed();
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2);
	 
	 if(paid_amount>0){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)-parseFloat(paid_amount)).toFixed(2);
	 }else{
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2);
	 }
	 }else if(invoice_discount=='Rs'){
	 document.getElementById('invoice_grand_total').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed();
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
	 if(paid_amount>0){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(paid_amount)-parseFloat(discount_amount)).toFixed(2);
	 }else{
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
	 }
	 }
	 }else{
	 document.getElementById('invoice_grand_total').value=add.toFixed();
	 if(paid_amount>0){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(paid_amount)).toFixed(2);
	 }else{
	 document.getElementById('invoice_due_amount').value=parseFloat(add).toFixed(2);
	 }
	 }
	 
  }
  // this code is use for grand total calculation -----END-----
  
  // this code is use for hide and show payment detail -----START-----
  function payment_detail(value){
  if(value=='Cash'){
  $('#for_payment_detail').hide();
  }else{
  $('#for_payment_detail').show();
  }
  }
  // this code is use for hide and show payment detail -----END-----
  
  // this code is use for get firm information -----START-----
  function firm_info(value){
		$.ajax({
			address: "POST",
			url: software_link+"purchase/get_firm_details.php?id="+value+"",
			cache: false,
			success: function(detail){
			var res = detail.split("|?|");
			//alert(res[0]);
			$('#invoice_shipping_address').val(res[2]);
			$('#invoice_billing_address').val(res[2]);
			$('#invoice_place_of_supply').val(res[1]).prop('selected', true);
			$('#invoice_gstin_no').val(res[0]);
			place_ofsupply(res[1]);
			}
		});
  }
  
  // this code is use for get firm information -----END-----
  
  
  function fix_rate(sno,value){
	 if(value!=''){
            var cgst=document.getElementById('cgst_'+sno).value;
            var sgst=document.getElementById('sgst_'+sno).value;
            var igst=document.getElementById('igst_'+sno).value;
            var price=document.getElementById('price_'+sno).value;
            var quantity=document.getElementById('quantity_'+sno).value;
            var rate=parseFloat(parseFloat(value)*100/parseFloat(100+parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst)));
	        document.getElementById('price_'+sno).value=rate.toFixed(0);
	        document.getElementById('taxable_'+sno).value=rate.toFixed(0);
	        document.getElementById('item_total_'+sno).value=(parseFloat(quantity*value)).toFixed(0);
            document.getElementById('tax_amount_'+sno).value=(parseFloat(value)-parseFloat(rate)).toFixed(0);
    }else
	{
	 var price1=document.getElementById('price1_'+sno).value;
	 document.getElementById('price_'+sno).value=price1;
	 $('#click_'+sno).click();
	}
    $('#click_total').click();
  
  }
  
  
  
  function place_ofsupply(value){
 var sno=$('table tr').length;
  //alert(sno);
for(i=1; i<sno; i++){
  if(value=='Delhi'){
            var cgst1=document.getElementById('cgst1_'+i).value;
            var sgst1=document.getElementById('sgst1_'+i).value;
			
			//alert(i);
			$("#tax_type_"+i).val('CGST&SGST').prop('selected', true);
			$("#cgst_"+i).val(cgst1);
			$("#cgst_"+i).prop("readonly", false);
			$("#sgst_"+i).val(sgst1);
			$("#sgst_"+i).prop("readonly", false);
			$("#igst_"+i).val('0');
			$("#igst_"+i).prop("readonly", true);			
			}else{
			var igst1=document.getElementById('igst1_'+i).value;
			//alert(i);
			$("#tax_type_"+i).val('IGST').prop('selected', true);
			$("#cgst_"+i).val('0');
			$("#cgst_"+i).prop("readonly", true);
			$("#sgst_"+i).val('0');
			$("#sgst_"+i).prop("readonly", true);
			$("#igst_"+i).val(igst1);
			$("#igst_"+i).prop("readonly", false);
			}
			var fix_price=document.getElementById('price_fix_'+i).value;
            if(fix_price!=''){
			fix_rate(i,fix_price);
			}
			$('#click_'+i).click();
			$('#click_total').click();
			}
	}
	
	
	function validate(){
	var gst=document.getElementById('invoice_gstin_no').value;
	var gst = gst.toUpperCase();
	var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
	if(gst==''){
	var val=confirm('Do You Want To Continue Without GST number !!!');
	if(val==true){
	return true;
	}else{
	return false;
	}
	}else{
    if(gst!=''){
    if (gstinformat.test(gst)) {
     return true;
    } else {
        alert('Please Enter Valid GSTIN Number or Left Blank');
        $("#invoice_gstin_no").focus();
		return false;
    }
	}
	}
	}
	
	
	function edit_firm(){
	var id=document.getElementById('invoice_firm_name').value;
	if(id!=''){
	window.open('../inventory/contact_edit.php?id='+id,'_self');
	}else{
	alert('Please Select Firm Name !!!');
	}
	}
  
  </script>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create New Purchase Order
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
	<form method="post" onsubmit="return validate();" enctype="multipart/form-data">
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title" style="color:red">Purchase Order</h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
    
	<div class="box-body "  >
		
				<div class="col-md-3 ">
						<?php
						include("../../connection/connect.php");
						$query2="select * from invoice_no where company_code='$company_code'";
						$res2=mysql_query($query2);
						while($row2=mysql_fetch_array($res2)){
						$sales_invoice_no=$row2['sales_invoice_no'];
						$val=substr($sales_invoice_no, 1);
						}
						?>
						<div class="form-group">
						  <label>Purchase Order No.</label>
						   <input type="text" name="invoice_no" placeholder="" value="<?php echo 'PO-'.$val; ?>" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Date</label>
					  <input type="date" name="invoice_date" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">		
						<div class="form-group">
						  <label>Reference</label>
						   <input type="text" name="invoice_reference" placeholder="Add Reference" value="" class="form-control">
						</div>
					</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Delivery Date</label>
					  <input type="date" name="invoice_due_date" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
				</div>
				
				<div class="col-md-3 ">				
					<div class="form-group" >
					  <label>Firm Name <span style="color:red;">*</span></label>
					  <select name="invoice_firm_name" class="form-control select2" id="invoice_firm_name" onchange="firm_info(this.value);" required>
					  <option value="">Select Firm</option>
					        <?php
							include("../../connection/connect.php");
							$qry="select * from contact_master where contact_status='Active' and company_code='$company_code'";
							$rest=mysql_query($qry);
							while($row22=mysql_fetch_array($rest)){
							$s_no=$row22['s_no'];
							$contact_company_name=$row22['contact_company_name'];
							$contact_tittle_name=$row22['contact_tittle_name'];
							$contact_first_name=$row22['contact_first_name'];
							$contact_last_name=$row22['contact_last_name'];
							?>
							<option value="<?php echo $s_no; ?>"><?php echo $contact_company_name.' '; ?><?php echo "[".$contact_tittle_name." ".$contact_first_name." ".$contact_last_name."]"; ?></option>
							<?php
							}
							?>
					  </select>

					</div>	
				</div>
				<br><br><br>
				<div class="col-md-3 ">
					<div class="form-group" >
					 <br>
					  <a href="../inventory/contact.php"><button type="button" style="background-color:#00a65a; color:white" class="">+ New Contact</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="#"><button onclick="edit_firm();" style="background-color:#00a65a; color:white" class="">Edit Firm</button></a>
					</div>
					</div>
					<div class="col-md-3 ">
					<div class="form-group" >
					  <label >GSTIN No</label>
					  <input type="text" name="invoice_gstin_no" placeholder="Add GSTIN" id="invoice_gstin_no" value="" class="form-control">
					</div>
					</div>
					<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Shipment Preference</label>
					  <input type="text" name="invoice_reference" placeholder="Add Reference" value="" class="form-control">
					</div>
				</div>
				
					<div class="col-md-3 " style="display:none">			
					<div class="form-group" >
					  <label >Place Of Supply <span style="color:red;">*</span></label>
					  <select class="form-control" name="invoice_place_of_supply" id="invoice_place_of_supply" onchange="place_ofsupply(this.value);" required>
					        <option value="">Select</option>
					        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
							<option value="Andhra Pradesh">Andhra Pradesh</option>
							<option value="Assam">Assam</option>
							<option value="Bihar">Bihar</option>
							<option value="Chandigarh">Chandigarh</option>
							<option value="Chattisgarh">Chattisgarh</option>
							<option value="Dadra Nagar Haveli">Dadra Nagar Haveli</option>
							<option value="Daman and Diu">Daman and Diu</option>
							<option value="Delhi">Delhi</option>
							<option value="Goa">Goa</option>
							<option value="Gujrat">Gujrat</option>
							<option value="Haryana">Haryana</option>
							<option value="Himachal Pradesh">Himachal Pradesh</option>
							<option value="Jammu & Kashmir">Jammu & Kashmir</option>
							<option value="Karnataka">Karnataka</option>
							<option value="Kerala">Kerala</option>
							<option value="Lakshadweep">Lakshadweep</option>
							<option value="Madhya Pradesh">Madhya Pradesh</option>
							<option value="Maharashtra">Maharashtra</option>
							<option value="Manipur">Manipur</option>
							<option value="Meghalaya">Meghalaya</option>
							<option value="Mizoram">Mizoram</option>
							<option value="Nagaland">Nagaland</option>
							<option value="Orissa">Orissa</option>
							<option value="Outside India">Outside India</option>
							<option value="Pondicherry">Pondicherry</option>
							<option value="Punjab">Punjab</option>
							<option value="Rajasthan">Rajasthan</option>
							<option value="Sikkim">Sikkim</option>
							<option value="Tamil Nadu">Tamil Nadu</option>
							<option value="Telangana">Telangana</option>
							<option value="Tripura">Tripura</option>
							<option value="Uttar Pradesh">Uttar Pradesh</option>
							<option value="Uttarakhand">Uttarakhand</option>
							<option value="West Bengal">West Bengal</option>
					  </select>
					</div>
					</div>
				</div>
		    </div>
            <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered" style="background-color:white;">
            <thead class="my_background_color">
                <tr>
					<th style="width:50px;">S.No</th>
					<th style="width:200px;">Item </th>
					<th style="width:70px;">Quantity</th>
					<th style="width:70px;">Rate (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:70px;">Fix Rate (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:70px;">Discount(%/Rs)</th>
					<th style="width:70px;">Taxable (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:70px;">Tax Type</th>
					<th style="width:70px;">Tax Amount</th>
					<th style="width:100px;">Total (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:20px;"></th>
                </tr>
            </thead>
			<tbody>
			 <tr id="row_1">
					<td><span id='snum_1' class="snm">1.</span></td>
					<td>
					 <div class="form-group">
						
							<select name="item_product_name[]" id="item_product_name_1" style="width:100%;" class="form-control select2" onchange="item_desc(this.value,1);" required>
							<option value=''>Select</option>
							<?php
							include("../../connection/connect.php");
							$query="select * from item_master where company_code='$company_code'";
							$res=mysql_query($query);
							while($row=mysql_fetch_array($res)){
							$s_no=$row['s_no'];
							$item_product_name=$row['item_product_name'];
							$barcode_no=$row['barcode_no'];
							?>
							<option value="<?php echo $s_no; ?>"><?php echo "[".$barcode_no."]"; ?><?php echo $item_product_name; ?></option>
							<?php
							}
							?>
							</select>
						</div>
						<div>
							<label id="for_desc_1" style="display:none;padding:0px;margin:0px;font-size:12px;color:#423C9B;">Description : </label>
							<textarea name="item_description[]" id="desc_1" class="form-control" style="display:none;border-color: Transparent;padding:0px;margin:0px;" rows="1" ></textarea>
						</div>
						
						<div>
						<label id="for_hsn_1" style="display:none;font-size:12px;color:#423C9B;">HSN : </label>
						<input type="text" name="item_hsn[]" id="hsn_1" style="display:none;border:none;" />
						</div>
						<input type="hidden" name="click" id="click_1" onclick="for_total(1);">
					</td>
					<td>
					<div>
					<input type="text" name="item_quantity[]" id="quantity_1" class="form-control" value="1" oninput="for_total(1);" />
					</div>
					<div>	
						<label id="for_abl_quantity_1" style="display:none;font-size:12px;color:#423C9B;">AVL : </label>
						<input type="text" name="item_avail_quantity[]" id="abl_quantity_1" style="width:50px;display:none;border:none;" readonly />
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_price[]" id="price_1" class="form-control" oninput="for_total(1);" />
					<input type="hidden" name="item_price1[]" id="price1_1" class="form-control" />
					</div>
					<div>	
						<label id="for_unit_1" style="display:none;font-size:12px;color:#423C9B;">UNIT : </label>
						<input type="text" name="item_unit[]" id="unit_1" style="width:50px;display:none;border:none;" readonly />
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_price_fix[]" id="price_fix_1" class="form-control" oninput="fix_rate(1,this.value);" />
					</div>
					</td>
					<td>
					<div class="input-group">
					<input type="text" name="item_discount[]" id="discount_1" value="0" class="form-control" oninput="for_total(1);" />
					<span class="input-group-addon" style="padding:0px;">
					<select name="item_discount_type[]" id="discount_type_1" style="border:none;" onchange="for_click(1);">
					<option value="%">%</option>
					<option value="Rs">Rs</option>
					</select>
					</span>
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_taxable[]" id="taxable_1" class="form-control" />
					</div>
					</td>
					<td>
					<div>
					<select name="item_tax_type[]" class="form-control" onchange="for_tax(1);" id="tax_type_1">
					<option value="CGST&SGST">CGST&SGST </option>
					<option value="IGST">IGST</option>
					</select>
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_tax_amount[]" id="tax_amount_1" class="form-control" />
					</div>
					<div>	
						<label id="for_cgst_1" style="width:40px;display:none;font-size:12px;color:#423C9B;">CGST : </label>
						<input type="text" name="item_cgst[]" oninput="for_total(1);" id="cgst_1" style="width:40px;display:none;border:none;" />
						<input type="hidden" name="item_cgst1[]" id="cgst1_1" />						
						
					</div>
					<div>	
						<label id="for_sgst_1" style="width:40px;display:none;font-size:12px;color:#423C9B;">SGST : </label>
						<input type="text" name="item_sgst[]" oninput="for_total(1);" id="sgst_1" style="width:40px;display:none;border:none;" />
						<input type="hidden" name="item_sgst1[]" id="sgst1_1" />
						
					</div>
					<div>
						<label id="for_igst_1" style="width:40px;display:none;font-size:12px;color:#423C9B;">IGST : </label>
						<input type="text" name="item_igst[]" id="igst_1" oninput="for_total(1);" style="width:40px;display:none;border:none;" />
						<input type="hidden" name="item_igst1[]" id="igst1_1" />
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_total_amount[]" class="form-control amt" id="item_total_1"  style="border:none;" />
					</div>
					</td>
					<td>
					<div>
					&nbsp;
					</div>
					</td>
             </tr>
			</tbody>
        </table>
		<br>

			<button type="button" style="background-color:#00a65a" class="btn btn-info" id='addmore'>+ Add More</button>

			<br/>

			<br/>

			<br/>
			<script>

			
			var i=2;

			$("#addmore").on('click',function(){
   
			count=$('table tr').length;

			var data="<tr id='row_"+count+"'><td><span id='snum_"+count+"' class='snm'>"+count+".</span></td>";

			 data +="<td><div class='form-group'><select class='form-control select2' style='width:100%;' name='item_product_name[]' id='item_product_name_"+count+"' onchange='item_desc(this.value,"+count+");' required><option value=''>Select</option><?php $query="select * from item_master where company_code='$company_code'";$res=mysql_query($query);while($row=mysql_fetch_array($res)){$s_no=$row['s_no'];$item_product_name=$row['item_product_name'];$barcode_no=$row['barcode_no'];?><option value='<?php echo $s_no; ?>'><?php echo '['.$barcode_no.']'; ?><?php echo $item_product_name; ?></option><?php } ?></select></div><div><label id='for_desc_"+count+"' style='display:none;padding:0px;margin:0px;font-size:12px;color:#423C9B;'>Description : </label><textarea name='item_description[]' id='desc_"+count+"' class='form-control' style='display:none;border-color: Transparent;padding:0px;margin:0px;' rows='1' ></textarea></div><div><label id='for_hsn_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>HSN : </label><input type='text' name='item_hsn[]' id='hsn_"+count+"' style='display:none;border:none;' /></div><input type='hidden' name='click' id='click_"+count+"' onclick='for_total("+count+");'></td><td><div><input type='text' name='item_quantity[]' id='quantity_"+count+"' class='form-control' value='1' oninput='for_total("+count+");' /></div><div><label id='for_abl_quantity_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>AVL : </label><input type='text' name='item_avail_quantity[]' id='abl_quantity_"+count+"' style='width:50px;display:none;border:none;' readonly /></div></td><td><div><input type='text' name='item_price[]' id='price_"+count+"' class='form-control' oninput='for_total("+count+");' /><input type='hidden' name='item_price1[]' id='price1_"+count+"' class='form-control' ></div><div><label id='for_unit_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>UNIT : </label><input type='text' name='item_unit[]' id='unit_"+count+"' style='width:50px;display:none;border:none;' readonly /></div></td><td><div><input type='text' name='item_price_fix[]' id='price_fix_"+count+"' class='form-control' oninput='fix_rate("+count+",this.value);' /></div></td><td><div class='input-group'><input type='text' name='item_discount[]' id='discount_"+count+"' value='0' class='form-control' oninput='for_total("+count+");' /><span class='input-group-addon' style='padding:0px;'><select name='item_discount_type[]' id='discount_type_"+count+"' style='border:none;' onchange='for_click("+count+");'><option value='%'>%</option><option value='Rs'>Rs</option></select></span></div></td><td><div><input type='text' name='item_taxable[]' id='taxable_"+count+"' class='form-control' /></div></td><td><div><select name='item_tax_type[]' class='form-control' onchange='for_tax("+count+");' id='tax_type_"+count+"'><option value='CGST&SGST'>CGST&SGST </option><option value='IGST'>IGST</option></select></div></td><td><div><input type='text' name='item_tax_amount[]' id='tax_amount_"+count+"' class='form-control' /></div><div><label id='for_cgst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>CGST : </label><input type='text' name='item_cgst[]' oninput='for_total("+count+");' id='cgst_"+count+"' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_cgst1[]' id='cgst1_"+count+"' /></div><div><label id='for_sgst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>SGST : </label><input type='text' name='item_sgst[]' oninput='for_total("+count+");' id='sgst_"+count+"' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_sgst1[]' id='sgst1_"+count+"' /></div><div><label id='for_igst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>IGST : </label><input type='text' name='item_igst[]' id='igst_"+count+"' oninput='for_total("+count+");' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_igst1[]' id='igst1_"+count+"' /></div></td><td><div><input type='text' name='item_total_amount[]' class='form-control amt' id='item_total_"+count+"' style='border:none;' /></div></td><td><div><label><i class='fa fa-times form-control' style='color:red;border:none;' onclick='for_delete("+count+");' aria-hidden='true'></i></label></div></td></tr>";

			$('table').append(data);

			i++;
			$('.select2').select2();
			});

			function for_delete(sno){
			if(sno>1){
			var my_sno=sno-1;
			$('#row_'+sno).remove();
			$('#click_'+my_sno).click();
			
			var count1=1;
			$('.snm').each(function() {
			$(this).html(count1);
			count1++;
			});
			}
			}
			</script>
	</div>
			<div class="col-md-12">
			<div class="col-md-3">
			        <div class="form-group" >
						<label > Extra Expences </label>
						<input type="text" name="invoice_extra_expences" id="invoice_extra_expences" placeholder="Enter Extra Expences"  value="0" class="form-control amt" oninput="for_grandtotal();">
						
						<input type="hidden" id="click_total" onclick="for_grandtotal();">
					</div>
			</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">
					<div class="form-group" >
						<label > Sub Total </label>
						<input type="text" name="invoice_sub_total" id="invoice_sub_total" placeholder="Sub Total"  value="" class="form-control" readonly style="border:none;" >
					</div>
			</div>
			</div>
			<div class="col-md-12">
			<div class="col-md-3">
			        <div class="form-group" >
					<label > Discount ( % / Rs ) </label>
					<div class="input-group" >
					<input type="text" name="total_invoice_discount" id="total_invoice_discount" placeholder="Enter Discount Amount"  value="0" class="form-control" oninput="for_grandtotal();">
					
					<span class="input-group-addon" style="padding:0px;">
					<select name="total_discount_type" id="total_discount_type" style="border:none;" onchange="for_grandtotal();">
					<option value="%">%</option>
					<option value="Rs">Rs</option>
					</select>
					</span>
					</div>
					</div>
			</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">
					<div class="form-group" >
						<label > Grand Total </label>
						<input type="text" name="invoice_grand_total" id="invoice_grand_total" placeholder="Grand Total"  value="" class="form-control" readonly style="border:none;" >
					</div>
			</div>
			</div>
			
			
			<div class="col-md-12">
			<div class="col-md-3">
			        <div class="form-group" >
						<label > Payment Mode </label>
						<select class="form-control" name="invoice_payment_mode" id="invoice_payment_mode" onchange="payment_detail(this.value);">
						<option value="Cash">Cash</option>
						<option value="Chaque">Chaque</option>
						<option value="Bank Draft">Bank Draft</option>
						<option value="Net Banking">Net Banking</option>
						<option value="Neft">Neft</option>
						<option value="Rtgs">Rtgs</option>
						</select>
					</div>
			</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">
				    <div class="form-group" >
						<label > Total Paid </label>
						<input type="text" name="invoice_total_paid" id="invoice_total_paid" placeholder="Total Paid"  value="" class="form-control" oninput="for_grandtotal();">
					</div>	
			</div>
			</div>
			
			<div class="col-md-12">
			<div class="col-md-3">
			        <div class="form-group" style="display:none;" id="for_payment_detail" >
						<label > Payment Details </label>
						<input type="text" name="invoice_pament_detail" id="invoice_pament_detail" placeholder="Enter Payment Details"  value="" class="form-control">
					</div>
			</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">
				    <div class="form-group" >
						<label > Due Amount </label>
						<input type="text" name="invoice_due_amount" id="invoice_due_amount" placeholder="Due Amount"  value="" class="form-control" readonly style="border:none;" >
					</div>	
			</div>
			<?php
						include("../../connection/connect.php");
						$query3="select * from user_details where company_code='$company_code'";
						$res3=mysql_query($query3);
						while($row3=mysql_fetch_array($res3)){
						$s_no=$row3['s_no'];
						$note_1=$row3['note_1'];
						$note_2=$row3['note_2'];
						$note_3=$row3['note_3'];
						$note_4=$row3['note_4'];
						$note_5=$row3['note_5'];
						}
			?>
			<div class="col-md-9 ">		
						<div class="form-group">
						  <label>Terms And Conditions</label>
						   <textarea name="invoice_terms_and_conditions"  rows="5" cols="200" style="width:100%" class="form-control"><?php echo $note_1."\n".$note_2."\n".$note_3."\n".$note_4."\n".$note_5; ?> </textarea>
						</div>
			</div>
			<div class="col-md-3 ">		
						<div class="form-group">
						  <label>Customer Notes</label>
						   <textarea name="invoice_customer_notes" id="invoice_customer_notes" rows="5" cols="200" style="width:300px" class="form-control"></textarea>
						</div>
			</div>
			</div>
			
			</div>
			<div class="box-footer">
					<div class="col-md-12">
					<div class="col-md-4">
					<div class="form-group" >
						<input type="submit"  name="save_as_draft" value="Save as Draft" class="form-control btn-info">
					</div>
					</div>
					
					<div class="col-md-4">
					<div class="form-group">
						<input type="submit" style="background-color:#00a65a"  name="save" value="Save" class="form-control btn-info">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group" >
						<input type="submit" style="background-color:brown" name="save_and_print" value="Save and Print" class="form-control btn-info">
					</div>
					</div>
					</div>
					</div>
					</div>
				</div>
	</div>
	
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
    </div>
    </div>
</section>
</form>	
 </div><!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->

 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/../attachment/link_js.php")?>
 <script src="select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>

<?php
if(isset($_POST['save_as_draft']) || isset($_POST['save']) || isset($_POST['save_and_print'])){
$invoice_no=$_POST['invoice_no'];
$sales_invoice_draft_no=$_POST['sales_invoice_draft_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_reference=$_POST['invoice_reference'];
$invoice_due_date=$_POST['invoice_due_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$invoice_gstin_no=$_POST['invoice_gstin_no'];
$invoice_place_of_supply=$_POST['invoice_place_of_supply'];
$invoice_billing_address=$_POST['invoice_billing_address'];
$invoice_shipping_address=$_POST['invoice_shipping_address'];
$item_product_name=$_POST['item_product_name'];
$item_description=$_POST['item_description'];
$item_hsn=$_POST['item_hsn'];
$item_quantity=$_POST['item_quantity'];
$item_avail_quantity=$_POST['item_avail_quantity'];
$item_unit=$_POST['item_unit'];
$item_price=$_POST['item_price'];
$item_price1=$_POST['item_price1'];
$item_price_fix=$_POST['item_price_fix'];
$item_discount=$_POST['item_discount'];
$item_discount_type=$_POST['item_discount_type'];
$item_taxable=$_POST['item_taxable'];
$item_tax_type=$_POST['item_tax_type'];
$item_tax_amount=$_POST['item_tax_amount'];
$item_cgst=$_POST['item_cgst'];
$item_cgst1=$_POST['item_cgst1'];
$item_sgst=$_POST['item_sgst'];
$item_sgst1=$_POST['item_sgst1'];
$item_igst=$_POST['item_igst'];
$item_igst1=$_POST['item_igst1'];
$item_total_amount=$_POST['item_total_amount'];
$invoice_extra_expences=$_POST['invoice_extra_expences'];
$invoice_sub_total=$_POST['invoice_sub_total'];
$total_invoice_discount=$_POST['total_invoice_discount'];
$total_discount_type=$_POST['total_discount_type'];
$invoice_grand_total=$_POST['invoice_grand_total'];
$invoice_payment_mode=$_POST['invoice_payment_mode'];
$invoice_total_paid=$_POST['invoice_total_paid'];
$invoice_pament_detail=$_POST['invoice_pament_detail'];
$invoice_due_amount=$_POST['invoice_due_amount'];
$invoice_customer_notes=$_POST['invoice_customer_notes'];
$invoice_terms_and_conditions=$_POST['invoice_terms_and_conditions'];
$item_product_name=mysql_escape_string(serialize($item_product_name));
$item_description=mysql_escape_string(serialize($item_description));
$item_hsn=mysql_escape_string(serialize($item_hsn));
$item_quantity=mysql_escape_string(serialize($item_quantity));
$item_avail_quantity=mysql_escape_string(serialize($item_avail_quantity));
$item_unit=mysql_escape_string(serialize($item_unit));
$item_price=mysql_escape_string(serialize($item_price));
$item_price1=mysql_escape_string(serialize($item_price1));
$item_price_fix=mysql_escape_string(serialize($item_price_fix));
$item_discount=mysql_escape_string(serialize($item_discount));
$item_discount_type=mysql_escape_string(serialize($item_discount_type));
$item_taxable=mysql_escape_string(serialize($item_taxable));
$item_tax_type=mysql_escape_string(serialize($item_tax_type));
$item_tax_amount=mysql_escape_string(serialize($item_tax_amount));
$item_cgst=mysql_escape_string(serialize($item_cgst));
$item_cgst1=mysql_escape_string(serialize($item_cgst1));
$item_sgst=mysql_escape_string(serialize($item_sgst));
$item_sgst1=mysql_escape_string(serialize($item_sgst1));
$item_igst=mysql_escape_string(serialize($item_igst));
$item_igst1=mysql_escape_string(serialize($item_igst1));
$item_total_amount=mysql_escape_string(serialize($item_total_amount));
if(isset($_POST['save_as_draft'])){
$query="insert into purchase_draft_info(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,invoice_pament_detail,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,company_name,company_code) values('$invoice_no','$invoice_date','$invoice_reference','$invoice_due_date','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name','$item_description','$item_hsn','$item_quantity','$item_avail_quantity','$item_unit','$item_price','$item_price1','$item_price_fix','$item_discount','$item_discount_type','$item_taxable','$item_tax_type','$item_tax_amount','$item_cgst','$item_cgst1','$item_sgst','$item_sgst1','$item_igst','$item_igst1','$item_total_amount','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$invoice_pament_detail','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','$company_name','$company_code')";
$sales_invoice_draft_no=$sales_invoice_draft_no+1;
$que2="update invoice_no set sales_invoice_draft_no='$sales_invoice_draft_no' where company_code='$company_code'";
mysql_query($que2);
if(mysql_query($query)){
echo "<script>window.open('purchase_order_list.php','_self');</script>";
} }
if(isset($_POST['save'])){
$query="insert into purchase_info(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,invoice_pament_detail,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,company_name,company_code) values('$invoice_no','$invoice_date','$invoice_reference','$invoice_due_date','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name','$item_description','$item_hsn','$item_quantity','$item_avail_quantity','$item_unit','$item_price','$item_price1','$item_price_fix','$item_discount','$item_discount_type','$item_taxable','$item_tax_type','$item_tax_amount','$item_cgst','$item_cgst1','$item_sgst','$item_sgst1','$item_igst','$item_igst1','$item_total_amount','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$invoice_pament_detail','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','$company_name','$company_code')";
$sales_invoice_no=$sales_invoice_no+1;
$que2="update invoice_no set sales_invoice_no='$sales_invoice_no' where company_code='$company_code'";
mysql_query($que2);
if(mysql_query($query)){
echo "<script>window.open('purchase_order_list.php','_self');</script>";
} }
if(isset($_POST['save_and_print'])){
$query="insert into purchase_info(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,invoice_pament_detail,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,company_name,company_code) values('$invoice_no','$invoice_date','$invoice_reference','$invoice_due_date','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name','$item_description','$item_hsn','$item_quantity','$item_avail_quantity','$item_unit','$item_price','$item_price1','$item_price_fix','$item_discount','$item_discount_type','$item_taxable','$item_tax_type','$item_tax_amount','$item_cgst','$item_cgst1','$item_sgst','$item_sgst1','$item_igst','$item_igst1','$item_total_amount','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$invoice_pament_detail','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','$company_name','$company_code')";
$sales_invoice_no=$sales_invoice_no+1;
$que2="update invoice_no set sales_invoice_no='$sales_invoice_no' where company_code='$company_code'";
mysql_query($que2);
if(mysql_query($query)){
echo "<script>window.open('purchase_order_list.php','_self');</script>";
} } }
?>
