<?php 
include("../../attachment/session.php");
include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
    ?>
    <section class="content-header">
      <h1>
        Profile Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascripr:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <!--<li><a href="javascript:get_content('profile/new_profile')"><i class="fa fa-plus"></i>Add Bank Or Card</a></li>-->
        <li class="active">Bank Details</li>
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
              url: software_link+"profile/ajax_contact_search.php?contact_type="+contact_type1+"&business_type="+business_type1+"",
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
<script type="text/javascript">
$("#warehouse_form").submit(function(e){
	alert('axaa');
        e.preventDefault();
    var formdata = new FormData(this);
	alert(formdata);
        $.ajax({
            url: software_link+"profile/warehouse_api.php",
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
				   var res[3]="";
				  // post_content('profile/warehouse_setting',res[3]);
            }
			}
         });
      });
	
</script>

    <!-- Main content -->
	<!-- Modal -->
	
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Warehouse Details</h4>
        </div>
        <div class="modal-body">
         <form method="post" id="warehouse_form">
       <div class="form-group">
      <label for="warehouse">Warehouse Name :</label>
      <input type="text" class="form-control" id="warehouse_name" placeholder="Warehouse Name" name="warehouse_name">
    </div>
    <div class="form-group">
      <label for="pwd">State :</label>
     <select class="form-control select2" name="warehouse_state" id="invoice_place_of_supply" style="width:100%">
					        <option value="">Select</option>
					        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
							<option value="Andhra Pradesh">Andhra Pradesh</option>
							<option value="Assam">Assam</option>
							<option value="Bihar">Bihar</option>
							<option value="Chandigarh">Chandigarh</option>
							<option value="Chattisgarh">Chattisgarh</option>
							<option value="Dadra Nagar Haveli">Dadra Nagar Haveli</option>
							<option value="Daman and Diu">Daman and Diu</option>
							<option value="Delhi">Delhi</option>
							<option value="Goa">Goa</option>
							<option value="Gujrat">Gujrat</option>
							<option value="Haryana">Haryana</option>
							<option value="Himachal Pradesh">Himachal Pradesh</option>
							<option value="Jammu & Kashmir">Jammu & Kashmir</option>
							<option value="Karnataka">Karnataka</option>
							<option value="Kerala">Kerala</option>
							<option value="Lakshadweep">Lakshadweep</option>
							<option value="Madhya Pradesh">Madhya Pradesh</option>
							<option value="Maharashtra">Maharashtra</option>
							<option value="Manipur">Manipur</option>
							<option value="Meghalaya">Meghalaya</option>
							<option value="Mizoram">Mizoram</option>
							<option value="Nagaland">Nagaland</option>
							<option value="Orissa">Orissa</option>
							<option value="Outside India">Outside India</option>
							<option value="Pondicherry">Pondicherry</option>
							<option value="Punjab">Punjab</option>
							<option value="Rajasthan">Rajasthan</option>
							<option value="Sikkim">Sikkim</option>
							<option value="Tamil Nadu">Tamil Nadu</option>
							<option value="Telangana">Telangana</option>
							<option value="Tripura">Tripura</option>
							<option value="Uttar Pradesh">Uttar Pradesh</option>
							<option value="Uttarakhand">Uttarakhand</option>
							<option value="West Bengal">West Bengal</option>
					  </select>
    </div>
    <div class="form-group">
      <label for="warehouse">City Name :</label>
      <input type="text" class="form-control" id="city_name" placeholder="City Name" name="city_name">
    </div>
	 <div class="form-group">
      <label for="warehouse">Zip Code :</label>
      <input type="text" class="form-control" id="zip_name" placeholder="Zip Code" name="zip_code">
    </div>
	 <div class="form-group">
      <label for="warehouse">Phone Num :</label>
      <input type="text" class="form-control" id="phone_num" placeholder="Phone Num" name="phone_num">
    </div>
	 <div class="form-group">
      <label for="warehouse">Address :</label>
       <textarea class="form-control" name="address" cols="4" rows="6"></textarea>
    </div>
	<!--<input type="submit" class="btn btn-success" name="submit" value="Submit" />-->
	 <div class="modal-footer">
          <button class="btn btn-success" value="Submit"></button>
        </div>
       </form> 
        </div>
       
      </div>
      
    </div>
  </div>
  
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
                <div class="col-sm-12">		
				<div class="col-sm-9">
			    </div>
				<div class="col-sm-3">
			  <a><button style="float:right;" type="button" class="btn my_background_color" data-toggle="modal" data-target="#myModal3">+ Add New</button></a>				
			</div>			
			</div>			
            <!-- /.box-header -->
            <div class="box-body">
			
               <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <strong style="font-size:15px;">Profile Information</strong>
						 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" style="font-size:15px;">Warehouses Info</a>
                                </li>
                                <li><a href="#security" data-toggle="tab" style="font-size:15px;">Security</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab" style="font-size:15px;">Users</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <h4>Warehouses Details</h4>
               <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead class="my_background_color">
                <tr>
				  <th>Date</th>
                  <th>Warehouse Name</th>
                  <th>Address</th>
				  <th>Phone</th>
				  <th>Acton</th>
                </tr>
                </thead>
            <tbody>
			     <?php $row = $new->company_warehouse_detail();
				 if($row){
                         foreach($row as $row2)
						 {						 ?>
				<tr align='center'>
				<th><?php echo $row2['date2'];	?></th>
				<th>
				<a href="javascript:get_content('profile/view_warehouse')">
				   <?php echo $row2['warehouse_name']; ?></a>
				</th>
				<th><?php echo $row2['address'];  ?></th>
				<th><?php echo $row2['phone']; ?></th>		
					
				<th>
				<center>
				<a href="javascript:get_content('profile/status')"><?php if($row2['status']=='Active')echo 'Active'; else echo 'Inactive'; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:post_content('profile/warehouse_edit','id=<?php echo $row2['id'] ?>')"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    <a href="delete.php"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;	
                 </center>				
				</th>
				</tr>
				 <?php } } ?>
			</tbody>
             </table>
            </div>
                                </div>
								<!-- security -->
                                <div class="tab-pane fade" id="security">
                           <h4>Session Activity</h4>
                                   <div class="box-body">
				   <div class="col-md-12">
				   <form role="form" method="post">
				   <div class="col-md-4">
				    <h4>Active Session</h4>
                <div class="form-group">
                  <label>Session Status&nbsp; : &nbsp;  
				   </label>Active<br/><br/>
				   <label>Session Active Date Time&nbsp; : &nbsp;  
				   </label>19-09-19<br/><br/>
                </div>
				 </div>
				 </form>
				 
				<form method="post">
				<div class="col-md-4" >
				<h4>Login History</h4>
                <div class="form-group">
				  <label> Login Ip address :</label> <br/><br/>
				  <label> Login Date Time :</label>
                </div>
				<br/>
				<br/>
				</div>
				</form>
				<form method="post">
				<div class="col-md-4" >
				<h4>Activity History</h4>
                <div class="form-group">
				  <label> Session Time Count :</label> <br/><br/>
				  <label> Other Activity :</label>
                </div>
				<br/>
				<br/>
				</div>
				</form>
				 </div>
              </div>
                                </div>
                                <div class="tab-pane fade" id="messages"> 
                                </div>
                               <!-- <div class="tab-pane fade" id="settings">
                                    <h4>Settings Tab</h4>
                                    <p>ashish4</p>
                                </div> -->
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
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
  </div>
  
<script src="select2.full.min.js"></script>
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
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
