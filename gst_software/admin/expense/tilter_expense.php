<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Expenses Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('expense/view_expenses')"><i class="fa fa-list"></i>Expenses Details</a></li>
        <li class="active">Expenses Details</li>
      </ol>
    </section>

	
    <!-- Main content -->
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
</script>
<script>
function payment_detail(value){
if(value=='Cheque'){
$('#cheque_or_dd').show();
$('#cheque_dd_no').show();
$('#cheque_dd_issue_date').show();
$('#cheque_dd_clearing_date').show();
}else if(value=='DD'){
$('#cheque_or_dd').show();
$('#cheque_dd_no').show();
$('#cheque_dd_issue_date').show();
$('#cheque_dd_clearing_date').show();
} else {
$('#cheque_or_dd').hide();
$('#cheque_dd_no').hide();
$('#cheque_dd_issue_date').hide();
$('#cheque_dd_clearing_date').hide();
}

}
</script>
<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete this Record !!!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}
</script>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form---------------------------------------------------->
        <?php if(empty($_GET['expense_id']))
		{ 			?>
		<div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data">				
			<div class="col-sm-12">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">			
                <div class="input-group-btn">
     <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Filter Expenses
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu" style="background-color:#F8F9F9;">
                   <a href="unreported.php">
				   <center> 
				   <li style="color:brown; font-size:15px; padding:5px">Unreported Expenses
				    </li>
					 </center>
					  </a>
					<li></li>
					<a href="unsubmitted.php">
					<center>
					<li style="color:brown; font-size:15px; padding:5px">Unsubmitted Expenses
					</li>
					</center>
					</a>
					<li></li>
					<a href="reimbursed.php">
					<center>
					<li style="color:brown; font-size:15px; padding:5px">Reimbursed Expenses
					</li>
					</center>
					</a>
				
                  </ul>
                </div>         
            </div>	
			
			</div>
				<div class="col-md-12 box-body table-responsive">
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
				$que="select * from add_expense where company_code='$company_code'";
				$run=mysql_query($que);
				while($row=mysql_fetch_array($run)){
				$date = $row['insert_date'];
				$merchant = $row['m_name'];
				$rem = $row['rem'];
				$id = $row['id'];
				$category = $row['category'];
				$amount = $row['amount'];
			    $report = $row['report_name'];
				$ref = $row['ref_name'];
				$report_status = $row['report_status']; ?>
				<tr>
				  <th><?php echo $date; ?></th>
                  <th><?php echo $merchant; ?></th>
				   <th><?php echo $rem; ?></th>
				  <th><?php echo $category; ?></th>
				   <th><?php 
                        echo $report;
				     ?></th>
				  <?php if($report_status == '0') 
				      { ?>
				  <th style="color:#AC5B18;"><a href='expenses_report.php?expenses_id=<?php echo $row['id']; ?>' style="color:#AC5B18;"><?php echo "UNREPORTED"; ?></a></th>
				  <?php } else  if($report_status == '1'){ ?>
				  <th><a href='expenses_report.php?expenses_id=<?php echo $row['id']; ?>' style="color:#18562F;">
				  	<?php echo "UNSUBMITTED"; ?></a></th>
				  <?php } else  if($report_status == '2')
				     { ?>
				  <th><a href='expenses_report.php?expenses_id=<?php echo $row['id']; ?>' style="color:#44965A;">
				  	<?php echo "VERIFY"; ?></a></th>
				<?php } ?>
				  <th><?php echo "&#8377;&nbsp;".$amount; ?></th>
				  <th>
	<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='expenses_edit.php?expenses_id=<?php echo $row['id']; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<!--<a style="color:#94450A;" aria-hidden="true" class="fa fa-print" href='#'> Print </a>--> &nbsp;&nbsp;&nbsp;&nbsp;
	
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='expenses_delete.php?expenses_id=<?php echo $row['id']; ?>'> Delete</a></center>
	
</th>
				 
				  <?php } ?>
				</tr>					
				</tbody>
				
                </table>
                </div>	
				 </form>
		</div>
		<?php } ?>
	   
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
    </div>
</section>

</body>
</html>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
   
  })
</script>
