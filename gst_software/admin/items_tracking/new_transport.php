<?php include("../../attachment/session.php"); ?>
 	 <script type="text/javascript">
			var deleteRow = function (link) {
			var row = link.parentNode.parentNode;
			var table = row.parentNode;
			table.removeChild(row); 
			}
		</script>
 
  </script>
  <script>
$("#transport_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"items_tracking/new_transport_api.php",
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
				   get_content('items_tracking/transport_list');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
        Create New Transport
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="javascript:get_content('items_tracking/packages_invoice_list')"><i class="fa fa-shopping-cart"></i>Package Details</a></li>
        <li class="active">Add Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
	<form method="post" onsubmit="return validate();" id="transport_form" enctype="multipart/form-data">
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
              <div class="col-md-12">
					<div class="form-group col-md-4">
					 <label>Transport Name <span style="color:red;">*</span></label>
					  <input type="text" name="transport_name" id="transport" placeholder="Transport Name" class="form-control" />
					<br><br>
					</div>
					<div class="form-group col-md-4">
					  <label>From Location</label>
					   <input type="text" name="transport_from" placeholder=" From Location"  class="form-control">
					</div>
					<div class="form-group col-md-4">
					 <label>To Location</label>
					  <input type="text" name="transport_to" id="invoice_date" placeholder="To Location" class="form-control">
					</div>
				</div>
				
				<div class="col-md-12">
					   <div class="form-group col-md-4">
					 <label>Vehicle Type</label>
					 <select name="vehicle_type" class="form-control select2"> 
					       <option>--Select--</option>
					       <option value="Full Truck Loader">Full Truck Loader</option> 
                           <option value="Half Truck Loader">Half Truck Loader</option>
                           <option value="Small Pickup loader">Small Pickup loader</option>	
                           <option value="Big Pickup loader">Big Pickup loader</option>							   
						   </select>
					</div> 
               <div class="form-group col-md-4">
					 <label>Vehicle No</label>
					  <input type="text" name="vehicle_no" id="vehicle_no" placeholder="Vehicle No" class="form-control">
					</div>	
               <div class="form-group col-md-4">
					 <label>Tracking No</label>
					  <input type="text" name="tracking_no" id="tracking_no" placeholder="Tracking No" class="form-control">
					</div>					
				</div>
				<div class="col-lg-12">
					<div class="form-group col-md-4">
					 <label>Transport Charge</label>
					 <input type="number" name="transport_charge" placeholder="Transport Charge" class="form-control" />
					</div>
					<div class="form-group col-md-4">
					 <label>Extra Charge</label>
					 <input type="number" name="extra_charge" placeholder="Extra Charge" class="form-control" />
					</div>
					<div class="form-group col-md-4">
					 <label>Remark</label>
						  <textarea cols="4" rows="3" style="resize:none;" class="form-control" name="remark"></textarea>
					</div>
				</div>	
				</div>
		<div class="box-footer">
					<div class="col-md-12">
					<br/>
					<br/>
					<div class="col-md-4"></div>	
					<div class="col-md-4">
					<div class="form-group">
						<input type="submit" name="save" value="Save" class="form-control btn btn-success">
					</div>
					</div>
					<div class="col-md-4"></div>
					</div>
			</div>

<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
		  	</div>
    </div>
</section>
</form>	
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>

<?php
if(isset($_POST['save']) || isset($_POST['save_and_print'])){
$invoice_no=$_POST['invoice_no'];
$invoice_date=$_POST['invoice_date'];
$invoice_reference=$_POST['invoice_reference'];
$invoice_due_date=$_POST['invoice_due_date'];
$pay_term = $_POST['payment_term'];
$invoice_date = $_POST['invoice_date'];
$invoice_firm_name=$_POST['invoice_firm_name'];
$pay_term = $_POST['payment_term'];
$customer_payment_term_update = "update contact_master set contact_payment_terms='$pay_term' where s_no='$invoice_firm_name'";
mysql_query($customer_payment_term_update);
$invoice_type=$_POST['invoice_type'];
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
$box_num = $_POST['box_quantity'];
$invoice_payment_mode="";
$payment_mode="";
$cheque_status="";
$table_name='packages_invoice_info';
$page_name='packages_invoice_list.php';
$transaction_type='Credit';
$stock_quantity_rate_update='';
$save=0;
$count=count($item_product_name);
for($i=0; $i<$count; $i++){
echo $query="insert into $table_name(invoice_no,shipping_no,delivery_no,invoice_date,invoice_reference,
invoice_due_date,invoice_firm_name,invoice_billing_address,invoice_shipping_address,
invoice_gstin_no,invoice_place_of_supply,invoice_product_name,invoice_description,
invoice_hsn,invoice_quantity,invoice_available_quantity,invoice_item_unit,invoice_rate,
invoice_rate1,invoice_price_fix,invoice_discount,invoice_discount_type,invoice_taxable,
invoice_tax_type,invoice_tax,invoice_cgst,invoice_cgst1,invoice_sgst,invoice_sgst1,
invoice_igst,invoice_igst1,invoice_total,invoice_extra_expences,invoice_sub_total,
invoice_total_discount,invoice_total_discount_type,invoice_grand_total,invoice_payment_mode,
invoice_total_paid,remark,invoice_due_amount,invoice_customer_notes,
invoice_terms_and_conditions,invoice_type,invoice_status,invoice_shipping_charge,
account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,
cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,
stock_quantity_rate_update,payment_count,
order_status,box_num) values('$invoice_no','','','$invoice_date','$invoice_reference',
'$invoice_due_date','$invoice_firm_name','$invoice_billing_address','$invoice_shipping_address',
'$invoice_gstin_no','$invoice_place_of_supply','$item_product_name[$i]','$item_description[$i]',
'$item_hsn[$i]','$item_quantity[$i]','$item_avail_quantity[$i]','$item_unit[$i]','$item_price[$i]',
'$item_price1[$i]','$item_price_fix[$i]','$item_discount[$i]','$item_discount_type[$i]','$item_taxable[$i]',
'$item_tax_type[$i]','$item_tax_amount[$i]','$item_cgst[$i]','$item_cgst1[$i]','$item_sgst[$i]','$item_sgst1[$i]',
'$item_igst[$i]','$item_igst1[$i]','$item_total_amount[$i]','$invoice_extra_expences','$invoice_sub_total',
'$total_invoice_discount','$total_discount_type','$invoice_grand_total','$invoice_payment_mode',
'$invoice_total_paid','$remark','$invoice_due_amount','$invoice_customer_notes','$invoice_terms_and_conditions',
'$invoice_type','Active','','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount',
'$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','','','Package','$box_num[$i]')";
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
$que3="insert into account_info(date,customer_id,payment_mode,bank_s_no,account_type,account_name,cheque_dd,cheque_dd_no,cheque_dd_amount,cheque_dd_issue_date,cheque_dd_clearing_date,transaction_type,invoice_no,invoice_grand_total,invoice_total_paid,invoice_due_amount,folder_name,upload_file,account_status,cheque_status) values('$invoice_date','$invoice_firm_name','$payment_mode','$invoice_payment_mode','$account_type','$account_name','$cheque_dd','$cheque_dd_no','$cheque_dd_amount','$cheque_dd_issue_date','$cheque_dd_clearing_date','$transaction_type','$invoice_no','$invoice_grand_total','$invoice_total_paid','$invoice_due_amount','$folder_id','$upload_file_name','Active','$cheque_status')";
mysql_query($que3);
$folder_id=$folder_id+1;
if($invoice_type=='sales'){
$package_invoice_no=$package_invoice_no+1;
}else{
$package_invoice_no=$package_invoice_no;
}
$que2="update invoice_no set folder_id='$folder_id',package_invoice_no='$package_invoice_no'";
mysql_query($que2);

if($save>0){
echo "<script>window.open('$page_name','_self');</script>";
}
}

?>
