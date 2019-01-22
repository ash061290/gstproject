<?php include("../../attachment/session.php"); ?>	
<script type="text/javascript">
function select_type_expense(value){
	            $.ajax({
			address: "POST",
			url: software_link+"expense/ajax_get_expense.php?id="+value+"",
			cache: false,
			success: function(detail){
			  $("#expense_type").html(detail);
			}
		});
	}
	$(document).ready(function(e){
		select_type_expense('Office Expense');
	});
</script>
<script type="text/javascript">
    function product_descr(value,s_no){
			    $.ajax({
					address: "POST",
                    url: software_link+"expense/get_ajax_item_detail.php?p_id="+value+"",
                    cache:false,
                    success: function(detail){
						alert(detail);
						 $("#quantity_"+s_no).val(detail);
					}					
				});
			 }
			 function check_quantity(quantity,sno){
				var p_id = $("#product_name_"+sno).val();
			    $.ajax({
					address: "POST",
                    url: software_link+"expense/get_ajax_item_detail.php?check_quantity="+quantity+"&p_id="+p_id+"",
                    cache:false,
                    success: function(detail){
						res = detail.split('|?|');
						if(res[0] ==1){
						 alert('Invalid Quantity...');
						 $("#quantity_"+sno).val(res[1]);
						}
						else{ 
   						$("#quantity_"+sno).val(res[1]); }
					}					
				})
			 }
			 function transport_desc(value){
			   $.ajax({
				    address: "POST",
                    url: software_link+"expense/get_transport_detail.php?transport_id="+value+"",
                    cache:false,
                    success: function(detail){
						res = detail.split('|?|');
						$("#from_location").val(res[0]);
						$("#to_location").val(res[1]);
						$("#transport_charge").val(res[4]);
						$("#extra_charge").val(res[3]);
						$("#remark").val(res[5]);
		document.getElementById("transport_detail2").style.display="block";	
		document.getElementById("transport_detail3").style.display="block";	
					}						 
				})
			}
</script>
<script>
$("#office_expense").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
    //alert(formdata);
        $.ajax({
            url: software_link+"expense/office_expense_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
            	alert(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Complete');
				   post_content('expense/add_expenses',res[2]);
            }
			}
         });
      });
</script>

<script type="text/javascript">

function item_total(sno){
   var item_name = $("#product_name_"+sno).val();
   if(item_name == ''){
        var item_quantity  = $("#quantity_"+sno).val(1);
		var item_price = $("#price_"+sno).val('');
    }else{
    var item_quantity = $("#quantity_"+sno).val();
	var item_price = $("#price_"+sno).val();
	}
	if(item_quantity==0){
	   $("#quantity_"+sno).val(1);
	}
	if(sno>1){
		var sno2 = sno-1;
	 var total_amount1 = $("#item_total_"+sno2).val();
	  var total_amount = parseInt(item_quantity) * parseInt(item_price);
	  $("#item_total_"+sno).val(total_amount);
	  var total_amount2 = parseInt(total_amount1)+parseInt(total_amount);
	  $("#total_paid").val(total_amount2);
	}
	else{
		 var item_quantity = parseInt(item_quantity);
		 var item_price = parseInt(item_price);
	     var total_amount = item_quantity*item_price;
		  var total_amount2 = parseInt(total_amount);
         $("#item_total_"+sno).val(total_amount);
           $("#total_paid").val(total_amount2);		 
	}
function due_payment(value){
	 var value = value;
	 var total_paid = $("#t1").val();
	 var due_amount = total_paid-value;
	 $("#due_amount").val(due_amount);
 
  }
	
 }
 </script>
<?php
	$query2="select * from invoice_no where company_code='$company_code'";
	$res2=mysql_query($query2);
	while($row2=mysql_fetch_array($res2)){
	$expense_no=$row2['expense_no'];
	 //$sales_invoice_draft_no=$row2['sales_invoice_draft_no'];
	 $val=$expense_no;
	}
	?>
    <section class="content-header">
      <h1>
        Create New Invoice
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index')"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="javascript:post_content('expense/expense_invoice_list','inv_type=expense')"></i>Expense Invoice</a></li>
        <li class="active">Add Invoice</li>
      </ol>
    </section>

    <section class="content">
    <div class="row">
	    <div class="col-xs-12">
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
			<h3 class="box-title">
              <center><select class="form-control select2" style="width:100%" name="expense_type" onchange="select_type_expense(this.value);" id="select_expense">
			   <option value="Office Expense">Office Expense</option>
			   <option value="Product Expense">Product Expense</option>
			   <option value="Transport Expense">Transport Expense</option>
			   <option value="Employee Expense">employee Expense</option>
			   </select></center></h3>
			  <h1 class="box-title" style="float:right;">Expense No: <?php echo 'EXP-'.$val; ?></h1>
            </div>
	<div class="box-body" id="expense_type">
		
</div>
  </div>
</div>
</div>
  </section>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
