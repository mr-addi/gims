<?php
if (isset($_GET['msg'])) { //show the responce message
  echo "<script> alert('".$_GET['msg']."'); </script>";
}
session_start(); //start session

//including external files
Include '../sourses/db_connection.php';
Include '../session/manage_session_class.php';
include '../sourses/teachers_class.php';


$tech_obj=new teacher(); //creationg teacher object
$sess_obj=new Manage_Session(); //session class object

$all_sess_raw_data=$sess_obj->fetch_all_session(); //getting all the sessions
if (isset($_GET)) { ##check if the value of get variable is set
$teacher_id = $_GET['tech_id']; //receive the teacher id by *url*

$result_data = $tech_obj->fn_ln_by_id($teacher_id); //tec Fname Lname
$teach_data = mysqli_fetch_assoc($result_data);
$teacher_fname = $teach_data['teacher_first_name'];
$teacher_lname = $teach_data['teacher_last_name'];
}
//if form is submitted
if (isset($_POST['form_submit'])||isset($_POST['form_submit1'])) {
$sess_id=$_POST['selected_session'];
$cl_id=$_POST['selected_class'];
$sec=$_POST['selected_section'];
$crs_id=$_POST['course_code'];

foreach ($crs_id as $key => $value) {
// $get_class_course_id="SELECT `class_course_id` FROM `classes_courses` WHERE `class_id`='$cl_id' AND `course_id`='$value'";
// $exe_get_class_course_id=mysqli_query($GLOBALS['con'],$get_class_course_id) or die($GLOBALS['conn']);
// $class_course_id=mysqli_fetch_assoc($exe_get_class_course_id);
 $responce = $tech_obj->insert_teach_crs_data($teacher_id,$sess_id,$cl_id,$value,$sec);
}
 if(isset($_POST['form_submit1'])){

  redirect("course_aloc_teacher.php?msg=$responce");
 } 
 if(isset($_POST['form_submit'])){
  redirect("select_crs_aloc_teach.php?tech_id=$teacher_id&msg=$responce");
 }



}



function redirect($url) { //deffining the redirect function
ob_start();
header('Location: '.$url);
ob_end_flush();
die();
}



 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alocate Courses</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style>
      .td_wid{
        width:33%;
      }
    </style>
  </head>
  <body>
    <div class="jumbotron"> <!-- div for navbar -->
      <nav class="navbar navbar-default">
       <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Teacher</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="course_aloc_teacher.php">Teacher Course Management <span class="sr-only">(current)</span></a></li>
              <li><a href="../index.php">Home</a></li>
              <li> <a href="add_teacher.php">Add New Teacher</a> </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li><a href="#">Link</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
       </div><!-- /.container-fluid -->
      </nav>
      <h2 class="text-center">Teacher Courses Allocation</h2>
    </div>
    <div class="col-md-1">

    </div>
    <div class="col-md-10">
      <h1 class="text-center">Teacher Data</h1>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Teacher Id</th>
              <th>Teacher First Name</th>
              <th>Teacher Last Name</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= $teacher_id ?></td>
              <td><?= ucwords($teacher_fname) ?></td>
              <td><?= ucwords($teacher_lname) ?></td>
            </tr>
          </tbody>
        </table>

        <h1 class="text-center">Select Data</h1>
        <form action="" method="post">
        <table class="table dtat_table" style="width:50%">
          <thead>
            <tr>
              <th>Select Session</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <select class="form-control" name="selected_session" id="selected_session">
                  <option value=""></option>
                  <?php
                    while ($sess_data=mysqli_fetch_assoc($all_sess_raw_data)) {
                      ?>
                      <option value="<?= $sess_data['session_id'] ?>"><?= ucwords($sess_data['session_type']." - ".$sess_data['session_year']." - ".$sess_data['session_timming']) ?></option>
                      <?php
                    }
                   ?>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
        <table class="table table-bordered" id="class_sec_crs_tbl">
          <thead>
            <tr>
              <th class="td_wid">Class</th>
              <th style="width:20%;">Section</th>
              <th >Courses</th>
            </tr>
          </thead>
          <tfoot>
            <td colspan="2">
               <input type="submit" name="form_submit" class="btn btn-primary" value="Add another class"> </td>
            <td> <input type="submit" name="form_submit1" value="Submit and exit" class="btn btn-success"> </td>
          </tfoot>
          <tbody id="selection_append">
            <tr>
              <td>
                <select class="form-control" name="selected_class" id="class_selected">

                </select>
              </td>
              <td>
                <select class="form-control" name="selected_section">
                  <option value="a">a</option>
                  <option value="b">b</option>
                </select>
              </td>
              <td>
                  <div id="insrt_chk_bxs" style="height:400px;" class="form-control">

                  </div>
              </td>
            </tr>
          </tbody>
        </table>
        </form>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
     <script>
         $('#selected_session').change(function() {
           var sess_val=$(this).val();
           console.log(sess_val);
           $.ajax({
                url: '../sourses/get_sessions_class.php',
                type:'POST',
                data: {param1 : sess_val}
              })
              .done(function(data) {
                  $("#class_selected").append(data);
              })
            });
            $("#class_selected").change(function() {

              var chk_val=this.value;
              $.ajax({
                url: '../sourses/get_classes_courses.php',
                type:'POST',
                data: {param1 : chk_val,param2 : "check_box"}
              })
              .done(function(data) {
                $('#insrt_chk_bxs').html(data);
              })
            });
     </script>
  </body>
</html>
