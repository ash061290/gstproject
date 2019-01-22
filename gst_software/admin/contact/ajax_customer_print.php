<?php include("../../attachment/session.php");
      $from_date = $_GET['from_date'];
      $to_date = $_GET['to_date'];
	  $from_date1 = explode("-",$from_date);
	  $to_date1 = explode("-",$to_date);
	  $from_date1 = $from_date1['2']."-".$from_date1['1']."-".$from_date1['0'];
	  $to_date1 = $to_date1['2']."-".$to_date1['1']."-".$to_date1['0'];
	 ?>		
   <table border="1" cellpadding="0" cellspacing="0" id="printTable" width="100%">
   <tbody>
        <td colspan="5"> <strong>Customer Record From: <?php echo $from_date1; ?> To:<?php echo $to_date1; ?></strong></td>
      <tbody>
	   <tbody>
        <th style="align:center;width:5%">S_no</th>
        <th style="align:center;width:20%">Date</th>
        <th style="align:center;width:30%">Customer Name</th>
        <th style="align:center;width:15%">Contact Number</th>
        <th style="align:center;width:30%">Customer_Id</th>
      <tbody>
	  <?php 
	    $que="select * from contact_new where status='Active' and company_code='$company_code' and customer_date>='$from_date'and customer_date<='$to_date' ORDER BY s_no DESC";
	   $run=mysql_query($que) or die(mysql_error());
				$serial_no=0;	
				while($row=mysql_fetch_array($run)){
					$s_no=$row['s_no'];
					$customer_name=$row['customer_name'];
					$customer_mobile=$row['customer_mobile'];
					$date_customer=$row['customer_date'];
					
					$customer_id=$row['customer_id'];					
					$serial_no++;				
				?>
	<tr>
        <th style="align:center;width:5%"><?php echo $serial_no; ?></th>
        <th style="align:center;width:20%"><?php echo $date_customer; ?></th>
        <th style="align:center;width:30%"><?php echo $customer_name; ?></th>
        <th style="align:center;width:15%"><?php echo $customer_mobile; ?></th>
        <th style="align:center;width:30%"><?php echo $customer_id; ?></th>
      <tr>
	  <?php } ?>
   </table>

				