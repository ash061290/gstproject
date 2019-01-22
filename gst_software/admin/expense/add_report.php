<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Add Report
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="view_expense.php"><i class="fa fa-list"></i>Report</a></li>
        <li class="active">Add Report</li>
      </ol>
    </section>	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
<script>
function for_banking(value){
if(value=='bank'){
$('#for_bank').show();
$('#for_credit_card').hide();

$('#account_name1').val('');
$('#account_code1').val('');
$('#account_number1').val('');
$('#bank_name1').val('');
$('#description_bank1').val('');
$('#credit_card_card_number1').val('');
$('#credit_card_routing_no1').val('');
}else{
$('#for_bank').hide();
$('#for_credit_card').show();

$('#bank_account_name').val('');
$('#bank_account_code').val('');
$('#bank_account_number').val('');
$('#bank_name').val('');
$('#bank_routing_no').val('');
$('#bank_description_bank').val('');
$('#account_type').val('');
$('#bank_itcr_no').val('');
}
}
</script>
		
<!--start --> <!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
<!-- end -->
<!-- end -->
    <div class="box-body">
		<form method='post'>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-6 form-horizontal">
				<div class="" id="for_bank">
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Report Title</label>
                    <div class="col-sm-8">
                        <input type="text" name="report_title" id="report_title" class="form-control" placeholder="Report Title" required  />
                    </div>										
                    </div>
                    </div>
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Bussiness Purpose</label>
                    <div class="col-sm-8">
                       <textarea name="business_purpose" id="business_purpose" rows="5" class="form-control" required></textarea>
                    </div>
                    </div>
                    </div>			
					<div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;"> Report Duration</label>
                    <div class="col-sm-4">
                       <input type="date" name="start_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required />
                    </div>
					 <div class="col-sm-4">
                       <input type="date" name="end_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required />
                    </div>
                    </div>
                    </div>
				</div>
				</div>
			<div class="col-sm-12">	
			<br/><center><input type="submit" name="submit" value="submit" class="btn btn-primary my_background_color"></center><br/>
		    </div>		
		</form>	
		<?php
        if(isset($_POST['submit']))
          {
            $report_title = $_POST['report_title'];
            $business_purpose = $_POST['business_purpose'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
      $qry = "INSERT INTO `add_report`(`title`, `business_purpose`, `start_date`, `end_date`,`company_name`,`company_name`,`company_code`) VALUES ('$report_title','$business_purpose','$start_date','$end_date','$company_name','$company_code')";
          $run = mysql_query($qry);
		  if(mysql_query($run))
		  {
	echo "<script>alert('Successfully Complete');</script>";
	echo "<script>window.open('expense_index.php','_self')</script>";
	
	}
        }
   ?>
	</div>
		  <!-- /.box-body -->
    </div>
    </div>
</section>  
  </div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>				
