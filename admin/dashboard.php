<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <?php 
$sql = "SELECT fullname,age FROM member";
$query = $dbh->prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_ASSOC);
  

?>




    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Fullname', 'Age'],
          <?php foreach($results as $key=>$val){?>
          ['<?php echo $val['fullname'] ?>',<?php echo $val['age']?>],  
        <?php }?>
        ]);

        var options = {
          title: 'Member Age',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.BarChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
<?php 
$sql = "SELECT name,age FROM instructor";
$query = $dbh->prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_ASSOC);
  

?>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Name', 'Age'],
          <?php foreach($results as $key=>$val){?>
          ['<?php echo $val['name'] ?>',<?php echo $val['age']?>],  
        <?php }?>
        ]);

        var options = {
          title: 'Instructor Age',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script> 
<?php 
$sql = "SELECT classname,student FROM class";
$query = $dbh->prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_ASSOC);
  

?>

      <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Classname', 'Student'],
          <?php foreach($results as $key=>$val){?>
          ['<?php echo $val['classname'] ?>',<?php echo $val['student']?>],  
        <?php }?>
        ]);

        var options = {
          title: 'Total student participate the class',
          legend: { position: 'none' },
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

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

      <li class="active"><a href="dashboard.php" class="waves-effect  "><i class="material-icons pink-text">dashboard</i>Dashboard</a></li>
      <li><div class="divider"></div></li>
      <li><a href="member.php" class="waves-effect  "><i class="material-icons pink-text">group</i>Member</a></li>
      <li><a href="instructor.php" class="waves-effect"><i class="material-icons pink-text">person</i>Instructor</a></li>
      <li><a href="class.php" class="waves-effect"><i class="material-icons pink-text">class</i>Class </a></li>
      <li><a href="classroom.php" class="waves-effect"><i class="material-icons pink-text">store</i>Classroom </a></li>
      <li><a href="subscription.php" class="waves-effect"><i class="material-icons pink-text">subscriptions</i>Subscription Menu</a></li>
      <li><a href="report.php" class="waves-effect"><i class="material-icons pink-text">assignment</i>Report</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons pink-text">exit_to_app</i>Logout</a></li>
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
        <div class="card-panel center">
          <h5>Member <a href=""><span><i class="tiny material-icons blue-text">open_in_new</i></span></a></h5>
          <div id="piechart"></div>
        </div>
        </div>
        <div class="col 14 m4 s12 center">
        <div class="card-panel center">
          <h5>Instructor <a href=""><span><i class="tiny material-icons blue-text">open_in_new</i></span></a></h5>
          <div id="curve_chart"></div>
        </div>
        </div>
        <div class="col 14 m4 s12 center">
        <div class="card-panel center ">
          <h5>Subscription<a href=""><span><i class="tiny material-icons blue-text">open_in_new</i></span></a></h5>
          <div id="chart_div"></div>
        </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12">
      <div class="card white">
          <div class="card-title pink white-text center"><h4>Recent Post</h4>
          <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
        </div>
        <div class="card-content">
          <p>Chong Yong Wei has become our member waiting for verify the member.
          Chong Yong Wei has sign our subscription waiting for verify the subscription.
          rugan22 has login to the yoga instructor portal to check his class timetable.</p>
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