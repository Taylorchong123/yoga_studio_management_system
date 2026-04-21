
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}

if(isset($_POST["add"]))
{

  $classname = $_POST['classname'];
  $participant = $_POST['participant'];
  $stime = $_POST['start_date']." ".$_POST['stime'];
  $etime = $_POST['end_date']." ".$_POST['etime'];
  $repeat =$_POST['repeat'];
  $dom = $_POST['dom'];
  $instructor = $_POST['instructor'];
  $classroom =$_POST['classroom'];
  $student = 0;
  $status = 'active';

  $sql="SELECT * FROM class WHERE stime BETWEEN :stime AND :etime OR etime BETWEEN :stime AND :etime AND classroom =:classroom";

  $query = $dbh->prepare($sql);
  $query->bindParam(':stime',$stime,PDO::PARAM_STR);
  $query->bindParam(':etime',$etime,PDO::PARAM_STR);
  $query->bindParam(':classroom',$classroom,PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);

  if($query->rowCount() > 0)
  { 
      echo "<script type = \"text/javascript\">
                          alert(\"The classroom is not available on selected timeframe.\");
                          window.location = (\"class.php\")
                          </script>";
  }
  else{

 if($repeat=='yes'){

    $sql="
     INSERT INTO class 
     (classname, stime, etime, participant,instructor,classroom,student,dom,status) 
     VALUES (:classname, :stime, :etime, :participant,:instructor,:classroom,:student,:dom,:status)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':classname',$classname,PDO::PARAM_STR);
    $query->bindParam(':stime',$stime,PDO::PARAM_STR);
    $query->bindParam(':etime',$etime,PDO::PARAM_STR);
    $query->bindParam(':participant',$participant,PDO::PARAM_STR);
    $query->bindParam(':instructor',$instructor,PDO::PARAM_STR);
    $query->bindParam(':classroom',$classroom,PDO::PARAM_STR);
    $query->bindParam(':student',$student,PDO::PARAM_STR);
    $query->bindParam(':dom',$dom,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->execute();

    echo "<script type = \"text/javascript\">
                          alert(\"Successfully add repeated class.\");
                          window.location = (\"class.php\")
                          </script>";
 }
 else{
 $sql="
 INSERT INTO class 
 (classname, stime, etime, participant,instructor,classroom,student,status) 
 VALUES (:classname, :stime, :etime, :participant,:instructor,:classroom,:student,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->bindParam(':stime',$stime,PDO::PARAM_STR);
$query->bindParam(':etime',$etime,PDO::PARAM_STR);
$query->bindParam(':participant',$participant,PDO::PARAM_STR);
$query->bindParam(':instructor',$instructor,PDO::PARAM_STR);
$query->bindParam(':classroom',$classroom,PDO::PARAM_STR);
$query->bindParam(':student',$student,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();

echo "<script type = \"text/javascript\">
                      alert(\"Successfully add class.\");
                      window.location = (\"class.php\")
                      </script>";
  
  } 
  }
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script  src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
    <script  src="https://cdn.rawgit.com/pinzon1992/materialize_table_pagination/f9a8478f/js/pagination.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <!-- rrule lib -->
<script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>

<!-- fullcalendar bundle -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js'></script>

<!-- the rrule-to-fullcalendar connector. must go AFTER the rrule lib -->
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@5.5.0/main.global.min.js'></script>

    

  <style type="text/css">
    

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
  $('#repeat').ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        if(inputValue =="yes"){
          $('#pickday').show();
        }
        else{
          $('#pickday').hide();
        }
    });
  });

  $('myTable').ready(function(){
  $('#myTable').pageMe({
    pagerSelector:'#myPager',
    activeColor: 'pink',
    prevText:'Anterior',
    nextText:'Siguiente',
    showPrevNext:true,
    hidePageNumbers:false,
    perPage:10
  });
});
   
  $('#add').ready(function() {
   var calendar = $('#calendar').fullCalendar({

    defaultView: 'agendaWeek',
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay,listMonth',
    },
    events: 'load.php',
    selectHelper:true,
    editable:true,
    eventResize:function(event)
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
       alert('Event Update');
       window.location = ("class.php");
      }
     })
    },

    eventDrop:function(event)
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
       alert("Event Updated");
       window.location = ("class.php");
      }
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
        window.location = ("class.php");
       }
      })
     }
    },
    eventRender: function(event){
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
  
 
  

<ul id="slide-out" class="sidenav sidenav-fixed">
    <li><div class="user-view center">
      <div class="background">
        <img src="images/background1.jpg" class="responsive-img">
      </div>
      <a href="#user">
        <img src="images/profile2.jpg" class="circle" style="margin:0px 85px;">
      </a>
      <span class="white-text username">Admin</span>
    </div></li>

      <li><a href="dashboard.php" class="waves-effect  "><i class="material-icons pink-text">dashboard</i>Dashboard</a></li>
      <li><div class="divider"></div></li>
      <li ><a href="member.php" class="waves-effect  "><i class="material-icons pink-text">group</i>Member</a></li>
      <li ><a href="instructor.php" class="waves-effect"><i class="material-icons pink-text">person</i>Instructor</a></li>
      <li class="active"><a href="class.php" class="waves-effect"><i class="material-icons pink-text">class</i>Class</a></li>
      <li><a href="classroom.php" class="waves-effect"><i class="material-icons pink-text">store</i>Classroom </a></li>
      <li><a href="subscription.php" class="waves-effect"><i class="material-icons pink-text">subscriptions</i>Subscription Menu</a></li>
       <li><a href="report.php" class="waves-effect"><i class="material-icons pink-text">assignment</i>Report</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons pink-text">exit_to_app</i>Logout</a></li>
</ul>




<div class="main">
  <div class="row">
    <div class="col s12">
        <table class="responsive-table table-hover" id="myTable">
        <thead>
          <tr>
              <th>Class Name</th>
              <th>Class time</th>
              <th>instructor</th>
              <th>classroom</th>
              <th>Class limit</th>
              <th>Action</th>
          </tr>
        </thead>
        <?php
  
$sql ="SELECT * from class ORDER BY classname";
$query= $dbh -> prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


if($query->rowCount() > 0)
{
  







?>
        <?php foreach($results as $result){
          ?>
        <tbody>
          
          <tr>
            <td><?php echo htmlentities($result->classname);?></td>
            <td><?php echo htmlentities($result->stime);?>-<?php echo htmlentities($result->etime);?></td>
            <td><?php echo htmlentities($result->instructor);?></td>
            <td><?php echo htmlentities($result->classroom);?></td>
            <td><?php echo htmlentities($result->student);?>/<?php echo htmlentities($result->participant);?></td>
            <td>

           <?php
               

                  if($result->status=='not active'){
              ?>
              
                <div class="col s2">
                <a href="activeclass.php?id=<?php echo htmlentities($result->id);?>" type="submit"><i class="material-icons left" style="color:green;">radio_button_unchecked</i></a>
                </div>
                <div class="col s2">
                 <a href="assign.php?id=<?php echo htmlentities($result->id);?>" onclick="return openDialog()" ><i class="material-icons center" >edit</i></a>
               </div>
                 <div class="col s2">
                 <a href="deleteclass.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')"><i class="material-icons center" style="color: red;">delete</i></a>
               </div>
            
              <?php } elseif($result->status=='active'){ ?>   
                <div class="col s2">
                 <a href="deactiveclass.php?id=<?php echo htmlentities($result->id);?>"><i class="material-icons left" style="color: green;">radio_button_checked</i></a>
               </div>
               <div class="col s2">
                <a  href="assign.php?id=<?php echo htmlentities($result->id);?>" onclick="return openDialog()"><i class="material-icons center">edit</i></a>
              </div>
              <div class="col s2">
                <a href="deleteclass.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')"><i class="material-icons left" style="color: red;">delete</i></a>
              </div>
              <?php } else{}?>
            </td>
          </tr>
          <?php }}?>
        </tbody>
      </table>


    </div>

  </div>
  <div class="row">
    <div class="col s12 center">
        <a class="btn-floating btn-large waves-effect waves-light red modal-trigger" href="#add"><i class="material-icons">event</i></a>
        &nbsp;
        <a class="btn-floating btn-large waves-effect waves-light red modal-trigger" href="#dialog"><i class="material-icons">add</i></a>
    </div>
  </div>
  <div class="col s12 center">
    <ul class="pagination pager" id="myPager"></ul>
</div>
</div>

<?php

$sql ="SELECT * from instructor where status ='active'";
$query= $dbh -> prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
              
              
            

?> 

<div id="dialog" class="modal">
    <div class="modal-content">
      <h4 class="center">Add Class</h4>
      <div class="row">
        <form class="col s12 form" method="POST" id="check">
      <div class="row">
        <div class="input-field col s12">
          <input id="classname" type="text" class="validate" name="classname" placeholder="eg.Aerial yoga class" required >
          <label for="classname">classname</label>
          <span class="helper-text" data-error="required"></span>
        </div>
      </div>
     <div class="row">
        <div class="input-field col s12">
          <input id="participant" type="number" class="validate" name="participant" placeholder="eg.10" required >
          <label for="participant">Participant</label>
          <span class="helper-text" data-error="required"></span>
        </div>
      </div>
      <div class="row">
          <div class="input-field col s3">
          <input id="start_date" type="date" class="validate" name="start_date"  required>
          <label for="start_date">Start Date</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s3">
          <input id="end_date" type="date" class="validate" name="end_date"  required>
          <label for="end_date">End Date</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s3">
          <input id="stime" type="time" class="validate" name="stime"  required>
          <label for="stime">Start time</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s3">
          <input id="etime" type="time" class="validate" name="etime"  required>
          <label for="etime">End time</label>
          <span class="helper-text" data-error="required"></span>
          </div>
      </div>
      <div class="row">
          <div class="input-field col s2">
          <label for="repeat">Repeat class?</label>
          </div>
          <div class="input-field col s1">
          <label>
            <input id="repeat" name="repeat" value="yes" type="radio"/>
            <span>Yes</span>
          </label>
          </div>
          <div class="input-field col s3">
          <label>
            <input id="repeat" name="repeat" value="no" checked type="radio"/>
            <span>No</span>
          </label>
          </div>
          <div id="pickday" class="input-field col s6" style="display: none;">
          <select name="dom" id="dom" >
            <option value="" disabled selected>Day</option>
            <option value="1">Monday</option>
            <option value="2">Tuesday</option>
            <option value="3">Wednesday</option>
            <option value="4">Thursday</option>
            <option value="5">Friday</option>
            <option value="6">Saturday</option>
            <option value="7">Sunday</option>
        </select>
        <label for="dom">Day</label>
          </div>
      </div>
      <div class="row ">
          <div class="input-field col s6">
            <select required name="instructor" id="instructor">
            <option value="" disabled selected>Choose your option</option>
            <?php foreach($results as $result){?>
            <option value="<?php echo htmlentities($result->name);?>"><?php echo htmlentities($result->name);?></option>
            <?php } 
          }?>
        </select>
        <label>Instructor</label>
          </div>

      <?php

