<?php include("../../attachment/session.php"); 
    $today=date('Y-m-d');
    $current_month2=date('m');
	$current_year=date('Y');
	$current_date=date('d');
?>
    <section class="content-header">
      <h1>
        Sales Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
      </ol>
    </section>
<script type="text/javascript">
      function for_income_ledger(id){ 
	  if(id=="date_wise"){
	  var from_date= document.getElementById('from_date').value;
	  var to_date= document.getElementById('to_date').value;
	   if ((Date.parse(from_date) >= Date.parse(to_date))) {
        alert("End date should be greater than Start date");
        document.getElementById('to_date').value = "";
		return false;
    }
	   $.ajax({
			  type: "POST",
              url: software_link+"report/Sales_date_ajax.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table1').html(detail);
              }
           });

	  }
	  	  if(id=="month_wise"){
	  var current_month= document.getElementById('ledger_month_wise').value;
	  var current_year= document.getElementById('ledger_year_wise').value;
	  if(current_month=="01" || current_month=="03" || current_month=="05" || current_month=="07" || current_month=="08" || current_month=="10" ||current_month=="12"){
	  var last_day="31";
	  }else if(current_month=="04" || current_month=="06" || current_month=="09" || current_month=="11"){
	  var last_day="30";
	  }else if(current_month=="02"){
	  	  var last_day="28";
	  if(current_year=="2020" || current_year=="2024" || current_year=="2028" || current_year=="2032" || current_year=="2036"){
	  var last_day="29";
	  }
	  }
	  if(current_month =='all')
   {
    var from_date=current_year+'-01-01';
    var to_date=current_year+'-12-31';
      $.ajax({
			  type: "POST",
              url: software_link+"report/Sales_year_ajax.php?current_year="+current_year+"&from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table1').html(detail);
              }
           });
   }
   else
   {
	  var from_date=current_year+'-'+current_month+'-01';
      var to_date=current_year+'-'+current_month+'-'+last_day;
    }
	   document.getElementById('from_date').value = from_date;
	   document.getElementById('to_date').value = to_date;
	  }
             $.ajax({
			  type: "POST",
              url: software_link+"report/Sales_year_ajax.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table1').html(detail);
              }
           });
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
</script>
<script type="text/javascript">
     $( document ).ready(function() {
	  for_income_ledger("month_wise");
	  //for_contact_area(value);
       });
</script>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	  <div class="col-xs-12">
    <div class="box my_border_top">
        <div class="box-body">
<div class="col-md-12">		
		<div class="col-md-2">
 <div class="form-group">
	<label><?php echo "Year Wise"; ?></label>
	  <select name="ledger_year" id="ledger_year_wise" onchange='for_income_ledger("month_wise");' class="form-control select2" style="width:100%;">
	  <option <?php if($current_year=='2017'){ echo "selected"; } ?>  value="2017">2017</option>
	  <option <?php if($current_year=='2018'){ echo "selected"; } ?>  value="2018">2018</option>
	  <option <?php if($current_year=='2019'){ echo "selected"; } ?> value="2019">2019</option>
	  <option <?php if($current_year=='2020'){ echo "selected"; } ?> value="2020">2020</option>
	  <option <?php if($current_year=='2021'){ echo "selected"; } ?> value="2021">2021</option>
	  <option <?php if($current_year=='2022'){ echo "selected"; } ?> value="2022">2022</option>
	  <option <?php if($current_year=='2023'){ echo "selected"; } ?> value="2023">2023</option>
	  <option <?php if($current_year=='2024'){ echo "selected"; } ?> value="2024">2024</option>
	  <option <?php if($current_year=='2025'){ echo "selected"; } ?> value="2025">2025</option>
	  <option <?php if($current_year=='2026'){ echo "selected"; } ?> value="2026">2026</option>
	  <option <?php if($current_year=='2027'){ echo "selected"; } ?> value="2027">2027</option>
	  <option <?php if($current_year=='2028'){ echo "selected"; } ?> value="2028">2028</option>
	  </select>
 </div>
</div>	

	<div class="col-md-2">
 <div class="form-group" >
	<label><?php echo "Month Wise"; ?></label>
	  <select name="ledger_month" id="ledger_month_wise" onchange='for_income_ledger("month_wise");' class="form-control select2" style="width:100%;">
	  <option value="all"><?php echo "All Month"; ?></option>
	  <option <?php if($current_month2=='01'){ echo "selected"; } ?> value="01"><?php echo "January"; ?></option>
	  <option <?php if($current_month2=='02'){ echo "selected"; } ?> value="02"><?php echo "February"; ?></option>
	  <option <?php if($current_month2=='03'){ echo "selected"; } ?> value="03"><?php echo "March"; ?></option>
	  <option <?php if($current_month2=='04'){ echo "selected"; } ?> value="04"><?php echo "April"; ?></option>
	  <option <?php if($current_month2=='05'){ echo "selected"; } ?> value="05"><?php echo  "May"; ?></option>
	  <option <?php if($current_month2=='06'){ echo "selected"; } ?> value="06"><?php echo  "June"; ?></option>
	  <option <?php if($current_month2=='07'){ echo "selected"; } ?> value="07"><?php echo  "July"; ?></option>
	  <option <?php if($current_month2=='08'){ echo "selected"; } ?> value="08"><?php echo 'August'; ?></option>
	  <option <?php if($current_month2=='09'){ echo "selected"; } ?> value="09"><?php echo 'September'; ?></option>
	  <option <?php if($current_month2=='10'){ echo "selected"; } ?> value="10"><?php echo 'October'; ?></option>
	  <option <?php if($current_month2=='11'){ echo "selected"; } ?> value="11"><?php echo 'November'; ?></option>
	  <option <?php if($current_month2=='12'){ echo "selected"; } ?> value="12"><?php echo 'December'; ?></option>
	  </select>
 </div>
</div>
<div class="col-md-2">
<div class="form-group">
<label><?php echo "From Date"; ?></label>
<input type="date" name="date" id="from_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" onchange='for_income_ledger("date_wise");' required>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label><?php echo "To Date"; ?></label>
<input type="date" name="date" id="to_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" onchange='for_income_ledger("date_wise");' required>
</div>
</div>
<div class="col-md-4">
   <label>Action</label><br/>
    <input type="button" name="pdf" value="Print Pdf" onclick="for_print()" class="btn btn-success" style="float:left">
    <input type="button" name="excel" value="Print Excel" onclick="exportTableToExcel('example1', 'Inventory Report')" class="btn btn-success" style=" float:right">
</div>
</div>
    <div class="box-body table-responsive" id="my_table1"></div>

    </div>
         
  </div>
    </div>
	</div>
</section>
</div>
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
</body>