<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("link_css.php")?>

</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">


  
  <?php include("../attachment/header.php")?>
  <?php include("../attachment/sidebar.php")?>

  
<script type="text/javascript">
function for_filter(value){
	  $.ajax({
			  type: "POST",
              url: "get_item_dropdown.php?item_sub_group="+value+"",
              cache: false,
              success: function(detail){
                  $("#item_group").html(detail);
              }
           });
	}
			
function for_list(value){
	var item_sub_group=document.getElementById('item_sub_group').value;
	  $.ajax({
			  type: "POST",
              url: "get_item_list.php?item_group="+value+"&item_sub_group="+item_sub_group+"",
              cache: false,
              success: function(detail){
                  $("#sorted_list").html(detail);
              }
           });
	}
			
function for_all_list(value){
	  $.ajax({
			  type: "POST",
              url: "get_item_all_list.php?item_sub_group="+value+"",
              cache: false,
              success: function(detail){
                  $("#sorted_list").html(detail);
              }
           });
			}
</script>
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item Group List
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form method='post' enctype="multipart/form-data">
			<div class="col-md-12" >
			<div class="col-md-12" >
			 <div class="col-md-6 ">	
					<div class="form-group" >
					   <label>Select Product Type</label>
					   <select name="item_sub_group" onchange="for_filter(this.value); for_all_list(this.value);" id="item_sub_group" class="form-control" required>
						<option value="">Select</option>
						<?php
							include("../../connection/connect.php");
							$query="select * from item_master where item_status='Active' GROUP BY item_sub_group";
							$res=mysql_query($query);
							while($row=mysql_fetch_array($res)){
							$s_no=$row['s_no'];
							$item_sub_group=$row['item_sub_group'];
							?>
							<option value="<?php echo $item_sub_group; ?>"><?php echo $item_sub_group; ?></option>
							<?php
							}
							?>		  
					    </select>
						
					</div>
				</div>
			<div class="col-md-6 " id="item_group" style="">	
					
			</div>
				
			</div>
			
			<div class="col-md-12" id="sorted_list" >
			  
				 	
			</div>	
			
			
			</div>

		<a href='item_group.php'> <button style="float:right; background-color:#00a65a" type="button" class="btn btn-primary">+ Add New</button></a> 
			
		</form>	
		
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("link_js.php")?>
</body>
</html>
				
<?php


	if(isset($_POST['submit'])){
	
echo	$student_class=$_POST['student_class'];
	$filter_type1=$_POST['filter_type'];
	$filter_name1=$_POST['filter_name'];
	$student_class_section=$_POST['student_class_section'];
	echo "<script>window.open('../pdf/student_list_pdf.php?class=$student_class&section=$student_class_section&filter_type=$filter_type1&filter_name=$filter_name1','_blank');</script>";
		
}
