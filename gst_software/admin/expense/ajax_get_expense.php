<?php include("../../attachment/session.php");
    $expense_type = $_GET['id'];
	$query2="select * from invoice_no where company_code='$company_code'";
	$res2=mysql_query($query2);
	while($row2=mysql_fetch_array($res2)){
	$expense_no=$row2['expense_no'];
	 //$sales_invoice_draft_no=$row2['sales_invoice_draft_no'];
	 $val=$expense_no;
	}
	if($expense_type == 'Office Expense'){
 ?>
 <script type="text/javascript">
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
 </script>
 <script>
$("#office_expense").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"expense/office_expense_api.php",
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
				   get_content('expense/add_expenses');
            }
			}
         });
      });
</script>
 <form method="post" id="office_expense" enctype="multipart/form-data">
	<input type="hidden" name="expense_type" value="<?php echo $expense_type; ?>" id="sales_type" />
		<input type="hidden" name="expense_invoice_no"  value="<?php echo $expense_no; ?>" />
	 <input type="hidden" name="invoice_no"  value="<?php echo 'EXP-'.$val; ?>" />
	  <input type="hidden" name="invoice_date"  value="<?php echo date("Y-m-d"); ?>" />
	        <div class="row">
              <div class="col-md-12" id="office_expense">
					<div class="col-md-4">    
					 <label>Shop Name <span style="color:red;">*</span></label>
					 <input type="text" name="vendor_name" placeholder='Shop Name/Vendor Name' class="form-control" />
					</div>
					<div class="form-group col-md-4">
					<div class="form-group" >
					  <label>Expense Date</label>
					  <input type="date" name="expense_date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
					</div>
					<div class="form-group col-md-4">
					<div class="form-group" >
					  <label>Mobile No</label>
					  <input type="number" name="expense_contact_no" placeholder="Expense Contact" id="expense_contact" value="" class="form-control">
					</div>
					</div>
					</div>
					<div class="col-md-12">	
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
							<option value="Madhya Pradesh" selected>Madhya Pradesh</option>
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
					<div class="form-group col-md-4" >
						<label>Shop Address</label>
						<textarea name="invoice_billing_address" id="invoice_billing_address" rows="3" class="form-control" style="resize:none;"></textarea>
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
				
				<div class="row">
				 <div class="col-md-12">
				 <center><h4 style="color:red;">* Purchase Product Detail Office Use Only</h4></center>
				</div>
    <div class="row">
	<div class="col-md-12">
	<div id="item_table">
	<input type="hidden" id="sample2" value="1" />
        <table class="table table-hover" id="table_1">
            <thead class="my_background_color">
                <tr id="row_1">
					<th style="width:300px;">Item Name</th>
					<th style="width:50px;">Quantity</th>
					<th style="width:70px;">Price</th>
					<th style="width:30px;">Total Amount (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:110px;">Remark</th>
                </tr>
            </thead>
			<tbody>
					<tr>
					<td style="width:300px">
					<input type="text" name="product_name[]" id="product_name_1" oninput="item_total(1);" class="form-control" />
					</td>
					<td style="width:50px">
					<input type="number" name="quantity[]" id="quantity_1" value="1" oninput="item_total(1);" class="form-control" />
					</td>
					<td style="width:150px;">
						<input type="number" name="price[]" id="price_1" value="" class="form-control" oninput="item_total(1);" />
					</td>
					<td style="width:150px;">
					<input type="number" name="total_amount[]" id="item_total_1" oninput="item_total(1);" class="form-control" />
					</td>
					<td>
				<textarea name="item_description" class="form-control" style="resize:none;" cols='15' rows='2'></textarea>
					</td>
					</tr>
					</tbody>
        </table>
			<script>
			$("#addmore").on('click',function(){
			    var i = 2;
				var count = $("#item_table tr").length;
				var count = count/2;
			    var count = count+1;
			var data="<table class='table table-hover' id='table_"+count+"'><thead class='my_background_color'><tr id='row_"+count+"'><th style='width:300px;'>Item Name</th><th style='width:50px;'>Quantity</th><th style='width:70px;'>Price</th><th style='width:70px;'>Total Amount (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:70px;'>Remark <span id='icon_"+count+"' style='float:right'><i class='fa fa-times form-control' style='color:red;border:none;' onclick='for_delete("+count+");' aria-hidden='true'></i></span> </th></tr></thead><tbody><tr><td style='width:300px'><input type='text' name='product_name[]' id='product_name_"+count+"' class='form-control' oninput='item_total("+count+");' /></td><td style='width:50px'><input type='number' name='quantity[]' id='quantity_"+count+"' oninput='item_total("+count+");' value='1' class='form-control' oninput='for_total("+count+");' /></td><td style='width:150px;'><input type='number' name='price[]' id='price_"+count+"' value='' class='form-control' oninput='item_total("+count+");' /></td><td style='width:150px;'><input type='number' name='total_amount[]'id='item_total_"+count+"' class='form-control' oninput='item_total("+count+");' /></td><td><textarea name='description' class='form-control' style='resize:none;' cols='15' rows='2' id='description_"+count+"'></textarea></td></tr></tbody> </table>";
			$('#item_table').append(data);
			i++;
			$('.select2').select2();
			});
			function for_delete(sno){
			if(sno>1){
			//var my_sno=sno-1;
			$('#table_'+sno).remove();
			$('#icon_'+sno).remove();
			//$('#click_'+my_sno).click();
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
			</div>
			  	<div class="col-md-12" style="display:block" id="Payment_mode">
				<div class="col-md-4">
					<div class="form-group">
					 <label> Payment Mode </label>
						<select class="form-control select2" name="invoice_payment_mode" id="invoice_payment_mode" onchange="payment_detail(this.value);for_condition();" style="width:100%" required>
						<?php
						$query4="select * from bank_or_credit_card_info where bank_status='Active' and account_type='Expense Account' and company_code='$company_code'";
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
					 <label>Total Paid</label>
					   <input type="hidden" id="t1" value="" />
						<input type="number" name="invoice_total_paid" id="total_paid" placeholder="Total Paid"  value="" oninput="due_payment(this.value);" class="form-control amt" />
					</div>
				</div>
				<div class="col-lg-4" style="">
					<div class="form-group">
					 <label> Due Amount </label>
						<input type="text" name="invoice_due_amount" id="due_amount" placeholder="Due Amount"  value="" class="form-control" readonly style="border:none;" />
					</div>
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
		  
				    </div> &nbsp;&nbsp;
					
				<div class="col-md-4">
		            <div class="form-group col-md-3">
					 <label>SubTotal</label>
					</div>
					<div class="col-md-2"></div>
					<div class="form-group col-md-7">
					<div class="input-group" >
						<input type="text" name="sub_total" id="sub_total" placeholder="Sub Total"  value="" class="form-control" style="border-style: none;" readonly />
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
					<input type="text" name="grand_total" id="grand_total" placeholder="Grand Total"  value="" class="form-control" readonly style="border:none;" />
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
					<!--<div class="col-md-2">
					<div class="form-group" >
						<input type="submit" name="save_and_print" value="Save and Print" class="form-control btn btn-success">
					</div>
					</div>-->
			        <div class="col-md-4"></div>
					</div>
			</div>
			
    </div>
	
</form>	
 <?php
	}
 if($expense_type == 'Product Expense'){
	 ?>
	 <script>
$("#product_expense").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
    //alert(formdata);
        $.ajax({
            url: software_link+"expense/product_expense_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
            	//alert(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Complete');
				   get_content('expense/add_expenses');
            }
			}
         });
      });
