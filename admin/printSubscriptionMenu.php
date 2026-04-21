<?php
//call the FPDF library
require('fpdf17/pdf_mc_table.php');
include('includes/config.php');




$sql = "SELECT * FROM admin";
$query= $dbh -> prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach ($results as $result) {

	$id = $result->id;
}
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
$today = date("Y-m-d");
//create pdf object
$pdf = new FPDF('P','mm','A4');
//add new page
$pdf->AddPage();


//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'Kristen Yoga Studio',0,0);
$pdf->Cell(59 ,5,'Report',0,1);//end of line

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
$pdf->Cell(25 ,5,'Admin ID',0,0);
$pdf->Cell(34 ,5,$id,0,1);//end of line



//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

$pdf->SetFont('Arial','B',16);
$pdf->Cell(189 ,10,'Subscription Information',0,1,'C');//end of line
//invoice contents
$pdf->SetFont('Arial','B',10);

$pdf->Cell(6 ,5,'ID',1,0);
$pdf->Cell(70 ,5,'Subscription Name',1,0);
$pdf->Cell(20 ,5,'Price (RM)',1,0);
$pdf->Cell(30 ,5,'Session (Times)',1,0);
$pdf->Cell(30,5,'Validity',1,0);
$pdf->Cell(20,5,'status',1,1);
$pdf->SetFont('Arial','',8);

//Numbers are right-aligned so we give 'R' after new line parameter
$sql2="SELECT * FROM subscription_information";
$query= $dbh -> prepare($sql2);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach ($results as $result) {

	$pdf->Cell(6 ,5,$result->id,1,0);
	$pdf->Cell(70 ,5,$result->subscription_name,1,0);
	$pdf->Cell(20 ,5,$result->price,1,0);
	$pdf->Cell(30 ,5,$result->session,1,0);
	$pdf->Cell(30,5,$result->validity,1,0);
	$pdf->Cell(20,5,$result->status,1,1);

	
}

// $pdf->Cell(130 ,5,'UltraCool Fridge',1,0);
// $pdf->Cell(25 ,5,'-',1,0);
// $pdf->Cell(34 ,5,'3,250',1,1,'R');//end of line



// //summary
// $pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Subtotal',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'4,450',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Taxable',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'0',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Tax Rate',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'10%',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Total Due',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'4,450',1,1,'R');//end of line

//output the result
$pdf->Output();