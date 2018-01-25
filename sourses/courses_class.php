<?php
/*

  title:this class handles all the opertions of courses
 */
 include 'dbconnection.php';
 require 'databas_query_function.php';
class course
{
    // declaring the private datamembers
  private $id;
  private $code;
  private $title;
  private $cr_hr;
  private $lab;
  private $type;
  // declared the private datamembers
  function __construct()//constructor
  {
  }
  //function to insert new record into the courses table
  public function insert_course($code,$title,$cr_hr,$lab,$type) {
    $course_code    =mysqli_real_escape_string($GLOBALS['con'],$code);
    $course_title   =mysqli_real_escape_string($GLOBALS['con'],$title);
    $course_cr_hr   =mysqli_real_escape_string($GLOBALS['con'],$cr_hr);
    $course_lab     =mysqli_real_escape_string($GLOBALS['con'],$lab);
    $course_type    =mysqli_real_escape_string($GLOBALS['con'],$type);
    $insrt_query    ="INSERT INTO courses(course_code, course_title, course_credit_hours, course_lab, course_type)
                          VALUES ('$course_code','$course_title','$course_cr_hr','$course_lab ','$course_type')";
    $insrt_exe      =mysqli_query($GLOBALS['con'],$insrt_query);
    if ($insrt_exe) {
      // echo "<script> alert('successfuly Deleted record')</script>";
       header('Location:..\courses_page.php?msg=successfuly Inserted record');//redirecting to main page of courses
    }else {
      // echo "<script> alert(".mysqli_error($GLOBALS['con']).")</script>";
      header('Location:..\courses_page.php?msg=Error Inserting record');//redirecting to main page of courses
    }
  }
  public function get_all_courses_record() { //funtion to get all records off the courses
    $slct_query ="SELECT * FROM courses WHERE course_deleted='0'";
    $slct_exe  =mysqli_query($GLOBALS['con'],$slct_query) or die(mysqli_error($GLOBALS['con']));
    return $slct_exe; //returning all the courses records
  }
  public function get_all_courses_by_id($id) { // function to get the courses all record by "ID"
    $slct_query ="SELECT * FROM courses WHERE course_id='$id' AND course_deleted='0'";
    $slct_exe  =mysqli_query($GLOBALS['con'],$slct_query) or die(mysqli_error($GLOBALS['con']));
    return $slct_exe;// return the record
  }
  public function delete_course($id) { //deleting the whole course
    $del_query="DELETE FROM `courses` WHERE course_id='$id'";
    $del_exe=mysqli_query($GLOBALS['con'],$del_query);
    if ($del_exe) {
       header('Location:..\courses_page.php?msg=successfuly Deleted record');//redirecting to main page of courses
    }else {
      header('Location:..\courses_page.php?msg=Error Deleting record');//redirecting to main page of courses
    }
  }
  //function to update the walue of the courses
  public function update_course($id,$cod,$titl,$crhr,$lab,$type) {
    $upd_query="UPDATE courses
                  SET course_code='$cod',course_title='$titl',course_credit_hours='$crhr',course_lab='$lab',course_type='$type'
                   WHERE course_id='$id'";
    $dupd_exe=mysqli_query($GLOBALS['con'],$upd_query);
    if ($dupd_exe) {
       header('Location:..\courses_page.php?msg=successfuly Updated record');//redirecting to main page of courses
    }else {
      header('Location:..\courses_page.php?msg=Error Updating record');//redirecting to main page of courses
    }
  }
  //function to get the courses code and name
  public function get_id_code_name($id)
  {
    if($id==""){
      $slct_qry="SELECT course_id,course_code,course_title FROM courses WHERE course_deleted='0'";
      $exe_qry=mysqli_query($GLOBALS['con'],$slct_qry) or die(mysqli_error($GLOBALS['con']));
    } else {
      $slct_qry="SELECT course_id,course_code,course_title FROM courses WHERE course_id = $id AND course_deleted='0'";
      $exe_qry=mysqli_query($GLOBALS['con'],$slct_qry) or die(mysqli_error($GLOBALS['con']));
    }
    return $exe_qry;
  }

  //get courses allocated to student by ID

  public function student_course_allocated($student_id)
  {
    $sql="SELECT DISTINCT c1.course_title,c1.course_code,c1.course_id
    FROM students AS s1
    JOIN students_classes_courses as scc1 ON s1.student_id=scc1.student_id AND s1.student_current_session=scc1.session_id
    JOIN courses AS c1 ON c1.course_id=scc1.course_id
    WHERE s1.student_id=$student_id";
    $obj=new Db_Query();
    $result_data=$obj->execute($sql);

    return $result_data;
  }

}

?>
