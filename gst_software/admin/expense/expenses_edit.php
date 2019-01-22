<?php include("../../attachment/session.php"); ?>
<script src="../attachment/file_check.js"></script>

    <section class="content-header">
      <h1>
        Expenses Edit
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Expenses Edit</li>
      </ol>
    </section>
	
	
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
$category_select = "select category from category_add where category_id='$category' and company_code='$company_code'";
$runcat = mysql_query($category_select);
$fetch_cat = mysql_fetch_array($runcat);
$category = $fetch_cat['category'];
$amount = $row['amount'];
$tax_type = $row['tax_type'];
$ref_name  = $row['ref_name'];
$paid_through = $row['paid_through'];
$select_account = "select bank_account_name,bank_account_type,credit_card_account_name from bank_or_credit_card_info where s_no='$paid_through' and company_code='$company_code'";
$run_account = mysql_query($select_account);
$fetch_account = mysql_fetch_array($run_account);
$bank_account_name = $fetch_account['bank_account_name'];
$bank_account_type = $fetch_account['bank_account_type'];
if($bank_account_type=='Credit_Card')
{
$bank_account_name = $fetch_account['credit_card_account_name'];
}
$descr = $row['description'];
$filename = $row['file_name'];
$id = $row['id'];
$folder_name = $row['folder_name'];
$path="../../documents/expenses_file/".$folder_name;
}
?>
                			
	<div class="box-body">
<form method="post" enctype="multipart/form-data" action="">
<div class="row" style="margin-top:30px;">
<div class="col-sm-6 form-horizontal">
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Date</label>
<div class="col-sm-8">
<input type="date" name="exp_date" value="<?php echo $row['insert_date']; ?>" class="form-control">
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Merchant Name</label>
<div class="col-sm-8">
<input type="text"  name="m_name" placeholder="Merchant Name" value="<?php echo $m_name; ?>" class="form-control">
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Category</label>
<div class="col-sm-8">
<select name="cat_name" class="form-control select2">
<option value="<?php echo $category; ?>" selected><?php echo $category; ?></option>
<?php
$qry = "SELECT * FROM `category_add`"; 
$run=mysql_query($qry) or die(mysql_error());

while($row=mysql_fetch_array($run)){

?>
<option value="<?php echo $row['category_id']; ?>"><?php echo $row['category']; ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Amount</label>
<div class="col-sm-8">
<input type="number" name="amount" placeholder="Amount"  value="<?php echo $amount; ?>" class="form-control">
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Tax Type</label>
<div class="col-sm-8">
<select name="tax_type" class="form-control select2">

<option value="<?php echo $tax_type; ?>" selected><?php echo $tax_type; ?></option>
<option value="IGST">IGST</option>
<option value="CGST/SGST">CGST/SGST</option>                         
</select>
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Ref Name</label>
<div class="col-sm-8">
<input type="text" name="ref_name" value="<?php echo $ref_name; ?>" class="form-control" />
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Paid Through</label>
<div class="col-sm-8">
<select name="paid_through" class="form-control select2">
<option value="<?php echo $paid_through; ?>"><?php echo $bank_account_name."(".$bank_account_type.")"; ?></option>
<?php

$que="select * from bank_or_credit_card_info where bank_account_type='Cash' or bank_account_type='Bank' or bank_account_type='Credit_Card' and bank_status='Active' and company_code='$company_code'";
$run=mysql_query($que);
while($row2=mysql_fetch_array($run)){
$s_no = $row2['s_no'];
$bank_account_type = $row2['bank_account_type'];
$account_type = $row2['account_type'];
$bank_account_name = $row2['bank_account_name'];
if(empty($bank_account_name))
{
$bank_account_name = $row2['credit_card_account_name'];
}
$bank_account_code = $row2['bank_account_code'];
$bank_account_number = $row2['bank_account_number'];
$bank_name = $row2['bank_name'];
$bank_routing_no = $row2['bank_routing_no'];
$account_amount = $row2['amount'];
?>
<option value="<?php echo $bank_account_name; ?>"><?php echo $bank_account_name."&nbsp;(".$bank_account_type.")"; ?></option>
<?php
}
?>
</select>
</div></div></div>
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Description</label>
<div class="col-sm-8">
<textarea name="descr" id="invoice_billing_address" rows="5" class="form-control"><?php echo $descr; ?></textarea>
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label class="col-sm-4 control-label" style="text-align:left;">Profile Photo</label>
<div class="col-sm-8">
<input type="file"  id="upload_file" name="image"  value="" onchange="check_file_type(this,'upload_file','show_application','all');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc">
</div>
</div></div>
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
<div class="col-md-12">
<center><input type="submit" name="submit" value="Update" class="btn  my_background_color" /></center>
</div>
</div>
		</form>			
	</div>
      
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  

 <?php } ?>
 
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>

<?php
if(isset($_POST['submit'])){
	$insert_date = $_POST['exp_date'];
	$m_name = $_POST['m_name'];
	$cat_name = $_POST['cat_name'];	
	$cat_name = $_POST['amount'];	
	$cat_name = $_POST['tax_type'];	
	$cat_name = $_POST['ref_name'];
    $paid_throught = $_POST['paid_through'];
    $descr = $_POST['descr'];	
    $path1 = $path;	
	$image_name=$_FILES['image']['name'];            
	$image_temp=$_FILES['image']['tmp_name'];	
	if($image_name==null){
	$image_name=$filename;
	}
	else{
	move_uploaded_file($image_temp,$path1.'/'.$image_name);
	}	
	echo $quer="UPDATE `add_expense` SET `insert_date`='$insert_date',`m_name`='$m_name',`category`='$cat_name',`amount`='$amount',`tax_type`='$tax_type',`ref_name`='$ref_name',`paid_through`='$paid_through',`description`='$descr',`file_name`='$image_name' WHERE `id`='$id'";
    if(mysql_query($quer)){
	echo "<script>alert('Successfully Update');</script>";
	echo "<script>window.open('view_expenses.php','_self');</script>";
    }
    }
	//end

?>
