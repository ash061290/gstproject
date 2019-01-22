<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("link_css.php")?>
</head>
<body class="hold-transition skin-green sidebar-collapse sidebar-mini">
<div class="wrapper">
  <?php include("../attachment/header.php"); ?>
  <?php include("../attachment/sidebar.php"); ?>
  <?php include("../../connection/connect.php"); ?>
 <?php $order_id = $_GET['order_no'];
    $select_sale = "select * from sales_invoice_info where invoice_no='INV-00025'";
	$runqry = mysql_query($select_sale);
	$row_run = mysql_fetch_array($runqry);
    $billing_address = $row_run['invoice_billing_address'];
	$s_no = $row_run['s_no'];
	$order_id = $row_run['invoice_no'];
	$order_date = $row_run['invoice_date'];
	$invoice_ref = $row_run['invoice_reference'];
	$invoice_desc = $row_run['invoice_description'];
	$invoice_quantity = $row_run['invoice_quantity'];
	$invoice_rate = $row_run['invoice_rate'];
	$invoice_tax = $row_run['invoice_tax'];
	$invoice_grand_total = $row_run['invoice_grand_total'];

  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Order List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="new_order.php"><i class="fa fa-plus"></i> Add Order</a></li>
        <li class="active"><i class="fa fa-list"></i> Sales Order List</li>
      </ol>
    </section>
<script type="text/javascript">
   function search(value){
               
       $.ajax({
			  type: "POST",
              url: software_link+"item_tracking/sales_search.php?search_by="+value+"",
              cache: false,
              success: function(detail){
			      //alert(detail);  
            $('#search_table').html(detail);
              }
           });
    }
	function packaging(value)
	{
	   var s_no = value;
	    $.ajax({
			  type: "POST",
              url: software_link+"item_tracking/sales_update.php?s_no="+s_no+"",
              cache: false,
              success: function(detail){
			  alert(detail);
              window.location.assign("sales_order.php");
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
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
			</div>
			<div class="col-xs-12 col-md-8" style="border-right:1px solid #332575;">
			<div class="box-header">
			<div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-th"></i>Sales Order<br/><span style="font-size:14px;">Sales Order : <a>#<?php echo $order_id; ?></a></span><br/></li>
			  <li class="header">Billing Address
			  <p style="font-size:14px;"><?php echo $billing_address; ?></p></li>
            </ul></div></div>
			 <div class="col-xs-12" style="background-color:#DBE6EA;">
			 <div class="col-xs-6">
			<div style="background-color:#DBE6EA;">
			    <table class="table table_bordared">
					 <tr>
					     <td><label>Ref Name</label></td>
						 <td><?php echo $invoice_ref; ?></td>
					 </tr>
					  <tr>
					     <td> <label>Order Date</label></td>
						 <td><?php echo $order_date; ?></td>
					 </tr>
				 </table>
			  </div>
			  </div>
			  <div class="col-xs-6"></div>
			  <br/>
			  </div>
			  <div class="col-xs-12">
			   <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-responsive" style="background-color:white;">
            <thead class="my_background_color">
                <tr>
					<th style="width:50px;">#</th>
					<th style="width:70px;">Invoice No</th>
					<th style="width:200px;">Item Name</th>
					<th style="width:70px;">Qty</th>
					<th style="width:70px;">Rate</th>
					<th style="width:70px;">Tax Amount</th>
					<th style="width:100px;">Total Amount (<i class="fa fa-inr" aria-hidden="true">)</th>
                </tr>
            </thead>
			<tbody>
			<?php
			$que12="select * from sales_invoice_info where invoice_no='$order_id' and invoice_status='Active'";
			$run12=mysql_query($que12) or die(mysql_error());
			$serial=0;
			$i = 0;
			while($row12=mysql_fetch_array($run12)){
			$invoice_s_no=$row12['s_no'];
			$invoice_description=$row12['invoice_description'];
			$invoice_quantity=$row12['invoice_quantity'];
			$invoice_rate=$row12['invoice_rate'];
			$invoice_tax=$row12['invoice_tax'];
			$invoice_grand_total=$row12['invoice_grand_total'];
			$invoice_total=$row12['invoice_sub_total'];
			$invoice_product_name = $row12['invoice_product_name'];
			 $qry2 = "select * from item_master where s_no='$invoice_product_name'";
			 $run = mysql_query($qry2);
			 $rowfetch = mysql_fetch_array($run);
			 $product_name = $rowfetch['item_product_name'];
		    $serial++;
			$serial_array[$i] = $serial;
			$i++;
			?>
			 <tr id="<?php echo 'row_'.$serial; ?>">
					<td><span id='<?php echo 'row_'.$serial; ?>'><?php echo $serial; ?></span></td>
					<td>
					 <div class="form-group">
							<label><?php echo $order_id; ?></label>
						</div>
					</td>
					<td><?php echo $product_name; ?></td>
					<td><div>
					<label><?php echo $invoice_quantity; ?></label>
					</div></td>
					<td><?php echo $invoice_rate; ?></td>
					<td><?php echo $invoice_tax; ?></td>
					<td><?php echo $invoice_total; ?></td>
				  <?php $total_amount[$i] = $invoice_total; ?>
             </tr>
			 <?php } $total_amount=array_sum($total_amount); ?>
			</tbody>
        </table>
		<br>
    <div class="pull-right header">
	    <ul style="list-style-type:none; padding:5px;">
		<li style="font-size:18px;"><b>Total Paid Amount :&nbsp;&nbsp;&#8377;&nbsp;<?php echo $total_amount; ?></b></li>
		</ul>
	 </div>
			<br/>
			<br/>
			<br/>
	     </div>
			  </div>
			</div>
			<div class="col-xs-4"></div>	
            <!-- /.box-header -->
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
</body>
</html>
