<?php
/**
 *this class handels all the opertation of teacher
 **
  **
  **
  **
  **
  **
  **
  **
 
 */
  require_once 'dbconnection.php';
class teacher
{

  function __construct() // default constructor
  {
    # code...
  }
  public function teacher_insertion()//data insertion function
  {
  //   echo "<pre>";
  //   print_r($_POST);
  // echo "</pre>";
  
  //saving the posted data in the variables
   $employee_id   = $_POST['emp_id'];
   $first_name    = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_frst_nm']));
   $last_name     = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_lst_nm']));
   $start_date    = $_POST['tec_strt_date'];
   $designation   = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_desg']));
   $gender        = $_POST['tec_gender'];
   $address       = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_addrs']));
   $d_o_b         = $_POST['tec_dob'];
   $suburb        = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_subrb']));
   $state         = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_state']));
   $post_code     = $_POST['tec_postcode'];
   $mobile_no     = $_POST['tec_mbl_no'];
   $email         = mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_email']);
   $bank_name     = mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_bnk_name']);
   $bank_branch   = mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_bnk_brnch']);
   $account_name  = mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_acnt_name']);
   $s_s_no        = $_POST['tec_ssn'];
   $bank_acc_no   = mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_bnk_acnt_no']);
   $kin_name      = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['kin_ful_nm']));
   $kin_relation  = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['kin_rel']));
   $kin_address   = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['kin_adrs']));
   $kin_suburb    = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['kin_suburb']));
   $kin_state     = strtolower(mysqli_real_escape_string($GLOBALS['con'],$_POST['kin_state']));
   $kin_pst_cd    = $_POST['kin_pst_cd'];
   $kin_work_no   = $_POST['kin_work_no'];
   $kin_mbl_no   = $_POST['kin_mbl_no'];


    // $teacher_status=mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_status']);
    // $pay_rate_annual=mysqli_real_escape_string($GLOBALS['con'],$_POST['pay_rate_annual']);
    // $pay_rate_monthly=mysqli_real_escape_string($GLOBALS['con'],$_POST['pay_rate_monthly']);
    // $pay_rate_hourly=mysqli_real_escape_string($GLOBALS['con'],$_POST['pay_rate_hourly']);
  // $teacher_frst_pay_date=mysqli_real_escape_string($GLOBALS['con'],$_POST['tec_frst_pay_date']);

    // echo "<br><br>";
    // echo $first_name." ".$last_name." ".$d_o_b." ".$gender." ".$designation." ".$start_date." ".$employee_id;
    #### inserting data into teachers table
  //  $insert_in_teacher   = "INSERT INTO `teachers`
  //                         (`teacher_first_name`, `teacher_last_name`, `teacher_date_of_birth`,
  //                          `teacher_gender`, `teacher_designation`, `teacher_date_of_joining`, `teacher_CNIC`)
  //                         VALUES ('$first_name','$last_name','$d_o_b','$gender','$designation','$start_date','$employee_id')";
  //  $exe_teacher_insert  = mysqli_query($GLOBALS['con'],$insert_in_teacher) or die(mysqli_error($GLOBALS['con']));
   $teacher_id =$this->teacher_root_insertion($first_name,$last_name,$d_o_b,$gender,$designation,$start_date,$employee_id);
    
   if($teacher_id){
            // $teacher_id = mysqli_insert_id($GLOBALS['con']);##getting the latest inserted teacher id

                  ##inserting data in the teacher_contacts table
            $insert_contact = "INSERT INTO `teacher_contacts`(`teacher_contact_mobile_no`, `teacher_contact_email`, `teacher_contact_state`, `teacher_contact_post_code`, `teacher_contact_suburb`, `teacher_contact_address`, `teacher_id`)
                                  VALUES ('$mobile_no','$email','$state','$post_code','$suburb','$address','$teacher_id')";
            if(mysqli_query($GLOBALS['con'],$insert_contact)){

              $this->insert_bank_data($bank_name,$bank_branch,$bank_acc_no,"0",$s_s_no,$teacher_id);
              $this->teacher_kin_insertion($kin_name,$kin_relation,$kin_address,$kin_suburb,$kin_state,$kin_pst_cd,$kin_work_no,$kin_mbl_no,$teacher_id);
                 }
              }
              return true;
  }


public function teacher_root_insertion($first_name,$last_name,$d_o_b,$gender,$designation,$start_date,$employee_id=0) {
  $insert_in_teacher   = "INSERT INTO `teachers`
                          (
                            `teacher_first_name`,
                            `teacher_last_name`,
                            `teacher_date_of_birth`,
                            `teacher_gender`,
                            `teacher_designation`,
                            `teacher_date_of_joining`,
                            `teacher_CNIC`
                          )
                          VALUES (
                                  '$first_name',
                                  '$last_name',
                                  '$d_o_b',
                                  '$gender',
                                  '$designation',
                                  '$start_date',
                                  '$employee_id'
                                  )";
    $exe_teacher_insert  = mysqli_query($GLOBALS['con'],$insert_in_teacher) or die(mysqli_error($GLOBALS['con']));
    if($exe_teacher_insert){
      $teacher_id = mysqli_insert_id($GLOBALS['con']);##getting the latest inserted teacher id
      return $teacher_id;      
    } else {
      return false;
    }
}

