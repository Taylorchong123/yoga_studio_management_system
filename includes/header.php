  
<?php 
  if($_SESSION["login"])
{
?> 
  <div class="navbar-fixed">
   <nav class="teal">
      <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo">KristenYogaStudio</a>
        <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Home</a></li>
          <li><a href="dashboard.php">Member Account</a></li>
          <li><a href="#aboutus">About us</a></li>
          <li><a href="index.php#subcription">Subscription Menu</a></li>
          <li><a href="logout.php">Logout</a></li> 
        </ul>
      </div>
    </nav>
  </div>
  <ul class="sidenav" id="mobile-nav">
    <li><a href="index.php">Home</a></li>
          <li><a href="#">My subcription</a></li>
          <li><a href="#aboutus">About us</a></li>
          <li><a href="#">Schedule</a></li>
          <li><a href="#">Subscription Menu</a></li>
          <li><a href="logout.php">Logout</a></li>
</ul>
  <?php } else { ?>

  <div class="navbar-fixed">
   <nav class="teal">
      <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo">KristenYogaStudio</a>
        <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Home</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Member Login</a></li>
          <li><a href="#aboutus">About us</a></li>
          <li><a href="login.php">Schedule</a></li>
          <li><a href="index.php#subcription">Subscription Menu</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <ul class="sidenav" id="mobile-nav">
    <li><a href="index.php">Home</a></li>
    <li><a href="register.php">Register</a></li>
    <li><a href="login.php">Member Login</a></li>
    <li><a href="#aboutus">About us</a></li>
    <li><a href="login.php">Schedule</a></li>
    <li><a href="#subcription">Subscription</a></li>
</ul>
   <?php } ?>


  