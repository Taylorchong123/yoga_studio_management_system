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
   var calendar = $('#calendar').fullCalendar({
    defaultView: 'listMonth',
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay,listMonth',
    },
    events: 'read.php',
    selectHelper:true,

    eventRender: function(event, element){
          element.tooltip({
              position:"top",
              exitDelay: 20,
              html: "<b>Class</b>: "+event.title+
                    "<br><b>Participant</b>: "+event.student+
                    "<br><b>Instructor</b>: "+event.instructor+
                    "<br><b>Classroom</b>: "+event.classroom,
              
          });

          
        },
        eventClick:function(event)
      {
       if(confirm("Are you sure you want to remove it?"))
       {
        var id = event.id;
        $.ajax({
         url:"delete.php",
         type:"POST",
         data:{id:id},
         success:function()
         {
          calendar.fullCalendar('refetchEvents');
          alert("Event Removed");
          window.location = ("myschedule.php");
         }
        })
       }
      },

   });
  });
   
  </script>
  
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

      <li ><a href="myprofile.php" class="waves-effect  "><i class="material-icons">mode_edit</i>My profile</a></li>
      <li class="active"><a href="myschedule.php" class="waves-effect"><i class="material-icons">event_note</i>My schedule</a></li>
      <li><a href="mysubscription.php" class="waves-effect"><i class="material-icons">assignment_turned_in</i>My subscription</a></li>
      <li><a href="myteacher.php" class="waves-effect"><i class="material-icons">face</i>My Teacher</a></li>
</ul>


<div class="main">
  <div class="row">
    <div class="col s12 center">
          <h4>Schedule</h4>
    </div>
  </div>
  <div class="container">
      <div class="row">
    <div class="col s12">
        <div id='calendar'></div>
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