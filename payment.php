<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}

if(isset($_POST['pay'])){
	$_SESSION['login'] = ' ';
	$cardname = $_POST['cardname'];
	$cardnumber = $_POST['cardnumber'];
	$amount = $_SESSION['amount'];
	$id = $_REQUEST['id'];
	$status = "paid";

	$sql="INSERT INTO payment (cardname,cardnumber,amount) VALUES (:cardname,:cardnumber,:amount)";

	  $query = $dbh->prepare($sql);
	  $query->bindParam(':cardname',$cardname,PDO::PARAM_STR);
	  $query->bindParam(':cardnumber',$cardnumber,PDO::PARAM_STR);
	  $query->bindParam(':amount',$amount,PDO::PARAM_STR);
	  $query->execute();

	$run="UPDATE subscription SET status=:status WHERE id=:id";
	  $query2 = $dbh->prepare($run);
	  $query2->bindParam(':id',$id,PDO::PARAM_STR);
	  $query2->bindParam(':status',$status,PDO::PARAM_STR);
	  $query2->execute();


	  echo "<script type = \"text/javascript\">
	                      window.location = (\"thankyou.php\")
	                      </script>";


}

if(isset($_POST['cancel'])){
	$_SESSION['login'] = ' ';
	echo "<script type = \"text/javascript\">
	                      window.location = (\"mysubscription.php\")
	                      </script>";
}




?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/jpg" href="img/a.jpg"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}


<?php
   include('includes/config.php');
   $id =$_SESSION['id'];
	      $sql = "SELECT * from member where id=:id LIMIT 1";
	      $query = $dbh->prepare($sql);
	      $query->bindParam(':id',$id ,PDO::PARAM_STR);
	      $query->execute();
	      $results=$query->fetchAll(PDO::FETCH_OBJ);
	            foreach($results as $result){
              
              
            }


?>
</style>
<script type="text/javascript">
function initPayPalButton() {
          paypal.Buttons({
            style: {
              shape: 'rect',
              color: 'gold',
              layout: 'vertical',
              label: 'paypal',
              
            },

            createOrder: function(data, actions) {
              return actions.order.create({
                purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
              });
            },

            onApprove: function(data, actions) {
              return actions.order.capture().then(function(details) {
                alert('Transaction completed by ' + details.payer.name.given_name + '!');
              });
            },

            onError: function(err) {
              console.log(err);
            }
          }).render('#paypal-button-container');
        }
        initPayPalButton();

  $(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        if(inputValue ==  "card"){
          $('#cardpayment').show();
          $('#paypal').hide();

        }
        else if(inputValue=="paypal"){
          $('#cardpayment').hide();

          $('#paypal').show();
           
      
          
        }
  
    });
});

</script>
</head>
<body>

<h2>Payment form</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form method="post">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" value="<?php echo htmlentities($result->fullname);?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" value="<?php echo htmlentities($result->email);?>">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" value="<?php echo htmlentities($result->address);?>">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" value="<?php echo htmlentities($result->city);?>">
            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" value="<?php echo htmlentities($result->state);?>">
              </div>
              <div class="col-50">
                <label for="zip">Poscode</label>
                <input type="text" id="zip" name="zip" value="<?php echo htmlentities($result->poscode);?>">

              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Choose your Payment Method</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container row">
               <div class="col-50">
              <input type="radio" name="payment" value="card" required > 
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
              </div>
              <div class="col-50">
               <input type="radio" name="payment" value="paypal" checked required>
              <i class="fa fa-cc-paypal" style="color:#169BD7;"></i>
              </div>
            </div>
            <div id="cardpayment" class="cardpayment" style="display: none;">
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" required>
              </div>
            </div>
          </div>
          <div id="paypal">
           <div id="smart-button-container">
            <div style="text-align: center;">
              <div id="paypal-button-container"></div>
            </div>
          </div>
          </div>
          </div>
        </div>
 
  
  
      
        <button class="btn" type="submit" name="pay">Pay</button>
        	
      </form>
      	<form method="post">
         <button class="btn" type="submit" name="cancel" style="background-color: red;">Cancel</button>
        </form>
    </div>
  </div>
  <?php
      	  include('includes/config.php');
	      $id =$_REQUEST['id'];
	      $sql = "SELECT * from subscription where id=:id";
	      $query = $dbh->prepare($sql);
	      $query->bindParam(':id',$id ,PDO::PARAM_STR);
	      $query->execute();
	      $results=$query->fetchAll(PDO::FETCH_OBJ);
	            foreach($results as $result){
              		$_SESSION['amount'] = $result->price;
                  $_SESSION['sid'] = $result->id;
            }

      ?>
  <div class="col-25">
    <div class="container">
      
    
     	
      <p><span style="margin-right: 20%;"><?php echo htmlentities($result->sname);?></span><span class="price">RM<?php echo htmlentities($result->price);?></span></p>
     
      <hr>
      <p>Total <span class="price" style="color:black"><b>RM<?php echo htmlentities($result->price);?></b></span></p>
    </div>
  </div>
</div>


</body>
</html>
