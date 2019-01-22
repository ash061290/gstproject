<?php  include("../../attachment/session.php"); ?>
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
$.ajax({
type: "POST",
url: software_link+"contact/contact_delete_api.php",
data: "id="+s_no,
cache: false,

success: function(detail){
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
 function for_print()
 {
	 var contact_type = $("#contact_type").val();
	 var business_type = $("#business_type").val();
	 $.ajax({
		     type: "POST",
			 url: software_link+"contact/ajax_contact_print_detail.php",
			 data:"contact_type="+contact_type+"&business_type="+business_type+"",
			 cache:false,
			 success: function(detail){
			    $('#sample_table').html(detail);
				 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
$('#printTable').print();
			  }
		 
	 })

 }
function exportTableToExcel(tableID, filename = ''){
	 var contact_type = $("#contact_type").val();
	 var business_type = $("#business_type").val();
	  $.ajax({
		     type: "POST",
			 url: software_link+"contact/ajax_contact_print_detail.php",
			 data:"contact_type="+contact_type+"&business_type="+business_type+"",
			 cache:false,
			 success: function(detail){
			    $('#sample_table').html(detail);
				 var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    // Create download link element
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        // Setting the file name
        downloadLink.download = filename;
        //triggering the function
        downloadLink.click();
    }
			  } 
	 })
}
</script>
<div id="sample_table" style="display:none;">
</div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			
			 <a><input type="button" name="pdf" value="Print Pdf" onclick="for_print()" class="btn btn-success"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a><input type="button" name="excel" value="Print Excel" onclick="exportTableToExcel('printTable', 'Contact Detail')" class="btn btn-success"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <a href="javascript:get_content('contact/contact')"><button style="float:right;" type="button" class="btn btn-success">+ Add New</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
				$val=" and contact_gst_treatment='$business_type' and company_code='$company_code'";
				}
				if($contact_type=='All-Contact'){
				$val1="";
				}else {
				$val1=" and contact_contact_type='$contact_type' and company_code='$company_code'";
				}
			    $que="select * from contact_master where contact_status='Active'$val$val1  ORDER BY s_no DESC";
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
				<th><a href="javascript:post_content('contact/contact_payment_details','id=<?php echo $s_no; ?>')" title="Details"><button class="btn btn-success">Payment Details</button></a></th>
				<th><a style="color:Green;" aria-hidden="true" class="fa fa-pencil" title="Edit" href="javascript:post_content('contact/contact_edit','id=<?php echo $s_no; ?>')"></a> &nbsp;&nbsp;&nbsp;&nbsp;<a style="color:Red;" aria-hidden="true" title="Delete" onclick="return myFunction()" class="fa fa-times" href='contact_delete.php?id=<?php echo $s_no; ?>'></a>	
				</th>
				</tr>
				<?php } } else {
				$que="select * from contact_master where contact_status='Active' and company_code='$company_code' ORDER BY s_no DESC";
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
				<th><a href="javascript:post_content('contact/contact_payment_details','id=<?php echo $s_no; ?>')" title="Details"><button class="btn btn-success">Payment Details</button></a></th>		
				<th>
					<a style="color:Green;" aria-hidden="true" class="fa fa-pencil" title="Edit" href="javascript:post_content('contact/contact_edit','id=<?php echo $s_no; ?>')"></a> &nbsp;&nbsp;&nbsp;&nbsp;<a style="color:Red;" aria-hidden="true" title="Delete" onclick = "valid('<?php echo $s_no;?>');" class="fa fa-times" href='#'></a>	
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

