<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="search_script.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("link_css.php")?>
<script src="select2.min.css"></script>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php include("../attachment/header.php"); ?>
  <?php include("../attachment/sidebar.php"); ?>
  <?php include("../../connection/connect.php"); ?>
  
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
	 
  //var place_of_supply=document.getElementById('invoice_place_of_supply').value;
 // var admin_place=document.getElementById('admin_place_of_supply').value;
 
  var inv_type= "sales";
 
  $.ajax({
			address: "POST",
			url: software_link+"item_tracking/ajax_get_item_description.php?value="+value+"&inv_type="+inv_type+"",
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
			$("#unit_"+sno).val(res[6]);
			$("#price_"+sno).val(res[5]);
			$("#price1_"+sno).val(res[5]);
			$("#tax_type_"+sno).val('CGST&SGST');
			$("#cgst_"+sno).val(res[2]);
			$("#sgst_"+sno).val(res[2]);
			$("#igst_"+sno).val('0');
			$("#igst_"+sno).prop("readonly", true);			
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
	 document.getElementById('invoice_grand_total').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2);
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2);
	 
	 if(paid_amount>0){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)-parseFloat(paid_amount)).toFixed(2);
	 }else{
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2);
	 }
	 }else if(invoice_discount=='Rs'){
	 document.getElementById('invoice_grand_total').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
	 if(paid_amount>0){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(paid_amount)-parseFloat(discount_amount)).toFixed(2);
	 }else{
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
	 }
	 }
	 }else{
	 document.getElementById('invoice_grand_total').value=add.toFixed(2);
	 if(paid_amount>0){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(paid_amount)).toFixed(2);
	 }else{
	 document.getElementById('invoice_due_amount').value=parseFloat(add).toFixed(2);
	 }
	 }
	 
  }
  // this code is use for grand total calculation -----END-----
  
  // this code is use for hide and show payment detail -----START-----
 
  // this code is use for hide and show payment detail -----END-----
  
  // this code is use for get firm information -----START-----
  
  // this code is use for get firm information -----END-----
  
  function fix_rate(sno,value){
	 if(value!=''){
            var cgst=document.getElementById('cgst_'+sno).value;
            var sgst=document.getElementById('sgst_'+sno).value;
            var igst=document.getElementById('igst_'+sno).value;
            var price=document.getElementById('price_'+sno).value;
            var quantity=document.getElementById('quantity_'+sno).value;
            var rate=parseFloat(parseFloat(value)*100/parseFloat(100+parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst)));
	        document.getElementById('price_'+sno).value=rate.toFixed(2);
	        document.getElementById('taxable_'+sno).value=rate.toFixed(2);
	        document.getElementById('item_total_'+sno).value=(parseFloat(quantity*value)).toFixed(2);
            document.getElementById('tax_amount_'+sno).value=(parseFloat(value)-parseFloat(rate)).toFixed(2);
    }else
	{
	 var price1=document.getElementById('price1_'+sno).value;
	 document.getElementById('price_'+sno).value=price1;
	 $('#click_'+sno).click();
	}
    $('#click_total').click();
  }
