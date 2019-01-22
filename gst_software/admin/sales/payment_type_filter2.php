	
<?php 
include("../../connection/connect.php");
include("../../attachment/session.php");
  if(isset($_POST['payment_type'])){
	  $invoice_type = $_POST['payment_type'];
    ?>
				<select class="form-control select2" name="customer_id"  style="width:100%" onchange="customer_vendor(this.value)" required>
						<option value="">Select</option>
						<?php
						  $select_advance_sales = "select * from sales_invoice_info where invoice_status='Active' and invoice_due_amount>0 and invoice_status2='$invoice_type' and company_code='$company_code' group by invoice_firm_name";
						  $run = mysql_query($select_advance_sales);
						  while($fetchrow = mysql_fetch_array($run))
						  {
						  $contact_firm_name=$fetchrow['invoice_firm_name'];
						$que="select * from contact_master where contact_status='Active' and company_code='$company_code' and s_no='$contact_firm_name'";
						$run2=mysql_query($que);
						$row=mysql_fetch_array($run2);
						$customer_id=$row['s_no'];
						$contact_tittle_name=$row['contact_tittle_name'];
						$contact_first_name=$row['contact_first_name'];
						$contact_last_name=$row['contact_last_name'];
						$contact_company_name=$row['contact_company_name'];
						$contact_contact_phone=$row['contact_contact_phone'];
						$contact_email=$row['contact_email'];
						$contact_gstin=$row['contact_gstin'];					
						$contact_contact_type=$row['contact_contact_type'];	
						$contact_gst_treatment=$row['contact_gst_treatment'];
          				$contact=$contact_company_name.' ('.$contact_contact_type.')';						
	                    ?>
						<option value="<?php echo $customer_id; ?>"><?php echo $contact; ?></option>
						<?php } ?>
						</select>
				 <?php } ?>
				 <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
				