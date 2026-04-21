<?php 
session_start();

include('includes/config.php');

error_reporting(0);
$error = NULL;
if(isset($_POST['signup']))
{  
   
$fullname=$_POST['fullname'];
$handphone=$_POST['handphone'];
$age=$_POST['age'];
$profile="member.png";
$address=$_POST['address'];
$city=$_POST['city'];
$state=$_POST['state'];
$poscode=$_POST['poscode'];
$password=md5(($_POST['password']));
$cpassword=md5(($_POST['cpassword']));
$email=$_POST['email'];
$gender=$_POST['gender'];
$status="verify";
	if ($password == $cpassword)  {
		// $vkey = md5(time().$fullname);

 
$sql="INSERT INTO member (fullname,email,gender,address,city,state,poscode,
handphone,age,profile,password,status) VALUES(:fullname,:email,:gender,:address,:city,
:state,:poscode,:handphone,:age,:profile,:password,:status)";

$query = $dbh->prepare($sql);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':state',$state,PDO::PARAM_STR);
$query->bindParam(':poscode',$poscode,PDO::PARAM_STR);
$query->bindParam(':handphone',$handphone,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':profile',$profile,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();

// if($query){

// 	$to=$email;
// 	$subject="Email verification";
// 	$messages ="<a href='http://localhost/yoga_studio_management_system/verify.php?vkey=$vkey'>Register Account</a>";
// 	$headers ="From: yongwei0512@gmail.com\r\n";
// 	$headers .="MIME-Version: 1.0\r\n";
// 	$headers .="Content-type: text/html;charset=UTF-8\r\n";

// 	  $retval =mail($to,$subject,$messages,$headers);


// 	  if( $retval == true ) {
//             echo "Message sent successfully...";
//          }else {
//             echo "Message could not be sent...";
//          }

	echo "<script type = \"text/javascript\">
                      alert(\"Successfully Registered.\");
                      window.location = (\"index.php\")
                      </script>";

        
    } 

	else{
		
		echo "<script type = \"text/javascript\">
                      alert(\"Password is not match.\");
                      window.location = (\"register.php\")
                      </script>";


// }

// echo "<script type = \"text/javascript\">
//                       alert(\"Successfully Registered.\");
//                       window.location = (\"index.php\")
//                       </script>";


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
  
  <?php include 'includes/header.php'; echo $error;?> 

  <section>
     <div class="container">
      <div class="row">
        <div class="col s12 m2">
        </div>

        <div class="col s12 m8">
          <div class="card">
            <div class="card-content white-text teal lighten-1">
              <h5 class="center">Register</h5>
            </div>
            <div class="card-action">
              <div class="row">
      <form class="col s12" method="post"  name="signup" action="">
      <div class="row">
        <div class="input-field col s4 ">
          <input id="fullname" type="text" name="fullname" class="validate" required>
          <label for="fullname">Fullname</label>
          
        </div>
        <div class="input-field col s4">
          <input id="handphone" type="tel" name="handphone" class="validate" required pattern="[0-9]{10,11}">
          <label for="handphone">Contact Number</label>
          
        
        </div>
        <div class="input-field col s4">
          <input id="age" type="number"  name="age" class="validate" min="10" max="70" required>
          <label for="age">Age</label>
     
        </div>
      </div>
      <div class="row">
	    <div class="col s12">
	      <div class="row">
	        <div class="input-field col s12">
	          <textarea id="address" class="materialize-textarea validate" name="address" required ></textarea>
	          <label for="address">Address</label>
	         	        </div>
	      </div>
	    </div>
	  </div>
    <div class="row">
        <div class="input-field col s4 ">
          <input id="city" type="text" name="city" class="validate" required>
          <label for="city">City</label>
          
        </div>
        <div class="input-field col s4">
          <input id="state" type="text" name="state" class="validate" required>
          <label for="state">State</label>
          
        
        </div>
        <div class="input-field col s4">
          <input id="poscode" type="number"  name="poscode" class="validate" minlength="5" required>
          <label for="poscode">Poscode</label>
     
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password" type="password" name="password" class="validate" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
          <label for="password">Password</label>
          <span class="helper-text" data-error="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"></span>
        </div>
        <div class="input-field col s6">
          <input id="cpassword" type="password" name="cpassword" class="validate" required>
          <label for="cpassword">Confirm Password</label>    
        </div>
      </div>
    
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="email" name="email" class="validate" required>
          <label for="email">Email</label>
          <span class="helper-text" data-error="invalid email"></span>
        </div>
        <div class="input-field col s6">
        	<div class="row">
        		<p class="input-field col s4">
        		 <label for="gender">Gender:</label>
        		</p>
        		<p class="input-field col s4">
			      <label>
			        <input class="with-gap" name="gender" value="Male" id="gender" type="radio" checked />
			        <span>Male</span>
			      </label>
			    </p>
        		
			    <p class="input-field col s4">
			      <label>
			        <input class="with-gap" name="gender" value="Female" id="gender"type="radio"  />
			        <span>Female</span>
			      </label>
			    </p>
			    	
        	</div>
          
        </div>
      </div>
      <div class="row">
        <button class="btn waves-effect waves-light" type="submit" name="signup">Submit
    <i class="material-icons right">send</i>
  </button>
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
 

  <section >
  
  	 <div class="container ">
  	 	<div class="row">
    
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