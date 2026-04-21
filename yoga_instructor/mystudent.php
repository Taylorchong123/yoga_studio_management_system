<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['ylogin']!=''){
$_SESSION['ylogin']='';
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yoga Malaysia | Kristen Yoga </title>
  <link rel="shortcut icon" type="image/jpg" href="images/a.jpg"/>
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
  <script>
         $(document).ready(function() {
            $('.select').material_select();
         });
      </script>
</head>
<body>
  

    <?php include 'includes/header.php'?>

    <?php
      include('includes/config.php');
      $username =$_SESSION['username'];
      $sql = "SELECT * from instructor where username=:username LIMIT 1";
      $query = $dbh->prepare($sql);
      $query->bindParam(':username',$username ,PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
            foreach($results as $result){
                $_SESSION['name']=$result->name; 
              
            }
             


  ?>
 
  

<ul id="slide-out" class="sidenav sidenav-fixed">
    <li><div class="user-view center">
      <div class="background">
        <img src="images/background1.jpg" class="responsive-img">
      </div>
      <a href="#user">
        <img src="images/profile.jpeg" class="circle" style="margin:0px 85px;">
      </a>
      <span class="white-text username"><?php echo htmlentities($result->name);?></span>
    </div></li>

      <li ><a href="dashboard.php" class="waves-effect  "><i class="material-icons">dashboard</i>Dashboard</a></li>
      <li><div class="divider"></div></li>
      <li ><a href="myprofile.php" class="waves-effect  "><i class="material-icons">mode_edit</i>My profile</a></li>
      <li><a href="mytimetable.php" class="waves-effect"><i class="material-icons">event_note</i>My timetable</a></li>
      <li class="active"><a href="mystudent.php" class="waves-effect"><i class="material-icons">face</i>My student</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>


<?php
      include('includes/config.php');
      $name = $_SESSION['name'];
      $status ="verify";
      $sql = "SELECT DISTINCT member.fullname, member.email, member.gender, member.address, member.age,member.handphone, student_enroll.teacher, student_enroll.student from member LEFT JOIN student_enroll ON member.fullname = student_enroll.student where member.status =:status AND student_enroll.teacher= :name";
      $query = $dbh->prepare($sql);
      $query->bindParam(':status',$status ,PDO::PARAM_STR);
      $query->bindParam(':name',$name ,PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);

      if($query->rowCount() > 0)
      {
  
            
                
              
          
             


  ?>


<div class="main">
  <div class="row">
    <div class="col s12 center">
          <h4>Student</h>
    </div>
  </div>
  <div class="container">
     <div class="row">
        <div class="col s2"></div>
        <div class="col s3 m8 ">
          <?php foreach($results as $result){ ?>
          <div class="card white">
            <a href="tel:<?php echo '0'.htmlentities($result->handphone);?>" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">call</i></a>
            <div class="card-content black-text">
              
                <div class="center">
              <i class="large material-icons">account_circle</i>
              </div>
              <span class="card-title">Name: <?php echo htmlentities($result->fullname);?></span>
              <span class="card-title">Email: <?php echo htmlentities($result->email);?></span>
              <span class="card-title">Gender: <?php echo htmlentities($result->gender);?></span>
              <span class="card-title">Handphone: <?php echo '0'.htmlentities($result->handphone);?></span>
              <span class="card-title">Address: <?php echo htmlentities($result->address);?></span>
              <span class="card-title">Age: <?php echo htmlentities($result->age);?></span>
            </div>
          </div>
          <?php  }} ?>
        </div>
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