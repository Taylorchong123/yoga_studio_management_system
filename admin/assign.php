<?php
  include 'includes/config.php';

  if(isset($_POST['edit'])){

  $id = $_REQUEST['id'];
  $classname = $_POST['classname'];
  $participant = $_POST['participant'];
  $stime = $_POST['start_date']." ".$_POST['stime'];
  $etime = $_POST['end_date']." ".$_POST['etime'];
  $instructor = $_POST['instructor'];
  $classroom =$_POST['classroom'];
  $dom =$_POST['dom'];

  if(isset($_POST['dom'])){
    $sql= "
     UPDATE class SET classname=:classname,stime=:stime,etime=:etime, participant=:participant,instructor=:instructor,classroom=:classroom,
     dom=:dom WHERE id =:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':classname',$classname,PDO::PARAM_STR);
    $query->bindParam(':stime',$stime,PDO::PARAM_STR);
    $query->bindParam(':etime',$etime,PDO::PARAM_STR);
    $query->bindParam(':participant',$participant,PDO::PARAM_STR);
    $query->bindParam(':instructor',$instructor,PDO::PARAM_STR);
    $query->bindParam(':classroom',$classroom,PDO::PARAM_STR);
    $query->bindParam(':dom',$dom,PDO::PARAM_STR);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->execute();

    echo "<script type = \"text/javascript\">
                          alert(\"Successfully edit repeat class.\");
                          window.location = (\"class.php\")
                          </script>";



  }

else{
 $sql= "
 UPDATE class SET classname=:classname,stime=:stime,etime=:etime, participant=:participant,instructor=:instructor,classroom=:classroom 
  WHERE id =:id";
$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->bindParam(':stime',$stime,PDO::PARAM_STR);
$query->bindParam(':etime',$etime,PDO::PARAM_STR);
$query->bindParam(':participant',$participant,PDO::PARAM_STR);
$query->bindParam(':instructor',$instructor,PDO::PARAM_STR);
$query->bindParam(':classroom',$classroom,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

echo "<script type = \"text/javascript\">
                      alert(\"Successfully edit class.\");
                      window.location = (\"class.php\")
                      </script>";

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
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
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons pink-text">exit_to_app</i>Logout</a></li>
</ul>
<?php
  $id = $_REQUEST['id'];

  $sql ="SELECT * FROM class WHERE id =:id limit 1";
 $query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result){
    $start_date=substr((string)$result->stime,0,10);
    $end_date=substr((string)$result->etime,0,10);
    $start_time = substr((string)$result->stime,11,15);
    $end_time = substr((string)$result->etime,11,15);







?>




<div class="main">
  <div class="row ">
    <div class="col s12 ">
        <div class="container">
<div>
    <div class="modal-content">
      <h4 class="center">Edit Class</h4>
      <div class="row">
        <form class="col s12 form" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input id="classname" type="text" class="validate" name="classname" value="<?php echo htmlentities($result->classname);?>" required >
          <label for="classname">classname</label>
          <span class="helper-text" data-error="required"></span>
        </div>
      </div>
     <div class="row">
        <div class="input-field col s12">
          <input id="participant" type="number" class="validate" name="participant" value="<?php echo htmlentities($result->participant);?>" required >
          <label for="participant">Participant</label>
          <span class="helper-text" data-error="required"></span>
        </div>
      </div>
      <div class="row">
          <div class="input-field col s3">
          <input id="start_date" type="date" class="validate" value="<?php echo htmlentities($start_date);?>"  name="start_date"  required>
          <label for="start_date">Start Date</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s3">
          <input id="end_date" type="date" class="validate" value="<?php echo htmlentities($end_date);?>" name="end_date"  required>
          <label for="end_date">End Date</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s3">
          <input id="stime" type="time" class="validate" value="<?php echo htmlentities($start_time);?>" name="stime"  required>
          <label for="stime">Start time</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s3">
          <input id="etime" type="time" class="validate" value="<?php echo htmlentities($end_time);?>" name="etime"  required>
          <label for="etime">End time</label>
          <span class="helper-text" data-error="required"></span>
          </div>
      </div>
      <?php if($result->dom>0){ ?>
      <div class="row">
          <div id="pickday" class="input-field col s6">
          <select name="dom" id="dom" >
            <option value="<?php echo htmlentities($result->dom);?>" selected><?php 
            if($result->dom==1){ echo "Monday";}
            if($result->dom==2){ echo "Tuesday";}
            if($result->dom==3){ echo "Wednesday";}
            if($result->dom==4){ echo "Thursday";}
            if($result->dom==5){ echo "Friday";}
            if($result->dom==6){ echo "Saturday";}
            if($result->dom==7){ echo "Sunday";}
            ?></option>
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
<?php
}
$sql ="SELECT * from instructor where status ='active'";
$query= $dbh -> prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
              
              
            

?>

      <div class="row ">
          <div class="input-field col s6">
            <select required name="instructor" id="instructor">
            <option value="" disabled selected><?php echo htmlentities($result->instructor);?></option>
            <?php foreach($results as $result2){?>
            <option value="<?php echo htmlentities($result2->name);?>"><?php echo htmlentities($result2->name);?></option>
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
            <option value="" disabled selected><?php echo htmlentities($result->classroom);?></option>
            <?php foreach($results as $result){?>
            <option value="<?php echo htmlentities($result->roomname);?>"><?php echo htmlentities($result->roomname);?></option>
            <?php } 
          }?>
        </select>
        <label>classroom</label>
         </div>
      </div>
      <div class="modal-footer">
      <button class="btn waves-effect waves-light" name="edit" type="submit">Submit
    <i class="material-icons right">send</i>
  </button>
  <a href="class.php" class="btn waves-effect waves-light red" type="submit" name="cancel">cancel
    <i class="material-icons right">close </i>
  </a>
    </div>
    </form>
      </div>

    </div>
    
  </div>
    
        </div>


    </div>

  </div>
</div>


<?php

}
?> 






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