</script>
 <form method="post" id="product_expense" enctype="multipart/form-data">
	<input type="hidden" name="expense_type" value="<?php echo $expense_type; ?>" id="sales_type" />
		<input type="hidden" name="expense_invoice_no"  value="<?php echo $expense_no; ?>" />
	 <input type="hidden" name="invoice_no"  value="<?php echo 'EXP-'.$val; ?>" />
	  <input type="hidden" name="invoice_date"  value="<?php echo date("Y-m-d"); ?>" />
	        <div class="row">
              <div class="col-md-12">
					<div class="col-md-4">    
					 <label>Select Product Expense<span style="color:red;">*</span></label>
					 <select name="product_expense_type" class="form-control select2" style="width:100%" required>
					       <option value="">--Select--</option>
						   <?php $select_e = "select * from product_expense_type_new";
                                 $run = mysql_query($select_e);
								 while($fetchr = mysql_fetch_array($run)){ 
								 ?>
					       <option value="<?php echo $fetchr['s_no']; ?>">
						   <?php echo $fetchr['expense_type']; ?></option>
								 <?php } ?>
					   </select>
					</div>
					<div class="form-group col-md-4">
					<div class="form-group" >
					  <label>Expense Date</label>
					  <input type="date" name="expense_date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
					</div>
					<div class="form-group col-md-4">
					<div class="form-group" >
					  <label>Mobile no</label>
					  <input type="number" name="expense_contact_no" placeholder="Expense Contact" id="expense_contact" value="" class="form-control">
					</div>
					</div>
					</div>
				</div>
				
				<div class="row">
				 <div class="col-md-12">
				 <center><h4 style="color:red;">* Product Detail In Inventory</h4></center>
				</div>
    <div class="row">
	<div class="col-md-12">
	<div id="item_table">
	<input type="hidden" id="sample2" value="1" />
        <table class="table table-hover" id="table_1">
            <thead class="my_background_color">
                <tr id="row_1">
					<th style="width:300px;">Item Name/Barcode No</th>
					<th style="width:100px;">Quantity</th>
					<th style="width:70px;">Product price</th>
					<th style="width:30px;">Total Amount (<i class="fa fa-inr" aria-hidden="true">)</th>
					<th style="width:110px;">Remark</th>
                </tr>
            </thead>
			<tbody>
					<tr>
					<td style="width:300px">
					<select name="product_name[]" id="product_name_1" class="form-control select2" style="width:100%" onchange=" product_descr(this.value,1);">
					<option value="">--Select--</option>
					<?php $select = "select item_product_name,item_purchase_quantity,s_no from item where item_purchase_quantity>0 and item_status='Active'";
                     $run = mysql_query($select);					
					 while($row = mysql_fetch_array($run)) { ?>
					  <option value="<?php echo $row['s_no']; ?>"><?php echo $row['item_product_name']; ?></option>
					 <?php } ?>
					</select>
					</td>
					<td style="width:100px">
					<input type="number" name="quantity[]" id="quantity_1" value="1" oninput="item_total(1); check_quantity(this.value,1)" class="form-control" />
					</td>
					<td style="width:150px;">
						<input type="number" name="price[]" id="price_1" value="" class="form-control" oninput="item_total(1);" />
					</td>
					<td style="width:150px;">
					<input type="number" name="total_amount[]" id="item_total_1" oninput="item_total(1);" class="form-control" />
					</td>
					<td>
				<textarea name="item_description" class="form-control" style="resize:none;" cols='15' rows='2'></textarea>
					</td>
					</tr>
					</tbody>
        </table>
			<script>
			$("#addmore").on('click',function(){
			    var i = 2;
				var count = $("#item_table tr").length;
				var count = count/2;
			    var count = count+1;
			var data="<table class='table table-hover' id='table_"+count+"'><thead class='my_background_color'><tr id='row_"+count+"'><th style='width:300px;'>Item Name/Barcode No</th><th style='width:100px;'>Quantity</th><th style='width:70px;'>Price</th><th style='width:70px;'>Total Amount (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:70px;'>Remark <span id='icon_"+count+"' style='float:right'><i class='fa fa-times form-control' style='color:red;border:none;' onclick='for_delete("+count+");' aria-hidden='true'></i></span> </th></tr></thead><tbody><tr><td style='width:300px'><select name='product_name[]' id='product_name_"+count+"' class='form-control select2' style='width:100%' onchange='product_descr(this.value,"+count+");'><option value=''>--Select--</option><?php $select ="select item_product_name,item_purchase_quantity,s_no from item where item_purchase_quantity>0 and item_status='Active'";$run = mysql_query($select);while($row = mysql_fetch_array($run)) { ?> <option value='<?php echo $row['s_no']; ?>'><?php echo $row['item_product_name']; ?></option><?php } ?></select></td><td style='width:100px'><input type='number' name='quantity[]' id='quantity_"+count+"' oninput='item_total("+count+");' value='1' class='form-control' oninput='for_total("+count+");' /></td><td style='width:150px;'><input type='number' name='price[]' id='price_"+count+"' value='' class='form-control' oninput='item_total("+count+");' /></td><td style='width:150px;'><input type='number' name='total_amount[]'id='item_total_"+count+"' class='form-control' oninput='item_total("+count+");' /></td><td><textarea name='description' class='form-control' style='resize:none;' cols='15' rows='2' id='description_"+count+"'></textarea></td></tr></tbody> </table>";
			$('#item_table').append(data);
			i++;
			$('.select2').select2();
			});
			function for_delete(sno){
			if(sno>1){
			//var my_sno=sno-1;
			$('#table_'+sno).remove();
			$('#icon_'+sno).remove();
			//$('#click_'+my_sno).click();
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
			</div>
			  	<div class="col-md-12" style="display:block" id="Payment_mode">
				<div class="col-md-4">
					<div class="form-group">
					 <label> Payment Mode </label>
						<select class="form-control select2" name="invoice_payment_mode" id="invoice_payment_mode" onchange="payment_detail(this.value);for_condition();" style="width:100%" required>
						<?php
						$query4="select * from bank_or_credit_card_info where bank_status='Active' and account_type='Expense Account' and company_code='$company_code'";
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
					 <label>Total Paid</label>
					   <input type="hidden" id="t1" value="" />
						<input type="number" name="invoice_total_paid" id="total_paid" placeholder="Total Paid"  value="" oninput="due_payment(this.value);" class="form-control amt" />
					</div>
				</div>
				<div class="col-lg-4" style="">
					<div class="form-group">
					 <label> Due Amount </label>
						<input type="text" name="invoice_due_amount" id="due_amount" placeholder="Due Amount"  value="" class="form-control" readonly style="border:none;" />
					</div>
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
		  
				    </div> &nbsp;&nbsp;
					
				<div class="col-md-4">
		            <div class="form-group col-md-3">
					 <label>SubTotal</label>
					</div>
					<div class="col-md-2"></div>
					<div class="form-group col-md-7">
					<div class="input-group" >
						<input type="text" name="sub_total" id="sub_total" placeholder="Sub Total"  value="" class="form-control" style="border-style: none;" readonly />
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
					<input type="text" name="grand_total" id="grand_total" placeholder="Grand Total"  value="" class="form-control" readonly style="border:none;" />
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
					<!--<div class="col-md-2">
					<div class="form-group" >
						<input type="submit" name="save_and_print" value="Save and Print" class="form-control btn btn-success">
					</div>
					</div>-->
			        <div class="col-md-4"></div>
					</div>
			</div>	
    </div>
</form>	

	 <?php
 }
 if($expense_type == 'Transport Expense'){
	 ?>
	 <script>
$("#transport_expense").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
    //alert(formdata);
        $.ajax({
            url: software_link+"expense/transport_expense_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
            	console.log(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Complete');
				   post_content('expense/add_expenses',res[2]);
            }
			}
         });
      });
