<?php 
include("../../attachment/session.php");
 if(isset($_GET['estimate_by'])) 
 {
$search_by = $_GET['estimate_by'];
 ?>
<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Date</th>
                  <th>Estimate No</th>
                  <th>Refrence</th>
				  <th>Customer Name</th>
                  <th>Status</th>
				  <th>Expiry Date</th>
                  <th>Amount</th>
				  <th>Estimate Status</th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
if($search_by != 'all'){
  $que="select * from sales_estimate_info where invoice_status='Active' AND estimate_status2='$search_by' and company_code='$company_code' GROUP BY invoice_no";
  
}
 if($search_by =='Draft'){
    $que="select * from sales_estimate_draft_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no"; }
 
if($search_by == 'all')
{
$que="select * from sales_estimate_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
$que2="select * from sales_estimate_draft_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
$run2 = mysql_query($que2) or die(mysql_error());
$serial_no2 =0;
while($row=mysql_fetch_array($run2)){
		$s_no=$row['s_no'];
		$estimate_no=$row['invoice_no'];
		$estimate_date = $row['invoice_date'];
		$start_date = explode("-",$estimate_date);
		$estimate_date = $start_date[2]."-".$start_date[1]."-".$start_date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$estimate_type=$row['invoice_type'];
		$estimate_status = $row['estimate_status'];
		$estimate_status2 = $row['estimate_status2'];
		$estimate_expire = $row['invoice_due_date'];
		$end_date = explode("-",$estimate_expire);
		$estimate_expire = $end_date[2]."-".$end_date[1]."-".$end_date[0];
	$serial_no2++;
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $estimate_date; ?></th>
	<th><a href="sales_estimate_list_action.php?sales_id=<?php echo $s_no; ?><?php if($search_by =='Draft'){ echo "&estimate_type=draft";} ?>"><?php echo $estimate_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $estimate_status; ?></span></th>
	<th><?php echo $estimate_expire; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<?php if($search_by == 'Draft')
	{
		?>
		<th><a href="#" onclick="status_draft('<?php echo $estimate_no; ?>')"><?php echo $estimate_status2; ?></a></th>
<?php
	} else
	{ ?>
	<th><a href="#" onclick="status_change('<?php echo $estimate_no; ?>')"><?php echo $estimate_status2; ?></a></th>
	<?php } ?>
</tr>
<?php    
}
	?>
<?php }
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$estimate_no=$row['invoice_no'];
		$estimate_date = $row['invoice_date'];
		$start_date = explode("-",$estimate_date);
		$estimate_date = $start_date[2]."-".$start_date[1]."-".$start_date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$estimate_type=$row['invoice_type'];
		$estimate_status = $row['estimate_status'];
		$estimate_status2 = $row['estimate_status2'];
		$estimate_expire = $row['invoice_due_date'];
		$end_date = explode("-",$estimate_expire);
		$estimate_expire = $end_date[2]."-".$end_date[1]."-".$end_date[0];
	$serial_no++;
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $estimate_date; ?></th>
	<th><a href="sales_estimate_list_action.php?sales_id=<?php echo $s_no; ?><?php if($search_by =='Draft'){ echo "&estimate_type=draft";} ?>"><?php echo $estimate_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $estimate_status; ?></span></th>
	<th><?php echo $estimate_expire; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<?php if($search_by == 'Draft')
	{  ?>
		<th><a href="#" onclick="status_draft('<?php echo $estimate_no; ?>')"><?php echo $estimate_status2; ?></a></th>
<?php
	} else
	{ ?>
	<th><a href="#" onclick="status_change('<?php echo $estimate_no; ?>')"><?php echo $estimate_status2; ?></a></th>
	<?php } ?>
</tr>
<?php    
}
	?>
		</tbody>
             </table>	 
