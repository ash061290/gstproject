<?php  include("../../attachment/session.php");  ?>
<?php
     $select1 ="select sum(amount) from add_expense where expense_status='1' and company_code='$company_code'";
	 $select11="select * from add_expense where expense_status='1' and company_code='$company_code'";
	 $select12="select * from add_expense where expense_status='2' and company_code='$company_code'";
	 $select2 ="select sum(amount) from add_expense where expense_status='2' and company_code='$company_code'";
	 $select3 = "select * from add_expense where expense_status='1' and report_id='' and company_code='$company_code'";
	 $select4 = "select * from add_expense where expense_status='0' and company_code='$company_code'";
	 $total_unpaid = "select * from add_expense where paid_through='' and company_code='$company_code'";
	 $run1 = mysql_query($select1);
	 $run11 = mysql_query($select11);
	 $run12 = mysql_query($select12);
	 $run2 = mysql_query($select2);
	 $run3 = mysql_query($select3);
	 $run4 = mysql_query($select4);
	 $num1 = mysql_num_rows($run11);
	 $num2 = mysql_num_rows($run12);
	 $num3 = mysql_num_rows($run3);
	 $paid_amount = mysql_fetch_array($run2);
	 $unpaid_amount = mysql_fetch_array($run1);
	 $paid_amount = $paid_amount['sum(amount)'];	
	 $unpaid_amount = $unpaid_amount['sum(amount)'];
	 $num4 = mysql_num_rows($run4);
	 $unpaid = mysql_query($total_unpaid);
	// $paid = mysql_query($total_paid);
	 //$fetch_paid = mysql_fetch_array($paid);
	 $fetch_unpaid = mysql_fetch_array($unpaid);
	 //$unpaid_amount =+ $fetch_unpaid['amount'];
	
   ?>
   <script type="text/javascript">
       function fun2(){
		        if(document.getElementById("edit_report").checked = true){
				   document.getElementById("secound").style.display="block";
				   document.getElementById("first").style.display="none";
				 }
	   }
	    function fun1(){
		        if(document.getElementById("new_report").checked = true){
				   document.getElementById("secound").style.display="none";
				   document.getElementById("first").style.display="block";
				 }
	   }
	   function fun3(value){
				 $("#modal_s_no").val(value);				 
				 $("#button_modal").click();
                 $.ajax({
					    type:"POST",
						url: software_link+"expense/ajax_expense_dashboard.php",
						data:"expense_id="+value,
						success: function(detail){
						  var myobj = JSON.parse(detail);
						    $("#modal_m_name").val(myobj[0]);
							$("#modal_insert_date").val(myobj[1]);
							$("#modal_amount").val(myobj[3]);
						} 
				 })			 
	   }
	   function view_report(value){
				 $.ajax({
					      type:"POST",
						  url: software_link+"expense/ajax_expense_dashboard.php",
						  data:"view_expense_id="+value,
						  success:function(detail){
						     alert(detail);
						  }
				 })
	   }
	   function fun4(value){
			      $.ajax({
					      type: "GET",
                          url: software_link+"expense/ajax_expense_dashboard.php?expense_type="+value+"",
                          cache: false,
                          success: function(detail){
                          $('#search_table').html(detail);
                          }
				 })
			 
	   }
	   
</script>
	 <script type="text/javascript">
     $( document ).ready(function() {
	  fun4("default");
       });
