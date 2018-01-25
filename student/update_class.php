
<?php
/*
*
*
*/
/**
 * For get complete one student Record to update form
 */
 //include "../sourses/db_connection.php";
class Update_Student_Form extends Db_Connection
{
  public function get_student_data_by_id($arg1)
  {
    /*
    *Get data from student table
    */

    $con=mysqli_connect("localhost","root","","masterdb2") or die("unable to connet");
    $sql="SELECT  `arid_reg_no`, `student_first_name`, `student_cnic`, `student_date_of_birth`, `student_religion`, `student_form_no`, `student_catagorey`, `categorey_of_reserved_seats`, `student_picture_path`, `student_joining_session`, `degree_id`, `student_section`, `student_current_session`, `student_gender`, `student_timing_shift`, `student_currunt_semester` FROM `students` WHERE `student_id`=$arg1";
    $student_query_data=mysqli_query($this->con,$sql);
    $student_personale_data=mysqli_fetch_assoc($student_query_data);

    // echo "<pre>";
    // print_r($student_personale_data);
    /*2
    *Get data from father table
    */
    $sql1="SELECT `parent_id`, `parent_name`, `parent_cnic`, `parent_occupation`, `parent_annual_income` FROM `parents` WHERE `student_id`='$arg1'";
    $student_parent=mysqli_query($this->con,$sql1);
    $student_parent_data=mysqli_fetch_assoc($student_parent);

    // echo "<pre>";
    // print_r($student_parent_data);
    /*3
    *Get data from student contacts table
    */
    $sql2="SELECT `student_contact_id`, `student_contact_phone_no`, `student_contact_mobile_no`, `student_contact_email`, `student_contact_permanent_address`, `student_contact_postal_address`, `student_contact_domicile_district`, `student_contact_domicile_province`, `student_contact_city`, `student_contact_nantionality`, `student_area` FROM `student_contacts` WHERE `student_id`='$arg1'";
    $student_contact=mysqli_query($this->con,$sql2);
    $student_contact_data=mysqli_fetch_assoc($student_contact);

    // echo "<pre>";
    // print_r($student_contact_data);
    /*4
    *Get data from guardian table
    */
    $sql3="SELECT `guardian_id`, `guardian_name`, `guardian_relation`, `guardian_contact_no`, `emaergancey_guardian_name`, `emaergancey_guardian_relation`, `emaergancey_contact_no` FROM `guardians` WHERE `student_id`='$arg1'";
    $student_guardian=mysqli_query($this->con,$sql3);
    $student_guardian_data=mysqli_fetch_assoc($student_guardian);

    // echo "<pre>";
    // print_r($student_guardian);
    /*5
    *Get data from student qualification table
    */
    $sql4="SELECT `qualification_id`, `qualification_level`, `qualification_degree_or_certificate`, `qualification_year_of_passing`, `borad_univeristy`, `qualification_marks_obtained`, `qualification_marks_total`, `qualification_grade`, `qualification_cgpa`, `qualification_major_subjects` FROM `students_qualifications` WHERE  `student_id`='$arg1'";
    $student_qualifications=mysqli_query($this->con,$sql4);
    $student_qualifications_data=mysqli_fetch_assoc($student_qualifications);

    // echo "<pre>";
    // print_r($student_guardian);
    /*6
    *Get data from student qualification table
    */
    $sql5="SELECT `entry_test_id`, `entry_test_name`, `entry_test_date`, `entry_test_marks`, `disciplinary_action`  FROM `entry_tests` WHERE `student_id`='$arg1'";
    $student_entry_test=mysqli_query($this->con,$sql5);
    $student_entry_test_data=mysqli_fetch_assoc($student_entry_test);

    // echo "<pre>";
    // print_r($student_entry_test);
    /*
    ***Here is the array of all 6 tables fetch data
    ***
    */
    $student_fetch_data=array($student_personale_data,$student_parent_data,$student_contact_data,$student_guardian_data,$student_qualifications_data,$student_entry_test_data);
    // echo "<pre>";
    // print_r($student_fetch_data);
    return $student_fetch_data;
  //echo $student_fetch_data[0]['student_first_name'];
  }

}

 ?>
