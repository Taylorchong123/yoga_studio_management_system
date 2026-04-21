<?php
session_start();
error_reporting(0);

include('includes/config.php');

if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
require('PHPMailer/class.phpmailer.php');
require('PHPMailer/class.smtp.php');
require('PHPMailer/PHPMailerAutoload.php');

if(isset($_POST['add'])){
  $email = $_POST['email'];
  $sql = "SELECT * FROM instructor WHERE email=:email";

$query = $dbh->prepare($sql);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->execute();
if($query->rowCount() > 0)
{
    echo "<script type = \"text/javascript\">
                      alert(\"Email already Exist\");
                      window.location = (\"instructor.php\")
                      </script>";
}
else{
  $min = 30;
  $max = 70;
  $code = rand(100000,999999);
  $password = md5($code);
  $namelength = rand(6,10);
  function random( $length )
    {
    // Set allowed chars
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    // Create username
    $username = "";
    for ( $i = 0; $i < $length; $i++ )
    {
      $username .= $chars[mt_rand(0, strlen($chars))];
    }
    return $username;
    }
  $username = random($namelength);
  $status = "not active";

  $sql1="INSERT INTO instructor(email,username,password,status) VALUES(:email,:username,:password,:status)";

  $query1 = $dbh->prepare($sql1);
  $query1->bindParam(':email',$email,PDO::PARAM_STR);
  $query1->bindParam(':username',$username,PDO::PARAM_STR);
  $query1->bindParam(':password',$password,PDO::PARAM_STR);
  $query1->bindParam(':status',$status,PDO::PARAM_STR);
  $query1->execute();
  $results=$query1->fetchAll(PDO::FETCH_OBJ);
  if (isset($results)) {
              $mail = new PHPMailer();
              $mail->isSMTP();
              $mail->SMTPAuth=true;
              $mail->SMTPSecure = 'ssl';
              $mail->SMTPDebug = 0;
              $mail->Host = 'smtp.gmail.com';
              $mail->Port='465';
              $mail->Username='testforfyp0512@gmail.com';
              $mail->Password='Bobo0512';
              //Recipents
              $mail->SetFrom('no-reply@KristenYogaStudio.org');
              $mail->AddAddress($email);
              //content
              $mail->isHTML(true);
              $mail->Subject = 'Yoga Instructor Account';
              $mail->Body    = "<p>Your Account username is ".$username." and your password is ".$code   ;

              $mail->Send();

              echo "<script type = \"text/javascript\">
                      alert(\"Successfully add instructor. An account is sent to instructor to login\");
                      window.location = (\"instructor.php\")
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
  <link rel="stylesheet" href="https://cdn.rawgit.com/Dogfalo/materialize/fc44c862/dist/css/materialize.min.css">
      <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script  src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
    <script  src="https://cdn.rawgit.com/pinzon1992/materialize_table_pagination/f9a8478f/js/pagination.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
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
    $(document).ready(function(){
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
      <li class="active"><a href="instructor.php" class="waves-effect"><i class="material-icons pink-text">person</i>Instructor</a></li>
      <li><a href="class.php" class="waves-effect"><i class="material-icons pink-text">class</i>Class</a></li>
      <li><a href="classroom.php" class="waves-effect"><i class="material-icons pink-text">store</i>Classroom </a></li>
      <li><a href="subscription.php" class="waves-effect"><i class="material-icons pink-text">subscriptions</i>Subscription Menu</a></li>
       <li><a href="report.php" class="waves-effect"><i class="material-icons pink-text">assignment</i>Report</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons pink-text">exit_to_app</i>Logout</a></li>
</ul>

<?php
  
$sql ="SELECT * from instructor";
$query= $dbh -> prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


if($query->rowCount() > 0)
{








?>


<div class="main">
  <div class="row">
    <div class="col s12">
        <table class="responsive-table table table-hover" id="myTable">
        <thead>
          <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Education Level</th>
              <th>Handphone</th>
              <th>Age</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
        </thead>
        <?php foreach($results as $result){?> 
        <tbody>

          <tr>
            <td><?php echo htmlentities($result->name);?></td>
            <td><?php echo htmlentities($result->email);?></td>
            <td><?php echo htmlentities($result->gender);?></td>
            <td><?php echo htmlentities($result->Education_Level);?></td>
            <td><?php echo htmlentities($result->handphone);?></td>
            <td><?php echo htmlentities($result->age);?></td>
            <td><?php echo htmlentities($result->status);?></td>
            <td>
           <?php
               

                  if($result->status=='not active'){
              ?>
              <a href="activeinstructor.php?id=<?php echo htmlentities($result->id);?>" ><i class="material-icons left" style="color:green;">radio_button_unchecked</i></a>
               <a href="deleteinstructor.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')"><i class="material-icons center" style="color: red;">delete</i></a>
              <?php } elseif($result->status=='active'){ ?>
                <a href="inactiveinstructor.php?id=<?php echo htmlentities($result->id);?>"><i class="material-icons left" style="color: green;">radio_button_checked</i></a>
                <a href="deleteinstructor.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')"><i class="material-icons left" style="color: red;">delete</i></a>
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
        <a class="btn-floating btn-large waves-effect waves-light red modal-trigger" href="#add"><i class="material-icons">add</i></a>
    </div>
  </div>
  <div class="center">
    <ul class="pagination pager" id="myPager"></ul>
</div>
</div>

<div id="add" class="modal">
    <div class="modal-content">
      <h4 class="center">Add instructor</h4>
      <div class="row">
        <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="icon_prefix" type="text" class="validate" name="email" required >
          <label for="icon_prefix">Email</label>
          
          <span class="helper-text" data-error="required"></span>
        </div>
      </div>
      <!-- <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate" name="username" required >
          <label for="icon_prefix">Username</label>
          <span class="helper-text" data-error="required"></span>
        </div>
      </div>
      <div class="row">
          <div class="input-field col s12 ">
            <i class="material-icons prefix">lock</i>
          <input id="icon_telephone" type="password" class="validate" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
          <label for="icon_telephone">Password</label>
          <span class="helper-text" data-error="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"></span>
          </div>
      </div> -->
      <div class="modal-footer">
      <button class="btn waves-effect waves-light" type="submit" name="add">Submit
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