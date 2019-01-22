<?php 
    include("../../attachment/session.php");
	 if(isset($_POST['expense_id'])){
	    $id = $_POST['expense_id'];
		$expense_select = "select * from add_expense where id='$id' and company_code='$company_code'";
		$run = mysql_query($expense_select);
		$fetchrow = mysql_fetch_array($run);
		$m_name = $fetchrow['m_name'];
		$m_date = $fetchrow['insert_date'];
		$category = $fetchrow['category'];
		$cat_id = $category;
		$amount = $fetchrow['amount'];
		if($category){
		    $select_category = "select * from expense_category where id='$category' and company_code='$company_code'";
			$run2 = mysql_query($select_category);
			$fetchcat = mysql_fetch_array($run2);
			$category = $fetchcat['category_name'];
		}
		$data = array($m_name,$m_date,$category,$amount,$cat_id);
		echo $data = json_encode($data);
	 }
	  if(isset($_POST['view_expense_id'])){
	    $id = $_POST['view_expense_id'];
		$expense_select = "select * from add_expense where id='$id' and company_code='$company_code'";
		$run = mysql_query($expense_select);
		$fetchrow = mysql_fetch_array($run);
		$m_name = $fetchrow['m_name'];
		$report_id = $fetchrow['report_id'];
		$select_report = "select * from add_report where report_id='$report_id' and company_code='$company_code'";
		$run2 = mysql_query($select_report);
		$fetchrow2 = mysql_fetch_array($run2);
		$report_title = $fetchrow2['title'];
		$business_purpose = $fetchrow2['business_purpose'];
		$start_date = $fetchrow2['start_date'];
		$end_date = $fetchrow2['end_date'];
		$m_date = $fetchrow['insert_date'];
		$category = $fetchrow['category'];
		$cat_id = $category;
		$amount = $fetchrow['amount'];
		if($category){
		    $select_category = "select * from expense_category where id='$cat_id' and company_code='$company_code'";
			$run2 = mysql_query($select_category);
			$fetchcat = mysql_fetch_array($run2);
			$category = $fetchcat['category_name'];
		}
		$data = array($m_name,$m_date,$category,$amount,$cat_id,$report_title,$business_purpose,$start_date,$end_date);
	    $data = json_encode($data);
	 }
	 //expense type filter start
	 if(isset($_GET['expense_type'])){
	        $expense_type = $_GET['expense_type'];
			if($expense_type == "Unsubmitted"){
				?>
				<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Expense Date</th>
                  <th>Marchant Name</th>
                  <th>Expense Category</th>
				  <th>Expense Amount</th>
                  <th>Payment Status</th>
                  <th>Expense Status</th>
                </tr>
                </thead>
				<tbody>
				<?php
			$que = "select * from add_expense where expense_status='1' and company_code='$company_code'";
			$run=mysql_query($que) or die(mysql_error());
            $serial_no=0;
     while($row=mysql_fetch_array($run)){
		$s_no=$row['id'];
		$m_name=$row['m_name'];
		$select_user = "select * from user_detail where user_id='$m_name' and company_code='$company_code' and status='Active'";
		$run_user = mysql_query($select_user);
		$fetch_user = mysql_fetch_array($run_user);
		$m_name = $fetch_user['user_name'];
		$insert_date=$row['insert_date'];
		$insert_date = explode("-",$insert_date);
		$insert_date = array($insert_date[2],$insert_date[1],$insert_date[0]);
		$insert_date = implode("-",$insert_date);
		$category=$row['category'];
		$category_name="select * from expense_category where id='$category' and company_code='$company_code'";
		$run_cat = mysql_query($category_name);
		$fetch_cat = mysql_fetch_array($run_cat);
		$category = $fetch_cat['category_name'];
		$amount = $row['amount'];
		$pay_through = $row['paid_through'];
		$expense_status = $row['expense_status'];
	    $serial_no++;
		$bank_account_name='';
		$bank_account_type='';
		   $query4="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$pay_through' and company_code='$company_code'";
			$res4=mysql_query($query4);
			if($row4=mysql_fetch_array($res4)){
			$bank_account_type=$row4['bank_account_type'];
			$bank_account_name=$row4['bank_account_name'];
			$credit_card_account_name=$row4['credit_card_account_name'];
			$payment_method=$bank_account_type.'['.$bank_account_name.']';
			if($bank_account_type=='Credit_Card'){
			$payment_method=$bank_account_type.'['.$credit_card_account_name.']';
			}
			if($bank_account_name=='Undeposited Funds'){
			$payment_method='Cheque/DD';
			}
			} ?>
			<tr align='center'>
	<th><?php echo $insert_date; ?></th>
	<th><?php echo $m_name; ?></th>
	<th><?php echo $category; ?></th>
	<th>&#8377;&nbsp;<?php echo $amount; ?></th>
	<th><span style="color:#6B823E;"><?php if($bank_account_name){ echo $bank_account_name."(".$bank_account_type.")"; } if(empty($bank_account_name)){ echo "<strong style='color:#BE4B31;'>NO PAYMENT</strong>"; } ?></span></th>
	<th>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-send-o" href='#'><?php  if($expense_status=='1'){ echo" Unsubmitted"; } if($expense_status=='2'){ echo" Submitted"; } ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <?php if($row['report_id']){ echo " <a aria-hidden='true' class='fa fa-print' href='' onclick='view_report(".$s_no.")'><span style='color:#2eb82e'> Print Report</span></a>"; } else
		   { echo " <a aria-hidden='true' class='fa fa-plus' href='#' onclick='fun3(".$s_no.")' data-toggle='modal' data-target='#myModal1'><span style='color:#B83E23' > Add Report</span></a>"; } ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
</tr>
			<?php } ?>
</tbody>
</table>
<?php } ?>
<?php   if($expense_type == "Approved"){ ?>
				<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Expense Date</th>
                  <th>Marchant Name</th>
                  <th>Expense Category</th>
				  <th>Expense Amount</th>
                  <th>Payment Status</th>
                  <th>Expense Status</th>
                </tr>
                </thead>
				<tbody>
				<?php
			$que ="select * from add_expense where expense_status='2' and company_code='$company_code'";
			$run=mysql_query($que) or die(mysql_error());
            $serial_no=0;
     while($row=mysql_fetch_array($run)){
		$s_no=$row['id'];
		$m_name=$row['m_name'];
		$select_user = "select * from user_detail where user_id='$m_name' and company_code='$company_code'";
		$run_user = mysql_query($select_user);
		$fetch_user = mysql_fetch_array($run_user);
		$m_name = $fetch_user['user_name'];
		$insert_date=$row['insert_date'];
		$insert_date = explode("-",$insert_date);
		$insert_date = array($insert_date[2],$insert_date[1],$insert_date[0]);
		$insert_date = implode("-",$insert_date);
		$category=$row['category'];
		$category_name="select * from expense_category where id='$category' and company_code='$company_code'";
		$run_cat = mysql_query($category_name);
		$fetch_cat = mysql_fetch_array($run_cat);
		$category = $fetch_cat['category_name'];
		$amount = $row['amount'];
		$pay_through = $row['paid_through'];
		$expense_status = $row['expense_status'];
	    $serial_no++;
		$bank_account_name='';
		$bank_account_type='';
		   $query4="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$pay_through' and company_code='$company_code'";
			$res4=mysql_query($query4);
			if($row4=mysql_fetch_array($res4)){
			$bank_account_type=$row4['bank_account_type'];
			$bank_account_name=$row4['bank_account_name'];
			$credit_card_account_name=$row4['credit_card_account_name'];
			$payment_method=$bank_account_type.'['.$bank_account_name.']';
			if($bank_account_type=='Credit_Card'){
			$payment_method=$bank_account_type.'['.$credit_card_account_name.']'; }
			if($bank_account_name=='Undeposited Funds'){
			$payment_method='Cheque/DD';
			} } ?>
			<tr  align='center'>
	<th><?php echo $insert_date; ?></th>
	<th><?php echo $m_name; ?></th>
	<th><?php echo $category; ?></th>
	<th>&#8377;&nbsp;<?php echo $amount; ?></th>
	<th><span style="color:#6B823E;"><?php if($bank_account_name){ echo $bank_account_name."(".$bank_account_type.")"; } if(empty($bank_account_name)){ echo "<strong style='color:#BE4B31;'>NO PAYMENT</strong>"; } ?></span></th>
	<th>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-send-o" href='#'><?php  if($expense_status=='1'){ echo" Unsubmitted"; } if($expense_status=='2'){ echo" Submitted"; } ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <?php if($row['report_id']){ echo " <a aria-hidden='true' class='fa fa-print' href='' onclick='view_report(".$s_no.")'><span style='color:#2eb82e'> Print Report</span></a>"; } else
		   { echo " <a aria-hidden='true' class='fa fa-plus' href='#' onclick='fun3(".$s_no.")' data-toggle='modal' data-target='#myModal1'><span style='color:#B83E23' > Add Report</span></a>"; } ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
</tr>
			<?php } ?>
</tbody>
</table>
<?php } ?>
<?php
			if($expense_type == "Unreported"){
				
					?>
				<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Expense Date</th>
                  <th>Marchant Name</th>
                  <th>Expense Category</th>
				  <th>Expense Amount</th>
                  <th>Payment Status</th>
                  <th>Expense Status</th>
                </tr>
                </thead>
				<tbody>
				<?php
			$que ="select * from add_expense where report_id='' and company_code='$company_code'";
			$run=mysql_query($que) or die(mysql_error());
            $serial_no=0;
     while($row=mysql_fetch_array($run)){
		$s_no=$row['id'];
		$m_name=$row['m_name'];
		$select_user = "select * from user_detail where user_id='$m_name' and company_code='$company_code' and status='Active'";
		$run_user = mysql_query($select_user);
		$fetch_user = mysql_fetch_array($run_user);
		$m_name = $fetch_user['user_name'];
		$insert_date=$row['insert_date'];
		$insert_date = explode("-",$insert_date);
		$insert_date = array($insert_date[2],$insert_date[1],$insert_date[0]);
		$insert_date = implode("-",$insert_date);
		$category=$row['category'];
		$category_name="select * from expense_category where id='$category' and company_code='$company_code'";
		$run_cat = mysql_query($category_name);
		$fetch_cat = mysql_fetch_array($run_cat);
		$category = $fetch_cat['category_name'];
		$amount = $row['amount'];
		$pay_through = $row['paid_through'];
		$expense_status = $row['expense_status'];
	    $serial_no++;
		$bank_account_name='';
		$bank_account_type='';
		   $query4="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$pay_through' and company_code='$company_code'";
			$res4=mysql_query($query4);
			if($row4=mysql_fetch_array($res4)){
			$bank_account_type=$row4['bank_account_type'];
			$bank_account_name=$row4['bank_account_name'];
			$credit_card_account_name=$row4['credit_card_account_name'];
			$payment_method=$bank_account_type.'['.$bank_account_name.']';
			if($bank_account_type=='Credit_Card'){
			$payment_method=$bank_account_type.'['.$credit_card_account_name.']';
			}
			if($bank_account_name=='Undeposited Funds'){
			$payment_method='Cheque/DD';
			}
			}
			
			?>
			<tr  align='center'>
	<th><?php echo $insert_date; ?></th>
	<th><?php echo $m_name; ?></th>
	<th><?php echo $category; ?></th>
	<th>&#8377;&nbsp;<?php echo $amount; ?></th>
	<th><span style="color:#6B823E;"><?php if($bank_account_name){ echo $bank_account_name."(".$bank_account_type.")"; } if(empty($bank_account_name)){ echo "<strong style='color:#BE4B31;'>NO PAYMENT</strong>"; } ?></span></th>
	<th>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-send-o" href='#'><?php  if($expense_status=='1'){ echo" Unsubmitted"; } if($expense_status=='2'){ echo" Submitted"; } ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <?php if($row['report_id']){ echo " <a aria-hidden='true' class='fa fa-print' href='' onclick='view_report(".$s_no.")'><span style='color:#2eb82e'> Print Report</span></a>"; } else
		   { echo " <a aria-hidden='true' class='fa fa-plus' href='#' onclick='fun3(".$s_no.")' data-toggle='modal' data-target='#myModal1'><span style='color:#B83E23' > Add Report</span></a>"; } ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
</tr>
	 <?php } ?>
</tbody>
</table>
<?php } ?>
<?php	
			if($expense_type == "Inactive"){
				
				?>
				<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Expense Date</th>
                  <th>Marchant Name</th>
                  <th>Expense Category</th>
				  <th>Expense Amount</th>
                  <th>Payment Status</th>
                  <th>Expense Status</th>
                </tr>
                </thead>
				<tbody>
				<?php
			$que ="select * from add_expense where expense_status='0' and company_code='$company_code'";
			$run=mysql_query($que) or die(mysql_error());
            $serial_no=0;
     while($row=mysql_fetch_array($run)){
		$s_no=$row['id'];
		$m_name=$row['m_name'];
		$select_user = "select * from user_detail where user_id='$m_name' and company_code='$company_code' and status='Active'";
		$run_user = mysql_query($select_user);
		$fetch_user = mysql_fetch_array($run_user);
		$m_name = $fetch_user['user_name'];
		$insert_date=$row['insert_date'];
		$insert_date = explode("-",$insert_date);
		$insert_date = array($insert_date[2],$insert_date[1],$insert_date[0]);
		$insert_date = implode("-",$insert_date);
		$category=$row['category'];
		$category_name="select * from expense_category where id='$category' and company_code='$company_code'";
		$run_cat = mysql_query($category_name);
		$fetch_cat = mysql_fetch_array($run_cat);
		$category = $fetch_cat['category_name'];
		$amount = $row['amount'];
		$pay_through = $row['paid_through'];
		$expense_status = $row['expense_status'];
	    $serial_no++;
		$bank_account_name='';
		$bank_account_type='';
		   $query4="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$pay_through' and company_code='$company_code'";
			$res4=mysql_query($query4);
			if($row4=mysql_fetch_array($res4)){
			$bank_account_type=$row4['bank_account_type'];
			$bank_account_name=$row4['bank_account_name'];
			$credit_card_account_name=$row4['credit_card_account_name'];
			$payment_method=$bank_account_type.'['.$bank_account_name.']';
			if($bank_account_type=='Credit_Card'){
			$payment_method=$bank_account_type.'['.$credit_card_account_name.']';
			}
			if($bank_account_name=='Undeposited Funds'){
			$payment_method='Cheque/DD';
			}
			} ?>
			<tr  align='center'>
	<th><?php echo $insert_date; ?></th>
	<th><?php echo $m_name; ?></th>
	<th><?php echo $category; ?></th>
	<th>&#8377;&nbsp;<?php echo $amount; ?></th>
	<th><span style="color:#6B823E;"><?php if($bank_account_name){ echo $bank_account_name."(".$bank_account_type.")"; } if(empty($bank_account_name)){ echo "<strong style='color:#BE4B31;'>NO PAYMENT</strong>"; } ?></span></th>
	<th>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-send-o" href='#'><?php  if($expense_status=='1'){ echo" Unsubmitted"; } if($expense_status=='2'){ echo" Submitted"; } ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <?php if($row['report_id']){ echo " <a aria-hidden='true' class='fa fa-print' href='' onclick='view_report(".$s_no.")'><span style='color:#2eb82e'> Print Report</span></a>"; } else
		   { echo " <a aria-hidden='true' class='fa fa-plus' href='#' onclick='fun3(".$s_no.")' data-toggle='modal' data-target='#myModal1'><span style='color:#B83E23' > Add Report</span></a>"; } ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
</tr>
<?php 
	 }
?>
</tbody>
</table>
<?php } ?>
				<?php
				if($expense_type == 'default')
				{ ?>
				<table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>Expense Date</th>
                  <th>Marchant Name</th>
                  <th>Expense Category</th>
				  <th>Expense Amount</th>
                  <th>Payment Status</th>
                  <th>Expense Status</th>
                </tr>
                </thead>
				<tbody>
				<?php
			$que ="select * from add_expense where (expense_status='0' or expense_status='1' or expense_status='2') and company_code='$company_code'";
			$run=mysql_query($que) or die(mysql_error());
            $serial_no=0;
     while($row=mysql_fetch_array($run)){
	    $s_no=$row['id'];
		$m_name=$row['m_name'];
		$select_user = "select * from user_detail where user_id='$m_name' and company_code='$company_code' and status='Active'";
		$run_user = mysql_query($select_user);
		$fetch_user = mysql_fetch_array($run_user);
		$m_name = $fetch_user['user_name'];
		$insert_date=$row['insert_date'];
		$insert_date = explode("-",$insert_date);
		$insert_date = array($insert_date[2],$insert_date[1],$insert_date[0]);
		$insert_date = implode("-",$insert_date);
		$category=$row['category'];
		$category_name="select * from expense_category where id='$category' and company_code='$company_code'";
		$run_cat = mysql_query($category_name);
		$fetch_cat = mysql_fetch_array($run_cat);
		$category = $fetch_cat['category_name'];
		$amount = $row['amount'];
		$pay_through = $row['paid_through'];
		$expense_status = $row['expense_status'];
	    $serial_no++;
		$bank_account_name='';
		$bank_account_type='';
		   $query4="select * from bank_or_credit_card_info where bank_status='Active' and s_no='$pay_through' and company_code='$company_code'";
			$res4=mysql_query($query4);
			if($row4=mysql_fetch_array($res4)){
			$bank_account_type=$row4['bank_account_type'];
			$bank_account_name=$row4['bank_account_name'];
			$credit_card_account_name=$row4['credit_card_account_name'];
			$payment_method=$bank_account_type.'['.$bank_account_name.']';
			if($bank_account_type=='Credit_Card'){
			$payment_method=$bank_account_type.'['.$credit_card_account_name.']';
			}
			if($bank_account_name=='Undeposited Funds'){
			$payment_method='Cheque/DD';
			}
			} ?>
			<tr  align='center'>
	<th><?php echo $insert_date; ?></th>
	<th><?php echo $m_name; ?></th>
	<th><?php echo $category; ?></th>
	<th>&#8377;&nbsp;<?php echo $amount; ?></th>
	<th><span style="color:#6B823E;"><?php if($bank_account_name){ echo $bank_account_name."(".$bank_account_type.")"; } if(empty($bank_account_name)){ echo "<strong style='color:#BE4B31;'>NO PAYMENT</strong>"; } ?></span></th>
	<th>
	<a style="color:#606125;" aria-hidden="true" class="fa fa-send-o" href='#'><?php  if($expense_status=='1'){ echo" Unsubmitted"; } if($expense_status=='2'){ echo" Submitted"; } ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <?php if($row['report_id']){ echo " <a aria-hidden='true' class='fa fa-print' href='' onclick='view_report(".$s_no.")'><span style='color:#2eb82e'> Print Report</span></a>"; } else
		   { echo " <a aria-hidden='true' class='fa fa-plus' href='#' onclick='fun3(".$s_no.")' data-toggle='modal' data-target='#myModal1'><span style='color:#B83E23' > Add Report</span></a>"; } ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
</tr>
	 <?php } ?>
</tbody>
</table>
<?php } ?>
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
		<?php
		
	     }

?>
 