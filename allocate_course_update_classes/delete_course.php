<?php
require_once '../sourses/dbconnection.php';
echo $key=$_GET['del'];
$ids=explode("@",$key);

$sql="DELETE FROM `students_classes_courses` WHERE `student_id`=$ids[0] AND  `session_id`=$ids[1] AND `course_id`=$ids[2]";
$respons=mysqli_query($GLOBALS['con'],$sql);
header("location:manage_course_allocation.php?rsp=$respons");
 ?>
