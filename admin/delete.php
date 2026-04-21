<?php

include('includes/config.php');

if(isset($_POST["id"]))
{
 $id = $_POST['id'];
 $sql = "DELETE from class WHERE id=:id";
 $query = $dbh->prepare($sql);
 $query->bindParam(':id',$id,PDO::PARAM_STR);
 $query->execute();
 
}

?>