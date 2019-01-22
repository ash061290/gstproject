<?php 
include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Purchase Order List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:post_content('purchase/new_order','inv_type=sales')"><i class="fa fa-plus"></i> Add Order</a></li>
        <li class="active"><i class="fa fa-list"></i> Purchase Order List</li>
      </ol>
    </section>
	
<script type="text/javascript">
   function search(value){
       $.ajax({
			  type: "POST",
              url: software_link+"purchase/sales_search.php?search_by="+value+"",
              cache: false,
              success: function(detail){
			      //alert(detail);  
            $('#search_table').html(detail);
              }
           });
    }
	function purchase_order_type(value)
	{
	   $.ajax({
			  type: "POST",
              url: software_link+"purchase/all_filter.php?purchase_order_info_status="+value+"",
              cache: false,
              success: function(detail){
			  $('#search_table').html(detail);   
            }
           }); 
	}
</script>

<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete this Record !!!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}
function print_data(value)
{
 //alert(value);
 
}
</script>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->
 <?php if(!isset($_GET['purchase_order_no']))
 { 	 ?>
          <div class="box">
            <div class="box-header">
			  <div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "Invoice type" ?></label>
					  <select name="ledger_month" id="extimate_type" onchange="purchase_order_type(this.value);" class="form-control select2" style="width:100%">
					  <option value="All" selected>All</option>
					  <option value="Draft">Draft</option>
				      <option value="Invoice Created">Invoice Created</option>
				      <option value="Pending Invoice">Pending Invoice</option>
					  <option value="Delivered">Delivered Invoice</option>
					  <option value="Return">Returned Invoice</option>
					  <option value="Partially Paid">Partially Invoice</option>
					  </select>
				 </div>
			    </div>
			  <a href="javascript:get_content('purchase/new_order')"> <button style="float:right; background-color:#00a65a" type="button" class="btn btn-primary">+ Add New</button></a>  
			</div>
			
            <!-- /.box-header -->
            <div class="box-body table-responsive" id="search_table">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Ref</th>
				  <th>Customer Name</th>
                  <th>Status</th>
				   <th>Shippment Date</th>
                  <th>Amount</th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
$que="select * from purchase_order_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$invoice_date1=$row['invoice_date'];
		$invoice_date2=explode('-',$invoice_date1);
		$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
		$order_no=$row['invoice_no'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_due_date1=$row['invoice_due_date'];
		$invoice_due_date2=explode('-',$invoice_due_date1);
		$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_due_amount=$row['invoice_due_amount'];
		$order_type=$row['invoice_type'];
		$ref = $row['invoice_reference'];
		$sales_order_status = $row['purchase_order_status'];
	$serial_no++;
	
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><a href="javascript:post_content('purchase/purchase_order_list','<?php echo 'purchase_order_no='.$order_no; ?>')"><?php echo $order_no; ?></a></th>
	<th><?php echo $ref; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $sales_order_status; ?></span></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
</tr>
<?php } ?>
<?php
$que="select * from purchase_order_draft_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$invoice_date1=$row['invoice_date'];
		$invoice_date2=explode('-',$invoice_date1);
		$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
		$order_no=$row['invoice_no'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_due_date1=$row['invoice_due_date'];
		$invoice_due_date2=explode('-',$invoice_due_date1);
		$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_due_amount=$row['invoice_due_amount'];
		$order_type=$row['invoice_type'];
		$ref = $row['invoice_reference'];
		$sales_order_status = $row['purchase_order_status'];
	$serial_no++;
	
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><a href="javascript:post_content('purchase/purchase_order_list','<?php echo 'purchase_order_no='.$order_no; ?>')"><?php echo $order_no; ?></a></th>
	<th><?php echo $ref; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $sales_order_status; ?></span></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
</tr>
<?php  } ?>
		</tbody>
            
             </table>
            </div>
            <!-- /.box-body -->
          </div>
		  <?php } 
		  if(isset($_GET['purchase_order_no']))
		  {
			  $purchase_order_no = $_GET['purchase_order_no'];
			   ?>
		       <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive" >
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Ref</th>
				  <th>Customer Name</th>
                  <th>Status</th>
				   <th>Shippment Date</th>
                  <th>Amount</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody>


<?php
$que="select * from purchase_order_info where invoice_status='Active' and invoice_no=
'$purchase_order_no' and company_code='$company_code' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$invoice_date1=$row['invoice_date'];
		$invoice_date2=explode('-',$invoice_date1);
		$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
		$order_no=$row['invoice_no'];
		$qry22 = "select * from purchase_invoice_info where invoice_status='Active' and challan_no='$order_no'";
		$fetchr = mysql_query($qry22);
		$row22 = mysql_fetch_array($fetchr);
		$invoice_no = $row22['invoice_no'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_due_date1=$row['invoice_due_date'];
		$invoice_due_date2=explode('-',$invoice_due_date1);
		$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_due_amount=$row['invoice_due_amount'];
		$order_type=$row['invoice_type'];
		$ref = $row['invoice_reference'];
		$sales_order_status = $row['purchase_order_status'];
	$serial_no++;
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><?php echo $order_no; ?><br/>
	    <?php echo $invoice_no; ?>
	 </th>
	<th><?php echo $ref; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $sales_order_status; ?></span></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
<th>
<center>
   <?php if($sales_order_status == 'No Invoice'){ ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href='order_to_invoice.php?order_no=<?php echo $order_no; ?>&order_type=<?php echo $order_type; ?>'> Invoice </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<?php if($sales_order_status != 'Invoice Created'){ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_order_edit.php?order_no=<?php echo $order_no; ?>&order_type=<?php echo $order_type; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href="#" onclick="print_data(<?php echo $s_no; ?>)">Print</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction('<?php echo $order_no; ?>');" class="fa fa-trash-o" href='order_delete.php?order_no=<?php echo $order_no; ?>&order_type=<?php echo $order_type; ?>'> Delete</a></center>
	
</th>

</tr>
<?php }
  ?>
  
  <!--draft -->
  <?php
$que="select * from purchase_order_draft_info where invoice_status='Active' and invoice_no=
'$purchase_order_no' and company_code='$company_code' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
	
		$s_no=$row['s_no'];
		$invoice_date1=$row['invoice_date'];
		$invoice_date2=explode('-',$invoice_date1);
		$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
		$order_no=$row['invoice_no'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_due_date1=$row['invoice_due_date'];
		$invoice_due_date2=explode('-',$invoice_due_date1);
		$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_due_amount=$row['invoice_due_amount'];
		$order_type=$row['invoice_type'];
		$ref = $row['invoice_reference'];
		$sales_order_status = $row['purchase_order_status'];
	$serial_no++;
	
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><?php echo $order_no; ?></th>
	<th><?php echo $ref; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $sales_order_status; ?></span></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
<th>
<center>
   <?php if($sales_order_status == 'No Challan'){ ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href='order_to_delivery_challan.php?order_no=<?php echo $order_no; ?>&order_type=<?php echo $order_type; ?>'> Challan </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<?php if($sales_order_status != 'Challan Created'){ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_order_edit.php?order_no=<?php echo $order_no; ?>&order_type=<?php echo $order_type; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='#'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction('<?php echo $order_no; ?>');" class="fa fa-trash-o" href='order_delete.php?order_no=<?php echo $order_no; ?>&order_type=<?php echo $order_type; ?>'> Delete</a></center>
	
</th>

</tr>
<?php }
  ?>
  <!--end-->
		</tbody>
            
             </table>
            </div>
            <!-- /.box-body -->
          </div>



<?php
}   ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
