<?php
include '../student/upload_images.php';//include(1)
include '../sourses/courses_class.php';//include (2);
include '../sourses/validate_data.php';//include (3)
include 'class_course.php';//include(4)
require_once '../sourses/dbconnection.php';
// include '../sourses/databas_query_function.php';//include(5)
// Session Variables
  session_start();
  $id=$_SESSION['student'];
  $session_id=$_SESSION['session'];
  $class_id=$_SESSION['class'];
  // include (1)
  $obj1=new Student();
  $data=$obj1->fetch_onload();
  //include (2)
  $obj_course=new course();
  $course_allocated=$obj_course->student_course_allocated($id);
  //Bussiness Logic
  if (isset($_POST['allocation_form'])) {
    @$class=$_POST['class_selected'];
    @$course_id=$_POST['course_selected'];

    settype($course_id, "integer");
    settype($class, "integer");
    settype($id, "integer");
    settype($session_id, "integer");

    $_required = array('degree_selected','class_selected','course_selected');
    $val=array($id,$class,$session_id,$course_id);
    $filldes=array("student_id","class_id","session_id","course_id");

    $validate_obj=new validate();
    $validate_duplication=new Db_Query();
    $validate_response=$validate_obj->validate_required($_POST,$_required);
    $validate_response_dup=$validate_duplication->set_fecth_query("students_classes_courses",$filldes,$filldes,$val);

    if (mysqli_affected_rows($GLOBALS['con'])) {
      $message="This Course is already Allocated";
      $class="danger";
      error_handler($class,$message);
    }elseif(isset($validate_response)) {
      $message="Try Again! Please Choose the Right Option";
      $class="danger";
      error_handler($class,$message);
    }else {
      $filldes=array("student_id","class_id","session_id","course_id");
      // include (4)
      $obj3=new class_course_student();
      $obj3->set_insert_query("students_classes_courses",$filldes,$val);

    }
  }
  //Delete Response Handler
  if (isset($_GET['rsp'])) {
      $res=$_GET['rsp'];
      if ($res) {
        $message="OK Successfully Completed Operation";
        $class="success";
        error_handler($class,$message);
      }else {
        $message="Try Again! Please Choose the Right Option";
        $class="danger";
        error_handler($class,$message);
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student</title>

  <!-- Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/master.css">
</head>
<body>
<div class="jumbotron jmbtrn">
<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Student</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="../index.php">Home</a>
              </li>
              
              <li class="nav-item active">
                  <a class="nav-link" href="../student_show_data.php">All Students</a>
              </li>
              <li class="nav-item ">
                  <a class="nav-link" href="freeze_student.php">Freezed Students</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="student_insertion_form_for_ex.php">Add New Student</a>
              </li>
              </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="../user_accounts/user_logout.php" class=" btn btn-default red-font"><b> LOGOUT </b></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
      <h2 class="text-center">Students<br> <sub><sub>(All alocatedd courses to this students)</sub></sub> </h2>
  </div>
<div class="container">
<?php
 function error_handler($class,$message)
{ ?>
  <div class='alert alert-<?=$class ?> alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <?=$message ?>
  </div>
<?php } ?>
</div>
<div class="container">
  <table class="table table table-bordered">
    <tr>
      <th colspan="3" class="text-center text-primary"><h3>Currently Course Allocated</h3></th>
    </tr>
    <tr>
      <th>Course Code</th>
      <th>Course Title</th>
      <th>Action</th>

    </tr>
    <?php
      while ($row=mysqli_fetch_assoc($course_allocated)) {
        // prepare a key for delete from students_classes_courses table
        $key=$id."@".$session_id."@".$row['course_id'];
         ?>
        <tr>
          <td><?=$row['course_code'] ?></td>
          <td><?=$row['course_title'] ?></td>
          <td><a class="btn btn-danger" href="delete_course.php?del=<?=$key ?>" >Delete</a></td>
        </tr>
      <?php } ?>

  </table>
  <hr>
  <form class="" action="" method="post">
    <table class=" table table-bordered">
      <tr>
        <th colspan="2" class="text-center">Allocate One More Course</th>
      </tr>
      <tr>
        <th>Select Degree</th>
        <td>
          <select class="form-control input-sm" id="degree_selected" name="degree_selected"  required>
            <option value=""></option>
            <?php while ($row=mysqli_fetch_assoc($data)) { ?>
              <option value="<?php echo $row['degree_id'] ?>"><?php echo $row['degree_name'] ?> ( <?php echo $row['degree_subject_name'] ?> )</option>
            <?php } ?>
          <!--close( Fetch All the degrees onload page )-->
          </select>
        </td>
      </tr>
      <tr>
        <!--AJAX DATA  -->
        <th>Select Class</th>
        <td>
          <select id="degree_classes" class="form-control" name="class_selected" disabled>

          </select>
        </td>
      </tr>
      <tr>
        <th>Select Course</th>
        <td>
          <!--AJAX DATA  -->
          <select id="class_courses" class="form-control" name="course_selected" disabled>
            <option value=""></option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="pull-right">
          <input class="btn btn-success" type="submit"  name="allocation_form" value="Save">
        </td>
      </tr>
    </table>
  </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

</body>
</html>
<script>
(function() {
    $("#degree_selected").change(function() {
      $("#degree_classes").html("");
      var ses_id=$(this).val();
      $.ajax({
        url: '../sourses/get_sess_class.php',
        type: 'POST',
        data: {param1: ses_id}
      })
      .done(function(data) {
        $("#degree_classes").html("");
        $("#degree_classes").removeAttr('disabled');
        $("#degree_classes").append(data);

      })
      .fail(function(data) {
        console.log(data);
      })
      .always(function() {
        console.log("complete");
      });

    });
}) ();

(function() {
    $("#degree_classes").change(function() {
      $("#class_courses").html("");
      var ses_id=$(this).val();
      $.ajax({
        url: '../sourses/get_sess_class.php',
        type: 'POST',
        data: {param_course: ses_id}
      })
      .done(function(data) {
        $("#class_courses").html("");
        $("#class_courses").removeAttr('disabled');
        $("#class_courses").append(data);

      })
      .fail(function(data) {
        console.log(data);
      })
      .always(function() {
        console.log("complete");
      });

    });
}) ();

setTimeout(function(){ $(".alert").hide() }, 4000);
</script>
