<?php
if(isset($_POST['submit'])){
	$contact_tittle_name = $_POST['contact_tittle_name'];
	$contact_first_name = $_POST['contact_first_name'];
	$contact_last_name = $_POST['contact_last_name'];
	$company_name = $_POST['company_name'];
	$contact_company_name = $_POST['contact_company_name'];
	$contact_contact_phone = $_POST['contact_contact_phone'];
	$contact_website = $_POST['contact_website'];
	$contact_contact_type = $_POST['contact_contact_type'];
	$contact_gst_treatment = $_POST['contact_gst_treatment'];
	$contact_gstin = $_POST['contact_gstin'];
	$contact_place_of_supply = $_POST['contact_place_of_supply'];
	$contact_currency = $_POST['contact_currency'];
	$contact_payment_terms = $_POST['contact_payment_terms'];
	$contact_tax_prefrences = $_POST['contact_tax_prefrences'];
	$contact_attention = $_POST['contact_attention'];
	$contact_address = $_POST['contact_address'];
	$contact_city = $_POST['contact_city'];
	$contact_state = $_POST['contact_state'];
	$contact_zipcode = $_POST['contact_zipcode'];
	$contact_country = $_POST['contact_country'];
	$contact_fax = $_POST['contact_fax'];
	$contact_phone = $_POST['contact_phone'];
	$contact_shipping_attention = $_POST['contact_shipping_attention'];
	$contact_shipping_address = $_POST['contact_shipping_address'];
	$contact_shipping_city = $_POST['contact_shipping_city'];
	$contact_shipping_state = $_POST['contact_shipping_state'];
	$contact_shipping_zipcode = $_POST['contact_shipping_zipcode'];
	$contact_shipping_country = $_POST['contact_shipping_country'];
	$contact_shipping_fax = $_POST['contact_shipping_fax'];
	$contact_shipping_phone = $_POST['contact_shipping_phone'];
	$contact_email = $_POST['contact_email'];
	$contact_remark = $_POST['contact_remark'];
	$contact_transport_details = $_POST['contact_transport_details'];
	$contact_person_name_1 = $_POST['contact_person_name_1'];
	$contact_person_number_1 = $_POST['contact_person_number_1'];
	$contact_person_email_1 = $_POST['contact_person_email_1'];
	$contact_person_remark_1 = $_POST['contact_person_remark_1'];
	$contact_person_name_2 = $_POST['contact_person_name_2'];
	$contact_person_number_2 = $_POST['contact_person_number_2'];
	$contact_person_email_2 = $_POST['contact_person_email_2'];
	$contact_person_remark_2 = $_POST['contact_person_remark_2'];
	$contact_person_name_3 = $_POST['contact_person_name_3'];
	$contact_person_number_3 = $_POST['contact_person_number_3'];
	$contact_person_email_3 = $_POST['contact_person_email_3'];
	$contact_person_remark_3 = $_POST['contact_person_remark_3'];
	$contact_person_name_4 = $_POST['contact_person_name_4'];
	$contact_person_number_4 = $_POST['contact_person_number_4'];
	$contact_person_email_4 = $_POST['contact_person_email_4'];
	$contact_person_remark_4 = $_POST['contact_person_remark_4'];
	$contact_person_name_5 = $_POST['contact_person_name_5'];
	$contact_person_number_5 = $_POST['contact_person_number_5'];
	$contact_person_email_5 = $_POST['contact_person_email_5'];
	$contact_person_remark_5 = $_POST['contact_person_remark_5'];

    $quer="update contact_master set contact_tittle_name='$contact_tittle_name',contact_first_name='$contact_first_name',contact_last_name='$contact_last_name',contact_company_name='$contact_company_name',contact_contact_phone='$contact_contact_phone',contact_website='$contact_website',contact_contact_type='$contact_contact_type',contact_gst_treatment='$contact_gst_treatment',contact_gstin='$contact_gstin',contact_place_of_supply='$contact_place_of_supply',contact_currency='$contact_currency',contact_payment_terms='$contact_payment_terms',contact_tax_prefrences='$contact_tax_prefrences',contact_attention='$contact_attention',contact_address='$contact_address',contact_city='$contact_city',contact_state='$contact_state',contact_zipcode='$contact_zipcode',contact_country='$contact_country',contact_fax='$contact_fax',contact_phone='$contact_phone',contact_shipping_attention='$contact_shipping_attention',contact_shipping_address='$contact_shipping_address',contact_shipping_city='$contact_shipping_city',contact_shipping_state='$contact_shipping_state',contact_shipping_zipcode='$contact_shipping_zipcode',contact_shipping_country='$contact_shipping_country',contact_shipping_fax='$contact_shipping_fax',contact_shipping_phone='$contact_shipping_phone',contact_email='$contact_email',contact_remark='$contact_remark',company_name='$company_name',contact_transport_details='$contact_transport_details',contact_person_name_1='$contact_person_name_1',contact_person_number_1='$contact_person_number_1',contact_person_email_1='$contact_person_email_1',contact_person_remark_1='$contact_person_remark_1',contact_person_name_2='$contact_person_name_2',contact_person_number_2='$contact_person_number_2',contact_person_email_2='$contact_person_email_2',contact_person_remark_2='$contact_person_remark_2',contact_person_name_3='$contact_person_name_3',contact_person_number_3='$contact_person_number_3',contact_person_email_3='$contact_person_email_3',contact_person_remark_3='$contact_person_remark_3',contact_person_name_4='$contact_person_name_4',contact_person_number_4='$contact_person_number_4',contact_person_email_4='$contact_person_email_4',contact_person_remark_4='$contact_person_remark_4',contact_person_name_5='$contact_person_name_5',contact_person_number_5='$contact_person_number_5',contact_person_email_5='$contact_person_email_5',contact_person_remark_5='$contact_person_remark_5' where s_no='$s_no'";

	if(mysql_query($quer)){
	echo "<script>alert('Successfully Update');</script>";
	if(isset($_GET['page'])){
	$page_name=$_GET['page'];	
	if($page_name=='invoice_draft_edit' or $page_name=='new_invoice_edit'){
	$invoice_type=$_GET['invoice_type'];
	$invoice_no=$_GET['invoice_no'];
	$link='../ /'.$page_name.'.php?invoice_no='.$invoice_no.'&invoice_type='.$invoice_type.'';
	}if($page_name=='new_estimate_edit'){
	$estimate_type=$_GET['estimate_type'];
	$estimate_no=$_GET['estimate_no'];
	$link='../invoice/'.$page_name.'.php?estimate_no='.$estimate_no.'&estimate_type='.$estimate_type.'';
	}if($page_name=='estimate_draft_edit'){
	$estimate_draft_type=$_GET['estimate_draft_type'];
	$estimate_draft_no=$_GET['estimate_draft_no'];
	$link='../invoice/'.$page_name.'.php?estimate_draft_no='.$estimate_draft_no.'&estimate_draft_type='.$estimate_draft_type.'';
	}if($page_name=='new_order_edit'){
	$order_type=$_GET['order_type'];
	$order_no=$_GET['order_no'];
	$link='../invoice/'.$page_name.'.php?order_no='.$order_no.'&order_type='.$order_type.'';
	}if($page_name=='order_draft_edit'){
	$order_draft_type=$_GET['order_draft_type'];
	$order_draft_no=$_GET['order_draft_no'];
	$link='../invoice/'.$page_name.'.php?order_draft_no='.$order_draft_no.'&order_draft_type='.$order_draft_type.'';
	}if($page_name=='new_delivery_challan_edit'){
	$challan_type=$_GET['challan_type'];
	$challan_no=$_GET['challan_no'];
	$link='../invoice/'.$page_name.'.php?challan_no='.$challan_no.'&challan_type='.$challan_type.'';
	}if($page_name=='delivery_challan_draft_edit'){
	$challan_draft_type=$_GET['challan_draft_type'];
	$challan_draft_no=$_GET['challan_draft_no'];
	$link='../invoice/'.$page_name.'.php?challan_draft_no='.$challan_draft_no.'&challan_draft_type='.$challan_draft_type.'';
	}
	
	
	echo "<script>window.open('$link','_self');</script>";
	}if(isset($_GET['page1'])){
	$page_name=$_GET['page1'];
	echo "<script>window.open('../invoice/$page_name.php','_self');</script>";
	}else{
	echo "<script>window.open('contact_list.php','_self');</script>";
	}
 }
 }

	?>			
