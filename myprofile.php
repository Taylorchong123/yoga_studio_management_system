<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']=' ';

}

if(isset($_POST['edit'])){
  $id = $_SESSION['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $handphone = $_POST['handphone'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];

  $sql="UPDATE member SET fullname=:name,email=:email,gender=:gender,address=:address,handphone=:handphone,age=:age WHERE id=:id";

  $query = $dbh->prepare($sql);
  $query->bindParam(':name',$name,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':handphone',$handphone,PDO::PARAM_STR);
  $query->bindParam(':age',$age,PDO::PARAM_STR);
  $query->bindParam(':gender',$gender,PDO::PARAM_STR);
  $query->bindParam(':address',$address,PDO::PARAM_STR);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->execute();

  echo "<script type = \"text/javascript\">
                      alert(\"Successfully edit profile.\");
                      window.location = (\"myprofile.php\")
                      </script>";


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
      $password =$_SESSION['password'];
      $sql = "SELECT * from member where password=:password";
      $query = $dbh->prepare($sql);
      $query->bindParam(':password',$password ,PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
            foreach($results as $result){
              $_SESSION['id'] = $result->id;
              
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

      <li class="active"><a href="myprofile.php" class="waves-effect  "><i class="material-icons">mode_edit</i>My profile</a></li>
      <li><a href="myschedule.php" class="waves-effect"><i class="material-icons">event_note</i>My schedule</a></li>
      <li><a href="mysubscription.php" class="waves-effect"><i class="material-icons">assignment_turned_in</i>My subscription</a></li>
      <li><a href="myteacher.php" class="waves-effect"><i class="material-icons">face</i>My Teacher</a></li>
</ul>



<div class="main">
      <div class="row">
        <div class="col s12 center">
          <h5>My profile<h5>
        </div>
      </div>
      <div class="row">
        <div class="col s3"></div>
        <div class="col s3 m6 ">
          <div class="card white">
            <a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#edit"><i class="material-icons">edit</i></a>
            <div class="card-content black-text">
              
                <div class="center">
                  <a href="#">
                  <img src="img/<?php echo htmlentities($result->profile);?>" class="circle" style="width: 25%;">
                  </a>
                  <a class="btn-floating fab center  waves-effect waves-light teal darken-3 modal-trigger" href="#add"><i class="material-icons">add</i></a>
              </div>
              <span class="card-title">Your name: <?php echo htmlentities($result->fullname);?></span>
              <span class="card-title">Your email: <?php echo htmlentities($result->email);?></span>
              <span class="card-title">Your gender: <?php echo htmlentities($result->gender);?></span>
              <span class="card-title">Your address: <?php echo htmlentities($result->address);?></span>
              <span class="card-title">Your age: <?php echo htmlentities($result->age);?></span>
            </div>
          </div>
        </div>
      </div>
</div>

<div id="add" class="modal">
    <div class="modal-content">
      <h4 class="center">Change Profile Picture</h4>
        <form class="col s12" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" name="image">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
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
  if(isset($_POST['add'])){
    $target_path = "img/";
    $target_path = $target_path . basename ($_FILES['image']['name']);
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
                
      $image = basename($_FILES['image']['name']);
      $password = $_SESSION['password'];
      $sql = "UPDATE member SET profile=:image WHERE password=:password";
      $query = $dbh->prepare($sql);
      $query->bindParam(':image',$image ,PDO::PARAM_STR);
      $query->bindParam(':password',$password ,PDO::PARAM_STR);
      $query->execute();

      echo "<script type = \"text/javascript\">
                      alert(\"Successfully change picture.\");
                      window.location = (\"myprofile.php\")
                      </script>";
    }
  }



?>


<div id="edit" class="modal">
    <div class="modal-content">
      <h4 class="center">Edit profile</h4>
      <div class="row">
        <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input id="name" value="<?php echo htmlentities($result->fullname);?>" type="text" name="name" class="validate" >
          <label class="active" for="name">Name</label>
        </div>
        <div class="input-field col s6">
          <input id="email" value="<?php echo htmlentities($result->email);?>" type="email"  name="email" class="validate" >
          <label class="active" for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4">
          <input id="handphone" value="<?php echo '0'.htmlentities($result->handphone);?>" type="tel" name="handphone" class="validate" pattern="[0-9]{10,11}" >
          <label class="active" for="handphone">Contact Number</label>
        </div>
        <div class="input-field col s4">
          <input id="age" type="number"  name="age" class="validate" min="18" max="70" value="<?php echo htmlentities($result->age);?>" >
          <label class="active" for="age">age</label>
        </div>
        <div class="input-field col s4">
        <select name="gender" value="<?php echo htmlentities($result->gender);?>" >
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <label>Gender</label>
        </div>
      </div>
      <div class="row">
          <div class="input-field col s12">
            <textarea id="address" class="materialize-textarea validate" name="address"><?php echo htmlentities($result->address);?></textarea>
            <label class="active" for="address">Address</label>
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

     const select = document.querySelectorAll('select');
    M.FormSelect.init(select,{});
   


  </script>

  </body>
</html>