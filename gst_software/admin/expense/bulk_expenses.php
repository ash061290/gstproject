<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
<h1>
    Bulk Add Expenses
     <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('expense/view_expenses')"><i class="fa fa-plus"></i> Expenses</a></li>
        <li class="active"> Bulk Add Expenses</li>
      </ol>
    </section>
<!-- Main content --> 
<script>
   function cFunction2(value,num) {
	var cbox = document.getElementById("rem_"+num);
	if(cbox.checked == true)
	{
	$("#pay_"+num).prop("disabled", true);
	} else {
	$("#pay_"+num).prop("disabled", false);
	}
	}  
</script>
	<script>
$("#bulk_expense_submit").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
        $.ajax({
            url: software_link+"expense/bulk_expense_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
				alert(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Complete');
				   post_content('expense/view_expense',res[2]);
            }
			}
         });
      });
</script>
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
        <div class="box-header with-border">
   <!-- <a href='#'><button style="float:right;" type="button" class="btn my_background_color" onclick="paid()"> Paid Through</button></a> -->      
        </div>
            <!-- /.box-header -->
        <!--------------------------------------Start Table------------------------------------------>
<form method="post" id="bulk_expense_submit" enctype="multipart/form-data">
<div class="box-body table-responsive" id="add_div">
<table id="item_table" class="table table-bordered" style="background-color:white;">
  <thead class="my_background_color">
	 <tr>
<th>s_no</th>
<th>Expense No.</th>
<th>Date</th>
<th>Excutive Name</th>
<th>Category (<i class="fa fa-inr" aria-hidden="true">)</th>
<th>Report (<i class="fa fa-inr" aria-hidden="true">)</th>
</tr>
</thead>
<tbody>
<tr id="row_1">
<td>1</td>
<td>
<?php
		$query2="select * from invoice_no where company_code='$company_code'";
		$res2=mysql_query($query2);
		while($row2=mysql_fetch_array($res2)){
		$folder_id=$row2['folder_id'];
		$expense_no=$row2['expense_no'];
		$val = $expense_no; } ?>
<input type="hidden" id="exp_no" value="2" />
<input type="hidden" id="exp_no2" name="exp_no" value="<?php echo $val; ?>" />
<input type="text" name="exp_name[]" value='EXP-<?php echo $expense_no; ?>' style="border:none;" readonly /></td>
<td>
<div class="form-group">	
<input type="date" name="date[]" class="form-control" id="date_<?php echo $val; ?>" required>
</div>
</td>
<td >
<div class="form-group">
<select name="mname[]" id="mname_<?php echo $val; ?>" class="form-control select2" style="width:100%;" required>
	<option value="">--Select--</option>
	   <?php
             $qry = "select * from user_detail where status='Active' and company_code='$company_code'";
			 $run = mysql_query($qry);
			 while($fetchrow = mysql_fetch_array($run)){
			 ?>
			   <option value="<?php echo $fetchrow['user_id'] ?>"><?php echo $fetchrow['user_name']; ?></option>
			 <?php } ?>
	 </select>	
</div>
</td>
<td >
<div class="form-group">	
<select name="cat[]" class="form-control select2" id="cat_<?php echo $val; ?>" style="width:100%">
<option value="" required>--Select--</option>
<?php
$qry = "SELECT * FROM `expense_category` where company_code='$company_code'"; 
$run=mysql_query($qry) or die(mysql_error());
while($row=mysql_fetch_array($run)){
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
<?php
}
?>
</select>
</div>
</td>
<td ><div class="form-group">
<div class="col-sm-12">
<div class="col-sm-12">
<select name="report[]" class="form-control select2" id="report_<?php echo $val; ?>" style="width:100%" >
<option value="" id='select_report'>Select Report</option>
<?php  $qry="select * from add_report where company_code='$company_code'"; 
       $rest=mysql_query($qry);  
	    while($row22=mysql_fetch_array($rest))
		 { $s_no=$row22['report_id']; 
	        $report_name=$row22['title']; 
			 echo '<option value='.$s_no.'>'.$report_name.'</option>'; 
		  } ?>
