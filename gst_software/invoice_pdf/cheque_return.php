<?php



require('fpdf.php');

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
    $this->SetXY(20,8); 
    $this->SetFont('Times','',22);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'SHREE LAKSHYA ENTERPRISES / MARKETING',0);
	$this->Image('apple.png',253,1,30,30);
	$this->Ln();
	
	$this->SetXY(3,55);
	$this->Cell(204,0.01,'',1);
	$this->Ln();
	
	$this->SetXY(20,15); 
    $this->SetFont('Times','',13);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'       20, Chhatrapati Nagar, Ayodhya ByPass Road, Bhopal, MadhyaPradesh - 462041',0);
	$this->Ln();
	
	$this->SetXY(20,21); 
    $this->SetFont('Times','',13);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'                           E-Mail: shreelakshya310@gmail.com Ph:0755 4222310',0);
	$this->Ln();
	
	$this->SetXY(20,26); 
    $this->SetFont('Times','',12);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'                                                    GSTIN: 23EBFPS5976H1Z5',0);
	$this->Ln();
	
    $this->SetXY(20,35); 
    $this->SetFont('Times','B',12);
    $this->SetTextColor(0,0,128);
    $this->Cell(190,8,'   CHEQUE RETURN MEMO',0);
	$this->Ln();
	
	$this->SetXY(10,42); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,26);
    $this->Cell(190,8,'Presenting Bank Name:BOI/SBI',0);
	$this->Ln();
	
	$this->SetXY(150,42); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,26);
    $this->Cell(190,8,'   Print Date  :',0);
	$this->Ln();
	
	$this->SetXY(10,47); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,26);
    $this->Cell(190,8,'Branch:_____________',0);
	$this->Ln();
	
	$this->SetXY(150,47); 
    $this->SetFont('Times','',10);
    $this->SetTextColor(26,26,26);
    $this->Cell(190,8,'Return Date  :',0);
	$this->Ln();
	
	$this->SetXY(24,42);
	$this->Cell(54,0.10,'',1);
	$this->Ln();
	
	$this->SetFont('Times','',30);
    $this->SetTextColor(0,0,128);
	$this->Ln();
	
}

// Page footer
function Footer()
{
   

	$this->SetXY(6,108);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(0.10);
    $this->Cell(200,30,'',1);
    $this->Ln();
	
	$this->SetXY(140,190);
	$this->SetDrawColor(26,26,26);
	$this->SetLineWidth(0.10);
    $this->Cell(10,10,'   Your FaithFully :',0);
    $this->Ln();
	
	$this->SetXY(20,198);
	$this->SetDrawColor(26,26,26);
	$this->SetLineWidth(0.10);
    $this->Cell(10,10,'Shree Lakshya Enterprices / Marketing',0);
    $this->Ln();
	
	$this->SetXY(10,210);
	$this->SetDrawColor(26,26,26);
	$this->SetLineWidth(0.10);
    $this->Cell(25,10,'Attach File: ->Cheque Image',0,0);
    $this->Ln();
	
	$this->SetXY(80,270);
	$this->SetFont('Times','B',12);
	$this->SetTextColor(236,15,36);
	$this->Cell(25,10,'         Thanking You',0);
    $this->Ln();
	
	$this->SetLineWidth(0.10);
	$this->Image('image.jpg',3,280,203,10);
    $this->Ln();
}

function Table1()
{
    
	$this->Cell(60,1,'',0);
    $this->Ln();
	
	$this->SetXY(6,70);
	$this->SetFont('Times','',12);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(15,10,'Dear Sir/Mam,',0);
    $this->Ln();
	
	$this->SetXY(6,80);
	$this->SetFont('Times','',12);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(15,10,'Being Unable to obtian payment of the enclosed Cheque/Draft No.',0);
    $this->Ln();
	
	$this->SetXY(6,108);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(40,10,'        Cheque No.',1,0);
    $this->Cell(40,10,'          MICR Code',1,0);
    $this->Cell(40,10,'         Amount',1,0);
    $this->Cell(40,10,'      Bank Name',1,0);
    $this->Cell(40,10,'   Reason & Description',1,0);
    $this->Ln();
	
    $this->SetXY(6,118);
	$this->SetFont('Times','B',10);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(40,20,'        ',1,0);
    $this->Cell(40,20,'        ',1,0);
    $this->Cell(40,20,'        ',1,0);
    $this->Cell(40,20,'      ',1,0);
    $this->Cell(40,20,'   ',1,0);
    $this->Ln();
	
	$this->SetXY(6,150);
	$this->SetFont('Times','',12);
	$this->SetTextColor(1,8,21);
	//$this->SetLineWidth(0.150);
    $this->Cell(30,7,'The Penalty Charges For Cheque Outward Return Are RS 350/-',0);
    $this->Ln();
	
	$this->SetXY(6,160);
    $this->Cell(30,7,'The Amount Has Been Debited To Your Account',0);
    $this->Ln();
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