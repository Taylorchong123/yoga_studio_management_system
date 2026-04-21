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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  
  <style type="text/css">
    .invesible-top {
    top: 65px;
  }
   #calendar {
        max-width: 1100px;
        margin: 1px 50px;
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
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay,listMonth',
    },
    events: 'load.php',
    eventResize:function(event,element)
    {

     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Class Update');
       window.location = ("mytimetable.php");
      }
     })
    },

    eventDrop:function(event,element)
    {

     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Class Updated");
      window.location = ("mytimetable.php");
      }
     });
    },

    eventRender: function(event, info){
        var instances = M.Tooltip.init(info,{
            position:'top',
              enterDelay: 1000,
              outDuration:0,
              inDuration:0 ,
              html: "<b>Class</b>: "+event.title+
                    "<br><b>Student</b>: "+event.student+
                    "<br><b>Instructor</b>: "+event.instructor+
                    "<br><b>Classroom</b>: "+event.classroom,       

        });

        return (event.ranges.filter(function(range){ // test event against all the ranges

        return (event.start.isBefore(range.end) &&
                event.end.isAfter(range.start));

    }).length)>0; //if it isn't in one of the ranges, don't render it (by returning false)

        },

   });
  
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
      <li class="active"><a href="mytimetable.php" class="waves-effect"><i class="material-icons">event_note</i>My timetable</a></li>
      <li><a href="mystudent.php" class="waves-effect"><i class="material-icons">face</i>My student</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>



<div class="main">
  <div class="row">
    <div class="col s12 center">
          <h4>Timetable</h4>
    </div>
  </div>
  
      <div class="row">
    <div class="col s12">
        <div id='calendar'></div>
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