function place_ofsupply(value){
  $.ajax({
		address: "POST",
		url: software_link+"item_tracking/ajax_get_admin_place_of_supply.php",
		cache: false,
		success: function(detail){
		var res = detail.split("|?|");
		//$('#admin_place_of_supply').val(res[1]);
var sno=$('table tr').length;
for(i=1; i<sno; i++){
  if(value==res[1]){
            var cgst1=document.getElementById('cgst1_'+i).value;
            var sgst1=document.getElementById('sgst1_'+i).value;

			$("#tax_type_"+i).val('CGST&SGST').prop('selected', true);
			$("#cgst_"+i).val(cgst1);
			$("#cgst_"+i).prop("readonly", false);
			$("#sgst_"+i).val(sgst1);
			$("#sgst_"+i).prop("readonly", false);
			$("#igst_"+i).val('0');
			$("#igst_"+i).prop("readonly", true);			
			}else{
			var igst1=document.getElementById('igst1_'+i).value;
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
		});
	}
	function get_barcode(value,id){
       $.ajax({
			  type: "POST",
              url: software_link+"item_tracking/ajax_get_data_by_barcode.php?barcode="+value+"",
              cache: false,
              success: function(detail){
              $('#item_product_name_'+id).html(detail);
              }
           });
    }

  </script>
  <script src="../attachment/file_check.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create New Invoice
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="packages_invoice_list.php"><i class="fa fa-shopping-cart"></i>Packages Order</a></li>
        <li class="active">Add Invoice</li>
      </ol>
    </section>
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
	<?php
	    $inv_no = $_GET['inv_no'];
        $qry = "select * from packages_invoice_info where invoice_no='$inv_no'";
		$run11 = mysql_query($qry);
		$row11 = mysql_fetch_array($run11);
		$s_no=$row11['s_no'];
			$invoice_no=$row11['invoice_no'];
			$invoice_date=$row11['invoice_date'];
			$invoice_reference=$row11['invoice_reference'];
			$invoice_due_date=$row11['invoice_due_date'];
			$invoice_firm_name=$row11['invoice_firm_name'];
			$select_pay_term = "select * from contact_master where s_no='$invoice_firm_name'";
			 $run = mysql_query($select_pay_term);
			 $fetchr=mysql_fetch_array($run);
			 $contact_payment_terms = $fetchr['contact_payment_terms'];
			$invoice_billing_address=$row11['invoice_billing_address'];
			$invoice_shipping_address=$row11['invoice_shipping_address'];
			$invoice_gstin_no=$row11['invoice_gstin_no'];
			$invoice_place_of_supply=$row11['invoice_place_of_supply'];
			$invoice_extra_expences=$row11['invoice_extra_expences'];
			$invoice_sub_total=$row11['invoice_sub_total'];
			$invoice_total_discount=$row11['invoice_total_discount'];
			$invoice_total_discount_type=$row11['invoice_total_discount_type'];
			$invoice_grand_total=$row11['invoice_grand_total'];
			$invoice_payment_mode=$row11['invoice_payment_mode'];
			$invoice_total_paid=$row11['invoice_total_paid'];
			$remark=$row11['remark'];
			$invoice_due_amount=$row11['invoice_due_amount'];
			$invoice_customer_notes=$row11['invoice_customer_notes'];
			$invoice_terms_and_conditions=$row11['invoice_terms_and_conditions'];
			$invoice_shipping_charge=$row11['invoice_shipping_charge'];
			$account_type=$row11['account_type'];
			$account_name=$row11['account_name'];
			$cheque_dd=$row11['cheque_dd'];
			$cheque_dd_no=$row11['cheque_dd_no'];
			$cheque_dd_amount=$row11['cheque_dd_amount'];
			$cheque_dd_issue_date=$row11['cheque_dd_issue_date'];
			$cheque_dd_clearing_date=$row11['cheque_dd_clearing_date'];
			$transaction_type=$row11['transaction_type'];
			$payment_count=$row11['payment_count'];
	?>
	<form method="post" onsubmit="return validate();" enctype="multipart/form-data">
    <section class="content">
      <!-- Small boxes (Stat box) -->
    <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title" style="color:red">Invoice</h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
	<div class="box-body">
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					  <label>Package No.</label>
					   <input type="text" name="invoice_no" placeholder="" value="<?php echo $invoice_no; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-lg-12">
					<?php
					$query2="select * from invoice_no";
					$res2=mysql_query($query2);
					while($row2=mysql_fetch_array($res2)){
					$folder_id=$row2['folder_id'];
					$shipping_invoice_no=$row2['shipping_invoice_no'];
					$val=substr($shipping_invoice_no, 1);
					}
					?>
					<div class="form-group col-lg-5">
					  <label>Shipping No.</label>
					   <input type="text" name="shipping_no" placeholder="" value="<?php echo "SHP-".$val; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label>Invoice Date</label>
					  <input type="date" name="invoice_date" id="invoice_date" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label>Transport(Carrier)</label>
						   <input type="text" name="invoice_transport_name" placeholder="Add Transport" value="" class="form-control">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label>Tracking No</label>
						   <input type="text" name="invoice_tracking" placeholder="Add Tracking Number" value="" class="form-control">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5">
					 <label>Shipping Charge</label>
						   <input type="number" name="invoice_shipping_charge" placeholder="Add Shipping Charge" value="" class="form-control">
					</div>
				</div>
	</div>
	</div>
	</div>
            <!-- /.box-header -->
    <div class="box-body table-responsive">
       <div id="item_table" class="table table-bordered" style="background-color:white">
	<input type="hidden" id="sample2" value="1" />
	<?php
			$que12="select * from packages_invoice_info where invoice_no='$invoice_no' and invoice_status='Active'";
			$run12=mysql_query($que12) or die(mysql_error());
			$num12 = mysql_num_rows($run12);
			$serial=0;
			while($row12=mysql_fetch_array($run12)){
			$invoice_s_no=$row12['s_no'];
			$invoice_product_name=$row12['invoice_product_name'];
			$invoice_description=$row12['invoice_description'];
			$invoice_hsn=$row12['invoice_hsn'];
			$invoice_quantity=$row12['invoice_quantity'];
			$invoice_available_quantity=$row12['invoice_available_quantity'];
			$invoice_rate=$row12['invoice_rate'];
			$invoice_rate1=$row12['invoice_rate1'];
			$invoice_item_unit=$row12['invoice_item_unit'];
			$invoice_price_fix=$row12['invoice_price_fix'];
			$invoice_discount=$row12['invoice_discount'];
			$invoice_discount_type=$row12['invoice_discount_type'];
			$invoice_taxable=$row12['invoice_taxable'];
			$invoice_tax_type=$row12['invoice_tax_type'];
			$invoice_tax=$row12['invoice_tax'];
			$invoice_cgst=$row12['invoice_cgst'];
			$invoice_cgst1=$row12['invoice_cgst1'];
			$invoice_sgst=$row12['invoice_sgst'];
			$invoice_sgst1=$row12['invoice_sgst1'];
			$invoice_igst=$row12['invoice_igst'];
			$invoice_igst1=$row12['invoice_igst1'];
			$invoice_total=$row12['invoice_total'];
			$serial++;
			?>
        <table class="table table-bordered" style="background-color:white;" id="table_1">
            <thead class="my_background_color">
                <tr id="<?php echo 'row_'.$serial; ?>">
					<th style="width:50px;">S.No.</th>
					<th style="width:200px;">Scan Barcode</th>
					<th style="width:200px;">Item </th>
					<th style="width:70px;">Quantity</th>
					<th style="width:70px;">Box Quantity</th>
					<th style="width:70px;">Rate (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:70px;">Fix Rate (<i class="fa fa-inr" aria-hidden="true">)</th>
                </tr>
            </thead>
			<tbody>
			 <tr id="<?php echo 'row_'.$serial; ?>">
					<td><span id='<?php echo 'snum_'.$serial; ?>' class="snm"><?php echo $serial.'.'; ?></span><input type="hidden" name="invoice_s_no[]" id="<?php echo 'invoice_s_no_'.$serial; ?>" value="<?php echo $invoice_s_no; ?>" /></td>
					<td>
					<div>
					<input type="text" name="barcode_no" placeholder="Scan Item" onblur="get_barcode(this.value,<?php echo $serial; ?>);" value="" class="form-control">
					</div>
					</td>
					<td>
					 <div class="form-group">
							<select name="item_product_name[]" id="<?php echo 'item_product_name_'.$serial; ?>" style="width:100%;" class="form-control select2" onchange="item_desc(this.value,<?php echo $serial; ?>);" required>
							<option value=''>Select</option>
							<?php
							$query="select * from item_master";
							$res=mysql_query($query);
							while($row=mysql_fetch_array($res)){
							$s_no=$row['s_no'];
							$item_product_name=$row['item_product_name'];
							$barcode_no=$row['barcode_no'];
							?>
							<option <?php if($s_no==$invoice_product_name){ echo "selected"; } ?> value="<?php echo $s_no; ?>"><?php echo "[".$barcode_no."]"; ?><?php echo $item_product_name; ?></option>
							<?php
							}
							?>
							</select>
							<input type="hidden" name="previous_item_product_name[]" value="<?php echo $invoice_product_name; ?>" />
						</div>
						<div>
							<label id="<?php echo 'for_desc_'.$serial; ?>" style="padding:0px;margin:0px;font-size:12px;color:#423C9B;">Description : </label>
							<textarea name="item_description[]" id="<?php echo 'desc_'.$serial; ?>" class="form-control" style="border-color: Transparent;padding:0px;margin:0px;" rows="1" ><?php echo $invoice_description; ?></textarea>
						</div>
						
						<div>
						<label id="<?php echo 'for_hsn_'.$serial; ?>" style="font-size:12px;color:#423C9B;">HSN : </label>
						<input type="text" name="item_hsn[]" value="<?php echo $invoice_hsn; ?>" id="<?php echo 'hsn_'.$serial; ?>" style="border:none;" />
						</div>
						<input type="hidden" name="click" id="<?php echo 'click_'.$serial; ?>" onclick="for_total(<?php echo $serial; ?>);">
					</td>
					<td>
					<div>
					<input type="number" name="item_quantity[]" id="<?php echo 'quantity_'.$serial; ?>" class="form-control" value="<?php echo $invoice_quantity; ?>" oninput="for_total(<?php echo $serial; ?>);" />
					<input type="hidden" name="previous_item_quantity[]" value="<?php echo $invoice_quantity; ?>" />
					</div>
					<div>	
						<label id="<?php echo 'for_abl_quantity_'.$serial; ?>" style="font-size:12px;color:#423C9B;">AVL : </label>
						<input type="number" name="item_avail_quantity[]" id="<?php echo 'abl_quantity_'.$serial; ?>" value="<?php echo $invoice_available_quantity; ?>" min="<?php if($invoice_type=='sales'){ echo 1; } ?>" style="width:50px;border:none;" />
					</div>
					</td>
					<td>
					<div>
						<input type="number" name="box_quantity[]" id="box_1" class="form-control" value="1" />
					</div>
					</td>
					<td>
					<div>
					<input type="number" name="item_price[]" id="<?php echo 'price_'.$serial; ?>" class="form-control" value="<?php echo $invoice_rate; ?>" oninput="for_total(<?php echo $serial; ?>);" />
					<input type="hidden" name="item_price1[]" value="<?php echo $invoice_rate1; ?>" id="<?php echo 'price1_'.$serial; ?>" class="form-control" />
					</div>
										<div>	
						<label id="<?php echo 'for_unit_'.$serial; ?>" style="font-size:12px;color:#423C9B;">UNIT : </label>
						<input type="text" name="item_unit[]" id="<?php echo 'unit_'.$serial; ?>" value="<?php echo $invoice_item_unit; ?>" style="width:60px;border:none;" readonly />
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_price_fix[]" id="<?php echo 'price_fix_'.$serial; ?>" value="<?php echo $invoice_price_fix; ?>" class="form-control" oninput="fix_rate(<?php echo $serial; ?>,this.value);" />
					</div>
					</td>
             </tr>
			</tbody>
			<tbody><tr><th style="width:70px;">Discount(%/Rs)</th>
					<th style="width:70px;">Taxable (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:70px;">Tax Type</th>
					<th style="width:70px;">Tax Amount</th>
					<th style="width:100px;">Total (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:20px;"></th></tr>
					<tr>
					<td>
					<div class="input-group">
					<input type="text" name="item_discount[]" id="<?php echo 'discount_'.$serial; ?>" value="<?php echo $invoice_discount; ?>" class="form-control" oninput="for_total(<?php echo $serial; ?>);" />
					<span class="input-group-addon" style="padding:0px;">
					<select name="item_discount_type[]" id="<?php echo 'discount_type_'.$serial; ?>" style="border:none;" onchange="for_click(<?php echo $serial; ?>);">
					<option <?php if($invoice_discount_type=="%"){ echo "selected"; } ?> value="%">%</option>
					<option <?php if($invoice_discount_type=="Rs"){ echo "selected"; } ?> value="Rs">Rs</option>
					</select>
					</span>
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_taxable[]" id="<?php echo 'taxable_'.$serial; ?>" value="<?php echo $invoice_taxable; ?>" class="form-control" />
					</div>
					</td>
					<td>
					<div>
					<select name="item_tax_type[]" class="form-control" onchange="for_tax(1);" id="tax_type_1">
					<option <?php if($invoice_tax_type=="CGST&SGST"){ echo "selected"; } ?> value="CGST&SGST">CGST&SGST </option>
					<option <?php if($invoice_tax_type=="IGST"){ echo "selected"; } ?> value="IGST">IGST</option>
					</select>
					<div class="col-md-12">
					 <div class="row">
						<label id="<?php echo 'for_cgst_'.$serial; ?>" style="width:40px;font-size:12px;color:#423C9B;">CGST : </label>
						<input type="text" name="item_cgst[]" oninput="for_total(<?php echo $serial; ?>);" value="<?php echo $invoice_cgst; ?>" id="<?php echo 'cgst_'.$serial; ?>" style="width:40px;border:none;" />
						<input type="hidden" name="item_cgst1[]" value="<?php echo $invoice_cgst1; ?>" id="<?php echo 'cgst1_'.$serial; ?>" />	
						<label id="<?php echo 'for_sgst_'.$serial; ?>" style="width:40px;font-size:12px;color:#423C9B;">SGST : </label>
						<input type="text" name="item_sgst[]" oninput="for_total(<?php echo $serial; ?>);" value="<?php echo $invoice_sgst; ?>" id="<?php echo 'sgst_'.$serial; ?>" style="width:40px;border:none;" />
						<input type="hidden" name="item_sgst1[]" value="<?php echo $invoice_sgst1; ?>" id="<?php echo 'sgst1_'.$serial; ?>" />
						<label id="<?php echo 'for_igst_'.$serial; ?>" style="width:40px;font-size:12px;color:#423C9B;">IGST : </label>
						<input type="text" name="item_igst[]" id="<?php echo 'igst_'.$serial; ?>" value="<?php echo $invoice_igst; ?>" oninput="for_total(<?php echo $serial; ?>);" style="width:40px;border:none;" />
						<input type="hidden" name="item_igst1[]" value="<?php echo $invoice_igst1; ?>" id="<?php echo 'igst1_'.$serial; ?>" />
					 </div></div>
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_tax_amount[]" id="<?php echo 'tax_amount_'.$serial; ?>" value="<?php echo $invoice_tax; ?>" class="form-control" />
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_total_amount[]" class="form-control amt" id="<?php echo 'item_total_'.$serial; ?>" value="<?php echo $invoice_total; ?>"  style="border:none;" />
					</div>
					</td>
					<td>
					<div>
					<label><i class="fa fa-times form-control" style="color:red;border:none;" onclick="delete_fromdb(<?php echo $serial; ?>);for_delete(<?php echo $serial; ?>);" aria-hidden="true"></i></label>
					</div>
					</td>
					</tr>
					</tbody>
        </table>
			<?php } ?>
		 </div>
		<br />
			<button type="button" style="background-color:#00a65a" class="btn btn-info" id='addmore'>+ Add More</button>
			<br/>
			<br/>
			<br/>
			<script>
			var c = document.getElementById("sample2").value;
			$("#addmore").on('click',function(){
				var i = 2;
			var count = c++;
			var count = c;
			var data="<input type='hidden' id='sample2' value='"+count+"' /><table class='table table-bordered' style='background-color:white;' id='table_"+count+"'><thead class='my_background_color'><tr id='row_"+count+"'><th style='width:50px;'>S.No.</th><th style='width:200px;'>Scan Barcode</th><th style='width:200px;'>Item </th><th style='width:70px;'>Quantity</th><th style='width:70px;'>Box Quantity</th><th style='width:70px;'>Rate (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:70px;'>Fix Rate (<i class='fa fa-inr' aria-hidden='true'>)</th></tr></thead><tbody><tr><td><span id='snum_"+count+"' class='snm'>"+count+".</span></td><td><div><input type='text' name='barcode_no' placeholder='Scan Item' onblur='get_barcode(this.value,"+count+");' value='' class='form-control'></div></td><td><div class='form-group'><select name='item_product_name[]' id='item_product_name_"+count+"' style='width:100%;' class='form-control select2' onchange='item_desc(this.value,"+count+");' required><option value=''>Select</option><?php $query="select * from item_master where item_status='Active'";$res=mysql_query($query);while($row=mysql_fetch_array($res)){ $s_no=$row['s_no'];$item_product_name=$row['item_product_name'];$barcode_no=$row['barcode_no']; ?><option value='<?php echo $s_no; ?>'><?php echo '['.$barcode_no.']'; ?><?php echo $item_product_name; ?></option><?php } ?></select></div><div><label id='for_desc_"+count+"' style='display:none;padding:0px;margin:0px;font-size:12px;color:#423C9B;'>Description : </label><textarea name='item_description[]' id='desc_"+count+"' class='form-control' style='display:none;border-color: Transparent;padding:0px;margin:0px;' rows='1' ></textarea>	</div>	<div><label id='for_hsn_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>HSN : </label><input type='text' name='item_hsn[]' id='hsn_"+count+"' style='display:none;border:none;' /></div><input type='hidden' name='click' id='click_"+count+"' onclick='for_total("+count+");'></td><td><div><input type='number' name='item_quantity[]' id='quantity_"+count+"' class='form-control' value='1' oninput='for_total("+count+");' /></div><div><label id='for_abl_quantity_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>AVL : </label><input type='number' name='item_avail_quantity[]' id='abl_quantity_"+count+"' min='<?php 
			   if(isset($_GET['inv_type'])){ if($inv_type=='sales'){ echo 1; } }else{ echo 1; } ?>' style='width:50px;display:none;border:none;' /></div></td> <td><div><input type='number' name='box_quantity[]' id='box_"+count+"' class='form-control' value='1' /></div></td><td><div><input type='number' name='item_price[]' step='0.01' id='price_"+count+"' class='form-control' oninput='for_total("+count+");' /><input type='hidden' name='item_price1[]' id='price1_"+count+"' class='form-control' /></div><div>	<label id='for_unit_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>UNIT : </label><input type='text' name='item_unit[]' id='unit_"+count+"' style='width:60px;display:none;border:none;' readonly /></div></td><td><div><input type='text' name='item_price_fix[]' id='price_fix_"+count+"' class='form-control' oninput='fix_rate("+count+",this.value);' /></div></td></tr></tbody><tbody><tr><th style='width:70px;'>Discount(%/Rs)</th><th style='width:70px;'>Taxable (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:70px;'>Tax Type</th><th style='width:70px;'>Tax Amount</th><th style='width:100px;'>Total (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:20px;'></th></tr><tr><td><div class='input-group'><input type='text' name='item_discount[]' id='discount_"+count+"' value='0' class='form-control' oninput='for_total("+count+");' /><span class='input-group-addon' style='padding:0px;'><select name='item_discount_type[]' id='discount_type_"+count+"' style='border:none;' onchange='for_click("+count+");'><option value='%'>%</option><option value='Rs'>Rs</option></select></span></div></td><td><div><input type='text' name='item_taxable[]' id='taxable_"+count+"' class='form-control' /></div></td><td><div><select name='item_tax_type[]' class='form-control' onchange='for_tax("+count+");' id='tax_type_"+count+"'><option value='CGST&SGST'>CGST&SGST </option><option value='IGST'>IGST</option></select><label id='for_cgst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>CGST : </label><input type='text' name='item_cgst[]' oninput='for_total("+count+");' id='cgst_"+count+"' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_cgst1[]' id='cgst1_"+count+"' /><label id='for_sgst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>SGST : </label><input type='text' name='item_sgst[]' oninput='for_total("+count+");' id='sgst_"+count+"' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_sgst1[]' id='sgst1_"+count+"' /><label id='for_igst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>IGST : </label><input type='text' name='item_igst[]' id='igst_"+count+"' oninput='for_total("+count+");' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_igst1[]' id='igst1_"+count+"' /></div></td><td><div><input type='text' name='item_tax_amount[]' id='tax_amount_"+count+"' class='form-control' /></div></td><td><div><input type='text' name='item_total_amount[]' class='form-control amt' id='item_total_"+count+"'  style='border:none;' /></div></td><td><div id='icon_"+count+"'><label><i class='fa fa-times form-control' style='color:red;border:none;' onclick='for_delete("+count+");' aria-hidden='true'></i></label></div></td></tr></tbody> </label></table>";
			$('#item_table').append(data);
			i++;
			$('.select2').select2();
			});
			function for_delete(sno){
			if(sno>1){
			var my_sno=sno-1;
			var my_sno2 =sno+1;
			$('#table_'+sno).remove();
			$('#icon_'+sno).remove();
			$('#click_'+my_sno).click();
			document.getElementById("sample2").value=my_sno;
			var count1=1;
			$('.snm').each(function() {
			$(this).html(count1);
			count1++;
			});
			}
			}
			</script>
	</div>
	
			<div class="col-lg-12" style="display:none;">
						<div class="form-group col-lg-5">
						 <label > Extra Expences </label>
							<input type="number" name="invoice_extra_expences" id="invoice_extra_expences" placeholder="Enter Extra Expences"  value="<?php echo $invoice_extra_expences; ?>" class="form-control amt" oninput="for_grandtotal();">
							
							<input type="hidden" id="click_total" onclick="for_grandtotal();">
						</div>
				</div>
				<div class="col-lg-12">
						<div class="form-group col-lg-5">
						<label > Discount ( % / Rs ) </label>
						<div class="input-group" >
						<input type="number" name="total_invoice_discount" id="total_invoice_discount" placeholder="Enter Discount Amount"  value="<?php echo $invoice_total_discount; ?>" class="form-control" oninput="for_grandtotal();">
						
						<span class="input-group-addon" style="padding:0px;">
						<select name="total_discount_type" id="total_discount_type" style="border:none;" onchange="for_grandtotal();">
						<option <?php if($invoice_total_discount_type=='%'){ echo 'selected'; } ?> value="%">%</option>
						<option <?php if($invoice_total_discount_type=='Rs'){ echo 'selected'; } ?> value="Rs">Rs</option>
						</select>
						</span>
						</div>
						</div>
				</div>
				
				<div class="col-lg-12" style="display:none;">
						<div class="form-group col-lg-5">
						<label > Sub Total </label>
							<input type="text" name="invoice_sub_total" id="invoice_sub_total" placeholder="Sub Total"  value="<?php echo $invoice_sub_total; ?>" class="form-control" readonly style="border:none;" />
						</div>
				</div>
				<div class="col-lg-12">
						<div class="form-group col-lg-5">
						<label > Grand Total </label>
							<input type="text" name="invoice_grand_total" id="invoice_grand_total" placeholder="Grand Total"  value="<?php echo $invoice_grand_total; ?>" class="form-control" readonly />
						</div>
				</div>
			<?php if($payment_count>1) {  ?>
			<div class="col-md-12">
			</div>
			<?php } ?>
			<div class="col-md-12" style="display:none;">
				    <div class="form-group col-lg-5">
						<label> Total Paid </label>
						<input type="number" name="invoice_total_paid" id="invoice_total_paid" placeholder="Total Paid"  value="<?php echo $invoice_total_paid; ?>" class="form-control" oninput="for_grandtotal();for_condition();"  <?php if($payment_count>1) { echo "readonly"; }  ?>>
					</div>	
			</div>
			<div class="col-lg-12" style="display:none;">
					<div class="form-group col-lg-5">
					<label > Due Amount </label>
						<input type="text" name="invoice_due_amount" id="invoice_due_amount" placeholder="Due Amount"  value="<?php echo $invoice_due_amount; ?>" class="form-control" readonly style="border:none;" />
					</div>
			</div>
				<div class="col-lg-12" style="display:none">
					<div class="form-group col-lg-5">
					 <label> Payment Mode </label>
						<select class="form-control select2" name="invoice_payment_mode" id="invoice_payment_mode" onchange="payment_detail(this.value);for_condition();" style="width:100%">
						<option value="">Select</option>
						<?php
						$query4="select * from bank_or_credit_card_info where bank_status='Active'";
						$res4=mysql_query($query4);
						while($row4=mysql_fetch_array($res4)){
						$s_no=$row4['s_no'];
						$bank_account_type=$row4['bank_account_type'];
						$bank_account_name=$row4['bank_account_name'];
						$credit_card_account_name=$row4['credit_card_account_name'];
						$payment_method=$bank_account_type.'['.$bank_account_name.']';
						if($bank_account_type=='Credit_Card'){
						$payment_method=$bank_account_type.'['.$credit_card_account_name.']';
						}
						if($bank_account_name=='Undeposited Funds'){
						$payment_method='Cheque/DD';
						}
						?>
						<option value="<?php echo $s_no; ?>"><?php echo $payment_method; ?></option>
						<?php
						}
						?>
						</select>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5" style="display:none;" id="for_account_type">
						<label > Account Type </label>
						<input type="text" name="account_type" id="account_type" value="" class="form-control" readonly />
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5" style="display:none;" id="for_account_name">
						<label > Account Name </label>
						<input type="text" name="account_name" id="account_name" value="" class="form-control" readonly />
					</div>
				</div>
				<div class="col-lg-12">
						<div class="form-group col-lg-5" style="display:none;" id="for_cheque_dd">
							<label > Cheque / DD </label>
							<select name="cheque_dd" id="cheque_dd" class="form-control">
							<option value="">Select</option>
							<option value="Cheque">Cheque</option>
							<option value="DD">DD</option>
							</select>
						</div>
				</div>
				<div class="col-lg-12">
						<div class="form-group col-lg-5" style="display:none;" id="for_cheque_dd_no">
							<label ><small> Cheque / DD No </small></label>
							<input type="text" name="cheque_dd_no" id="cheque_dd_no" value="" class="form-control" />
						</div>
				</div>
				<div class="col-lg-12">
			        <div class="form-group col-lg-5" style="display:none;" id="for_remark" >
						<label> Remarks </label>
						<input type="text" name="remark" id="remark" placeholder="Remarks" value="" class="form-control" />
					</div>
				</div>
				<div class="col-lg-12">
						<div class="form-group col-lg-5" style="display:none;" id="for_cheque_dd_amount" >
							<label > Cheque / DD Amount </label>
							<input type="number" name="cheque_dd_amount" id="cheque_dd_amount" placeholder="Amount"  value="" class="form-control" style="border:none;" />
						</div>
				</div>
				<div class="col-lg-12">
						<div class="form-group col-lg-5" style="display:none;" id="for_cheque_dd_issue_date" >
							<label > Cheque / DD Issue Date </label>
							<input type="date" name="cheque_dd_issue_date" id="cheque_dd_issue_date" placeholder="Issue Date" value="" class="form-control" style="border:none;" />
						</div>
				</div>
				<div class="col-md-12">
						<div class="form-group col-lg-5" style="display:none;" id="for_cheque_dd_clearing_date" >
							<label> Cheque / DD Clearing Date </label>
							<input type="date" name="cheque_dd_clearing_date" id="cheque_dd_clearing_date" placeholder="Clearing Date" value="" class="form-control" style="border:none;" />
						</div>
				</div>
				<div class="col-md-12">
						<div class="form-group col-lg-4">
							<label> Upload File <small style="color:red;">( If So )</small> </label>
							<input type="file"  id="upload_file" name="upload_file"  value="" onchange="check_file_type(this,'upload_file','show_application','all');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc">
						</div>
						<div class="form-group col-lg-1">
						 <img src="" id="show_application" height="60" width="50" >	
						</div>
				</div>
	
			<div class="col-md-12">
			<div class="col-md-3">
            <div class="form-group">
			</div>
			</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-3">
			<div class="form-group" >		
			</div>
			</div>
			</div>
			
			<div class="col-md-12">			
			<?php
			$query3="select * from user_details";
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
			<div class="col-md-3">		
			<div class="form-group">
			  <label>Customer Notes</label>
			   <textarea name="invoice_customer_notes" id="invoice_customer_notes" rows="5" cols="200" style="width:260px" class="form-control"></textarea>
			</div>
			</div>
			</div>

		<div class="box-footer">
					<div class="col-md-12">
					<br/>
					<br/>
					<div class="col-md-2"></div>	
					<div class="col-md-4">
					<div class="form-group">
						<input type="submit" name="save" value="Shipped" class="form-control .btn-default">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group" >
						<input type="reset" name="cancel" value="Cancel" class="form-control .btn-default">
					</div>
					</div>
					<div class="col-md-2"></div>
					</div>
			</div>

<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
    </div>
</section>
</form>	
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->

 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("link_js.php")?>
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
if(isset($_POST['save'])){
$invoice_no=$_POST['invoice_no'];
$shipping_no = $_POST['shipping_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_date=$_POST['invoice_date'];
$invoice_transport_name = $_POST['invoice_transport_name'];
$tracking_no = $_POST['invoice_tracking'];
$shipping_charge = $_POST['invoice_shipping_charge'];
$invoice_type="sales";
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
$invoice_sub_total=$_POST['invoice_sub_total'];
$total_invoice_discount=$_POST['total_invoice_discount'];
$total_discount_type=$_POST['total_discount_type'];
$invoice_grand_total=$_POST['invoice_grand_total'];
$invoice_payment_mode=$_POST['invoice_payment_mode'];
$invoice_total_paid=$_POST['invoice_total_paid'];
$remark=$_POST['remark'];
$invoice_due_amount=$_POST['invoice_due_amount'];
$invoice_customer_notes=$_POST['invoice_customer_notes'];
$invoice_terms_and_conditions=$_POST['invoice_terms_and_conditions'];
$account_type=$_POST['account_type'];
$account_name=$_POST['account_name'];
$cheque_dd=$_POST['cheque_dd'];
$cheque_dd_no=$_POST['cheque_dd_no'];
$cheque_dd_amount=$_POST['cheque_dd_amount'];
$cheque_dd_issue_date=$_POST['cheque_dd_issue_date'];
$cheque_dd_clearing_date=$_POST['cheque_dd_clearing_date'];
$upload_file_name=$_FILES['upload_file']['name'];            
$upload_file_temp=$_FILES['upload_file']['tmp_name'];
$table_name='packages_invoice_info';
$page_name='packages_invoice_list.php';
$transaction_type='Credit';
$stock_quantity_rate_update='';
$box_num = $_POST['box_quantity'];
$save=0;
$count=count($item_product_name);
for($i=0; $i<$count; $i++){
 $query="update $table_name set invoice_no='$invoice_no',shipping_no='$shipping_no',invoice_date='$invoice_date',invoice_product_name='$item_product_name[$i]',invoice_description='$item_description[$i]',
invoice_hsn='$item_hsn[$i]',invoice_quantity='$item_quantity[$i]',invoice_available_quantity='$item_avail_quantity[$i]',invoice_item_unit='$item_unit[$i]',invoice_rate='$item_price[$i]',
invoice_rate1='$item_price1[$i]',invoice_price_fix='$item_price_fix[$i]',invoice_discount='$item_discount[$i]',invoice_discount_type='$item_discount_type[$i]',invoice_taxable='$item_taxable[$i]',
invoice_tax_type='$item_tax_type[$i]',invoice_tax='$item_tax_amount[$i]',invoice_cgst='$item_cgst[$i]',invoice_cgst1='$item_cgst1[$i]',invoice_sgst='$item_sgst[$i]',invoice_sgst1='$item_sgst1[$i]',
invoice_igst='$item_igst[$i]',invoice_igst1='$item_igst1[$i]',invoice_total='$item_total_amount[$i]',invoice_extra_expences='$invoice_extra_expences',invoice_sub_total='$invoice_sub_total',
invoice_total_discount='$total_invoice_discount',invoice_total_discount_type='$total_discount_type',invoice_grand_total='$invoice_grand_total',invoice_payment_mode='$invoice_payment_mode',
invoice_total_paid='$invoice_total_paid',invoice_customer_notes='$invoice_customer_notes',
invoice_type='sales',invoice_status='Active',invoice_shipping_charge='$shipping_charge',order_status='Shipped' ,box_num='$box_num[$i]' where invoice_no='$invoice_no'"; 
if(mysql_query($query)){
$save++;
}
if($invoice_type=='sales'){
$que4="select * from item_master where s_no='$item_product_name[$i]'";
$res4=mysql_query($que4);
$row4=mysql_fetch_array($res4);
$stock_item_quantity=$row4['item_quantity'];
$stock_item_quantity=$stock_item_quantity-$item_quantity[$i];
$que5="update item_master set item_quantity='$stock_item_quantity' where s_no='$item_product_name[$i]'";
mysql_query($que5);
}
}
$path="../../documents/upload_file/".$folder_id;
if(!is_dir($path)){
mkdir($path, 0755, true);
}
move_uploaded_file($upload_file_temp,$path."/$upload_file_name");

$folder_id=$folder_id+1;
if($invoice_type=='sales'){
$shipping_invoice_no=$shipping_invoice_no+1;
}else{
$shipping_invoice_no=$shipping_invoice_no;
}
$que2="update invoice_no set folder_id='$folder_id',shipping_invoice_no='$shipping_invoice_no'";
mysql_query($que2);

if($save>0){
echo "<script>window.open('$page_name','_self');</script>";
}
}

?>
