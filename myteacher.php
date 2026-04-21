<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']=' ';

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
  <style type="text/css">
    
     .invesible-top {
    top: 65px;
  }

     header, .main, footer {
      padding-left: 300px;
    }

    @media only screen and (max-width : 992px) {
      header, .main, footer {
        padding-left: 0;
      }
    }
  </style>
  
</head>
<body>
  

    <?php include 'includes/header.php'?>
 
    <?php
      include('includes/config.php');
      $password =$_SESSION['password'];
      $sql = "SELECT * from member where password=:password";
      $query = $dbh->prepare($sql);
      $query->bindParam(':password',$password ,PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
            foreach($results as $result){
              
              
            }
             


  ?>

<ul id="slide-out" class="sidenav sidenav-fixed invesible-top">
    <li><div class="user-view center">
      <div class="background">
        <img src="img/background.jpg" class="responsive-img">
      </div>
      <a href="#user">
        <img src="img/<?php echo htmlentities($result->profile);?>" class="circle" style="margin:0px 85px;">
      </a>
      <span class="white-text username"><?php echo htmlentities($result->fullname);?></span>
    </div></li>

      <li><a href="myprofile.php" class="waves-effect  "><i class="material-icons">mode_edit</i>My profile</a></li>
      <li><a href="myschedule.php" class="waves-effect"><i class="material-icons">event_note</i>My schedule</a></li>
      <li><a href="mysubscription.php" class="waves-effect"><i class="material-icons">assignment_turned_in</i>My subscription</a></li>
      <li class="active"><a href="myteacher.php" class="waves-effect"><i class="material-icons">face</i>My Teacher</a></li>
</ul>

<?php
  $fullname = $_SESSION['fullname'];
  $status ="active";
  $sql ="SELECT DISTINCT instructor.name, instructor.email, instructor.gender,instructor.Education_Level, instructor.age, instructor.handphone, student_enroll.teacher, student_enroll.student from student_enroll LEFT JOIN instructor ON student_enroll.teacher = instructor.name WHERE instructor.status = :status AND student_enroll.status =:status AND student_enroll.student = :fullname"  ;
$query= $dbh -> prepare($sql);
$query-> bindParam(':status', $status, PDO::PARAM_STR);
$query-> bindParam(':fullname', $fullname, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


if($query->rowCount() > 0)
{
  




?>



<div class="main">
  <div class="row">
        <div class="col s12 center">
          <h5>My Teacher<h5>
        </div>
      </div>
      <div class="row">
        
        <div class="col s3"></div>

        <div class="col s3 m6 ">
          <?php foreach($results as $result){ ?>
          <div class="card white">
            <a href="tel:<?php echo htmlentities($result->handphone);?>" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">call</i></a>
            <div class="card-content black-text">
              
                <div class="center">
              <i class="large material-icons">account_circle</i>
              </div>
              <span class="card-title">Name: <?php echo htmlentities($result->name);?></span>
              <span class="card-title">Email: <?php echo htmlentities($result->email);?></span>
              <span class="card-title">Gender: <?php echo htmlentities($result->gender);?></span>
              <span class="card-title">Yoga Education Level: <?php echo htmlentities($result->Education_Level);?></span>
              
              <span class="card-title">handphone: <?php echo htmlentities($result->handphone);?></span>
            </div>
          </div>
           <?php  }} ?>
        </div>
     
      </div>


      

</div>

  


 <!--   <?php include 'includes/footer.php' ?> -->

  <!--  Scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    const sidenav = document.querySelector('.sidenav');
    M.Sidenav.init(sidenav,{});

   


  </script>

  </body>
</html>