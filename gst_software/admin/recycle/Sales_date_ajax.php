<?php include("../../attachment/session.php"); ?>
     <div class="box-body table-responsive">
         <table id="example4" class="table table-bordered table-striped">
        <thead>
		 <tr>
		  <th>Invoice Date</th>
		  <th>Invoice No</th>
		   <th>Product Name</th>
		  <th>Sale MRP</th>
		  <th>Sales Quantity</th>
		  <th>Total Amount</th>
		  <th>Due Amount</th>
		  <th>Pay Amount</th>
		  <th>Action</th>
		</tr>
	</thead>
	<script>
function valid(s_no){ 
//alert(s_no);
var myval=confirm("Are you sure want to Delete this record !!!!");
if(myval==true){
delete_sales_invoice(s_no);       
 }            
else  {      
return false;
  }       
} 
  function delete_sales_invoice(s_no){
    //alert(s_no);
$.ajax({
type: "POST",
url: software_link+"report/sales_report_invoice_delete_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
  alert(detail);
    var res=detail.split("|?|");
         if(res[1]=='success'){
             alert('Successfully Deleted');
           get_content('report/Sale_report');
         }else{
               alert(detail); 
         }
}
});
}
</script>
	<tbody>
<?php
if(isset($_GET['from_date'])&& isset($_GET['to_date']))
{
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
 echo $query1="SELECT * FROM sales_invoice_new where invoice_status = 'Deleted' and company_code='$company_code' and invoice_date>='$from_date' and invoice_date<='$to_date' GROUP BY invoice_no";
 }
$serial_no=0;
$income_total_amount=0;
$res1 = mysql_query($query1) or die(mysql_error());
while($row3 = mysql_fetch_array($res1))
{
$contact_name = $row3['contact_first_name']."".$row3['contact_last_name'];
$date = $row3['invoice_date'];
$company_name = $row3['contact_company_name'];
$contact_mobile = $row3['contact_contact_phone'];
$pay_term = $row3['contact_payment_terms'];
$invoice_no = $row3['invoice_no'];
$due_date2 = $row3['invoice_due_date'];
$invoice_due_amount = $row3['invoice_due_amount'];
$invoice_total_paid = $row3['invoice_total_paid'];
$invoice_grand_total = $row3['invoice_grand_total'];
$transaction_type = $row3['transaction_type'];
$account_name = $row3['account_name'];
$transaction_type = $row3['transaction_type'];
$date_c = date('Y-m-d');
if($pay_term == 'Due end of the month')
{
$date1 = new DateTime("$date_c");
$date2 = new DateTime("$due_date2");
$diff = $date2->diff($date1)->format("%a Days");
$due_date = $diff;
}
if($pay_term == 'Due end of the next month')
{
$date1 = new DateTime("$date_c");
$date2 = new DateTime("$due_date2");
$diff = $date2->diff($date1)->format("%a Days");
$due_date = $diff;
}
if($pay_term == 'Due on receipt')
{
$date1 = new DateTime("$date_c");
$date2 = new DateTime("$due_date2");
$diff = $date2->diff($date1)->format("%a Days");
$due_date = $diff;
}
if($pay_term =='Net-15' || $pay_term =='Net-30' || $pay_term =='Net-45' || $pay_term =='Net-60')
{
list($y,$m,$d) = explode("-",$date);
list($net,$day) = explode("-",$pay_term);
$due_date = strtotime($date);
$due_date = strtotime("+$day day", $due_date);
$due_date2 =  date('Y-m-d', $due_date);
$date1 = new DateTime("$date_c");
$date2 = new DateTime("$due_date2");
$diff = $date2->diff($date1)->format("%a Days");
$due_date = $diff;
	}
$date = date_create($date);
$date = date_format($date,"d-m-Y");	
$due_date2 = date_create($due_date2);
$due_date2 = date_format($due_date2,"d-m-Y");
	?>
<tr>
<th><?php echo $date; ?></th>
<th><?php echo $invoice_no; ?></th>
<th><?php echo $contact_mobile; ?></th>
<?php if (isset($_GET['default_from_date']) && isset($_GET['default_to_date'])) { $a ="Ago"; }  else { $a ="Left"; } ?>
<th style="color:red"><?php echo $due_date."&nbsp;".$a; ?></th>
<th><?php echo $due_date2; ?></th>
<th>
<a href="contact_detail.php?<?php if(isset($_GET['debit_from_date'])){ echo "did=".$invoice_no; } else { echo "cid=".$invoice_no; } ?>"><?php echo $contact_name; ?></a>
</th>
<th><?php echo $invoice_grand_total; ?></th>
<a href="#">
<th style="color:#2E86C1"><?php echo $invoice_due_amount; ?>
</a></th>
<th><?php echo $invoice_total_paid; ?></th>
<th> <a href="#" onclick="valid('<?php echo $s_no;?>');" style="color:Red;" aria-hidden="true" class="fa fa-trash-o"> Delete</a></th>
</tr> <?php }  ?>
</tbody>
</table>
        </div> 
		<script>
$(function () {
$('#example4').DataTable()

})
</script>