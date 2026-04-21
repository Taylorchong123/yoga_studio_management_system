<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';

}

if(isset($_POST['subscription'])){


  if(isset($_SESSION['email'])){
    echo "<script>alert('Successfully sign subscription');</script>";
    $email = $_SESSION['email'];
    $sql = "SELECT * from member where email =:email Limit 1";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email',$email ,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
  foreach($results as $result){
        $mfullname= $result->fullname;
        $_SESSION['fullname'] = $mfullname;
  }

  }

    $sid = $_REQUEST['id'];
    $sql = "SELECT * from subscription_information where id=:sid Limit 1";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sid',$sid ,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
    foreach($results as $result){
        $sname = $result->subscription_name;
        $_SESSION['sname'] = $sname;
        $price = $result->price;
        $_SESSION['price'] = $price;
        $session = $result->session;
        $_SESSION['times'] = $session; 
  }
  }

  $status = 'not paid';
  $sname = $_SESSION['sname'];
  $price = $_SESSION['price'];
  $mfullname = $_SESSION['fullname'];
  $class_times = $_SESSION['times'];  

        $run ="INSERT INTO subscription (sname,mfullname,price,status,class_times) VALUES(:sname,:mfullname,:price,:status,:class_times)";

$query2 = $dbh->prepare($run);
$query2->bindParam(':sname',$sname,PDO::PARAM_STR);
$query2->bindParam(':mfullname',$mfullname,PDO::PARAM_STR);
$query2->bindParam(':price',$price,PDO::PARAM_STR);
$query2->bindParam(':status',$status,PDO::PARAM_STR);
$query2->bindParam(':class_times',$class_times,PDO::PARAM_STR);
$query2->execute();




     
  
}
  else{
    header('location:login.php');
  }



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
<body>
  
  <?php include 'includes/header.php' ?>

  <section class="slider">
  	<ul class="slides">
      <li>
        <img src="img/carousel1.jpg"> <!-- random image -->
        <div class="caption center-align">
          <h2>Kristen Yoga Studio</h2>
          <h5 class="light grey-text text-lighten-5">At Kistsen Yoga Studio, Aerial & Rope Yoga is a new evolution.</h5>
          <br>
          <a class="waves-effect waves-light btn-large orange lighten-2"><i class="material-icons right">chevron_right</i>Learn more</a>
        </div>
      </li>
      <li>
        <img src="img/carousel8.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h2><b>AERIAL YOGA</b></h2>
          <h5 class="light grey-text text-lighten-3 text-left">Try it and challenge your body </h5>
          <br>
          <a class="waves-effect waves-light btn-large orange lighten-2"><i class="material-icons right">chevron_right</i>Learn more</a>
        </div>
      </li>
      <li>
        <img src="img/carousel10.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h2><b>ROPE YOGA</b></h2>
          <h5 class="light grey-text text-lighten-3 text-left"> Bringing a new dimension to your workout</h5>
          <br>
          <a class="waves-effect waves-light btn-large orange lighten-2"><i class="material-icons right">chevron_right</i>Learn more</a>
        </div>
      </li>
    </ul>
  </section>

  <?php
    $sql ="SELECT * from subscription_information WHERE status='active' LIMIT 3";
    $query= $dbh -> prepare($sql);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);


    if($query->rowCount() > 0)
    {
        


  ?>


  <section class="container">
    <div class="row">
      <div class="col s12 center" id="subcription">
          <h2>Class Package We Offer<h2>

      </div>
    </div>
  	<div class="row">
    <?php foreach($results as $result){?> 
    <div class="col s12 m4">
      <div class="card hoverable">
        <div class="card-content teal lighten-2 white-text">
          <h6><?php echo htmlentities($result->subscription_name); ?></h6>
        </div>
        <div class="card-content white center">
          <p>RM</p><h3><?php echo htmlentities($result->price);?></h3>
          
        </div>
        <div class="card-action center">
           <p>Including GST</p>
           <p>Valid for <?php echo htmlentities($result->validity); ?></p>
           <form action="index.php?id=<?php echo htmlentities($result->id);?>" method="post">
           <button class="btn waves-effect waves-light orange lighten-2" type="submit" name="subscription">Subscribe</button>
           </form>
        </div>
      </div>
    </div>
  <?php } }?>
 
  </div>
  </section>

  <section>
    <div class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br><br><br>
        <h1 class="header center white-text ">Welcome to join us</h1>
        <div class="row center">
          <a href="register.php" class="btn-large waves-effect waves-light amber lighten-2"><i class="material-icons right">person_add</i>Register now</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="img/carousel5.jpg" alt="Register"></div>
  </div>
    


  </section>


  <section class="container">
    <div class="row">
      <div class="col s12 center">
          <h2>Gallery<h2>
      </div>
    </div>
  <div class="row">
    <div class="col s11 center">
    <div class="carousel" >
      <a class="carousel-item" href="#one!"><img src="img/kristen5.jpg" width="250" height="250" class="materialboxed"></a>
      <a class="carousel-item" href="#two!"><img src="img/kristen4.jpg" width="250" height="250" class="materialboxed"></a>
      <a class="carousel-item" href="#three!"><img src="img/kristen3.png" width="250" height="250" class="materialboxed"></a>
      <a class="carousel-item" href="#four!"><img src="img/kristen2.jpg" width="250" height="250" class="materialboxed"></a>
      <a class="carousel-item" href="#five!"><img src="img/carousel6.jpg" width="250" height="250" class="materialboxed"></a>
    </div>
  </div>
 </div>
  </section>

 

   <?php include 'includes/footer.php' ?>

  <!--  Scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    const sidenav = document.querySelector('.sidenav');
    M.Sidenav.init(sidenav,{});

    const slider = document.querySelector('.slider');
    M.Slider.init(slider,{
    	indicators: false,
    	height: 500,
    	transition: 500,
    	interval: 6000
    });

    const carousel = document.querySelector('.carousel');
    M.Carousel.init(carousel,{});

    const parallax = document.querySelector('.parallax');
    M.Parallax.init(parallax,{});


    document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.materialboxed');
          var instances = M.Materialbox.init(elems);
      });

  

    
  </script>
  

  </body>
</html>