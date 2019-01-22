<?php 
include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Purchase Delivery Challan List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:post_content('purchase/new_delivery_challan','inv_type=sales')"><i class="fa fa-plus"></i> Add Delivery Challan</a></li>
        <li class="active"><i class="fa fa-list"></i> Purchase Delivery Challan List</li>
      </ol>
    </section>
	
<script type="text/javascript">
	function order_return(value)
	{
	
	  if(value == 'Credit Amount')
	  {
	    var invoice_no = document.getElementById('invoice_no2').value;
		var order_return2 = document.getElementById('order_return2').value;
		var order_term = value;
		$.ajax({
		        type:"POST",
				url:software_link+"purchase/ajax_delivery_challan_return_submit.php",
				data:"invoice_no="+invoice_no+"&order_return_reason="+order_return2+"&order_term="+order_term,
				cache:false,
				success:function(detail){
				alert(detail);
				 if(detail==1)
				 {
	             if(window.confirm('Invoice Payment Save Us Future...'))
	             window.open('sales_challan_to_advance.php?invoice_no='+invoice_no+'&invoice_type=sales','_self');
				 }
				}
		     });
		
	   }
	   else
	   { return false; }
	}
	function delivery_challan_type(value)
	{
	   $.ajax({
			  type: "POST",
              url: software_link+"purchase/all_filter.php?purchase_delivery_challan_status="+value+"",
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
</script>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->
 <?php if(!isset($_GET['challan_no'])) { ?>
        <div class="box">
           <div class="box-header">
				<div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "Invoice type" ?></label>
					  <select name="ledger_month" id="extimate_type" onchange="delivery_challan_type(this.value);" class="form-control select2" style="width:100%">
					  <option value="all" selected>All</option>
					  <option value="Draft">Draft</option>
					   <option value="Invoiced">Invoiced</option>
					  <option value="Delivered">Delivered</option>
					  <option value="Return">Returned</option>
					   <option value="No Invoice">No-Invoice</option>
					  <option value="Partially Paid">Partially Invoice</option>
					  </select>
				 </div>
			    </div>
			
			<a href="javascript:post_content('purchase/new_delivery_challan','inv_type=sales')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>  
		</div>
			
            <!-- /.box-header -->
            <div class="box-body table-responsive" id="search_table">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				 <th>Date</th>
                  <th>challan No</th>
                  <th>Refrence</th>
				  <th>Customer Name</th>
				  <th>Status</th>
                  <th>Amount</th>
				
                </tr>
                </thead>
				<tbody >


<?php
$que="select * from purchase_delivery_challan_info where invoice_status='Active' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$challan_no=$row['invoice_no'];
		$challan_type = $row['challan_type'];
		$date = $row['invoice_date'];
		$date = explode("-",$date);
		$date = $date[2]."-".$date[1]."-".$date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_status2 = $row['invoice_status2'];
		$challan_type2 = $row['invoice_type'];
	
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href="javascript:post_content('purchase/purchase_delivery_challan_list','<?php echo 'challan_no='.$challan_no; ?>')"><?php echo $challan_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th style="color:#606125;"><?php echo $invoice_status2; ?></th>
	<th onclick="change_status1('<?php echo $challan_no; ?>');"><?php echo $invoice_grand_total; ?></th>

</tr>
<?php } ?>
<?php
$que="select * from purchase_delivery_challan_draft_info where invoice_status='Active' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$challan_no=$row['invoice_no'];
		$challan_type = $row['challan_type'];
		$date = $row['invoice_date'];
		$date = explode("-",$date);
		$date = $date[2]."-".$date[1]."-".$date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_status2 = $row['invoice_status2'];
		$challan_type2 = $row['invoice_type'];
	
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href="javascript:post_content('purchase/purchase_delivery_challan_list','<?php echo 'challan_no='.$challan_no; ?>')"><?php echo $challan_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th style="color:#606125;"><?php echo $invoice_status2; ?></th>
	<th onclick="change_status1('<?php echo $challan_no; ?>');"><?php echo $invoice_grand_total; ?></th>

</tr>
<?php } ?>
		</tbody>
            
             </table>
            </div>
            <!-- /.box-body -->
          </div>
 <?php }
if(isset($_GET['challan_no']))
{
$challan_no = $_GET['challan_no'];
     ?>
	     <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>#</th>
                  <th>challan No</th>
                  <th>Refrence</th>
				  <th>Customer Name</th>
                  <th>Status</th>
                  <th>Amount</th>
				  <th><center>Action</center></th>
                </tr>
                </thead><tbody id="search_table">
<?php
  $que="select * from purchase_delivery_challan_info where invoice_status='Active' and invoice_no=
'$challan_no' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$numrow = mysql_num_rows($run);
if($numrow<1){
	 $que="select * from purchase_delivery_challan_draft_info where invoice_status='Active' and invoice_no=
'$challan_no' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
}
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$challan_no=$row['invoice_no'];
		$challan_type = $row['challan_type'];
		$date = $row['invoice_date'];
		$date = explode("-",$date);
		$date = $date[2]."-".$date[1]."-".$date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_status2 = $row['invoice_status2'];
		$challan_type2 = $row['invoice_type'];
	
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href="sales_delivery_challan_list.php?challan_no=<?php echo $challan_no; ?>"><?php echo $challan_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th style="color:#606125;"><?php echo $invoice_status2; ?></th>
	<th onclick="change_status1('<?php echo $challan_no; ?>');"><?php echo $invoice_grand_total; ?></th>
<th>
<center>
   <?php if($invoice_status2 =='No Invoice'){ ?>
<a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href='delivery_challan_to_invoice.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Invoice </a> &nbsp;&nbsp;&nbsp;&nbsp;
<?php } else if($invoice_status2 == 'Invoiced') { ?>
<a style="color:#606125;" aria-hidden="true" class="fa fa-truck" href='change_status.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Delivered</a> &nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
   <?php if($invoice_status2 == 'Delivered')
            { ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-refresh"  href='#' data-toggle="modal" data-target="#myModal1" > Return</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<?php if($invoice_status2 != 'Return')
	{ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_delivery_challan_edit.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='#'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" class="fa fa-trash-o" onclick="if(window.confirm('Do You Want Delete..')){  window.open('delivery_challan_delete.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>', '_self'); }" href="#"> Delete</a></center>
</th>
</tr>
<?php } ?>
		</tbody>
            
             </table>
            </div>
            <!-- /.box-body -->
          </div> 
<?php } ?>
          <!-- /.box -->
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