public function teacher_kin_insertion($kin_name="",$kin_relation="",$kin_address="",$kin_suburb="",$kin_state="",$kin_pst_cd="",$kin_work_no="000",$kin_mbl_no="",$teacher_id="")
{
  $insert_kin       ="INSERT INTO `teacher_kin`(`teacher_kin_name`, `teacher_kin_relation`, `kin_address`, `kin_suburb`, `kin_state`, `kin_post_code`, `teacher_work`, `teacher_kin_mobile_no`, `teacher_id`)
                                       VALUES ('$kin_name','$kin_relation','$kin_address','$kin_suburb','$kin_state','$kin_pst_cd','$kin_work_no','$kin_mbl_no','$teacher_id')";
            $exe_insert_kin   =mysqli_query($GLOBALS['con'],$insert_kin) or die(mysqli_error($GLOBALS['con']));
             
}

  public function insert_bank_data($bank_name="EXAMPLE",$bank_branch,$bank_acc_no,$eobi,$s_s_no="12",$teacher_id="")
  {
    if(!$bank_branch){
      $bank_branch=0;
      
    }
    if (!$bank_acc_no) {
      $bank_acc_no=0;
    }
    if (!$s_s_no) {
      $s_s_no=0;
    }
    $teacher_bank     ="INSERT INTO `faculty_bank_accounts`(`bank_name`, `branch_no`, `account_no`, `eobi_no`, `social_security_no`, `teacher_id`)
    VALUES ('$bank_name','$bank_branch','$bank_acc_no','0','$s_s_no','$teacher_id')";
    $exe_teacher_bank =mysqli_query($GLOBALS['con'],$teacher_bank) or die(mysqli_error($GLOBALS['con']));
    $bank_id          =mysqli_insert_id($GLOBALS['con']);
    return true;
  }
  public function display_all_teachers_basic() ##get teachers data to show on display
  {
    $slct_query="SELECT t1.teacher_id,t1.teacher_CNIC,t1.teacher_first_name,t1.teacher_last_name,t1.teacher_designation,tc.teacher_contact_mobile_no,tc.teacher_contact_email,tb.account_no
                    FROM teachers as t1,teacher_contacts as tc, faculty_bank_accounts as tb
                    WHERE t1.teacher_id=tc.teacher_id AND t1.teacher_id=tb.teacher_id AND t1.teacher_deleted='0'";
    $slct_exe=$exe_teacher_bank=mysqli_query($GLOBALS['con'],$slct_query) or die(mysqli_error($GLOBALS['con']));
    return $slct_exe;
  }

public function fn_ln_by_id($id)
{
  $query="SELECT `teacher_first_name`,`teacher_last_name` FROM `teachers` WHERE `teacher_id`='$id'";
  $query_exe=mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con']));
  return $query_exe; 
}


  public function delete_teacher($value) ##deleting teacher
  {
      $del_query="UPDATE `teachers` SET `teacher_deleted`='1' WHERE `teacher_id`='$value'";
      $del_exe=mysqli_query($GLOBALS['con'],$del_query) or die(mysqli_error($GLOBALS['con']));
      header('Location: ..\teachers_page.php');

  }



  public function insert_teach_crs_data($tech_id,$sess_id,$cl_id,$crs_id,$sec) ###inserting teacher classes courses
  {
    $check="SELECT `teacher_course_id` 
              FROM `teachers_classes_courses` 
                WHERE `teacher_id`= '$tech_id'
                AND `classs_id`= '$cl_id'
                AND `course_id`= '$crs_id'
                AND`class_section`= '$sec'
                AND`session_id`= '$sess_id' ";
    $check_exe=mysqli_query($GLOBALS['con'],$check);
    if(mysqli_num_rows($check_exe)){ ##check if record already exists
      return "record already exists";
    } else{ ## if not prform these actions
      $insert_tech_crss = "INSERT INTO 
                            `teachers_classes_courses`
                                ( `teacher_id`,
                                   `classs_id`,
                                   `course_id`,
                                   `class_section`,
                                   `session_id`
                                )
                             VALUES ('$tech_id','$cl_id','$crs_id','$sec','$sess_id')";
      $insert_exe1=mysqli_query($GLOBALS['con'],$insert_tech_crss);
      if($insert_exe1){ ## insert data into teachers_classes_courses
        return "successfily inserted record"; ##responce message
        // print_r($insert_exe1);
      } else{
        return "Error in inserting record";##responce message
      }
    }

    
  }


  public function get_cls_crs_etc($tec_id,$sess_id)
  {
    $select_crs_dat="SELECT cl.class_id,cl.class_name,cr.course_id,cr.course_code,cr.course_title,tcc.class_section
                      FROM classes AS cl ,courses AS cr ,teachers_classes_courses AS tcc
                      WHERE tcc.teacher_id= '$tec_id'
                        AND tcc.session_id= '$sess_id'
                          AND tcc.classs_id=cl.class_id
                          AND tcc.course_id=cr.course_id";
                      ##teacher classes courses data selection
  $exe_get_rec = mysqli_query($GLOBALS['con'],$select_crs_dat) or die($GLOBALS['con']);
  
    return $exe_get_rec; ##returning result
  }
  
  public function delete_teach_crs($t_id,$ses_id,$cls_id,$crs_id,$se)
  {
    $del_query = "DELETE FROM `teachers_classes_courses` 
                    WHERE `teacher_id`= '$t_id' 
                    AND `classs_id`= '$cls_id'
                     AND `course_id`= '$crs_id'
                      AND `class_section`= '$se' 
                      AND `session_id`= '$ses_id' ";
    $res=mysqli_query($GLOBALS['con'],$del_query) or die($GLOBALS['con']);
    if($res){
      return true;   
    } else{
      return false;
    }

  }
}
 ?>
