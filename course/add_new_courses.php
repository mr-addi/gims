<?php

require_once '..\sourses\courses_class.php';
if (isset($_POST['submit_course'])) {
  $course_code    =mysqli_real_escape_string($GLOBALS['con'],$_POST['course_code']);
  $course_title   =mysqli_real_escape_string($GLOBALS['con'],$_POST['course_title']);
  $course_cr_hr   =$_POST['crs_cr_hr'];
  $course_lab     =$_POST['crs_lab'];
  $course_type    =mysqli_real_escape_string($GLOBALS['con'],$_POST['crs_type']);
    $deg_obj=new course();
    $deg_obj->insert_course($course_code,$course_title,$course_cr_hr,$course_lab,$course_type);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add Course</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="  https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
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
        <a class="navbar-brand" href="#">Courses</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="../index.php">Home</a>
              </li>
              
              <li class="nav-item ">
                  <a class="nav-link" href="../courses_page">All Courses</a>
              </li>
              <li class="nav-item active">
                  <a class="nav-link" href="course/add_new_courses.php">Add New Course</a>
              </li>
            </ul>
        <ul class="nav navbar-nav navbar-right">
           <li><a href="../user_accounts/user_logout.php" class=" btn btn-default red-font"><b> LOGOUT </b></a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
    <h2 class="text-center">Courses<br> <sub><sub>(Add new Course)</sub></sub> </h2>
</div>
    <div class="container">
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <form method="post" action="">
            <table class="table table-bordered">
                <tr>
                  <th class="text-left">Course Code:</th>
                  <td><input type="text" name="course_code" autofocus value="" class="form-control" required></td>
                </tr>
                <tr>
                  <th class="text-left">Course Title:</th>
                  <td><input type="text" name="course_title" class="form-control" required></td>
                </tr>
                <tr>
                  <th class="text-left">Course Credit-Hours:</th>
                  <td>
                    <input type="number" min="0" class="form-control" name="crs_cr_hr" value="3" required>
                  </td>
                </tr>
                <tr>
                  <th class="text-left">Course Lab:</th>
                  <td>
                    <label for="crs_lab" class="form-control">
                      <input type="radio" name="crs_lab" value="1" checked>
                      No Lab</label>
                    <label for="crs_lab" class="form-control">
                      <input type="radio" name="crs_lab" value="2">
                      Computer Lab
                    </label>

                    <label for="crs_lab" class="form-control">
                      <input type="radio" name="crs_lab" value="3">
                      Other Lab
                    </label>

                  </td>
                </tr>
                <tr>
                  <th class="text-left">Course Type:</th>
                  <td>
                    <label for="crs_type" class="form-control">
                      <input type="radio" name="crs_type" value="major" checked>
                      Major</label>
                    <label for="crs_type" class="form-control">
                      <input type="radio" name="crs_type" value="minor">
                      Minor</label>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input type="submit" name="submit_course" value="Submit" class="btn btn-success pull-right">
                  <a href="../courses_page.php" class="btn btn-primary">CANCEL</a>
                  </td>
                </tr>
            </table>
          </form>
        </div>
        <div class="col-md-1">
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="..\js\bootstrap.min.js"></script>
  </body>
</html>
