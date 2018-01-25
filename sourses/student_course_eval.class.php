<?php 
/** 
 * *************************************
 * Student->course evalution class
 * *************************************
 * ## Manages all data of student course management
 * 
 * ##different function
 *      *student_class_courses_teachers($student_id,$eval_sess_id,$section)
 *      *get_eval_ques()
 *      *sumbit_eval_result($student_id,$teacher_id,$class_id,$course_id,$ques_id,$option_id)
 */
require_once('pdo_db_class.php');
class student_course_evaluation extends Database
 {
    public static $connection;
    public function __construct()
    {
        Database::__construct();
        // $this=NULL;  
        // $this = new Database();
        //  print_r(students_logins::$connection);
    } 
    public function student_class_courses_teachers($student_id,$eval_sess_id,$section)
    {
        $class[]="";
        $course[]="";
        $finalres[]="";
       $query   = $this->query("SELECT DISTINCT `class_id`,`course_id` 
                    FROM `students_classes_courses` 
                    WHERE `student_id`= '$student_id' 
                    AND `session_id`= '$eval_sess_id'");
        $result = $this->resultset();
        
        $index=0;
        $fi=0;
        $result3='';
        foreach ($result as $key => $value) {

            
            $class[$index]=$value['class_id'];
            $course[$index]=$value['course_id'];

            $this->query("SELECT `teacher_id` 
                                                    FROM `teachers_classes_courses` 
                                                    WHERE `classs_id`='$class[$index]' 
                                                    AND `course_id`= '$course[$index]' 
                                                    AND`class_section`='$section' 
                                                    AND `session_id`='$eval_sess_id'
                                              ");

            $result2 = $this->resultset();
        //     echo "<pre>";
        //     print_r(count($result2));
        // echo "</pre>";
        // die();
        if (count($result2)>0) {
            # code...
        
            // print_r($result2[0]['teacher_id']);
            $teacher_id=$result2[0]['teacher_id'];
            // echo $teacher_id."<br>";
            foreach ($result2 as $key1 => $value1) {
                $this->query("SELECT cl.class_id,cl.class_name,cr.course_id,cr.course_code,cr.course_title,ses.session_type,ses.session_year,tr.teacher_id,tr.teacher_first_name,tr.teacher_last_name
                                                        FROM classes as cl
                                                        JOIN courses AS cr ON cr.course_id='$course[$index]'
                                                        JOIN sessions AS ses ON ses.session_id='$eval_sess_id'
                                                        JOIN teachers AS tr ON tr.teacher_id='$teacher_id'
                                                        WHERE cl.class_id='$class[$index]'");
                $result3 = $this->resultset();
                
            }
            foreach ($result3 as $key => $value) {
                $finalres[$index]=$value;
            }
            
            
            $index+=1;
        }
    }
        return $finalres;
    // die();
         
    }

    public function get_eval_ques()
    {
        
        $this->query("SELECT * FROM `course_evaluation_questions`");
        return $this->resultset();
    }

    public function get_eval_result($student_id,$teacher_id,$class_id,$course_id,$session_id)
    {
        $this->query("SELECT * FROM
                         `course_evaluations_reports` 
                            WHERE 
                                `student_id`= '$student_id'
                            AND `teacher_id`= '$teacher_id'
                            AND `session_id`= '$session_id'
                            AND  `classs_id`= '$class_id'
                            AND  `course_id`='$course_id'"
                        );
        $this->execute();
        return $this->rowCount();
        
    }

    //function to submit the eval result
    public function sumbit_eval_result($student_id,$teacher_id,$class_id,$course_id,$ques_id,$option_id,$session_id)
    {
        $this->query("INSERT INTO 
                                                `course_evaluations_reports`(
                                                        `student_id`,
                                                        `teacher_id`,
                                                        `session_id`,
                                                        `classs_id`,
                                                        `course_id`,
                                                        `question_id`,
                                                        `selected_option_id`) 
                                                VALUES (
                                                        '$student_id',
                                                        '$teacher_id',
                                                        $session_id,
                                                        '$class_id',
                                                        '$course_id',
                                                        '$ques_id',
                                                        '$option_id'
                                                        )"
                                                );

            return $this->execute();
            
    }
    public function insert_eval_comment($student_id,$teacher_id,$class_id,$course_id,$session_id,$comment1,$comment2,$comment3,$comment4,$comment5,$comment6,$comment7,$comment8) {
        $comment1 = $this->qoute_string($comment1);
        $comment2 = $this->qoute_string($comment2);
        $comment3 = $this->qoute_string($comment3);
        $comment4 = $this->qoute_string($comment4);
        $comment5 = $this->qoute_string($comment5);
        $comment6 = $this->qoute_string($comment6);
        $comment7 = $this->qoute_string($comment7);
        $comment8 = $this->qoute_string($comment8);
        
        $this->query("INSERT INTO
                        `course_evaluation_comments`
                            (
                                `course_best_features`, 
                                `course_improvement_sgtions`, 
                                `course_content_organization`, 
                                `student_contribution`, 
                                `learning_environment`, 
                                `learning_resources`, 
                                `delivery_quality`, 
                                `assessment_ethodology`, 
                                `student_id`, 
                                `teacher_id`, 
                                `session_id`, 
                                `class_id`, 
                                `course_id`
                            ) VALUES (
                                :comment1,:comment2,:comment3,:comment4,
                                :comment5,:comment6,:comment7,:comment8,
                                '$student_id','$teacher_id','$session_id',
                                '$class_id','$course_id'
                                )"
                        );
            $this->bind(':comment1',$comment1);
            $this->bind(':comment2',$comment2);
            $this->bind(':comment3',$comment3);
            $this->bind(':comment4',$comment4);
            $this->bind(':comment5',$comment5);
            $this->bind(':comment6',$comment6);
            $this->bind(':comment7',$comment7);
            $this->bind(':comment8',$comment8);
           
            return $this->execute();
                                                
    }

    public function evaluation_status_set($student_id,$status) {
        
        $this->query("UPDATE `students` SET `crs_eval_status`='$status' WHERE `student_id`='$student_id' ");
        return $this->execute();
    }

    public function evaluation_status_get($student_id="") {
        $this->query("SELECT `crs_eval_status` FROM `students` WHERE `student_id`='$student_id'");
        return $this->single();
    }

    public function get_eval_session()
    {
        $this->query("SELECT `session_id` FROM `sessions` WHERE `eval_status`=1");
        return $this->single();
    }
}

?>