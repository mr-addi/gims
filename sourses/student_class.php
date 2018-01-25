<?php
require_once 'db_connection.php';
class student_class extends Db_Connection
{
 public function student_of_class_by_id($id)
 {
   $sql="SELECT `student_id`, `arid_reg_no`, `student_first_name`  FROM `students` WHERE `student_currunt_semester`=$id AND `is_deleted`=0";
   $all_student_by_id=mysqli_query($this->con,$sql);
   return $all_student_by_id;
 }
//admin_student_action.php
 public function admin_student_action($student_id)
 {
   $sql="SELECT  s1.student_currunt_semester,s1.student_current_session,s1.arid_reg_no,s1.student_first_name,s1.student_cnic,s1.is_deleted,s1.student_picture_path,sc1.student_contact_mobile_no,sc1.student_contact_email,sc1.student_contact_city,p1.parent_name,cl1.class_name,sl.student_login_name,sl.student_login_password
         FROM students as s1
         JOIN student_contacts as sc1 ON sc1.student_id=s1.student_id
         JOIN parents as p1 ON p1.student_id=s1.student_id
         JOIN classes as cl1 ON cl1.class_id=s1.student_currunt_semester
         JOIN students_logins as sl ON sl.student_id=s1.student_id
         WHERE s1.student_id=$student_id";
  $result_data=mysqli_query($this->con,$sql);
  return $result_data;
}
public function fetch_active_students_records()
{
  $sql="SELECT s1.student_id,s1.arid_reg_no,s1.student_picture_path,d1.degree_subject_name,s1.student_first_name,p1.parent_name,cl1.class_name,c1.student_contact_mobile_no,c1.student_contact_email,c1.student_contact_city
  FROM students as s1
  JOIN degrees as d1 ON d1.degree_id=s1.degree_id
  JOIN parents as p1 ON p1.student_id=s1.student_id
  JOIN classes as cl1 ON cl1.class_id=s1.student_currunt_semester
  JOIN student_contacts as c1 ON c1.student_id=s1.student_id
  WHERE s1.is_deleted=0
  ORDER BY cl1.class_name ASC";
  $data=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
  return $data;
}
public function fetch_feezed_students_records()
{
  $sql="SELECT s1.student_id,s1.arid_reg_no,s1.student_picture_path,d1.degree_subject_name,s1.student_first_name,p1.parent_name,cl1.class_name,c1.student_contact_mobile_no,c1.student_contact_email,c1.student_contact_city
  FROM students as s1
  JOIN degrees as d1 ON d1.degree_id=s1.degree_id
  JOIN parents as p1 ON p1.student_id=s1.student_id
  JOIN classes as cl1 ON cl1.class_id=s1.student_currunt_semester
  JOIN student_contacts as c1 ON c1.student_id=s1.student_id
  WHERE s1.is_deleted=2
  ORDER BY cl1.class_name ASC";
  $data=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
  return $data;
}
// Background Lookup Function//
// Change Image Extension
// public function change_extension_of_image()
// {
//   $sql="SELECT `student_id`,`student_picture_path` FROM `students`";
//   $data_result=mysqli_query($this->con,$sql);
//   while ($data_statement=mysqli_fetch_assoc($data_result)) {
//     $data=str_replace("png","JPG",$data_statement['student_picture_path']);
//     $id=$data_statement['student_id'];
//     echo $data." "."$id"."<br>";
//     $sqll="UPDATE `students` SET `student_picture_path`='$data' WHERE `student_id`=$id";
//     mysqli_query($this->con,$sqll);
//   }
// }
}

// $obj=new student_class();
// $obj->change_extension_of_image();
 ?>
