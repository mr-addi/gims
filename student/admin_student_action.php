<?php
/*
| Student Admin Pannel
*/
include '../sourses/student_class.php';//include(1)
include '../sourses/courses_class.php';//inclue (2);

// URL VARIABLES
$s_id=urldecode(base64_decode($_GET['del']));

$obj=new student_class();//(1)
$data_result=$obj->admin_student_action($s_id);//(..1)
$data_statement=mysqli_fetch_assoc($data_result);//(..1)

$obj_course=new course();//(2)
$course_allocated=$obj_course->student_course_allocated($s_id);//(2)

// SESSION VARIABLES
session_start();
$_SESSION['student']=$s_id;
$_SESSION['session']=$data_statement['student_current_session'];
$_SESSION['class']=$data_statement['student_currunt_semester'];

// // Header VARIABLES
// $title="Student Action Profile";
// $home="../index.php";
// $active="Student Action Profile";
// $next_link="../student_show_data.php";
// $next_content="All Students";

// // Header include
// require '../sourses/header.php';
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
             <!-- <li><a href="../user_accounts/user_logout.php" class=" btn btn-default red-font">logout</a></li> -->
             <li><a href="../user_accounts/user_logout.php" class=" btn btn-default red-font"><b> LOGOUT </b></a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
      <h2 class="text-center">Students<br> <sub><sub>(Students Details)</sub></sub> </h2>
  </div>
<div class="container">
  <div class="row">
    <div class="col-sm-2 col-md-2 col-lg-2" style="padding:10px;">
      <a class="btn form-control btn-success" href="#">Profile</a>
      <a class="btn form-control btn-default" href="../allocate_course_update_classes/manage_course_allocation.php">Mangae Course</a>
      <a class="btn form-control btn-default" href="#">Expire Registration</a>
      <a class="btn form-control btn-default" href="#">Passout</a>
      <a class="btn form-control btn-default" href="#login_details">Login Detail</a>
    </div>
    <div class="col-sm-10 col-md-10 col-lg-10">
      <table class="table">
        <tr class="">
          <th class="text-center text-primary "><h3>Student Personale Profile</h3></th>
        </tr>
      </table>
      <div class="row">
        <div class="col-sm-10 col-md-10 col-lg-10">
          <table class="table table-bordered">
            <tr>
              <th>Arid NO:</th>
              <td><?=$data_statement['arid_reg_no']; ?></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <th>Name:</th>
              <td><?=ucwords($data_statement['student_first_name']);  ?></td>
              <th>Father Name:</th>
              <td><?=ucwords($data_statement['parent_name']);  ?></td>
            </tr>
            <tr>
              <th>CNIC:</th>
              <td><?=$data_statement['student_cnic'];?></td>
              <th>City:</th>
              <td><?=ucwords($data_statement['student_contact_city']);  ?></td>
            </tr>
            <tr>
              <th>Mobile</th>
              <td><?=$data_statement['student_contact_mobile_no']; ?></td>
              <th>E-Mail:</th>
              <td><?=ucwords($data_statement['student_contact_email']); ?></td>
            </tr>
          </table>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
          <div class="" style="height:150px;">
            <img src="<?=$data_statement['student_picture_path']; ?>" alt="" width="170px" height="170px">
          </div>
        </div>
      </div>
      <table class="table">
        <tr class="">
          <th class="text-center text-primary "><h3>Student Acadamics Profile</h3></th>
        </tr>
      </table>
      <div class="row">
        <div class="col-sm-10 col-md-10 col-lg-10">
          <table class="table table-bordered">
            <tr>
              <th>Current Status</th>
              <?php if ($data_statement['is_deleted']==0) { ?>
                <td>Active</td>
                <td>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#myModal">
                    Freeze
                  </button>
                </td>
              <?php } else { ?>
                <td>Freeze</td>
                <td>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#myModal">
                    Un Freeze
                  </button>
                </td>
              <?php } ?>

            </tr>
            <tr>
              <th>Class:</th>
              <td><?=$data_statement['class_name']; ?></td>
              <th></th>
            </tr>
            <tr>
              <th>Current Course Allocated</th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th></th>
              <th>Course Code</th>
              <th>Course Title</th>

            </tr>
            <?php
            while ($row=mysqli_fetch_assoc($course_allocated)) { ?>
              <tr>
                <th></th>
                <td><?=$row['course_code']; ?></td>
                <td><?=$row['course_title']; ?></td>
              </tr>
            <?php }   ?>
            <!-- <tr>
              <td colspan="3">
                <button class="btn btn-success form-control" type="button" name="button">Okk</button>
              </td>
            </tr> -->
          </table>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">

        </div>
      </div>
      <hr>
      <!-- Login Pannale  -->
      <table class="table" id="login_details">
        <tr class="">
          <th class="text-center text-primary "><h3>Login Pannale</h3></th>
        </tr>
      </table>
      <div class="row">

        <div class="col-md-10">
          <table class="table table-bordered">
            <tr>
              <th>User Name</th>
              <td><?=$data_statement['student_login_name'] ?></td>
            </tr>
            <tr>
              <th>Passowrd</th>
              <td><?=$data_statement['student_login_password'] ?></td>
            </tr>
            <tr>
              <td colspan="2" class="pull-right">
                <button class="btn btn-success pull-right form-control" type="button" name="button">Reset Account</button>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-md-2">

        </div>
      </div>

    </div>
  </div>
</div>
<!--Modal for Mangae Student Status  -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!--Modal for Mangae Student Status  -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
