<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']=' ';
}

if(isset($_POST["title"]) && isset($_POST["start"]) && isset($_POST["end"]) 
	&& isset($_POST["teacher"]) && isset($_POST["id"]))
{

  $classname = $_POST['title'];
  $start = $_POST['start'];
  $end_class = $_POST['end'];
  $teacher = $_POST['teacher'];
  $student = $_SESSION['fullname'];
  $status = 'active';
  $id = $_POST['id'];
  $sid= $_POST['sid'];
  
  $stmt="SELECT * FROM student_enroll WHERE classname=:classname AND start=:start AND end_class=:end_class AND teacher=:teacher AND student=:student";
  $q = $dbh->prepare($stmt);
  $q->bindParam(':classname',$classname,PDO::PARAM_STR);
  $q->bindParam(':start',$start,PDO::PARAM_STR);
  $q->bindParam(':end_class',$end_class,PDO::PARAM_STR);
  $q->bindParam(':teacher',$teacher,PDO::PARAM_STR);
  $q->bindParam(':student',$student,PDO::PARAM_STR);
  $q->execute();
  $r=$q->fetchAll(PDO::FETCH_OBJ);
  
if($q->rowCount() > 0){

    echo "<script type = \"text/javascript\">
                      alert(\"Book failed. You had book the same class before\");
                      window.location = (\"mysubscription.php\")
                      </script>";


 }   

 else{	
 $sql= "
 INSERT INTO student_enroll 
 (classname, start, end_class, teacher, student,subscription_ID,class_ID,status) 
 VALUES (:classname, :start, :end_class, :teacher, :student,:sid,:id,:status)";
  
$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->bindParam(':start',$start,PDO::PARAM_STR);
$query->bindParam(':end_class',$end_class,PDO::PARAM_STR);
$query->bindParam(':teacher',$teacher,PDO::PARAM_STR);
$query->bindParam(':student',$student,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();

  
	
$run2 ="UPDATE subscription SET class_times=class_times-1 WHERE id=:sid";
$query3 = $dbh->prepare($run2);
$query3->bindParam(':sid',$sid,PDO::PARAM_STR);
$query3->execute();


$run = "UPDATE class SET student = student+1 WHERE id =:id ";
$query2 = $dbh->prepare($run);
$query2->bindParam(':id',$id,PDO::PARAM_STR);
$query2->execute();



echo "<script type = \"text/javascript\">
                      alert(\"Book successfully\");
                      window.location = (\"mysubscription.php\");
                      </script>";
}
}
?>