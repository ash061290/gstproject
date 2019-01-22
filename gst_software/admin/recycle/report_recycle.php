<?php 
include("../../attachment/session.php");
 $today=date('Y-m-d');
    $current_month2=date('m');
  $current_year=date('Y');
  $current_date=date('d');
?>
<section class="content-header">
      <h1>
       Report recycle
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        
        <li class="active">Report recycle</li>
      </ol>
</section>
<script type="text/javascript">
      function for_income_ledger(id){ 
    if(id=="date_wise"){
    var from_date= document.getElementById('from_date').value;
    var to_date= document.getElementById('to_date').value;
     $.ajax({
        type: "POST",
              url: software_link+"recycle/Sales_date_ajax.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
        alert(detail);
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
              url: software_link+"recycle/Sales_year_ajax.php?current_year="+current_year+"&from_date="+from_date+"&to_date="+to_date+"",
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
              url: software_link+"recycle/Sales_year_ajax.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table1').html(detail);
              }
           });
        }
     
</script>
<script type="text/javascript">
     $( document ).ready(function() {
    for_income_ledger("month_wise");
    //for_contact_area(value);
       });
</script>

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
                <div class="col-sm-12">   
        <div class="col-sm-9">
          </div>  
      </div>      
            <!-- /.box-header -->
            <div class="box-body ">
               <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <strong style="font-size:15px;">recycle Information</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#security" data-toggle="tab" style="font-size:15px;">Sales Report</a>
                                </li>
                                <li ><a href="#home" data-toggle="tab" style="font-size:15px;">Purchase Report</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab" style="font-size:15px;">Inventory Report</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="security">
                                    <h4>Sales Report</h4>
                                    
<div class="box-body">
  <div class="col-md-3">
 <div class="form-group">
  <label><?php echo "Year Wise"; ?></label>
    <select name="ledger_year" id="ledger_year_wise" onchange='for_income_ledger("month_wise");' class="form-control">
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
<div class="col-md-3">
 <div class="form-group" >
  <label><?php echo "Month Wise"; ?></label>
    <select name="ledger_month" id="ledger_month_wise" onchange='for_income_ledger("month_wise");' class="form-control">
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
<div class="col-md-3">
<div class="form-group">
<label><?php echo "From Date"; ?></label>
<input type="date" name="date" id="from_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label><?php echo "To Date"; ?></label>
<input type="date" name="date" id="to_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
</div>
</div>

  <form role="form" id="my_form" enctype="multipart/form-data">
    <div class="box-body table-responsive" id="my_table1"></div>
  
                            <?php if(empty($_GET['inv_id'])){ ?>
                              <th colspan="2"><input type="submit" name="download" value="Download all data as Excel" style="float:right;
                              background-color:#00a65a;color:#fff;border:30px;padding: 7px;font-size:12px;"></th>
                            <?php } ?>
                        </form>
                           </div>
                             </div>

<script type="text/javascript">
      function for_income_ledger1(id){ 
    if(id=="date_wise"){
    var from_date= document.getElementById('from_date1').value;
    var to_date= document.getElementById('to_date1').value;
     $.ajax({
        type: "POST",
              url: software_link+"recycle/Purchase_date_ajax.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
        alert(detail);
              $('#my_table2').html(detail);
              }
           });

    }
        if(id=="month_wise"){
    var current_month= document.getElementById('ledger_month_wise1').value;
    var current_year= document.getElementById('ledger_year_wise1').value;
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
              url: software_link+"recycle/Purchase_year_ajax.php?current_year="+current_year+"&from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table2').html(detail);
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
              url: software_link+"recycle/Purchase_year_ajax.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table2').html(detail);
              }
           });
        }
     
</script>
<script type="text/javascript">
     $( document ).ready(function() {
    for_income_ledger1("month_wise");
    //for_contact_area(value);
       });
</script>
<div class="tab-pane fade" id="home">
  <h4>Purchase Report</h4>
    <div class="box-body">
