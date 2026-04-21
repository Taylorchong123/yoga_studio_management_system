<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['ylogin']!=''){
$_SESSION['ylogin']='';
}

if(isset($_POST['edit'])){
  $password = $_SESSION['password'];
  $username = $_SESSION['username'];
  $name = $_POST['name'];
  $handphone = $_POST['handphone'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $Education_Level = $_POST['Education_Level'];

  $sql="UPDATE instructor SET name=:name,handphone=:handphone,age=:age,gender=:gender,Education_Level=:Education_Level WHERE username =:username AND password=:password";

  $query = $dbh->prepare($sql);
  $query->bindParam(':name',$name,PDO::PARAM_STR);
  $query->bindParam(':handphone',$handphone,PDO::PARAM_STR);
  $query->bindParam(':age',$age,PDO::PARAM_STR);
  $query->bindParam(':gender',$gender,PDO::PARAM_STR);
  $query->bindParam(':Education_Level',$Education_Level,PDO::PARAM_STR);
  $query->bindParam(':username',$username,PDO::PARAM_STR);
  $query->bindParam(':password',$password,PDO::PARAM_STR);
  $query->execute();

  echo "<script type = \"text/javascript\">
                      alert(\"Successfully edit profile.\");
                      window.location = (\"myprofile.php\")
                      </script>";


}

if(isset($_POST['add'])){
  $password = $_SESSION['password'];
  $username = $_SESSION['username'];
  $name = $_POST['name'];
  $handphone = $_POST['handphone'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $Education_Level = $_POST['Education_Level'];
  $status = "active";

  $sql="UPDATE instructor SET name=:name,handphone=:handphone,age=:age,gender=:gender,Education_Level=:Education_Level WHERE username =:username AND password=:password";

  $query = $dbh->prepare($sql);
  $query->bindParam(':name',$name,PDO::PARAM_STR);
  $query->bindParam(':handphone',$handphone,PDO::PARAM_STR);
  $query->bindParam(':age',$age,PDO::PARAM_STR);
  $query->bindParam(':gender',$gender,PDO::PARAM_STR);
  $query->bindParam(':Education_Level',$Education_Level,PDO::PARAM_STR);
  $query->bindParam(':username',$username,PDO::PARAM_STR);
  $query->bindParam(':password',$password,PDO::PARAM_STR);
  $query->execute();

  echo "<script type = \"text/javascript\">
                      alert(\"Successfully add profile.\");
                      window.location = (\"myprofile.php\")
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

      <li ><a href="dashboard.php" class="waves-effect  "><i class="material-icons">dashboard</i>Dashboard</a></li>
      <li><div class="divider"></div></li>
      <li class="active"><a href="myprofile.php" class="waves-effect  "><i class="material-icons">mode_edit</i>My profile</a></li>
      <li><a href="mytimetable.php" class="waves-effect"><i class="material-icons">event_note</i>My timetable</a></li>
      <li><a href="mystudent.php" class="waves-effect"><i class="material-icons">face</i>My student</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>



<div class="main">
  <div class="row">
    <div class="col s12 center">
          <h4>Profile</h>
    </div>
  </div>
  <div class="container">
     <div class="row">
        <div class="col s3"></div>
        
        <div class="col s3 m6 ">
          <?php if($result->age=='0') 
          {
        ?>
          <div class="card white">
            <div class="card-content black-text center">
               <a class="btn-floating btn-large waves-effect waves-light red modal-trigger" href="#add"><i class="material-icons">add</i></a>
               <p>Add profile</p>
            </div>
          </div>
        <?php } ?>
          <div class="card white">
            <div class="card-content black-text center">
               <a class="btn-floating btn-large waves-effect waves-light red modal-trigger" 
               href="#edit"><i class="material-icons">edit</i></a>
               <p>Edit profile</p>
            </div>
          </div>
          
</div>
          
        </div>
        </div>
      </div>
  </div>

<!-- Modal Structure -->
<div id="add" class="modal">
    <div class="modal-content">
      <h4 class="center">Add profile</h4>
      <div class="row">
        <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" name="name" class="validate" required>
          <label for="name">Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4">
          <input id="handphone" type="tel" name="handphone" class="validate" pattern="[0-9]{10,11}" required>
          <label for="handphone">Contact Number</label>
        </div>
        <div class="input-field col s4">
          <input id="age" type="number" name="age" class="validate" min="18" max="70" required>
          <label for="age">age</label>
        </div>
        <div class="input-field col s4">
        <select required name="gender">
          <option value="" disabled selected>Choose your option</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <label>Gender</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
        <select required name="Education_Level">
            <option value="" disabled selected>Choose your option</option>
            <option value="Master in yoga">Master in yoga</option>
            <option value="Bachelor degree in yoga">Bachelor degree in yoga</option>
            <option value="Diploma in yoga therapy">Diploma in yoga therapy</option>
        </select>
        <label>Education Level</label>
        </div>
        
      </div>

      <div class="modal-footer">
      <button class="btn waves-effect waves-light" type="submit" name="add">Submit
    <i class="material-icons right">send</i>
  </button>
    </div>
  
    </form>
      </div>

    </div>
    
  </div>
<?php
    $username = $_SESSION['username'];

    $sql2 ="SELECT * from instructor WHERE username=:username LIMIT 1";
$query1= $dbh -> prepare($sql2);
$query1-> bindParam(':username', $username, PDO::PARAM_STR);
$query1-> execute();
$results=$query1->fetchAll(PDO::FETCH_OBJ);


if($query1->rowCount() > 0)
{
  foreach($results as $result){


}

} 

  


?>

  
<div id="edit" class="modal">
    <div class="modal-content">
      <h4 class="center">Edit profile</h4>
      <div class="row">
        <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" value="<?php echo htmlentities($result->name);?>" type="text" name="name" class="validate" required>
          <label for="name">Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4">
          <input id="handphone" value="<?php echo htmlentities($result->handphone);?>" type="tel" name="handphone" class="validate" pattern="[0-9]{10,11}" required>
          <label for="handphone">Contact Number</label>
        </div>
        <div class="input-field col s4">
          <input id="age" type="number" value="<?php echo htmlentities($result->age);?>" name="age" class="validate" min="18" max="70" required>
          <label for="age">age</label>
        </div>
        <div class="input-field col s4">
        <select required class="validate" name="gender">
          <option value="" disabled selected><?php echo htmlentities($result->gender);?></option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <label>Gender</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
        <select required class="validate" name="Education_Level" >
            <option value="" disabled selected><?php echo htmlentities($result->Education_Level);?></option>
            <option value="Master in yoga">Master in yoga</option>
            <option value="Bachelor degree in yoga">Bachelor degree in yoga</option>
            <option value="Diploma in yoga therapy">Diploma in yoga therapy</option>
        </select>
        <label>Education Level</label>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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