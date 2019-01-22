<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Report Details
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="view_report.php"><i class="fa fa-list"></i>Report Details</a></li>
        <li class="active">Expenses Details</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
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
<?php 
$exp_id =0;
$exp_id = $_GET['exp_id'];
$qry = "SELECT * FROM `add_report` JOIN `add_expense` ON `add_report`.`title`=`add_expense`.`report_name` WHERE `add_expense`.`id`='$exp_id' and company_code='$company_code'";
$runq = mysql_query($qry);
?>
<div class="box-body">
<form role="form" method="post" enctype="multipart/form-data">				
<div class="col-md-12 box-body table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
  <th>Report Title </th>
   <th>Business Purpose</th>
  <th>Starting Date</th>
  <th>End Date</th>
  <th>Report Status</th>
  <th>Amount</th>
   <th><center>Action</center></th>
 
</tr>
</thead>

<tbody>
<?php
while($row=mysql_fetch_array($runq)){
$title = $row['title'];
$b_purpose = $row['business_purpose'];
$start = $row['start_date'];
$end = $row['end_date'];
//$date = $row['insert_date'];
$merchant = $row['m_name'];
$category = $row['category'];
$amount = $row['amount'];
$report = $row['report_name'];
$rem = $row['rem'];
$report_status = $row['report_status'];
?>

<tr>
  <th><?php echo $title; ?></th>
  <th><?php echo $b_purpose; ?></th>
  <th><?php echo $start; ?></th>
   <th><?php echo $end; ?></th>
  <?php if($report_status == '0') { ?>
  <th style="color:#AC5B18;"><a href='expenses_report.php?expenses_id=<?php echo $row['id']; ?>' style="color:#AC5B18;"><?php echo "UNREPORTED"; ?></a></th>
  <?php } else  if($report_status == '1'){ ?>
  <th><a href='expenses_report.php?expenses_id=<?php echo $row['id']; ?>' style="color:#18562F;">
	<?php echo "UNSUBMITTED"; ?></a></th>
  <?php } else  if($report_status == '2'){ ?>
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
</div>
</form>
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
<!-- /.box-body -->
</div>
</section>


</div>



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
