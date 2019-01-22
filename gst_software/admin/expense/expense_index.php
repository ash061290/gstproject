<?php include("../../attachment/session.php"); ?>
    <?php
	$que1="SELECT * FROM `add_expense` where company_code='$company_code'";
	$qry2 = "SELECT * FROM `add_expense` WHERE `report_status`='1' and where `company_code`='$company_code'";
	$qry3 = "SELECT * FROM `add_expense` WHERE `report_status`='2' and where `company_code`='$company_code'";
	$qry4 = "SELECT * FROM `add_expense` WHERE `report_status`='0' and where `company_code`='$company_code'";
	$report_qry = "SELECT * FROM `add_report` where `company_code`='$company_code'";
	$common_report = "SELECT * FROM `add_report` JOIN `add_expense` ON `add_report`.`title`=`add_expense`.`report_name` where `add_report`.`company_code`='$company_code' and `add_expense`.`company_code`='$company_code'";
	$run_common_report = mysql_query($common_report);
	$report_qry_run = mysql_query($report_qry);
	$run4 = mysql_query($qry4);
	$run3 = mysql_query($qry3);
	$run2 = mysql_query($qry2);
	$run1=mysql_query($que1);
	$row_num1=mysql_num_rows($run1);
  if($row_num1>0){
    $fetchrow = mysql_fetch_array($run1);
	$insert_date = $fetchrow['insert_date'];
	$m_name = $fetchrow['m_name'];
	$category = $fetchrow['category'];
	$amount = $fetchrow['amount'];
    $rem = $fetchrow['rem'];
				    $tax_type = $fetchrow['tax_type'];
					$report_name = $fetchrow['report_name'];
					$ref_name  = $fetchrow['ref_name'];
					$paid_through = $fetchrow['paid_through'];
					$descr = $fetchrow['description'];
					$report_status = $fetchrow['report_status'];
					}
					 $numrow3 = mysql_num_rows($run3);
					 $numrow2 = mysql_num_rows($run2);
					 $numrow4 = mysql_num_rows($run4);
					  
					if($numrow2>0)
					{
					while($rowfetch2 = mysql_fetch_array($run2))
					{
					$total_unsubmitted = 0;
				    $total_unsubmitted += $rowfetch2['amount'];
					}
					}
					else
					{
					 $total_unsubmitted = '0';
					}
					if($numrow3>0)
					{
					  while($rowfetch3 = mysql_fetch_array($run3))
					{
					$total_submitted = 0;
				    $total_submitted += $rowfetch3['amount'];
					}
					}
					else
					{
					 $total_submitted = '0';
					}
					if($numrow4>0)
					{
					  while($rowfetch4 = mysql_fetch_array($run4))
					{
					$total_unreported = 0;
				    $total_unreported += $rowfetch4['amount'];
					}
					}
					else
					{
					   $total_unreported = 0;
					}
					?>

  <!-- Content Wrapper. Contains page content  style="position: unset !important;"-->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	   <div class="col-lg-12">
	 <!-- <h4>&nbsp;&nbsp;&nbsp;&nbsp;Sales Activity</h4>-->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
		 
          <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:red;">
		   <!--<img src="C:\xampp\htdocs\samsungplaza\software\images\expence_logo.png" width="100" height="100"/>--></span></p></center>
		   <a href="add_expenses.php"><center><p><span style="color:red;">New Expenses</span></p></center></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
           <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:green;"><?php echo ""; ?></span></p></center>
		   <a href="add_report.php"><center><p><span style="color:green;">New Report</span></p></center></a>
			
          </div>
        </div>
        <!-- ./col 
        <div class="col-lg-4 col-xs-6">
          <!-- small box 
           <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:green;">0</span></p></center>
		   <center><p style="font-size:20px;"><span style="color:green; font-size:22px;">Add User</span></p></center>
			
          </div>
        </div>-->
      
      </div>
      <!-- /.row -->
	  <br>
          
		  <br/>
		  <hr/>
		  
		   <section class="content">     
	  <!-------------------------------PURCHASE details---------------->
	   <div class="row">
      
        <!-- /.col (left) -->
        <div class="col-md-8">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Reports Summary</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
            <thead>
            <tr>
			<th></th>
              <th>UNSUBMITTED</th>
			  <th></th>
              <th>SUBMITTED</th>
			  <th></th>
              <th>AWAITING REIMBURSEMENT</th>
			  <th></th>
             
            </tr>
			  <tr>
			<th></th>
              <th>&#8377;<?php echo $total_unsubmitted; ?></th>
			  <th></th>
              <th>&#8377;<?php echo $total_submitted; ?></th>
			  <th></th>
              <th>&#8377;<?php echo $total_unreported; ?></th>
			  <th></th>
             
            </tr>
			  <tr>
			<th></th>
              <th><a href="javascript:get_content('expense/unsubmitted')"><?php echo $numrow2; ?> Report</a></th>
			  <th></th>
              <th><a href="javascript:get_content('expense/reimbursed')"><?php echo $numrow3; ?> Report</a></th>
			  <th></th>
              <th><a href="javascript:get_content('expense/unreported')"><?php echo $numrow4; ?> Report</a></th>
			  <th></th>
             
            </tr>
            </thead>
            <tbody>      
            </tbody>
          </table>
        </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		
        <!-- /.col (right) -->
		  <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <!--<h3 class="box-title">PURCHASE ORDER</h3>-->
			   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
         <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
            <thead>
            <tr>
			<th></th>
              <th><h4><?php echo $numrow4; ?><h4></th>
			  <th></th>
              <td>UNREPORTED EXPENSES</td>
			  <th></th>
			  
            </tr>
		 <tr>
			<th></th>
              
			  <th></th>
             
			  <th></th>
			  </tr>
            </thead>
            <tbody>      
            </tbody>
          </table>
        </div>
           </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
	   <!-------------------------------PURCHASE details---------------->
    </section>
	   <!-- Main content -->
      <!-- Main content -->
	  <!-------------------------------product details---------------->
	   <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <center><div class="box-header with-border" style="background:#38894E; color:#E1F3ED;">
             <h3 class="box-title" >RECENT REPORTS</h3></div></center>
            
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row invoice-info">
				 <div class="col-sm-2"></div>
        <div class="col-sm-8 table-responsive invoice-col">
		<table class="table table-striped">
			<tr>
			<th></th>
              <th>Report Name</th>
			  <th></th>
			   <th></th>
			  <th>Amount</th>
			  <th></th>
			   <th></th>
			   <th>Start Date</th>
			    <th></th>
			   <th></th>
			   <th>End Date</th>
				<th></th>
				 <th></th>
				 <th>Action</th>
			  </tr>
			  
			  <?php 
			  while($report_row = mysql_fetch_array($run_common_report))
{			  ?>
			  <tr>
			<th></th>
              <th><?php echo $title = $report_row['title']; ?></th>
			  <th></th>
			   <th></th>
			  <th>&#8377;&nbsp;<?php echo $report_row['amount']; ?></th>
			  <th></th>
			   <th></th>
			   <th><?php echo $report_row['start_date']; ?></th>
			  <th></th>
			   <th></th>
			   <th><?php echo $report_row['end_date']; ?></th>
			   <?php 
			       $id = $report_row['id'];
                    ?>
			   <th></th>
				<th></th>
			<th><a href="view_report.php?exp_id=<?php echo $rowid = $id;  
?>"><button name="view_report" class="btn btn-success">View Report</button></a></th>
			  </tr>
			  <?php } ?>
		   </table>
		   
        </div>
        <!-- /.col -->
        <div class="col-sm-2"></div>
        <!-- /.col -->
         
        <!-- /.col -->
      </div>
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
    </section>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>				
