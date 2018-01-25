<?php
/*
*=================================================
*                          CLASSS
*               TEACHER COURSE EVALUATION CLASSS
*=================================================
*
*1)evaluation_reports.php
*2)manage_evaluation_reports.php
*/

require_once 'databas_query_function.php';
@session_start();
class teacher_evaluation_report extends Db_Query
{
  // Get Teacher By Session ID
  public function get_teacher_by_session($session_id)
  {
    $sql = "SELECT DISTINCT t1.teacher_id,t1.teacher_first_name,t1.teacher_last_name
     FROM teachers_classes_courses as tcc
     JOIN teachers as t1 ON t1.teacher_id=tcc.teacher_id
     WHERE `session_id`=$session_id";
     $data_set=$this->execute($sql);
     return $data_set;
  }
  // Get CLASS SESSION and TEACHER
  public function get_class_by_teacher_session($ses,$tec)
  {
    $sql="SELECT DISTINCT cs.class_id,cs.class_name
    FROM teachers_classes_courses as tcc
	JOIN classes as cs ON cs.class_id=tcc.classs_id
    WHERE tcc.teacher_id=$tec AND tcc.session_id=$ses";
    $data_set=$this->execute($sql);
    return $data_set;
  }
  // Get course By SESSION and TEACHER
  public function get_courses_by_teacher_session($tec,$ses,$cls)
  {
    $sql="SELECT  c.course_id,c.course_code,c.course_title
    FROM teachers_classes_courses as tcc
    JOIN courses as c ON c.course_id=tcc.course_id
    WHERE tcc.teacher_id=$tec AND tcc.session_id=$ses AND tcc.classs_id=$cls";
    $data_set=$this->execute($sql);
    return $data_set;
  }

  public function get_class($val)
  {
    $tb="teachers_evaluations_reports";
    $filldes=array("classs_id");
    $condpar=array("teacher_id","session_id","course_id");
    $condval=array($val[0],$val[1],$val[2]);
    $data_s=$this->set_fecth_query($tb,$filldes,$condpar,$condval);
    $row=mysqli_fetch_assoc($data_s);
    $key=$row['classs_id'];
    return $key;
  }
  // corse evaluation
  public function get_class_course_eval($val)
  {
    $tb="course_evaluations_reports";
    $filldes=array("classs_id");
    $condpar=array("teacher_id","session_id","course_id");
    $condval=array($val[0],$val[1],$val[2]);
    $data_s=$this->set_fecth_query($tb,$filldes,$condpar,$condval);
    $row=mysqli_fetch_assoc($data_s);
    $key=$row['classs_id'];
    return $key;
  }
  // Teacher Evaluation
  public function evaluation_report($array)
  {
    $percentage_array=array();

    $tb="teachers_evaluations_reports";
    $filldes=array("teacher_evaluation_report_id","student_id","selected_option_id");
    $condpar=array("teacher_id","classs_id","session_id","course_id","question_id");

     for ($i=1; $i < 18 ; $i++) {
       $option_array = array('strongaly_agree' => 0,'agree' => 0,'uncertain' =>0,'disagree'=>0,'strongely_disagree'=>0);
      $condval=array($array[0],$array[1],$array[2],$array[3],$i);
      $data_s=$this->set_fecth_query($tb,$filldes,$condpar,$condval);
      $total=mysqli_num_rows($data_s);
      while ($row=mysqli_fetch_assoc($data_s)) {
        $val=$row['selected_option_id'];
        switch ($val) {
          case 1:
            $option_array['strongaly_agree']++;
            break;
          case 2:
            $option_array['agree']++;
            break;
          case 3:
            $option_array['uncertain']++;
            break;
          case 4:
            $option_array['disagree']++;
            break;
          case 5:
            $option_array['strongely_disagree']++;
            break;
        }
      }
      $j=0;
      $percen_option=array();
      foreach ($option_array as $key => $value) {
        $j++;
        $per=0;
        $per=($value/$total)*100;
        $percen_option[] =$per;
      }
        $percentage_array[]=array($i=>$percen_option);
    }
    return $percentage_array;
  }
  public function evaluation_question()
  {
    $sql="SELECT * FROM `evaluation_questions`";
    $data_s=mysqli_query($this->con,$sql);
    $qu=array();

    while ($row=mysqli_fetch_assoc($data_s)) {
      $qu[]=$row['evaluation_question_title'];
    }
    return $qu;
  }
  // course eavl
  public function course_evaluation_question()
  {
    $sql="SELECT * FROM `course_evaluation_questions`";
    $data_s=mysqli_query($this->con,$sql);
    $qu=array();

    while ($row=mysqli_fetch_assoc($data_s)) {
      $qu[]=$row['evaluation_question_title'];
    }
    // $my_qu=json_encode($qu);
    return $qu;
  }
  public function evaluation_comments($tech,$ses,$cls)
  {
    $sql="SELECT * FROM `evaluation_comments`";
    $data_s=mysqli_query($this->con,$sql);
    $com=array();

    while ($row=mysqli_fetch_assoc($data_s)) {
      $com[]=$row['evaluation_comment_instructer'];
      $com[]=$row['evaluation_comment_course'];
    }
    return $com;
  }
  // course evaluation
  public function course_evaluation_comments($tech,$ses,$cls)
  {
    $sql="SELECT * FROM `course_evaluation_comments` WHERE `session_id`=$ses AND `teacher_id`=$tech AND `class_id`=$cls";
    $data_s=mysqli_query($this->con,$sql);
    $com1=array();
    $com2=array();
    $com3=array();
    $com4=array();
    $com5=array();
    $com6=array();
    $com7=array();
    $com8=array();
    while ($row=mysqli_fetch_assoc($data_s)) {

      $com3[]=$row['course_content_organization'];
      $com4[]=$row['student_contribution'];
      $com5[]=$row['learning_environment'];
      $com6[]=$row['learning_resources'];
      $com7[]=$row['delivery_quality'];
      $com8[]=$row['assessment_ethodology'];
      $com1[]=$row['course_best_features'];
      $com2[]=$row['course_improvement_sgtions'];
    }
    $com=array($com1,$com2,$com3,$com4,$com5,$com6,$com7,$com8);
    return $com;
  }

