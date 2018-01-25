<?php
/*
*Page:
*File Include:
*
*/

/**
 *
 */
 include_once '../sourses/db_connection.php';

class Student extends Db_Connection
{
  // public function fetch_image()
  // {
  //     $this->con =mysqli_connect("localhost","root","","gims") or die("unable to connet");
  //   $sql="SELECT `student_picture_path` FROM `students` WHERE `student_id`=8";
  //   $images=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
  //   while ($row=mysqli_fetch_assoc($images)) {
  //     $path=$row['student_picture_path'];
  //     return $path;
  //
  //   }
  // }
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
  public function fetch_onload()
  {
    $sql="SELECT * FROM `degrees`";
    $degree_subject=mysqli_query($this->con,$sql);
    return $degree_subject;
  }

  public function insert_student_form_data()
  {


    //Post values for Student table
    $reg_no=$_POST['arid_reg_year'];
    $reg_no.="-Arid-";
    $reg_no.=$_POST['arid_roll_no'];
    $student_reg_no=$reg_no;
    $student_name=strtolower($_POST['student_name']);
    $student_cnic=$_POST['student_cnic'];
    $date_of_birth=$_POST['student_dob'];
    $student_religion=$_POST['religion'];
    $student_form_no=$_POST['student_form_no'];
    //$student_admission_session=$_POST['student_admission_session_name']."_".date('Y');
    $seat_category=$_POST['seat_categorey'];
    if(isset($_POST['categorey_reserved_seats']))
    {
      $categorey_reserved_seats=$_POST['categorey_reserved_seats'];
    }else {
      $categorey_reserved_seats="NULL";
    }
    $student_degree_id=$_POST['degree_selected'];//foreign Key
    $student_section=$_POST['student_section'];//pending


    $student_crrunt_session=$_POST['student_crrunt_session'];//Foreign Key
    $student_joining_session=$_POST['student_joining_session'];

    $student_picture=Null;//Pending
    $male_female_radio=$_POST['male_female_radio'];
     $morning_evening_radio=$_POST['morning_evening_radio'];
     $crrunt_semester=$_POST['semester_no'];
    //INSERT Query for student table
    $sql="INSERT INTO `students`(`arid_reg_no`, `student_first_name`, `student_cnic`, `student_date_of_birth`, `student_religion`, `student_form_no`, `student_catagorey`, `categorey_of_reserved_seats`, `student_joining_session`, `degree_id`,`student_section`, `student_current_session`, `student_gender`, `student_timing_shift`,`student_currunt_semester`)
    VALUES ('$student_reg_no','$student_name','$student_cnic','$date_of_birth','$student_religion','$student_form_no','$seat_category','$categorey_reserved_seats','$student_joining_session','$student_degree_id','$student_section','$student_crrunt_session','$male_female_radio','$morning_evening_radio','$crrunt_semester')";


    // $sql="INSERT INTO `students`(`arid_reg_no`, `student_first_name`,  `student_cnic`, `student_date_of_birth`, `student_religion`, `student_form_no`, `student_catagorey`, `categorey_of_reserved_seats`,  `student_joining_session`, `degree_id`, `student_section`, `student_current_session`, `student_gender`, `student_timing_shift`) VALUES ('$student_reg_no',[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18])";
    mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
     //get inputs for student contact Table
           $student_last_id =mysqli_insert_id($this->con);
      $student_phone=$_POST['student_phone_no'];
      $student_mobile=$_POST['student_mobile_no'];
      $student_email=$_POST['student_email'];
      $student_parmanent_address=strtolower($_POST['student_parmanent_address']);
      $student_postal_address=strtolower($_POST['student_postal_address']);
      $student_domicile_district=strtolower($_POST['domicile_district']);
      $student_domicile_province=strtolower($_POST['domicile_province']);
      $student_city=strtolower($_POST['student_parmanent_city']);
      $student_nationality="pakistan";
      $student_area=$_POST['rural_urban_radio'];

     $sql2="INSERT INTO `student_contacts`(`student_contact_phone_no`, `student_contact_mobile_no`, `student_contact_email`, `student_contact_permanent_address`, `student_contact_postal_address`, `student_contact_domicile_district`, `student_contact_domicile_province`, `student_contact_city`, `student_contact_nantionality`,`student_area`, `student_id`)
      VALUES ('$student_phone','$student_mobile','$student_email','$student_parmanent_address','$student_postal_address','$student_domicile_district','$student_domicile_province','$student_city','$student_nationality','$student_area','$student_last_id')";
     mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));

     $guardian_name=$_POST['guardian_name'];
     $guardian_relation=$_POST['guardian_relation'];
     $guardian_contact_no=$_POST['guardian_contact_no'];
     $emergancey_guardian_name=$_POST['emergancey_guardian_name'];
     $emergancey_guardian_relation=$_POST['emergancey_guardian_relation'];
     $emergancey_guardian_contact_no=$_POST['emergancey_guardian_contact_no'];;
    $sql3="INSERT INTO `guardians`(`guardian_name`, `guardian_relation`, `guardian_contact_no`, `emaergancey_guardian_name`, `emaergancey_guardian_relation`, `emaergancey_contact_no`, `student_id`)
           VALUES ('$guardian_name','$guardian_relation','$guardian_contact_no','$emergancey_guardian_name','$emergancey_guardian_relation','$emergancey_guardian_contact_no','$student_last_id')";
    mysqli_query($this->con,$sql3) or die(mysqli_error($this->con));

     $father_name=$_POST['father_name'];
     $father_cnic=$_POST['father_cnic'];
     $father_occupation=$_POST['father_occupation'];
     $father_annual_income=$_POST['father_annual_income'];
    $sql4="INSERT INTO `parents`(`parent_name`, `parent_cnic`, `parent_occupation`, `parent_annual_income`, `student_id`)
          VALUES ('$father_name','$father_cnic','$father_occupation','$father_annual_income','$student_last_id')";
    mysqli_query($this->con,$sql4) or die(mysqli_error($this->con));

     $entry_test_name=($_POST['test_name'] == "") ? "No Test" : $_POST['test_name'];
     $entry_test_date=($_POST['test_date'] == "") ? "00/00/0000" : $_POST['test_date'];
     $entry_test_marks=($_POST['test_marks'] == "") ? 0 : $_POST['test_marks'];
     $disciplinary_action=($_POST['disciplinary_action'] == "") ? "No" : $_POST['disciplinary_action'];

    $sql6="INSERT INTO `entry_tests`( `entry_test_name`, `entry_test_date`, `entry_test_marks`, `disciplinary_action`, `student_id`)
            VALUES ('$entry_test_name','$entry_test_date','$entry_test_marks','$disciplinary_action','$student_last_id')";
    mysqli_query($this->con,$sql6) or die(mysqli_error($this->con));
    $level= array('ssc','hssc','bachelor','master','mphil');

    for ($i=0; $i <5 ; $i++) {

      // $quali_lavel=$level[$i];
      // $deg=$_POST['degree'][$i];
      // $year=$_POST['year_of_passing'][$i];
      // $bord_univeristy=$_POST['borad_university'][$i];
      // $obtained_marks=$_POST['obtained_marks'][$i];
      // $total_marks=$_POST['total_marks'][$i];
      // $grade=$_POST['grade'][$i];
      // $cgpa=$_POST['cgpa'][$i];
      // $main_subjects=$_POST['main_subjects'][$i];

        $quali_lavel = ($level[$i] == "") ? "NULL" : $level[$i];
        $deg = ($_POST['degree'][$i] == "") ? "NULL" : $_POST['degree'][$i];
        $year = ($_POST['year_of_passing'][$i] == "") ? 0000 : $_POST['year_of_passing'][$i];
        $bord_univeristy = ($_POST['borad_university'][$i] == "") ? "NULL" : $_POST['borad_university'][$i];
        $obtained_marks = ($_POST['obtained_marks'][$i] == "") ? 0 : $_POST['obtained_marks'][$i];
        $total_marks = ($_POST['total_marks'][$i] == "") ? 0 : $_POST['total_marks'][$i];
        $grade = ($_POST['grade'][$i] == "") ? "Z" : $_POST['grade'][$i];
        $cgpa = ($_POST['cgpa'][$i] == "") ? 0 : $_POST['cgpa'][$i];
        $main_subjects = ($_POST['main_subjects'][$i] == "") ? "NULL" : $_POST['main_subjects'][$i];

      $sql7="INSERT INTO `students_qualifications`( `qualification_level`, `qualification_degree_or_certificate`, `qualification_year_of_passing`, `borad_univeristy`,`qualification_marks_obtained`, `qualification_marks_total`, `qualification_grade`, `qualification_cgpa`, `qualification_major_subjects`, `student_id`)
      VALUES ('$quali_lavel','$deg','$year','$bord_univeristy','$obtained_marks','$total_marks','$grade',$cgpa,'$main_subjects','$student_last_id')";
      mysqli_query($this->con,$sql7) or die(mysqli_error($this->con));
    }
    // //Return Las
    return $student_last_id;
  }

  public function upload_image($argum1)
  {

    $target_dir = "user_images/";
     $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
           "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
        $message="File is not an image.";
        header("location:student_insertion_form_for_ex.php?msg=$message");
       exit;
        }
      }
      // Check if file already exists
      // if (file_exists($target_file)) {
      //   $message="Sorry, file already exists.";
      //    header("location:student_insertion_form_for_ex.php?msg=$message");
      //   exit;
      //   }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000000) {
          $message="Sorry, your file is too large.";
          header("location:student_insertion_form_for_ex.php?msg=$message");
         exit;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "PNG") {
            $message="Sorry, only JPG, JPEG,PNG & GIF files are allowed.";
            header("location:student_insertion_form_for_ex.php?msg=$message");
           exit;
          }
          // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message="Sorry, your file was not uploaded.";
            header("location:student_insertion_form_for_ex_for_ex.php?msg=$message");
           exit;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

              $message="Sccessfully Submitted form";
                $sql="UPDATE `students` SET `student_picture_path`='$target_file' WHERE `student_id`=$argum1";
                 mysqli_query($this->con,$sql) or die(mysqli_error($this->con)."this is an crrunt ");
            } else {
                $message="Sorry, there was an error uploading your file.";
            }
        }
        return $message;
  }
  //upadation method start from here
  public function update_student_record($id_for_update)
  {
    //Post values for Student table
    $reg_no=$_POST['arid_reg_year'];
    $reg_no.="-Arid-";
    $reg_no.=$_POST['arid_roll_no'];
    $student_reg_no=$reg_no;
    $student_name=strtolower($_POST['student_name']);
    $student_cnic=$_POST['student_cnic'];
    $date_of_birth=$_POST['student_dob'];
    $student_religion=$_POST['religion'];
    $student_form_no=$_POST['student_form_no'];
    //$student_admission_session=$_POST['student_admission_session_name']."_".date('Y');
    $seat_category=$_POST['seat_categorey'];
    if(isset($_POST['categorey_reserved_seats']))
    {
      $categorey_reserved_seats=$_POST['categorey_reserved_seats'];
    }else {
      $categorey_reserved_seats="NULL";
    }
    $student_degree_id=$_POST['degree_selected'];//foreign Key
    $student_section=$_POST['student_section'];//pending


    $student_crrunt_session=$_POST['student_crrunt_session'];//Foreign Key
    $student_joining_session=$_POST['student_joining_session'];

    $student_picture=Null;//Pending
    $male_female_radio=$_POST['male_female_radio'];
    $morning_evening_radio=$_POST['morning_evening_radio'];
    $crrunt_semester=$_POST['semester_no'];
    //UPDATE Query for student table

    $sql1="UPDATE `students` SET `arid_reg_no`='$student_reg_no',`student_first_name`='$student_name',`student_cnic`='$student_cnic',`student_date_of_birth`='$date_of_birth',`student_religion`='$student_religion',`student_form_no`='$student_form_no',`student_catagorey`='$seat_category',`categorey_of_reserved_seats`='$categorey_reserved_seats',`student_joining_session`='$student_joining_session',
    `degree_id`='$student_degree_id',`student_section`='$student_section',`student_current_session`='$student_crrunt_session',`student_gender`='$male_female_radio',
    `student_timing_shift`='$morning_evening_radio',`student_currunt_semester`='$crrunt_semester'  WHERE `student_id`=$id_for_update";

    mysqli_query($this->con,$sql1) or die(mysqli_error($this->con));

      $student_phone=$_POST['student_phone_no'];
      $student_mobile=$_POST['student_mobile_no'];
      if($_POST['student_email']=="")
      {
          $student_email="No Email";
      }
      else{
          $student_email=$_POST['student_email'];
      }
      $student_email=
      $student_parmanent_address=strtolower($_POST['student_parmanent_address']);
      $student_postal_address=strtolower($_POST['student_postal_address']);
      $student_domicile_district=strtolower($_POST['domicile_district']);
      $student_domicile_province=strtolower($_POST['domicile_province']);
      $student_city=strtolower($_POST['student_parmanent_city']);
      $student_nationality="pakistan";
      $student_area=$_POST['rural_urban_radio'];

      $sql2="UPDATE `student_contacts` SET
      `student_contact_phone_no`='$student_phone',`student_contact_mobile_no`='$student_mobile',`student_contact_email`='$student_email',`student_contact_permanent_address`='$student_parmanent_address',`student_contact_postal_address`='$student_postal_address',
      `student_contact_domicile_district`='$student_domicile_district',`student_contact_domicile_province`='$student_domicile_province',`student_contact_city`='$student_city',`student_contact_nantionality`='$student_nationality',`student_area`='$student_area' WHERE `student_id`=$id_for_update";
     mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));

     $guardian_name=$_POST['guardian_name'];
     $guardian_relation=$_POST['guardian_relation'];
     $guardian_contact_no=$_POST['guardian_contact_no'];
     $emergancey_guardian_name=$_POST['emergancey_guardian_name'];
     $emergancey_guardian_relation=$_POST['emergancey_guardian_relation'];
     $emergancey_guardian_contact_no=$_POST['emergancey_guardian_contact_no'];;

           $sql3="UPDATE `guardians` SET
           `guardian_name`='$guardian_name',`guardian_relation`='$guardian_relation',`guardian_contact_no`='$guardian_contact_no',`emaergancey_guardian_name`='$emergancey_guardian_name',`emaergancey_guardian_relation`='$emergancey_guardian_relation',`emaergancey_contact_no`='$emergancey_guardian_contact_no' WHERE `student_id`=$id_for_update";
    mysqli_query($this->con,$sql3) or die(mysqli_error($this->con));

     $father_name=$_POST['father_name'];
     $father_cnic=$_POST['father_cnic'];
     $father_occupation=$_POST['father_occupation'];
     $father_annual_income=$_POST['father_annual_income'];

          $sql4="UPDATE `parents` SET
          `parent_name`='$father_name',`parent_cnic`='$father_cnic',`parent_occupation`='$father_occupation',`parent_annual_income`='$father_annual_income' WHERE `student_id`=$id_for_update";
    mysqli_query($this->con,$sql4) or die(mysqli_error($this->con));

     $entry_test_name=$_POST['test_name'];
     $entry_test_date=$_POST['test_date'];
     $entry_test_marks=$_POST['test_marks'];
     $disciplinary_action=$_POST['disciplinary_action'];


            $sql5="UPDATE `entry_tests` SET
            `entry_test_name`='$entry_test_name',`entry_test_date`='$entry_test_date',`entry_test_marks`='$entry_test_marks',`disciplinary_action`='$disciplinary_action' WHERE `student_id`=$id_for_update";
    mysqli_query($this->con,$sql5) or die(mysqli_error($this->con));
    //$level= array('ssc','hssc','bachelor','master','mphil');
    //
    // for ($i=0; $i <5 ; $i++) {
    //
    //   // $quali_lavel=$level[$i];
    //   // $deg=$_POST['degree'][$i];
    //   // $year=$_POST['year_of_passing'][$i];
    //   // $bord_univeristy=$_POST['borad_university'][$i];
    //   // $obtained_marks=$_POST['obtained_marks'][$i];
    //   // $total_marks=$_POST['total_marks'][$i];
    //   // $grade=$_POST['grade'][$i];
    //   // $cgpa=$_POST['cgpa'][$i];
    //   // $main_subjects=$_POST['main_subjects'][$i];
    //
    //     $quali_lavel = ($level[$i] == "") ? "NULL" : $level[$i];
    //     $deg = ($_POST['degree'][$i] == "") ? "NULL" : $_POST['degree'][$i];
    //     $year = ($_POST['year_of_passing'][$i] == "") ? 0000 : $_POST['year_of_passing'][$i];
    //     $bord_univeristy = ($_POST['borad_university'][$i] == "") ? "NULL" : $_POST['borad_university'][$i];
    //     $obtained_marks = ($_POST['obtained_marks'][$i] == "") ? 0 : $_POST['obtained_marks'][$i];
    //     $total_marks = ($_POST['total_marks'][$i] == "") ? 0 : $_POST['total_marks'][$i];
    //     $grade = ($_POST['grade'][$i] == "") ? "Z" : $_POST['grade'][$i];
    //     $cgpa = ($_POST['cgpa'][$i] == "") ? 0 : $_POST['cgpa'][$i];
    //     $main_subjects = ($_POST['main_subjects'][$i] == "") ? "NULL" : $_POST['main_subjects'][$i];
    //
    //   $sql7="INSERT INTO `students_qualifications`( `qualification_level`, `qualification_degree_or_certificate`, `qualification_year_of_passing`, `borad_univeristy`,`qualification_marks_obtained`, `qualification_marks_total`, `qualification_grade`, `qualification_cgpa`, `qualification_major_subjects`, `student_id`)
    //   VALUES ('$quali_lavel','$deg','$year','$bord_univeristy','$obtained_marks','$total_marks','$grade',$cgpa,'$main_subjects','$student_last_id')";
    //   mysqli_query($this->con,$sql7) or die(mysqli_error($this->con));
    // }
    // // //Return Las
    // return $student_last_id;
  }

  public function get_student_name_class_section($std_id)
{
  $query="SELECT `student_first_name`,`student_last_name`,`student_section` 
          FROM `students` 
          WHERE `student_id`='$std_id'";
  $query_execute=mysqli_query($this->con,$query) or die(mysqli_error($this->con));
  return $query_execute;
}

}//end of class



?>
