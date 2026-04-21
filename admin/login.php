<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
if(isset($_POST['alogin']))
{
         
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT * from admin WHERE username=:username and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


if($query->rowCount() > 0)
{
  foreach($results as $result){
  
        $_SESSION['alogin']=$username;
        $_SESSION['username'] =$username;
        $_SESSION['password'] =$password;


 echo "<script type = \"text/javascript\">
                      alert(\"Successfully Login.\");
                      window.location = (\"dashboard.php\")
                      </script>";

}

} 

else{
echo "<script>alert('Invalid Details');</script>";
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
</head>
<body>
  
  <section>
     <div class="container">
      <div class="row">
        <div class="col s12 m3">
        </div>

        <div class="col s12 m6">
          <div class="card">
            <div class="card-content white-text blue-grey">
              <h5 class="center">Admin Login</h5>
            </div>
            <div class="card-action">
              <div class="row">
      <form class="col s12" method="post">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate" name="username" required >
          <label for="icon_prefix">Username</label>
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
      </div>
          <div class="row">
          <div class="input-field col s12 center">
            <button class="btn waves-effect waves-light grey" type="submit" name="alogin">Login
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
 

 

  <!--  Scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  </body>
</html>