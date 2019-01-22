<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
       Expenses Unrepoprted
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('expense/view_expenses')"><i class="fa fa-plus"></i>Expenses</a></li>
        <li class="active">Un Reported</li>
      </ol>
    </section>
<script type="text/javascript">
   function for_contact(id,value){
   //alert(value);
            if(id=='contact_type'){
			var contact_type1=value;
            var business_type1=document.getElementById('business_type').value; 
            }else if(id=='business_type') {
            var business_type1=value;
            var contact_type1=document.getElementById('contact_type').value;	
            }			
 
       $.ajax({
			  type: "POST",
              url: software_link+"expense/ajax_contact_search.php?contact_type="+contact_type1+"&business_type="+business_type1+"",
              cache: false,
              success: function(detail){
			      //alert(detail);  
            $('#search_table').html(detail);
              }
           });
	}
</script>
<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}
</script>
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <div class="col-sm-12">	
<div class="col-sm-10"></div>				
			 <div class="col-sm-2">			
                <div class="input-group-btn">
                  <button type="button" class="btn btn-success dropdown-toggle" style="margin-left:70px" data-toggle="dropdown">FILTER EXPENSES
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu" style="background-color:#F8F9F9;">
                   <a href="unreported.php">
				   <center> <li style="color:#DC7633; font-size:15px; padding:5px"><b>UNREPORTED REPORT</b></li></center>
					</a>
					<li></li>
					<a href="unsubmitted.php">
					<center><li style="color:#DC7633; font-size:15px; padding:5px"><b>UNSUBMITTED REPORT</b></li></center>
					</a>
					<li></li>
					<a href="reimbursed.php">
					<center><li style="color:#DC7633; font-size:15px; padding:5px"><b>REIMBURSED REPORT</b></li></center>
					</a>
				
                  </ul>
                </div>         
            </div>
			</div>			
			</div>			
            <!-- /.box-header -->
            <div class="box-body table-responsive"> 
			
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				 <th>Date</th>
				  <th>Merchant</th>
				  <th>Pay Type</th>
                  <th>Category</th>
				  <th>Report</th>
				  <th>Status</th>
				   <th>Pay Throught</th>
                  <th>Amount</th>
				  <th>Action</th>
                </tr>
                </thead>
            <tbody>
			   <?php
			   $report_name ="";
	$que1="SELECT * FROM `add_expense` WHERE `rem`='Reimbursable'";
	$run1=mysql_query($que1);
  while($row1=mysql_fetch_array($run1)){
	$insert_date = $row1['insert_date'];
	$m_name = $row1['m_name'];
	$category = $row1['category'];
	$category_select = "select category from category_add where category_id='$category'";
$runcat = mysql_query($category_select);
$fetch_cat = mysql_fetch_array($runcat);
$category = $fetch_cat['category'];
$amount = $row1['amount'];
$rem = $row1['rem'];
$tax_type = $row1['tax_type'];
$ref_name  = $row1['ref_name'];
$paid_through = $row1['paid_through'];
$descr = $row1['description'];
$report_id = $row1['report_id'];
$select_report = "select title from add_report where report_id='$report_id'";
$runreport = mysql_query($select_report);
$fetchreport = mysql_fetch_array($runreport);
$report_title = $fetchreport['title'];
$expense_status = $row1['expense_status'];
					?>
<tr align='center'>
<th><b><?php echo $insert_date; ?></b></th>
<th><strong><?php echo $m_name; ?></strong></th>
<th><?php echo $rem; ?></th>
<th><?php echo $category; ?></th>	
<th><?php echo $report_title; ?></th>	
<th><a href='expenses_report.php?expenses_id=<?php echo $row1['id']; ?>' title="Details"><?php  if($expense_status == '1' && $report_id == ''){ echo "UNREPORTED";}  if($expense_status == '1' && $report_id !='' ){ echo "UNSUBMITTED";} 
if($expense_status == '2'){ echo "VERIFY";} ?></a></th>					
<th><?php echo $paid_through; ?></th>	
<th><span><b>&nbsp;&#8377;&nbsp;</b></span><?php echo $amount; ?></th>
<th>
<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href='expenses_edit.php?expenses_id=<?php echo $row['id']; ?>'> Edit </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-trash-o" href='expenses_delete.php?expenses_id=<?php echo $row['id']; ?>'> Delete</a></center>				
</th>
</tr>	
<?php } ?>
			</tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		</div>
        <!-- /.col -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <?php   
          $qry ="select * from add_report where title ='$report_name'";
           $runq  = mysql_query($qry) or die(mysql_error());
           if($row3 = mysql_fetch_array($runq))
{
    $business_purpose = $row3['business_purpose'];
	$start_date = $row3['start_date'];
	$end_date = $row3['end_date'];
	
}		   ?>
  <!-- modal report -->
 <form method="post" enctype="multipart/form-data">
  <!-- Modal Start -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $report_name; ?>&nbsp;&nbsp; &#8377; <strong><?php echo $amount; ?></strong></h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
			<div class="col-md-6">
			<label>Staring Date</label>
			<input type="date" name="start_date" placeholder="Item Sale Rate" id="item_sale_rate" value="<?php echo $start_date;			?>" class="form-control" readonly />
			</div>
			<div class="col-md-6">
			<label>Ending Date</label>
			<input type="date" name="end_date" placeholder="Item Sale Rate" id="item_sale_rate" value="<?php echo $end_date;			?>" class="form-control" readonly />
			</div>
		  </div>
		  <div class="col-md-12">
			<div class="col-md-6">
			<label>Business Purpose</label>
			<textarea class="form-control" name="business_purpose" rows="4" readonly><?php echo $business_purpose; ?></textarea>
			</div>
			<div class="col-md-6">
			<label>Merchant name</label>
			<input type="text" name="m_name" value="<?php echo $m_name; ?>" id="item_purchase_rate" class="form-control" readonly />
			</div>
		  </div>
		  <div class="col-md-12">
			<div class="col-md-6">
			<label>Ref Name</label>
			<input type="text" name="ref_name" value="<?php echo $ref_name; ?>" id="item_intra_state_tax_type" class="form-control" readonly />
			</div>
			<div class="col-md-6">
			<label>Category</label>
			<input type="text" name="category" value="<?php echo $category; ?>" id="item_intra_state_tax_type" class="form-control" readonly />
			</div>
		  </div>
		  <div class="col-md-12">
			<div class="col-md-6">
			<label>Paid Through</label>
			<input type="text" name="paid_through" value="<?php echo $paid_through; ?>" id="item_intra_state_tax_type" class="form-control" readonly />
			</div>
			<div class="col-md-6">
			<label> Total Amount (%)</label>
			<input type="text" name="amount" value="&nbsp;&#8377;&nbsp;<?php echo $amount; ?>" id="item_intra_state_tax_type" class="form-control" readonly />
			</div>
		  </div>
        <div class="col-md-12">&nbsp;</div>
		</div>
        <div class="modal-footer">
          <input type="submit" name="submit" value="Submit" class="btn my_background_color" />
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal End -->
  </form>
  
  <?php
        if(isset($_POST['submit']))
		{
		   $start_date = $_POST['start_date'];
		    $end_date = $_POST['end_date'];
			 $business_purpose = $_POST['business_purpose'];
			  $merchant_name = $_POST['m_name'];
			 $ref_name = $_POST['ref_name'];
			  $category = $_POST['category'];
			   $paid_through = $_POST['paid_through'];
			    $amount = $_POST['amount'];
				 $qry = "UPDATE `add_expense` SET `m_name`='$merchant_name',`ref_name`='$ref_name',`category`='$category',`paid_through`='$paid_through',`amount`='$amount',`report_status`='2' Where id='$id'";
				 $runq = mysql_query($qry) or die(mysql_error());
				 if($runq)
				 { 
				    echo "<script>alert('Your Request is Successfully Update in Stock !');</script>";
                   echo "<script>window.open('expenses_report.php', '_self');</script>";
				 }
		}

     ?>
  
  
  
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("link_js.php")?>


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
</body>
</html>
