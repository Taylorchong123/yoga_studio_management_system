<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST["id"]))
{
	

 $id = $_POST['id'];

 $sql3= "SELECT * FROM student_enroll WHERE id=:id LIMIT 1";
 $query4 = $dbh->prepare($sql3);
 $query4->bindParam(':id',$id,PDO::PARAM_STR);
 $query4->execute();
 $results=$query4->fetchAll(PDO::FETCH_OBJ);
    foreach($results as $result){
      $class_ID = $result->class_ID;
      $subscription_ID = $result->subscription_ID;

     $sql2 = "UPDATE subscription SET class_times=class_times+1 WHERE 
     id=:subscription_ID";
	 $query2 = $dbh->prepare($sql2);
	 $query2->bindParam(':subscription_ID',$subscription_ID,PDO::PARAM_STR);
	 $query2->execute();

	 $run = "UPDATE class SET student = student-1 WHERE id =:class_ID";
	 $query3 = $dbh->prepare($run);
	 $query3->bindParam(':class_ID',$class_ID,PDO::PARAM_STR);
	 $query3->execute();
              
    }



 $sql = "DELETE from student_enroll WHERE id=:id";
 $query = $dbh->prepare($sql);
 $query->bindParam(':id',$id,PDO::PARAM_STR);
 $query->execute();

 
 
 
}

?>