</script>
  <!-- Content Wrapper. Contains page content  style="position: unset !important;"-->
 
    <section class="content-header">
      <h1>
        Dashboard Expenses
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	   <div class="col-lg-8">
	   <h4>&nbsp;&nbsp;&nbsp;&nbsp;Sales Activity</h4>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
		  <a href="#" onclick="fun4('Unsubmitted')" >
          <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:red;"><?php echo $num1; ?></span></p></center>
		   <center><p style="font-size:20px;"><span style="color:red;">Unsubmitted</span></p></center>
			</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
		   <a href="#" onclick="fun4('Approved')" >
           <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:green;"><?php echo $num2; ?></span></p></center>
		   <center><p style="font-size:20px;"><span style="color:green;">Approved</span></p></center>
			</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
		  <a href="#" onclick="fun4('Unreported')">
           <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:green;"><?php echo $num3; ?></span></p></center>
		   <center><p style="font-size:20px;"><span style="color:green;">Unreported</span></p></center>
          </div>
		  </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="#" onclick="fun4('Inactive')">
            <div class="small-box" style="padding:15px; background-color:#fff;">
           <center><p style="font-size:20px;"><span style="color:brown;"><?php echo $num4; ?></span></p></center>
		   <center><p style="font-size:20px;"><span style="color:brown;">Inactivate</span></p></center>
			</a>
          </div>
        </div>
		</div>
		 <div class="col-lg-4">
		 <h4>&nbsp;&nbsp;Expenses Summary</h4>
		 <div class="">
          <!-- small box -->
         
            <div style="padding:2px; background-color:#fff;">
           <p style="font-size:15px;">&nbsp;&nbsp;Total Unpaid Amount Expense&nbsp;&nbsp;<span style="color:red;float:right;">&nbsp;&nbsp;&#8377;&nbsp;<?php echo  $unpaid_amount; ?></span></p></div><br>
		   <div style="padding:2px; background-color:#fff;">
           <p style="font-size:15px;">&nbsp;&nbsp;Total Paid Amount Expenses &nbsp;&nbsp;<span style="color:red;float:right;">&nbsp;&nbsp;&#8377;&nbsp;<?php echo $paid_amount; ?></span></p></div>
			 </div>
          
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
	  <br>
     
	  <!-------------------------------product details---------------->
	   <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Expenses Details</h3>
            </div>
            <!-- /.box-header -->   
		 <!-- /.box-header -->
            <div class="box-body table-responsive" id="search_table">
			
			 <!--<a href='#' id="button_modal" data-toggle="modal" data-target="#myModal1" style="display:none;" ></a>-->
            </div>
          </div>
          <!-- /.box -->
        </div>  
          </div>
    </section>
  </div>
 <form method="post" enctype="multipart/form-data" >
  <!-- Modal Start -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog" >
    <input type="hidden" name="s_no" id="modal_s_no"  value="" />
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Report Info<span id="modal_span"></span></h4>
        </div>
        <div class="modal-body">
		<div class="col-md-12">
		   <div class="col-md-6">
		   <input type="radio" name="select" id="new_report" onclick="fun1()" value="Edit Expense" checked > Edit Expense</div>
		   <div class="col-md-6">
		   <input type="radio" name="select"  id="edit_report" onclick="fun2()" value="Insert Report"> Insert Report</div>
		  </div>
		  <hr/> 
		  <!--first-->
		  <div id="first">
          <div class="col-md-12">
			<div class="col-md-6" id="select_report">
			<label>Select Report</label>
		     <select name="report" class="form-control" id="modal_report">
			    <option value="">Select</option>
				<?php $qry_select = "select * from add_report";
                      $run2 = mysql_query($qry_select);
                     while($fetchname = mysql_fetch_array($run2)){
                      $report_name = $fetchname['title'];
                      $report_id = $fetchname['report_id'];				
					  ?>
					    <option value="<?php echo $report_id; ?>"><?php echo $report_name; ?></option>
					 <?php } ?>
			  </select>
			</div>
			<div class="col-md-6">
			<label>Total Amount</label>
			<input type="text" name="amount" class="form-control" id="modal_amount" value="" />
			</div>
		  </div>
		  <div class="col-md-12">
			<div class="col-md-6">
			<label>Expense Category</label>
			<select name="expense_category" class="form-control" id="modal_category" >
			<option value="">Select</option>
			<?php
			$query4="select * from expense_category";
			$res4=mysql_query($query4);
			while($row4=mysql_fetch_array($res4)){
			$s_no2=$row4['id'];
			$category_name2=$row4['category_name'];
			?>
			<option value="<?php echo $s_no2; ?>"><?php echo $category_name2; ?></option>
			<?php
			}
			?>
			</select>
			</div>
			<div class="col-md-6">
			<label>Merchant Name</label>
			<input type="text" name="m_name" id="modal_m_name" value="" class="form-control" />
			</div>
			<div class="col-md-6">
			<label>Merchant Date</label>
			<input type="date" name="insert_date" id="modal_insert_date" value="" class="form-control" />
			</div>
        </div>
		</div>
		<!--secound end -->
		  <!--secound start-->
		  <div id="secound" style="display:none;">
          <div class="col-md-12">
      <div class="col-md-6">
      <label>Report Title</label>
       <div class="form-group">
      <input type="text" name="report_title" id="report_title" class="form-control" placeholder="Report Title"  />
    </div>
	  <label>Start Date</label>
        <div class="form-group">
        <input type="date" name="start_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
      </div>
	   <label>End Date</label>
      <div class="form-group">
        <input type="date" name="end_date" placeholder="<?php echo date('Y-m-d'); ?>" class="form-control"/>
      </div>
	  </div>
     
	<div class="col-md-6">
      <label>Bussiness Purpose</label>
    <div class="form-group">
    <textarea name="business_purpose" id="business_purpose" rows="5" class="form-control" > </textarea>
  </div>
  </div>
    </div>
		</div>
		<!--secound end -->
        <div class="modal-footer" id="m-footer">
		  <input type="submit" class="btn my_background_color" name="submit" value="Submit" />
		  &nbsp;&nbsp;
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal End -->
  </div>
  </form>


   <?php
          if(isset($_POST['submit'])){
			  $edit = $_POST['select'];
			  if($edit == 'Edit Expense'){
		       $m_name = $_POST['m_name'];
			   $s_no2=$_POST['s_no'];
			   $report = $_POST['report'];
			   $category = $_POST['expense_category'];
			   if(empty($category)){
			   $select = "select category from add_expense where id='$s_no2'";
			   $run = mysql_query($select);
			   $fetchrow = mysql_fetch_array($run);
			   $category = $fetchrow['category']; 
			  }
			  
			   $amount = $_POST['amount'];
			   $insert_date = $_POST['insert_date'];
			   $update = "update add_expense set insert_date = '$insert_date',m_name ='$m_name',amount='$amount',report_id='$report',category='$category' where id='$s_no2'";
			  if($run = mysql_query($update)){
			        echo "<script>alert('Successfully Updated');</script>";
	                echo "<script>window.open('expense_dashboard.php','_self');</script>"; } }
			  if($edit == 'Insert Report'){
			       $report_title = $_POST['report_title'];
				   $start_date = $_POST['start_date'];
				   $end_date = $_POST['end_date'];
				   $business_purpose = $_POST['business_purpose'];
				  echo $insert = "insert into add_report(title,business_purpose,start_date,end_date) values('$report_title','$business_purpose','$start_date','$end_date')";
				   if($run = mysql_query($insert)){
				    echo "<script>alert('New Report Created');</script>";
	                echo "<script>window.open('expense_dashboard.php','_self');</script>";
				   }
			  }
		  }			  
   ?>
   <script>
  $(function () {
    $('#example1').DataTable()
   
  })
</script>