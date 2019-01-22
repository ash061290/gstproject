<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Contact Payment Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('banking/banking')"><i class="fa fa-list"></i>Bank Details</a></li>
        <li class="active">Transaction Details</li>
      </ol>
    </section>

<script>
	function valid(){   
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	return true;        
	 }            
	else  {      
	return false;
	 }       
	  } 
function for_income_ledger(){
	   var s_no = $("#c_id").val();
	   var date = new Date();
       var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
       var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0); 
	   var day_from = firstDay.getDate();
	   var day_from = "0"+day_from;
	   var month_from = firstDay.getMonth()+1;
	   var year_from = firstDay.getFullYear();
	   var day_to = lastDay.getDate();
	   var month_to = lastDay.getMonth()+1;
	   var year_to = lastDay.getFullYear();
	   var firstday = year_from+"-"+month_from+"-"+day_from;
	   var lastday = year_to+"-"+month_to+"-"+day_to;
	    $("#from_date").val(firstday);
	    $("#to_date").val(lastday);
		var from_date =  $("#from_date").val();
		var to_date   =  $("#to_date").val();
		  $.ajax({
		   method:"POST",
		   url:software_link+"contact/ajax_contact_payment_detail.php",
		   data:"from_date="+from_date+"&to_date="+to_date+"&s_no="+s_no,
		   success:function(detail){
		    $("#sample1").html(detail);
		   }
	   })
}
function check_date_wise()
{
	   var from_date = $("#from_date").val();
	   var to_date = $("#to_date").val();
	   var s_no = $("#c_id").val();
	  $.ajax({
		   method:"POST",
		   url:software_link+"contact/ajax_contact_payment_detail.php",
		   data:"from_date="+from_date+"&to_date="+to_date+"&s_no="+s_no,
		   success:function(detail){
			console.log(detail);
		    $("#sample1").html(detail);
		   }
	   })
}

$(document).ready(function(e){
	for_income_ledger();
});  
</script>
<script>
function for_print()
 {
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	var s_no = $("#c_id").val();
	$.ajax({
		method:"POST",
		url:software_link+"contact/ajax_contact_payment_detail_print.php",
		data:"from_date="+from_date+"&to_date="+to_date+"&s_no="+s_no,
		success:function(detail){
			//alert(detail);
			$("#sample2").html(detail);
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 $('#printTable').print();
		}
	})
 
 }
