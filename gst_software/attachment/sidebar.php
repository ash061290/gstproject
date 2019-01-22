  <!-- Left side column. contains the logo and sidebar -->
<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Logout!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
}
</script>
<?php 
    $id = $_SESSION['firm_id'];
	if($_SESSION['user_role'] == "Main_Admin"){
    $que="select * from admin_firm_detail where id='$id'";
	$run=mysql_query($que);
	if($row=mysql_fetch_array($run)){
	echo $username = $row['admin_name'];
	$contact = $row['firm_contact'];
	$image = $row['firm_logo'];
    $designation = "Admin";
    }
	}
	if($_SESSION['user_role']=='Admin' || $_SESSION['user_role']=='Employee'){
		  $que="select * from user_detail where company_code='$id' and user_mobile='".$_SESSION['emp_id']."'";
	      $run=mysql_query($que);
	      if($row=mysql_fetch_array($run)){
	     $username = $row['user_name'];
	     $contact = $row['user_mobile'];
	     $image = $row['upload_file'];
         $designation = $row['user_role'];
	     }
	}
?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
		
		<img  src="<?php if($image !=''){ echo 'data:image;base64,'.$image; }else{ echo "../gst_software/images/Profile.png"; }  ?>" id="show_bill_upload" height="50" width="50" style="margin-top:10px;" class="img-circle" alt="User Image">
         
        </div>
        <div class="pull-left info">		
          <p><?php echo $username." (".$designation.")" ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search  -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search  -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
		<li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
		<?php if(isset($_SESSION['banking']) || isset($_SESSION['permission'])){	?>
		<li class="treeview">
          <a href="">
            <i class="fa fa-university"></i><span>Banking</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript:get_content('banking/banking')"><i class="fa fa-arrow-circle-right"></i>Banking Details</a></li>
			<!--<li><a href="javascript:get_content('banking/cheque_dd_details')"><i class="fa fa-arrow-circle-right"></i>Payments</a></li>-->
             <li><a href="javascript:get_content('banking/cheque_detail')"><i class="fa fa-arrow-circle-right"></i>Cheque detail</a></li>
           <!-- <li><a href="javascript:get_content('banking/neft_details')"><i class="fa fa-arrow-circle-right"></i>Neft Details</a></li> -->
            <!--<li><a href="javascript:get_content('banking/cash_add')"><i class="fa fa-arrow-circle-right"></i>Cash Details</a></li>-->
          </ul>
        </li>	
		<?php } ?>		
		<?php if(isset($_SESSION['inventory']) || isset($_SESSION['permission'])){ ?>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-indent"></i> <span>Inventory</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
		    <li><a href="javascript:get_content('inventory/product_attribute_add')"><i class="fa fa-arrow-circle-right"></i>Add Product Attribute</a></li>
			<li><a href="javascript:get_content('inventory/brand_add')"><i class="fa fa-arrow-circle-right"></i>Add Brand</a></li>
			<li><a href="javascript:get_content('inventory/category_add')"><i class="fa fa-arrow-circle-right"></i>Add Category</a></li>
			<li><a href="javascript:get_content('inventory/subcategory_add')"><i class="fa fa-arrow-circle-right"></i>Add SubCategory</a></li>
      <!--<li><a href="javascript:get_content('inventory/product_model_no_add')"><i class="fa fa-arrow-circle-right"></i>Product Model No</a></li>
	        <li><a href="javascript:get_content('inventory/product_name_add')"><i class="fa fa-arrow-circle-right"></i>Add Product</a></li>
			<li><a href="javascript:get_content('inventory/price_list')"><i class="fa fa-arrow-circle-right"></i>Price List</a></li>
			<li><a href="javascript:get_content('inventory/company_wise_product_add')"><i class="fa fa-arrow-circle-right"></i>Add Prod. & Company</a></li>
            <li><a href="javascript:get_content('inventory/item_details')"><i class="fa fa-arrow-circle-right"></i>Item Details</a></li>-->			
			<li><a href="javascript:get_content('inventory/items')"><i class="fa fa-arrow-circle-right"></i>Add Items</a></li>
     <!-- <li><a href="javascript:get_content('inventory/item_master')"><i class="fa fa-arrow-circle-right"></i>Items Master</a></li>-->
			<li><a href="javascript:get_content('inventory/item_details')"><i class="fa fa-arrow-circle-right"></i>Generate Item Barcode</a></li>
      <li><a href="javascript:get_content('inventory/item_list')"><i class="fa fa-arrow-circle-right"></i>Item Adjustments</a></li>
          </ul>
        </li>
		<?php } ?>
		<!--
		<li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Invoice</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="javascript:post_content('sales/new_invoice','inv_type=sales')"><i class="fa fa-arrow-circle-right"></i>Sales Invoice</a></li>
			<li><a href="javascript:post_content('purchase/new_invoice','inv_type=purchase')"><i class="fa fa-arrow-circle-right"></i>Purchase Invoice</a></li>
          </ul>
        </li>-->
		<?php if(isset($_SESSION['sales']) || isset($_SESSION['permission'])){ ?>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-basket"></i> <span>Sales</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		   <li><a href="javascript:get_content('sales/sales_order')"><i class="fa fa-arrow-circle-right"></i>Sales Order</a></li>
		  
			<!--<li><a href="javascript:get_content('sales/sales_order_list')"><i class="fa fa-arrow-circle-right"></i>Sales Order</a></li>-->
			<!--<li><a href="javascript:get_content('sales/sales_order_draft_list')"><i class="fa fa-arrow-circle-right"></i>Sales Order Draft</a></li>-->
			
            <!--<li><a href="javascript:get_content('sales/sales_delivery_challan_list')"><i class="fa fa-arrow-circle-right"></i>Delivery Challan</a></li>-->
            <!--<li><a href="javascript:get_content('sales/sales_delivery_challan_draft_list')"><i class="fa fa-arrow-circle-right"></i>Delivery Challan Draft</a></li>-->
			
            <li><a href="javascript:get_content('sales/new_invoice')"><i class="fa fa-arrow-circle-right"></i>Sales Invoice</a></li>
			<li><a href="javascript:get_content('sales/invoice_payment_add')"><i class="fa fa-arrow-circle-right"></i>Sales Payment</a></li>
			<li><a href="javascript:get_content('sales/credit_note')"><i class="fa fa-arrow-circle-right"></i>Credit Notes</a></li>
			<!--<li><a href="javascript:get_content('sales/recuring_invoice')"><i class="fa fa-arrow-circle-right"></i>Recuring Invoice</a></li>-->
			<!--<li><a href="javascript:get_content('sales/retainer_invoice')"><i class="fa fa-arrow-circle-right"></i>Retainer Invoice</a></li>-->
          </ul>
        </li>
		<?php } ?>
		<?php if(isset($_SESSION['purchase']) || isset($_SESSION['permission'])){ ?>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-cart-arrow-down"></i> <span>Purchase</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
		   <li><a href="javascript:get_content('purchase/invoice_payment_add')"><i class="fa fa-arrow-circle-right"></i>Purchase Payment</a></li>
			<li><a href="javascript:get_content('purchase/new_invoice')"><i class="fa fa-arrow-circle-right"></i>Purchase Invoice</a></li>
			<!--<li><a href="javascript:get_content('purchase/purchase_estimate_draft_list')"><i class="fa fa-arrow-circle-right"></i>Purchase Est. Draft</a></li>-->		  
			<!--<li><a href="javascript:get_content('purchase/purchase_order_list')"><i class="fa fa-arrow-circle-right"></i>purchase Order</a></li>-->
            <!--<li><a href="javascript:get_content('purchase/purchase_order_draft_list')"><i class="fa fa-arrow-circle-right"></i>Purchase Order draft</a></li>
			-->
			<!--<li><a href="javascript:get_content('purchase/purchase_delivery_challan_list')"><i class="fa fa-arrow-circle-right"></i>Delivery Challan</a></li>
			<!--<li><a href="javascript:get_content('purchase/purchase_delivery_challan_draft_list')"><i class="fa fa-arrow-circle-right"></i>Delivery Challan Draft</a></li>-->
			<li><a href="javascript:get_content('purchase/debit_note')"><i class="fa fa-arrow-circle-right"></i>Debit Note</a></li>
          </ul>
        </li>
		<?php } if(isset($_SESSION['expense']) || isset($_SESSION['permission'])){ ?>
		<li class="treeview">
           <a href="attendance">
            <i class="fa fa-money"></i> <span>Expenses</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
          <ul class="treeview-menu">
		    <li><a href="javascript:get_content('expense/view_expenses')"><i class="fa fa-arrow-circle-right"></i>View Expense</a></li>
			<li><a href="javascript:get_content('expense/add_expenses')"><i class="fa fa-arrow-circle-right"></i>Single Expense</a></li>
			<li><a href="javascript:get_content('expense/bulk_expenses')"><i class="fa fa-arrow-circle-right"></i>Bulk Expenses</a></li>
          </ul>
        </li>
		<?php } if(isset($_SESSION['report']) || isset($_SESSION['permission'])){ ?>
		<li class="treeview">
           <a href="attendance">
            <i class="fa fa-money"></i> <span>Report</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
          <ul class="treeview-menu">
        <li><a href="javascript:get_content('report/inventory_report')"><i class="fa fa-arrow-circle-right"></i>Inventory Report</a></li>
		<li><a href="javas cript:get_content('report/product_report')"><i class="fa fa-arrow-circle-right"></i>Product Report</a></li>
        <li><a href="javascript:get_content('report/Sale_report')"><i class="fa fa-arrow-circle-right"></i>Sale Report</a></li>
      <li><a href="javascript:get_content('report/Purchase_report')"><i class="fa fa-arrow-circle-right"></i>Purchase Report</a></li>
          </ul>
        </li>
		<?php } ?>
	<?php if(isset($_SESSION['contact']) || isset($_SESSION['permission'])){ ?>
		<li class="treeview"><a href="javascript:get_content('contact/contact_list')"><i class="fa fa-address-book-o"></i> <span>Contact</span></a>
		<ul class="treeview-menu">
        <li><a href="javascript:get_content('contact/regular_customer')"><i class="fa fa-arrow-circle-right"></i>Regular Customer</a></li>
        <li><a href="javascript:get_content('contact/contact_list')"><i class="fa fa-arrow-circle-right"></i>Retailer Customer</a></li>
          </ul>
		</li>	
		<?php } if(isset($_SESSION['recycle']) || isset($_SESSION['permission'])){ ?>
		<li class="treeview">
           <a href="">
            <i class="fa fa-bitbucket"></i> <span>Recycle Bin</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
          <ul class="treeview-menu">
        <li><a href="javascript:get_content('recycle/sales_recycle')"><i class="fa fa-arrow-circle-right"></i>sales  Recycle</a></li>
        <li><a href="javascript:get_content('recycle/purchase_recycle')"><i class="fa fa-arrow-circle-right"></i>Purchase Recycle</a></li>
         <li><a href="javascript:get_content('recycle/expenses_recycle')"><i class="fa fa-arrow-circle-right"></i>Expenses Recycle</a></li>
        <li><a href="javascript:get_content('recycle/inventory_recycle')"><i class="fa fa-arrow-circle-right"></i>Inventory Recycle</a></li>
        <li><a href="javascript:get_content('recycle/report_recycle')"><i class="fa fa-arrow-circle-right"></i>Report Recycle</a></li>
         <li><a href="javascript:get_content('recycle/contact_recycle')"><i class="fa fa-arrow-circle-right"></i>Contact Recycle</a></li>
          </ul>
        </li>
		<?php } ?>
		<?php if(isset($_SESSION['items_tracking']) || isset($_SESSION['permission'])){ ?>
		<li><a href="javascript:get_content('items_tracking/packages_invoice_list')"><i class="fa fa-truck"></i><span>Items Tracking</span></a></li>
		<?php } ?>
		<?php if(isset($_SESSION['change_password']) || isset($_SESSION['permission'])){ ?>
		<li><a href="javascript:get_content('contact/change_password')"><i class="fa fa-circle-o text-aqua"></i> <span>Change Password</span></a></li>
		<?php } ?>
		<li><a href="javascript:get_content('contact/logout')" onclick="return myFunction()"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    </section>
    <!-- /.sidebar -->
  </aside>
   
  <!-- Modal Start -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment Options</h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
		  <div class="col-md-1">&nbsp;</div>
		  <div class="col-md-10">
		  <div class="col-md-4">
			<center><a href="banking/cash_add"><button type="button" class="btn btn-warning">Cash Payment</button></a></center>
		  </div>
		  <div class="col-md-4">
			<center><a href="banking/cheque_dd_add"><button type="button" class="btn btn-warning">Cheque/DD</button></a></center>
		  </div>
		  <div class="col-md-4">
			<center><a href="banking/neft_add"><button type="button" class="btn btn-warning">Neft Payment</button></a></center>
		  </div>
		  </div>
		  <div class="col-md-1">&nbsp;</div>
		  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
    <!-- Modal End -->