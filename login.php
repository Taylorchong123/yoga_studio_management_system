<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{
  //code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT * from member WHERE email=:email and password=:password Limit 1";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
   $_SESSION['login']=$email;
  foreach($results as $result){

        $_SESSION['login']=$email;
        $_SESSION['email'] =$email;
        $_SESSION['password'] =$password;
        $_SESSION['id']=$result->id;
        $_SESSION['fullname'] = $result->fullname;

 echo "<script type = \"text/javascript\">
                      alert(\"Successfully Login.\");
                      window.location = (\"dashboard.php\")
                      </script>";

}

} 

else{
echo "<script>alert('Enter your email and password again');</script>";
}

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
</head>
<body>
  
  <?php include 'includes/header.php'?>
  
  <section>
     <div class="container">
      <div class="row">
        <div class="col s12 m3">
        </div>

        <div class="col s12 m6">
          <div class="card">
            <div class="card-content white-text teal lighten-1">
              <h5 class="center">Login</h5>
            </div>
            <div class="card-action">
              <div class="row">
      <form class="col s12" method="post">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="email" class="validate" name="email" required >
          <label for="icon_prefix">Email</label>
          <span class="helper-text" data-error="invalid email"></span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 ">
            <i class="material-icons prefix">lock</i>
          <input id="icon_telephone" type="password" class="validate" name="password" required >
          <label for="icon_telephone">Password</label>
        </div>
          </div>
          <div class="row">
         <div class="input-field col s4">
          <input type="text" id="code" name="vercode" maxlength="5" autocomplete="off" style="width: 150px;"  required class="validate" />&nbsp;<img src="captcha.php">
          <label for="code">Verification code</label>
          <span class='helper-text' data-error="required" ></span>
        
        </div>
      </div>
          <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light" type="submit" name="login">Login
    <i class="material-icons right">login</i>
  </button>
          </div>
        </div>
        </form>
        </div>
      
    </div>
            </div>
          </div>
          <div class="col s12 m3">
        </div>
        </div>

        
      </div>
          


  </section>
 

   <?php include 'includes/footer.php' ?>

  <!--  Scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    const sidenav = document.querySelector('.sidenav');
    M.Sidenav.init(sidenav,{});

   


  </script>

  </body>
</html>