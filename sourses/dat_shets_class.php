<?php
require_once 'dbconnection.php'; //including the connection
/**
* classs for DATE SHEET
*/
class dates_sheets
{

  function __construct()
  {
    # code...
  }
  public function insert_date_sheet($session,$class,$section,$term,$paper_code,$paper_title,$paper_type,$date,$time_from,$time_to,$call_from)
  {
    $insert_query="INSERT INTO `date_sheets`(`session_id`, `class_id`, `class_section`, `slip_term`, `paper_code`, `paper_title`, `paper_type`, `date`, `time_from`, `time_to`)
    VALUES ('$session','$class','$section','$term','$paper_code','$paper_title','$paper_type','$date','$time_from','$time_to')";
    $exe_insert=mysqli_query($GLOBALS['con'],$insert_query) or die(mysqli_error($GLOBALS['con']));
    if ($exe_insert) {
      // echo "<script> alert('successfuly Deleted record')</script>";
      if ($call_from=="edit") {
        header('Location:../date_sheet.php?msg=successfuly Updated record');//redirecting to main page of courses
      }
      else {
        header('Location:date_sheet.php?msg=successfuly Inserted record');//redirecting to main page of courses
      }
    }else {
      // echo "<script> alert(".mysqli_error($GLOBALS['con']).")</script>";
      if ($call_from=="edit") {
        header('Location:../date_sheet.php?msg=Error Updating record');//redirecting to main page of courses
      }
      else {
        header('Location:date_sheet.php?msg=Error Inserting record');//redirecting to main page of courses
      }
      // header('Location:date_sheet.php?msg=Error Inserting record');//redirecting to main page of courses
    }
    // header("location: date_sheet.php?msg='successfuly entered the record'");
  }
  public function get_class_date_sheet($term,$session,$class,$section)
  {
    $search_query="SELECT `paper_code`, `paper_title`, `paper_type`, `date`, `time_from`, `time_to`
                      FROM `date_sheets`
                      WHERE `session_id`='$session'
                      AND `class_id`='$class'
                      AND `class_section`='$section'
                      AND `slip_term`='$term'
                      ORDER BY `date` ASC";
    $query_exe=mysqli_query($GLOBALS['con'],$search_query) or die(mysqli_error($GLOBALS['con']));
    return $query_exe;
  }
  public function delete_date_sheet($term,$session,$class,$section)
  {
    $delete_query="DELETE FROM `date_sheets`
                    WHERE `session_id`='$session'
                    AND `class_id`='$class'
                    AND `class_section`='$section'
                    AND `slip_term`='$term'";
    $exe_delete=mysqli_query($GLOBALS['con'],$delete_query);
    if (mysqli_affected_rows($GLOBALS['con'])>0) {
      return "true";
    }else {
      return die(mysqli_error($GLOBALS['con']));
    }
    // if ($exe_insert) {
    //   echo "<script> alert('successfuly Deleted record')</script>";
    //    // header('Location:date_sheet.php?msg=successfuly Inserted record');//redirecting to main page of courses
    // }else {
    //   echo "<script> alert(".mysqli_error($GLOBALS['con']).")</script>";
    //   // header('Location:date_sheet.php?msg=Error Inserting record');//redirecting to main page of courses
    // }
    return;
  }
}



?>
