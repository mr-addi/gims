<?php
include '../sourses/db_connection.php';

/**
 *
 */
class Delete_Records extends Db_Connection
{
  public function delete($id)
  {
    $sql="UPDATE `students` SET `is_deleted`=1 WHERE `student_id`='$id'";
    mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
    return "Successfully Deleted";
  }
}
if(isset($_GET['del']))
{
    $re=$_GET['del'];
  $obj=new Delete_Records();
  $msg=$obj->delete($re);
  header("location:../student_show_data.php");
}

