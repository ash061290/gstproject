<?php include("../../attachment/session.php");
		$s_no = $_POST['s_no'];
		$company_code                   = $_POST['company_code'];
		$date                           = date('d-m-Y');
		$brand_name                     = $_POST['brand_name'];
		$category_name                  = $_POST['category_name'];
		$subcategory_name               = $_POST['subcategory_name'];
	    $model_no                       = $_POST['model_no'];
		$item_product_attribute         = $_POST['item_product_attribute'];
		$item_product_hsn_no            = $_POST['item_product'];
		$item_purchase_purchase_price   = $_POST['item_purchase'];
		$item_purchase_purchase_mrp     = $_POST['item_purchase_purchase_mrp'];
		$item_purchase_discount         = $_POST['item_purchase_discount'];
		$item_purcahse_quantity         = $_POST['item_purchase_quantity'];
		$item_purchase_total_amount     = $_POST['item_purchase_total_amount'];
		$item_purchase_description      = $_POST['item_description'];
		$item_sales_sales_price         = $_POST['item_sales_sales_price'];
		$item_sales_purchase_mrp        = $_POST['item_sales_purchase_mrp'];
		$item_sales_discount            = $_POST['item_sales_discount'];
		$item_sales_quantity            = $_POST['item_sales_quantity'];
		$item_sales_total_amount        = $_POST['item_sales_total_amount'];
		$item_sales_description         = $_POST['item_sales_description'];
		$item_tax_cgst                  = $_POST['item_tax_cgst'];
		$item_tax_sgst                  = $_POST['item_tax_sgst'];
		$item_tax_igst                  = $_POST['item_tax_igst'];

	$quer="update item set company_code='$company_code',item_date='$date',item_brand='$brand_name',item_category='$category_name',item_subcategory='$subcategory_name',item_product_name='$model_no',item_attribute='$item_product_attribute',item_hsn_no='$item_product_hsn_no',item_purchase_price='$item_purchase_purchase_price',item_purchase_mrp='$item_purchase_purchase_mrp',item_purchase_discount='$item_purchase_discount',item_purchase_quantity='$item_purcahse_quantity',item_purchase_total_amount='$item_purchase_total_amount',item_purchase_description='$item_purchase_description',item_sales_price='$item_sales_sales_price',item_sales_mrp='$item_sales_purchase_mrp',item_sales_discount='$item_sales_discount',item_sales_quantity='$item_sales_quantity',item_sales_total_amount='$item_sales_total_amount',item_sales_description='$item_sales_description',item_tax_cgst='$item_tax_cgst',item_tax_sgst='$item_tax_sgst',item_tax_igst='$item_tax_igst' where s_no=$s_no";

    $run=mysql_query($quer) or die(mysql_error());
    if($run)
    {
	    echo "|?|success|?|";
    }

?>