</script>
<form method="post" id="transport_expense" enctype="multipart/form-data">
	<input type="hidden" name="expense_type" value="<?php echo $expense_type; ?>" id="expense_type" />
		<input type="hidden" name="expense_invoice_no"  value="<?php echo $expense_no; ?>" />
	 <input type="hidden" name="invoice_no"  value="<?php echo 'EXP-'.$val; ?>" />
	 <input type="hidden" name="invoice_date"  value="<?php echo date("Y-m-d"); ?>" />
	        <div class="row">
              <div class="col-md-12" id="transport_expense">
					<div class="col-md-4">    
					 <label>Select Transport Name<span style="color:red;">*</span></label>
					 <select name="product_expense_type" class="form-control select2" style="width:100%" onchange="transport_desc(this.value);">
					       <option value="">--Select--</option>
						   <?php $transport = "select * from transport_detail_new where status='Active' and company_code='$company_code'";
                           $run = mysql_query($transport);
                            while($fetchrow = mysql_fetch_array($run)){ ?>
					       <option value="<?php echo $fetchrow['s_no']; ?>"><?php echo $fetchrow['transport_name']; ?></option>
							<?php } ?>
					   </select>
					</div>
					<div class="form-group col-md-4">
					<div class="form-group" >
					  <label>Expense Date</label>
					  <input type="date" name="expense_date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
					</div>
					<div class="form-group col-md-4">
					<div class="form-group" >
					  <label>Mobile no</label>
					  <input type="number" name="expense_contact_no" placeholder="Expense Contact" id="expense_contact" value="" class="form-control">
					</div>
					</div>
	               <div class="col-md-12" id="transport_detail2" style="display:none;">
					  <!-- <div class="col-md-4">    
					 <label>Select Vehicle Type<span style="color:red;">*</span></label>
					 <select name="product_expense_type" id="vehicle_type" class="form-control select2" style="width:100%" onchange="transport_detail(this.value)" required>
					       <option value="">--Select--</option>
						  
					   </select>
					</div> -->
					<div class="col-md-4">    
					 <label>From location<span style="color:red;">*</span></label>
					 <input type="text" name="from_location" id="from_location" class="form-control" required />
					</div>
					<div class="col-md-4">    
					 <label>To location<span style="color:red;">*</span></label>
					 <input type="text" name="to_location" id="to_location" class="form-control" required />
					</div>
					<div class="col-md-4">    
					 <label>Transport Charge<span style="color:red;">*</span></label>
					<input type="number" id="transport_charge" name="transport_charge" class="form-control" />					  
					</div>
			   </div>
				 </div>
					   
		   <div class="col-md-12" id="transport_detail3" style="display:none;">
		            <div class="col-md-4">    
					 <label>Extra Charge<span style="color:red;">*</span></label>
					 <input type="number" name="extra_charge" id="extra_charge" class="form-control" required />
					</div>
		           <div class="col-md-4">    
					 <label>Remark<span style="color:red;">*</span></label>
					<textarea name="remark" class="form-control" cols="2" rows="2" name="remark" id="remark" style="resize:none;"></textarea>
				</div>
			</div>
			</div>
				
				<div class="row">
				 <div class="col-md-12">
				 <center><h4 style="color:red;">* Product Detail In Inventory</h4></center>
				</div>
    <div class="row">
	<div class="col-md-12">
	<div id="item_table">
	<input type="hidden" id="sample2" value="1" />
        <table class="table table-hover" id="table_1">
            <thead class="my_background_color">
                <tr id="row_1">
					<th style="width:300px;">Item Name/Barcode No</th>
					<th style="width:100px;">Quantity</th>
					<th style="width:100px;">Attr Type</th>
					<th style="width:110px;">Remark</th>
                </tr>
            </thead>
			<tbody>
					<tr>
					<td style="width:300px">
					<select name="product_name[]" id="product_name_1" class="form-control select2" style="width:100%" onchange=" product_descr(this.value,1);">
					<option value="">--Select--</option>
					<?php $select = "select item_product_name,item_purchase_quantity,s_no from item where item_purchase_quantity>0 and item_status='Active'";
                     $run = mysql_query($select);					
					 while($row = mysql_fetch_array($run)) { ?>
					  <option value="<?php echo $row['s_no']; ?>"><?php echo $row['item_product_name']; ?></option>
					 <?php } ?>
					</select>
					</td>
					<td style="width:100px">
					<input type="number" name="quantity[]" id="quantity_1" value="1" oninput="item_total(1); check_quantity(this.value,1)" class="form-control" />
					</td>
					<td style="width:250px;">
					<select name="attribute[]" class="form-control select2" id="attr_1"  style="width:100%;">
					    <option value="">--Select--</option>
						<?php $select_atr ="select * from product_attribute_add where company_code='$company_code'";
                        $run = mysql_query($select_atr);
                        while($row_r = mysql_fetch_array($run)){
             							    ?>
						<option value="<?php echo $row_r['s_no']; ?>"><?php echo $row_r['product_attribute_name']; ?></option>
								<?php
						}	?>
					  </select>
					</td>
					<td>
				<textarea name="item_description" class="form-control" style="resize:none;" cols='1' rows='1'></textarea>
					</td>
					</tr>
					</tbody>
        </table>
			<script>
			$("#addmore").on('click',function(){
			    var i = 2;
				var count = $("#item_table tr").length;
				var count = count/2;
			    var count = count+1;
			var data="<table class='table table-hover' id='table_"+count+"'><thead class='my_background_color'><tr id='row_"+count+"'><th style='width:300px;'>Item Name/Barcode No</th><th style='width:100px;'>Quantity</th><th style='width:70px;'>Price</th><th style='width:70px;'>Total Amount (<i class='fa fa-inr' aria-hidden='true'>)</th><th style='width:70px;'>Remark <span id='icon_"+count+"' style='float:right'><i class='fa fa-times form-control' style='color:red;border:none;' onclick='for_delete("+count+");' aria-hidden='true'></i></span> </th></tr></thead><tbody><tr><td style='width:300px'><select name='product_name[]' id='product_name_"+count+"' class='form-control select2' style='width:100%' onchange='product_descr(this.value,"+count+");'><option value=''>--Select--</option><?php $select ="select item_product_name,item_purchase_quantity,s_no from item where item_purchase_quantity>0 and item_status='Active'";$run = mysql_query($select);while($row = mysql_fetch_array($run)) { ?> <option value='<?php echo $row['s_no']; ?>'><?php echo $row['item_product_name']; ?></option><?php } ?></select></td><td style='width:100px'><input type='number' name='quantity[]' id='quantity_"+count+"' oninput='item_total("+count+");' value='1' class='form-control' oninput='for_total("+count+");' /></td><td style='width:150px;'><input type='number' name='price[]' id='price_"+count+"' value='' class='form-control' oninput='item_total("+count+");' /></td><td style='width:150px;'><input type='number' name='total_amount[]'id='item_total_"+count+"' class='form-control' oninput='item_total("+count+");' /></td><td><textarea name='description' class='form-control' style='resize:none;' cols='15' rows='2' id='description_"+count+"'></textarea></td></tr></tbody> </table>";
			$('#item_table').append(data);
			i++;
			$('.select2').select2();
			});
			function for_delete(sno){
			if(sno>1){
			//var my_sno=sno-1;
			$('#table_'+sno).remove();
			$('#icon_'+sno).remove();
			//$('#click_'+my_sno).click();
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
			</div>
			  	<div class="col-md-12" style="display:block" id="Payment_mode">
				<div class="col-md-4">
					<div class="form-group">
					 <label> Payment Mode </label>
						<select class="form-control select2" name="invoice_payment_mode" id="invoice_payment_mode" onchange="payment_detail(this.value);for_condition();" style="width:100%" required>
						<?php
						$query4="select * from bank_or_credit_card_info where bank_status='Active' and account_type='Expense Account' and company_code='$company_code'";
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
					 <label>Total Paid</label>
					   <input type="hidden" id="t1" value="" />
						<input type="number" name="invoice_total_paid" id="total_paid" placeholder="Total Paid"  value="" class="form-control amt" />
					</div>
				</div>
				<div class="col-lg-4" style="">
					<div class="form-group">
					 <label> Due Amount </label>
						<input type="text" name="invoice_due_amount" id="due_amount2" placeholder="Due Amount"  value="" class="form-control" readonly style="border:none;" />
					</div>
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
		  
				    </div> &nbsp;&nbsp;
					
				<div class="col-md-4">
		            <div class="form-group col-md-3">
					 <label>SubTotal</label>
					</div>
					<div class="col-md-2"></div>
					<div class="form-group col-md-7">
					<div class="input-group" >
						<input type="text" name="sub_total" id="sub_total" placeholder="Sub Total"  value="" class="form-control" style="border-style: none;" readonly />
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
					<input type="text" name="grand_total" id="grand_total" placeholder="Grand Total"  value="" class="form-control" readonly style="border:none;" />
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
					<!--<div class="col-md-2">
					<div class="form-group" >
						<input type="submit" name="save_and_print" value="Save and Print" class="form-control btn btn-success">
					</div>
					</div>-->
			      <div class="col-md-4"></div>
			</div>
		</div>
    </div>	
</form>	
	 <?php
 }
?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>