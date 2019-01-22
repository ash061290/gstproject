<?php 
include("../../attachment/session.php");
?>
<section class="content-header">
      <h1>
       Purchase recycle
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="javascript:get_content('purchase/new_invoice')"><i class="fa fa-plus"></i>Add New </a></li>
        <li class="active">Purchase recycle</li>
      </ol>
</section>
<script>
function valid(s_no){ 
//alert(s_no);
var myval=confirm("Are you sure want to permanent Delete this record !!!!");
if(myval==true){
delete_purchase_invoice(s_no);       
 }            
else  {      
return false;
  }       
} 
  function delete_purchase_invoice(s_no){
    //alert(s_no);
$.ajax({
type: "POST",
url: software_link+"recycle/purchase_invoice_permanent_delete_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
  alert(detail);
    var res=detail.split("|?|");
         if(res[1]=='success'){
             alert('Successfully Deleted');
           get_content('purchase/purchase_invoice_list');
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
restore_sales_invoice(s_no);       
 }            
else  {      
return false;
  }       
} 
  function restore_sales_invoice(s_no){
$.ajax({
type: "POST",
url: software_link+"recycle/restore_purchase_invoice_api.php",
data: "id="+s_no,
cache: false,
success: function(detail){
    var res=detail.split("|?|");
         if(res[1]=='success'){
             alert('Successfully Restore');
           get_content('purchase/purchase_invoice_list');
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
                                <li class="active"><a href="#security" data-toggle="tab" style="font-size:15px;">Purchase Invoice</a>
                                </li>
								                <li ><a href="#home" data-toggle="tab" style="font-size:15px;">Purchase order</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab" style="font-size:15px;">Purchase payment</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="security">
                                    <h4>Purchase Invoice</h4>
                                    
<div class="box-body">
	<form role="form" method="post" enctype="multipart/form-data">
		<div class="col-md-12 box-body table-responsive" id="my_table1">
        <table id="example4" class="table table-bordered table-striped">
          <thead class="btn-success">
            <tr>
                  <th>Date</th>
                   <th>Invoice No</th>
                   <th>Customer Name</th>
                   <th>Invoice Amount</th>
                   <th>Total Paid</th>
                   <th>Due Amount</th>
                   <th>Status</th>
                  <th>Action</th>
            </tr>
          </thead>
<tbody>				
				<?php	
        
        $query ="select * from purchase_invoice_new where invoice_status='Deleted'and company_code='$company_code'";
                      	$run=mysql_query($query) or die(mysql_error());
                        $serial_no=0;
                        while($row=mysql_fetch_array($run)){
                        $s_no=$row['s_no'];
                        $invoice_date1=$row['invoice_date'];
                        $invoice_date2=explode('-',$invoice_date1);
                        $invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
                        $invoice_no=$row['invoice_no'];
                        $invoice_firm_name=$row['invoice_firm_name'];
                        $invoice_grand_total=$row['invoice_grand_total'];
                        $invoice_total_paid=$row['invoice_total_paid'];
                        $invoice_due_amount=$row['invoice_due_amount'];
                        $invoice_type=$row['invoice_type'];
                        $invoice_status = $row['invoice_status'];
                        $serial_no++;
                        $que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
                        $run1=mysql_query($que1) or die(mysql_error());
                        $row1=mysql_fetch_array($run1);
                        $contact_company_name=$row1['contact_company_name'];
                        $contact_tittle_name=$row1['contact_tittle_name'];
                        $contact_first_name=$row1['contact_first_name'];
                        $contact_last_name=$row1['contact_last_name'];
         ?>
<tr  align='center'>
                    <th><?php echo $invoice_date; ?></th>
                    <th><a href="javascript:post_content('purchase/purchase_invoice_list','<?php echo 'inv_id='.$invoice_no; ?>')"><?php echo $invoice_no; ?></a></th>
                    <th><?php echo $contact_tittle_name.'   '.$contact_first_name.'   '.$contact_last_name; ?></th>
                    <th><?php echo $invoice_grand_total; ?></th>
                    <th><?php echo $invoice_total_paid; ?></th>
                    <th><?php echo $invoice_due_amount; ?></th>
                    <th><a href="#" onclick="change_status('<?php echo $invoice_no; ?>')">
                      <?php echo $invoice_status; ?></a></th>
                    <th>
                   <a href="#" onclick="restore('<?php echo $s_no;?>');" style="color:bule;" aria-hidden="true" class="fa fa-undo"></a> &nbsp;&nbsp;&nbsp;
                   <a href="#" onclick="valid('<?php echo $s_no;?>');" style="color:Red;" aria-hidden="true" class="fa fa-trash-o"></a> &nbsp;&nbsp;&nbsp;
                 </th>
<?php }  ?>
</tr>					
                               </tbody>
                                  </table>
                                      </div>	
                                        </form>
	                                          </div>
                                                </div>


<div class="tab-pane fade" id="home">
	<h4>Purchase Order</h4>
    <div class="box-body">
		    <form role="form" method="post" enctype="multipart/form-data">
			      <div class="col-md-12 box-body" id="my_table1">
             <table id="example1" class="table table-bordered table-striped table-responsive">
              <thead class="btn-success">
              <tr>
                  <th>Date</th>
                   <th>Invoice No</th>
                   <th>Customer Name</th>
                   <th>Invoice Amount</th>
                   <th>Total Paid</th>
                   <th>Due Amount</th>
                   <th>Status</th>
                  <th>Action</th>
              </tr>
              </thead>
<tbody>				
					
				                </tbody>
                             </table>
                                </div>	
	                                 </form>
	                                    </div>
                                          </div>
<div class="tab-pane fade" id="messages">
  <h4>Purchase payment</h4>
      <div class="box-body">
		     <form role="form" method="post" enctype="multipart/form-data">
			      <div class="col-md-12 box-body table-responsive" id="my_table1">
              <table id="example3" class="table table-bordered table-striped">
                <thead  class="btn-success">
                <tr>
                  
				 
                </tr>
                </thead>
<tbody>				
				
				                  </tbody>
                            </table>
                               </div>
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

