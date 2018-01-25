<?php
include '../sourses/db_connection.php';

/**
 *
 */
class Delete_Records extends Db_Connection
{
  public function delete_record($id)
  {
    $sql="UPDATE `students` SET `is_deleted`=1 WHERE `student_id`='$id'";
    mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
    return "Successfully Deleted";
  }
}
if(isset($_GET['id']))
{
  $obj=new Delete_Records();
  $actual_last_id=$_GET['id'];
  $msg=$obj->delete_record($actual_last_id);
  header("location:student_show_data.php?msg=$msg");
}
 ?>
