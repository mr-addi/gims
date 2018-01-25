<?php
/*

  title:this class handles all the opertions of Degrees
 */
 require_once 'dbconnection.php';
class degree
{
  private $_deg_id;
  private $_deg_title;
  private $_deg_subj="";
  function __construct()
  {
  }
  public function insert_degree($title,$subj)
  {
    $deg_title    =mysqli_real_escape_string($GLOBALS['con'],$title);
    $deg_subj     =mysqli_real_escape_string($GLOBALS['con'],$subj);
    $insrt_query  ="INSERT INTO degrees(degree_name, degree_subject_name) VALUES ('$deg_title','$deg_subj')";
    $insrt_exe    =mysqli_query($GLOBALS['con'],$insrt_query) or die(mysqli_error($GLOBALS['con']));
    header('Location: ..\degrees_page.php');
  }
  public function get_all_degrees_record()
  {
    $slct_query ="SELECT * FROM degrees WHERE degree_deleted='0'";
    $slct_exe  =mysqli_query($GLOBALS['con'],$slct_query) or die(mysqli_error($GLOBALS['con']));
    return $slct_exe;
  }
  public function get_all_degrees_record_by_id($id)
  {
    $slct_query ="SELECT * FROM degrees WHERE degree_id='$id' ";
    $slct_exe  =mysqli_query($GLOBALS['con'],$slct_query) or die(mysqli_error($GLOBALS['con']));
    return $slct_exe;
  }
  public function delete_degree($id)
  {
    $del_query="UPDATE degrees SET degree_deleted='1' WHERE degree_id='$id'";
    $del_exe=mysqli_query($GLOBALS['con'],$del_query) or die(mysqli_error($GLOBALS['con']));
    header('Location: ..\degrees_page.php');
  }
  public function update_degree($id,$title,$subj)
  {
    $del_query="UPDATE `degrees` SET `degree_name`='$title',`degree_subject_name`='$subj' WHERE `degree_id`='$id'";
    $del_exe=mysqli_query($GLOBALS['con'],$del_query) or die(mysqli_error($GLOBALS['con']));
    header('Location: ..\degrees_page.php');
  }
}

?>
