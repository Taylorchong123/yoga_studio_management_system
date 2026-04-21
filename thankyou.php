<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']=' ';
}

$today = date("Y-m-d");
//call the FPDF library
require('fpdf17/fpdf.php');
require('PHPMailer/class.phpmailer.php');
require('PHPMailer/class.smtp.php');
require('PHPMailer/PHPMailerAutoload.php ');


$dest = "customer_invoice/invoice.pdf";


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
$pdf = new FPDF();

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

$pdf->Output($dest,'F');


$id = $_SESSION['id'];
        $sql = "SELECT * from member where id=:id LIMIT 1";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id',$id ,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
              foreach($results as $result){
              //create the mail
              $mail = new PHPMailer();
              $mail->isSMTP();
              $mail->SMTPAuth=true;
              $mail->SMTPSecure = 'ssl';
              $mail->SMTPDebug = 0;
              $mail->Host = 'smtp.gmail.com';
              $mail->Port='465';
              $mail->Username='testforfyp0512@gmail.com';
              $mail->Password='Bobo0512';
              //Recipents
              $mail->SetFrom('no-reply@KristenYogaStudio.org');
              $mail->AddAddress($result->email);
              //attachment
              $mail->addAttachment($dest);
              //content
              $mail->isHTML(true);
              $mail->Subject = 'Customer Invoice';
              $mail->Body    = $result->fullname." 's customer invoice" ;
              $mail->AltBody = 'PDF Attached';

              
              $mail->Send();
              
            }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yoga Malaysia | Kristen Yoga </title>
  <link rel="shortcut icon" type="image/jpg" href="img/a.jpg"/>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body  style="background-color: #e0f2f1;">
  
  <?php include 'includes/header.php'?>
  
  <section>
    <div class="container" style="background-color: white; margin-top: 5%;">
      <div class="row">
        <br>
        <br>
        <div class="col s12 center">
            <i class="large material-icons" style="color: green; font-size:7rem;" ><b>done</b></i>
            <h3><b>Thank you!</b><h3>
            <h6>Your payment has been received. A invoice has sent to your email<h6>
            <br>
            <br>
        <br>
        <br>
        </div>

      </div>
      



    </div>



  </section>
 

   

  <!--  Scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    const sidenav = document.querySelector('.sidenav');
    M.Sidenav.init(sidenav,{});

   


  </script>

  </body>
</html>