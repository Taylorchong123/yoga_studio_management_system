<?php
session_start();
error_reporting(0);
include('includes/config.php');
$data = array();

$sid = $_SESSION['sid'];
$sql2="SELECT * FROM subscription WHERE id=:sid";
$query2 = $dbh->prepare($sql2);
$query2->bindParam(':sid',$sid,PDO::PARAM_STR);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
  foreach($results2 as $result2){
     
      $sname = $result2->sname;
      $classname = substr($sname,0,1).'%';
      $status ='active';
      $sql = "SELECT * FROM class  WHERE status =:status AND classname Like :classname ORDER BY id";
      $query = $dbh->prepare($sql);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->bindParam(':classname',$classname,PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
            
foreach($results as $result)
{
 if($result->dom==0){

 $data[] = array(
  'id'   => $result->id,
  'title'   => $result->classname,
  'start'   => $result->stime,
  'end'   => $result->etime,
    'ranges' => array(
    0 => array(
        'start' =>'2010-01-01',
        'end' => '2100-01-01',
    )

),
  'participant' => $result->participant,
  'instructor' => $result->instructor,
  'classroom' => $result->classroom
 );
 

}
else{
$startRecur=substr((string)$result->stime,0,10);
$endRecur=substr((string)$result->etime,0,10);
$startTime = substr((string)$result->stime,10,18);
$endTime = substr((string)$result->etime,10,18);

 $data[] = array(
  'id'   => $result->id,
  'title'   => $result->classname,
  'start'   => $startTime,
  'end'   => $endTime,  
  'dow'   =>$result->dom,
  'ranges' => array(
    0 => array(
        'start' => $startRecur,
        'end' => $endRecur,
    )

),
  'participant' => $result->participant,
  'instructor' => $result->instructor,
  'classroom' => $result->classroom,
  'allDay'=> false
 );

}

}
  
}

echo json_encode($data);
?>