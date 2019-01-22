<?php 
include("../../attachment/session.php"); ?>
     <div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped">
        <thead class="btn-success">
     <tr>
      <th>Invoice Date</th>
      <th>Invoice No</th>
       <th>Product Name</th>
      <!--<th>Purchase MRP</th>-->
      <th>Purchase Quantity</th>
      <th>Pay Amount</th>
      <th>Due Amount</th>
      <th>Total Amount</th>
       <th>Invoice status </th>
      <th>action</th>
    </tr>
  </thead>
   <script>
function valid(s_no){ 
//alert(s_no);
var myval=confirm("Are you sure want to permanent Delete this record !!!!");
if(myval==true){
delete_purchase_invoice(s_no);       
 }            
else  {      
return false;
  }       
} 
  function delete_purchase_invoice(s_no){
    //alert(s_no);
$.ajax({
type: "POST",
url: software_link+"recycle/purchase_report_permanent_delete_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
  alert(detail);
    var res=detail.split("|?|");
         if(res[1]=='success'){
             alert('Successfully Deleted');
           get_content('report/Purchase_report');
         }else{
               alert(detail); 
         }
}
});
}
</script>
<script>
function restore(s_no){ 
//alert(s_no);
var myval=confirm("Are you sure want to restore this record !!!!");
if(myval==true){
restore_purchase_invoice(s_no);       
 }            
else  {      
return false;
  }       
} 
  function restore_purchase_invoice(s_no){
$.ajax({
type: "POST",
url: software_link+"recycle/restore_purchase_report_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
    var res=detail.split("|?|");
         if(res[1]=='success'){
             alert('Successfully Restore');
           get_content('report/Purchase_report');
         }else{
               alert(detail); 
         }
}
});
}
</script>
  <tbody>
<?php
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
if(isset($_GET['current_year']))
{
$current_year = $_GET['current_year'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
 }
$que="SELECT * FROM purchase_invoice_new where invoice_status='Deleted' and company_code='$company_code' and invoice_date >= '$from_date' and invoice_date <= '$to_date' GROUP BY invoice_no ";
$serial_no=0;
$income_total_amount=0;
$res1 = mysql_query($que) or die(mysql_error());
while($row3 = mysql_fetch_array($res1))
{
$s_no =$row3['s_no'];
$date = $row3['invoice_date'];
$invoice_no = $row3['invoice_no']."<br>";
$invoice_product_name = $row3['invoice_product_name'];
//$item_mrp = $row3['item_mrp'];
$invoice_quantity = $row3['invoice_quantity'];
$invoice_total_paid = $row3['invoice_total_paid'];
$invoice_due_amount = $row3['invoice_due_amount'];
$invoice_grand_total = $row3['invoice_grand_total'];
$invoice_status      =$row3['invoice_status'];

$que1="select model_no from item where s_no='$invoice_product_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$invoice_product_name =$row1['model_no'];
?>
<tr>
<th><?php echo $date; ?></th>
<th><?php echo $invoice_no; ?></th>
<th><?php echo $invoice_product_name; ?></th>
<!--<th><?php //echo $item_mrp; ?></th>-->
<th><?php echo $invoice_quantity; ?></th>
<th><?php echo $invoice_total_paid; ?></th>
<th><?php echo $invoice_due_amount; ?></th>
<th><?php echo $invoice_grand_total; ?></th>
<th><?php echo $invoice_status; ?></th>
<th> <a href="#" onclick="restore('<?php echo $s_no;?>');" style="color:bule;" aria-hidden="true" class="fa fa-undo"></a> &nbsp;&nbsp;&nbsp;
<a href="#" onclick="valid('<?php echo $s_no;?>');" style="color:Red;" aria-hidden="true" class="fa fa-trash-o"></a> &nbsp;&nbsp;&nbsp;</th>
</tr> <?php }  ?>
</tbody>
</table>
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