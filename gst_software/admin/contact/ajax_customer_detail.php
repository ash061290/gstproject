<?php include("../../attachment/session.php");
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
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
				<tr  align='center'>
				<th><?php echo $serial_no; ?></th>
				<th><?php echo $date_customer; ?></th>
				<th><?php echo $customer_id; ?></th>
				<th><?php echo $customer_name; ?></th>
				<th><?php echo $customer_mobile; ?></th>
				<th><a href="javascript:post_content('contact/customer_regular_detail','id=<?php echo $s_no; ?>')" title="Details"><button class="btn btn-success">Payment Details</button></a></th>
				<th>
				<!--<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" title="Edit" href="javascript:post_content('contact/customer_edit','id=<?php //echo $s_no; ?>')"></a>  &nbsp;&nbsp;&nbsp;&nbsp; --><a style="color:Red;" aria-hidden="true" title="Delete" onclick="return myFunction()" class="fa fa-times" href='contact_delete.php?id=<?php echo $s_no; ?>'></a>	
				</th>
				</tr>
				<?php }   ?>
				<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>