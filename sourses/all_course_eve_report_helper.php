<?php

  /**
   *
   */
   require_once 'pdo_db_class.php';
     class cou_eve_helper extends Database
  {

    public function __construct()
    {
        Database::__construct();
    }
    public function get_teacher_by_session($session_id)
    {
      $this->query("SELECT DISTINCT
        t1.teacher_id,
        t1.teacher_first_name,
        t1.teacher_last_name
        FROM teachers_classes_courses as tcc
        JOIN teachers as t1 ON t1.teacher_id=tcc.teacher_id
        WHERE `session_id`='$session_id'
        ");

       $data_set=$this->resultset();
       return $data_set;
    }

    public function get_class_by_teacher_session($ses,$tec)
    {
      $this->query("SELECT DISTINCT
       cs.class_id,
       cs.class_name,
       tcc.class_section
       FROM teachers_classes_courses as tcc
  	   JOIN classes as cs ON cs.class_id=tcc.classs_id
       WHERE
       tcc.teacher_id='$tec' AND
       tcc.session_id='$ses'
        ");
        $data_set=$this->resultset();
        return $data_set;
    }
    // Get course By SESSION and TEACHER
    public function get_courses_by_teacher_session($tec,$ses,$cls)
    {
      $this->query("SELECT
      c.course_id,
      c.course_code,
      c.course_title
      FROM teachers_classes_courses as tcc
      JOIN courses as c ON c.course_id=tcc.course_id
      WHERE
      tcc.teacher_id=$tec AND
      tcc.session_id=$ses AND
      tcc.classs_id=$cls
       ");
       $data_set=$this->resultset();
       return $data_set;
    }
  }

// $obj=new cou_eve_helper();
// $abc=$obj->get_teacher_by_session(7);
//
// print_r($abc);

 ?>
