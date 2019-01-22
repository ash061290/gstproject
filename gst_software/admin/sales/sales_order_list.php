<?php include("../../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Sales Order List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('sales/sales_order')"><i class="fa fa-plus"></i> Add Order</a></li>
        <li class="active"><i class="fa fa-list"></i> Sales Order List</li>
      </ol>
    </section>
<script type="text/javascript">
   function search(value){
               
       $.ajax({
			  type: "POST",
              url: software_link+"sales/sales_search.php?search_by="+value+"",
              cache: false,
              success: function(detail){
            $('#search_table').html(detail);
              }
           });
    }
</script>

<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete this Record !!!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
}
function sales_order_challan_type(value)
	{
	   $.ajax({
			  type: "POST",
              url: software_link+"sales/all_filter.php?sales_order_info_status="+value+"",
              cache: false,
              success: function(detail){
			  $('#search_table').html(detail);   
            }
           }); 
	}
</script>
<script type="text/javascript">
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
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
<?php if(!isset($_GET['sales_order_no']))
{ ?>
          <div class="box">
            <div class="box-header">
			  <div class="col-md-2 ">
				 <div class="form-group" >
					<label><?php echo "Invoice type" ?></label>
					  <select name="ledger_month" id="extimate_type" onchange="sales_order_challan_type(this.value);" class="form-control select2" style="width:100%">
					  <option value="All" selected>All</option>
					  <option value="Draft">Draft</option>
					   <option value="Invoice Created">Invoice Created</option>
					   <option value="Pending Invoice">Pending Invoice</option>
					  </select>
				 </div>
			    </div>
          <div class="col-md-4"></div>
			 <div class="col-md-4">
                 <div class="col-md-5"><button onclick="for_print()" class="btn btn-success" style="float:right;">Print PDF</button></div>
                  <button id="print_excel"  onclick="exportTableToExcel('example1', 'sales order')" class="btn btn-success" style="float:right;">Print Excel</button>
        </div>
			  <a href="javascript:get_content('sales/new_order')"> <button style="float:right; background-color:#00a65a" type="button" class="btn btn-primary">+ Add New</button></a>
			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" id="search_table">
              <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="0" cellspacing="0">
                <thead class="my_background_color">
                <tr>
                  <th>Date</th>
                  <th>Sales Order</th>
				          <th>Customer Name</th>
				          <th>Order status</th>
                  <th>Totel Amount</th>
                  <th>Total Paid</th>
                  <th>Due Amount</th>
				          <th>Action</th>
                </tr>
                </thead>
				<tbody>
<?php
$que="select * from sales_invoice_new where invoice_type='sales order' and  invoice_status='Active' and company_code='$company_code' GROUP BY invoice_no";
$run=mysql_query($que) or die(mysql_error());
$serial_no=0;

while($row=mysql_fetch_array($run)){
		$s_no                   =$row['s_no'];
	  $invoice_date           =$row['invoice_date'];
    $invoice_no             =$row['invoice_no'];
    $order_status           =$row['order_status'];
    $invoice_grand_total    =$row['invoice_grand_total'];
    $invoice_firm_name      =$row['invoice_firm_name'];
    $invoice_total_paid     =$row['invoice_total_paid'];
    $invoice_due_amount     =$row['invoice_due_amount'];
    $que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
    $run1=mysql_query($que1) or die(mysql_error());
    $row1=mysql_fetch_array($run1);
    $contact_tittle_name=$row1['contact_tittle_name'];
    $contact_first_name=$row1['contact_first_name'];
    $contact_last_name=$row1['contact_last_name'];
    $serial_no++;
?>
<tr  align='center'>
	<th><?php echo $invoice_date; ?></th>
  <th><a href="#"><?php echo $invoice_no; ?></th></a>
	<th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
	<th><a href="#"><?php echo $order_status; ?></th></a>
	<th><?php echo $invoice_grand_total; ?></th>
  <th><?php echo $invoice_total_paid; ?></th>
  <th><?php echo $invoice_due_amount; ?></th>
  <th>
    <center>
  <a style="color:Green;" aria-hidden="true" class="fa fa-pencil" href="javascript:post_content('sales/new_invoice_edit2','inv_id=<?php echo $inv_id; ?>')">Edit</a> &nbsp;&nbsp;&nbsp;

  <a href="#" onclick="valid('<?php echo $s_no;?>');" style="color:Red;" aria-hidden="true" class="fa fa-trash-o"> Delete</a></center>



  </th>
</tr>
<?php } ?>
		</tbody>
            
             </table>
            </div>
            <!-- /.box-body -->
          </div>
<?php }
?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  

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
