<?php
include("../../attachment/session.php");

	$company_code                   = $_POST['company_code'];
	$date                           = date('d-m-Y');
	$brand_name                     = $_POST['brand_name'];
	$category_name                  = $_POST['category_name'];
	$subcategory_name               = $_POST['subcategory_name'];
    $item_scan_barcode              = $_POST['item_scan_barcode'];
	$model_no                       = $_POST['model_no'];
	$uom_no                         = $_POST['uom_no'];
	$hsn_no                         = $_POST['hsn_no'];
	$item_code                      = $_POST['item_code'];
	$serial_no                      = $_POST['serial_no'];
	$imei_no                        = $_POST['imei_no'];
	$opening_stock_quantity         = $_POST['opening_stock_quantity'];
	$opening_stock_price            = $_POST['opening_stock_price'];
	$product_mrp                    = $_POST['product_mrp'];
	$description                    = $_POST['description'];
	$item_tax_cgst                  = $_POST['item_tax_cgst'];
	$item_tax_sgst                  = $_POST['item_tax_sgst'];
	$item_tax_igst                  = $_POST['item_tax_igst'];

	
	$quer="insert into item_master(company_code,date,brand_name,category,subcategory,item_scan_barcode,model_no,item_hsn_no,item_code,item_serial_no,item_imei_no,item_opening_stock_quantity,item_stock_price,item_product_mrp,item_description,item_tax_cgst,item_tax_sgst,item_tax_igst) values('$company_code','$date','$brand_name','$category_name','$subcategory_name','$item_scan_barcode','$model_no','$uom_no','$hsn_no','$item_code',
	'$serial_no','$imei_no','$opening_stock_quantity','$opening_stock_price',
	'$description','$item_tax_cgst','$item_tax_sgst','$item_tax_igst')";


	$run=mysql_query($quer) or die(mysql_error());
    if($run)
    {
	    echo "|?|success|?|";
    }

?>