<?php  session_start();
if(!isset($_SESSION['emp_id'])){
	header('location:../../client2/index.php');
	
}
if(isset($_SESSION['emp_id']))
{
 $company_name = $_SESSION['firm_name'];
 $company_code = $_SESSION['firm_id'];
}
include('../con73/con37.php');
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
    $this->SetXY(10,10);
	$this->SetFont('Times','B',20);
	$this->SetTextColor(1,6,40);
	$this->SetLineWidth(0.150);
    $this->Cell(70,1,'Inventory Report',0);
	$this->Cell(140,1,'',0);
	$this->SetXY(220,9); 
	$this->Ln();
	$this->SetXY(10,18);
	$this->Cell(275,0.10,'',1);
	$this->Ln();
	$this->SetXY(3,3);
	$this->Cell(290,203,'',1);
    $this->Ln();
	$this->SetXY(72,21); 
    $this->SetFont('Times','',13);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'',0);
	$this->Ln();
	
	$this->SetXY(85,27); 
    $this->SetFont('Times','',13);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'',0);
	$this->Ln();
	
	$this->SetXY(105,32); 
    $this->SetFont('Times','',12);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'                    ',0);
	$this->Ln();
	
	
	
	$this->SetFont('Times','',30);
    $this->SetTextColor(0,0,128);
	$this->Ln();
	
}

// Page footer
function Footer()
{
    $this->SetXY(20,280);
    $this->SetFont('Times','',12);
    $this->SetTextColor(0,0,128);
    $this->Cell(40,0.20,'',1);
    $this->Ln();

	$this->SetXY(6,108);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(0.10);
    $this->Cell(285,40,'',1);
    $this->Ln();
	
	$this->SetXY(25,150); 
    $this->SetFont('Times','B',12);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'Amount In Words:',0);
    $this->Ln();
	$this->Cell(190,8,'Companys Bank Details',0);
    $this->Ln();
	$this->SetFont('Times','',10);
	$this->SetTextColor(26,26,26);
	$this->Cell(190,5,'Bank Name:',0);
    $this->Ln();
	$this->Cell(190,5,'Account No:',0);
    $this->Ln();
	$this->Cell(190,5,'Branch & IFS Code:',0);
    $this->Ln();
	$this->SetFont('Times','B',12);
	 $this->SetTextColor(0,0,128);
	$this->Cell(190,5,'Terms & Conditions:',0);
    $this->Ln();
	$this->SetFont('Times','',10);
	 $this->SetTextColor(26,26,26);
	$this->Cell(190,5,'Goods Once Sold Will Not Taken Back Or Replaced',0);
    $this->Ln();
	$this->Cell(190,5,'Warrenty on Product Will be Extend as per the Company norms.',0);
    $this->Ln();
	$this->Cell(190,5,'Interest Will Be Charged @18 After 21 Days From Bill Date.',0);
    $this->Ln();
	$this->Cell(190,5,'All Disputes Are Subject To Bhopal Jusrisdiction.',0);
    $this->Ln();
	
	$this->SetXY(200,150); 
    $this->SetFont('Times','B',12);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'Total Taxable Value:',0);
    $this->Ln();
	
	$this->SetXY(228,155); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,8,'CGST :',0);
    $this->Ln();  
	
	$this->SetXY(228,159); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,8,'SGST :',0);
    $this->Ln(); 
	
	$this->SetXY(228,164); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,8,'IGST  :',0);
    $this->Ln(); 
	
	$this->SetXY(228,168); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,8,'CESS  :',0);
    $this->Ln(); 
	
	$this->SetXY(205,172); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,8,'Total Value Of Supply :',0);
    $this->Ln();

	$this->SetXY(205,185); 
    $this->SetFont('Times','B',12);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,8,'For SHREE LAKSHYA ENTERPRISES',0);
    $this->Ln(); 
	
	$this->SetXY(225,195); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,28);
    $this->Cell(190,8,'(Authorised Signatory)',0);
    $this->Ln(); 
}

