 <?php include("../../attachment/session.php");  ?>
    <section class="content-header">
      <h1>
       Transaction Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/banking')"><i class="fa fa-list"></i>Bank Details</a></li>
        <li class="active">Transaction Details</li>
      </ol>
    </section>
<script>
function payment_detail(value){
if(value=='Cheque'){
$('#cheque_or_dd').show();
$('#cheque_dd_no').show();
$('#cheque_dd_issue_date').show();
$('#cheque_dd_clearing_date').show();
}else if(value=='DD'){
$('#cheque_or_dd').show();
$('#cheque_dd_no').show();
$('#cheque_dd_issue_date').show();
$('#cheque_dd_clearing_date').show();
} else {
$('#cheque_or_dd').hide();
$('#cheque_dd_no').hide();
$('#cheque_dd_issue_date').hide();
$('#cheque_dd_clearing_date').hide();
}

}
</script>
<script>
   function for_print()
 {
    var s_no = $("#s_no").val();
    $.ajax({
		    method:"POST",
			url:software_link+"banking/ajax_print_transaction.php",
			data:"s_no="+s_no,
			success:function(detail){
			   $("#sample_div").html(detail);
			   var divToPrint=document.getElementById("PrintTable");
               newWin= window.open("");
               newWin.document.write(divToPrint.outerHTML);
               newWin.print();
               newWin.close();
               $('#PrintTable').print();
			 }
	})	
	 
 
 }
function exportTableToExcel(tableID, filename = ''){
	 var s_no = $("#s_no").val();
    $.ajax({
		 method:"POST",
			url:software_link+"banking/ajax_print_transaction.php",
			data:"s_no="+s_no,
			success:function(detail){
			    $("#sample_div").html(detail);
				 var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    // Create download link element
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        // Setting the file name
        downloadLink.download = filename;
        //triggering the function
        downloadLink.click();
    }
			}
	})
   
}
</script>
    <?php
	$s_no=$_GET['id'];
	$que="select * from bank_or_credit_card_info where s_no='$s_no'";
	$run=mysql_query($que);
	while($row=mysql_fetch_array($run)){
	$s_no = $row['s_no'];
	$bank_account_type = $row['bank_account_type'];
	$credit_card_account_name = $row['credit_card_account_name'];
	$credit_card_account_number = $row['credit_card_account_number'];
	$bank_account_name = $row['bank_account_name'];
	$bank_account_number = $row['bank_account_number'];
	if($bank_account_type=='Credit_Card'){
	$name='Credit Card('.$credit_card_account_name.')';
	$account_no=$credit_card_account_number.'XXXXXX';
	$class='fa fa-credit-card-alt';
	}
	else if($bank_account_type=='Bank'){
	$name=$bank_account_type.'('.$bank_account_name.')';
	$account_no=$bank_account_number.'XXXXXX';
	$class='fa fa-university';
	}else {
	$name=$bank_account_type.'('.$bank_account_name.')';
	$account_no='XXXXXXX112323';
	$class='fa fa-money';
	}
	}
	$que="select * from account_info where bank_s_no='$s_no' and account_status='Active'";
	$run=mysql_query($que);
	$total_credit_amount=0;
	$total_debit_amount=0;
	$running_amount=0;
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
	$running_amount=$total_credit_amount-$total_debit_amount;
	}				
	?>
	<input type="hidden" name="s_no" id="s_no" value="<?php echo $s_no; ?>" />
    <section class="content">
	<div id="sample_div" style="display:none;"></div>
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <div class="col-xs-12">
    <div class="box my_border_top">
        <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">				
			<div class="col-sm-12">
			<div class="col-sm-10">
                <h4><i class="<?php echo $class; ?>">&nbsp;<?php echo $name; ?></i></h4>
                <h5><?php echo $account_no; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Running Balance : <b><a style="color:red"><?php echo $running_amount;?></a><b></h5>
            </div>
			<div class="col-sm-2">
   <div class="col-sm-4">
    <input type="button" name="pdf" value="Print Pdf" onclick="for_print()" class="btn btn-success"></div>
	<div class="col-sm-3"></div>
	<div class="col-sm-4">
    <input type="button" name="excel" value="Print Excel" onclick="exportTableToExcel('PrintTable', 'transaction_report')" class="btn btn-success">
	</div>
	<div class="col-sm-1"></div>
