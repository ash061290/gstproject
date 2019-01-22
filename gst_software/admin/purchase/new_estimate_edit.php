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

  <?php include("../attachment/header.php"); ?>
  <?php include("../attachment/sidebar.php"); ?>
  <?phpinclude("../../attachment/session.php"); ?>

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
  var admin_place=document.getElementById('admin_place_of_supply').value;
  if(document.getElementById('inv_type_1').checked){
  var inv_type=document.getElementById('inv_type_1').value;
  }else if(document.getElementById('inv_type_2').checked){
  var inv_type=document.getElementById('inv_type_2').value;
  }
  $.ajax({
			address: "POST",
			url: software_link+"purchase/ajax_get_item_description.php?value="+value+"&inv_type="+inv_type+"",
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
			if(place_of_supply==admin_place){
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
  function payment_detail(value){
  if(value!=''){
	$.ajax({
		address: "POST",
		url: software_link+"purchase/get_payment_details.php?id="+value+"",
		cache: false,
		success: function(detail){
		var res = detail.split("|?|");
		var myvar=res[0];
		var myvar1=res[1];
		if(parseInt(value)==3 || parseInt(value)==4){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}else if(parseInt(value)==5){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}else if(parseInt(value)==2){
		$('#for_account_type').show();
		$('#account_type').val(res[0]).prop('required',true);
		$('#for_account_name').show();
		$('#account_name').val(res[1]).prop('required',true);
		$('#for_cheque_dd').show();
		$('#cheque_dd').val('').prop('required',true);
		$('#for_cheque_dd_no').show();
		$('#cheque_dd_no').val('').prop('required',true);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_cheque_dd_amount').show();
		$('#cheque_dd_amount').val('').prop('required',true);
		$('#for_cheque_dd_issue_date').show();
		$('#cheque_dd_issue_date').val('').prop('required',true);
		$('#for_cheque_dd_clearing_date').show();
		$('#cheque_dd_clearing_date').val('').prop('required',true);
		}else if(parseInt(value)==1){
		$('#for_account_type').hide();
		$('#account_type').val('').prop('required',false);
		$('#for_account_name').hide();
		$('#account_name').val('').prop('required',false);
		$('#for_cheque_dd').hide();
		$('#cheque_dd').val('').prop('required',false);
		$('#for_cheque_dd_no').hide();
		$('#cheque_dd_no').val('').prop('required',false);
		$('#for_remark').show();
		$('#remark').val('');
		$('#for_cheque_dd_amount').hide();
		$('#cheque_dd_amount').val('').prop('required',false);
		$('#for_cheque_dd_issue_date').hide();
		$('#cheque_dd_issue_date').val('').prop('required',false);
		$('#for_cheque_dd_clearing_date').hide();
		$('#cheque_dd_clearing_date').val('').prop('required',false);
		}
		}
	});
  }else{
	$('#for_account_type').hide();
	$('#account_type').val('').prop('required',false);
	$('#for_account_name').hide();
	$('#account_name').val('').prop('required',false);
	$('#for_cheque_dd').hide();
	$('#cheque_dd').val('').prop('required',false);
	$('#for_cheque_dd_no').hide();
	$('#cheque_dd_no').val('').prop('required',false);
	$('#for_remark').hide();
	$('#remark').val('');
	$('#for_cheque_dd_amount').hide();
	$('#cheque_dd_amount').val('').prop('required',false);
	$('#for_cheque_dd_issue_date').hide();
	$('#cheque_dd_issue_date').val('').prop('required',false);
	$('#for_cheque_dd_clearing_date').hide();
	$('#cheque_dd_clearing_date').val('').prop('required',false);
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
			$('#invoice_shipping_address').val(res[2]);
			$('#invoice_billing_address').val(res[2]);
			$("#invoice_place_of_supply").val(res[1]).change();
			$('#invoice_gstin_no').val(res[0]);
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
  $.ajax({
		address: "POST",
		url: software_link+"purchase/ajax_get_admin_place_of_supply.php",
		cache: false,
		success: function(detail){
		var res = detail.split("|?|");
		$('#admin_place_of_supply').val(res[1]);
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
	
	
	function delete_fromdb(sno){
	var inv_sno=document.getElementById('invoice_s_no_'+sno).value;
	var delete_item=document.getElementById('invoice_delete_items').value;
	var delete_count=document.getElementById('invoice_delete_items_count').value;
	var delete_count1=0;
	if(delete_item!='' && delete_count!=''){
	var delete_item1=delete_item+''+inv_sno+',';
	delete_count1=parseInt(delete_count)+1;
	$('#invoice_delete_items').val(delete_item1);
	$('#invoice_delete_items_count').val(delete_count1);
	}else{
	var delete_item1=inv_sno+',';
	delete_count1=parseInt(delete_count)+1;
	$('#invoice_delete_items').val(delete_item1);
	$('#invoice_delete_items_count').val(delete_count1);
	}
	}
	
	function for_condition(){
	var pay_mode=document.getElementById('invoice_payment_mode').value;
	var tot_paid=document.getElementById('invoice_total_paid').value;
	if(pay_mode!='' || tot_paid!=''){
	$('#invoice_payment_mode').prop('required',true);
	$('#invoice_total_paid').prop('required',true);
	}else{
	$('#invoice_payment_mode').prop('required',false);
	$('#invoice_total_paid').prop('required',false);
	}
	}
	
	function get_barcode(value,id){
       $.ajax({
			  type: "POST",
              url: software_link+"purchase/ajax_get_data_by_barcode.php?barcode="+value+"",
              cache: false,
              success: function(detail){
              $('#item_product_name_'+id).html(detail);
              }
           });
    }
	
  </script>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Estimate
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-plus"></i> Add Estimate</a></li>
        <li class="active"><i class="fa fa-pencil"></i> Edit Estimate</a></li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	<?php
	$estimate_no=$_GET['estimate_no'];
	$estimate_type=$_GET['estimate_type'];
	if($estimate_type=='sales'){
	$table_name='sales_estimate_info';
	}elseif($estimate_type=='purchase'){
	$table_name='purchase_estimate_info';
	$table_name2 ='purchase_estimate_draft_info';
	}
	$que11="select * from $table_name where invoice_no='$estimate_no' and invoice_status='Active'";
	$run11=mysql_query($que11) or die(mysql_error());
	$numrow = mysql_num_rows($run11);
	if($numrow<1){
		 $que11="select * from $table_name2 where invoice_no='$estimate_no' and invoice_status='Active'";
	     $run11=mysql_query($que11) or die(mysql_error());
	}
	while($row11=mysql_fetch_array($run11)){
			$s_no=$row11['s_no'];
			$sales_person_name =$row11['sales_person_name'];
			$project_name = $row11['project_name'];
			$invoice_no=$row11['invoice_no'];
			$invoice_date=$row11['invoice_date'];
			$invoice_reference=$row11['invoice_reference'];
			$invoice_due_date=$row11['invoice_due_date'];
			$invoice_firm_name=$row11['invoice_firm_name'];
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
			$invoice_order_no=$row11['invoice_order_no'];
			$account_type=$row11['account_type'];
			$account_name=$row11['account_name'];
			$cheque_dd=$row11['cheque_dd'];
			$cheque_dd_no=$row11['cheque_dd_no'];
			$cheque_dd_amount=$row11['cheque_dd_amount'];
			$cheque_dd_issue_date=$row11['cheque_dd_issue_date'];
			$cheque_dd_clearing_date=$row11['cheque_dd_clearing_date'];
			$transaction_type=$row11['transaction_type'];
	}
	?>
    <!-- Main content -->
	<form method="post" onsubmit="return validate();" enctype="multipart/form-data">
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title" style="color:red">Estimate</h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
    
	<div class="box-body">
		
				<div class="col-md-12">
				<div class="form-group col-md-5">
					<label >Estimate Type&nbsp;:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="invoice_type" id="inv_type_1" value="purchase" <?php if($estimate_type=='purchase'){ echo 'checked'; }else{ echo 'disabled'; } ?> >&nbsp;&nbsp;<b>Purchase</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="invoice_type" id="inv_type_2" value="sales" <?php if($estimate_type=='sales'){ echo 'checked'; }else{ echo 'disabled'; } ?> >&nbsp;&nbsp;<b>Sales</b>
					</div>
				</div>
				<div class="col-md-12 ">				
					<div class="form-group col-md-5" >
					  <label>Firm Name <span style="color:red;">*</span></label>
					  <select name="invoice_firm_name" class="form-control select2" id="invoice_firm_name" onchange="firm_info(this.value);" style="width:100%" required>
					  <option value="">Select Firm</option>
					        <?php
							$qry="select * from contact_master where contact_status='Active'";
							$rest=mysql_query($qry);
							while($row22=mysql_fetch_array($rest)){
							$s_no=$row22['s_no'];
							$contact_company_name=$row22['contact_company_name'];
							$contact_first_name=$row22['contact_first_name'];
							$contact_last_name=$row22['contact_last_name'];
							?>
							<option <?php if($s_no==$invoice_firm_name){ echo "selected"; } ?> value="<?php echo $s_no; ?>"><?php echo $contact_company_name; ?><?php echo "[".$contact_first_name." ".$contact_last_name."]"; ?></option>
							<?php
							}
							?>
					  </select>
					  
					  
					<br><br>
					<a href="../contact/contact.php?invoice_edit=new_estimate_edit&estimate_no=<?php echo $estimate_no; ?>&estimate_type=<?php echo $estimate_type; ?>"><button type="button" style="background-color:#00a65a; color:white" class="">+ New Contact</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
					<input type="submit" name="edit_firm" style="background-color:#00a65a; color:white" value="Edit Firm" class="" />
					<br><br>			
					
					<input type="hidden" name="invoice_delete_items" id="invoice_delete_items" value="" />
					<input type="hidden" name="invoice_delete_items_count" id="invoice_delete_items_count" value="0" />
					</div>
				</div>
				<div class="col-md-12">
						<div class="form-group col-md-5">
						  <label>Estimate No.</label>
						   <input type="text" name="invoice_no" placeholder="" value="<?php echo $invoice_no; ?>" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-12 ">	
					<div class="form-group col-md-5" >
					  <label>Estimate Date</label>
					  <input type="date" name="invoice_date" placeholder="Date" value="<?php echo $invoice_date; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-12 ">		
						<div class="form-group col-md-5">
						  <label>Reference</label>
						   <input type="text" name="invoice_reference" placeholder="Add Reference" value="<?php echo $invoice_reference; ?>" class="form-control">
						</div>
					</div>
				<div class="col-md-12 ">	
					<div class="form-group col-md-5" >
					  <label>Expiry Date</label>
					  <input type="date" name="invoice_due_date" placeholder="Date" value="<?php echo $invoice_due_date; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-12 ">	
					<div class="form-group col-md-5" >
					  <label>Sales Person</label>
					  <input type="text" name="sales_person_name" placeholder="Sales Person Name" value="<?php echo $sales_person_name; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-12 ">	
					<div class="form-group col-md-5" >
					  <label>Project Name</label>
					  <input type="text" name="project_name" placeholder="Project Name" value="<?php echo $project_name; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">				
					<div class="col-md-12 ">
					<div class="form-group" >
					  <label >GSTIN No</label>
					  <input type="text" name="invoice_gstin_no" placeholder="Add GSTIN" id="invoice_gstin_no" value="<?php echo $invoice_gstin_no; ?>" class="form-control">
					</div>
					</div>
					<div class="col-md-12 ">			
					<div class="form-group" >
					  <label >Place Of Supply <span style="color:red;">*</span></label>
					  <select class="form-control select2" name="invoice_place_of_supply" id="invoice_place_of_supply" onchange="place_ofsupply(this.value);" style="width:100%" required>
					        <option <?php if($invoice_place_of_supply==''){ echo "selected"; } ?> value="">Select</option>
					        <option <?php if($invoice_place_of_supply=='Andaman and Nicobar Islands'){ echo "selected"; } ?> value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
							<option <?php if($invoice_place_of_supply=='Andhra Pradesh'){ echo "selected"; } ?> value="Andhra Pradesh">Andhra Pradesh</option>
							<option <?php if($invoice_place_of_supply=='Assam'){ echo "selected"; } ?> value="Assam">Assam</option>
							<option <?php if($invoice_place_of_supply=='Bihar'){ echo "selected"; } ?> value="Bihar">Bihar</option>
							<option <?php if($invoice_place_of_supply=='Chandigarh'){ echo "selected"; } ?> value="Chandigarh">Chandigarh</option>
							<option <?php if($invoice_place_of_supply=='Chattisgarh'){ echo "selected"; } ?> value="Chattisgarh">Chattisgarh</option>
							<option <?php if($invoice_place_of_supply=='Dadra Nagar Haveli'){ echo "selected"; } ?> value="Dadra Nagar Haveli">Dadra Nagar Haveli</option>
							<option <?php if($invoice_place_of_supply=='Daman and Diu'){ echo "selected"; } ?> value="Daman and Diu">Daman and Diu</option>
							<option <?php if($invoice_place_of_supply=='Delhi'){ echo "selected"; } ?> value="Delhi">Delhi</option>
							<option <?php if($invoice_place_of_supply=='Goa'){ echo "selected"; } ?> value="Goa">Goa</option>
							<option <?php if($invoice_place_of_supply=='Gujrat'){ echo "selected"; } ?> value="Gujrat">Gujrat</option>
							<option <?php if($invoice_place_of_supply=='Haryana'){ echo "selected"; } ?> value="Haryana">Haryana</option>
							<option <?php if($invoice_place_of_supply=='Himachal Pradesh'){ echo "selected"; } ?> value="Himachal Pradesh">Himachal Pradesh</option>
							<option <?php if($invoice_place_of_supply=='Jammu & Kashmir'){ echo "selected"; } ?> value="Jammu & Kashmir">Jammu & Kashmir</option>
							<option <?php if($invoice_place_of_supply=='Karnataka'){ echo "selected"; } ?> value="Karnataka">Karnataka</option>
							<option <?php if($invoice_place_of_supply=='Kerala'){ echo "selected"; } ?> value="Kerala">Kerala</option>
							<option <?php if($invoice_place_of_supply=='Lakshadweep'){ echo "selected"; } ?> value="Lakshadweep">Lakshadweep</option>
							<option <?php if($invoice_place_of_supply=='Madhya Pradesh'){ echo "selected"; } ?> value="Madhya Pradesh">Madhya Pradesh</option>
							<option <?php if($invoice_place_of_supply=='Maharashtra'){ echo "selected"; } ?> value="Maharashtra">Maharashtra</option>
							<option <?php if($invoice_place_of_supply=='Manipur'){ echo "selected"; } ?> value="Manipur">Manipur</option>
							<option <?php if($invoice_place_of_supply=='Meghalaya'){ echo "selected"; } ?> value="Meghalaya">Meghalaya</option>
							<option <?php if($invoice_place_of_supply=='Mizoram'){ echo "selected"; } ?> value="Mizoram">Mizoram</option>
							<option <?php if($invoice_place_of_supply=='Nagaland'){ echo "selected"; } ?> value="Nagaland">Nagaland</option>
							<option <?php if($invoice_place_of_supply=='Orissa'){ echo "selected"; } ?> value="Orissa">Orissa</option>
							<option <?php if($invoice_place_of_supply=='Outside India'){ echo "selected"; } ?> value="Outside India">Outside India</option>
							<option <?php if($invoice_place_of_supply=='Pondicherry'){ echo "selected"; } ?> value="Pondicherry">Pondicherry</option>
							<option <?php if($invoice_place_of_supply=='Punjab'){ echo "selected"; } ?> value="Punjab">Punjab</option>
							<option <?php if($invoice_place_of_supply=='Rajasthan'){ echo "selected"; } ?> value="Rajasthan">Rajasthan</option>
							<option <?php if($invoice_place_of_supply=='Sikkim'){ echo "selected"; } ?> value="Sikkim">Sikkim</option>
							<option <?php if($invoice_place_of_supply=='Tamil Nadu'){ echo "selected"; } ?> value="Tamil Nadu">Tamil Nadu</option>
							<option <?php if($invoice_place_of_supply=='Telangana'){ echo "selected"; } ?> value="Telangana">Telangana</option>
							<option <?php if($invoice_place_of_supply=='Tripura'){ echo "selected"; } ?> value="Tripura">Tripura</option>
							<option <?php if($invoice_place_of_supply=='Uttar Pradesh'){ echo "selected"; } ?> value="Uttar Pradesh">Uttar Pradesh</option>
							<option <?php if($invoice_place_of_supply=='Uttarakhand'){ echo "selected"; } ?> value="Uttarakhand">Uttarakhand</option>
							<option <?php if($invoice_place_of_supply=='West Bengal'){ echo "selected"; } ?> value="West Bengal">West Bengal</option>
					  </select>
						<?php
						$qryad="select * from invoice_no";
						$restad=mysql_query($qryad);
						while($rowad=mysql_fetch_array($restad)){
						$admin_place_of_supply=$rowad['admin_place_of_supply'];
						}
						?>
					  <input type="hidden" name="" id="admin_place_of_supply" value="<?php echo $admin_place_of_supply; ?>" />
					</div>
					</div>
					
				</div>
				
				<div class="col-md-12 ">				
					<div class="form-group col-md-5" >
						<label >Billing Address</label>
						<textarea name="invoice_billing_address" id="invoice_billing_address" rows="5" class="form-control"><?php echo $invoice_billing_address; ?></textarea>
					</div>
				</div>
				<div class="col-md-12 ">				
					<div class="form-group col-md-5" >
						<label >Shipping Address</label>
						<textarea name="invoice_shipping_address" id="invoice_shipping_address" rows="5" class="form-control"><?php echo $invoice_shipping_address; ?></textarea>
					</div>
				</div>
	</div>
    </div>
    </div>
            <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered" style="background-color:white;">
            <thead class="my_background_color">
                <tr>
					<th style="width:50px;">#</th>
					<th style="width:200px;">Scan Barcode</th>
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
			<?php
			$que12="select * from $table_name where invoice_no='$estimate_no' and invoice_status='Active'";
			$run12=mysql_query($que12) or die(mysql_error());
			$numrow = mysql_num_rows($run12);
		 if($numrow<1){
		 $que12="select * from $table_name2 where invoice_no='$estimate_no' and invoice_status='Active'";
	     $run12=mysql_query($que12) or die(mysql_error());
	       }
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
			 <tr id="<?php echo 'row_'.$serial; ?>">
					<td><span id='<?php echo 'snum_'.$serial; ?>' class="snm"><?php echo $serial.'.'; ?></span><input type="hidden" name="invoice_s_no[]" id="<?php echo 'invoice_s_no_'.$serial; ?>" value="<?php echo $invoice_s_no; ?>" />
					</td>
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
					</div>
					<div>	
						<label id="<?php echo 'for_abl_quantity_'.$serial; ?>" style="font-size:12px;color:#423C9B;">AVL : </label>
						<input type="number" name="item_avail_quantity[]" id="<?php echo 'abl_quantity_'.$serial; ?>" value="<?php echo $invoice_available_quantity; ?>" min="<?php if($estimate_type=='sales'){ echo 1; } ?>" style="width:50px;border:none;" />
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
					<select name="item_tax_type[]" class="form-control" onchange="for_tax(<?php echo $serial; ?>);" id="<?php echo 'tax_type_'.$serial; ?>">
					<option <?php if($invoice_tax_type=="CGST&SGST"){ echo "selected"; } ?> value="CGST&SGST">CGST&SGST </option>
					<option <?php if($invoice_tax_type=="IGST"){ echo "selected"; } ?> value="IGST">IGST</option>
					</select>
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_tax_amount[]" id="<?php echo 'tax_amount_'.$serial; ?>" value="<?php echo $invoice_tax; ?>" class="form-control" />
					</div>
					<div>	
						<label id="<?php echo 'for_cgst_'.$serial; ?>" style="width:40px;font-size:12px;color:#423C9B;">CGST : </label>
						<input type="text" name="item_cgst[]" oninput="for_total(<?php echo $serial; ?>);" value="<?php echo $invoice_cgst; ?>" id="<?php echo 'cgst_'.$serial; ?>" style="width:40px;border:none;" />
						<input type="hidden" name="item_cgst1[]" value="<?php echo $invoice_cgst1; ?>" id="<?php echo 'cgst1_'.$serial; ?>" />
					</div>
					<div>	
						<label id="<?php echo 'for_sgst_'.$serial; ?>" style="width:40px;font-size:12px;color:#423C9B;">SGST : </label>
						<input type="text" name="item_sgst[]" oninput="for_total(<?php echo $serial; ?>);" value="<?php echo $invoice_sgst; ?>" id="<?php echo 'sgst_'.$serial; ?>" style="width:40px;border:none;" />
						<input type="hidden" name="item_sgst1[]" value="<?php echo $invoice_sgst1; ?>" id="<?php echo 'sgst1_'.$serial; ?>" />
					</div>
					<div>
						<label id="<?php echo 'for_igst_'.$serial; ?>" style="width:40px;font-size:12px;color:#423C9B;">IGST : </label>
						<input type="text" name="item_igst[]" id="<?php echo 'igst_'.$serial; ?>" value="<?php echo $invoice_igst; ?>" oninput="for_total(<?php echo $serial; ?>);" style="width:40px;border:none;" />
						<input type="hidden" name="item_igst1[]" value="<?php echo $invoice_igst1; ?>" id="<?php echo 'igst1_'.$serial; ?>" />
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
			<?php } ?>
			
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

			 data +="<td><div><input type='text' name='barcode_no' placeholder='Scan Item' onblur='get_barcode(this.value,"+count+");' value='' class='form-control'></div></td><td><div class='form-group'><select class='form-control select2' style='width:100%;' name='item_product_name[]' id='item_product_name_"+count+"' onchange='item_desc(this.value,"+count+");' required><option value=''>Select</option><?php $query='select * from item_master';$res=mysql_query($query);while($row=mysql_fetch_array($res)){$s_no=$row['s_no'];$item_product_name=$row['item_product_name'];$barcode_no=$row['barcode_no'];?><option value='<?php echo $s_no; ?>'><?php echo '['.$barcode_no.']'; ?><?php echo $item_product_name; ?></option><?php } ?></select></div><div><label id='for_desc_"+count+"' style='display:none;padding:0px;margin:0px;font-size:12px;color:#423C9B;'>Description : </label><textarea name='item_description[]' id='desc_"+count+"' class='form-control' style='display:none;border-color: Transparent;padding:0px;margin:0px;' rows='1' ></textarea></div><div><label id='for_hsn_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>HSN : </label><input type='text' name='item_hsn[]' id='hsn_"+count+"' style='display:none;border:none;' /></div><input type='hidden' name='click' id='click_"+count+"' onclick='for_total("+count+");'></td><td><div><input type='number' name='item_quantity[]' id='quantity_"+count+"' class='form-control' value='1' oninput='for_total("+count+");' /></div><div><label id='for_abl_quantity_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>AVL : </label><input type='number' name='item_avail_quantity[]' min='<?php if($estimate_type=='sales'){ echo 1; } ?>' id='abl_quantity_"+count+"' style='width:50px;display:none;border:none;' /></div></td><td><div><input type='number' name='item_price[]' id='price_"+count+"' class='form-control' oninput='for_total("+count+");' /><input type='hidden' name='item_price1[]' id='price1_"+count+"' class='form-control' ></div><div><label id='for_unit_"+count+"' style='display:none;font-size:12px;color:#423C9B;'>UNIT : </label><input type='text' name='item_unit[]' id='unit_"+count+"' style='width:60px;display:none;border:none;' readonly /></div></td><td><div><input type='text' name='item_price_fix[]' id='price_fix_"+count+"' class='form-control' oninput='fix_rate("+count+",this.value);' /></div></td><td><div class='input-group'><input type='text' name='item_discount[]' id='discount_"+count+"' value='0' class='form-control' oninput='for_total("+count+");' /><span class='input-group-addon' style='padding:0px;'><select name='item_discount_type[]' id='discount_type_"+count+"' style='border:none;' onchange='for_click("+count+");'><option value='%'>%</option><option value='Rs'>Rs</option></select></span></div></td><td><div><input type='text' name='item_taxable[]' id='taxable_"+count+"' class='form-control' /></div></td><td><div><select name='item_tax_type[]' class='form-control' onchange='for_tax("+count+");' id='tax_type_"+count+"'><option value='CGST&SGST'>CGST&SGST </option><option value='IGST'>IGST</option></select></div></td><td><div><input type='text' name='item_tax_amount[]' id='tax_amount_"+count+"' class='form-control' /></div><div><label id='for_cgst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>CGST : </label><input type='text' name='item_cgst[]' oninput='for_total("+count+");' id='cgst_"+count+"' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_cgst1[]' id='cgst1_"+count+"' /></div><div><label id='for_sgst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>SGST : </label><input type='text' name='item_sgst[]' oninput='for_total("+count+");' id='sgst_"+count+"' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_sgst1[]' id='sgst1_"+count+"' /></div><div><label id='for_igst_"+count+"' style='width:40px;display:none;font-size:12px;color:#423C9B;'>IGST : </label><input type='text' name='item_igst[]' id='igst_"+count+"' oninput='for_total("+count+");' style='width:40px;display:none;border:none;' /><input type='hidden' name='item_igst1[]' id='igst1_"+count+"' /></div></td><td><div><input type='text' name='item_total_amount[]' class='form-control amt' id='item_total_"+count+"' style='border:none;' /></div></td><td><div><label><i class='fa fa-times form-control' style='color:red;border:none;' onclick='for_delete("+count+");' aria-hidden='true'></i></label></div></td></tr>";

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
			for_grandtotal();
			}else{
			var my_sno=sno+1;
			$('#row_'+sno).remove();
			$('#click_'+my_sno).click();
			
			var count1=1;
			$('.snm').each(function() {
			$(this).html(count1);
			count1++;
			});
			for_grandtotal();
			}
			}
			</script>
	</div>
	
			<div class="col-md-12" style="display:none;">
			        <div class="form-group col-md-5" >
						<label > Extra Expences </label>
						<input type="number" name="invoice_extra_expences" id="invoice_extra_expences" placeholder="Enter Extra Expences"  value="<?php echo $invoice_extra_expences; ?>" class="form-control amt" oninput="for_grandtotal();">
						<input type="hidden" id="click_total" onclick="for_grandtotal();">
					</div>
			</div>
			
			<div class="col-md-12">
			        <div class="form-group col-md-5" >
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
			
			<div class="col-md-12">
			        <div class="form-group col-md-5" >
					<label > Sub Total </label>
						<input type="text" name="invoice_sub_total" id="invoice_sub_total" placeholder="Sub Total"  value="<?php echo $invoice_sub_total; ?>" class="form-control" readonly style="border:none;" />	
					</div>
			</div>
			
			<div class="col-md-12">
			        <div class="form-group col-md-5" >
						<label > Grand Total </label>
						<input type="text" name="invoice_grand_total" id="invoice_grand_total" placeholder="Grand Total"  value="<?php echo $invoice_grand_total; ?>" class="form-control" readonly style="border:none;" />
					</div>
			</div>
			<div class="col-md-12"  style="display:none;">
			        <div class="form-group col-md-5" >
					<label > Total Paid </label>
						<input type="number" name="invoice_total_paid" id="invoice_total_paid" placeholder="Total Paid"  value="<?php echo $invoice_total_paid; ?>" class="form-control" oninput="for_grandtotal();for_condition();" />	
					</div>
			</div>
			<div class="col-md-12"  style="display:none;">
			        <div class="form-group col-md-5">
					<label > Due Amount </label>
						<input type="text" name="invoice_due_amount" id="invoice_due_amount" placeholder="Due Amount"  value="<?php echo $invoice_due_amount; ?>" class="form-control" readonly style="border:none;" />	
					</div>
			</div>
			<div class="col-md-12"  style="display:none;">
			        <div class="form-group col-md-5">
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
						<option <?php if($s_no==$invoice_payment_mode){ echo "selected"; } ?> value="<?php echo $s_no; ?>"><?php echo $payment_method; ?></option>
						<?php
						}
						?>
						</select>	
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group col-md-5" style="<?php if($invoice_payment_mode=='' || $invoice_payment_mode==1){ echo 'display:none'; } ?>" id="for_account_type">
						<label > Account Type </label>
						<input type="text" name="account_type" id="account_type" value="<?php echo $account_type; ?>" class="form-control" readonly />
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group col-md-5" style="<?php if($invoice_payment_mode=='' || $invoice_payment_mode==1){ echo 'display:none'; } ?>" id="for_account_name">
						<label > Account Name </label>
						<input type="text" name="account_name" id="account_name" value="<?php echo $account_name; ?>" class="form-control" readonly />
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group col-md-5" style="<?php if($invoice_payment_mode=='' || $invoice_payment_mode==1 || $invoice_payment_mode==3 || $invoice_payment_mode==4 || $invoice_payment_mode==5){ echo 'display:none'; } ?>" id="for_cheque_dd">
						<label > Cheque / DD </label>
						<select name="cheque_dd" id="cheque_dd" class="form-control">
						<option <?php if($cheque_dd==''){ echo "selected"; } ?> value="">Select</option>
						<option <?php if($cheque_dd=='Cheque'){ echo "selected"; } ?> value="Cheque">Cheque</option>
						<option <?php if($cheque_dd=='DD'){ echo "selected"; } ?> value="DD">DD</option>
						</select>
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group col-md-5" style="<?php if($invoice_payment_mode=='' || $invoice_payment_mode==1 || $invoice_payment_mode==3 || $invoice_payment_mode==4 || $invoice_payment_mode==5){ echo 'display:none'; } ?>" id="for_cheque_dd_no">
						<label ><small> Cheque / DD No </small></label>
						<input type="text" name="cheque_dd_no" id="cheque_dd_no" value="<?php echo $cheque_dd_no; ?>" class="form-control" />
					</div>
			</div>
			<div class="col-md-12">
			        <div class="form-group col-md-5" style="<?php if($invoice_payment_mode==''){ echo 'display:none'; } ?>" id="for_remark" >
						<label> Remarks </label>
						<input type="text" name="remark" id="remark" placeholder="Remarks" value="<?php echo $remark; ?>" class="form-control" />
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group col-md-5" style="<?php if($invoice_payment_mode=='' || $invoice_payment_mode==1 || $invoice_payment_mode==3 || $invoice_payment_mode==4 || $invoice_payment_mode==5){ echo 'display:none'; } ?>" id="for_cheque_dd_amount" >
						<label > Cheque / DD Amount </label>
						<input type="number" name="cheque_dd_amount" id="cheque_dd_amount" placeholder="Amount"  value="<?php echo $cheque_dd_amount; ?>" class="form-control" style="border:none;" />
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group col-md-5" style="<?php if($invoice_payment_mode=='' || $invoice_payment_mode==1 || $invoice_payment_mode==3 || $invoice_payment_mode==4 || $invoice_payment_mode==5){ echo 'display:none'; } ?>" id="for_cheque_dd_issue_date" >
						<label > Cheque / DD Issue Date </label>
						<input type="date" name="cheque_dd_issue_date" id="cheque_dd_issue_date" placeholder="Issue Date" value="<?php echo $cheque_dd_issue_date; ?>" class="form-control" style="border:none;" />
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group col-md-5" style="<?php if($invoice_payment_mode=='' || $invoice_payment_mode==1 || $invoice_payment_mode==3 || $invoice_payment_mode==4 || $invoice_payment_mode==5){ echo 'display:none'; } ?>" id="for_cheque_dd_clearing_date" >
						<label > Cheque / DD Clearing Date </label>
						<input type="date" name="cheque_dd_clearing_date" id="cheque_dd_clearing_date" placeholder="Clearing Date" value="<?php echo $cheque_dd_clearing_date; ?>" class="form-control" style="border:none;" />
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
						   <textarea name="invoice_customer_notes" id="invoice_customer_notes" rows="5" cols="200" style="width:250px" class="form-control"><?php echo $invoice_customer_notes; ?></textarea>
						</div>
			</div>
			</div>

				<div class="box-footer">
				<br/>
				<br/>
					<div class="col-md-12">
					<div class="col-md-2"></div>
					
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
					
					<div class="col-md-2"></div>
					</div>
					</div>
			</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-bodybody -->
    
</section>
</form>	
 
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->

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
if(isset($_POST['edit_firm'])){
$invoice_firm_name=$_POST['invoice_firm_name'];
echo "<script>window.open('../contact/contact_edit.php?id=$invoice_firm_name&page=new_estimate_edit&estimate_no=$estimate_no&estimate_type=$estimate_type','_self');</script>";
}

if(isset($_POST['save']) || isset($_POST['save_and_print'])){
$invoice_no=$_POST['invoice_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_reference=$_POST['invoice_reference'];
$invoice_due_date=$_POST['invoice_due_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$invoice_type=$_POST['invoice_type'];
$invoice_gstin_no=$_POST['invoice_gstin_no'];
$sales_person_name = $_POST['sales_person_name'];
$project_name = $_POST['project_name'];
$invoice_place_of_supply=$_POST['invoice_place_of_supply'];
$invoice_billing_address=$_POST['invoice_billing_address'];
$invoice_shipping_address=$_POST['invoice_shipping_address'];

$invoice_s_no=$_POST['invoice_s_no'];
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

$invoice_delete_items=$_POST['invoice_delete_items'];
$invoice_delete_items_count=$_POST['invoice_delete_items_count'];

if(isset($_POST['save']) || isset($_POST['save_and_print'])){
if($invoice_type=='sales'){
$table_name='sales_estimate_info';
$page_name='sales_estimate_list.php';
}elseif($invoice_type=='purchase'){
$table_name='purchase_estimate_info';
$page_name='purchase_estimate_list.php';
}

if($invoice_delete_items!=''){
$invoice_delete_items1=explode(',',$invoice_delete_items);
for($a=0;$a<$invoice_delete_items_count;$a++){
$que4="delete from $table_name where s_no='$invoice_delete_items1[$a]'";
mysql_query($que4);
}
}

$count=count($invoice_s_no);
$count1=count($item_product_name);
$a=0;
$set=0;
for($i=0; $i<$count; $i++){
$query="update $table_name set invoice_no='$invoice_no',invoice_date='$invoice_date',invoice_reference='$invoice_reference',invoice_due_date='$invoice_due_date',invoice_firm_name='$invoice_firm_name',invoice_billing_address='$invoice_billing_address',invoice_shipping_address='$invoice_shipping_address',invoice_gstin_no='$invoice_gstin_no',invoice_place_of_supply='$invoice_place_of_supply',invoice_product_name='$item_product_name[$i]',invoice_description='$item_description[$i]',invoice_hsn='$item_hsn[$i]',invoice_quantity='$item_quantity[$i]',invoice_available_quantity='$item_avail_quantity[$i]',invoice_item_unit='$item_unit[$i]',invoice_rate='$item_price[$i]',invoice_rate1='$item_price1[$i]',invoice_price_fix='$item_price_fix[$i]',invoice_discount='$item_discount[$i]',invoice_discount_type='$item_discount_type[$i]',invoice_taxable='$item_taxable[$i]',invoice_tax_type='$item_tax_type[$i]',invoice_tax='$item_tax_amount[$i]',invoice_cgst='$item_cgst[$i]',invoice_cgst1='$item_cgst1[$i]',invoice_sgst='$item_sgst[$i]',invoice_sgst1='$item_sgst1[$i]',invoice_igst='$item_igst[$i]',invoice_igst1='$item_igst1[$i]',invoice_total='$item_total_amount[$i]',invoice_extra_expences='$invoice_extra_expences',invoice_sub_total='$invoice_sub_total',invoice_total_discount='$total_invoice_discount',invoice_total_discount_type='$total_discount_type',invoice_grand_total='$invoice_grand_total',invoice_payment_mode='$invoice_payment_mode',invoice_total_paid='$invoice_total_paid',remark='$remark',invoice_due_amount='$invoice_due_amount',invoice_customer_notes='$invoice_customer_notes',invoice_terms_and_conditions='$invoice_terms_and_conditions',account_type='$account_type',account_name='$account_name',cheque_dd='$cheque_dd',cheque_dd_no='$cheque_dd_no',cheque_dd_amount='$cheque_dd_amount',cheque_dd_issue_date='$cheque_dd_issue_date',cheque_dd_clearing_date='$cheque_dd_clearing_date',sales_person_name='$sales_person_name',project_name='$project_name' where s_no='$invoice_s_no[$i]'";
if(mysql_query($query)){
$set=$set+1;
$a=$a+1;
}
}
for($j=$a; $j<$count1; $j++){
$query1="insert into $table_name(invoice_no,invoice_date,invoice_reference,invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,invoice_terms_and_conditions,invoice_type,invoice_status,invoice_order_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,sales_person_name,project_name,estimate_status,estimate_status2) values('$invoice_no','$invoice_date','$invoice_reference','$invoice_due_date','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address','$invoice_gstin_no','$invoice_place_of_supply','$item_product_name[$j]','$item_description[$j]','$item_hsn[$j]','$item_quantity[$j]','$item_avail_quantity[$j]','$item_unit[$j]','$item_price[$j]','$item_price1[$j]','$item_price_fix[$j]','$item_discount[$j]','$item_discount_type[$j]','$item_taxable[$j]','$item_tax_type[$j]','$item_tax_amount[$j]','$item_cgst[$j]','$item_cgst1[$j]','$item_sgst[$j]','$item_sgst1[$j]','$item_igst[$j]','$item_igst1[$j]','$item_total_amount[$j]','$invoice_extra_expences','$invoice_sub_total','$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode','$invoice_total_paid','$remark','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions','$invoice_type','Active','$invoice_order_no','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','$sales_person_name','$project_name','Estimate','Approved')";
if(mysql_query($query1)){
$set=$set+1;
}
}
if($set>0){
echo "<script>window.open('$page_name','_self');</script>";
}
}


}

?>
