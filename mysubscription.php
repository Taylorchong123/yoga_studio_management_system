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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <style type="text/css">
     .pagination .active{
        background-color: #80cbc4  !important;

     }


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
      $sql = "SELECT * from member where password=:password LIMIT 1";
      $query = $dbh->prepare($sql);
      $query->bindParam(':password',$password ,PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
            foreach($results as $result){
              $_SESSION['fullname'] = $result->fullname;
              
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
      <li class="active"><a href="mysubscription.php" class="waves-effect"><i class="material-icons">assignment_turned_in</i>My subscription</a></li>
      <li><a href="myteacher.php" class="waves-effect"><i class="material-icons">face</i>My Teacher</a></li>
</ul>

  <?php
  $mfullname = $_SESSION['fullname'];
  $sql = "SELECT * FROM subscription WHERE mfullname=:mfullname";
    $query = $dbh->prepare($sql);
    $query->bindParam(':mfullname',$mfullname ,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
        



?>



<div class="main">
        

    <div class="row">

      <?php foreach($results as $result){?>
      <div class="col s12 m4">

        <div class="card">
        <div class="card-content teal lighten-2 white-text">
          <h6><?php echo htmlentities($result->sname);?></h6>
        </div>
        <div class="card-content white center">
        <p>RM</p><h3><?php echo htmlentities($result->price);?></h3>
        </div>
        <div class="card-content white center">
         Status: <?php echo htmlentities($result->status);?>
        </div>
        <div class="card-action center">
           <?php
               

                  if($result->status=='not paid'){
              ?>
              <div class="row">
                <div class="col s6 m7">
                <a href="payment.php?id=<?php echo htmlentities($result->id);?>" type="submit"><i class="material-icons" style="color:gold;">attach_money</i></a>
                </div>
                <div class="col s6 m5">
                 <a href="cancel.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')"><i class="material-icons" style="color: red;">delete</i></a>
                 </div>
             </div>
              <?php } elseif($result->status=='paid' && $result->class_times!=0){ ?>
              <div class="row" style="margin-left: 10%;">
                <div class="col s1 m1" ng-controller="myCtrl">
                
                 <a href="insert.php?id=<?php echo htmlentities($result->id);?>" name="book" ><i class="material-icons" style="color:black;">event</i></a>
                    </div> 
                    <div class="col s1 m1">
                       (<?php echo htmlentities($result->class_times);?>)
                    </div>
               
                <div class="col s10 m8">
                  <a href="cancel.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')" ><i class="material-icons right" style="color: red;">delete</i></a>
                </div>  
              </div>    
              <?php } else{ ?>
                <div class="row" style="margin-left: 10%;">
                <div class="col s1 m1" ng-controller="myCtrl">
      
                 <button class="btn-flat white disabled" style=" margin-top:-5px; "><i class="material-icons" style="color:black;">event</i></button>
                                       </div> 
                    <div class="col s1 m1">
                       &nbsp;&nbsp;&nbsp;(<?php echo htmlentities($result->class_times);?>)
                    </div>
               
                <div class="col s10 m8">
                  <a href="cancel.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')" ><i class="material-icons right" style="color: red;">delete</i></a>
                </div>  
              </div>    

             <?php }?>
        </div>
      </div>       
      </div>
<div id="bookclass" class="modal">
    <div class="modal-content">
      <h4 class="center">Book Class</h4>
      <div class="row">
        <div class="col m12">
            <div id="calendar"></div>
        

        </div>
        
      </div>

    </div>
    
  </div>
      
      <?php 


    }


  } ?>
      


    </div>


      
</div>



  


 <!--   <?php include 'includes/footer.php' ?> -->

  <!--  Scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    const sidenav = document.querySelector('.sidenav');
    M.Sidenav.init(sidenav,{});

    const modal = document.querySelectorAll('.modal');
    M.Modal.init(modal,{});
   


  </script>

  </body>
</html>