</div>
			</div>
				<div class="col-md-12 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
                  <th>Date</th>
				  <th>Customer/Vendor Name</th>
				  <th>Type</th>
				  <th>Status</th>
				  <th>Payment Mode</th>
				  <th>Deposit</th>
				  <th>Withdrawals</th>
				  <th>Running Balance</th>
                </tr>
                </thead>
				
				<tbody>
				<?php
				$que="select * from account_info where bank_s_no='$s_no' and account_status='Active' and company_code='$company_code'";
				$run=mysql_query($que);
				$total_credit_amount=0;
				$total_debit_amount=0;
				$running_amount=0;
				while($row=mysql_fetch_array($run)){
				$reference = $row['reference'];
				$cheque_status = $row['cheque_status'];
			    $customer_id = $row['customer_id'];
				$payment_mode = $row['payment_mode'];
				$select_bank = "select bank_account_type from bank_or_credit_card_info where s_no='$payment_mode'";
				$run2 = mysql_query($select_bank);
				$fetchr = mysql_fetch_array($run2);
				$bank_account_type = $fetchr['bank_account_type'];
				$invoice_total_paid = $row['invoice_total_paid'];
				$transaction_type = $row['transaction_type'];
				$date1 = $row['date'];
				$date2 = explode("-",$date1);
				$date=$date2[2]."-".$date2[1]."-".$date2[0];
				if($transaction_type=='Credit'){
				$credit_amount=$invoice_total_paid;
				$debit_amount='';
				$total_credit_amount=$total_credit_amount+$credit_amount;			
				}else{
				$debit_amount=$invoice_total_paid;
				$credit_amount='';
				$total_debit_amount=$total_debit_amount+$debit_amount;
				}
				$running_amount=$total_credit_amount-$total_debit_amount;
				if($reference =='Customers'){
				   $select_company = "select * from contact_new where customer_id='$customer_id'";
				$run2=mysql_query($select_company);
				$row1=mysql_fetch_array($run2);
				$contact_name = $row1['customer_name'];
				$customer_mobile = $row1['customer_mobile'];
				$customer_name  = $contact_name."[".$customer_mobile."]";
				}else if($reference =='Office Expense'){
				      $select_customer2 = "select expense_vendor_name,expense_contact_no from shop_details where s_no='$customer_id'";
					  $run3 = mysql_query($select_customer2);
					  $fetchrow = mysql_fetch_array($run3);
					  $expense_vendor_name = $fetchrow['expense_vendor_name'];
					  $expense_contact_no = $fetchrow['expense_contact_no'];
				      $customer_name = $expense_vendor_name."[".$expense_contact_no."]";
				 } else if($reference =='Product Expense'){
				       $select_customer2 = "select expense_type from product_expense_type_new where s_no='$customer_id'";
					  $run3 = mysql_query($select_customer2);
					  $fetchrow = mysql_fetch_array($run3);
					  $expense_type = $fetchrow['expense_type'];
				      $customer_name = $expense_type;
				 }else if($reference =='Transport Expense'){
				     $select_customer2 = "select * from transport_detail_new where s_no='$customer_id'";
					   $run3 = mysql_query($select_customer2);
					  $fetchrow = mysql_fetch_array($run3);
					  $transport_name = $fetchrow['transport_name'];
				      $customer_name = $transport_name;
				 }
				else{
			    $select_customer = "select contact_first_name,contact_last_name,contact_company_name,contact_contact_phone from contact_master where s_no='$customer_id'";
				$run1 = mysql_query($select_customer);
				$numrow = mysql_num_rows($run1);
				if($numrow>0){
			    $select_cust = mysql_fetch_array($run1);
				$contact_first_name = $select_cust['contact_first_name'];
				$contact_last_name = $select_cust['contact_last_name'];
				$contact_company_name = $select_cust['contact_company_name'];
				$contact_contact_phone = $select_cust['contact_contact_phone'];
				$customer_name = $contact_first_name." ".$contact_last_name."[".$contact_contact_phone."]";
				} }
	            ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><a href="javascript:get_content('banking/customer_detail')" style="color:#333;"><?php echo $customer_name; ?></a></th>
				  <th><?php echo $transaction_type; ?></th>
				  <?php if($cheque_status=='Cleared') { ?>
				  <th style="color:#2E86C1"><?php echo $cheque_status; ?></th>
				  <?php } else { ?>
				  <th><a href='cheque_dd_details.php' style="color:red"><?php echo $cheque_status; ?></a></th>
				  <?php } ?>
				  <th><?php echo $bank_account_type; ?></th>
				  <th><?php echo $credit_amount; ?></th>
				  <th><?php echo $debit_amount; ?></th>
				  <th><?php echo $running_amount; ?></th>
		          <?php  } ?>
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
