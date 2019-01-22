<?php include("../../attachment/session.php"); ?>
<section class="content-header">
      <h1> Cheque Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/cheque_dd_add')"><i class="fa fa-plus"></i>Add New Cheque</a></li>
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
              url: software_link+"contact/ajax_contact_search.php?contact_type="+contact_type1+"&business_type="+business_type1+"",
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
			 url:software_link+"banking/ajax_cheque_detail_data.php",
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
function cheque_clear(val){
         $.ajax({
			 type:"POST",
			 url:software_link+"banking/ajax_cheque_detail_data.php",
			 data:"invoice_id="+val,
			 success:function(detail){
			  console.log(detail);
			 }
		 })
}
</script>
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
				 <a href="javascript:get_content('banking/cheque_dd_add')"><button style="float:right;" type="button" class="btn btn-success">+ Add New Detail</button></a>			
			</div>			
			</div>			
            <!-- /.box-header -->
            <div class="box-body ">
               <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
                        <!-- /.panel-heading -->
                        <div class="">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#security" data-toggle="tab" style="font-size:15px;">Uncleared Cheque</a>
                                </li>
								<li ><a href="#home" data-toggle="tab" style="font-size:15px;">Cleared Cheque</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab" style="font-size:15px;">Bounced Cheque</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="security">
                                   
                                    
                   <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
			<div class="col-md-12 box-body table-responsive" id="my_table1">
             <table id="example4" class="table table-bordered table-striped">
                <thead  class="btn-success">
                <tr>
				  <th>s_no</th>
                  <th>Issue Date</th>
                  <th>Clearing Date</th>
				  <th>Invoice No</th>
				  <th>Cheque No</th>
				  <th>Type</th>	
				  <th>Invoice Amount</th>
				  <th>Cheque Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody>				
				<?php				
				$que="select * from account_info where payment_mode='Cheque' and account_status='Active' or payment_mode='DD' and cheque_status='Unclear' and company_code='$company_code'";
				$run=mysql_query($que);
				$s_no =1;
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['reference'];
				$customer_id = $row['customer_id'];
				$cheque_status = $row['cheque_status'];
				$payment_mode = $row['payment_mode'];
				$invoice_grand_total = $row['invoice_grand_total'];
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
				$invoice_no = $row['invoice_no'];
				$que1="select * from contact_master where s_no='$customer_id' and company_code='$company_code'";
				$run1=mysql_query($que1);
				
				while($row1=mysql_fetch_array($run1)){
				$contact_company_name = $row1['contact_company_name'];
				
	            ?>
				<tr>
				   <th><?php echo $s_no; ?></th>
				  <th><?php echo $cheque_dd_issue_date; ?></th>
                  <th><?php echo $cheque_dd_clearing_date; ?></th>
				  <th><?php echo $invoice_no; ?></th>
                  <th><?php echo $cheque_dd_no; ?></th>
                  <th><?php echo $transaction_type; ?></th>				  
                  <th><?php echo $invoice_grand_total; ?></th>
                  <th><?php echo $invoice_total_paid; ?></th>
				  <th><a href="javascript:post_content('banking/change_status','<?php echo $invoice_no; ?>')"><button class="btn btn-success">Clear</button></a> &nbsp;&nbsp;<a href="javascript:post_content('banking/change_status','<?php echo $invoice_no; ?>')"><button class="btn btn-danger">Bounced</button></a></th>	
				  <?php $s_no = $s_no+1; } } ?>
				</tr>					
				</tbody>
                </table>
                </div>	
	    </form>
		<!--modal check clear-->
		 <!-- Modal -->
  <div class="modal fade" id="chequeclear" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Cheque Clear</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
		<!--end -->
		<!--modal bounced check-->
		<div class="modal fade" id="chequebounced" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Cheque Bounced</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
		<!--end-->
		<!--modal check return-->
		<div class="modal fade" id="chequereturn" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Cheque Return</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
		<!-- end-->
	</div>
              <!-- /.box-body session -->
                                </div>
								     <div class="tab-pane fade" id="home">
								
                                    <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
			<div class="col-md-12 box-body" id="my_table1">
             <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead class="btn-success">
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
				$que="select * from account_info where payment_mode='Cheque' and account_status='Active' and cheque_status='Cleared' or payment_mode='DD' and account_status='Active' and cheque_status='Cleared' and company_code='$company_code'";
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
                                   <div class="tab-pane fade" id="messages">
                                    <h4>Bounced Cheque</h4>
                                   <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
		 <!-----------------------------------Expence Details Start----------------------------------->
			<div class="col-md-12 box-body table-responsive" id="my_table1">
             <table id="example3" class="table table-bordered table-striped">
                <thead  class="btn-success">
                <tr>
                  <th>Issue Date</th>
                  <th>Clearing Date</th>
                  <th>Company Name</th>
                  <th>Account Name</th>
                  <th>Cheque/DD No</th>
				  <th>Type</th>				  
				  <th>Payment Mode</th>
				  <th>Amount</th>
				  <th>Cheque Status</th>
				  <th>Action</th>
				 
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from account_info where payment_mode='Cheque' and account_status='Active' and cheque_status='Bounce' or payment_mode='DD' and account_status='Active' and cheque_status='Bounce' and company_code='$company_code'";
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
				    <th><?php echo $cheque_status; ?></th>		
				  <th>
				    <a href="#">Cleared</a>&nbsp;&nbsp;
					<a href="#">Bounced</a>&nbsp;&nbsp;
					<a href="#">Return</a>
				  </th>
                		  
				  <?php } } ?>
				</tr>					
				</tbody>
                </table>
                </div>	
  	
	    </form>
	</div>
                                </div>
                            </div>
                        </div>
                  
                    </div>
                
                </div>
            </div>
        </div>
       
        </div>
		</div>
    </section>
 
<script>
  $(function () {
    $('#example1').DataTable()
   
  })
   $(function () {
    $('#example4').DataTable()
   
  })
   $(function () {
    $('#example3').DataTable()
   
  })
</script>