</select>
</div>
</div>
</div>
</td>
</tr>
</tbody>
<thead class="my_background_color">
<tr>
<th style="width:70px;">Amount(Rs) (<i class="fa fa-inr" aria-hidden="true">)</th>
<th style="width:30px;">Reimbursable</th>
<th id="pay_through" style="width:70px;">Pay Through(<i class="fa fa-inr" aria-hidden="true">)</th>
<th style="width:100px;">Description</th>
<th style="width:100px;">Ref</th>
<th style="width:100px;">File &nbsp;&nbsp;<img id="upload_image" src=<?php echo $image_path."Profile.png"; ?> width='30px' height='30px'></th>
</tr>
</thead>
<tbody>
<tr>
<td width="10%">
<div class="form-group">	
 <input type="number" name="amount[]" id="amount_<?php echo $val; ?>" class="form-control" required>
</div>
</td>
<td width="5%">
<div class="form-group">	
<input type="checkbox" name="rem_1" checked="true" value="Reimbursable" id="rem_1" onclick="cFunction2(this.value,1)">
</div>
</td>
<td width="10%">
<div class="form-group" >	
<select name="pay_1" class="form-control select2" style="width:100%" id="pay_1" disabled>  
	<option value="">--Select--</option>					 
<?php
$que="select * from bank_or_credit_card_info where bank_account_type='Cash' or bank_account_type='Bank' or bank_account_type='Credit_Card' and bank_status='Active' and company_code='$company_code'";
	$run=mysql_query($que);
	while($row2=mysql_fetch_array($run)){
	$s_no = $row2['s_no'];
	$bank_account_type = $row2['bank_account_type'];
	$account_type = $row2['account_type'];
	$bank_account_name = $row2['bank_account_name'];
	if(empty($bank_account_name)) {
	$bank_account_name = $row2['credit_card_account_name']; }
	$bank_account_code = $row2['bank_account_code'];
	$bank_account_number = $row2['bank_account_number'];
	$bank_name = $row2['bank_name'];
	//$bank_routing_no = $row2['bank_routing_no'];
	$account_amount = $row2['amount']; ?>
<option value="<?php echo $s_no; ?>"><?php echo $bank_account_name."&nbsp;(".$bank_account_type.")"; ?></option>
	<?php  }  ?>
</select>
</div>
</td>
<td width="10%">
<div class="form-group">	
<input type="text" name="descr[]" id="descr_<?php echo $val; ?>" class="form-control">
</div>
</td>
<td width="10%">
<div class="form-group">	
<input type="text" name="ref[]" id="ref_<?php echo $val; ?>" class="form-control">
</div>
</td>
<td width="10%">
<div class="form-group">	
 <input type="file" name="upload_file" id="upload_file" placeholder="" onchange="check_file_type(this,'upload_file','upload_image','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
