<?php  include("../../attachment/session.php");  ?>
    <section class="content-header">
      <h1>
        Add Expenses
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="view_expenses.php"><i class="fa fa-list"></i>Expenses</a></li>
        <li class="active">Add Expenses </li>
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
<!------------------------------------------------Start Registration form---------------------------------------------------->


<script>
  function myFunction()
  {
 var checkbox = document.getElementById("ember904");
 if(checkbox.checked == true)
 {
  document.getElementById("div1").style.display = "none";
  document.getElementById("div2").style.display = "none";
  document.getElementById("mname").value="";
  document.getElementById("catname").value="0";
 }
 else
   if(checkbox.checked == false)
 {
 document.getElementById("div1").style.display = "block";
  document.getElementById("div2").style.display = "block";
 }
}
 function myFunction2()
  {
 var checkbox = document.getElementById("ember905");
 if(checkbox.checked == true)
 {
  document.getElementById("paid_through").style.display = "none";
 }
 else
   if(checkbox.checked == false)
 {
 document.getElementById("paid_through").style.display = "block";
 }
}
function submit2(value){
	       $.ajax({
			        type:"POST",
					url: software_link+"expense/ajax_report.php",
					data:"new_title="+value,
					success:function(detail){
					document.getElementById("report").innerHTML = detail;
					}
			   
		   })
        
}
</script>
 <?php
	      if(isset($_GET['expenses_id']))
		  {
$id = $_GET['expenses_id'];
$qry = "SELECT * FROM `add_expense` WHERE `id`='$id' and company_code='$company_code'";
$res = mysql_query($qry);
if($row=mysql_fetch_array($res)){
$date = $row['insert_date'];
$m_name = $row['m_name'];
$category = $row['category'];
$rem = $row['rem'];
$cat_id = $category;
$report_id = $row['report_id'];
$report_select = "select * from add_report where report_id='$report_id' and company_code='$company_code'";
$runreport = mysql_query($report_select);
$fetchr = mysql_fetch_array($runreport);
$report_name = $fetchr['title'];
$category_select = "select category_name from expense_category where id='$category' and company_code='$company_code'";
$runcat = mysql_query($category_select);
$fetch_cat = mysql_fetch_array($runcat);
$category = $fetch_cat['category_name'];
$amount = $row['amount'];
$tax_type = $row['tax_type'];
$ref_name  = $row['ref_name'];
$paid_through = $row['paid_through'];
$paid_id = $paid_through;
$select_account = "select bank_account_name,bank_account_type,credit_card_account_name from bank_or_credit_card_info where s_no='$paid_through' and company_code='$company_code'";
$run_account = mysql_query($select_account);
$fetch_account = mysql_fetch_array($run_account);
$bank_account_name = $fetch_account['bank_account_name'];
$bank_account_type = $fetch_account['bank_account_type'];
if($bank_account_type=='Credit_Card'){
$bank_account_name = $fetch_account['credit_card_account_name']; }
$paid_through = $bank_account_name." (".$bank_account_type.")";
$descr = $row['description'];
$filename = $row['file_name'];
$id = $row['id'];
$folder_name = $row['folder_name'];
$path="../../documents/expenses_file/".$folder_name;
}
?>		
    <div class="box-body">
		<form method='post' enctype="multipart/form-data">
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-6 form-horizontal">
				<div class="" id="for_bank">
				    <div class="form-group">
				    <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Date</label>
                    <div class="col-sm-8">
            <input type="date" name="insert_date" id="insert_date" value="<?php echo $date; ?>" class="form-control" required>
                    </div>										
                    </div>
                    </div>

   <div class="form-group">
     <div class="col-sm-12">
      <label class="col-sm-4 control-label" style="text-align:left;"></label>
       <div class="col-sm-8">
    <div class="checkbox">
      <label>
    <input type="checkbox" name="check" id="ember904" class="ember-checkbox ember-view"  onclick="myFunction()" <?php if(empty($category) && empty($m_name)){ echo " checked";} ?>> Is Personal Expense?
      </label>
    </div>
  </div>
</div>
</div>
					
	<div class="form-group" id="div1" style="<?php if(empty($category) && empty($m_name)){ echo "display:none"; } ?>">
	<div class="col-sm-12">
	<label class="col-sm-4 control-label" style="text-align:left;">Merchant Name</label>
	<div class="col-sm-8">
	<input type="text" name="merchant_name" placeholder="Merchant Name" id="mname" value="<?php echo $m_name; ?>" class="form-control"  >
	</div>
	</div>
	</div>
	<div class="form-group" id="div2" style="<?php if(empty($category) && empty($m_name)){ echo "display:none"; } ?>">
	<div class="col-sm-12">
	<label class="col-sm-4 control-label" style="text-align:left;">Category</label>
	<div class="col-sm-8">
	  <select name="category" class="form-control select2" id="catname" style="width:100%">
		<option value="">--Select--</option>
		<?php
	   $qry = "SELECT * FROM `expense_category` where company_code='$company_code'"; 
		$run=mysql_query($qry) or die(mysql_error());
		 while($row=mysql_fetch_array($run)){ ?>
<option  <?php if($row['id'] == $cat_id){ echo "value='".$row['id']."' selected"; } else{ echo "value='".$row['id']."'"; } ?>>
 <?php if($row['id'] == $cat_id){ echo $category; } else{ echo $row['category_name']; } ?></option>
	<?php } ?>
	   </select>
	</div>
	</div>
	</div>
	<div class="form-group">
	<div class="col-sm-12">
	<label class="col-sm-4 control-label" style="text-align:left;">Amount</label>
	<div class="col-sm-8">
	 <input type="number" name="amount" value="<?php echo $amount; ?>" placeholder="Amount" id="amount" class="form-control" required>
	</div>
	</div>
	</div>
	<div class="form-group">
	<div class="col-sm-12">
	<label class="col-sm-4 control-label" style="text-align:left;">Tax Type</label>
	<div class="col-sm-8">
 <select name="tax_type" class="form-control select2" id="tax_type" style="width:100%">
	 <option>--Select--</option>
	 <option <?php if($tax_type == 'CGST/SGST'){ echo "selected"; } ?> value="CGST/SGST">CGST/SGST</option>
	 <option <?php if($tax_type == 'IGST'){ echo "selected"; } ?> value="IGST">IGST</option>
	  </select>
	</div>
	</div>
	</div>
	<div class="form-group">
	<div class="col-sm-12">
	<label class="col-sm-4 control-label" style="text-align:left;">Add To Report</label>
	<div class="col-sm-8">
<select name="report_name" class="form-control select2" id="report" style="width:100%" >
<option value="" id="select_report">Select Report</option>
<?php
  $qry="select * from add_report where company_code='$company_code'";
  $rest=mysql_query($qry);
  while($row22=mysql_fetch_array($rest)){
  $s_no=$row22['report_id'];
  $report_name=$row22['title'];
   ?>
  <option <?php if($report_id == $s_no){ echo "value='".$report_id."' selected"; } 
                  else{ echo "value='".$s_no."'"; } ?>>
				  <?php if($report_id == $s_no){ echo $report_name; } else { echo $report_name; }  ?></option>
  <?php } ?>
  	 
 </select>
	<br><br>
  <a aria-hidden="true" class="fa fa-hand-o-right" href='#' data-toggle="modal" data-target="#myModal1" >
	<button type="button" style="background-color:#00a65a; color:white" class="">+ New Report</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				 
	</div>
	</div>
	</div>
	<div class="form-group">
	<div class="col-sm-12">
	<label class="col-sm-4 control-label" style="text-align:left;">Ref#</label>
	<div class="col-sm-8">
 <input type="text"  name="ref_name" placeholder="Ref Name" value="<?php echo $ref_name; ?>" id="ref_name" class="form-control">
	</div>
	</div>
	</div>
	<div class="form-group">
     <div class="col-sm-12">
      <label class="col-sm-4 control-label" style="text-align:left;"></label>
      <div class="col-sm-8">
     <div class="checkbox">
      <label><input type="checkbox" name="rem" id="ember905" class="ember-checkbox ember-view" onclick="myFunction2()" <?php if($rem == 'Reimbursable'){ echo "value='Reimbursable' checked='true'"; } else{ echo "value='Non-Reimbursable'";} ?>> Claim reimbursement </label>
    </div>
  </div>
</div>
</div>
	<div class="form-group">
	<div class="col-sm-12" id="paid_through" <?php if($rem == 'Reimbursable') { echo"style='display:none'"; } else{ echo "style='display:block'";} ?>>
	<label class="col-sm-4 control-label" style="text-align:left;">Paid Through</label>
	<div class="col-sm-8">
	   <select name="paid_through" class="form-control select2" id="paid_through" style="width:100%" disabled >
	  <option value="">--Select--</option>
  <?php
$que="select * from bank_or_credit_card_info where company_code='$company_code'";
$run=mysql_query($que);
while($row=mysql_fetch_array($run)){
$s_no = $row['s_no'];
$bank_account_type = $row['bank_account_type'];
$account_type = $row['account_type'];
$bank_account_name = $row['bank_account_name'];
if(empty($bank_account_name)){
$bank_account_name = $row['credit_card_account_name']; }
$bank_account_code = $row['bank_account_code'];
$bank_account_number = $row['bank_account_number'];
$bank_name = $row['bank_name'];
$bank_routing_no = $row['bank_routing_no'];
$account_amount = $row['amount']; ?>
<option <?php if($paid_id == $s_no){ echo " value='".$paid_id."' selected"; } else{ echo "value='".$s_no."'";} ?>>
<?php if($paid_id == $s_no){ echo $paid_through; } else { echo $bank_account_name."&nbsp;(".$bank_account_type.")"; } ?></option>
		<?php } ?>
  </select>
			</div>
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12">
			<label class="col-sm-4 control-label" style="text-align:left;">Description</label>
			<div class="col-sm-8">
			 <input type="text"  name="descr" placeholder="Description" id="bank_description_bank" class="form-control" value="<?php echo $descr; ?>" >
			</div>
			</div>
			</div>
				</div>
        <div class="form-group">
            <div class="col-sm-12">
                    <label class="col-sm-4 control-label" style="text-align:left;">Insert File</label>
                    <div class="col-sm-8">
              <input type="file"  id="upload_file" name="upload_file"  value="" onchange="check_file_type(this,'upload_file','show_application','all');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc">
                      
                    </div>
                    </div>
                    </div>
       <div class="form-group">
<div class="col-sm-12">
<div class="form-group" ><br/>	
<div class="col-sm-12">
<center>
<img src="<?php echo $path."/".$filename; ?>" id="show_application" height="50" width="50">
</center>
</div>
</div>
</div>
</div>	
			<div class="col-sm-12">	
			<br/><center><input type="submit" name="submit1" value="submit" class="btn btn-primary my_background_color"></center><br/>
		    </div>		
		</form>	
	</div>
		  <!-- /.box-body -->
    </div>
    </div>
</section>

    
  </div>
  
<?php
  }
