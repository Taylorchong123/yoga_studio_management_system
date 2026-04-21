<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
$today = date("Y-m-d");
//call the FPDF library
require('fpdf17/fpdf.php');

$id = $_SESSION['id'];
	      $sql = "SELECT * from member where id=:id LIMIT 1";
	      $query = $dbh->prepare($sql);
	      $query->bindParam(':id',$id ,PDO::PARAM_STR);
	      $query->execute();
	      $results=$query->fetchAll(PDO::FETCH_OBJ);
	            foreach($results as $result){
              
              
            }

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//create pdf object
$pdf = new FPDF('P','pt',array(500,233));

//add new page
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'Kristen Yoga Studio',0,0);
$pdf->Cell(59 ,5,'Invoice',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'No 33,Jalan Bestari 4/3 Taman Super Bestari',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'81200 Johor Bahru,Johor',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$today,0,1);//end of line

$pdf->Cell(130 ,5,'Phone [+12345678]',0,0);
$pdf->Cell(25 ,5,'Invoice #',0,0);
$pdf->Cell(34 ,5,'[1234567]',0,1);//end of line


$pdf->Cell(130 ,5,'Fax [+12345678]',0,0);
$pdf->Cell(25 ,5,'Customer ID',0,0);
$pdf->Cell(34 ,5,$result->id,0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$result->fullname,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(130 ,5,$result->address,0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(130 ,5,$result->poscode." ".$result->city." ".$result->state,0,1);


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'0'.$result->handphone,0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130 ,5,'Subscription',1,0);
$pdf->Cell(25 ,5,'Taxable',1,0);
$pdf->Cell(34 ,5,'Amount (RM)',1,1);//end of line

$pdf->SetFont('Arial','',12);

		  $sid = $_SESSION['sid'];
	      $sql2 = "SELECT * from subscription where id=:sid";
	      $query2 = $dbh->prepare($sql2);
	      $query2->bindParam(':sid',$sid ,PDO::PARAM_STR);
	      $query2->execute();
	      $results2=$query2->fetchAll(PDO::FETCH_OBJ);
	            foreach($results2 as $result2){
              		
              
           }


//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(130 ,5,$result2->sname,1,0);
$pdf->Cell(25 ,5,'-',1,0);
$pdf->Cell(34 ,5,$result2->price,1,1,'R');//end of line

 
//summary
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Subtotal',0,0);
$pdf->Cell(4 ,5,'RM',0,0);
$pdf->Cell(30 ,5,$result2->price,0,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Taxable',0,0);
$pdf->Cell(4 ,5,'RM',0,0);
$pdf->Cell(30 ,5,'0',0,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total Due',0,0);
$pdf->Cell(4 ,5,'RM',0,0);
$pdf->Cell(30 ,5,$result2->price,0,1,'R');//end of line


$id = $_SESSION['id'];
	      $sql = "SELECT * from member where id=:id LIMIT 1";
	      $query = $dbh->prepare($sql);
	      $query->bindParam(':id',$id ,PDO::PARAM_STR);
	      $query->execute();
	      $results=$query->fetchAll(PDO::FETCH_OBJ);
	            foreach($results as $result){
              
              
            }
$to = $result->id;
$from = "yongwei0512@hotmail.com";
$subject = "Customer Invoice";
$message = "<p>Payment successfuly<p>";

$separator = md5(time());
$eol = PHP_EOL;
$filename = "invoice.pdf";
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "This is a MIME encoded message.".$eol;

$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

mail($to, $subject, $body, $headers);

?>