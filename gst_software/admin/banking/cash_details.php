<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
   <?php include("../attachment/link_css.php")?>
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php include("../attachment/header.php")?>
  <?php include("../attachment/sidebar.php")?>
  <?php include("../../connection/connect.php")?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Cash Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="neft_add.php"><i class="fa fa-plus"></i>Cash Add</a></li>
        <li class="active">Cash Details</li>
      </ol>
    </section>
	
<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
<!-- Main content -->
	
<script>
	function myFunction(){   
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	return true;        
	 }            
	else  {      
	return false;
	 }       
	  }           
</script>

 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
        <div class="box-header with-border">
		<a href='cash_add.php'><button style="float:right;" type="button" class="btn my_background_color">+ Add Cash Details</button></a>				
        </div>
            <!-- /.box-header -->
        <!--------------------------------------Start Table----------------------------------------->
        <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
   
		 <!-----------------------------------Expence Details Start----------------------------------->		   
				<div class="col-md-12 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Company Name</th>
                  <th>Account Name</th>
                  <th>Invoice No</th>
				  <th>Type</th>				  
				  <th>Payment Mode</th>
				  <th>Deposits</th>
				  <th>Withdrawals</th>
				  <th>Action</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from account_info where payment_mode='Cash' and account_status='Active' and company_code='$company_code'";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['reference'];
				$customer_id = $row['customer_id'];
				$payment_mode = $row['payment_mode'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$account_name = $row['account_name'];
				$cheque_dd = $row['cheque_dd'];
				$cheque_dd_no = $row['cheque_dd_no'];
				$invoice_no = $row['invoice_no'];
				$remark = $row['remark'];
				$date1 = $row['date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];
				
				if($transaction_type=='Credit'){
				$credit_amount=$invoice_total_paid;
				$debit_amount='';	
				}else{
				$debit_amount=$invoice_total_paid;
				$credit_amount='';
				}
				
				$que1="select * from contact_master where s_no='$customer_id' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
                  <th><?php echo $account_name; ?></th>
                  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $transaction_type; ?></th>
                  <th><?php echo $payment_mode; ?></th>
                  <th><?php echo $credit_amount; ?></th>
                  <th><?php echo $debit_amount; ?></th>
				  <th><a style="color:green;" class="fa fa-pencil" title="Edit" href='cash_edit.php?account_s_no=<?php echo $account_s_no;?>'></a> &nbsp;&nbsp;&nbsp;&nbsp;<a style="color:Red;" title="Delete" onclick="return myFunction()" class="fa fa-times" href='cash_delete.php?account_s_no=<?php echo $account_s_no;?>&invoice_no=<?php echo $invoice_no;?>&transaction_type=<?php echo $transaction_type;?>&paid_amount=<?php echo $invoice_total_paid;?>'></a>
				  </th>
				  <?php } } ?>
				</tr>					
				</tbody>
				
                </table>
                </div>	
  		
		</div>
	    </form>
	</div>
        <!---------------------------------------------End Table------------------------------------->
		<!-- /.box-body -->
    </div>
</section>  
</div>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
 <?php include("../attachment/link_js.php")?>
</div>
</body>
</html>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
