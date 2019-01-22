<?php include("../../connection/connect.php");
      if(isset($_GET['inv_type']) && isset($_GET['item_id'])){
	      $pay_type = $_GET['inv_type'];
		  $item_id = $_GET['item_id'];
		  if($pay_type =="sales"){
		    $table_name = "sales_invoice_info";
		  }
		  if($pay_type =="purchase"){
		     $table_name = "purchase_invoice_info";
		  }
		  $qry = "select * from $table_name where invoice_product_name='$item_id' and invoice_status='Active' and company_code='$company_code'";
		  $run = mysql_query($qry);
		  while($fetchrow = mysql_fetch_array($run)){
			  $s_no=$row['s_no'];
	$invoice_date1=$row['invoice_date'];
	$invoice_date2=explode('-',$invoice_date1);
	$invoice_product_name = $row['invoice_product_name'];
	$select = "select * from item_master where s_no='$invoice_product_name' and company_code='$company_code'";
	$run = mysql_query($select);
	$fetchproduct = mysql_fetch_array($run);
	$item_product_name = $fetchproduct['item_product_name'];
	$item_sale_price = $fetchproduct['item_sale_price'];
	
	$invoice_date=$invoice_date2[2].'-'.$invoice_date2[1].'-'.$invoice_date2[0];
	$invoice_no=$row['invoice_no'];
	$invoice_firm_name=$row['invoice_firm_name'];
	$invoice_grand_total=$row['invoice_grand_total'];
	$invoice_due_amount=$row['invoice_due_amount'];
	$invoice_order_no=$row['invoice_order_no'];
	$invoice_quantity = $row['invoice_quantity'];
	$invoice_available_quantity = $row['invoice_available_quantity'];
	$tax_amount = $row['invoice_tax'];
	$serial_no++;
	$que1="select * from contact_master where s_no='$invoice_firm_name' and company_code='$company_code'";
	$run1=mysql_query($que1) or die(mysql_error());
	$row1=mysql_fetch_array($run1);
	$contact_company_name=$row1['contact_company_name'];
	$contact_tittle_name=$row1['contact_tittle_name'];
	$contact_first_name=$row1['contact_first_name'];
	$contact_last_name=$row1['contact_last_name'];
			  ?>
			   <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>S.No</th>
                  <th>Product Name</th>
				  <th>Invoice Date</th>
				  <th>Customer Name</th>
				  <th>Sales Price</th>
				  <th>Sales Tax(GST)</th>
				  <th>Quantity</th>
				  <th>Sales Price(Total)</th>
				  <th>Available Quantity</th>
				  <th>Due Amount</th>
                </tr>
                </thead>
				<tr align='center'>
				<th><?php echo $serial_no; ?></th>
				<th><a href="item_detail2.php?item_id=<?php echo $serial_no; ?>"><?php echo $invoice_product_name; ?></a></th>
				<th><?php echo $invoice_date; ?></th>
				<th><?php echo $contact_company_name; ?></th>
				<th><i class="fa fa-inr">&nbsp;<?php echo $item_sales_price; ?></th>
				<th><i class="fa fa-inr">&nbsp;<?php echo $tax_amount; ?></i></th>
				<th><i>&nbsp;<?php echo $invoice_quantity; ?></i></th>
				<th><i class="fa fa-inr">&nbsp;<?php echo $invoice_grand_total; ?></i></th>
				<th><i>&nbsp;<?php echo $invoice_available_quantity; ?></i></th>
				<th><i class="fa fa-inr">&nbsp;<?php echo $invoice_due_amount; ?></i></th>
				</tr>
				<?php } ?>
		        </tbody>
            
             </table>
			  
			  
			  <?php }
     ?>