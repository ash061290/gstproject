<?php include("../../attachment/session.php")?>
<script>
    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: "../hospital_management/software/schedule/add_schedule_api.php",
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
				   get_content('schedule/add_schedule');
            }
			}
         });
      });
function get_doctor_detail(val){
	$("#doctor_name").val('Loading....');
$("#doctor_mobile").val('Loading....');
$("#department_name").val('Loading....');
$("#doctor_type").val('Loading....');
$("#doctor_designation").val('Loading....');
 $.ajax({
 type: 'post',
 url: '../hospital_management/software/schedule/ajax_get_doctor_details.php?doctor_id='+val,
 cache: false,
  success: function(detail){            
   var res=detail.split('|?|');
$("#doctor_name").val(res[1]);
$("#doctor_mobile").val(res[2]);
$("#department_name").val(res[3]);
$("#doctor_type").val(res[4]);
$("#doctor_designation").val(res[5]);
              }
           });
}
    
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script> 
 
 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	<small></small></h1>
  <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>Home</a></li>
  <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-graduation-cap"></i> </a></li>
  <li class="active"></li>
  </ol>
</section>

    <!-- Main content -->
<section class="content">
      <!-- Small boxes (Stat box) -->
    <div class="row">
	       <!-- general form elements disabled -->
        <div class="box box-primary my_border_top">
            <!--<div class="box-header with-border ">
            </div> -->

		<div class="box-body">
			<form method="post" enctype="multipart/form-data" action="" id="my_form">
				<div class="box-body ">
					<center><h4 style="color:#d9534f;"><b></b></h4></center>
				
					<div class="col-md-4 ">
					
							<div class="form-group">
								<label><font style="color:red"><b>*</b></font></label>
					<select name="doctor_id" class="form-control select2" onchange="get_doctor_detail(this.value);" required>
					  <option value="">select</option>
					        
							<option value=""></option>
							
					  </select>
						
						</div>
						</div>
					
						<div class="col-md-4 ">
							<div class="form-group">
								<label><font style="color:red"><b>*</b></font></label>
								<input type="text" name="doctor_name" id="doctor_name" placeholder="" value="" class="form-control">
							</div>
						</div>
						<div class="col-md-4 ">
							<div class="form-group">
								<label><font style="color:red"><b>*</b></font></label>
								<input type="number" name="doctor_mobile" id="doctor_mobile"  value="" class="form-control">
							</div>
						</div>
						<div class="col-md-4 ">
							<div class="form-group">
								<label><font style="color:red"><b>*</b></font></label>
								<input type="text" name="department_name" id="department_name"  value="" class="form-control">
							</div>
						</div>
						<div class="col-md-4 ">
							<div class="form-group">
								<label><font style="color:red"><b>*</b></font></label>
								<input type="text" name="doctor_type" id="doctor_type" value="" class="form-control">
							</div>
						</div>
						<div class="col-md-4 ">
							<div class="form-group">
								<label><font style="color:red"><b>*</b></font></label>
								<input type="text" name="doctor_designation" id="doctor_designation"  value="" class="form-control">
							</div>
						</div>
						
						<div class="col-md-12 ">				
							<div class="form-group">
								<label></label><br>
							</div>
						</div>
					</div>
				
				<div class="box-body table-responsive">
					<div id="table" class="table table-bordered" style="background-color:white">
					<table id="example1" class="table table-bordered" style="background-color:white;">
						<thead class="my_background_color">
							<tr>
								<th rowspan="2">S.No.</th>
								<th rowspan="2">Days</th>
								<th colspan="2">Slot 1</th>
								<th colspan="2">Slot 2</th>
								<th colspan="2">Slot 3</th>
							</tr>
							<tr>
								<th>From</th>
								<th>To</th>
							     <th>From</th>
								<th>To</th>
								<th>From</th>
								<th>To</th>
							</tr>
						</thead>
						<tbody>
						<tr>
			<td>1</td>
			<td><input type="checkBox" name="monday_avail" id="monday_avail"> Monday</td>
            <td><input type="time" name="mon_slot1_from" id="meeting-time" /></td>
			<td><input type="time" name="mon_slot1_to" id="meeting-time" /></td>
			<td><input type="time" name="mon_slot2_from" id="meeting-time" /></td>
			<td><input type="time" name="mon_slot2_to" id="meeting-time" /></td>
			<td><input type="time" name="mon_slot3_from" id="meeting-time" /></td>
			<td><input type="time" name="mon_slot3_to" id="meeting-time" /></td>
						</tr>
						<tr>
			<td>2</td>
			<td><input type="checkBox" name="tuesday_avail" id="tuesday_avail">Tuesday</td>
            <td><input type="time" name="tue_slot1_from" id="meeting-time" /></td>
			<td><input type="time" name="tue_slot1_to" id="meeting-time" /></td>
			<td><input type="time" name="tue_slot2_from" id="meeting-time" /></td>
			<td><input type="time" name="tue_slot2_to" id="meeting-time" /></td>
			<td><input type="time" name="tue_slot3_from" id="meeting-time" /></td>
			<td><input type="time" name="tue_slot3_to" id="meeting-time" /></td>
						</tr>
						<tr>
			<td>3</td>
			<td><input type="checkBox" name="wednesday_avail" id="wednesday_avail">Wednesday</td>
            <td><input type="time" name="wed_slot1_from" id="meeting-time" /></td>
			<td><input type="time" name="wed_slot1_to" id="meeting-time" /></td>
			<td><input type="time" name="wed_slot2_from" id="meeting-time" /></td>
			<td><input type="time" name="wed_slot2_to" id="meeting-time" /></td>
			<td><input type="time" name="wed_slot3_from" id="meeting-time" /></td>
			<td><input type="time" name="wed_slot3_to" id="meeting-time" /></td>
						</tr>
						<tr>
			<td>4</td>
			<td><input type="checkBox" name="thursday_avail" id="thursday_avail">Thursday</td>
            <td><input type="time" name="thu_slot1_from" id="meeting-time" /></td>
			<td><input type="time" name="thu_slot1_to" id="meeting-time" /></td>
			<td><input type="time" name="thu_slot2_from" id="meeting-time" /></td>
			<td><input type="time" name="thu_slot2_to" id="meeting-time" /></td>
			<td><input type="time" name="thu_slot3_from" id="meeting-time" /></td>
			<td><input type="time" name="thu_slot3_to" id="meeting-time" /></td>
						</tr>
						<tr>
			<td>5</td>
			<td><input type="checkBox" name="friday_avail" id="friday_avail">Friday</td>
            <td><input type="time" name="fri_slot1_from" id="meeting-time" /></td>
			<td><input type="time" name="fri_slot1_to" id="meeting-time" /></td>
			<td><input type="time" name="fri_slot2_from" id="meeting-time" /></td>
			<td><input type="time" name="fri_slot2_to" id="meeting-time" /></td>
			<td><input type="time" name="fri_slot3_from" id="meeting-time" /></td>
			<td><input type="time" name="fri_slot3_to" id="meeting-time" /></td>
						</tr>
						<tr>
			<td>6</td>
			<td><input type="checkBox" name="saturday_avail" id="saturday_avail">Saturday</td>
            <td><input type="time" name="sat_slot1_from" id="meeting-time" /></td>
			<td><input type="time" name="sat_slot1_to" id="meeting-time" /></td>
			<td><input type="time" name="sat_slot2_from" id="meeting-time" /></td>
			<td><input type="time" name="sat_slot2_to" id="meeting-time" /></td>
			<td><input type="time" name="sat_slot3_from" id="meeting-time" /></td>
			<td><input type="time" name="sat_slot3_to" id="meeting-time" /></td>
						</tr>
						<tr>
			<td>7</td>
			<td><input type="checkBox" name="sunday_avail" id="sunday_avail">Sunday</td>
            <td><input type="time" name="sun_slot1_from" id="meeting-time" /></td>
			<td><input type="time" name="sun_slot1_to" id="meeting-time" /></td>
			<td><input type="time" name="sun_slot2_from" id="meeting-time" /></td>
			<td><input type="time" name="sun_slot2_to" id="meeting-time" /></td>
			<td><input type="time" name="sun_slot3_from" id="meeting-time" /></td>
			<td><input type="time" name="sun_slot3_to" id="meeting-time" /></td>
						</tr>
						</tbody>
					</table>
					</div>
				</div>
				
				<div class="col-md-12">
					<center><input type="submit" name="finish" value="" class="btn  my_background_color" /></center>
				</div>
			</form>
	<!-------------------------End Registration Form---------------------------------->
	  <!-- /.box-body -->				
		</div>
        </div>
    </div>
</section>
