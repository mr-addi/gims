
<?php 
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=NULL) { 
    if($_SESSION['reset_status']== 0) { 
      redirect('user_accounts/student_password_reset.php');
    }
    // print_r($_POST); 
    $student_id = $_POST['student_id'];
    $class_id = $_POST['class_id'];
    $session_id = $_POST['session_id'];
    $teacher_id =$_POST['teacher_id']; 
    $course_id = $_POST['course_id'];
    $res = $_POST['option'];
    $comments[]="";
    for ($i=0; $i < count($_POST['comment']); $i++) { 
        if(empty($_POST['comment'][$i])){
            $_POST['comment'][$i]="no comment";
        } 
        $comments[$i]= $_POST['comment'][$i]; 
    }
 


    require_once('../sourses/student_course_eval.class.php');
    $cec_obj=new student_course_evaluation();
    $responce = $cec_obj->get_eval_result($student_id,$teacher_id,$class_id,$course_id,$session_id);
            if ($responce) {
                        $_SESSION['error_msg']="Already done evaluation for this subject";
                        goto skip;
                    }
    foreach ($res as $key => $value) {
        // echo "<br>".$key."=>".$value."<br>";
                $cec_obj->sumbit_eval_result($student_id,$teacher_id,$class_id,$course_id,$key,$value,$session_id);
    }

    
   
    $cec_obj->insert_eval_comment($student_id,$teacher_id,$class_id,$course_id,$session_id,$comments[6],$comments[7],$comments[0],$comments[1],$comments[2],$comments[3],$comments[4],$comments[5]);
    $res=$cec_obj->evaluation_status_get($student_id);
    $Stts=$res['crs_eval_status'];
    $status=$Stts+1;
    $cec_obj->evaluation_status_set($student_id,$status);

    skip:
    if ($_SESSION['sub_no']<$_SESSION['totlat_subs']) {
        redirect("course_evaluation.php");
    }else {
        redirect("student_portal.php");
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