$sql ="SELECT * from classroom where status ='active'";
$query= $dbh -> prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
              
              
            

?>
    
         <div class="input-field col s6">
         <select required name="classroom" id="classroom">
            <option value="" disabled selected>Choose your option</option>
            <?php foreach($results as $result){?>
            <option value="<?php echo htmlentities($result->roomname);?>"><?php echo htmlentities($result->roomname);?></option>
            <?php } 
          }?>
        </select>
        <label>classroom</label>
         </div>
      </div>
      <!-- <div class="row">
       <div class="input-field col s12">
            <select required name = "repeat_class" id = "repeat_class">
            <option value="none" selected="selected">Once</option>
            <option value="weekly" >Weekly</option>
            </select>
            <label>Recurrance</label>
        </div>
      </div> -->
      <div class="modal-footer">
      <button class="btn waves-effect waves-light" name="add" type="submit">Submit
    <i class="material-icons right">send</i>
  </button>
    </div>
    </form>
      </div>

    </div>
    
  </div>

<div id="add" class="modal">
    <div class="modal-content">
      <h4 class="center">Calendar</h4>
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

   const modal = document.querySelectorAll('.modal');
    M.Modal.init(modal,{});

    const select = document.querySelectorAll('select');
    M.FormSelect.init(select,{});
    
   
 
 
 



  </script>

  </body>
</html>