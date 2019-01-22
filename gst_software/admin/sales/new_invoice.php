<?php include("../../attachment/session.php"); ?>	
   <script>
  // this code is use for fetch the rowwise data -----START-----
  function item_desc(value,sno){
  var place_of_supply=document.getElementById('invoice_place_of_supply').value;
  var admin_place=document.getElementById('admin_place_of_supply').value;
     $.ajax({
			address: "POST",
			url: software_link+"sales/ajax_get_item_description.php?value="+value+"",
			cache: false,
			success: function(detail){
			var str =detail;                
			var res = detail.split("|?|");
			$("#desc_"+sno).show();
			$("#for_desc_"+sno).show();
			$("#hsn_"+sno).show();
			$("#quantity_"+sno).show();
			$("#unit_"+sno).show();
			$("#for_abl_quantity_"+sno).show();
			$("#abl_quantity_"+sno).show();
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
			$("#mrp_price_"+sno).val(res[8]);
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
  var quantity = parseInt(quantity);
  var abl_quantity =document.getElementById('abl_quantity_'+sno).value;
  var abl_quantity = parseInt(abl_quantity);
  var price=document.getElementById('price_'+sno).value;
  var discount=document.getElementById('discount_'+sno).value;
  var tax_type=document.getElementById('tax_type_'+sno).value;
  var cgst=document.getElementById('cgst_'+sno).value;
  var sgst=document.getElementById('sgst_'+sno).value;
  var igst=document.getElementById('igst_'+sno).value;
  if(abl_quantity){
  if(quantity>abl_quantity){  
  document.getElementById('quantity_'+sno).value=abl_quantity;	
  var quantity = document.getElementById('quantity_'+sno).value;
    }
  }
   if(quantity == 0){ document.getElementById('quantity_'+sno).value=1; 
                      var quantity = 1; }
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
	 var select_sales = $("#select_sales").val();
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
	 if(select_sales == 'Vendors')
	 var paid_amount=document.getElementById('invoice_total_paid').value;
	 if(discount_amount>0){
	 var invoice_discount=document.getElementById('total_discount_type').value;
	 if(invoice_discount=='%'){
	 var disc_amt11=parseFloat(add)*parseFloat(discount_amount)/100;
	 document.getElementById('invoice_grand_total').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed();
	 if(select_sales == 'Vendors'){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2); }
	 if(select_sales == 'Customers'){
		 document.getElementById('invoice_total_paid').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2); 
	 }
	 
	 if(paid_amount>0){
		   if(select_sales == 'Vendors'){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)-parseFloat(paid_amount)).toFixed(2);
		   } 
		   if(select_sales == 'Customers'){
	document.getElementById('invoice_total_paid').value=(parseFloat(add)-parseFloat(disc_amt11)-parseFloat(paid_amount)).toFixed(2);
		   }
	 }else{
		 if(select_sales == 'Vendors'){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2);
		 }  if(select_sales == 'Customers'){
	 document.getElementById('invoice_total_paid').value=(parseFloat(add)-parseFloat(disc_amt11)).toFixed(2);
		 }
	 }
	 }else if(invoice_discount=='Rs'){
	 document.getElementById('invoice_grand_total').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed();
	  if(select_sales == 'Vendors'){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
	  } if(select_sales == 'Customers'){
     document.getElementById('invoice_total_paid').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
	  }
	 if(paid_amount>0){
		 if(select_sales == 'Vendors'){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(paid_amount)-parseFloat(discount_amount)).toFixed(2);
		 } if(select_sales == 'Customers'){
	 document.getElementById('invoice_total_paid').value=(parseFloat(add)-parseFloat(paid_amount)-parseFloat(discount_amount)).toFixed(2);
		 }
	 }else{
		  if(select_sales == 'Vendors'){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
		  } if(select_sales == 'Customers'){
	document.getElementById('invoice_total_paid').value=(parseFloat(add)-parseFloat(discount_amount)).toFixed(2);
		  }
	 }  
	 }
	 }else{
	 document.getElementById('invoice_grand_total').value=add.toFixed();
	 if(paid_amount>0){
		   if(select_sales == 'Vendors'){
	 document.getElementById('invoice_due_amount').value=(parseFloat(add)-parseFloat(paid_amount)).toFixed(0);
		   } if(select_sales == 'Customers'){
	 document.getElementById('invoice_total_paid').value=(parseFloat(add)-parseFloat(paid_amount)).toFixed(0);
		    }
	 }else{
		  if(select_sales == 'Customers'){ 
		  $("#invoice_total_paid").val(parseInt(add));
		 
		 // document.getElementById('invoice_total_paid').value=parseInt(add);
          document.getElementById('invoice_total_paid').readOnly="true";
		  document.getElementById('invoice_due_amount').value=0; 
		   for_condition(); }
		 if(select_sales == 'Vendors')
         document.getElementById('invoice_due_amount').value=parseFloat(add).toFixed(0);
	     
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
		//$('#for_remark').show();
		//$('#remark').val('');
		
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
		//$('#for_remark').show();
		//$('#remark').val('');
		
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
		//$('#for_remark').show();
		//$('#remark').val('');
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
		//$('#for_remark').show();
		//$('#remark').val('');
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
	//$('#for_remark').hide();
	//$('#remark').val('');
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
  function firm_info(value,company_code){
		$.ajax({
			address: "POST",
			url: software_link+"sales/get_firm_details.php?id="+value+"&company_code="+company_code+"",
			cache: false,
			success: function(detail){
			var res = detail.split("|?|");
			$('#invoice_shipping_address').val(res[2]);
			$('#invoice_billing_address').val(res[2]);
			 // $('#pay_term').val(res[4]);
			//var pay_term = res[4];
			$("#invoice_place_of_supply").val(res[1]).change();
		    $('#invoice_gstin_no').val(res[0]);
			}
		});	
  }
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
              url: software_link+"sales/ajax_get_data_by_barcode.php?barcode="+value+"",
              cache: false,
              success: function(detail){
              $('#item_product_name_'+id).html(detail);
              }
           });
    }
  
  </script>
