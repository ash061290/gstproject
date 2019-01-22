<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Payment Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/cheque_dd_add')"><i class="fa fa-plus"></i>Add New Payment</a></li>
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
              url: software_link+"sales/ajax_contact_search.php?contact_type="+contact_type1+"&business_type="+business_type1+"",
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
<script type="text/javascript">
function popup(value) {
	 var invoice_s_no = value;
	 $.ajax({
		     type:"POST",
			 url:software_link+"sales/ajax_cheque_detail_data.php",
			 data:"invoice_id="+invoice_s_no,
			 success:function(detail){
			  alert(detail);
			 }
		 
	 })
    w2popup.open({
		width: 500,
        height: 530,
        title: 'Cheque Detail',
        body: '<br/><div class="w2ui-centered"></div><div class="col-md-12"><form method="post"><div class="form-group"><label for="email">Clearing Date : </label><input type="date" class="form-control" id="date" value="<?php //echo $date('Y-m-d'); ?>" name="date"></div><div class="form-group"><label for="pwd">Party Name :</label><input type="text" class="form-control" id="party_name" name="party_name" disabled></div><div class="form-group"><label for="pwd">Cheque No :</label><input type="text" class="form-control" id="cheque_no" name="cheque_no" disabled></div><div class="form-group"> <label for="pwd">Cheque Amount :</label><input type="text" class="form-control" id="cheque_no" name="cheque_amount" disabled></div><div class="form-group"><label for="pwd">Description :</label><textarea cols="4" rows="4" name="description" class="form-control"></textarea> </div><div class="form-group"><input type="checkbox" value="sms">&nbsp;Send ThankYou Message For Payment Clearing</div><button type="submit" class="btn btn-success">Submit</button></form></div>',
    });
}
</script>
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
<a href="javascript:get_content('sales/invoice_payment_add')">
			   <button style="float:right;" type="button" class="btn btn-success">+ Payment</button></a>				
			</div>			
			</div>			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <div class="row">
                <div class="col-lg-12">
                 <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Referance</th>				  
				  <th>Customer Name</th>
				  <th>Payment Mode</th>
				  <th>Invoice Amount</th>
				  <th>Due Amount</th>
				   <th>Action</th>
                </tr>
                </thead>
				<tbody>				
				<?php				
				$que="select * from sales_invoice_info where invoice_due_amount>0 and invoice_status='Active' and company_code='$company_code' and invoice_status2='Invoiced' GROUP BY invoice_no";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['invoice_reference'];
				$invoice_no = $row['invoice_no'];
				$invoice_grand_total = $row['invoice_grand_total'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$invoice_due_amount = $row['invoice_due_amount'];
				$invoice_firm_name = $row['invoice_firm_name'];
				$transaction_type = $row['transaction_type'];
				$account_name = $row['account_name'];
				$cheque_dd = $row['cheque_dd'];
				$cheque_dd_no = $row['cheque_dd_no'];
				$invoice_payment_mode = $row['invoice_payment_mode'];
				
				if(empty($invoice_payment_mode))
				{
				 $invoice_payment_mode = "No Payment";
				}
				$remark = $row['remark'];
				$date1 = $row['invoice_date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];				 
				 
				$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
				$run1=mysql_query($que1);
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $reference; ?></th>
                  <th><?php echo $contact_company_name; ?></th>
				  <th><?php echo $invoice_payment_mode; ?></th>
				  <th><?php echo $invoice_grand_total; ?></th>
				  <th><?php echo $invoice_due_amount; ?></th>
				  <th>
				     <a style="color:Red;" aria-hidden="true" onclick="if(window.confirm(' Do You Want Deleted..'))return myFunction('<?php echo $invoice_no; ?>')" class="fa fa-trash-o" href='#'> Delete</a>
				    </th>
				  
				  <?php } } ?>
				</tr>					
				</tbody>
				
                </table>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		</div>
	    </div>
</div>
    </section>
    <!-- /.content -->

<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>