if(isset($_POST['submit1'])){
$insert_date = $_POST['insert_date'];
$merchant_name = $_POST['merchant_name'];
$category = $_POST['category'];
$amount = $_POST['amount'];
$tax_type = $_POST['tax_type'];
$report_id = $_POST['report_name'];
$ref_name = $_POST['ref_name'];
$paid_through = $_POST['paid_through'];
$descr = $_POST['descr'];
$rem = $_POST['rem'];
if(empty($_POST['rem'])){
 $_POST['rem'] = 'Non-Reimbursable';
 $rem = $_POST['rem'];
}
$folder_id ='0';
$upload_file_name=$_FILES['upload_file']['name'];            
$upload_file_temp=$_FILES['upload_file']['tmp_name'];
 $qry = "UPDATE `add_expense` SET `insert_date`='$insert_date',`m_name`='$merchant_name',`category`='$category',`amount`='$amount',`tax_type`='$tax_type',`ref_name`='$ref_name',`paid_through`='$paid_through',`description`='$descr',`file_name`='$image_name',`report_id`='$report_id' WHERE `id`='$id'"; 
 if(mysql_query($qry)){
$qry_select = "SELECT * FROM `add_expense` where company_code='$company_code' ORDER BY ID DESC LIMIT 1";
  $runq = mysql_query($qry_select) or die(mysql_error());
  if($row = mysql_fetch_array($runq)){
  $folder_id = $row['id']; }
 $path="../../documents/expenses_file/".$folder_id;
if(!is_dir($path)){
mkdir($path, 0755, true); }
	$move = move_uploaded_file($upload_file_temp,$path."/$upload_file_name");
	 if($move){
   $qry = "UPDATE `add_expense` SET `folder_name`='$folder_id' WHERE `id`='$folder_id' and company_code='$company_code'";
	$runq = mysql_query($qry);}     
 echo "<script>alert('Successfully Complete');</script>";
 echo "<script>window.open('view_expenses.php','_self')</script>";
}
}  ?>
<!-- modal report -->
<form method="post" enctype="multipart/form-data">
  <!-- Modal Start -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header my_background_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title ">Add New Report</h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
      <div class="col-md-6">
      <label>Report Title</label>
       <div class="form-group">
      <input type="text" name="report_title" id="report_title" class="form-control" placeholder="Report Title" required  />
    </div>
	  <label>Start Date</label>
        <div class="form-group">
        <input type="date" name="start_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required />
      </div>
	   <label>End Date</label>
      <div class="form-group">
        <input type="date" name="end_date" placeholder="<?php echo date('Y-m-d'); ?>" class="form-control" required />
      </div>
	  </div>
     
	<div class="col-md-6">
      <label>Bussiness Purpose</label>
    <div class="form-group">
    <textarea name="business_purpose" id="business_purpose" rows="5" class="form-control" required> </textarea>
  </div>
  </div>
    </div>
     
        </div>
        <div class="modal-footer">
      <input type="submit" class="btn my_background_color" name="modal_submit" value="Submit" />
      &nbsp;&nbsp;
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal End -->
  </form>
  <!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
  <?php
        if(isset($_POST['modal_submit']))
          {
            $report_title = $_POST['report_title'];
            $business_purpose = $_POST['business_purpose'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
      $qry = "INSERT INTO `add_report`(`title`, `business_purpose`, `start_date`, `end_date`,`company_name`,`company_code`) VALUES ('$report_title','$business_purpose','$start_date','$end_date','$company_name','$company_code')";
          $run = mysql_query($qry);
	     echo "<script type='text/javascript'>
		              $( document ).ready(function() {
	                   submit2('$report_title');
                              });
		         </script>";	 
          }

   ?>
<!-- end -->
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>				
