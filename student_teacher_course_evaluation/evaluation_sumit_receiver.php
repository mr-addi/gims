
<?php 
session_start();
/**
 * --------------------------------------------
 * controller for the teacher evaluation
 * ---------------------------------------------
 * 
 * recieves the posted values of the teacher evaluation form
 * and send it to the course_evaluation_class.php
 * 
 * 
 * 
 * 
 * 
 */
    // echo "<pre>";
    //  print_r($_POST);
    // echo "</pre>"; 

    if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=NULL) { 
        if($_SESSION['reset_status']== 0) { 
          redirect('user_accounts/student_password_reset.php');
        }

    $student_id = $_POST['student_id'];
    $class_id = $_POST['class_id'];
    $session_id = $_POST['session_id'];
    $res = $_POST['option'];
    if( isset($_POST['teacher_comment']) ){ //comment about teacher
    $teach_comment = $_POST['teacher_comment'];        
    } else{
        $teach_comment = "no comment";
    }

    if( isset($_POST['course_comment']) ){ // comment about course 
        $teach_comment = $_POST['course_comment'];        
        } else{
            $teach_comment = "no comment";
        }

    $teacher_id = "";
    $course_id = ""; 

    require_once('../sourses/course_evaluation_class.php');
    $cec_obj=new course_evaluation(); //stud eval obj
    
    foreach ($res as $key => $value) {
        $course_id = $key;
        foreach ($value as $ckey => $cvalue) {
            $teacher_id = $ckey;
            $responce = $cec_obj->get_eval_result($student_id,$teacher_id,$class_id,$course_id,$session_id);
            if ($responce) {
                        $_SESSION['error_msg']="Already done evaluation for this subject";
                        goto skip;
                    }
            foreach ($cvalue as $cckey => $ccvalue) {
                // echo " | | student>".$student_id." | | teacher>".$ckey." | | class>".$class_id." | | course>".$key." | | ques>".$cckey." | | ans>".$ccvalue."<br>";
            $cec_obj->sumbit_eval_result($student_id,$ckey,$class_id,$key,$cckey,$ccvalue,$session_id);
                
            }
        }
    }
    if( empty($teach_comment) ){
        $teach_comment="no comment";
    }
    if (empty($course_comment)) {
        $course_comment="no comment";
    }
    //inserting evaluation comments
    $cec_obj->insert_eval_comment($student_id,$teacher_id,$class_id,$course_id,$session_id,$teach_comment,$course_comment);
    
    //getting the eval status
    $res=$cec_obj->evaluation_status_get($student_id);
    $Stts=$res['evaluation_status'];
    $status=$Stts+1;
    //setting status
    $cec_obj->evaluation_status_set($student_id,$status);

    skip: //skip evluation for if already done
    //checking if the current suubject no is less then totAL
    if ($_SESSION['id_index']<$_SESSION['totlat_subs']) { 
        redirect("teacher_course_evaluation.php");
    # code...
    }else {
    // redirect("home");
    redirect("student_portal.php");
    // die();
    // redirect("teacher_course_evaluation.php");
    }

} else {
    redirect("student_login.php");
  }
    function redirect($url) { //deffining the redirect function
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
      }

?>
