<?php 
   include("../../attachment/session.php"); 
   if(isset($_GET['expense_name']))
   { ?>
	   <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                 <tr>
                  <th>Date</th>
				  <th>Merchant</th>
				  <th>Pay Type</th>
                  <th>Category</th>
				  <th>Report</th>
				  <th>Status</th>
				  <th>Amount</th>
				   <th><center>Action</center></th>
                </tr>
                </thead>
            <tbody>
			<?php
		$report_name ="";
	    $expense_type = $_GET['expense_name'];
		if($_GET['expense_name'] == 'Unreported Expenses'){ $que1="SELECT * FROM `add_expense` WHERE `report_id`='' and company_code='$company_code'"; }
		if($_GET['expense_name'] == 'Unsubmitted Expenses'){ $que1="SELECT * FROM `add_expense` WHERE `expense_status`='1' AND `report_id`!='' and company_code='$company_code'"; }
		if($_GET['expense_name'] == 'Reimbursed Expenses'){ $que1="SELECT * FROM `add_expense` WHERE `expense_status`='2' and company_code='$company_code'"; }
	if($_GET['expense_name'] == 'all'){ $que1 = "select * from add_expense where expense_status='1' OR expense_status='2' and company_code='$company_code'"; }
					$run1=mysql_query($que1);
					while($row1=mysql_fetch_array($run1)){
					$insert_date = $row1['insert_date'];
					$insert_date = explode("-",$insert_date);
                    $insert_date = array($insert_date[2],$insert_date[1],$insert_date[0]);
                    $insert_date = implode("-",$insert_date);
					$m_name = $row1['m_name'];
					$category = $row1['category'];
					$select_cat = "select * from expense_category where id='$category' and company_code='$company_code'";
					$run_cat = mysql_query($select_cat);
					$fetchcat = mysql_fetch_array($run_cat);
					$category = $fetchcat['category_name'];
					$amount = $row1['amount'];
					$rem = $row1['rem'];
				    $tax_type = $row1['tax_type'];
					$ref_name  = $row1['ref_name'];
					$paid_through = $row1['paid_through'];
					$descr = $row1['description'];
					$report_id = $row1['report_id'];
					$select_report = "select * from add_report where report_id='$report_id' and company_code='$company_code'";
					$run = mysql_query($select_report);
					$fetchr = mysql_fetch_array($run);
					$report_name = $fetchr['title'];
					$expense_status = $row1['expense_status'];
					?>
				<tr align='center'>
				 <th><?php echo $insert_date; ?></th>
				 <th><?php echo $m_name; ?></th>	
					<th><?php if($rem == '1') { echo  $rem = "Reimbursable"; } else{ echo $rem = "No-Reimbursable"; } ?></th>
				<th><b><?php echo $category; ?></b></th>
				 <th><?php  echo $report_name;  ?></th>	
				<?php if($expense_status == '1' && $report_id=='') { ?>
				<th style="color:#AC5B18;"><a href="view_expenses.php?expenses_id=<?php echo $row['id']; ?>" style="color:#AC5B18;">
				<?php echo "UNREPORTED"; ?></a></th>
				<?php } else  if($expense_status == '1' && $report_id !='') { ?>
				<th><a href="view_expenses.php?expenses_id=<?php echo $row['id']; ?>" style="color:#18562F;">
				<?php echo "UNSUBMITTED"; ?></a></th>
				<?php } else  if($expense_status == '2') { ?>
				<th><a href="view_expenses.php?expenses_id=<?php echo $row['id']; ?>" style="color:#44965A;">
				<?php echo "VERIFY"; ?></a></th>
				<?php } ?>
				<th><span><b>&nbsp;&#8377;&nbsp;</b></span><strong><?php echo $amount; ?></strong></th>		
				<th>
                <a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='expenses_edit.php?expenses_id=<?php echo $row1['id']; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            <a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='expenses_delete.php?expenses_id=<?php echo $row1['id']; ?>'> Delete</a></center>				
				</th>
				</tr>	
				<?php } ?>
				
			</tbody>
             </table>
		<?php
   } ?>
		