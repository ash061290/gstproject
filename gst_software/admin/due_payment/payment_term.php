<?php 
include("../../attachment/session.php");
if(isset($_GET['pay_term']))
{
   $pay_term = $_GET['pay_term'];
  ?>

    <section class="content-header">
      <h1>
     Payment Term Detail
	   <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('due_payment/receivable')"><i class="fa fa-list"></i>Receivable Payment</a></li>
        <li><a href="javascript:get_content('due_payment/payable_payment')"><i class="fa fa-list"></i>Payable Payment</a></li>
		<li><a href="javascript:get_content('due_payment/Default')"><i class="fa fa-list"></i>Default Payment</a></li>
        <li class="active">Transaction Details</li>
      </ol>
    </section>
    <!-- Main content -->
<script>
	function pay_term(val)
	{
   var pay_term = val;
   var payment_term = document.getElementById('payment_term').value;
    
   if(pay_term == '')
   {
   alert('Select Payment Term First');
   }
   else
   {
		 $.ajax({
             type:"POST",		   
		     url: software_link+"due_payment/ajax_search_payment_term.php?pay_term="+pay_term+"",
			 cache:false,
			 success: function(detail){ 
            $('#my_table1').html(detail);
              }
		 
		 });
   }
	}
</script>
 <?php 
    $today=date('Y-m-d');
    $current_month2=date('m');
	$current_year=date('Y');
	$current_date=date('d');
	?>
<script  src="attendance_jquery.js"></script>
<script type="text/javascript">
      function for_income_ledger(id){ 
	   var payment_term = document.getElementById('payment_term').value;
	  if(payment_term=="end_month")
	  {
	   var payment_term="Due end of the month";
	  }
	  if(payment_term=="next_month")
	  {
	   var payment_term="Due end of the next month";
	  }
	  if(payment_term=="on_receipt")
	  {
	   var payment_term="Due on receipt";
	  }
	  document.getElementById('pay_term2').value = payment_term;
	  if(id=="date_wise"){
	  var from_date= document.getElementById('from_date').value;
	  var to_date= document.getElementById('to_date').value;
	   var payment_term = document.getElementById('pay_term2').value;
	   $.ajax({
			  type: "POST",
              url: software_link+"due_payment/ajax_search_payment_term.php?from_date="+from_date+"&to_date="+to_date+"&payment_term="+payment_term+"",
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
	  if(current_month=="all")
	  {
	    var from_date=current_year+'-01-01';
		var to_date=current_year+'-12-31';
      $.ajax({
			  type: "POST",
              url: software_link+"due_payment/ajax_search_payment_term.php?current_year="+current_year+"&payment_term="+payment_term+"&from_date="+from_date+"&to_date="+to_date+"",
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
	  var payment_term = document.getElementById('pay_term2').value;
	   document.getElementById('from_date').value = from_date;
	   document.getElementById('to_date').value = to_date;
	  }
             $.ajax({
			  type: "POST",
              url: software_link+"due_payment/ajax_search_payment_term.php?from_date="+from_date+"&to_date="+to_date+"&payment_term="+payment_term+"",
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
       });
</script>
	
    <section class="content">
	<input type="hidden" id="payment_term" value="<?php echo $pay_term; ?>">
    <div class="row">
	<div class="col-sm-12">
	    <div class="box">
	        <div class="col-md-12">	
			<br/>
               <div class="col-md-2">
				 <div class="form-group">
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
				<div class="col-md-2 ">
				 <div class="form-group" >
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
			  <form name="d_form" id="Myform" method="post">		
			    <div class="col-md-3">
				 <div class="form-group" >
					<label><?php echo "Starting Date"; ?></label>
					 <div class="form-group" >
					  <input type="date" name="date1" id="from_date" class="form-control" onchange='for_income_ledger("date_wise");'>
				 </div>
				 </div>
			    </div>
				<div class="col-md-3">
				 <div class="form-group" >
					<label><?php echo "End Date"; ?></label>
					<input type="date" name="date2" id="to_date" class="form-control" onchange='for_income_ledger("date_wise");'>
				 </div>
			    </div>
				</form>
				<div class="col-md-2 ">
				 <div class="form-group">
				 <label><?php echo "Payment_Term"; ?></label>
 <select name="contact_payment_terms" class="form-control" id="pay_term2" onchange="pay_term(this.value)" style="width:100%">
                        <option value="">-Select-</option>
						<option value="Net-15">Net-15</option>
						<option value="Net-30">Net-30</option>
						<option value="Net-45">Net-45</option>
						<option value="Net-60">Net-60</option>
						<option value="Due end of the month">Due end of the month</option>
						<option value="Due end of the next month">Due end of the next month</option>
						<option value="Due on receipt">Due on receipt</option>
					</select>
				 </div>
			    </div>
			</div>
	    </div>
	</div>
        <div class="col-sm-12"> 
		 <br/>
          <!-- /.box -->
		    <div class="col-sm-12">
              <div class="box" >
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="my_table1">
                  
                </div>
            <!-- /.box-body -->
              </div>
          <!-- /.box -->
		    </div>
        </div>
        <!-- /.col -->
    </div>
      <!-- /.row -->
    </section>
 
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<?php } ?>
