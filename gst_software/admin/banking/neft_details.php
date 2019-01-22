<?php
include("../../attachment/session.php");
  	  ?>
    <section class="content-header">
      <h1>
       NEFT/RTGS Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/neft_add')"><i class="fa fa-plus"></i>NEFT/RTGS Add</a></li>
        <li class="active">NEFT/RTGS Details</li>
      </ol>
    </section>
<script>
function valid(account_s_no,invoice_no,transaction_type,paid_amount,company_code){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_neft(account_s_no,invoice_no,transaction_type,paid_amount,company_code);       
 }            
else  {      
return false;
 }       
  } 
  function delete_neft(account_s_no,invoice_no,transaction_type,paid_amount,company_code){
      
$.ajax({
type: "POST",
url: software_link+"banking/neft_delete_api.php",
data: "account_s_no="+account_s_no+"&invoice_no="+invoice_no+"&transaction_type="+ transaction_type+"&paid_amount="+paid_amount+"&company_code="+company_code+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
			   
				   alert('Successfully Deleted');
				   get_content('banking/neft_details');
			   }else{
               alert(detail); 
			   }
}
});
}
</script>	

 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	     <div class="col-xs-12">
    <div class="box my_border_top">
        <div class="box-header with-border">
		<a href="javascript:get_content('banking/neft_add')"><button style="float:right;" type="button" class="btn btn-success">+ Add NEFT/RTGS Details</button></a>	<input type="hidden" id="company_code" name="comapny_code" />			
        </div>
        <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">
				<div class="col-md-12 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>Date</th>
                  <th>Company Name</th>
                  <th>Account Name</th>
                  <th>Invoice No</th>
                  <th>NEFT/RTGS Details</th>
				  <th>Type</th>				  
				  <th>Payment Mode</th>
				  <th>Deposits</th>
				  <th>Withdrawals</th>
				  <th>Action</th>
                </tr>
                </thead>
				
				<tbody>				
				<?php				
				$que="select * from account_info where payment_mode='Neft' and account_status='Active' or payment_mode='RTGS' and account_status='Active' or payment_mode='Paytm' and account_status='Active' and company_code='$company_code'";
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
                  <th><?php echo $remark; ?></th>
                  <th><?php echo $transaction_type; ?></th>
                  <th><?php echo $payment_mode; ?></th>
                  <th><?php echo $credit_amount; ?></th>
                  <th><?php echo $debit_amount; ?></th>

                 
				  <th><a style="color:green;" class="fa fa-pencil" title="Edit" href= "javascript:post_content('banking/neft_edit','account_s_no=<?php echo $account_s_no; ?>')"></a>
                 



				  &nbsp;&nbsp;&nbsp;&nbsp;<a style="color:Red;" title="Delete" class="fa fa-times" href="#" onclick="valid('<?php echo $account_s_no;?>','<?php echo $invoice_no;?>','<?php echo $transaction_type;?>','<?php echo $invoice_total_paid;?>','<?php echo $company_code;?>');"></a>
				  </th>
				  
				
				  
				  <?php } } ?>
				</tr>					
				</tbody>
				
                </table>
                </div>	
  		
		</div>
	    </form>
	</div>
    </div>
	    
  </div>
 
</section>



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
