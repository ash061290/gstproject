<?php 
 include("../../attachment/session.php"); ?>
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

      include("../../connection/connect.php");
     if(isset($_GET['from_date']))
	 {
	    $from_date = $_GET['from_date'];
		$to_date = $_GET['to_date'];
		$qry ="SELECT * FROM sales_invoice_info where invoice_status='Active' AND invoice_date >= '$from_date' AND invoice_date <= '$to_date' GROUP BY invoice_no";
		$rundata = mysql_query($qry);
		$serial_no=0;
		while($row=mysql_fetch_array($rundata))
		{
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
		$type1 = $row['challan_no'];
		$type2 = $row['advance_no'];
		if(empty($type2))
		{
		 $inv_type = "Invoiced";
		}
		else
		{
		$inv_type = "Advance";
		}
	
$que1="select * from contact_master where s_no='$invoice_firm_name'";
$run1=mysql_query($que1) or die(mysql_error());
$row1=mysql_fetch_array($run1);
$contact_tittle_name=$row1['contact_tittle_name'];
$contact_first_name=$row1['contact_first_name'];
$contact_last_name=$row1['contact_last_name'];
?>
<tr  align='center' >
	<th><?php echo $date; ?></th>
	<th><a href=""><?php echo $challan_no; ?></a></th>
	<th style="color:#922A14"><?php echo $inv_type; ?></th>
	<th><?php echo $invoice_reference; ?></th>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th onclick="change_status1('<?php echo $challan_no; ?>');"><?php echo $invoice_grand_total; ?></th>
    <th><?php echo $invoice_due_amount; ?></th>
    <th>
	 <a href="#" data-toggle="modal" class="fa fa-google-wallet"  data-target="#myModal">  Payment</a>&nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='sales_invoice_delete.php?invoice_id=<?php echo $invoice_no; ?>'> Delete</a></th>
	

</tr>
<?php  $serial_no++; } ?>
<?php
		}
	 
 ?>