<div class="col-md-3">
 <div class="form-group" >
  <label><?php echo "Year Wise"; ?></label>
    <select name="ledger_year" id="ledger_year_wise1" onchange='for_income_ledger1("month_wise");' class="form-control">
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
    <div class="col-md-3">
 <div class="form-group" >
  <label><?php echo "Month Wise"; ?></label>
    <select name="ledger_month" id="ledger_month_wise1" onchange='for_income_ledger1("month_wise");' class="form-control">
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
<div class="col-md-3">
<div class="form-group">
<label><?php echo "From Date"; ?></label>
<input type="date" name="date" id="from_date1" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label><?php echo "To Date"; ?></label>
<input type="date" name="date" id="to_date1" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
</div>
</div>
 <form role="form" id="my_form" enctype="multipart/form-data">
 
    <div class="box-body table-responsive" id="my_table2">
    </div>
                                    <?php if(empty($_GET['inv_id'])){ ?>
                                    <th colspan="2"><input type="submit" name="download" value="Download all data as Excel" style="float:right;
                                    background-color:#00a65a;color:#fff;border:30px;padding: 7px;font-size:12px;"></th>
                                    <?php } ?>
                                    </form>
                                        </div>
                                           </div>

<script>
function brand_select(value)
 {
  $.ajax({
    type:"POST",
    url:software_link+"recycle/ajax_item_brand.php",
    data:"brand_name="+value,
    success:function(detail){
      $("#brands_").html(detail);
    }
  }) 
 }

 function category_select(value)
 {
  $.ajax({
    type:"POST",
    url:software_link+"recycle/ajax_item_category.php",
    data:"category_name="+value,
    success:function(detail){
      $("#categories").html(detail);
    }

  })
 }

</script> 
<div class="tab-pane fade" id="messages">
  <h4>Inventory report</h4>
      <div class="box-body">
         <div class="col-md-3">
           <div class="form-group">
               <label>Brand Wise</label>
                    <select class="form-control select2" name="brand_name" style="width:100%" onchange="brand_select(this.value)" required="true">
                    <option value="1">All Brand</option>        
                     <?php
                      $que="select * from brand_add where company_code='$company_code'";
                      $run=mysql_query($que) or die(mysql_error());
                      while($row=mysql_fetch_array($run)){
                      $brand_name = $row['brand_name'];
                      ?>
                     <option value="<?php echo $brand_name; ?>" ><?php echo $brand_name; ?>
                     </option>
                      <?php } ?>
                 </select>
                      </div>
                         </div> 
<div class="col-md-3">
  <div class="form-group" >
     <label>Category Wise</label>
                    <select class="form-control select2" name="brand_name" style="width:100%" onchange="category_select(this.value)" required="true">
                    <option value="">Select Category</option>            
                    <?php
                    $que="select * from category_add where company_code='$company_code' GROUP BY category";
                    $run=mysql_query($que) or die(mysql_error());
                    while($row=mysql_fetch_array($run)){
                    $category_name = $row['category'];
                     ?>
                    <option value="<?php echo $category_name; ?>" ><?php echo $category_name; ?>
                    </option>
                    <?php } ?>
                  </select>
                       </div>
                         </div> 
 <div class="row">
        <div class="col-sm-12"> 
          <div class="box">
             <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                  <th>S.No</th>
                  <th>PRODUCT NAME</th>
                  <th>DATE</th>
                  <th>PURCHASE PRICE</th>
                  <th>SALE PRICE</th>
                  <th>QUANTITY</th>
                  <th>CATEGORY</th>
                  <th>SUB CATEGORY</th>
                  <th>Item status</th>
                </tr>
                </thead>
                     <tbody id="brands_"></tbody>
                     <tbody id="categories"></tbody>
                </table>
                    </div>
                     </div>
                       </div>
                          </div>

<form role="form" id="my_form" enctype="multipart/form-data">

    <div class="box-body table-responsive" id="my_table3"></div>
                  <?php if(empty($_GET['inv_id'])){ ?>
                  <th colspan="2"><input type="submit" name="download" value="Download all data as Excel" style="float:right;
                  background-color:#00a65a;color:#fff;border:30px;padding: 7px;font-size:12px;"></th>
                  <?php } ?>
                              </form>
                                   </div>
                                      </div>
                                        </div>
                                           </div>
                                             </div>
                                                </div>
                                                  </div>
                                                    </div> 
                                                      </div>
                                                         </div>
                                                           </section>
 
<script>
  $(function () {
    $('#example1').DataTable()
   
  })
   $(function () {
    $('#example4').DataTable()
   
  })
   $(function () {
    $('#example3').DataTable()
   
  })
</script>