</div>
</td>
</tr>
</tbody>
</table>
</div>
<br>
<button type="button" style="background-color:#00a65a; float:left;" class="btn btn-info" id='addmore'>+ Add More</button>
<input type="submit" name="submit" style="background-color:#00a65a; float:right;" class="btn btn-info" value="Submit"/>
<br/>
<br/>
<br/>
<script>
var i=2;
$("#addmore").on('click',function(){
count=$('table tr').length;
$i=2;
var exp_no = document.getElementById("exp_no2").value;
var exp_no = parseInt(exp_no);
var exp_no = exp_no+1;
document.getElementById("exp_no2").value = exp_no;
var count = document.getElementById("exp_no").value;
$('#add_div').append('<table id="item_table" class="table table-bordered" style="background-color:white;"><thead class="my_background_color"><tr><th >s_no</th><th>Expense No.</th><th>Date</th><th>Merchant Name</th><th>Category (<i class="fa fa-inr" aria-hidden="true">)</th><th>Report (<i class="fa fa-inr" aria-hidden="true">)&nbsp; &nbsp;&nbsp; &nbsp;<i class="fa fa-close" style="color:red;"></i></th></tr></thead><tbody><tr id="row_'+count+'"><td>'+count+'</td><td><input type="text" name="exp_name[]" value="EXP-'+exp_no+'" style="border:none;" readonly /></td><td ><div class="form-group">	<input type="date" name="date[]" class="form-control" id="date_'+count+'"></div></td><td ><div class="form-group">	<input type="text" name="mname[]" id="mname_'+count+'" class="form-control"></div></td><td><div class="form-group"><select name="cat[]" class="form-control select2" id="cat_'+count+'" style="width:100%"><option value="">--Select--</option><?php $qry = "SELECT * FROM `expense_category` where company_code='$company_code'"; $run=mysql_query($qry) or die(mysql_error());while($row=mysql_fetch_array($run)){ ?><option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option><?php } ?></select></div></td><td><div class="form-group"><div class="col-sm-12"><div class="col-sm-12"><select name="report[]" class="form-control select2" id="report_'+count+'"style="width:100%" ><option value="" id="select_report">Select Report</option><?php  $qry="select * from add_report where company_code='$company_code'"; $rest=mysql_query($qry); while($row22=mysql_fetch_array($rest)){ $s_no=$row22['report_id']; $report_name=$row22['title']; echo '<option value='.$s_no.'>'.$report_name.'</option>'; } ?></select></div></div></div></td></tr></tbody><thead class="my_background_color"><tr><th style="width:70px;">Amount(Rs) (<i class="fa fa-inr" aria-hidden="true">)</th><th style="width:30px;">Reimbursable</th><th id="pay_through" style="width:70px;">Pay Through(<i class="fa fa-inr" aria-hidden="true">)</th><th style="width:100px;">Description</th><th style="width:100px;">Ref</th><th style="width:100px;">File &nbsp;&nbsp;<img id="upload_image" src=<?php echo $image_path."Profile.png"; ?> width='30px' height='30px'></th></tr></thead><tbody><tr><td width="10%"><div class="form-group">	<input type="number" name="amount[]" id="amount_'+count+'" class="form-control" required></div></td><td width="5%"><div class="form-group">	<input type="checkbox" name="rem_'+count+'" checked="true" value="Reimbursable" id="rem_'+count+'" onclick="cFunction2(this.value,'+count+')"></div></td><td width="10%"><div class="form-group" ><select name="pay_'+count+'" class="form-control select2" style="width:100%" disabled id="pay_'+count+'"><option value="">--Select--</option><?php $que="select * from bank_or_credit_card_info where bank_account_type='Cash' or bank_account_type='Bank' or bank_account_type='Credit_Card' and bank_status='Active' and company_code='$company_code'"; $run=mysql_query($que);while($row2=mysql_fetch_array($run)){ $s_no = $row2['s_no'];$bank_account_type = $row2['bank_account_type'];$account_type = $row2['account_type'];$bank_account_name = $row2['bank_account_name'];if(empty($bank_account_name)){ $bank_account_name = $row2['credit_card_account_name']; } $bank_account_code = $row2['bank_account_code'];$bank_account_number = $row2['bank_account_number'];$bank_name = $row2['bank_name'];$account_amount = $row2['amount']; ?><option value="<?php echo $s_no; ?>"><?php echo $bank_account_name."&nbsp;(".$bank_account_type.")"; ?></option><?php }?></select></div></td><td width="10%"><div class="form-group">	<input type="text" name="descr[]" id="descr_1" class="form-control"></div></td><td width="10%"><div class="form-group">	<input type="text" name="ref[]" id="ref_'+count+'" class="form-control"></div></td><td width="10%"><div class="form-group"><input type="file" name="upload_file" id="upload_file" placeholder="" onchange="check_file_type(this,'+upload_file+','+upload_image+','+image+');" class="form-control" accept=".gif, .jpg, .jpeg, .png"></div></td></tr></tbody></table>');
 
$('.select2').select2();
i++;
document.getElementById('exp_no').value = i;
});
function for_delete(sno){
if(sno>1){
var my_sno=sno-1;
$('#row_'+sno).remove();
$('#click_'+my_sno).click();
var count1=1;
$('.snm').each(function() {
$(this).html(count1);
count1++;
});
}
}
</script>
	
	</form>
	<!--form submittion -->
	
	<!--end form -->
  </div>
       <!---------------------------------------------End Table------------------------------------->
      <!-- /.box-body -->
    </div>
</section>
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
