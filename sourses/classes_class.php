<?php
/*
  title : the classs for the Semster name and no
 */
  require_once 'dbconnection.php'; //including the connection
class classes
{
  private $class_id; //private datamember Class id
  private $class_name;//private datamember Class name

  function __construct() //constructor of class
  {
  }
  public function insert_data_rt_id($title) // function to insert data into the Classes table
  {
    $insrt_qry="INSERT INTO classes(class_name) VALUES ('$title')";
    $insrt_exe=mysqli_query($GLOBALS['con'],$insrt_qry);// or die(mysqli_error($GLOBALS['con']));
    $id = mysqli_insert_id($GLOBALS['con']);
    if ($insrt_exe) {
      // header('Location: ..\class_page.php?msg=successfuly Inserted record');//redirecting to main page of courses
      echo "<script> alert('successfuly entered record')</script>";
    }else {
      // header('Location: ..\class_page.php?msg=Error Inserting record');//redirecting to main page of courses
      echo "<script> alert('Error Inserting record')</script>";
    }

    return $id;
  }
  public function get_all_classes_data() //functio to get all the data
  {
    $slct_qry="SELECT * FROM classes WHERE class_deleted='0'";
    $slct_exe=mysqli_query($GLOBALS['con'],$slct_qry) or die(mysqli_error($GLOBALS['con']));

    return $slct_exe;
  }
  public function delete_class($id)
  {
    $upd_qry="UPDATE classes SET class_deleted='1' WHERE class_id='$id'";
    $upd_exe=mysqli_query($GLOBALS['con'],$upd_qry);
    if ($upd_exe) {
      // echo "<script> alert('successfuly Deleted record')</script>";
       header('Location: ..\class_page.php?msg=successfuly Deleted record');//redirecting to main page of courses
    }else {
      // echo "<script> alert(".mysqli_error($GLOBALS['con']).")</script>";
      header('Location: ..\class_page.php?msg=Error Deleting record');//redirecting to main page of courses
    }
    // header('Location: ..\class_page.php');//redirecting to main page of courses
  }
  public function get_class_by_id($value)
  {
    $selct_qry="SELECT c1.`class_name`,d1.degree_id,c2.course_id
                FROM `classes` AS c1,
                      `degrees` AS d1,
                      `courses` AS c2,
                      `classes_courses` AS cc
                WHERE c1.`class_id`='$value'
                      AND c1.`class_deleted`=0
                      AND cc.`class_id`=c1.`class_id`
                      AND d1.`degree_id`=cc.`degree_id`
                      AND c2.`course_id`=cc.`course_id`";
    $selct_exe=mysqli_query($GLOBALS['con'],$selct_qry);
    return $selct_exe;

  }
  public function select_classes_by_function($value)
  {
    $select_cls="SELECT DISTINCT a1.`class_id`,a2.`class_name` FROM `classes_courses` AS a1,classes as a2 WHERE `degree_id`=$value AND a2.`class_id`=a1.`class_id`";
    $slct_exe=mysqli_query($GLOBALS['con'],$select_cls);
    return $slct_exe;
  }
  public function get_classes_courses_by_session($value)
  {

    $sql="SELECT c1.class_id,c1.class_name,cu1.course_id,co1.course_title
    FROM  session_classes as sc1
    JOIN classes as c1 ON c1.class_id=sc1.class_id
    JOIN classes_courses as cu1 ON cu1.class_id=sc1.class_id
    JOIN courses as co1 ON co1.course_id=cu1.course_id
    WHERE sc1.session_id=$value";
    $class_course=mysqli_query($GLOBALS['con'],$sql);
    return $class_course;
  }
  public function valid_next_session_class($session_id)
  {
    $sql="SELECT  `session_type`, `session_year` FROM `sessions` WHERE `session_id`=$session_id";
    $data=mysqli_query($GLOBALS['con'],$sql);
    $session_type="";
    $session_year="";
    if ('fall'==mysqli_fetch_assoc($data['session_type'])) {
      $session_type="spring";

    }
  }

  public function get_course_by_class($class_id)
  {
    $sql="SELECT c1.course_title,c1.course_code,c1.course_id
FROM classes_courses AS cc1
JOIN courses AS c1 ON c1.course_id=cc1.course_id
WHERE cc1.class_id=$class_id";
    $data=mysqli_query($GLOBALS['con'],$sql);
      return $data;

  }
}

 ?>
