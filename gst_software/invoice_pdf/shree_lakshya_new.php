<?php
$invoice_no=$_GET['invoice_no'];
$invoice_type=$_GET['inv_type'];
if($invoice_type=='sales'){
$table_name='sales_invoice_new';
}elseif($invoice_type=='purchase'){
$table_name='purchase_invoice_new';
}
include('../con73/con37.php');
$query="select * from $table_name where invoice_no='$invoice_no'";
$result=mysql_query($query);
$invoice_cgst=0;
$invoice_sgst=0;
$invoice_igst=0;
$total_tax=0;
while($row=mysql_fetch_array($result)){
$s_no=$row['s_no'];
$invoice_no=$row['invoice_no'];
$invoice_date1=$row['invoice_date'];
$invoice_date2=explode('-',$invoice_date1);
$invoice_date=$invoice_date2[2].'/'.$invoice_date2[1].'/'.$invoice_date2[0];
$invoice_reference=$row['invoice_reference'];
$invoice_due_date=$row['invoice_due_date'];
$invoice_firm_name=$row['invoice_firm_name'];
$invoice_billing_address=$row['invoice_billing_address'];
$invoice_shipping_address=$row['invoice_shipping_address'];
$invoice_gstin_no=$row['invoice_gstin_no'];
$invoice_place_of_supply=$row['invoice_place_of_supply'];
$invoice_tax = $row['invoice_tax'];
$invoice_cgst+=$row['invoice_cgst'];
$invoice_sgst+=$row['invoice_sgst'];
$invoice_igst+=$row['invoice_igst'];
$invoice_extra_expences=$row['invoice_extra_expences'];
$invoice_sub_total=$row['invoice_sub_total'];
$invoice_total_discount=$row['invoice_total_discount'];
$invoice_total_discount_type=$row['invoice_total_discount_type'];
$invoice_grand_total=$row['invoice_grand_total'];
$invoice_payment_mode=$row['invoice_payment_mode'];
$invoice_total_paid =$row['invoice_total_paid'];
$remark=$row['remark'];
$invoice_due_amount=$row['invoice_due_amount'];
$invoice_item_unit=$row['invoice_item_unit'];
$invoice_customer_notes=$row['invoice_customer_notes'];
$invoice_terms_and_conditions=$row['invoice_terms_and_conditions'];
$invoice_type=$row['invoice_type'];
$invoice_order_no=$row['invoice_order_no'];
$challan_no=$row['challan_no'];
}
$total_tax=$invoice_cgst+$invoice_sgst+$invoice_igst;
$query2="select * from contact_master where s_no='$invoice_firm_name'";
$result2=mysql_query($query2);
if($row2=mysql_fetch_array($result2)){
$contact_tittle_name=$row2['contact_tittle_name'];
$contact_first_name=$row2['contact_first_name'];
$contact_last_name=$row2['contact_last_name'];
$contact_company_name=$row2['contact_company_name'];
$contact_pan = $row2['contact_pan'];
$contact_adhar = $row2['contact_adhar'];
$contact_area = $row2['contact_area'];
}
require('fpdf1.php');
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';
function WriteHTML($html)
{			$this->SetFont('Times','',13);
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(7,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('Times',$style,13);
}

function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

function Heading($num, $label)
{
    // Arial 12
    $this->SetFont('Arial','',12);
    // Background color
    $this->SetFillColor(220,220,220);
    // Title
    $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
    // Line break
    $this->Ln(4);
}

function Body($file)
{
    // Read text file
    // Times 12
    $this->SetFont('Times','',12);
    // Output justified text
    $this->MultiCell(0,5,$file);
    // Line break
    $this->Ln();
   
}

// Page header
function Header()
{
	
}

// Page footer
function Footer()
{
  

}

function Table1()
{
    global $invoice_cgst,$invoice_sgst,$invoice_igst,$total_tax,$invoice_grand_total,$invoice_terms_and_conditions,$contact_tittle_name,$contact_first_name,$contact_last_name,$contact_company_name,$invoice_gstin_no,$invoice_billing_address,$invoice_shipping_address,$invoice_place_of_supply,$remark,$invoice_no,$invoice_date,$contact_pan,$contact_adhar;
      $c1 = explode(' ',$invoice_shipping_address);
	  $b1 = explode(' ',$invoice_billing_address);
	  $b2 = count($b1);
	  $c2 = count($c1);
	$x=0;
	$y=0;
	$y1=0;
	$x1=0;
	$x2=0;
    $invoice_shipping_address1="";
	$invoice_shipping_address2="";
	for($z=0;$z<$c2;$z++){
	 $x=strlen($c1[$z]);
	$y=$y+$x;
	if($y>15){
	if($x1==0){
	$y1='16';
	$x1++;}
	}
	if($y>31){
    if($x2==0){
	$y1='32';
	$x2++;}
	}
	$y1=$y1+$x;

	$y=$y1;
	if($y1<60){
	$invoice_shipping_address1=$invoice_shipping_address1.' '.$c1[$z];}elseif($y1<130){
	$invoice_shipping_address2=$invoice_shipping_address2.' '.$c1[$z];}
	}
	$x=0;
	$y=0;
	$y1=0;
	$x1=0;
	$x2=0;
	$invoice_billing_address1="";
	$invoice_billing_address2="";
	for($z=0;$z<$c2;$z++){
	 $x=strlen($c1[$z]);
	$y=$y+$x;
	if($y>15){
	if($x1==0){
	$y1='16';
	$x1++;}
	}
	if($y>31){
    if($x2==0){
	$y1='32';
	$x2++;}
	}
	$y1=$y1+$x;

	$y=$y1;
	if($y1<60){
	$invoice_billing_address1=$invoice_billing_address1.' '.$b1[$z];}elseif($y1<130){
	$invoice_billing_address2=$invoice_billing_address2.' '.$b1[$z];}
	}
	$this->SetFont('Times','',50);
    $this->SetTextColor(0,0,128);
	$this->Ln(); 

   $number = $invoice_grand_total;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
	$this->Cell(30,1,'',0);
    $this->Ln();
	$this->SetXY(10,10);
	$this->SetFont('Times','B',20);
	$this->SetTextColor(1,6,40);
	$this->SetLineWidth(0.150);
    $this->Cell(70,1,'Tax Invoice',0);
	$this->Cell(140,1,'',0);
	$this->SetXY(220,9); 
    $this->SetFont('Times','B',11);
    //$this->SetTextColor(0,0,128);
    $this->Cell(100,5,'GSTIN Number: 23EBFPS5976H1Z5',0);
	$this->Ln();
    $this->SetXY(248,16); 
    $this->SetFont('Times','B',11);
	$this->Cell(190,5,'Date: '. $invoice_date,0);
	$this->Ln();
	 $this->SetXY(10,18); 
    $this->SetFont('Times','B',12);
    $this->Cell(70,4,'Invoice Number : '.$invoice_no,0);
	$this->Ln();
	 $this->SetXY(10,25); 
    $this->SetFont('Times','B',12);
    $this->Cell(70,4,'Order Number :1081619-724918-0560001',0);
	$this->Ln();
	 $this->SetXY(10,33); 
    $this->SetFont('Times','B',12);
    $this->Cell(70,4,'Shipment Number : 1641083714',0);
	$this->Ln();
	  $this->SetXY(10,40);
	$this->Cell(275,0.10,'',1);
	$this->Ln();
	$this->Cell(10,6,'',0);
	$this->Ln();
	 $this->SetXY(10,44); 
    $this->SetFont('Times','B',12);
    $this->Cell(70,4,'Buyers Name and Address',0);
	$this->Ln();
	   $this->SetXY(10,50); 
    $this->SetFont('Times','B',12);
    $this->Cell(199,5,'  '.$contact_first_name.' '.$contact_last_name,0);
	$this->Ln();
	 $this->SetXY(10,55); 
    $this->SetFont('Times','',12);
    $this->Cell(199,5,'  '.$invoice_billing_address,0);
	$this->Ln();
	
    $this->SetXY(180,44); 
    $this->SetFont('Times','B',12);
    $this->Cell(199,5,'Selllers Name and Address',0);
	$this->Ln();
	
	 $this->SetXY(180,50); 
    $this->SetFont('Times','',12);
    $this->Cell(199,5,'Shop No:20, Chhatrapati Nagar, Ayodhya ByPass Road',0);
	$this->Ln();
	 $this->SetXY(180,57); 
    $this->SetFont('Times','',12);
    $this->Cell(199,5,'Bhopal, MadhyaPradesh - 462041',0);
	$this->Ln();
	  $this->SetXY(10,85);
	$this->Cell(275,0.10,'',1);
	$this->Ln();
    $this->SetXY(12,85);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);              
	//$this->SetLineWidth(0.150);
    //$this->Cell(10,10,'S No.',1,0);
    $this->Cell(19,8,'Product',0,0,'C');
    $this->Cell(91,8,'Description Of',0,0,'C');
    $this->Cell(29,5,'Qty',1,0,'C');
    $this->Cell(15,10,'Rate',1,0,'C');
    $this->Cell(16,10,'Total',1,0,'C');
    $this->Cell(10,10,'Disc',1,0,'C');
    $this->Cell(22,5,'Taxable',1,0,'C');
    $this->Cell(22,5,'CGST',1,0,'C');
    $this->Cell(22,5,'SGST',1,0,'C');
    $this->Cell(24,5,'IGST',1,0,'C');
    $this->Ln();
	$this->SetXY(12,90);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	$this->SetLineWidth(0.150);
    //$this->Cell(10,5,'',0);
    $this->Cell(19,5,'Code',0,0,'C');
    $this->Cell(91,5,'Goods',0,0,'C');
    //$this->Cell(20,5,'Code',0,0,'C');
    $this->Cell(14,5,'Qty',1,0,'C');
    $this->Cell(15,5,'UOM',1,0,'C');
    $this->Cell(16,5,'',0,0,'C');
    $this->Cell(17,5,'',0,0,'C');
    $this->Cell(11,5,'',0,0,'C');
    $this->Cell(19,5,'Value',0,0,'C');
    $this->Cell(11,5,'Rate',1,0,'C');
    $this->Cell(11,5,'AMT',1,0,'C');
    $this->Cell(11,5,'Rate',1,0,'C');
    $this->Cell(11,5,'AMT',1,0,'C');
    $this->Cell(11,5,'Rate',1,0,'C');
    $this->Cell(13,5,'AMT',1,0,'C');
    $this->Ln();
	
	$this->SetXY(12,100);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	$this->SetLineWidth(0.150);
    $this->Cell(10,5,'',0,0,'C');
    $this->Cell(19,5,'',0,0,'C');
    $this->Cell(91,5,'',0,0,'C');
    $this->Cell(20,5,'',0,0,'C');
    $this->Cell(10,5,'',0,0,'C');
    $this->Cell(19,5,'',0,0,'C');
    $this->Cell(16,5,'',0,0,'C');
    $this->Cell(16,5,'',0,0,'C');
    $this->Cell(10,5,'',0,0,'C');
    $this->Cell(18,5,'',0,0,'C');
    $this->Cell(10,5,'',0,0,'C');
    $this->Cell(10,5,'',0,0,'C');
    $this->Cell(10,5,'',0,0,'C');
    $this->Cell(10,5,'',0,0,'C');
    $this->Cell(10,5,'',0,0,'C');
    $this->Cell(10,5,'',0,0,'C');
    $this->Ln();
	
	$this->SetXY(12,85);
	$this->SetDrawColor(24,24,24);
	$this->SetLineWidth(0.10);
    $this->Cell(19,10,'',1);
    $this->Ln();
	//productcode//
	
    $this->SetXY(31,85);
    $this->SetDrawColor(24,24,24);
	$this->SetLineWidth(0.10);
    $this->Cell(91,10,'',1);
    $this->Ln();
	//descriptiongoods//
	
	$invoice_no=$_GET['invoice_no'];
	$invoice_type=$_GET['inv_type'];
	if($invoice_type=='sales'){
	$table_name='sales_invoice_new';
	}elseif($invoice_type=='purchase'){
	$table_name='purchase_invoice_new';
	}
	$query1="select * from $table_name where invoice_no='$invoice_no'";
	$result1=mysql_query($query1);
	$serial_no=0;
	$i=0;
	while($row1=mysql_fetch_array($result1)){
	$invoice_description=$row1['invoice_description'];
	$invoice_hsn=$row1['invoice_hsn'];
	$invoice_product_name = $row1['invoice_product_name'];
	$product_name ="select * from item where s_no='$invoice_product_name'";
	$run = mysql_query($product_name);
	$fetch_row = mysql_fetch_array($run);
	//$barcode_no = $fetch_row['barcode_no'];
	$invoice_quantity=$row1['invoice_quantity'];
	$invoice_product_name = $fetch_row['item_product_name'];
	$invoice_item_unit=$row1['invoice_item_unit'];
	$invoice_rate=$row1['invoice_rate'];
	$invoice_total=$row1['invoice_total'];
	$total_pay[$i] = $row1['invoice_total'];
	$invoice_discount=$row1['invoice_discount']; 
	$invoice_tax=$row1['invoice_tax'];
	$invoice_cgst=$row1['invoice_cgst'];
	$invoice_sgst=$row1['invoice_sgst'];
	$invoice_igst=$row1['invoice_igst'];
	$serial_no++;
	$i++;
	$invoice_description1 = substr($invoice_description, 0, 50);
	$this->Cell(-1,0,'',0,0,'C');
    $this->Ln();
	$this->Cell(-4,0,'',0,0,'C');
     $cgst_total = $invoice_rate*$invoice_cgst/100;
	 $sgst_total =  $invoice_rate*$invoice_sgst/100;
	 $igst_total = $invoice_rate*$invoice_igst/100; 
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	$this->SetLineWidth(0.150);
    //$this->Cell(10,15,''.$serial_no.'.',1,0,'C');
    $this->Cell(6,12,'',0,0,'C');
    $this->Cell(19,15,''.$serial_no,1,0,'C');
	$this->Cell(91,15,''.$invoice_product_name,1,0,'C');
    //$this->Cell(20,15,''.$invoice_hsn,1,0,'C');
    $this->Cell(14,15,''.$invoice_quantity,1,0,'C');
    $this->Cell(15,15,''.$invoice_item_unit,1,0,'C');
    $this->Cell(15,15,''.$invoice_rate,1,0,'C');
    $this->Cell(16,15,''.$invoice_total,1,0,'C');
    $this->Cell(10,15,''.$invoice_discount,1,0,'C');
    $this->Cell(22,15,''.$invoice_tax,1,0,'C');
    $this->Cell(11,15,''.$invoice_cgst,1,0,'C');
    $this->Cell(11,15,''.$cgst_total,1,0,'C');
    $this->Cell(11,15,''.$invoice_sgst,1,0,'C');
    $this->Cell(11,15,''.$sgst_total,1,0,'C');
    $this->Cell(11,15,''.$invoice_igst,1,0,'C');
    $this->Cell(13,15,''.$igst_total,1,0,'C');
    $this->Ln();
	}
  $total_sum = array_sum($total_pay);
	$this->Cell(-1,0,'',0,0,'C');
    $this->Ln();
	$this->Cell(-4,0,'',0,0,'C');
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(6,10,'',0,0);
    $this->Cell(19,10,'',1,0,'C');
    $this->Cell(91,10,'Total : ',1,0,'R');
    $this->Cell(14,10,'',1,0,'C');
    $this->Cell(15,10,'',1,0,'C');
    $this->Cell(15,10,'',1,0,'C');
    //$this->Cell(16,10,'',1,0,'C');
    $this->Cell(26,10,' '.$total_sum,1,0,'L');
    $this->Cell(22,10,'',1,0,'C');
    $this->Cell(11,10,'',1,0,'C');
    $this->Cell(11,10,'',1,0,'C');
    $this->Cell(11,10,'',1,0,'C');
    $this->Cell(11,10,'',1,0,'C');
    $this->Cell(11,10,'',1,0,'C');
    $this->Cell(13,10,'',1,0,'C');
    $this->Ln();
    $this->Cell(-1,4,'',0,0,'C');
    $this->Ln();
	$this->Cell(1,0,'',0,0,'C');
    $this->SetFont('Times','B',12);
    //$this->SetTextColor(0,0,128);
    $this->Cell(182,7,'Amount In Words: '.$result."Rupees Only",0,0);
	$this->Cell(190,7,'Total Taxable Value: '.$total_sum,0);
    $this->Ln();
	$this->Cell(211,7,' Company Bank Details',0);
	$this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,7,'CGST :'.$invoice_cgst,0);
    $this->Ln();
	$this->SetFont('Times','',10);
	$this->SetTextColor(26,26,26);
	$this->Cell(211,5,'Bank Name:',0);
	$this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,5,'SGST :'.$invoice_sgst,0);
    $this->Ln();
	$this->Cell(211,5,'Account No:',0);
	$this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,5,'IGST  :'.$invoice_igst,0);
    $this->Ln();
	$this->Cell(211,5,'Branch & IFSC Code:',0);
	$this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,5,'CESS  :',0);
    $this->Ln();
	$this->SetFont('Times','B',12);
	//$this->SetTextColor(0,0,128);
	$this->Cell(187,5,'Terms & Conditions:',0);
	$this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,5,'Total Value Of Supply :'.$total_tax,0);
    $this->Ln();
	$this->SetFont('Times','',10);
	$this->SetTextColor(26,26,26);
	$this->Cell(190,5,'Goods Once Sold Will Not Taken Back Or Replaced',0);
    $this->Ln();
	$this->Cell(190,5,'Warranty on Product Will be Extend as per the Company norms.',0);
	$this->SetFont('Times','B',12);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,5,'FOR SHREE LAKSHYA ENTERPRISES',0);
    $this->Ln();
	$this->SetFont('Times','',10);
	$this->Cell(190,5,'Interest Will Be Charged @18 After 21 Days From Bill Date.',0);
	$this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(210,5,'(Authorised Signatory)',0);
    $this->Ln();
	$this->SetFont('Times','',10);
	$this->Cell(190,5,'All Disputes Are Subject To Bhopal Jusrisdiction.',0);
    $this->Ln();	//--------------------------------------footerstart-------------------------------------------------------//
}
function sign($s1, $s2){

	    $this->Cell(90,6,$s1,'',0,'L',false);
        $this->Cell(90,6,$s2,'',0,'R',false);
		$this->Ln();
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Table1();
$pdf->Output('');
?>