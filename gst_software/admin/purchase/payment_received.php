<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Purchase Payment Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="#"><i class="fa fa-plus"></i>Add New Payment</a></li>
        <li class="active">Bank Details</li>
      </ol>
    </section>
<script type="text/javascript">
   function for_contact(id,value){
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
function pay_amount(value)
{
   var due_amount = document.getElementById("due_amount2").value;
    var pay_amount = value;
	if(parseFloat(pay_amount)>parseFloat(due_amount))
	{
		alert('Please Enter Valid Pay Amount...');
		document.getElementById("pay_amount2").value = '';
		return false;
	}
	else{
	    return true;
	}
}
function form_submit(){
	 $("#form1").submit(function(e){
		 var form = $(this);
		 $.ajax({
			 type:"POST",
			 url:software_link+"purchase/ajax_form_submit.php",
			 data: form.serialize(),
			 success:function(detail){
			 alert(detail);
			 }
		 });
		 e.preventDefault();
	 });
}
function form_submit_cheque(){
           $("#form2").submit(function(e){
			   var form2 = $(this);
			   $.ajax({
				   type:"POST",
				   url:software_link+"purchase/ajax_cheque_form_submit.php",
				   data: form2.serialize(),
				   success:function(detail){
					   alert(detail);
				   }
			   })
		   });
}
$("#image2").change(function(){
	 var file = this.files[0];
	 var imagefile = file.type;
	 var match = ["image/jpeg","image/png","image/jpg"];
	 if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
		 alert('Please Select Valid Image png/jpg/jpeg');
		 $("#image2").val('');
		 return false;
	 }
})



</script>
<?php  	?>
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
			  <a href="javascript:get_content('purchase/invoice_payment_add')">
			   <button style="float:right;" type="button" class="btn btn-success">+ Payment</button></a>				
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
                            <!--<ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" style="font-size:15px;">Purchase Invoice Payment</a>
                                </li>
                                <li><a href="#security" data-toggle="tab" style="font-size:15px;">Purchase Order Invoice</a>
                                </li>
                            </ul>-->
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
		 <!-----------------------------------Expence Details Start----------------------------------->
			<div class="col-md-12 box-body table-responsive" id="my_table1">
             <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Payment Type</th>
                  <th>Referance</th>
                  <th>Customer Name</th>
                  <th>Payment Mode</th>		  
				  <th>Due Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody>				
				<?php				
				$que="select * from account_info join purchase_invoice_info on purchase_invoice_info.invoice_no=account_info.invoice_no where account_info.account_status='Active' and purchase_invoice_info.invoice_status='Active' and account_info.company_code='$company_code' and purchase_invoice_info.company_code='$company_code' and account_info.transaction_type='Debit' and purchase_invoice_info.transaction_type='Debit' GROUP BY account_info.invoice_no";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$invoice_no = $row['invoice_no'];
				$invoice_date = $row['invoice_date'];
				$customer_id = $row['invoice_firm_name'];
				$invoice_due_date = $row['invoice_due_date'];
				$product_id = $row['invoice_product_name'];
				$invoice_quantity = $row['invoice_quantity'];
				$invoice_payment_mode = $row['invoice_payment_mode'];
				if(empty($invoice_payment_mode)){
				   $invoice_payment_mode = "No Payment";
				}
				$invoice_grand_total = $row['invoice_grand_total'];
				$invoice_due_amount = $row['invoice_due_amount'];
				$transaction_type = $row['transaction_type'];
		        $invoice_status2 = $row['invoice_status2'];
				$invoice_referance = $row['invoice_reference'];
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
                  <th><?php echo $invoice_status2; ?></th>
                  <th><?php echo $invoice_referance; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
                  <th><?php echo $invoice_payment_mode; ?></th>		  
                  <th><?php echo $invoice_due_amount; ?></th>
				  <th>
				    <!--<a href="#" class="w2ui-btn" onclick="popup('<?php //echo $row['invoice_no']; ?>')">Cleared</a>-->
					
					<a href="delete_payment_received.php?id=<?php echo $invoice_no; ?>" class="w2ui-btn"><i class="fa fa-trash">&nbsp; &nbsp;Delete</i></a>
					
				  </th>			  
				  <?php }  ?>
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
                <thead class="btn-success">
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
			 $que="select * from account_info join purchase_invoice_info on account_info.invoice_no=purchase_invoice_info.invoice_no join purchase_order_info on purchase_order_info.invoice_no=purchase_invoice_info.challan_no where `account_info`.account_status='Active' and purchase_order_info.invoice_status='Active' and `purchase_order_info`.invoice_status='Active' and purchase_order_info.purchase_order_status='Invoice Created' and  `account_info`.company_code='$company_code' and `purchase_order_info`.company_code='$company_code' group by `purchase_invoice_info`.invoice_no";
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
					<a href="#" class="w2ui-btn" onclick="popup('<?php echo $invoice_no; ?>',<?php echo $company_code; ?>')" >Cash Payment&nbsp;&nbsp;
					<a href="#" class="w2ui-btn" onclick="popup2(<?php echo $invoice_no; ?>,<?php echo $company_code; ?>)">Cheque Payment</a>&nbsp;&nbsp;
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
   
        <!-- /.col -->
      <!-- /.row -->
    </section>
    <!-- /.content -->


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>