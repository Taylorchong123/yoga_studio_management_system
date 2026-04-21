<?php
session_start();
error_reporting(0);
include('includes/config.php');

$data = array();
$status ='active';
$fullname = $_SESSION['fullname'];
$sql = "SELECT student_enroll.id, student_enroll.classname, student_enroll.start, student_enroll.end_class, student_enroll.teacher, class.classroom, student_enroll.status, class.student FROM student_enroll LEFT JOIN class ON student_enroll.classname = class.classname WHERE student_enroll.status =:status AND student_enroll.student =:fullname ORDER BY student_enroll.id";
$query = $dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
          

foreach($results as $result)
{

 $data[] = array(
  'id'   => $result->id,
  'title'   => $result->classname,
  'start'   => $result->start,
  'end'   => $result->end_class,
  'instructor' => $result->teacher,
  'classroom' => $result->classroom,
  'student'   => $result->student

 );
}

echo json_encode($data);

?>