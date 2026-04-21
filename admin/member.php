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
      <li class="active"><a href="member.php" class="waves-effect  "><i class="material-icons pink-text">group</i>Member</a></li>
      <li><a href="instructor.php" class="waves-effect"><i class="material-icons pink-text">person</i>Instructor</a></li>
      <li><a href="class.php" class="waves-effect"><i class="material-icons pink-text">class</i>Class</a></li>
      <li><a href="classroom.php" class="waves-effect"><i class="material-icons pink-text">store</i>Classroom </a></li>
      <li><a href="subscription.php" class="waves-effect"><i class="material-icons pink-text">subscriptions</i>Subscription Menu</a></li>
       <li><a href="report.php" class="waves-effect"><i class="material-icons pink-text">assignment</i>Report</a></li>
      <li><div class="divider"></div></li>
      <li><a href="logout.php" class="waves-effect"><i class="material-icons pink-text">exit_to_app</i>Logout</a></li>
</ul>

<?php
  
$sql ="SELECT * from member";
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
              <th>Fullname</th>
          <!--     <th>Email</th> -->
              <th>Gender</th>
              <th>Address</th>
              <th>Handphone</th>
              <th>Age</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
        </thead>
        <?php foreach($results as $result){?>
        <tbody>
          
          <tr>
            <td><?php echo htmlentities($result->fullname);?></td>
           <!--  <td><?php echo htmlentities($result->email);?></td> -->
            <td><?php echo htmlentities($result->gender);?></td>
            <td><?php echo htmlentities($result->address);?></td>
            <td><?php echo '0'.htmlentities($result->handphone);?></td>
            <td><?php echo htmlentities($result->age);?></td>
            <td><?php echo htmlentities($result->status);?></td>
            <td>

           <?php
               

                  if($result->status=='not verify'){
              ?>

              <a href="verifymember.php?id=<?php echo htmlentities($result->id);?>" type="submit"><i class="material-icons left" style="color:green;">radio_button_unchecked</i></a>
               <a href="deletemember.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')"><i class="material-icons center" style="color: red;">delete</i></a>
              <?php } elseif($result->status=='verify'){ ?>
                 <a href="unverifymember.php?id=<?php echo htmlentities($result->id);?>"><i class="material-icons left" style="color: green;">radio_button_checked</i></a>

                <a href="deletemember.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure?')"><i class="material-icons left" style="color: red;">delete</i></a>
              <?php } else{}?>
            </td>
          </tr>
          <?php }}?>
        </tbody>
      </table>


    </div>

  </div>
  <div class="center">
      <ul class="pagination pager" id="myPager"></ul>
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