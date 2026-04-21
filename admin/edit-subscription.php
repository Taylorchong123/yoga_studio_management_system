<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}


if(isset($_POST['edit'])){
  $subscription_name = $_POST['subscription_name'];
  $price = $_POST['price'];
  $period = $_POST['period'];
  $session = $_POST['session'];
  $id = $_REQUEST['id'];

  $sql1="UPDATE subscription_information 
  SET subscription_name=:subscription_name, price=:price, 
  session=:session, validity=:period WHERE id=:id";

  $query1 = $dbh->prepare($sql1);
  $query1->bindParam(':subscription_name',$subscription_name,PDO::PARAM_STR);
  $query1->bindParam(':price',$price,PDO::PARAM_STR);
  $query1->bindParam(':period',$period,PDO::PARAM_STR);
  $query1->bindParam(':session',$session,PDO::PARAM_STR);
  $query1->bindParam(':id',$id,PDO::PARAM_STR);
  $query1->execute();

  echo "<script type = \"text/javascript\">
                      alert(\"Successfully edit subscription information.\");
                      window.location = (\"subscription.php\")
                      </script>";


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
      <li><a href="member.php" class="waves-effect  "><i class="material-icons pink-text">group</i>Member</a></li>
      <li><a href="instructor.php" class="waves-effect"><i class="material-icons pink-text">person</i>Instructor</a></li>
      <li><a href="class.php" class="waves-effect"><i class="material-icons pink-text">class</i>Class</a></li>
      <li ><a href="classroom.php" class="waves-effect"><i class="material-icons pink-text">store</i>Classroom </a></li>
      <li class="active"><a href="subscription.php" class="waves-effect"><i class="material-icons pink-text">subscriptions</i>Subscription Menu</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons pink-text">exit_to_app</i>Logout</a></li>
</ul>

<?php

$id = $_REQUEST['id'];
$sql ="SELECT * from subscription_information WHERE id =:id";

$query= $dbh -> prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
  foreach($results as $result){


  }
}






?>


<div class="main">
<div class="row">
    <div class="container">
      <h4 class="center">Edit Subscription Menu</h4>
      <div class="row">
        <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="subscription_name" type="text" class="validate" name="subscription_name"required value="<?php echo htmlentities($result->subscription_name);?>" >
          <label for="subscription_name">Subscription Name</label>
          <span class="helper-text" data-error="required"></span>
        </div>
      </div>
      <div class="row">
          <div class="input-field col s4">
          <input id="price" type="number" class="validate" name="price" placeholder="20" required min="1" value="<?php echo htmlentities($result->price);?>">
          <label for="price">classprice(RM)</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s4">
          <input id="period" type="text" class="validate" name="period" placeholder="1 week/month" required value="<?php echo htmlentities($result->validity);?>">
          <label for="period">Validity</label>
          <span class="helper-text" data-error="required"></span>
          </div>
          <div class="input-field col s4">
          <input id="session" type="text" class="validate" name="session" placeholder="10" required value="<?php echo htmlentities($result->session);?>">
          <label for="period">Session</label>
          <span class="helper-text" data-error="required"></span>
          </div>
      </div>
      <div class="modal-footer">
      <button class="btn waves-effect waves-light" type="submit" name="edit">Submit
    <i class="material-icons right">send</i>
  </button>
  <a href="subscription.php" class="btn waves-effect waves-light red" type="submit" name="cancel">cancel
    <i class="material-icons right">close </i>
  </a>
    </div>
  
    </form>
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

 

   


  </script>

  </body>
</html>