<?php



include('includes/config.php');

if(isset($_POST["id"]))
{
  $id = $_POST['id'];		
  $classname = $_POST['title'];
  $stime = $_POST['start'];
  $etime = $_POST['end'];

 $sql="UPDATE class SET classname=:classname, stime=:stime, etime=:etime WHERE id=:id";
 $query = $dbh->prepare($sql);
 $query->bindParam(':classname',$classname,PDO::PARAM_STR);
 $query->bindParam(':stime',$stime,PDO::PARAM_STR);
 $query->bindParam(':etime',$etime,PDO::PARAM_STR);
 $query->bindParam(':id',$id,PDO::PARAM_STR);
 $query->execute();
 	
}

?>