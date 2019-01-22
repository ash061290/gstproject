<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Samsung Smart Plaza</title>
  <?php include("../attachment/link_css.php") ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php include("../attachment/header.php") ?>
  <?php include("../attachment/sidebar.php") ?>
  <?php include("../../connection/connect.php") ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory (Item) List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="items.php"><i class="fa fa-plus"></i>Item Add</a></li>
        <li class="active">Inventory List</li>
      </ol>
    </section>
	
<script>
	function pay_term(inv_type,item_id)
	{
   var inv_type = inv_type;
   var item_id = item_id;
		 $.ajax({
             type:"POST",		   
		     url:"ajax_item_by_invoice.php?inv_type="+pay_term+"&item_id="+item_id+"",
			 cache:false,
			 success: function(detail){ 
            $('#my_table1').html(detail);
              }
		 
		 });
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
              url: "ajax_search_payment_term.php?from_date="+from_date+"&to_date="+to_date+"&payment_term="+payment_term+"",
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
              url: "ajax_search_payment_term.php?current_year="+current_year+"&payment_term="+payment_term+"&from_date="+from_date+"&to_date="+to_date+"",
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
              url: "ajax_search_payment_term.php?from_date="+from_date+"&to_date="+to_date+"&payment_term="+payment_term+"",
              cache: false,
              success: function(detail){
              $('#my_table1').html(detail);
              }
           });
            }
</script>
<script type="text/javascript">
     $(document).ready(function() {
	    pay_term(invoice_type);
	  //for_income_ledger("month_wise");
       });
</script>

<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	            <?php
				if(isset($_GET['item_id'])){
				$item_id = $_GET['item_id'];
		$sales_detail = "select * from sales_invoice_info where invoice_product_name='$item_id' and company_code='$company_code'";
		$run = mysql_query($sales_detail);
		$detail_row = mysql_fetch_array($run);
		$invoice_total_paid = $detail_row['invoice_total_paid'];
			$que="select * from item_master where item_status='Active' and s_no = '$item_id' and company_code='$company_code'";
				$run=mysql_query($que) or die(mysql_error());
				while($row=mysql_fetch_array($run)){
					$item_group=$row['item_group'];				
					}
				} ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">       			
          <!-- /.box -->
          <div class="box">
            <div class="box-header">			
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
				 <label><?php echo "Invoice Type"; ?></label>
 <select name="contact_payment_terms" class="form-control" id="pay_term2" onchange="pay_term(this.value,'<?php echo $item_id; ?>')" style="width:100%">
						<option value="sales" selected>Sales Products</option>
						<option value="purchase">Perchase Products</option>
					</select>
				 </div>
			    </div>
			</div>
			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>S.No</th>
                  <th>Product Name</th>
				  <th>Opening Balance</th>
				  <th>Inwards Quantity</th>
                  <th>Outwards Quantity</th>
				  <th>Closeing Balance</th>
                </tr>
                </thead>
				<tbody id="">
				<?php
				$que="select * from item_master where item_status='Active' and s_no='$item_id' and company_code='$company_code'";
				$run=mysql_query($que) or die(mysql_error());
				$serial_no=0;
				while($row=mysql_fetch_array($run)){
						$s_no=$row['s_no'];
						$item_product_name=$row['item_product_name'];
						$item_purchase_price=$row['item_purchase_price'];
						$item_sale_price=$row['item_sale_price'];
						$item_sub_group=$row['item_sub_group'];
						$item_group=$row['item_group'];	
						$item_mrp = $row['item_mrp_price'];
						$item_quantity = $row['item_quantity'];
						$total_sale_amount = $item_quantity * $item_sale_price;
						$total_purchase_amount = $item_quantity * $item_purchase_price;
						$opening_balance = $total_purchase_amount;
						$closeing_balance = 
						$profit_amount = $total_sale_amount-$total_purchase_amount;
						if(isset($_GET['group_id']) && isset($_GET['subgroup_id'])){
                        $item_group = $company_name;
                        $item_sub_group = $subgroup_name;
						}						
					$serial_no++;
				?>
				<tr align='center'>
				<th><?php echo $serial_no; ?></th>
				<th><a href="item_detail2.php?item_id=<?php echo $serial_no; ?>"><?php echo $item_product_name; ?></a></th>
				<th><i class="fa fa-inr">&nbsp;<?php echo "30000"; ?></i></th>
				<th><i>&nbsp;<?php echo $item_quantity; ?></i></th>
			    <th><i>&nbsp;<?php echo $item_quantity; ?></i></th>
				<th><i class="fa fa-inr">&nbsp;<?php echo "3000"; ?></i></th>
				</tr>
				<?php } ?>
		        </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->   
  </div>	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>
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
</body>
</html>
