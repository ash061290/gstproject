<?php
include("../../attachment/session.php");
  	  ?>
 <section class="content-header">
      <h1>
        Bank Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/add_bank')"><i class="fa fa-plus"></i>Add Bank Or Card</a></li>
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
              url: "ajax_contact_search.php?contact_type="+contact_type1+"&business_type="+business_type1+"",
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
<script>
	function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_Banking(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_Banking(s_no){
$.ajax({
type: "POST",
url: "../html/admin/banking/bank_delete_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
			   
				   alert('Successfully Deleted');
				   get_content('banking/banking');
			   }else{
               alert(detail); 
			   }
}
});
}
</script>				
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
	<?php
	$que1="select * from account_info where account_type='Cash' and account_name='Petty Cash' and account_status='Active' and cheque_status='Cleared' and company_code='$company_code'";
	$run1=mysql_query($que1) or die(mysql_error());
	$total_credit_amount=0;
	$total_debit_amount=0;
	$running_amount=0;
	$cash_running_amount=0;
	while($row1=mysql_fetch_array($run1)){
	$invoice_total_paid = $row1['invoice_total_paid'];
	$transaction_type = $row1['transaction_type'];
	if($transaction_type=='Credit'){
	$credit_amount=$invoice_total_paid;
	$debit_amount='';
	$total_credit_amount=$total_credit_amount+$credit_amount;				
	}else{
	$debit_amount=$invoice_total_paid;
	$credit_amount='';
	$total_debit_amount=$total_debit_amount+$debit_amount;
	}
	$cash_running_amount=$total_credit_amount-$total_debit_amount;
	}
	
	?>
    <?php
	$que="select * from account_info where account_type='Cash' and account_name='Undeposited Funds' and account_status='Active' and cheque_status='Cleared' and company_code='$company_code'";
	$run=mysql_query($que);
	$total_credit_amount=0;
	$total_debit_amount=0;
	$running_amount=0;
	$undeposited_running_amount=0;
	while($row=mysql_fetch_array($run)){
	$invoice_total_paid = $row['invoice_total_paid'];
	$transaction_type = $row['transaction_type'];
	if($transaction_type=='Credit'){
	$credit_amount=$invoice_total_paid;
	$debit_amount='';
	$total_credit_amount=$total_credit_amount+$credit_amount;				
	}else{
	$debit_amount=$invoice_total_paid;
	$credit_amount='';
	$total_debit_amount=$total_debit_amount+$debit_amount;
	}
	$undeposited_running_amount=$total_credit_amount-$total_debit_amount;
	}
	?>
    <?php
	$que="select * from account_info where account_type='Bank' and account_status='Active' and cheque_status='Cleared' and company_code='$company_code' ";
	$run=mysql_query($que);
	$total_credit_amount=0;
	$total_debit_amount=0;
	$running_amount=0;
	$bank_running_amount=0;
	while($row=mysql_fetch_array($run)){
	$invoice_total_paid = $row['invoice_total_paid'];
	$transaction_type = $row['transaction_type'];
	if($transaction_type=='Credit'){
	$credit_amount=$invoice_total_paid;
	$debit_amount='';
	$total_credit_amount=$total_credit_amount+$credit_amount;				
	}else{
	$debit_amount=$invoice_total_paid;
	$credit_amount='';
	$total_debit_amount=$total_debit_amount+$debit_amount;
	}
	$bank_running_amount=$total_credit_amount-$total_debit_amount;
	}
	?>
	
    <?php
	$que="select * from account_info where account_type='Credit_Card' and account_status='Active' and company_code='$company_code'";
	$run=mysql_query($que);
	$total_credit_amount=0;
	$total_debit_amount=0;
	$running_amount=0;
	$credit_card_running_amount=0;
	while($row=mysql_fetch_array($run)){
	$invoice_total_paid = $row['invoice_total_paid'];
	$transaction_type = $row['transaction_type'];
	if($transaction_type=='Credit'){
	$credit_amount=$invoice_total_paid;
	$debit_amount='';
	$total_credit_amount=$total_credit_amount+$credit_amount;				
	}else{
	$debit_amount=$invoice_total_paid;
	$credit_amount='';
	$total_debit_amount=$total_debit_amount+$debit_amount;
	}
	$credit_card_running_amount=$total_credit_amount-$total_debit_amount;
	}
	?>	
          <div class="box">
            <div class="box-header">
				<div class="row">
			<div class="col-sm-10"></div>
				<div class="col-sm-2">
				 <div class="form-group" >
				  <a href="javascript:get_content('banking/add_bank')"><button style="float:right;" type="button" class="btn btn-success">+ Add New Bank Or Card</button></a>	
				 </div>
			    </div>
				  </div>
                <div class="col-sm-12">		
				<div class="col-sm-2">
				 <div class="form-group" >
					<label>Cash In Hand</label>
					  <input type="text" name="" id="" value="<?php echo $cash_running_amount; ?>" class="form-control" readonly>
				 </div>
			    </div>
				<div class="col-sm-2">
				 <div class="form-group" >
					<label>Bank Balance</label>
					  <input type="text" name="" id="" value="<?php echo $bank_running_amount; ?>" class="form-control" readonly>
				 </div>
			    </div>
				<div class="col-sm-3">
				 <div class="form-group" >
					<label>Card Balance</label>
					  <input type="text" name="" id="" value="<?php echo $credit_card_running_amount; ?>" class="form-control" readonly>
				 </div>
			    </div>
				<div class="col-sm-3">
				 <div class="form-group" >
					<label>Undeposited Fund</label>
					  <input type="text" name="" id="" value="<?php echo $undeposited_running_amount; ?>" class="form-control" readonly>
				 </div>
			    </div>
			<div class="col-sm-2"></div>				
			</div>			
			</div>			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>Account Name</th>
                  <th>Bank Name</th>
                  <th>Account Details</th>
                  <th>Account Type</th>
				  <th>Total Amount</th>
				  <th>Acton</th>
                </tr>
                </thead>
            <tbody>
			   <?php
				    $que="select * from bank_or_credit_card_info where bank_account_type='Cash' and bank_status='Active' and company_code='$company_code'";
					$run=mysql_query($que);
					while($row=mysql_fetch_array($run)){
					$s_no = $row['s_no'];
					$bank_account_type = $row['bank_account_type'];
					$account_type = $row['account_type'];
					$bank_account_name = $row['bank_account_name'];
					$bank_account_code = $row['bank_account_code'];
					$bank_account_number = $row['bank_account_number'];
					$bank_name = $row['bank_name'];
					$Mobile_No = $row['Mobile_No'];
					$amount = $row['amount'];
					$que123="select * from account_info where bank_s_no='$s_no' and account_status='Active' and company_code='$company_code'";
					$run123=mysql_query($que123);
					$total_credit_amount=0;
					$total_debit_amount=0;
					$running_amount=0;
					$credit_card_running_amount=0;
					while($row123=mysql_fetch_array($run123)){
					$invoice_total_paid = $row123['invoice_total_paid'];
					$transaction_type = $row123['transaction_type'];
					if($transaction_type=='Credit'){
					$credit_amount=$invoice_total_paid;
					$debit_amount='';
					$total_credit_amount=$total_credit_amount+$credit_amount;				
					}else{
					$debit_amount=$invoice_total_paid;
					$credit_amount='';
					$total_debit_amount=$total_debit_amount+$debit_amount;
					}
					$amount=$total_credit_amount-$total_debit_amount;
					}
				?>
				
				<tr align='center'>
				<th><i class="fa fa-money">&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $bank_account_name; ?></b></i></th>
				<th><?php echo $bank_name; ?></th>
				<th><?php echo $bank_account_type; ?></th>
				<th><?php echo $account_type; ?></th>				
				<th><a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')" title="Details"><?php echo $amount; ?></a></th>	
				<th>
			    <a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-eye" style="font-size:18px;" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-edit" style="font-size:18px;" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-trash" style="font-size:18px; color:red" ></i></a>
			    
           			
				</th>
				</tr>
				<?php }  ?>
			
			    <?php
				    $que="select * from bank_or_credit_card_info where bank_account_type='Bank' and bank_status='Active' and company_code='$company_code'";
					$run=mysql_query($que);
					while($row=mysql_fetch_array($run)){
					$s_no = $row['s_no'];
					$bank_account_type = $row['bank_account_type'];
					$account_type = $row['account_type'];
					$bank_account_name = $row['bank_account_name'];
					$bank_account_code = $row['bank_account_code'];
					$bank_account_number = $row['bank_account_number'];
					$bank_name = $row['bank_name'];
					$Mobile_No = $row['Mobile_No'];
					$bank_amount = $row['amount'];
					
					$que123="select * from account_info where bank_s_no='$s_no' and account_status='Active' and company_code='$company_code'";
					$run123=mysql_query($que123);
					$total_credit_amount=0;
					$total_debit_amount=0;
					$running_amount=0;
					$credit_card_running_amount=0;
					while($row123=mysql_fetch_array($run123)){
					$invoice_total_paid = $row123['invoice_total_paid'];
					$transaction_type = $row123['transaction_type'];
					if($transaction_type=='Credit'){
					$credit_amount=$invoice_total_paid;
					$debit_amount='';
					$total_credit_amount=$total_credit_amount+$credit_amount;				
					}else{
					$debit_amount=$invoice_total_paid;
					$credit_amount='';
					$total_debit_amount=$total_debit_amount+$debit_amount;
					}
					$bank_amount=$total_credit_amount-$total_debit_amount;
	                }
				?>

				<tr align='center'>
				<th><i class="fa fa-university">&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $bank_account_name; ?></b></i></th>
				<th><?php echo $bank_name; ?></th>
				<th><?php echo $bank_account_type; ?></th>
				<th><?php echo $account_type; ?></th>
				<th><a href="javascript:post_content('transaction_details','id=<?php echo $s_no; ?>')" title="Details"><?php echo $bank_amount; ?></a></th>	
				<th>
				 <a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-eye" style="font-size:18px;" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-edit" style="font-size:18px;" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-trash" style="font-size:18px; color:red" ></i></a>
				</th>
				</tr>
				<?php } ?>
				
				<?php
				    $que="select * from bank_or_credit_card_info where bank_account_type='Credit_Card'  and bank_status='Active' and company_code='$company_code'";
					$run=mysql_query($que);
					while($row=mysql_fetch_array($run)){
					$s_no = $row['s_no'];
					$bank_account_type = $row['bank_account_type'];
					$account_type = $row['account_type'];
					$bank_description_bank = $row['bank_description_bank'];	
					$credit_card_account_name = $row['credit_card_account_name'];
					$credit_card_bank_name = $row['credit_card_bank_name'];
					$credit_card_account_number = $row['credit_card_account_number'];
					$credit_card_card_number = $row['credit_card_card_number'];
					$credit_card_account_code = $row['credit_card_account_code'];
					$credit_card_description_bank = $row['credit_card_description_bank'];
					$credit_card_routing_no = $row['credit_card_routing_no'];
					$credit_card_bank_amount = $row['amount'];
					
					$que123="select * from account_info where bank_s_no='$s_no' and account_status='Active' and company_code='$company_code'";
					$run123=mysql_query($que123);
					$total_credit_amount=0;
					$total_debit_amount=0;
					$running_amount=0;
					$credit_card_running_amount=0;
					while($row123=mysql_fetch_array($run123)){
					$invoice_total_paid = $row123['invoice_total_paid'];
					$transaction_type = $row123['transaction_type'];
					if($transaction_type=='Credit'){
					$credit_amount=$invoice_total_paid;
					$debit_amount='';
					$total_credit_amount=$total_credit_amount+$credit_amount;				
					}else{
					$debit_amount=$invoice_total_paid;
					$credit_amount='';
					$total_debit_amount=$total_debit_amount+$debit_amount;
					}
					$credit_card_bank_amount=$total_credit_amount-$total_debit_amount;
					}
				?>

				<tr align='center'>
				<th><i class="fa fa-credit-card">&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $credit_card_account_name; ?><b></i></th>
				<th><?php echo $credit_card_bank_name; ?></th>
				<th><?php echo $bank_account_type; ?></th>
				<th><?php echo $account_type; ?></th>
				<th><a href="javascript:post_content('transaction_details','id=<?php echo $s_no; ?>')" title="Details"><?php echo $credit_card_bank_amount; ?></a></th>	
				<th>
                 <a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-eye" style="font-size:18px;" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-edit" style="font-size:18px;" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:post_content('banking/transaction_details','id=<?php echo $s_no; ?>')"><i class="fa fa-trash" style="font-size:18px; color:red" ></i></a>
				</th>
				</tr>
				<?php } ?>
			</tbody>
            
             </table>
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