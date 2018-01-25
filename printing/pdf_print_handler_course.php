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

require_once '../sourses/databas_query_function.php';
session_start();
class pdf_print_handler extends Db_Query
{

  // Get course By SESSION and TEACHER
  public function get_courses_by_teacher_session($ses,$tec)
  {
    $sql="SELECT DISTINCT c.course_id,c.course_code,c.course_title
    FROM teachers_classes_courses as tcc
    JOIN courses as c ON c.course_id=tcc.course_id
    WHERE tcc.teacher_id=$tec AND tcc.session_id=$ses";
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

  public function get_total($tech,$ses,$cou,$cls)
  {
    $sql="SELECT DISTINCT `student_id`
    FROM `teachers_evaluations_reports`
    WHERE `teacher_id`=$tech
     AND `session_id`=$ses
     AND `classs_id`=$cls
     AND `course_id`=$cou";
    $data_s=mysqli_query($this->con,$sql);

    $total_evaluated=mysqli_num_rows($data_s);
    return $total_evaluated;
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
    return $qu;
  }


  // course evaluation
  public function course_evaluation_comments($tech,$ses,$cou,$cls)
  {
    $sql="SELECT * FROM `course_evaluation_comments` WHERE `session_id`=$ses AND `teacher_id`=$tech AND `class_id`=$cls AND `course_id`=$cou";
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

      if ($row['course_content_organization']!="'no comment'") {
        $com3[]=$row['course_content_organization'];
      }
      if ($row['student_contribution']!="'no comment'") {
        $com4[]=$row['student_contribution'];
      }
      if ($row['learning_environment']!="'no comment'") {
        $com5[]=$row['learning_environment'];
      }
      if ($row['learning_resources']!="'no comment'") {
          $com6[]=$row['learning_resources'];
      }
      if ($row['delivery_quality']!="'no comment'") {
      $com7[]=$row['delivery_quality'];
      }
      if ($row['assessment_ethodology']!="'no comment'") {
        $com8[]=$row['assessment_ethodology'];
      }
      if ($row['course_best_features']!="'no comment'") {
        $com1[]=$row['course_best_features'];
      }
      if ($row['course_improvement_sgtions']!="'no comment'") {
          $com2[]=$row['course_improvement_sgtions'];
      }

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
    $condpar=array("teacher_id","session_id","course_id","classs_id","question_id");

     for ($i=1; $i < 36 ; $i++) {
       $option_array = array('strongaly_agree' => 0,'agree' => 0,'uncertain' =>0,'disagree'=>0,'strongely_disagree'=>0);

      $condval=array($array[0],$array[1],$array[2],$array[3],$i);
      $data_s=$this->set_fecth_query($tb,$filldes,$condpar,$condval);
      $total=1;
      $total=mysqli_num_rows($data_s);
      // if (!$total) {
      //   echo "Data Not Available";
      //   exit;
      // }
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
        @$per=($value/$total)*100;
        $percen_option[] =$per;
      }
        $percentage_array[]=array($i=>$percen_option);
    }
    return $percentage_array;
  }
}