function exportTableToExcel(tableID, filename = ''){
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	var s_no = $("#c_id").val();
		$.ajax({
		method:"POST",
		url:software_link+"contact/ajax_contact_payment_detail_print.php",
		data:"from_date="+from_date+"&to_date="+to_date+"&s_no="+s_no,
				success:function(detail){
			//alert(detail);
			$("#sample2").html(detail);
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
	$s_no_new = $s_no;
    $total_amount ="";
    $total_paid ="";
    $total_due="";	
				$select = "select account_info.reference,account_info.date,account_info.transaction_type,account_info.invoice_no,account_info.payment_mode,contact_master.contact_status='Active',contact_master.contact_first_name,contact_master.contact_last_name,contact_master.contact_company_name,contact_master.contact_contact_phone,bank_or_credit_card_info.bank_account_type,bank_or_credit_card_info.bank_account_name,bank_or_credit_card_info.bank_name,bank_or_credit_card_info.account_type  from account_info join contact_master on account_info.customer_id=contact_master.s_no join bank_or_credit_card_info on account_info.bank_s_no=bank_or_credit_card_info.s_no where contact_master.s_no='$s_no' and contact_master.contact_status='Active' and account_info.account_status='Active' and bank_or_credit_card_info.bank_status='Active' and contact_master.company_code='$company_code'";
	$select_run = mysql_query($select);
	$numrow = mysql_num_rows($select_run);
	if($numrow>0){
	$s_no=1;
	while($fetchrow = mysql_fetch_array($select_run)){
	   $contact_first_name = $fetchrow['contact_first_name'];
	   $contact_last_name = $fetchrow['contact_last_name'];
	   $contact_company_name = $fetchrow['contact_company_name'];
	   $contact_contact_phone = $fetchrow['contact_contact_phone'];
	   $transaction_type = $fetchrow['transaction_type'];
	   $invoice_no = $fetchrow['invoice_no'];
	   $bank_account_type = $fetchrow['bank_account_type'];
	   $bank_account_name = $fetchrow['bank_account_name'];
	   $bank_name = $fetchrow['bank_name'];
	   $account_type = $fetchrow['account_type'];
	   $payment_mode = $bank_account_type;
	   $date = $fetchrow['date'];
	   $reference = $fetchrow['reference'];
	   if($transaction_type == 'Credit'){
	   $select_invoice = "select invoice_no,invoice_date,invoice_reference,invoice_product_name,invoice_quantity,invoice_grand_total,invoice_total_paid,invoice_due_amount from sales_invoice_new where invoice_no='$invoice_no' and invoice_status='Active' and company_code='$company_code'";
	   }
	   if($transaction_type == 'Debit' && $account_type !='Expense Account' ){
	    $select_invoice = "select invoice_no,invoice_date,invoice_reference,invoice_product_name,invoice_quantity,invoice_grand_total,invoice_total_paid,invoice_due_amount from purchase_invoice_new where invoice_no='$invoice_no' and company_code='$company_code'";
	   }
	   $run_invoice = mysql_query($select_invoice);
	    while($row1 = mysql_fetch_array($run_invoice)){
		  $invoice_date = $row1['invoice_date'];
		  $invoice_product_name = $row1['invoice_product_name'];
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_grand_total = $row1['invoice_grand_total'];
		  $total_amount +=$invoice_grand_total;
		  $invoice_total_paid = $row1['invoice_total_paid'];
		  $total_paid += $invoice_total_paid;
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $total_due += $invoice_due_amount;
		  $invoice_quantity = $row1['invoice_quantity'];
		  $invoice_due_amount = $row1['invoice_due_amount'];
		  $product_name = "select item_product_name from item where s_no='$invoice_product_name'";
		  $run2 = mysql_query($product_name);
		  $fetchrow2 = mysql_fetch_array($run2);
		  $item_product_name = $fetchrow2['item_product_name'];
		
	  	}
	}	
	?>
	<input type="hidden" id="c_id" value="<?php echo $s_no_new; ?>" />
	<div id="sample2" style="display:none;"></div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
    <div class="box my_border_top">
	     	<div class="col-sm-12">
			<div class="col-sm-4">
                <h4><i class="<?php echo $class ?>">&nbsp;<?php echo $contact_first_name." ".$contact_last_name."[".$contact_company_name."]"; ?></i></h4>
                <h5><strong>Mob : <?php echo $contact_contact_phone; ?></strong><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Balance :</strong> <b><a style="color:#0D0F2B;"><?php echo $total_amount; ?></a></b><br/><br/><strong>Total Due : </strong><b><a style="color:#AC4646;"><?php echo $total_due; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><strong>Total Paid :</strong> <b><a style="color:#128A52;"><?php echo $total_paid; ?></a></b></h5>
            </div>
			<div class="col-md-5">
			 <div class="col-md-6">
			 <br/>
              <div class="form-group">
               <label><?php echo "From Date"; ?></label>
                 <input type="date" name="date" id="from_date" value="" class="form-control" onchange='check_date_wise();' required>
                  </div>
                        </div>
           <div class="col-md-6">
		   <br/>
                 <div class="form-group">
                 <label><?php echo "To Date"; ?></label>
                  <input type="date" name="date" id="to_date" value="" class="form-control" onchange='check_date_wise();' required>
                     </div>
                       </div>
			</div>
			
   <div class="col-sm-3">
   <br/><br/>
    <input type="button" name="pdf" value="Print Pdf" onclick="for_print()" class="btn btn-success"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="excel" value="Print Excel" onclick="exportTableToExcel('printTable', 'customer_report')" class="btn btn-success">
	</div>
	<?php }  ?>
			</div>
        <div class="box-body">				
				<div class="col-md-12 box-body table-responsive" id="sample1">
               
                </div>	
		</div>
	</div>

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

