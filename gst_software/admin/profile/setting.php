<?php include("../../attachment/session.php");
	 include("../../attachment/classes/firm_detail.php");
	$new = new firm_detail();
    ?>
    <section class="content-header">
      <h1>
        Profile Detail
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
		<?php if(isset($_GET['firm_id'])){
         $id = $_GET['firm_id'];
      	  ?>
        <li><a href="javascript:post_content('profile/new_user','firm_id=<?php echo $id; ?>')"><i class="fa fa-plus"></i>Add New User</a></li> 
		<?php } ?>
        <li class="active">Bank Details</li>
      </ol>
    </section>
<script type="text/javascript">
 function status_change(value){
       $.ajax({
			  type: "POST",
              url: software_link+"profile/ajax_company_status.php",
			  data: "firm_id="+value,
              cache: false,
              success: function(detail){
           if(detail==1){
			              get_content('profile/setting');
						  }
              }
           });
 }
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
function delete_data(value)
{
	 var del = confirm('Do U Want Delete');
	 if(del == true)
	 {
		  $.ajax({
			     type:"POST",
				 url: software_link+"profile/ajax_company_status.php",
				 data:"delete_id="+value,
				 success:function(detail)
				 {
					 if(detail==1)
					 {
						 get_content('profile/setting');
					 }
				 }
			  
		  })
	 }
}
function company_user_status(value)
{
	$.ajax({
		         type:"POST",
				 url: software_link+"profile/ajax_company_status.php",
				 data:"user_id="+value,
				 success:function(detail)
				 {
					 if(detail==1)
					 {
					    get_content('profile/setting');
					 }
				 }
	})   
}
function user_delete(value)
{
	  var val1=confirm('Do You Want Delete...');
	  if(val1 == true)
	  {
		  $.ajax({
			   type:"POST",
			   url: software_link+"profile/ajax_company_status.php",
			   data:"user_delete="+value,
			   success:function(detail){
			        if(detail==1)
					{
						 get_content('profile/setting');
					}
			   }
		  })
	  }
}
</script>
    <!-- Main content -->
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
				<?php if(!isset($_GET['firm_id'])){ ?>
			  <a href="javascript:get_content('profile/new_profile')"><button style="float:right;" type="button" class="btn my_background_color">+ Add New Oragnization</button></a>	
				<?php } ?>
<?php if(isset($_GET['firm_id'])){
         $id = $_GET['firm_id'];
          $select_user = $new->company_user($id);
      	  ?>
			  <a href="javascript:post_content('profile/new_user','firm_id=<?php echo $id; ?>')"><button style="float:right;" type="button" class="btn btn-success">+ Add New User</button></a>	
				<?php } ?>				
			</div>			
			</div>	
<hr/>			
            <!-- /.box-header -->
            <div class="box-body">
               <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="panel-heading" style="background-color:#00a65a; color:#fff">
						<?php if(isset($id)){ $result = $new->company_name($id); ?>
						<strong style="font-size:15px;"><?php echo $result; } 
						else echo "<strong style='font-size:15px;'>Oragnization Details"; ?></strong>
                        </div>
                        <!-- /.panel-heading -->
                         <div class="box-body table-responsive">
			
              <table id="example1" class="table table-bordered table-striped table-responsive">
			  <?php if(!isset($_GET['firm_id'])){ ?>
                <thead class="my_background_color">
                <tr>
				  <th>S_No</th>
                  <th>Firm Name</th>
                  <th>Admin Name</th>
                  <th>Contact No</th>
				  <th>Firm Email</th>
                  <th>Gst Type</th>
				  <th>Address</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
				
			<tbody id="search_table">
			    <?php 
					  $company_row = $new->company_detail();
					  if($company_row){
						$serial_no=0;
						foreach($company_row as $data){ 
                        $serial_no = $serial_no+1;						
					?>
				<tr  align='center' >
				 <th><?php echo $serial_no; ?></th>
				<th><a href="javascript:post_content('profile/setting','firm_id=<?php echo $data['id']; ?>')"><?php echo $data['firm_name']; ?></a></th>
				<th><?php echo $data['admin_name']; ?></th>
				<th><?php echo $data['firm_contact']; ?></th>
				<th><?php echo $data['firm_email']; ?></th>		
				<th><?php echo $data['firm_gst_type']; ?></th>	
				<th><?php echo $data['firm_address']; ?></th>	
				<th>
			      <a href='#' style="<?php if($data['firm_status'] == "Active") echo "color:green"; else echo "color:red"; ?>" onclick="status_change('<?php echo $data['id']; ?>')">
				   <?php if($data['firm_status'] == "Active"){ echo "<i class='fa fa-check' style='color:green;'></i>"; }
                    else{ echo "<i class='fa fa-times' style='color:red;'></i>";}				   ?>
				<?php echo $data['firm_status']; ?></a> &nbsp;&nbsp;&nbsp;
				 <a href="javascript:post_content('profile/company_edit','id=<?php echo $data['id']; ?>')"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;&nbsp;
                <a href="#" onclick="delete_data('<?php echo $data['id']; ?>')"><i class="fa fa-trash"></i></a>
               				
				</th>
				</tr>
				<?php } } ?>
			</tbody>
				<?php } if(isset($_GET['firm_id'])){ ?>
				 <thead class="my_background_color">
                <tr>
				  <th>S_No</th>
                  <th>User Image</th>
                  <th>User Name</th>
                  <th>User Mobile</th>
                  <th>User Email</th>
				   <th>Address</th>
				  <th>Permission</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
			<tbody id="search_table">
			    <?php 
					  $company_row = $new->company_user($id);
					  if($company_row){
						$serial_no=0;
						foreach($company_row as $data){ 
                        $serial_no = $serial_no+1;	
						if($data['user_permission'] !='All'){
                        $user_permission = json_decode($data['user_permission']);
						$user_permission = implode(",",$user_permission); }
						else{ $user_permission == $data['user_permission']; }
                        						
					?>
				<tr  align='center' >
				 <th><?php echo $serial_no; ?></th>
				<th><a href="javascript:post_content('profile/setting','firm_id=<?php echo $data['user_id']; ?>')"><image src="data:image/jpeg;base64,<?php echo $data['upload_file']; ?>" width="40px" height="40px" /></a></th>
				<th><?php echo $data['user_name']; ?></th>
				<th><?php echo $data['user_mobile']; ?></th>
				<th><?php echo $data['user_email']; ?></th>		
				<th><?php echo $data['user_address']; ?></th>
				<th><?php echo $user_permission; ?></th>		
				<th><a style="color:Green;" href='#' onclick="company_user_status('<?php echo $data['user_id']; ?>')"><?php echo $data['status']; ?></a> &nbsp;&nbsp;&nbsp;&nbsp;
				<a style="color:Green;" href='user_edit.php?user_id=<?php echo $data['user_id']; ?>&firm_id=<?php echo $id; ?>'><i class="fa fa-edit"></i></a>
                &nbsp;&nbsp;&nbsp;&nbsp;
            <a style="color:Green;" onclick ="user_delete('<?php echo $data['user_id']; ?>')" href='#'>
			 <i class="fa fa-trash"></i></a>				
				</th>
				</tr>
				<?php } } ?>
			</tbody>
				<?php } ?>
             </table>
            </div>
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