<script>
$("#new_invoice_add").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"sales/new_invoice_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
				alert(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Complete');
				   post_content('sales/sales_invoice_list',res[2]);
            }
			}
         });
      });
</script>
<script>
				function cheque_dd_showtextbox()
				{
				var select_status=$('#cheque_dd').val();
				if(select_status == 'Cheque' || select_status == 'DD')
				{
				$('#for_cheque_dd_no').show();
		        $('#for_cheque_dd_amount').show();
		        $('#for_cheque_dd_issue_date').show();
	            $('#for_cheque_dd_clearing_date').show();
				}
				else
				{
				$('#for_cheque_dd_no').hide();
	            $('#for_cheque_dd_amount').hide();
	            $('#for_cheque_dd_issue_date').hide();
	            $('#for_cheque_dd_issue_date').hide();
	            $('#for_cheque_dd_clearing_date').hide();
				}
				}
				
				</script>
				<script type="text/javascript">
     $( document ).ready(function() {
	  var select_val = $("#select_sales").val();
				  select_type_sales(select_val);
       });
	    function select_type_sales(value){
			 $("#sales_type").val(value);
				  if(value=='Customers'){
					  $.ajax({
						      method:"POST",
							  url: software_link+"sales/ajax_invoice_no_select.php",
							  data:"sales_type="+value,
							  success:function(detail){
					 $("#customer_id").val(detail);
					$("#sales_vendor").hide();
					$("#sales_vendor2").hide();
					$("#sales_customer").show();
							  }
					  })
				   
				  }else{
					  $("#customer_id").val('');
					  $("#sales_customer").hide();
					  $("#sales_vendor").show();
					  $("#sales_vendor2").show();
				  }
				 }
