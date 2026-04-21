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
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Date', 'Visitor'],
          ['2020-09-01',34],
          ['2020-09-02',30],
          ['2020-09-03',12],
          ['2020-09-04',32],
          ['2020-09-05',4],
          ['2020-09-06',17],
          ['2020-09-07',23],
        ]);

        var options = {
          title: 'Number of visits last week',
          legend: { position: 'bottom' },
          height: 270,
          width :600,
          
        };

        var chart = new google.visualization.LineChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
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
      <li><a href="member.php" class="waves-effect  "><i class="material-icons pink-text">group</i>Member</a></li>
      <li><a href="instructor.php" class="waves-effect"><i class="material-icons pink-text">person</i>Instructor</a></li>
      <li><a href="class.php" class="waves-effect"><i class="material-icons pink-text">class</i>Class</a></li>
      <li ><a href="classroom.php" class="waves-effect"><i class="material-icons pink-text">store</i>Classroom </a></li>
      <li ><a href="subscription.php" class="waves-effect"><i class="material-icons pink-text">subscriptions</i>Subscription Menu</a></li>
       <li class="active"><a href="report.php" class="waves-effect"><i class="material-icons pink-text">assignment</i>Report</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons pink-text">exit_to_app</i>Logout</a></li>
</ul>




<div class="main">
  <div class="row">
    <div class="col s12 m4">
        <div class="card-panel"> 
            <h6 class="card-title"><b>Stat</b></h6>
            <div class="divider"></div>
            <div class="card-content">
                 <a href="printMember.php" class="waves-effect waves-teal btn-large btn-flat ">Total Member<i class="medium material-icons pink-text">group</i></a>
                 <a href="printInstructor.php" class="waves-effect waves-teal btn-large btn-flat ">Total Instructor<i class="medium material-icons pink-text">person</i></a>
                 <a href="printClass.php" class="waves-effect waves-teal btn-large btn-flat ">Total Class<i class="medium material-icons pink-text">class</i></a>
                 <a href="printClassroom.php" class="waves-effect waves-teal btn-large btn-flat ">Total Classroom<i class="medium material-icons pink-text">store</i></a>
                 <a href="printSubscriptionMenu.php" class="waves-effect waves-teal btn-large btn-flat ">Total Subscription Menu<i class="medium material-icons pink-text">subscriptions</i></a>
              
            </div>
        </div>
      </div>
    <div class="col s12 m8">
        <div class="card-panel"> 
            <h6 class="card-title"><b>History</b></h6>
            <div class="divider"></div>
            <div class="card-content" >
                <div id="piechart" ></div>
            </div>
        </div>
      </div>

    </div>
    
  </div>



<div id="edit" class="modal">
    <div class="modal-content">
      <h4 class="center">Add Subscription Menu</h4>
      <div class="row">
        <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="subscription_name" type="text" class="validate" name="subscription_name"required >
          <label for="subscription_name">Subscription Name</label>
          <span class="helper-text" data-error="required"></span>
        </div>
      </div>
      <div class="row">
          <div class="input-field col s6">
          <input id="price" type="number" class="validate" name="price" placeholder="20" required min="1">
          <label for="price">classprice(RM)</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s6">
          <input id="period" type="text" class="validate" name="period" placeholder="1 week/month" required>
          <label for="period">Validity</label>
          <span class="helper-text" data-error="required"></span>
          </div>
      </div>
      <div class="modal-footer">
      <button class="btn waves-effect waves-light" type="submit" name="edit">Submit
    <i class="material-icons right">send</i>
  </button>
    </div>
  
    </form>
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

 

   


  </script>

  </body>
</html>