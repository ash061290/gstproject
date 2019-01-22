<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
   <?php include("../attachment/link_css.php"); ?>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php include("../attachment/header.php"); ?>
  <?php include("../attachment/sidebar.php"); ?>
   <?php include("../../connection/connect.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Group
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Add Group</li>
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

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
        <div class="box-body">
			<form role="form" method="post" enctype="multipart/form-data">				
				<div class="col-md-6 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>Group Name</th>
				  <th>Add Group</th>
                </tr>
                </thead>
				
				<tbody>
				<tr>
				<td><input class="form-control" type="text" name="company_name" placeholder="Add Group Name" required /></td>
				<td><input type="submit" name="add_company" value="Add Group" class="btn  my_background_color" /></td>
				</tr>					
				</tbody>
				
                </table>
                </div>
			
				<div class="col-md-6 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>S No.</th>
                  <th>Group Name</th>
				  <th>Delete</th>
                </tr>
                </thead>
										
				<tbody>
				<?php
				$que="select * from company_add where status='Active'  and company_code='$company_code'";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
				while($row=mysql_fetch_array($run)){
				$company_name_id=$row['company_name_id'];
				$company_name=$row['company_name'];
				$serial_no++;
				?>		
				
				<tr align='center'>				
				<th><?php echo $serial_no; ?></th>
				<th><a href='category_add.php?id=<?php echo $company_name_id; ?>'><?php echo $company_name; ?></a></th>
				<th><a href='company_name_delete.php?id=<?php echo $company_name_id; ?> '><button type="button" class="btn btn-default" onclick="return valid();">Delete</th>
	            </tr>
				<?php } ?>
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
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
 <?php include("../attachment/link_js.php")?>
</div>
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
</body>
</html>

<?php

	if(isset($_POST['add_company'])){
	$company_name = $_POST['company_name'];
	$company_name = ucfirst($company_name);
	
	$quer="insert into company_add(company_name,status,company_code)
    values('$company_name','Active','$company_code')";
	
    if(mysql_query($quer)){
	echo "<script>alert('Company Name Successfully Added');</script>";
    echo "<script>window.open('company_add.php','_self');</script>";
}
}

?>


