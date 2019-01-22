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
	 var from_date = $("#from_date").val();
	 var to_date = $("#to_date").val();
	 $.ajax({
		     type: "POST",
			 url: software_link+"contact/ajax_customer_print.php?from_date="+from_date+"&to_date="+to_date+"",
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
	 var from_date = $("#from_date").val();
	 var to_date = $("#to_date").val();
	  $.ajax({
		     type: "POST",
			 url: software_link+"contact/ajax_customer_print.php?from_date="+from_date+"&to_date="+to_date+"",
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
function for_income_ledger(){
	   var s_no = $("#c_id").val();
	   var date = new Date();
       var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
       var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0); 
	   var day_from = firstDay.getDate();
	   var day_from = "0"+day_from;
	   var month_from = firstDay.getMonth()+1;
	   var year_from = firstDay.getFullYear();
	   var day_to = lastDay.getDate();
	   var month_to = lastDay.getMonth()+1;
	   var year_to = lastDay.getFullYear();
	   var firstday = year_from+"-"+month_from+"-"+day_from;
	   var lastday = year_to+"-"+month_to+"-"+day_to;
	    $("#from_date").val(firstday);
	    $("#to_date").val(lastday);
		var from_date =  $("#from_date").val();
		var to_date   =  $("#to_date").val();
		  $.ajax({
		   method:"POST",
		   url:software_link+"contact/ajax_customer_detail.php",
		   data:"from_date="+from_date+"&to_date="+to_date,
		   success:function(detail){
		    $("#search_table").html(detail);
		   }
	   })
}
function check_date_wise()
{
	   var from_date = $("#from_date").val();
	   var to_date = $("#to_date").val();
	 
	  $.ajax({
		   method:"POST",
		   url:software_link+"contact/ajax_customer_payment_detail.php",
		   data:"from_date="+from_date+"&to_date="+to_date,
		   success:function(detail){
			
		    $("#sample1").html(detail);
		   }
	   })
}
$(document).ready(function(e){
	for_income_ledger();
}); 
</script>
<div id="sample_table" style="display:none;">
</div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			
			 <a><input type="button" name="pdf" value="Print Pdf" onclick="for_print()" class="btn btn-success"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a><input type="button" name="excel" value="Print Excel" onclick="exportTableToExcel('printTable', 'Regular_Customer')" class="btn btn-success"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  
				<div class="col-md-3">
				<input type="date" name="form_date" class="form-control" id="from_date" value="" onchange="check_date_wise();" />
				</div>
                <div class="col-md-3">
				<input type="date" name="to_date" class="form-control" id="to_date" value="" onchange="check_date_wise();" />
				<option></option>
				</select>
				
				</div>
				
			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="btn-success">
                <tr>
				  <th>S_No</th>
				  <th>Date</th>
				  <th>Customer_id</th>
                  <th>Customer Name</th>
                  <th>Customer Mobile</th>
				  <th><center>Detail</center></th>
				  <th>Action</th>
                </tr>
                </thead>
			<tbody id="search_table">
			   
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

