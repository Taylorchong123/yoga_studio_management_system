<!DOCTYPE html>
<html lang="en">
<head>

  <title>Yoga Malaysia | Kristen Yoga </title>
  <link rel="shortcut icon" type="image/jpg" href="images/a.jpg"/>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
  <div class="container">
  	<div class="center" style="margin-top: 20%">
  		<div class="preloader-wrapper active">
	    <div class="spinner-layer spinner-blue-only">
	      <div class="circle-clipper left">
	        <div class="circle"></div>
	      </div><div class="gap-patch">
	        <div class="circle"></div>
	      </div><div class="circle-clipper right">
	        <div class="circle"></div>
	      </div>
	    </div>
  	</div>
  	<div class="row">
  		<h5>Updating...</h5>
  	</div>


  	</div>
  </div>	
  	
  	
  </body>
</html>
<?php

	include 'includes/config.php';
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM subscription_information WHERE id =:id";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':id',$id,PDO::PARAM_STR);
	$query->execute();
	

	?>
	 <meta content="2; subscription.php" http-equiv="refresh" />