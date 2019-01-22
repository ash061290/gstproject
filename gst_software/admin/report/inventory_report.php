<?php include("../../attachment/session.php"); ?>
<section class="content-header">
      <h1>
        Product List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('../../index')"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="javascript:get_content('inventory/items')"><i class="fa fa-plus"></i>Item Add</a></li>
        <li class="active">Inventory List</li>
      </ol>
    </section>
<script>
function valid(s_no){
 
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_item_list(s_no);

 }            
else  {      
return false;
 }
  } 
  function delete_item_list(s_no){  
$.ajax({
type: "POST",
url: software_link+"inventory/item_delete_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
    var res=detail.split("|?|");
         if(res[1]=='success'){
           alert('Successfully Deleted');
           get_content('inventory/item_list');
         }else{
               alert(detail); 
         }
}
});
}
</script>
<script>
function brand_all(value)
 {
  $.ajax({
    type:"POST",
    url:software_link+"report/ajax_item_brand.php",
    data:"brand_name="+value,
    success:function(detail){
		$("#categories").empty();
		$("#brands_").empty();
      $("#brands_").html(detail);
	  
    }
  }) 
 }
function brand_select(value)
 {
	 if(value==1){
	    brand_all(1);
	  }
	  else{
  $.ajax({
    type:"POST",
    url:software_link+"report/ajax_item_brand.php",
    data:"brand_name="+value,
    success:function(detail){
    var res = detail.split("|?|");
	  $("#category").html(res[0]);
	   $("#categories").empty();
      $("#brands_").html(res[1]);
    }
  });
	  }  
 }

 function category_select(value)
 {
 var brand = $("#brand_name").val();
  $.ajax({
    type:"POST",
    url:software_link+"report/ajax_item_category.php",
    data:"category_name="+value+"&brand_name="+brand+"",
    success:function(detail){
		$("#brands_").empty();
      $("#categories").html(detail);
    }

  })
 }
function for_print()
 {
    	 
	 
 var divToPrint=document.getElementById("example1");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
$('#example1').print();
 }
function exportTableToExcel(tableID, filename = ''){
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
//end
</script> 
<script type="text/javascript">
  $( document ).ready(function(e){
	  brand_all(1);
  });
</script>
<?php 
//excel code

//end
?>
<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
    <div class="col-xs-12">
    <div class="box my_border_top">
        <div class="box-body">
    <div class="col-md-3">
    <div class="form-group">
  <label>Brand Wise</label>
      <select class="form-control select2" name="brand_name" id="brand_name" style="width:100%" onchange="brand_select(this.value)" required="true">
          <option value="1">All Brand</option>        
            <?php
              $que="select * from brand_add where company_code='$company_code'";
              $run=mysql_query($que) or die(mysql_error());
                while($row=mysql_fetch_array($run)){
                    $brand_name = $row['brand_name']; ?>
               <option value="<?php echo $brand_name; ?>" ><?php echo $brand_name; ?>
               </option>
                <?php } ?>
      </select>
 </div>
</div>  

  <div class="col-md-3">
 <div class="form-group" >
  <label>Category Wise</label>
      <select class="form-control select2" name="brand_name" id="category" style="width:100%" onchange="category_select(this.value)" required="true">
      </select>
 </div>
</div>
<div class="col-md-3"></div>
<div class="col-md-3">
   <div class="col-md-5"><button onclick="for_print()" class="btn btn-success">Print PDF</button></div>
   <div class="col-md-1"></div>
   <div class="col-md-5"><button id="print_excel"  onclick="exportTableToExcel('example1', 'Inventory Report')" class="btn btn-success">Print Excel</button></div>
   <div class="col-md-1"></div>
 </div>
    <div class="row">
        <div class="col-sm-12"> 
          <div class="box">
             <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered" border="1px" cellpadding="0" cellspacing="0">
                <thead class="my_background_color">
                <tr>
                  <th style="align:center; width:5%;">S.No</th>
                  <th style="align:center; width:22%;">PRODUCT NAME</th>
                  <th style="align:center; width:12%;">DATE</th>
                  <th style="align:center; width:12%;">PURCHASE PRICE</th>
                  <th style="align:center; width:12%;">SALE PRICE</th>
                  <th style="align:center; width:12%;">QUANTITY</th>
                  <th style="align:center; width:14%;">CATEGORY</th>
                  <th style="align:center; width:14%;">SUB CATEGORY</th>
                </tr>
                </thead>
        <tbody id="brands_" class="headerTable">

            </tbody>
        <tbody id="categories" class="headerTable">

        </tbody>
             </table>
            </div>
          </div>
       </div>
     </div>
 <form role="form" id="my_form" enctype="multipart/form-data">
    <div class="box-body table-responsive" id="my_table1"></div>
 </form>
    </div>      
  </div>
    </div>
  </div>
</section>
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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>