function Table1()
{
    
	$this->Cell(70,1,'',0);
    $this->Ln();
	$this->SetXY(6,30);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(15,10,'Date',1,0);
    $this->Cell(24,5,'   Product',0);
    $this->Cell(26,5,'Description Of',0);
    $this->Cell(25,5,'  GST/HSN',0);
    $this->Cell(25,5,'       Qty',1,0);
    $this->Cell(25,10,'       Rate',1,0);
    $this->Cell(20,10,'      Total',1,0);
    $this->Cell(25,10,'    Discount',1,0);
    $this->Cell(25,5,'    Taxable',0);
    $this->Cell(25,5,'    CGST',1,0);
    $this->Cell(25,5,'       SGST',1,0);
    $this->Cell(25,5,'       IGST',1,0);
    $this->Ln();
	
	$this->SetXY(6,35);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(15,5,'',0);
    $this->Cell(24,5,'    Code',0);
    $this->Cell(26,5,'       Goods',0);
    $this->Cell(25,5,'     Code',0);
    $this->Cell(12,5,' Qty',1,0);
    $this->Cell(13,5,' UOM',1,0);
    $this->Cell(25,5,'       ',0);
    $this->Cell(20,5,'      ',0);
    $this->Cell(25,5,'    ',0);
    $this->Cell(25,5,'      Value',0);
    $this->Cell(12,5,'Rate%',1,0);
    $this->Cell(13,5,'AMT',1,0);
    $this->Cell(13,5,'Rate%',1,0);
    $this->Cell(12,5,'AMT',1,0);
    $this->Cell(14,5,'Rate%',1,0);
    $this->Cell(11,5,'AMT',1,0);
    $this->Ln();
	
	$this->SetXY(6,40);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(15,20,'',1,0);
    $this->Cell(24,20,'    ',1,0);
    $this->Cell(26,20,'       ',1,0);
    $this->Cell(25,20,'     ',1,0);
    $this->Cell(12,20,' ',1,0);
    $this->Cell(13,20,' ',1,0);
    $this->Cell(25,20,'       ',1,0);
    $this->Cell(20,20,'      ',1,0);
    $this->Cell(25,20,'    ',1,0);
    $this->Cell(25,20,'      ',1,0);
    $this->Cell(12,20,'',1,0);
    $this->Cell(13,20,'',1,0);
    $this->Cell(13,20,'',1,0);
    $this->Cell(12,20,'',1,0);
    $this->Cell(14,20,'',1,0);
    $this->Cell(11,20,'',1,0);
    $this->Ln();
	
	$this->SetXY(6,45);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(15,10,'',1,0);
    $this->Cell(24,10,' Total:   ',1,0);
    $this->Cell(26,10,'       ',1,0);
    $this->Cell(25,10,'     ',1,0);
    $this->Cell(12,10,' ',1,0);
    $this->Cell(13,10,' ',1,0);
    $this->Cell(25,10,'       ',1,0);
    $this->Cell(20,10,'      ',1,0);
    $this->Cell(25,10,'    ',1,0);
    $this->Cell(25,10,'      ',1,0);
    $this->Cell(12,10,'',1,0);
    $this->Cell(13,10,'',1,0);
    $this->Cell(13,10,'',1,0);
    $this->Cell(12,10,'',1,0);
    $this->Cell(14,10,'',1,0);
    $this->Cell(11,10,'',1,0);
    $this->Ln();
	
	$this->SetXY(21,30);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(0.10);
    $this->Cell(24,10,'',1);
    $this->Ln();
	//productcode//
	
	$this->SetXY(45,30);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(0.10);
    $this->Cell(26,10,'',1);
    $this->Ln();
	//descriptiongoods//
	
	$this->SetXY(71,30);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(0.10);
    $this->Cell(25,10,'',1);
    $this->Ln();
	//hsncode//
	
	$this->SetXY(191,30);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(0.10);
    $this->Cell(25,10,'',1);
    $this->Ln();
	//taxablevalue//
	

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