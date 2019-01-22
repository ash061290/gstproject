<?php 
   include("../../attachment/session.php");
    $today=date('Y-m-d');
    $current_month2=date('m');
	$current_year=date('Y');
	$current_date=date('d');
	?>
<script type="text/javascript">
      function for_income_ledger(id){ 
	  if(id=="date_wise"){
	  var from_date= document.getElementById('from_date').value;
	  var to_date= document.getElementById('to_date').value;
	   $.ajax({
			  type: "POST",
              url: software_link+"reminder/dashboard_date_ajax.php?from_date="+from_date+"&to_date="+to_date+"",
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
              url: software_link+"reminder/dashboard_year_ajax.php?current_year="+current_year+"&from_date="+from_date+"&to_date="+to_date+"",
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
              url: software_link+"reminder/dashboard_date_ajax.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table1').html(detail);
              }
           });
            }
     
</script>
<script>
    function for_contact_area(value){
	  var contact_area = value;
	     $.ajax({
			  type: "POST",
              url: software_link+"reminder/contact_area_ajax.php?contact_area="+contact_area+"",
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
	  for_contact_area(value);
       });
</script>

<section class="content-header">
  <h1>
	Payment Dashboard
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
  </ol>
</section>
 <section class="content">
      <!-- Small boxes (Stat box) -->
	  <?php 
$customer = "Customer";
$vendor = "Vendor";
$net_15 ="Net-15";
$net_30 ="Net-30";
$net_45 ="Net-45";
$net_60="Net-60";
$due_end_month ="end_month";
$due_next_month ="next_month";
$on_receipt ="on_receipt";	  ?>
<div class="row">
<div class="col-md-12 col-xs-12 col-sm-12">
<!--box-->
<div class="box">
  <div class="col-md-12 col-sm-12" style="background-color:#EFF4F2;">
  <div class="row">
    <div class="col-md-3 col-sm-3">
  <!-- small box -->
      <div class="small-box" style="padding:15px; background-color:#fff;">
        <a href="contact_type.php?contact_type=<?php echo $customer; ?>">
          <center><p><img src="../../documents/icon/user7.png" width="48px" height="48px" class="img-responsive" /></p></center>
            <center><p><span style="">CUSTOMERS</span></p></center>
                  </a>
        </div>
             </div>
<!-- ./col -->
       <div class="col-md-3 col-sm-3">
  <!-- small box -->
        <div class="small-box" style="padding:15px; background-color:#fff;">
                 <a href="contact_type.php?contact_type=<?php echo $vendor; ?>">
	        <center><p><img src="../../documents/icon/user5.png" width="48px" height="48px" class="img-responsive" /></p></center>
                <center><p><span style="color:green;">VENDORS</span></p></center>
                </a>
                 </div>
                   </div>
          <div class="col-md-3 col-sm-3">
  <!-- small box -->
            <div class="small-box" style="padding:15px; background-color:#fff;">
	            <a href="payment_term.php?pay_term=<?php echo $net_15; ?>">
               <center><p><img src="../../documents/icon/15.png" width="48px" height="48px" class="img-responsive" /></p></center>
                 <center><p><span style="color:green;">NET-15</span></p></center>
                      </a>
                     </div>
                       </div>
               <div class="col-md-3 col-sm-3">
                     <!-- small box -->
                    <div class="small-box" style="padding:15px; background-color:#fff;">
	                  <a href="payment_term.php?pay_term=<?php echo $net_30; ?>">
                       <center><p><img src="../../documents/icon/30_2.png" width="48px" height="48px" class="img-responsive" /></p></center>
                        <center><p><span style="color:green;">NET-30</span></p></center></a>
                       </div>
                          </div>
						  </div>
					<div class="row">	  
                <div class="col-md-3 col-sm-3">
  <!-- small box -->
                   <a href="payment_term.php?pay_term=<?php echo $net_45; ?>">
                   <div class="small-box" style="padding:15px; background-color:#fff;">
                      <center><p><img src="../../documents/icon/45.png" width="48px" height="48px" class="img-responsive" /></p></center>
                       <center><p><span style="color:green;">NET-45</span></p></center></a>
                     </div>
                        </div>
             <div class="col-md-3 col-sm-3">
  <!-- small box -->
                     <a href="payment_term.php?pay_term=<?php echo $net_60; ?>">
                      <div class="small-box" style="padding:15px; background-color:#fff;">
                     <center><p><img src="../../documents/icon/60.png" width="48px" height="48px" class="img-responsive" /></p></center>
                     <center><p><span style="color:green;">NET-60</span></p></center></a>
                      </div>
                        </div>
              <div class="col-md-3 col-sm-3">
  <!-- small box -->
                    <div class="small-box" style="padding:15px; background-color:#fff;">
	                    <a href="payment_term.php?pay_term=<?php echo $due_end_month; ?>">
                  <center><p><img src="../../documents/icon/31_1.png" width="48px" height="48px" class="img-responsive" /></p></center>
                  <center><p><span style="color:green;">END MONTH</span></p></center></a>
                     </div>
                        </div>
              <div class="col-md-3 col-sm-3">
  <!-- small box -->
                    <div class="small-box" style="padding:15px; background-color:#fff;">
                      <a href="payment_term.php?pay_term=<?php echo $due_next_month; ?>">
                       <center><p><img src="../../documents/icon/31_3.png" width="48px" height="48px" class="img-responsive" /></p></center>
                       <center><p><span style="color:green;">NEXT MONTH</span></p></center></a>
                            </div>
                                </div>
								</div>
			<div class="row">
                <div class="col-md-3 col-sm-3">
  <!-- small box -->
                         <div class="small-box" style="padding:15px; background-color:#fff;">
                           <a href="payment_term.php?pay_term=<?php echo $on_receipt; ?>">
                            <center><p><img src="../../documents/icon/31_4.png" width="48px" height="48px" class="img-responsive" /></p></center>
                            <center><p><span style="color:green; ">ON RECEIPT</span></p></center></a>
                                </div>
                                    </div>	
	<div class="col-md-3 col-sm-3">
		 <div class="small-box" style="padding:15px; background-color:#fff;">
		  <a href="payable_payment.php">
			<center><p><img src="../../documents/icon/expence_logo.png" width="48px" height="48px" class="img-responsive" /></p></center>
			 <center><p><span style="">PAYABLE</span></p></center>
			   </a>
			  </div>
		</div>
<!-- ./col-->
<div class="col-md-3 col-sm-3">
		 <div class="small-box" style="padding:15px; background-color:#fff;">
		  <a href="receivable_payment.php">
			<center><p><img src="../../documents/icon/report.png" width="48px" height="48px" class="img-responsive" /></p></center>
			 <center><p><span style="">RECEIVALE</span></p></center>
			   </a>
			  </div>
		</div>
		<div class="col-md-3 col-sm-3 ">
			 <div class="small-box" style="padding:15px; background-color:#fff;">
			  <a href="defaulter.php">
			  <center><p><img src="../../documents/icon/block.png" width="48px" height="48px" class="img-responsive" /></p></center>
				<center><p><span style="">DEFAULT</span></p></center>
				  </a>
				  </div>
		</div>
             </div>	
			 </div>
</div>	
<div class="col-lg-12">		 
<div class="col-lg-12" >
  <div class="row">
    <div class="col-sm-12">
	  <form method="POST" action="../../pdf/samsung_plaza.php">
	    <div class="col-md-12">	
	  <br/>	 
 <div class="col-md-2 ">
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
<div class="col-md-2">
 <div class="form-group" >
	<label><?php echo "Year Wise"; ?></label>
	  <select name="ledger_year" id="ledger_year_wise" onchange='for_income_ledger("month_wise");for_expence_ledger("month_wise");' class="form-control">
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
	<label><?php echo "To Date"; ?></label>
	 <div class="form-group">
	  <input type="date" name="from_date" id="from_date" class="form-control" onchange='for_income_ledger("date_wise");'>
 </div>
 </div>
</div>
<div class="col-md-2">
 <div class="form-group" >
	<label><?php echo "From Date"; ?></label>
	<input type="date" name="to_date" id="to_date" class="form-control" onchange='for_income_ledger("date_wise");'>
 </div>
</div> 
<div class="col-md-2">
 <div class="form-group" >
	<label>Contact Area</label>
	 <select name="ledger_area" id="ledger_area" class="form-control select2" style="width:100%" onchange="for_contact_area(this.value);">
	    <option value="all" selected>all</option>
		<?php $select ="select contact_area,s_no from contact_master where company_code='$company_code'";
              $run = mysql_query($select);
              while($row_fetch = mysql_fetch_array($run)){ 
			      ?>
				  <option value="<?php echo $s_no=$row_fetch['s_no']; ?>"><?php echo $contact_area = $row_fetch['contact_area']; ?></option>
				  <?php } ?>
	  </select>
 </div>
</div> 
<div class="col-md-2">
 <div class="form-group" >
	<br/>
	<button name="submit" class="form-control btn btn-info my_background_color">Download</button>
 </div>
</div> 		
	</div> 
		</form>
		    </div>
				</div><!--row2 end-->
        <!-- /.col -->
	<div class="box-body table-responsive" id="my_table1"></div>
      </div>
	  </div>
	 </div><!--col-md-12-->
	 </div> <!--row1 -->
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
