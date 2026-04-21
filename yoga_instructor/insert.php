<?php

//insert.php

include('includes/config.php');

if(isset($_POST["title"]))
{
  $classname = $_POST['title'];
  $stime = $_POST['start'];
  $etime = $_POST['end'];	

 $sql= "
 INSERT INTO class 
 (classname, stime, etime) 
 VALUES (:classname, :stime, :etime)
 ";
$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->bindParam(':stime',$stime,PDO::PARAM_STR);
$query->bindParam(':etime',$etime,PDO::PARAM_STR);

 $query->execute();
  // array(
  //  ':title'  => $_POST['title'],
  //  ':start_event' => $_POST['start'],
  //  ':end_event' => $_POST['end']
  // )
 
}


?>