<?php include("../../attachment/session.php"); ?>
<section class="content-header">
      <h1>
       Unclear Cheque/DD Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/cheque_dd_add')"><i class="fa fa-plus"></i>Cheque/DD Add</a></li>
        <li class="active">Unclear Cheque/DD</li>
      </ol>
    </section>
	
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

    function clear_cheque(){   
	var myval=confirm("Are you sure this Cheque is Clear !!!!");
	if(myval==true){
	return true;        
	 }            
	else  {      
	return false;
	 }       
	  }
	
	function bounce_cheque(){   
	var myval=confirm("Are you sure this Cheque is bounce !!!!");
	if(myval==true){
	return true;        
	 }            
	else {      
	return false;
	 }       
	 }   

    	  
</script>

 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
		  <div class="col-xs-12">
    <div class="box my_border_top">
        <div class="box-header with-border">
		<a href='cheque_dd_add.php'><button style="float:right;" type="button" class="btn btn-success">+ Add Cheque/DD</button></a>				
        </div>
            <!-- /.box-header -->
        <!--------------------------------------Start Table----------------------------------------->
        <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
   
		 <!-----------------------------------Expence Details Start----------------------------------->		   
				<div class="col-md-12 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>Issue Date</th>
                  <th>Clearing Date</th>
                  <th>Company Name</th>
                  <th>Account Name</th>
                  <th>Cheque/DD No</th>	  
				  <th>Payment Mode</th>
				  <th>Type</th>				  
				  <th>Amount</th>
				  <th>Cheque Status</th>
				  <th>Action</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from account_info where payment_mode='Cheque' and account_status='Active' and cheque_status='Uncleared' or payment_mode='DD' and account_status='Active' and cheque_status='Uncleared'";
				$run=mysql_query($que);
				$total_credit_amount=0;
				$total_debit_amount=0;
				$running_amount=0;
				while($row=mysql_fetch_array($run)){
				$account_s_no = $row['s_no'];
				$reference = $row['reference'];
				$invoice_no = $row['invoice_no'];
				$customer_id = $row['customer_id'];
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
				
				$que1="select * from contact_master where s_no='$customer_id'";
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
				  <ul class="nav nav-tabs">
				  <li class="dropdown">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Status
				  <span class="fa fa-caret-down"></span></button>
				  <ul class="dropdown-menu">
				  <li><a href='cheque_clear.php?id=<?php echo $account_s_no; ?>&cheque=Cleared' onclick="return clear_cheque()">Cheque Cleared</a></li>
				  <li><a href='cheque_clear.php?id=<?php echo $account_s_no; ?>&cheque=Bounced' onclick="return bounce_cheque()">Cheque Bounced</a></li>
				  </ul>
				  </li>
				  </ul>				
				  </th>				  
				  <th><a style="color:green;" class="fa fa-pencil" title="Edit" href='cheque_dd_edit.php?account_s_no=<?php echo $account_s_no;?>'></a> &nbsp;&nbsp;&nbsp;&nbsp;<a style="color:Red;" title="Delete" onclick="return myFunction()" class="fa fa-times" href='cheque_dd_delete.php?account_s_no=<?php echo $account_s_no;?>&invoice_no=<?php echo $invoice_no;?>&transaction_type=<?php echo $transaction_type;?>&paid_amount=<?php echo $invoice_total_paid;?>'></a>
				  </th>
				  <?php } }  ?>
				</tr>					
				</tbody>
				
                </table>
                </div>	
  		
		</div>
	    </form>
	</div>
    </div>
	  </div>
	  </div>
</section>
	</div>