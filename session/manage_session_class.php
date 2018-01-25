<?php
if (!class_exists('Db_Connection')) {
require "../sourses/db_connection.php";
# code...
}
class Manage_Session extends Db_Connection
{
  public function insert_session_data()
  {
    $session_type=$_POST['select_session'];
    $session_year=$_POST['select_year'];
    $session_timing=$_POST['select_timing'];
    // $con=mysqli_connect("localhost","root","","masterdb");
      $sql1="SELECT  `session_type`, `session_year` FROM `sessions` WHERE `session_type`='$session_type' AND `session_year`='$session_year'";
      $data=mysqli_query($this->con,$sql1);
      if(mysqli_num_rows($data)>0)
        {
          return $a=2;
        }else {

      $sql="INSERT INTO `sessions`( `session_type`, `session_year`, `session_timming`)
            VALUES ('$session_type','$session_year','$session_timing')";
            $isert_error=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
            return $isert_error;

    }
  }
public function fetch_all_session()
{
  $sql="SELECT * FROM `sessions`";
  $data=mysqli_query($this->con,$sql);
  return $data;
}
public function set_eval_session($id)
{
  $sql="UPDATE `sessions` SET `eval_status`=0 WHERE 1";
  $data=mysqli_query($this->con,$sql);
  $sql2="UPDATE `sessions` SET `eval_status`=1 WHERE `session_id`='$id'";
  $data2=mysqli_query($this->con,$sql2);
  return $data2;
}

}

 ?>
