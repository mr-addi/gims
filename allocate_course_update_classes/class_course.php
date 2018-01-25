<?php
/**
 *
 */
class class_course_student
{
  private $con;
  public function __construct()
  {
    $this->con =mysqli_connect("localhost","root","","masterdb2") or die("unable to connet");
  }
  public function student_of_class_by_id($id)
  {
    $sql="SELECT `student_id`, `arid_reg_no`, `student_first_name`  FROM `students` WHERE `student_currunt_semester`=$id AND `is_deleted`=0";
    $all_student_by_id=mysqli_query($this->con,$sql);
    return $all_student_by_id;
  }
  public function class_courses($class_to_id)
  {
    $sql="SELECT c1.course_id,c1.course_code,c1.course_title
    FROM classes_courses as cc1
    JOIN courses as c1 ON c1.course_id=cc1.course_id
    WHERE cc1.class_id=$class_to_id";
    $data=mysqli_query($this->con,$sql);
    return $data;
  }
  public function set_fecth_query($tb,$_filldes,$cond_par,$cond_val)
  {
      $sql="";
      $sql.="SELECT ";
      $len=sizeof($_filldes);
      for ($i=0; $i <$len ; $i++) {
        $_filldes[$i];
        $sql.="`$_filldes[$i]` ";
        $sql.=",";
      }
      $sql=substr($sql, 0, -1);
      $sql.=" FROM ";
      $sql.=" `$tb` "."WHERE ";
      $con_len=sizeof($cond_par);
      if ($con_len==sizeof($cond_val) && $con_len>0) {
        for ($i=0; $i <$con_len ; $i++) {
          if ($con_len>1 && $i>0) {
            $sql.=" AND ";
          }
        $sql.="`$cond_par[$i]`"."="."$cond_val[$i]";
        }
      }
      $data=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
      return $data;
  }
  public function validate_data($session_from,$session_to,$class_from,$class_to,$deg_id)
  {
    $table="sessions";
    $filldes = array("session_type","session_year");
    $condition_para = array("session_id");

    $condition_val=array($session_from);
    $sess_f=self::set_fecth_query($table,$filldes,$condition_para,$condition_val);
    $sess_from=mysqli_fetch_assoc($sess_f);

    $condition_val=array($session_to);
    $sess_t=self::set_fecth_query($table,$filldes,$condition_para,$condition_val);
    $sess_to=mysqli_fetch_assoc($sess_t);

    $table="degrees";
    $filldes = array("total_semester");
    $condition_para = array("degree_id");

    $condition_val=array($deg_id);
    $dg_i=self::set_fecth_query($table,$filldes,$condition_para,$condition_val);
    $dg_idd=mysqli_fetch_assoc($dg_i);
    $dg_idd['total_semester'];

    $table="classes";
    $filldes = array("class_name");
    $condition_para = array("class_id");

    $condition_val=array($class_from);
    $cls_f=self::set_fecth_query($table,$filldes,$condition_para,$condition_val);
    $cls_from=mysqli_fetch_assoc($cls_f);

    if ($class_to==1111) {
      $cls_to=11111;
    }else {
      $condition_val=array($class_to);
      $cls_t=self::set_fecth_query($table,$filldes,$condition_para,$condition_val);
      $cls_to=mysqli_fetch_assoc($cls_t);
    }
    // validate Logic
    $error_flag=0;
    /*
    * 0-> SessionError
    * 1-> No error
    * 2-> Class Error
    */
    // validate session
    if (trim($sess_from['session_type'])=="fall") {
      $next=$sess_from['session_year']+1;
      if (trim($sess_to['session_type'])=="spring" && $next==$sess_to['session_year'])
      {$error_flag=1;}
    }else {
        if (trim($sess_to['session_type'])=="fall" && $sess_from['session_year']==$sess_to['session_year'])
        {$error_flag=1;}
    }
    //validate Class
    //BBA(7th)
    $c_from=preg_replace("/[^0-9]/", '', $cls_from['class_name']);
    $d_idd=$dg_idd['total_semester'];
    if ($cls_to==11111) {
      if ($c_from==$d_idd) {
        $error_flag=3;
      }else {
        $error_flag=4;
      }
    }else {

      $c_to=preg_replace("/[^0-9]/", '', $cls_to['class_name']);

      if ($c_from<$d_idd && $c_from+1==$c_to) {
      }else {
        $error_flag=2;
      }
    }
     $data_array = array('error' => $error_flag,'session' => $session_to,'class' =>$class_to);
     return $data_array;
}
  public function set_insert_query($tb,$_filldes,$values){
      $sql="";
      $sql.="INSERT INTO ";
      $sql.="`$tb`"."(";
      $len_fild=sizeof($_filldes);
      for ($i=0; $i <$len_fild ; $i++) {
        $_filldes[$i];
        $sql.="`$_filldes[$i]` ";
        $sql.=",";
      }
      $sql=substr($sql, 0, -1);
      $sql.=") VALUES (";
      $len_val=sizeof($values);
      if ($len_fild==$len_val) {
        for ($i=0; $i <$len_val ; $i++) {
          $type=gettype($values[$i]);
          if ($type=="string") {
            $sql.="`$values[$i]`".",";
          }else {
            $sql.=$values[$i].",";
          }
        }
      }else {
        echo "query Error";
        exit;
      }
      $sql=substr($sql, 0, -1);
      $sql.=")";
      $response=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
  }

  public function set_update_query($tb,$_filldes,$values,$cond_par,$cond_val){
      $sql="";
      $sql.=" UPDATE ";
      $sql.="`$tb`";
      $len_fild=sizeof($_filldes);
      $len_val=sizeof($values);
      if ($len_fild==$len_val) {
        $sql.=" SET ";
        for ($i=0; $i <$len_val ; $i++) {
          $sql.="`$_filldes[$i]`"."=";
          $type=gettype($values[$i]);
          if ($type=="string") {
            $sql.="`$values[$i]`".",";
          }else {
            $sql.=$values[$i].",";
          }
        }
      }else {
        echo "Parameter Error";
        exit;
      }
      $sql=substr($sql, 0, -1);
       $sql.=" WHERE ";
      $con_len=sizeof($cond_par);
      if ($con_len==sizeof($cond_val) && $con_len>0) {
        for ($i=0; $i <$con_len ; $i++) {
          if ($con_len>1 && $i>0) {
            $sql.=" AND ";
          }
        $sql.=" `$cond_par[$i]`"."="."$cond_val[$i]";
        }
      }
      // echo $sql;
       $response=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
  }
}
//  $obj=new class_course_student();
// // $obj->validate_data(7,8,21,22,11);
// //
// $filldes=array("student_current_session","student_currunt_semester");
// $fil=array(8,8);
// $cond_par= array("student_id","is_deleted");
// $cod_par_val= array(2,0);
// $obj->set_update_query("students",$filldes,$fil,$cond_par,$cod_par_val);

 ?>
