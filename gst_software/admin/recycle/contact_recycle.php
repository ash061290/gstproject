<?php 
include("../../attachment/session.php");

?>
    <section class="content-header">
      <h1>
        All Contacts
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="javascript:get_content('contact/contact')"><i class="fa fa-plus"></i>New Contact</a></li>
        <li class="active">Contact List</li>
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
              url: software_link+"contact/ajax_contact_search.php?contact_type="+contact_type1+"&business_type="+business_type1+"",
              cache: false,
			  success: function(detail){
			  $('#search_table').html(detail);
			  }
           });
	}
</script>
<script>
function valid(s_no){  
 
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_contact_list(s_no);
 }            
else  {      
return false;
 }       
  } 
function delete_contact_list(s_no){  
	//alert(s_no);
$.ajax({
type: "POST",
url: software_link+"recycle/contact_permanent_delete_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
	alert(detail);
    var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Deleted');
           get_content('contact/contact_list');
         }else{
               alert(detail); 
         }
}
});
}
</script>
<script>
function restore(s_no){ 
//alert(s_no);
var myval=confirm("Are you sure want to restore this record !!!!");
if(myval==true){
restore_contact_list(s_no);       
 }            
else  {      
return false;
  }       
} 
  function restore_contact_list(s_no){
$.ajax({
type: "POST",
url: software_link+"recycle/restore_contact_list_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
	//alert(detail);
    var res=detail.split("|?|");
         if(res[1]=='success'){
             alert('Successfully Restore');
           get_content('contact/contact_list');
         }else{
               alert(detail); 
         }
}
});
}
</script>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
				<div class="col-md-3">
				<select class="form-control" name="" id="contact_type" onchange="for_contact(this.id,this.value);">
				<?php 
					if(isset($_GET['contact_type'])){
					$contact_type=$_GET['contact_type'];
					$business_type=$_GET['business_type'];
					?>
					<option value="<?php echo $contact_type; ?>" ><?php echo $contact_type; ?></option>
					<?php } else { ?>
					<option value="All-Contact">All-Contact</option>
					<?php } ?>
				<option value="All-Contact">All-Contact</option>	
				<option value="Vendor">Vendor</option>
				<option value="Customer">Customer</option>			  
				</select>
				</div>
                <div class="col-md-3">
				<select class="form-control" name="" id="business_type" onchange="for_contact(this.id,this.value);">
				<?php 
					if(isset($_GET['contact_type'])){
					$contact_type=$_GET['contact_type'];
					$business_type=$_GET['business_type'];
					?>
					<option value="<?php echo $business_type; ?>" ><?php echo $business_type; ?></option>
					<?php } else { ?>
					<option value="All-Business-Type">All-Business-Type</option>
					<?php } ?>
				<option value="All-Business-Type">All-Business-Type</option>	
				<option value="Registered-Business-Regular">Registered-Business-Regular</option>
				<option value="Registered-Business-Composition">Registered-Business-Composition</option>
				<option value="Unregistered-Business">Unregistered-Business</option>
				<option value="Customer">Customer</option>
				<option value="Overseas">Overseas</option>
				<option value="Special-Economic-Zone">Special-Economic-Zone</option>		  
				</select>
				</div>				
			</div>
			
			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
				<th>S_No</th>
                  <th>Name</th>
                  <th>Company Name</th>
                  <th>Contact</th>
                  <th>Email</th>
				  <th>GST Treatment Type</th>
				  <th>Payment Details</th>
				  <th><center>Action</center></th>
                </tr>
                </thead>
			<tbody id="search_table">
			    <?php 
					if(isset($_GET['contact_type'])){
					$contact_type=$_GET['contact_type'];
					$business_type=$_GET['business_type'];
					
				
				if($business_type=='All-Business-Type'){
				$val="";
				}else {
				$val=" and contact_gst_treatment='$business_type'";
				}
				if($contact_type=='All-Contact'){
				$val1="";
				}else {
				$val1=" and contact_contact_type='$contact_type'";
				}
			    $que="select * from contact_master where contact_status='Deleted'$val$val1 and company_code='$company_code'  ORDER BY s_no DESC";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;	
				while($row=mysql_fetch_array($run)){
					$s_no=$row['s_no'];
					$contact_tittle_name=$row['contact_tittle_name'];
					$contact_first_name=$row['contact_first_name'];
					$contact_last_name=$row['contact_last_name'];
					$contact_company_name=$row['contact_company_name'];
					$contact_contact_phone=$row['contact_contact_phone'];
					$contact_email=$row['contact_email'];
					$contact_gstin=$row['contact_gstin'];					
					$contact_contact_type=$row['contact_contact_type'];	
					$contact_gst_treatment=$row['contact_gst_treatment'];	
					$serial_no++;				
				?>

				<tr  align='center' >
				 <th><?php echo $serial_no; ?></th>
				<th><?php echo $contact_tittle_name ."     ".$contact_first_name ."     ".$contact_last_name; ?></th>
				<th><?php echo $contact_company_name; ?></th>
				<th><?php echo $contact_contact_phone; ?></th>
				<th><?php echo $contact_email; ?></th>		
				<th><?php echo $contact_gst_treatment; ?></th>	
				<th><a href="javascript:post_content('contact/contact_payment_details','id=<?php echo $s_no; ?>')" title="Details"><button class="btn btn-success">Payment Details</button></a>  </th>
				<th>
					<a href="#" onclick="restore('<?php echo $s_no;?>');" style="color:bule;" aria-hidden="true" class="fa fa-undo"></a> &nbsp;&nbsp;&nbsp;
                   <a href="#" onclick="valid('<?php echo $s_no;?>');" style="color:Red;" aria-hidden="true" class="fa fa-trash-o"></a> &nbsp;&nbsp;&nbsp;
				</th>
				</tr>
				<?php } } else {
				$que="select * from contact_master where contact_status='Deleted' and company_code='$company_code' ORDER BY s_no DESC";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;	
				while($row=mysql_fetch_array($run)){
					$s_no=$row['s_no'];
					$contact_tittle_name=$row['contact_tittle_name'];
					$contact_first_name=$row['contact_first_name'];
					$contact_last_name=$row['contact_last_name'];
					$contact_company_name=$row['contact_company_name'];
					$contact_contact_phone=$row['contact_contact_phone'];
					$contact_email=$row['contact_email'];
					$contact_gstin=$row['contact_gstin'];					
					$contact_contact_type=$row['contact_contact_type'];					
					$contact_gst_treatment=$row['contact_gst_treatment'];					
					$serial_no++;				
				?>

				<tr  align='center' >
			    <th><?php echo $serial_no; ?></th>
				<th><?php echo $contact_tittle_name ."     ".$contact_first_name ."     ".$contact_last_name; ?></th>
				<th><?php echo $contact_company_name; ?></th>
				<th><?php echo $contact_contact_phone; ?></th>
				<th><?php echo $contact_email; ?></th>
				<th><?php echo $contact_gst_treatment; ?></th>	
				<th><a href="javascript:post_content('contact/contact_payment_details','id=<?php echo $s_no; ?>')" title="Details"><button class="btn btn-success">Payment Details</button></a>  </th>		
				<th>
				<a href="#" onclick="restore('<?php echo $s_no;?>');" style="color:bule;" aria-hidden="true" class="fa fa-undo"></a> &nbsp;&nbsp;&nbsp;
                   <a href="#" onclick="valid('<?php echo $s_no;?>');" style="color:Red;" aria-hidden="true" class="fa fa-trash-o"></a> &nbsp;&nbsp;&nbsp;	
				</th>
				</tr>
				<?php } }?>
			</tbody>
            
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      </div>
	  </div>
    </section>

<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>

