<?php
/**
 * 
 * --------------------------------------------------
 * Student evaluates the courses 0f perivious class and its teachers
 * ---------------------------------------------------------------------
 * 
 * ## In this page the evaluation questions are presented to the student
 *      
 * 
 * 
 */
    session_start();
    if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=NULL) { 
        if($_SESSION['reset_status']== 0) { 
          redirect('user_accounts/student_password_reset.php');
        }
    

    @$student_id=$_SESSION['user_id']; //getting the user-id
    @$student_arid_no=$_SESSION['user_name']; //getting the user-login-name
    if (isset($_SESSION['error_msg'])) {
        // echo '<script> alert("'.$_SESSION['error_msg'].'") </script>';
        unset($_SESSION['error_msg']);
        
    }
   

    require_once('../student/upload_images.php'); //including student classs
    require_once('../sourses/course_evaluation_class.php');//including the evalustion class

    $cec_obj    = new course_evaluation(); //evaluation object
    $std_obj    = new Student(); //student object
    $eval_status= $cec_obj->evaluation_status_get($student_id);
    
    // echo "<br> stau";
    // print_r($eval_status);
    // echo "<br>";
    
    $eval_ques=$cec_obj->get_eval_ques(); //getting evluation questions

    $eval_sess_res=$cec_obj->get_eval_session();
     $eval_sess=$eval_sess_res['session_id'];

    //grtting the student info
    $result = $std_obj->get_student_name_class_section($student_id);
    $student_data = mysqli_fetch_assoc($result);

    $student_first_name = $student_data['student_first_name'];
    $student_last_name = $student_data['student_last_name'];
    $student_section = $student_data['student_section'];
    //getting the final result to show
    $result_final = $cec_obj->student_class_courses_teachers($student_id,$eval_sess,$student_section);
    
    if(count($result_final)==1){ //showing the error message on not finding the Data
        echo '<h1 style="position:absolute;height:50px;color:red;">
                    <strong>Oh snap!</strong> No Data found
                </h1>'; 
    } elseif($eval_status['evaluation_status']<count($result_final)){
        $_SESSION['id_index']=$eval_status['evaluation_status'];
        
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Evaluation</title>
    <!-- offline links -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/master.css">
    <!-- [ in case of using online cdn unncomment ]

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

   -->
    <style media="screen">
      *{
        /* background-image: url(logo.png); */
      }
      .opt_wdth{
          width:3%;
      }
    </style>
  </head>
  <body>
        <div class="jumbotron text-primary jmbtrn">
        <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../student_portal.php">Student Portal</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../student_portal.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Results</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Events</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <!-- <button class="btn btn-outline-success my-2 my-sm-0">Search</button> -->
                <a href="user_accounts/student_logout.php" class="btn btn-outline-danger my-2 my-sm-0"> LOGOUT  </a>
                </form>
            </div>
        </nav>
        <p class="text-center display-4">Teacher Evatuation <br> <sub><sub>(Proforma-10)</sub></sub> </p>
        </div>

        <!-- main area -->

        <?php 
        $_SESSION['totlat_subs']=count($result_final);
        // echo "<br> result count = ".count($result_final)."<br>";
        ?>
        <form action="evaluation_sumit_receiver.php" method="post" id="eval_form">
        <div class="container working_div">
            <div class="row" >
                <!-- <div class="col-md-2"></div> -->
                <div class="col-md-12">
                    <div class="row" >
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <p class="display-4 text-center text-primary" style=" font-size:50px; " >Student Data</p>
                                <table class=" table table-bordered">
                                <tr>
                                    <th>Student Name:</th>
                                    <td>
                                    <?= ucwords($student_first_name) ?>
                                    <input type="hidden" name="student_id" value="<?= $student_id ?>" >
                                    <input type="hidden" name="session_id" value="<?= $eval_sess ?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <th>Roll No:</th>
                                    <td><?= $student_arid_no ?></td>
                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <td>
                                    <?= $result_final[$_SESSION['id_index']]['class_name'] ?> (<?= $result_final[$_SESSION['id_index']]['session_year'] ?>-<?= $result_final[$_SESSION['id_index']]['session_type'] ?>)
                                    <input type="hidden" name="class_id" value="<?= $result_final[$_SESSION['id_index']]['class_id'] ?>">
                                    </td>
                                <tr></tr>
                                </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <p class="display-4 text-center text-primary" style=" font-size:50px; ">Teacher Data</p>
                                <table class=" table table-bordered">
                                <tr>
                                    <th>Teacher Name:</th>
                                    <td><?= ucwords($result_final[$_SESSION['id_index']]['teacher_first_name']." ".$result_final[$_SESSION['id_index']]['teacher_last_name']) ?></td>
                                </tr>
                                <tr>
                                    <th>course code</th>
                                    <td><?= $result_final[$_SESSION['id_index']]['course_code'] ?></td>
                                </tr>
                                <tr>
                                    <th>Course Title</th>
                                    <td><?= $result_final[$_SESSION['id_index']]['course_title'] ?></td>
                                <tr></tr>
                                </table>    
                        
                        </div>
                </div>

                </div>
            </div>
            <div class="row" >
            <table class="table table-bordered table-sm" >
                <thead>
                    <th class="text-center bg-success text-white"><h5>index</h5></th>
                    <th class="text-center bg-success text-white"><h5>Questions</h5></th>
                    <th class="text-center bg-success text-white"><h5>Strongly Agree</h5></th>
                    <th class="text-center bg-success text-white"><h5>Agree</h5></th>
                    <th class="text-center bg-success text-white"><h5>Uncertain</h5></th>
                    <th class="text-center bg-success text-white"><h5>Disagree</h5></th>
                    <th class="text-center bg-success text-white"><h5>Strongly Disagree</h5></th>
                </thead>
                <tbody>
                    <?php
                        foreach ($eval_ques as $no => $ques) {
                        ?>
                        <tr>
                            <td><?= $no+1 ?></td>
                            <td><h5><?= $ques['evaluation_question_title'] ?></h5></td>
                            <td class="opt_wdth"> <input type="radio" name="option[<?=  $result_final[$_SESSION['id_index']]['course_id'] ?>][<?=  $result_final[$_SESSION['id_index']]['teacher_id'] ?>][<?= $ques['evaluation_question_id'] ?>]" value="1" checked> </td>
                            <td class="opt_wdth"><input type="radio" name="option[<?=  $result_final[$_SESSION['id_index']]['course_id'] ?>][<?=  $result_final[$_SESSION['id_index']]['teacher_id'] ?>][<?= $ques['evaluation_question_id'] ?>]" value="2"></td>
                            <td class="opt_wdth"><input type="radio" name="option[<?=  $result_final[$_SESSION['id_index']]['course_id'] ?>][<?=  $result_final[$_SESSION['id_index']]['teacher_id'] ?>][<?= $ques['evaluation_question_id'] ?>]" value="3"></td>
                            <td class="opt_wdth"><input type="radio" name="option[<?=  $result_final[$_SESSION['id_index']]['course_id'] ?>][<?=  $result_final[$_SESSION['id_index']]['teacher_id'] ?>][<?= $ques['evaluation_question_id'] ?>]" value="4"></td>
                            <td class="opt_wdth"><input type="radio" name="option[<?=  $result_final[$_SESSION['id_index']]['course_id'] ?>][<?=  $result_final[$_SESSION['id_index']]['teacher_id'] ?>][<?= $ques['evaluation_question_id'] ?>]" value="5"></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
            </table>
            <table class="table table-bordered">
                    <tr>
                    <td class=" text-center bg-inverse text-white">
                        <h3>Any Comment About  Teacher?</h3>
                    </td>
                    </tr>
                    <tr>
                        <td>
                        <textarea name="teacher_comment" class="form-control" cols="50" rows="10" placeholder="type your comment here" ></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td class=" text-center bg-inverse text-white">
                        <h3>Any Comment About the course?</h3>
                    </td>
                    </tr>
                    <tr>
                        <td>
                        <textarea name="course_comment" class="form-control" cols="50" rows="10" placeholder="type your comment here" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-success form-control" value="Submit & next">    
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        </form>


            <!-- offline links -->
            <script src="../js/jquery-3.2.1.min.js"></script>
            <script src="../js/bootstrap.js"></script>
            <!-- [ in case of using online cdn unncomment ] 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
            <script>

            </script>
    </body>
</html>
        <?php 
        } // check of total VS submited no of courses
            elseif ($eval_status['evaluation_status']=count($result_final)) {
                ?>
                <a href="../student_portal.php"> < BACK</a>
                <h1 style="position:absolute;height:50px;color:Green;">
                    <strong>Well Done</strong> You have already done the teacher evaluatin for current session
                </h1>
            <?php
            // redirect("../student_portal.php");
            }
} else { //login check redirect 
    redirect("../student_login.php");
}

function redirect($url) { //deffining the redirect function
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
  }

?>
