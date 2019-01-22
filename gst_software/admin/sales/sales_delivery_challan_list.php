<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Sales Delivery Challan List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:post_content('sales/new_delivery_challan','inv_type=sales')"><i class="fa fa-plus"></i> Add Delivery Challan</a></li>
        <li class="active"><i class="fa fa-list"></i> Sales Delivery Challan List</li>
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
				url: software_link+"sales/ajax_delivery_challan_return_submit.php",
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
              url: software_link+"sales/all_filter.php?sales_delivery_challan_status="+value+"",
              cache: false,
              success: function(detail){
			  $('#search_table').html(detail);   
            }
           }); 
	}
	
   function inv_status(value){
	    $.ajax({
			  type: "POST",
              url: software_link+"sales/change_status.php?challan_no="+value+"",
              cache: false,
              success: function(detail){
				  //alert(detail);
            }
           }); 
   }	
$("#credit_note_form").submit(function(e){
        e.preventDefault();
       var formdata = new FormData(this);
        $.ajax({
            url: software_link+"sales/sales_delivery_challan_credit_note_api.php",			
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   alert(res[1]);
			   if(res[1]=='success'){
				    alert(res[2]);
			       alert('Successfully Complete');
				   post_content('sales/sales_delivery_challan_list','challan_no='+res[2]);
            }
			}
         });
      });   
</script>
    <!-- Main content -->
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
			<a href="javascript:post_content('sales/new_delivery_challan','inv_type=sales')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>  
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
$que="select * from sales_delivery_challan_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
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
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
  ?>
<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href="javascript:post_content('sales/sales_delivery_challan_list','challan_no=<?php echo $challan_no; ?>')"><?php echo $challan_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th style="color:#606125;">
	<a href="<?php if($invoice_status2=="Open"){ echo "javascript:post_content('sales/sales_delivery_confirm','challan_no=$challan_no&challan_type=$challan_type2')"; } else{ echo"javascript:post_content('sales/sales_delivery_challan_list','challan_no=$challan_no')";} ?>"><?php echo $invoice_status2; ?></a></th>
	<th><?php echo $invoice_grand_total; ?></th>
</tr>
<?php  $serial_no++; } ?>
    <!-- /.box-body -->
             </table>
            </div>
        
		  <?php }
     else
{
if(isset($_GET['challan_no']))
{
$challan_no = $_GET['challan_no'];
?>
 <div class="box">
            <div class="box-header">
			<a href="javascript:post_content('sales/new_delivery_challan','inv_type=sales')"> <button style="float:right; background-color:#00a65a"  type="button" class="btn btn-primary">+ Add New</button></a>  
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
                  <th>Amount</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody >
<?php
$que="select * from sales_delivery_challan_info where invoice_status='Active' and invoice_no='$challan_no' and company_code='$company_code' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$num = mysql_num_rows($run);
if($num<1)
{
$que="select * from sales_delivery_challan_draft_info where invoice_status='Active' and invoice_no='$challan_no' and company_code='$company_code' GROUP BY invoice_no";
$run = mysql_query($que) or die(mysql_error());
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
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
  ?>
<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href="#"><?php echo $challan_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th onclick="change_status1('<?php echo $challan_no; ?>');"><?php echo $invoice_grand_total; ?></th>
<th>
<center>
   <?php if($invoice_status2 =='Open'){ ?>
<a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href="javascript:post_content('sales/delivery_challan_to_invoice','challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>')"> Invoice </a> &nbsp;&nbsp;&nbsp;&nbsp;
<?php } else if($invoice_status2 == 'Invoiced') { ?>
<a style="color:#606125;" aria-hidden="true" class="fa fa-truck" href="javascript:post_content('sales/change_status','challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>')"> Delivered</a> &nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
   <?php if($invoice_status2 == 'Delivered')
            { ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-refresh" href='#' data-toggle="modal" data-target="#myModal1" > Return</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<?php if($invoice_status2 != 'Return')
	{ ?>
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="javascript:post_content('sales/new_delivery_challan_edit','challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>')"> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='#'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" class="fa fa-trash-o" onclick="if(window.confirm('Do You Want Delete..')){  window.open('delivery_challan_delete.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>', '_self'); }" href="#"> Delete</a></center>
</th>
</tr>
<?php  $serial_no++; } ?>
		</tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
<?php
}	
} ?>
<!-- modal start -->
<form method="post" enctype="multipart/form-data" id="credit_note_form">
  <!-- Modal Start -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#00a65a; color:#f9f9f9;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">Invoice Credit Notes</h4></center>
        </div>
		<input type="hidden" name="inv_no" value="<?php echo $_GET['challan_no']; ?>" />
        <div class="modal-body">
		<?php
					$query2="select * from invoice_no where company_code='$company_code'";
					$res2=mysql_query($query2);
					while($row2=mysql_fetch_array($res2)){
					$credit_no1=$row2['credit_no'];
					$val=substr($credit_no1, 1);
					}
					?>
					<input type="hidden" name="credit_note_no" value="<?php echo $credit_no1; ?>" />
		<div class="col-md-12">
			 <label>Credit No : </label>
		      <input type="text" name="credit_no" value="<?php echo 'CRD-'.$val; ?>" class="form-control" readonly />
			</div>
		
          <div class="col-md-12">
		  	<br/>
		    <div class="col-md-12">
			 <label>Credit Notes Reasons : </label>
		      <select class="form-control select2" name="credit_notes_reason" id="credit_note_reason" style="width:100%;">
			     <option value="Sales Return">Sales Return</option>
				 <option value="Deficiency In Service">Deficiency In Service</option>
				 <option value="Correction In Invoice">Correction In Invoice</option>
				 <option value="Change In Pos">Change In Pos</option>
				  <option value="Other Reason">Other Reason</option>
				 <option></option>
				</select>
			</div>
			<div class="col-md-6">
			<br/>
			<label>Reason For Retun/Cancel</label>
			<textarea cols="6" rows="4" name="reason_return" id="order_return2" class="form-control"></textarea>
			</div>
			<div class="col-md-6">
			<br/>
			<label>Order Return Term</label>
			<select name="order_return_term" class="form-control" onchange="order_return(this.value)" required>
			   <option value="Refund Order">Refund Order</option>
			   <option value="Credit Order">Credit Order</option>
			  </select>
			  <br/>
			  <label>Order Return Types</label>
			  <select name="order_return_type" class="form-control" onchange="order_return_type(this.value)" required>
			   <option value="Product Return">Product Return</option>
			   <option value="Order Cancel">Order Cancel</option>
			  </select>
			   <br/>
			</div>
		  </div>
		         </div>
				
        <div class="modal-footer">
		
		 <input type="submit" class="btn my_background_color" name="modal_submit" value="Submit" />
		  &nbsp;&nbsp;
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal End -->
  </form>
          <!-- /.box -->
		  <!-- status update -->
		  
		  <!--end-->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
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