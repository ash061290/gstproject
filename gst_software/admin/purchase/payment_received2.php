<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("../attachment/link_css.php"); ?>
   
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php include("../attachment/header.php")?>
  <?php include("../attachment/sidebar.php")?>
  <?php include("../../connection/connect.php")?>
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payment Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="cheque_dd_add.php"><i class="fa fa-plus"></i>Add New Payment</a></li>
        <li class="active">Bank Details</li>
      </ol>
    </section>
	
<script type="text/javascript">
   function for_contact(id,value){
   //alert(value);
            if(id=='contact_type'){
			var contact_type1=value;
            var business_type1=document.getElementById('business_type').value; 
            }else if(id=='business_type') {
            var business_type1=value;
            var contact_type1=document.getElementById('contact_type').value;	
            }			
 
       $.ajax({
			  type: "POST",
              url: software_link+"purchase/ajax_contact_search.php?contact_type="+contact_type1+"&business_type="+business_type1+"",
              cache: false,
              success: function(detail){
			      //alert(detail);  
            $('#search_table').html(detail);
              }
           });
	}
</script>

<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://rawgit.com/vitmalina/w2ui/master/dist/w2ui.min.css" />
<script type="text/javascript">
function popup(value) {
	 var invoice_s_no = value;
	 $.ajax({
		     type:"POST",
			 url:software_link+"purchase/ajax_cheque_detail_data.php",
			 data:"invoice_id="+invoice_s_no,
			 success:function(detail){
			  alert(detail);
			 }
		 
	 })
    w2popup.open({
		width: 800,
        height: 630,
        title: 'Payment Detail',
        body: '<br/><div class="w2ui-centered"></div><div class="col-md-12"><form method="post"><div class="form-group"><label for="email">Clearing Date : </label><input type="date" class="form-control" id="date" value="<?php //echo $date('Y-m-d'); ?>" name="date"></div><div class="form-group"><label for="pwd">Party Name :</label><input type="text" class="form-control" id="party_name" name="party_name" disabled></div><div class="form-group"><label for="pwd">Cheque No :</label><input type="text" class="form-control" id="cheque_no" name="cheque_no" disabled></div><div class="form-group"> <label for="pwd">Cheque Amount :</label><input type="text" class="form-control" id="cheque_no" name="cheque_amount" disabled></div><div class="form-group"><label for="pwd">Description :</label><textarea cols="4" rows="4" name="description" class="form-control"></textarea> </div><div class="form-group"><input type="checkbox" value="sms">&nbsp;Send ThankYou Message For Payment Clearing</div><button type="submit" class="btn btn-success">Submit</button></form></div>',
    });
}
</script>
 
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
                <div class="col-sm-12">		
				<div class="col-sm-9">
			    </div>
				<div class="col-sm-3">
			  <a href='invoice_payment_add.php'>
			   <button style="float:right;" type="button" class="btn my_background_color">+ Payment</button></a>				
			</div>			
			</div>			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" style="font-size:15px;">Purchase Invoice Payment</a>
                                </li>
                                <li><a href="#security" data-toggle="tab" style="font-size:15px;">Purchase Order Invoice</a>
                                </li>
                       
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
		 <!-----------------------------------Expence Details Start----------------------------------->
			<div class="col-md-12 box-body table-responsive" id="my_table1">
             <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Issue Date</th>
                  <th>Clearing Date</th>
                  <th>Company Name</th>
                  <th>Account Name</th>
                  <th>Cheque/DD No</th>
				  <th>Type</th>				  
				  <th>Payment Mode</th>
				  <th>Amount</th>
				  <th>Action</th>
				  <th>Cheque Status</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from account_info where payment_mode='Cheque' and account_status='Active' and cheque_status='Clear' or payment_mode='DD' and account_status='Active' and cheque_status='Clear' and company_code='$company_code' and transaction_type='Debit'";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['reference'];
				$customer_id = $row['customer_id'];
				$cheque_status = $row['cheque_status'];
				$payment_mode = $row['payment_mode'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$account_name = $row['account_name'];
				$cheque_dd = $row['cheque_dd'];
				$cheque_dd_no = $row['cheque_dd_no'];
				$cheque_dd_issue_date1 = $row['cheque_dd_issue_date'];
				$cheque_dd_issue_date2 = explode("-",$cheque_dd_issue_date1);
				$cheque_dd_issue_date=$cheque_dd_issue_date2[2]."-".$cheque_dd_issue_date2[1]."-".$cheque_dd_issue_date2[0];
				$cheque_dd_clearing_date1 = $row['cheque_dd_clearing_date'];
				$cheque_dd_clearing_date2 = explode("-",$cheque_dd_clearing_date1);
				$cheque_dd_clearing_date=$cheque_dd_clearing_date2[2]."-".$cheque_dd_clearing_date2[1]."-".$cheque_dd_clearing_date2[0];
				$date1 = $row['date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];
				
				$que1="select * from contact_master where s_no='$customer_id' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $cheque_dd_issue_date; ?></th>
                  <th><?php echo $cheque_dd_clearing_date; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
                  <th><?php echo $account_name; ?></th>
                  <th><?php echo $cheque_dd_no; ?></th>
                  <th><?php echo $payment_mode; ?></th>
                  <th><?php echo $transaction_type; ?></th>				  
                  <th><?php echo $invoice_total_paid; ?></th>
				  <th>
				   <a href="#">Delete</a>			
				  </th>
                  <th><?php echo $cheque_status; ?></th>				  
				  <?php } } ?>
				</tr>					
				</tbody>
                </table>
                </div>	
  	
	    </form>
	</div>
                                </div>
								<!-- security -->
                                <div class="tab-pane fade" id="security">
                                  
                                    
                   <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
		 <!-----------------------------------Expence Details Start----------------------------------->
			<div class="col-md-12 box-body table-responsive" id="my_table1">
             <table id="example4" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Invoice Date</th>
                  <th>Invoice Num</th>
				  <th>Due Date</th>
                  <th>Vender Name</th>
                  <th>Product Name</th>
                  <th>Quienty</th>
				  <th>Total Amount</th>				  
				  <th>Due Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
			 $que="select * from account_info join purchase_invoice_info on account_info.invoice_no=purchase_invoice_info.invoice_no where `account_info`.account_status='Active' and `purchase_invoice_info`.invoice_status='Active' and  `account_info`.company_code='10' and `purchase_invoice_info`.company_code='$company_code'";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$invoice_no = $row['invoice_no'];
				$invoice_date = $row['invoice_date'];
				$customer_id = $row['invoice_firm_name'];
				$invoice_due_date = $row['invoice_due_date'];
				$product_id = $row['invoice_product_name'];
				$invoice_quantity = $row['invoice_quantity'];
				$invoice_grand_total = $row['invoice_grand_total'];
				$invoice_due_amount = $row['invoice_due_amount'];
				$transaction_type = $row['transaction_type'];
		
				$invoice_date = $invoice_date;
				$invoice_date = explode("-",$invoice_date);
				$invoice_date=$invoice_date[2]."-".$invoice_date[1]."-".$invoice_date[0];
				
				$invoice_due_date = $invoice_due_date;
				$invoice_due_date = explode("-",$invoice_due_date);
				$invoice_due_date=$invoice_due_date[2]."-".$invoice_due_date[1]."-".$invoice_due_date[0];
				
				$que1="select * from contact_master where s_no='$customer_id' and company_code='$company_code'";
				$run1=mysql_query($que1);
				if($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
				}
				$qry2="select * from item_master where s_no='$product_id'";
				$run2 = mysql_query($qry2);
				if($row2 = mysql_fetch_array($run2))
				{
					$invoice_product_name = $row2['item_product_name'];
				}
	            ?>
				<tr>
				  <th><?php echo $invoice_date; ?></th>
                  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $invoice_due_date; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
                  <th><?php echo $invoice_product_name; ?></th>
                  <th><?php echo $invoice_quantity; ?></th>
                  <th><?php echo $invoice_grand_total; ?></th>				  
                  <th><?php echo $invoice_due_amount; ?></th>
				  <th>
				    <!--<a href="#" class="w2ui-btn" onclick="popup('<?php //echo $row['invoice_no']; ?>')">Cleared</a>-->
					
					<a href="#" class="w2ui-btn" onclick="popup('<?php echo $invoice_no; ?>')" >Cash Payment&nbsp;&nbsp;
					<a href="#">Cheque Payment</a>&nbsp;&nbsp;
					<a href="#">Delete</a>
				  </th>
                 			  
				  <?php } ?>
				</tr>					
				</tbody>
                </table>
                </div>	
  	
	    </form>
	</div>
              <!-- /.box-body session -->
                                </div>
                                
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		</div>
        <!-- /.col -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/../attachment/link_js.php")?>


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
   $(function () {
    $('#example4').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
   $(function () {
    $('#example3').DataTable()
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
