<?php include("../../attachment/session.php");
   $contact_type=$_POST['contact_type'];
   $business_type=$_POST['business_type'];
   if($business_type=='All-Business-Type'){
				$val="";
				}else {
				$val=" and contact_gst_treatment='$business_type'";
				}
				if($contact_type=='All-Contact'){
				$val1="";
				}else {
				$val1=" and contact_contact_type='$contact_type'";
				}
				$que="select * from contact_master where contact_status='Active'$val$val1 and company_code='$company_code'  ORDER BY s_no DESC";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
?>
     <table class="table-stripped" id="printTable" border='1px' cellpadding="0" cellspacing="0">
	 <tbody>
	     <th style="align:center;width:5%">S_no</th>
	     <th style="align:center;width:12%">Customer Name</th>
	     <th style="align:center;width:12%">Company Name</th>
	     <th style="align:center;width:10%">Contact No</th>
	     <th style="align:center;width:8%">Email Address</th>
	     <th style="align:center;width:12%">Gst Type</th>
	     <th style="align:center;width:20%">Shipping Address</th>
	     <th style="align:center;width:17%">Billing Address</th>
	     <th style="align:center;width:10%">Pan Card No</th>
	 </tbody>
<?php				$s_no=1;
				while($row=mysql_fetch_array($run)){
				?>
				<tr>
				 <td align="center"><?php echo $s_no; ?></td>
				 <td align="center"><?php echo $row['contact_first_name']." ".$row['contact_last_name']; ?></td>
				 <td align="center"><?php echo $row['contact_company_name']; ?></td>
				 <td align="center"><?php echo $row['contact_contact_phone']; ?></td>
				 <td align="center"><?php echo $row['contact_email']; ?></td>
				 <td align="center"><?php echo $row['contact_gst_treatment']; ?></td>
				 <td align="center"><?php echo $row['contact_shipping_address']; ?></td>
				 <td align="center"><?php echo $row['contact_address']; ?></td>
				 <td align="center"><?php echo $row['contact_pan']; ?></td>
				</tr>
				<?php
				$s_no++;
				}
				?>
				</table>