<?php
}
?>
<?php
//sales_invoice_info status change
if(isset($_GET['sales_invoice'])) 
{ 
  $status_value = $_GET['sales_invoice'];
 ?>
  <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Invoice No</th>
                  <th>Order No</th>
				  <th>Customer Name</th>
				  <th>Invoice Status</th>
                  <th>Due Date</th>
                  <th>Amount</th>
				  <th>Due Balance</th>
                </tr>
                </thead>
				<tbody >
<?php
 if($status_value == 'Draft')
 {
 $que="select * from sales_invoice_draft_info where invoice_status='Active' AND invoice_status2='Draft' and company_code='$company_code' GROUP BY invoice_no";
 }
 if($status_value == "all")
 {
   $que="select * from sales_invoice_info where invoice_status='Active' and company_code='$company_code' GROUP BY sales_invoice_info.invoice_no"; 
 }
 if($status_value == 'Approved' || $status_value == 'Partially Paid' || $status_value == 'Unpaid Invoice'  || $status_value == 'Paid Invoice' || $status_value == 'Debit Notes' || $status_value == 'Retainer')
 {
   $que="select * from sales_invoice_info where invoice_status='Active' AND invoice_status2='$status_value' and company_code='$company_code' GROUP BY invoice_no";
 }
 if($status_value=='Overdue')
 {
   $que="select * from sales_invoice_info where invoice_status='Active' and company_code='$company_code' and invoice_due_date < CURDATE() GROUP BY invoice_no";
 }
 if($status_value =='Advance')
 {
   $que="select * from sales_invoice_info where invoice_status='Active' AND advance_no!='' and company_code='$company_code' GROUP BY invoice_no"; 
 }
 if($status_value == 'Delivery Challan')
 {
	$que="select * from sales_invoice_info where invoice_status='Active' AND challan_no!='' and company_code='$company_code' GROUP BY invoice_no"; 
 }
	
	$run=mysql_query($que) or die(mysql_error());
	$serial_no=0;
	while($row=mysql_fetch_array($run)){
	$s_no=$row['s_no'];
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_due_date1=$row['invoice_due_date'];
	$invoice_due_date2=explode('-',$invoice_due_date1);
	$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$invoice_order_no=$row['invoice_order_no'];
	$invoice_type=$row['invoice_type'];
	$invoice_status=$row['invoice_status'];
	$invoice_status2 = $row['invoice_status2'];
	$serial_no++;
	$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
	$run1=mysql_query($que1) or die(mysql_error());
	$row1=mysql_fetch_array($run1);
	$contact_company_name=$row1['contact_company_name'];
	$contact_tittle_name=$row1['contact_tittle_name'];
	$contact_first_name=$row1['contact_first_name'];
	$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><a href="sales_invoice_list.php?inv_id=<?php echo $invoice_no; ?>"><?php echo $invoice_no; ?></a></th>
	<th><?php echo $invoice_order_no; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><a href="sales_invoice_list.php?inv_draft=<?php echo $invoice_no; ?>"><?php echo $invoice_status2 ?></a></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
</tr>
<?php } ?>
		</tbody>
            
            </table> 
 <?php
 }
 //end sales invoice
 
   //delivery_challan_table status change
   if(isset($_GET['sales_delivery_challan_status']))
   {
   ?>
     <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Date</th>
                  <th>challan No</th>
                  <th>Refrence</th>
				  <th>Customer Name</th>
				  <th>Status</th>
                  <th>Amount</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				<tbody>
   <?php
     $status_value = $_GET['sales_delivery_challan_status'];
	 if($status_value == 'all'){
  $que="select * from sales_delivery_challan_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
  $que2 = "select * from sales_delivery_challan_draft_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
  $run2 = mysql_query($que2);
}
if($status_value=='Draft')
{
    $que="select * from sales_delivery_challan_draft_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
}
if($status_value == 'Invoiced' || $status_value == 'Unpaid' || $status_value == 'No Invoice' || $status_value =='Advance' || $status_value == 'Return' || $status_value == 'Delivered')
 {
  $que="select * from sales_delivery_challan_info where invoice_status='Active' AND invoice_status2='$status_value' and company_code='$company_code' GROUP BY invoice_no";
   $que2="select * from sales_delivery_challan_draft_info where invoice_status='Active' AND invoice_status2='$status_value' and company_code='$company_code' GROUP BY invoice_no";
   $run2 = mysql_query($que2);
 }
 if($status_value=='Partially Paid')
 {
  $que = "select sales_delivery_challan_info.s_no,sales_delivery_challan_info.invoice_no,sales_delivery_challan_info.challan_type,sales_delivery_challan_info.invoice_date,sales_delivery_challan_info.invoice_reference,sales_delivery_challan_info.invoice_firm_name,sales_delivery_challan_info.invoice_status,sales_delivery_challan_info.invoice_grand_total,sales_delivery_challan_info.invoice_status2,sales_delivery_challan_info.invoice_type from sales_delivery_challan_info join sales_invoice_info on sales_delivery_challan_info.invoice_no=sales_invoice_info.challan_no where sales_invoice_info.challan_no !='' and sales_invoice_info.invoice_due_amount < sales_invoice_info.invoice_grand_total and sales_invoice_info.invoice_total_paid !='' and sales_invoice_info.invoice_due_amount!='0' and sales_delivery_challan_info.invoice_status2='Delivered' and sales_delivery_challan_info.company_code='$company_code'";
 }
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$challan_no=$row['invoice_no'];
		$challan_type = $row['challan_type'];
		$date = $row['invoice_date'];
		$date = explode("-",$date);
		$date = $date[2]."-".$date[1]."-".$date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_status2 = $row['invoice_status2'];
		$challan_type2 = $row['invoice_type'];
	
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
 ?>
<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href="sales_delivery_challan_list.php?challan_no=<?php echo $challan_no; ?>"><?php echo $challan_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th style="color:#606125;"><?php echo $invoice_status2; ?></th>
	<th onclick="change_status1('<?php echo $challan_no; ?>');"><?php echo $invoice_grand_total; ?></th>
<th>
<center>
   <?php if($invoice_status2 =='No Invoice'){  if($status_value == 'Draft'){ ?>
   <a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href='sales_delivery_challan_draft_to_invoice.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Invoice </a> &nbsp;&nbsp;&nbsp;&nbsp;
   <?php } else { ?>
<a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href='delivery_challan_to_invoice.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Invoice </a> &nbsp;&nbsp;&nbsp;&nbsp;
   <?php } ?>
<?php } else if($invoice_status2 == 'Invoiced') { ?>
<a style="color:#606125;" aria-hidden="true" class="fa fa-truck" href='change_status.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Delivered</a> &nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
   <?php if($invoice_status2 == 'Delivered')
            { ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-refresh"  href='#' data-toggle="modal" data-target="#myModal1" onclick="up_challan('<?php echo $challan_no; ?>')"> Return</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_delivery_challan_edit.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='#'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='delivery_challan_delete.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type; ?>'> Delete</a></center>
</th>
</tr>
<?php  $serial_no++; } ?>
<!-- draft-->
<?php
if(!empty($run2)){
while($row=mysql_fetch_array($run2)){
		$s_no=$row['s_no'];
		$challan_no=$row['invoice_no'];
		$challan_type = $row['challan_type'];
		$date = $row['invoice_date'];
		$date = explode("-",$date);
		$date = $date[2]."-".$date[1]."-".$date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_status2 = $row['invoice_status2'];
		$challan_type2 = $row['invoice_type'];
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
 ?>
<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href="sales_delivery_challan_list.php?challan_no=<?php echo $challan_no; ?>"><?php echo $challan_no; ?></a></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th style="color:#606125;"><?php echo $invoice_status2; ?></th>
	<th onclick="change_status1('<?php echo $challan_no; ?>');"><?php echo $invoice_grand_total; ?></th>
<th>
<center>
   <?php if($invoice_status2 =='No Invoice'){  if($status_value == 'Draft'){ ?>
   <a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href='sales_delivery_challan_draft_to_invoice.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Invoice </a> &nbsp;&nbsp;&nbsp;&nbsp;
   <?php } else { ?>
<a style="color:#606125;" aria-hidden="true" class="fa fa-plus" href='delivery_challan_to_invoice.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Invoice </a> &nbsp;&nbsp;&nbsp;&nbsp;
   <?php } ?>
<?php } else if($invoice_status2 == 'Invoiced') { ?>
<a style="color:#606125;" aria-hidden="true" class="fa fa-truck" href='change_status.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type2; ?>'> Delivered</a> &nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
   <?php if($invoice_status2 == 'Delivered')
            { ?>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-refresh"  href='#' data-toggle="modal" data-target="#myModal1" onclick="up_challan('<?php echo $challan_no; ?>')"> Return</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_delivery_challan_edit.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='#'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='delivery_challan_delete.php?challan_no=<?php echo $challan_no; ?>&challan_type=<?php echo $challan_type; ?>'> Delete</a></center>
	
</th>

</tr>
<?php  $serial_no++; } } ?>
		</tbody>
            
             </table>
<?php 
   }
   //end sales_delivery_challan_info 
   
   //start sales_order_status changed
   if(isset($_GET['sales_order_info_status']))
   {
      $status_value = $_GET['sales_order_info_status'];
	  ?>
	   <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				 
                  <th>Date</th>
                  <th>Sales Order</th>
				  <th>Ref</th>
				  <th>Customer Name</th>
                  <th>Status</th>
				   <th>Shippment Date</th>
                  <th>Amount</th>
				  
                </tr>
                </thead>
				<tbody id="search_table">


<?php
if( $status_value=='Draft')
{
  $que = "select * from sales_order_draft_info where invoice_status='Active' and company_code='$company_code' order by invoice_no";
}
if($status_value=='All')
{
$que="select * from sales_order_info where invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
}
if($status_value =='Pending Invoice')
{
$que="select * from sales_order_info where invoice_status='Active' AND sales_order_status='Challan Created' and company_code='$company_code' GROUP BY invoice_no";
}
if($status_value=='Invoice Created' || $status_value=='Delivered' || $status_value=='Return' || $status_value=='Partially Paid')
{
$que="select * from sales_order_info where invoice_status='Active' AND sales_order_status='$status_value' and company_code='$company_code' GROUP BY invoice_no";
}
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;
while($row=mysql_fetch_array($run)){
		$s_no=$row['s_no'];
		$invoice_date1=$row['invoice_date'];
		$invoice_date2=explode('-',$invoice_date1);
		$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
		$order_no=$row['invoice_no'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_due_date1=$row['invoice_due_date'];
		$invoice_due_date2=explode('-',$invoice_due_date1);
		$invoice_due_date=$invoice_due_date2[2].'-'.$invoice_due_date2[1].'-'.$invoice_due_date2[0];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_due_amount=$row['invoice_due_amount'];
		$order_type=$row['invoice_type'];
		$ref = $row['invoice_reference'];
		$sales_order_status = $row['sales_order_status'];
	$serial_no++;
	
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $invoice_date; ?></th>
	<th><a href="sales_order_list.php?sales_order_no=<?php echo $order_no; ?>"><?php echo $order_no; ?></a></th>
	<th><?php echo $ref; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><span style="color:#6B823E;"><?php echo $sales_order_status; ?></span></th>
	<th><?php echo $invoice_due_date; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
</tr>
<?php } ?>
		</tbody>
             </table>
	  <?php
   }
   //payment_received ajax
   if(isset($_GET['payment_received']))
   {
   $payment_type = $_GET['payment_received'];
   ?>
   <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Date</th>
                  <th>Invoice No</th>
				  <th>Type</th>
                  <th>Refrence</th>
				  <th>Customer Name</th>
                  <th>Amount</th>
				  <th>Due Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody >

<?php
   if($payment_type=="all")
   {
    $qry ="SELECT * FROM sales_invoice_info where invoice_status='Active' and invoice_due_amount!='0' and company_code='$company_code' GROUP BY invoice_no"; 
   }
   if($payment_type=="Invoiced")
   {
		$qry ="SELECT * FROM sales_invoice_info where challan_no='' and company_code='$company_code' GROUP BY invoice_no";
    }
	if($payment_type == "Partially")
	{
	$qry = "select * from sales_invoice_info where invoice_due_amount!='0' and company_code='$company_code' and invoice_due_amount!=invoice_grand_total";
	}
	if($payment_type == "Advance")
	{
	$qry = "select * from sales_invoice_info where invoice_status2 = 'Advance' and invoice_due_amount!='0' and company_code='$company_code'";
	}
	if($payment_type == "Invoiced")
	{
	$qry = "select * from sales_invoice_info where challan_no ='' and invoice_due_amount!='0' and company_code='$company_code'";
	}
	if($payment_type == "Challan Invoice")
	{
	$qry = "select * from sales_invoice_info where challan_no !='' and invoice_due_amount!='0' and company_code='$company_code'";
	}
	if($payment_type == "Advance Invoice")
	{
	$qry = "select * from sales_invoice_info where invoice_status2 = 'Advance' and company_code='$company_code'";
	}
		$rundata = mysql_query($qry);
		$serial_no=0;
		while($row=mysql_fetch_array($rundata)){
		$s_no=$row['s_no'];
		$challan_no=$row['invoice_no'];
		$date = $row['invoice_date'];
		$date = explode("-",$date);
		$date = $date[2]."-".$date[1]."-".$date[0];
		$invoice_reference=$row['invoice_reference'];
		$invoice_firm_name=$row['invoice_firm_name'];
		$invoice_status=$row['invoice_status'];
		$invoice_grand_total=$row['invoice_grand_total'];
		$invoice_status2 = $row['invoice_status2'];
		$challan_type2 = $row['invoice_type'];
		$invoice_due_amount = $row['invoice_due_amount'];
		$inv_type="Invoiced";
		if($row['invoice_status2'] == "Advance"){
		 $inv_type = "Advance Invoice"; }
		 if($row['challan_no']){
		 $inv_type = "Challan Invoice"; }
$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href="single_payment.php?inv_id=<?php echo $challan_no; ?>&inv_type=<?php echo $invoice_status2; ?>"><?php echo $challan_no; ?></a></th>
	<th style="color:#922A14"><?php echo $inv_type; ?></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th onclick="change_status1('<?php echo $challan_no; ?>');"><?php echo $invoice_grand_total; ?></th>
    <th><?php echo $invoice_due_amount; ?></th>
    <th>
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php echo $challan_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" onclick="if(window.confirm(' Do You Want Deleted..'))return myFunction('<?php echo $challan_no; ?>')" class="fa fa-trash-o" href='#'> Delete</a></th>
	

</tr>
<?php  $serial_no++; } ?>
<?php
		} 
	//credit notes type filter
     if(isset($_POST['credit_value']))
{
$return_term = $_POST['credit_value'];
?>
   <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
				  <th>Credit Note No</th>
				  <th>Referance</th>
				  <th>Customer Name</th>
				  <th>Reason</th>
				   <th>Return Term</th>
                  <th>Amount</th>
				  <th>Due Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody >
<?php
if($return_term == "all")
{
  $que="select sales_invoice_info.invoice_no,sales_invoice_info.invoice_type,sales_invoice_info.invoice_date,sales_invoice_info.invoice_reference,sales_invoice_info.invoice_due_amount,sales_invoice_info.invoice_firm_name,sales_invoice_info.invoice_grand_total,sales_invoice_info.challan_no,sales_invoice_info.invoice_status,sales_delivery_challan_info.invoice_no,sales_delivery_challan_info.order_return_reason,sales_delivery_challan_info.order_return_term from sales_invoice_info join sales_delivery_challan_info on sales_invoice_info.challan_no=sales_delivery_challan_info.invoice_no where sales_invoice_info.invoice_status='Active' and sales_invoice_info.invoice_status2='Debit Notes' and sales_invoice_info.company_code='$company_code' GROUP BY sales_invoice_info.invoice_no";
}
else
{
	$que="select sales_invoice_info.invoice_no,sales_invoice_info.invoice_type,sales_invoice_info.invoice_date,sales_invoice_info.invoice_reference,sales_invoice_info.invoice_due_amount,sales_invoice_info.invoice_firm_name,sales_invoice_info.invoice_grand_total,sales_invoice_info.challan_no,sales_invoice_info.invoice_status,sales_delivery_challan_info.invoice_no,sales_delivery_challan_info.order_return_reason,sales_delivery_challan_info.order_return_term from sales_invoice_info join sales_delivery_challan_info on sales_invoice_info.challan_no=sales_delivery_challan_info.invoice_no where sales_invoice_info.invoice_status='Active' and sales_invoice_info.invoice_status2='Debit Notes' and sales_delivery_challan_info.order_return_term='$return_term' and sales_invoice_info.company_code='$company_code' GROUP BY sales_invoice_info.invoice_no";
	}
	$run=mysql_query($que) or die(mysql_error());
	$serial_no=0;
	while($row=mysql_fetch_array($run)){
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_type=$row['invoice_type'];
	$reference = $row['invoice_reference'];
	$return_reason = $row['order_return_reason'];
	$order_return_term = $row['order_return_term'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$serial_no++;
	$que1="select * from contact_master where s_no='$invoice_firm_name'";
	$run1=mysql_query($que1) or die(mysql_error());
	$row1=mysql_fetch_array($run1);
	$contact_company_name=$row1['contact_company_name'];
	$contact_tittle_name=$row1['contact_tittle_name'];
	$contact_first_name=$row1['contact_first_name'];
	$contact_last_name=$row1['contact_last_name'];
?>

<tr  align='center'>
	<th><?php echo $invoice_date; ?></th>
	<th><a href=""><?php echo $invoice_no; ?></a></th>
	<th><?php echo $reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><?php echo $return_reason; ?></th>
	<th><?php echo $order_return_term; ?></th>
	<th><?php echo $invoice_grand_total; ?></th>
	<th><?php echo $invoice_due_amount; ?></th>
	<th>
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='new_invoice_edit.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='../../invoice_pdf/shree_lakshya.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>'> Print </a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" class="fa fa-trash-o" onclick="if(window.confirm('Do You Want Delete..')){  window.open('credit_notes_delete.php?invoice_no=<?php echo $invoice_no; ?>&invoice_type=<?php echo $invoice_type; ?>', '_self'); }" href="#"> Delete</a>
	   </th>
</tr>
<?php } ?>
		</tbody>
            </table> 
<?php
}	 
		?>
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