  // Course EVALUATION
  public function course_evaluation_report($array)
  {

    $percentage_array=array();

    $tb="course_evaluations_reports";
    $filldes=array("teacher_evaluation_report_id","student_id","selected_option_id");
    $condpar=array("teacher_id","classs_id","session_id","course_id","question_id");

     for ($i=1; $i < 36 ; $i++) {
       $option_array = array('strongaly_agree' => 0,'agree' => 0,'uncertain' =>0,'disagree'=>0,'strongely_disagree'=>0);

      $condval=array($array[0],$array[1],$array[2],$array[3],$i);
      $data_s=$this->set_fecth_query($tb,$filldes,$condpar,$condval);

      $total=mysqli_num_rows($data_s);

      while ($row=mysqli_fetch_assoc($data_s)) {

        $val=$row['selected_option_id'];
        switch ($val) {
          case 1:
            $option_array['strongaly_agree']++;
            break;
          case 2:
            $option_array['agree']++;
            break;
          case 3:
            $option_array['uncertain']++;
            break;
          case 4:
            $option_array['disagree']++;
            break;
          case 5:
            $option_array['strongely_disagree']++;
            break;
        }
      }
      $j=0;
      $percen_option=array();
      foreach ($option_array as $key => $value) {
        $j++;
        $per=0;
        $per=($value/$total)*100;
        $percen_option[] =$per;
      }
        $percentage_array[]=array($i=>$percen_option);
    }
    return $percentage_array;
  }
}

$obj=new teacher_evaluation_report();


if (isset($_POST['param1'])) {
$id=$_POST['param1'];
$result=$obj->get_teacher_by_session($id);

while ($teacher=mysqli_fetch_assoc($result)) {
  ?>
  <option value="<?= $teacher['teacher_id'] ?>"><?= ucwords($teacher['teacher_first_name']." ".$teacher['teacher_last_name']) ?></option>
  <?php
}
exit;
 }

 if (isset($_POST['session']) && isset($_POST['teacher'])) {
 $ses=$_POST['session'];
 $tec=$_POST['teacher'];
 $result_to=$obj->get_class_by_teacher_session($tec,$ses);
 while ($course=mysqli_fetch_assoc($result_to)) { ?>
   <option value="<?=$course['class_id'] ?>"><?=$course['class_name'] ?></option>
   <?php
 }
 exit;
  }

  if (isset($_POST['session_n']) && isset($_POST['teacher_r'])) {

  $ses=$_POST['session_n'];
  $tec=$_POST['teacher_r'];
  $cls=$_POST['class_s'];
  $result_to=$obj->get_courses_by_teacher_session($tec,$ses,$cls);
  while ($course=mysqli_fetch_assoc($result_to)) { ?>
    <option value="<?=$course['course_id'] ?>"><?=$course['course_code']." ".$course['course_title'] ?></option>
    <?php
  }
  exit;
   }
//
 if (isset($_POST['ses']) && isset($_POST['tea']) && isset($_POST['cou']) && isset($_SESSION['course_evaluation'])) {

$ses=$_POST['ses'];
$tec=$_POST['tea'];
$cou=$_POST['cou'];
settype($ses,"integer");
settype($tec,"integer");
settype($cou,"integer");

$report_input_param = array($tec,$ses,$cou );
$cla=$obj->get_class_course_eval($report_input_param);

$report_input_param = array($tec,$cla,$ses,$cou);
// print_r($report_input_param);
$data=$obj->course_evaluation_report($report_input_param);
// print_r($data);
$question=$obj->course_evaluation_question();

 $comments=$obj->course_evaluation_comments($tec,$ses,$cla);
// print_r($comments);
$send_data[0]=$question;
$send_data[1]=$data;
$send_data[2]=$comments;
$check=json_encode($send_data);
unset($_SESSION['course_evaluation']);
echo $check;
exit;
    }
  // if (isset($_POST['ses']) && isset($_POST['tea']) && isset($_POST['cou']) && isset($_SESSION['teacher_evaluation'])) {
else{
  $ses=$_POST['ses'];
  $tec=$_POST['tea'];
  $cou=$_POST['cou'];
  settype($ses,"integer");
  settype($tec,"integer");
  settype($cou,"integer");

  $report_input_param = array($tec,$ses,$cou );
  $cla=$obj->get_class($report_input_param);

  $report_input_param = array($tec,$cla,$ses,$cou);
  $data=$obj->evaluation_report($report_input_param);
  $question=$obj->evaluation_question();
  $comments=$obj->evaluation_comments($tec,$ses,$cla);

  $send_data[0]=$question;
  $send_data[1]=$data;
  $send_data[2]=$comments;
  $check=json_encode($send_data);
  echo $check;
  exit;
    }
?>
