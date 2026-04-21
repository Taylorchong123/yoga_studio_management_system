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

      <li class="active"><a href="dashboard.php" class="waves-effect  "><i class="material-icons">dashboard</i>Dashboard</a></li>
      <li><div class="divider"></div></li>
      <li><a href="myprofile.php" class="waves-effect  "><i class="material-icons">mode_edit</i>My profile</a></li>
      <li><a href="mytimetable.php" class="waves-effect"><i class="material-icons">event_note</i>My timetable</a></li>
      <li><a href="mystudent.php" class="waves-effect"><i class="material-icons">face</i>My student</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>



<div class="main">
  <div class="row">
    <div class="col s12">
          <h4>Dashboard</h>
    </div>
  </div>
  <div>
    <div class="row">
      <div class="col 14 m4 s12 center ">
        <div class="card-panel center amber lighten-1">
          <h5>Profile</h5>
          <i class="medium material-icons">mode_edit</i>
        </div>
        </div>
        <div class="col 14 m4 s12 center">
        <div class="card-panel center green accent-4">
          <h5>Timetable</h5>
          <i class="medium material-icons">event_note</i>
        </div>
        </div>
        <div class="col 14 m4 s12 center">
        <div class="card-panel center red darken-1">
          <h5>student</h5>
          <i class="medium material-icons">face</i>
        </div>
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