</script>
<?php
    $query2="select * from invoice_no where company_code='$company_code'";
	$res2=mysql_query($query2);
	while($row2=mysql_fetch_array($res2)){
	$sales_invoice_no=$row2['sales_invoice_no'];
	 //$sales_invoice_draft_no=$row2['sales_invoice_draft_no'];
	 $val=substr($sales_invoice_no, 1);
	}
	?>
    <section class="content-header">
      <h1>
        Create New Invoice
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="javascript:post_content('sales/sales_invoice_list','inv_type=sales')"></i>Sales Invoice</a></li>
        <li class="active">Add Invoice</li>
      </ol>
    </section>

    <section class="content">
    <div class="row">
	    <div class="col-xs-12">
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
			<h3 class="box-title">
              <center><select class="form-control select2" style="width:100%" name="select_sales" onchange="select_type_sales(this.value)" id="select_sales">
			   <option value="Customers">Customers Sales</option>
			   <option value="Vendors">Retailer Sales</option>
			   </select></center></h3>
			  <h1 class="box-title" style="float:right;">Invoice No: <?php echo 'INV-'.$val; ?></h1>
            </div>
	<div class="box-body">
		<form method="post" id="new_invoice_add" enctype="multipart/form-data">
	<input type="hidden" name="sales_type" value="" id="sales_type" />
	<input type="hidden" name="customer_id" value="" id="customer_id" />
	<input type="hidden" name="sales_invoice_no"  value="<?php echo $sales_invoice_no; ?>" />
	 <input type="hidden" name="invoice_no"  value="<?php echo 'INV-'.$val; ?>" />
	  <input type="hidden" name="invoice_date"  value="<?php echo date("Y-m-d"); ?>" />
	        <div class="row">
			<div class="col-md-12" id="sales_customer">
			   <div class="col-md-4">    
					 <label>Mobile No<span style="color:red;">*</span></label>
					 <input type="text" name="customer_mobile" class="form-control" id="customer_mobile" placeholder="Customer Mobile" />
					</div>
					 <div class="col-md-4">    
					 <label>User Name<span style="color:red;">*</span></label>
					 <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" id="customer_name" />
					</div>
					
			 </div>
              <div class="col-md-12" id="sales_vendor">
					<div class="col-md-4">    
					 <label>Firm Name <span style="color:red;">*</span></label>
					 
					 <select name="invoice_firm_name" class="form-control select2" id="invoice_firm_name" onchange="firm_info(this.value,'<?php echo $company_code; ?>');" style="width:100%">
					  <option value="">Select Customer</option>
					        <?php
							$qry="select * from contact_master where contact_status='Active' and contact_contact_type='Customer' and company_code='$company_code'";
							$rest=mysql_query($qry);
							while($row22=mysql_fetch_array($rest)){
							$s_no=$row22['s_no'];
							$contact_company_name=$row22['contact_company_name'];
							$contact_contact_phone=$row22['contact_contact_phone'];
							?>
							<option value="<?php echo $s_no; ?>"><?php echo $contact_company_name; ?><?php echo " [".$contact_contact_phone."]"; ?></option>
							<?php
							}
							?>
					   </select>
					</div>
					<div class="form-group col-md-4">
					<div class="form-group" >
					  <label >GSTIN No</label>
					  <input type="text" name="invoice_gstin_no" placeholder="Add GSTIN" id="invoice_gstin_no" value="" class="form-control">
					</div>
					</div>
					<div class="form-group col-md-4">
					  <label >Place Of Supply <span style="color:red;">*</span></label>
					  <select class="select2" name="invoice_place_of_supply" id="invoice_place_of_supply" onchange="place_ofsupply(this.value);" style="width:100%">
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
					  <input type="hidden" name="" id="admin_place_of_supply" value="" />
					</div>
				</div>
				<div class="col-md-12" id="sales_vendor2">				
					<div class="form-group col-md-4" >
						<label >Billing Address</label>
						<textarea name="invoice_billing_address" id="invoice_billing_address" rows="3" class="form-control" style="resize:none;"></textarea>
					</div>			
					<div class="form-group col-md-4" >
						<label >Shipping Address</label>
						<textarea name="invoice_shipping_address" id="invoice_shipping_address" rows="3" class="form-control" style="resize:none;"></textarea>
					</div>
					<div class="form-group  col-md-3">
				    	 <label class="control-label" style="text-align:left;">Choose Image</label>
				
					  <input type="file" name="upload_file" id="upload_file" placeholder="" onchange="check_file_type(this,'upload_file','upload_image','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					  	</div>
				      <div class="col-md-1">	
				      <img id="upload_image" src=<?php echo $image_path."Profile.png"; ?> width='60px' height='60px'>
					</div>
					
				</div>
				</div>
				<br>
				<br>
    <div class="row">
	<div class="col-md-12">
	<div id="item_table">
	<input type="hidden" id="sample2" value="1" />
        <table class="table table-bordered">
            <thead class="my_background_color">
                <tr id="row_1">
					<th>S.No.</th>
					<th style="width:200px;">Scan Barcode</th>
					<th style="width:200px;">Item </th>
					<th style="width:70px;">Quantity</th>
					<th style="width:70px;">Rate (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:70px;">Fix Rate (<i class="fa fa-inr" aria-hidden="true">)</th>
					
                </tr>
            </thead>
			<tbody>
			 <tr>
					<td><span id='snum_1' class="snm">1.</span></td>
					<td>
					<div>
					<input type="text" name="barcode_no" placeholder="Scan Item" onblur="get_barcode(this.value,1,'<?php echo $company_code; ?>');" value="" class="form-control">
					</div>
						<div>
							<label id="for_desc_1" style="display:none;padding:0px;margin:0px;font-size:12px;color:#423C9B;">Description : </label>
							<textarea name="item_description[]" id="desc_1" class="form-control" style="display:none;border-color:Transparent;padding:0px;margin:0px;" rows="1" ></textarea>
						</div>
					</td>
					<td>
					  <div class="form-group">
							<select name="item_product_name[]" id="item_product_name_1" style="width:100%;" class="form-control select2" onchange="item_desc(this.value,1);" required>
							<option value=''>Select</option>
							<?php
							$query="select item.item_product_name,item.s_no from item join purchase_invoice_new on item.s_no=purchase_invoice_new.invoice_product_name where item.item_status='Active' and item.company_code='$company_code' and item.item_purchase_quantity>0 group by purchase_invoice_new.invoice_product_name";
							$res=mysql_query($query);
							while($row=mysql_fetch_array($res)){
							$s_no=$row['s_no'];
							$item_product_name=$row['item_product_name'];
							//$barcode_no=$row['barcode_no'];
							?>
							<option value="<?php echo $s_no; ?>"><?php //echo "[".$barcode_no."]"; ?><?php echo $item_product_name; ?></option>
							<?php
							}
							?>
							</select>
						</div>
						<div>
						<label id="for_hsn_1" style="display:none;font-size:12px;color:#423C9B;">HSN : </label>
						<input type="text" name="item_hsn[]" id="hsn_1" style="display:none;border:none;" />
						</div>
						<input type="hidden" name="click" id="click_1" onclick="for_total(1);">
					</td>
					<td>
					<div>
					<input type="number" name="item_quantity[]" id="quantity_1" class="form-control" value="1" oninput="for_total(1);" />
					</div>
					<div>	
						<label id="for_abl_quantity_1" style="display:none;font-size:12px;color:#423C9B;">AVL : </label>
						<input type="number" name="item_avail_quantity[]" id="abl_quantity_1" min="<?php if(isset($_GET['inv_type'])){ if($inv_type=='sales'){ echo 1; } }else{ echo 1; } ?>" style="width:50px;display:none;border:none;"readonly />
					</div>
					</td>
					<td>
					<div>
					<input type="number" name="item_price[]" step="0.01" id="price_1" class="form-control" oninput="for_total(1);" />
					<input type="hidden" name="item_price1[]" id="price1_1" class="form-control" />
					</div>
					<div>	
						<label id="for_unit_1" style="display:none;font-size:12px;color:#423C9B;">UNIT : </label>
						<input type="text" name="item_unit[]" id="unit_1" style="width:60px;display:none;border:none;" readonly />
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_price_fix[]" id="price_fix_1" class="form-control" oninput="fix_rate(1,this.value);" />
					</div>
					</td>
					<td></td>
             </tr>
			</tbody>
			<tbody>
			<tr>
			        <th style="width:70px;">MRP</th>
			        <th style="width:70px;">Discount(%/Rs)</th>
					<th style="width:70px;">Taxable (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:70px;">Tax Type</th>
					<th style="width:70px;">Tax Amount</th>
					<th style="width:100px;">Total (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:20px;"></th></tr>
					<tr>
					<td>
					<div class="input-group">
					<input type="text" name="item_mrp[]" id="price_fix_1" value="0" class="form-control" oninput="fix_rate(1,this.value);" />
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
					<select name="item_tax_type[]" class="form-control" onchange="for_tax(1);" id="tax_type_1">
					<option value="CGST&SGST">CGST&SGST </option>
					<option value="IGST">IGST</option>
					</select>
					<div class="col-md-12">
					 <div class="row">
						<label id="for_cgst_1" style="width:45px;display:none;font-size:12px;color:#423C9B;">CGST : </label>
						<input type="text" name="item_cgst[]" oninput="for_total(1);" id="cgst_1" style="width:45px;display:none;border:none;" />
						<input type="hidden" name="item_cgst1[]" id="cgst1_1" />
						<label id="for_sgst_1" style="width:45px;display:none;font-size:12px;color:#423C9B;">SGST : </label>
						<input type="text" name="item_sgst[]" oninput="for_total(1);" id="sgst_1" style="width:45px;display:none;border:none;" />
						<input type="hidden" name="item_sgst1[]" id="sgst1_1" />
						<label id="for_igst_1" style="width:45px;display:none;font-size:12px;color:#423C9B;">IGST : </label>
						<input type="text" name="item_igst[]" id="igst_1" oninput="for_total(1);" style="width:45px;display:none;border:none;" />
						<input type="hidden" name="item_igst1[]" id="igst1_1" />
					 </div></div>
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_taxable[]" id="taxable_1" class="form-control" />
					</div>
					</td>
					<td>
					<div>
					<input type="text" name="item_tax_amount[]" id="tax_amount_1" class="form-control" />
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
			<script>
			$("#addmore").on('click',function(){
			var i = 2;
				var count = $("#item_table tr").length;
				var count = count/4;
			    var count = count+1;
			var data="<table class='table table-bordered'><thead class='my_background_color'><tr id='row_"+count+"'><th>S.No.</th><th style='width:200px;'>Scan Barcode</th><th style='width:200px;'>Item </th><th style='width:70px;'>Quantity</th><th style='width:70px;'>Rate (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:70px;'>Fix Rate (<i class='fa fa-inr' aria-hidden='true'>)</th></tr></thead><tbody><tr><td><span id='snum_"+count+"' class='snm'>"+count+"</span></td><td><div><input type='text' name='barcode_no' placeholder='Scan Item' onblur='get_barcode(this.value,"+count+",'<?php echo $company_code; ?>');' value='' class='form-control'></div><div><label id='for_desc_"+count+"' style='display:none;padding:0px;margin:0px;font-size:"+count+"2px;color:#423C9B;'>Description : </label><textarea name='item_description[]' id='desc_"+count+"' class='form-control' style='display:none;border-color:Transparent;padding:0px;margin:0px;' rows='"+count+"' ></textarea></div></td><td><div class='form-group'><select name='item_product_name[]' id='item_product_name_"+count+"' style='width:100%;' class='form-control select2' onchange='item_desc(this.value,"+count+");' required><option value=''>Select</option><?php $query="select item.item_product_name,item.s_no from item join purchase_invoice_new on item.s_no=purchase_invoice_new.invoice_product_name where item.item_status='Active' group by purchase_invoice_new.invoice_no and item.company_code='$company_code'  and item.item_purchase_quantity>0";$res=mysql_query($query);while($row=mysql_fetch_array($res)){ $s_no=$row['s_no'];$item_product_name=$row['item_product_name'];//$barcode_no=$row['barcode_no']; ?><option value='<?php echo $s_no; ?>'><?php //echo '['.$barcode_no.']'; ?><?php echo $item_product_name; ?></option><?php } ?></select></div><div><label id='for_hsn_"+count+"' style='display:none;font-size:"+count+"2px;color:#423C9B;'>HSN : </label><input type='text' name='item_hsn[]' id='hsn_"+count+"' style='display:none;border:none;' /></div><input type='hidden' name='click' id='click_"+count+"' onclick='for_total("+count+");'></td><td><div><input type='number' name='item_quantity[]' id='quantity_"+count+"' class='form-control' value='"+count+"' oninput='for_total("+count+");' /></div><div>	<label id='for_abl_quantity_"+count+"' style='display:none;font-size:"+count+"2px;color:#423C9B;'>AVL : </label><input type='number' name='item_avail_quantity[]' id='abl_quantity_"+count+"' min='<?php if(isset($_GET['inv_type'])){ if($inv_type=='sales'){ echo "+count+"; } }else{ echo "+count+"; } ?>' style='width:50px;display:none;border:none;'readonly /></div></td><td><div><input type='number' name='item_price[]' step='0.0"+count+"' id='price_"+count+"' class='form-control' oninput='for_total("+count+");' /><input type='hidden' name='item_price"+count+"[]' id='price"+count+"_"+count+"' class='form-control' /></div><div>	<label id='for_unit_"+count+"' style='display:none;font-size:"+count+"2px;color:#423C9B;'>UNIT : </label><input type='text' name='item_unit[]' id='unit_"+count+"' style='width:60px;display:none;border:none;' readonly /></div></td><td><div><input type='text' name='item_price_fix[]' id='price_fix_"+count+"' class='form-control' oninput='fix_rate("+count+",this.value);' /></div></td><td></td></tr></tbody><tbody><tr><th style='width:70px;'>MRP</th><th style='width:70px;'>Discount(%/Rs)</th><th style='width:70px;'>Taxable (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:70px;'>Tax Type</th><th style='width:70px;'>Tax Amount</th><th style='width:"+count+"00px;'>Total (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:20px;'></th></tr><tr><td><div class='input-group'><input type='text' name='item_mrp[]' id='price_fix_"+count+"' value='0' class='form-control' oninput='fix_rate("+count+",this.value);' /></div></td><td><div class='input-group'><input type='text' name='item_discount[]' id='discount_"+count+"' value='0' class='form-control' oninput='for_total("+count+");' /><span class='input-group-addon' style='padding:0px;'><select name='item_discount_type[]' id='discount_type_"+count+"' style='border:none;' onchange='for_click("+count+");'><option value='%'>%</option><option value='Rs'>Rs</option></select></span></div></td><td><div><select name='item_tax_type[]' class='form-control' onchange='for_tax("+count+");' id='tax_type_"+count+"'><option value='CGST&SGST'>CGST&SGST </option><option value='IGST'>IGST</option></select><div class='col-md-"+count+"2'><div class='row'><label id='for_cgst_"+count+"' style='width:45px;display:none;font-size:"+count+"2px;color:#423C9B;'>CGST : </label><input type='text' name='item_cgst[]' oninput='for_total("+count+");' id='cgst_"+count+"' style='width:45px;display:none;border:none;' /><input type='hidden' name='item_cgst"+count+"[]' id='cgst"+count+"_"+count+"' /><label id='for_sgst_"+count+"' style='width:45px;display:none;font-size:"+count+"2px;color:#423C9B;'>SGST : </label><input type='text' name='item_sgst[]' oninput='for_total("+count+");' id='sgst_"+count+"' style='width:45px;display:none;border:none;' /><input type='hidden' name='item_sgst"+count+"[]' id='sgst"+count+"_"+count+"' /><label id='for_igst_"+count+"' style='width:45px;display:none;font-size:"+count+"2px;color:#423C9B;'>IGST : </label><input type='text' name='item_igst[]' id='igst_"+count+"' oninput='for_total("+count+");' style='width:45px;display:none;border:none;' /><input type='hidden' name='item_igst"+count+"[]' id='igst"+count+"_"+count+"' /></div></div></div></td><td><div><input type='text' name='item_taxable[]' id='taxable_"+count+"' class='form-control' /></div></td><td><div><input type='text' name='item_tax_amount[]' id='tax_amount_"+count+"' class='form-control' /></div></td><td><div><input type='text' name='item_total_amount[]' class='form-control amt' id='item_total_"+count+"'  style='border:none;' /></div></td><td><div>&nbsp;</div></td></tr></tbody></table>";
			$('#item_table').append(data);
			i++;
			$('.select2').select2();
			});
			function for_delete(sno){
			if(sno>1){
			var my_sno=sno-1;
			$('#table_'+sno).remove();
			$('#icon_'+sno).remove();
			$('#click_'+my_sno).click();
			var count1=1;
			$('.snm').each(function() {
			$(this).html(count1);
			count1++;
			});
			}
			}
			$("#payment").on('click',function(){
			document.getElementById('Payment_mode').style.display="block";                   
			});
			</script>
	</div>			
	</div>
	</div>				
	<div class="col-md-6">
		<div class="col-md-2">
		<div class="form-group">
			<button type="button" class="btn btn-success" id='addmore'>Add More</button>
			</div>
			</div>
			 <div class="col-md-1"></div>
			<!-- <div class="col-md-2">
		      <div class="form-group">
			<button type="button" class="btn btn-success" onclick="Payment();" id='payment'>Payment</button>
			</div>
			</div>-->
			</div>
			  	<div class="col-md-12" style="display:block" id="Payment_mode">
				<div class="col-md-4">
					<div class="form-group">
					 <label> Payment Mode </label>
						<select class="form-control select2" name="invoice_payment_mode" id="invoice_payment_mode" onchange="payment_detail(this.value);for_condition();" style="width:100%" required>
						<?php
						$query4="select * from bank_or_credit_card_info where bank_status='Active' and account_type='Sales Account' or bank_account_name='Petty Cash' or bank_account_name='Undeposited Funds' or account_type='E-Payment Account' and company_code='$company_code'";
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
				<div class="col-lg-4"  style="" >
					<div class="form-group">
					 <label>Total Paid </label>
						<input type="number" name="invoice_total_paid" id="invoice_total_paid" placeholder="Total Paid" class="form-control" oninput="for_grandtotal();for_condition();" />
					</div>
				</div>
				<div class="col-lg-4" style="">
					<div class="form-group">
					 <label>Due Amount </label>
						<input type="text" name="invoice_due_amount" id="invoice_due_amount" placeholder="Due Amount"  value="" class="form-control" readonly style="border:none;" />
					</div>
				</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group" style="display:none;" id="for_account_type">
						<label>Account Type </label>
						<input type="text" name="account_type" id="account_type" value="" class="form-control" readonly />
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group" style="display:none;" id="for_account_name">
						<label>Account Name </label>
						<input type="text" name="account_name" id="account_name" value="" class="form-control" readonly />
					</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group" style="display:none;" id="for_cheque_dd">
							<label>Cheque / DD</label>
							<select name="cheque_dd" id="cheque_dd" class="form-control" onchange="cheque_dd_showtextbox();" style="width:100%">
							<option value="">Select</option>
							<option value="Cheque">Cheque</option>
							<option value="DD">DD</option>
							</select>
						</div>
				</div>
				
			<div class="col-lg-12" id="cheque_dd">
				<div class="col-lg-4">
						<div class="form-group" style="display:none;" id="for_cheque_dd_no">
							<label ><small> Cheque / DD No </small></label>
							<input type="text" name="cheque_dd_no" id="cheque_dd_no" value="" class="form-control" />
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group" style="display:none;" id="for_cheque_dd_amount" >
							<label>Cheque / DD Amount </label>
							<input type="number" name="cheque_dd_amount" id="cheque_dd_amount" placeholder="Amount"  value="" class="form-control" style="border:none;" />
						</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group" style="display:none;" id="for_cheque_dd_issue_date" >
							<label>Cheque / DD Issue Date </label>
							<input type="date" name="cheque_dd_issue_date" id="cheque_dd_issue_date" placeholder="Issue Date" value="" class="form-control" style="border:none;" />
						</div>
				</div>
				<div class="col-md-4">
						<div class="form-group" style="display:none;" id="for_cheque_dd_clearing_date" >
							<label>Cheque / DD Clearing Date </label>
							<input type="date" name="cheque_dd_clearing_date" id="cheque_dd_clearing_date" placeholder="Clearing Date" value="" class="form-control" style="border:none;" />
						</div>
				</div>
			<div class="col-lg-4" style="display:none;">
					<div class="form-group col-lg-5">
					 <label>Extra Expences </label>
						<input type="number" name="invoice_extra_expences" id="invoice_extra_expences" placeholder="Enter Extra Expences"  value="0" class="form-control amt" oninput="for_grandtotal();">
						<input type="hidden" id="click_total" onclick="for_grandtotal();">
					</div>
				</div>
				    <div class="row">
			<div class="col-md-12">			
			<?php
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
			<div class="col-md-5">		
			<div class="form-group">
			  <label>Terms And Conditions</label>
			   <textarea name="invoice_terms_and_conditions"  rows="5" cols="200" style="width:100%" class="form-control"><?php echo $note_1."\n".$note_2."\n".$note_3."\n".$note_4."\n".$note_5; ?> </textarea>
			</div>
			</div>
			<div class="col-md-3">		
			<div class="form-group">
			  <label>Customer Notes</label>
			   <textarea name="invoice_customer_notes" id="invoice_customer_notes" rows="5" cols="200" class="form-control" style="resize:none;"></textarea>
			</div>
			</div>
		   <div class="col-md-4">
		   <div class="form-group col-md-3">
					 <label>Discount(%/Rs):</label>
					</div>
					<div class="col-md-2"></div>
					<div class="col-md-7">
					<div class="input-group" >
					<input type="number" name="total_invoice_discount" id="total_invoice_discount" placeholder="Enter Discount Amount"  value="0" class="form-control" oninput="for_grandtotal();">
					<span class="input-group-addon" style="padding:0px;">
					<select name="total_discount_type" id="total_discount_type" style="border:none;" onchange="for_grandtotal();">
					<option value="%">%</option>
					<option value="Rs">Rs</option>
					</select>
					</span>
					</div>
					</div>
				    </div> &nbsp;
					
				<div class="col-md-4">
		            <div class="form-group col-md-3">
					 <label>SubTotal</label>
					</div>
					<div class="col-md-2"></div>
					<div class="form-group col-md-7">
					<div class="input-group" >
						<input type="text" name="invoice_sub_total" id="invoice_sub_total" placeholder="Sub Total"  value="" class="form-control" style="border-style: none;" readonly />
					</div>
					</div>
					
				    </div>
					  <div class="col-md-4">
		   <div class="form-group col-md-3">
					 <label>GrandTotal</label>
					</div>
					<div class="col-md-2"></div>
					<div class="form-group col-md-7">
					<div class="input-group" >
					<input type="text" name="invoice_grand_total" id="invoice_grand_total" placeholder="Grand Total"  value="" class="form-control" readonly style="border:none;" />
					</div>
					</div>
				    </div>
			</div>
            </div>
			   <input type="hidden" value="<?php echo $company_code; ?>" name="company_code"/>
				<br>
				<br>				
		<div class="box-footer">
					<div class="col-md-12">
					   <div class="col-md-4"></div>
					<div class="col-md-2">
					<div class="form-group">
						<input type="submit" name="save" value="Save" class="form-control btn btn-success">
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group" >
						<input type="submit" name="save_and_print" value="Save and Print" class="form-control btn btn-success">
					</div>
					</div>
			        <div class="col-md-4"></div>
					</div>
			</div>
    </div>
</form>	
  </div>
  </section>
  </div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
