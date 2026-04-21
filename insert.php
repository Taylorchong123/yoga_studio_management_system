<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']=' ';
}

$id = $_REQUEST['id'];
$_SESSION['sid']= $id;

if(isset($_POST["title"]) && isset($_POST["start"]) && isset($_POST["end"]) 
	&& isset($_POST["teacher"]) && isset($_POST["id"]))
{

  $classname = $_POST['title'];
  $start = $_POST['start'];
  $end_class = $_POST['end'];
  $teacher = $_POST['teacher'];
  $student = $_SESSION['fullname'];
  $status = 'active';
  $id = $_POST['id'];
  $sid= $_POST['sid'];
  
  $stmt="SELECT * FROM student_enroll WHERE classname=:classname AND start=:start AND end_class=:end_class AND teacher=:teacher AND student=:student";
  $q = $dbh->prepare($stmt);
  $q->bindParam(':classname',$classname,PDO::PARAM_STR);
  $q->bindParam(':start',$start,PDO::PARAM_STR);
  $q->bindParam(':end_class',$end_class,PDO::PARAM_STR);
  $q->bindParam(':teacher',$teacher,PDO::PARAM_STR);
  $q->bindParam(':student',$student,PDO::PARAM_STR);
  $q->execute();
  $r=$q->fetchAll(PDO::FETCH_OBJ);
  
if($q->rowCount() > 0){



    echo "<script type = \"text/javascript\">
                      alert(\"Book failed. You had book the same class before\");
                      window.location = (\"mysubscription.php\")
                      </script>";

 }   

 else{	
 $sql= "
 INSERT INTO student_enroll 
 (classname, start, end_class, teacher, student,subscription_ID,class_ID,status) 
 VALUES (:classname, :start, :end_class, :teacher, :student,:sid,:id,:status)";
  
$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->bindParam(':start',$start,PDO::PARAM_STR);
$query->bindParam(':end_class',$end_class,PDO::PARAM_STR);
$query->bindParam(':teacher',$teacher,PDO::PARAM_STR);
$query->bindParam(':student',$student,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();

  
	
$run2 ="UPDATE subscription SET class_times=class_times-1 WHERE id=:sid";
$query3 = $dbh->prepare($run2);
$query3->bindParam(':sid',$sid,PDO::PARAM_STR);
$query3->execute();


$run = "UPDATE class SET student = student+1 WHERE id =:id ";
$query2 = $dbh->prepare($run);
$query2->bindParam(':id',$id,PDO::PARAM_STR);
$query2->execute();



echo "<script type = \"text/javascript\">
                      alert(\"Book successfully\");
                      window.location = (\"mysubscription.php\");
                      </script>";
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
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
      events: "load.php",
      selectHelper:true,    
      eventClick:function(event)
      { 
       if(confirm("Are you sure you want to book it?"))
       {
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var teacher = event.instructor;
        var id = event.id;
        var sid = <?php echo $_REQUEST['id'];?>;
        $.ajax({
         url:"insert.php",
         type:"POST",
         data:{id:id, title:title, start:start, end:end, teacher:teacher,sid:sid},
         success:function()
         {
          
          calendar.fullCalendar('refetchEvents');
          alert("booked successfully");
          window.location = ("mysubscription.php");            
         }

        });
       }
      },
      eventRender: function(event, element){
          element.tooltip({
              position:"top",
              exitDelay: 20,
              html: "<b>Class</b>: "+event.title+
                    "<br><b>Participant</b>: "+event.student+
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
<div class="container">
    <div class="col m12">
      <h4 class="center">Book Class</h4>
      <div class="row">
        <div class="col m12">
            <div id="calendar"></div>
        </div>
      </div>
      <div class="row">
        <div class="col m12">
        	<form action="mysubscription.php" method="post">
            <button class="btn waves-effect waves-light" type="submit" name="action">cancel</button>
           </form>
        </div>
      </div>
    </div> 
  </div>
</div>     
</div>



  


 

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
