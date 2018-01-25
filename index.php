<?php
/**
 * ==================================
 * admin home page
 * ==================================
 *
 */



session_start();
if ($_SESSION['perm']=="") { //check if user is login
  redirect("permission/login_user.php"); //redirect to the login page
} else {
        require_once 'permission/dbconnection.php'; //addiing the permission system database connection
        require_once 'permission/module_manager.php';//Getting the available modules;
        require_once 'permission/section_manager.php';//Getting the available modilules;section_manager
        $_SESSION['module_names']=permission_checker();
        $sections=section_checker("Academics");

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
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Cover Template for Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/master.css">

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/cover/cover.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <style media="screen">
      .nav_a{
        padding-left: 5px;
      }
    </style>
  </head>
<style media="screen">
  .logo_set{
    background-image: url(image/logo.png);
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
  }
  .try>a{
    margin: 10px;
  }
</style>
  <body>

    <div class="site-wrapper logo_set" >

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <nav class="nav nav-masthead try text-center">
                <a class="nav-link active" href="#" class="btn">Home</a>


                <?php if (array_search("Student Manager",$_SESSION['module_names'])): //check permission to this module ?>
                  <a href="student_show_data.php" class="btn" style="border:1px solid white;">Student</a>
                <?php endif; ?>
                <?php if (array_search("Academics",$_SESSION['module_names'])): //check permission to this module ?>

                  <li class="nav-item dropdown btn">
                        <a class="dropdown-toggle btn" style="border:1px solid white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Academics
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <!-- <nav class="navbar navbar-default"> -->
                      <ul class="nav-pills list-unstyled">
                          <?php if (array_search("Degrees",$sections)): ?>
                            <!-- <li class="nav-item"> -->
                              <a class="btn text-gray-dark form-control" href="degrees_page.php">Degrees</a>
                            <!-- </li> -->
                          <?php endif; ?>
                          <?php if (array_search("Courses",$sections)): ?>
                            <li class="nav-item">
                              <a class="btn text-gray-dark form-control" href="courses_page.php">Courses</a>
                            </li>
                          <?php endif; ?>
                          <?php if (array_search("Classes",$sections)): ?>
                            <li class="nav-item">
                              <a class="btn text-gray-dark form-control" href="class_page.php">Classes</a>
                            </li>
                          <?php endif; ?>
                          <?php if (array_search("Sessions",$sections)): ?>
                            <li class="nav-item">
                              <a class="btn text-gray-dark form-control" href="session\manage_session.php">Sessions</a>
                            </li>
                          <?php endif; ?>
                          <?php if (array_search("Date Sheet",$sections)): ?>
                            <li class="nav-item">
                              <a href="date_sheet.php" class="btn text-gray-dark form-control">Create Date Sheet</a>
                            </li>
                          <?php endif; ?>
                          <li class="nav-item">
                            <a href="allocate_course_update_classes/allocate_course.php" class="btn text-gray-dark form-control">Update Class Session</a>
                          </li>



                      </ul>
                    <!-- </nav> -->
                      </div>
                    </li>

                  <!-- <a href="Academics_links.php" class="btn" style="border:1px solid white;">Academicss</a> -->
                <?php endif; ?>


                <?php if (array_search("Teacher Manager",$_SESSION['module_names'])): //check permission to this module ?>
                  <!-- <a href="teacher/teachers.php" class="btn" style="border:1px solid white;">Teachers</a> -->

                  <li class="nav-item dropdown btn">
                        <a class="dropdown-toggle btn" style="border:1px solid white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Teachers
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <!-- <nav class="navbar navbar-default"> -->
                      <ul class="nav-pills list-unstyled">
                          <li class="nav-item">
                            <a class="btn text-gray-dark form-control" href="teachers_page.php">All Teachers</a>
                          </li>
                          <hr>
                          <li class="nav-item">
                            <a class="btn text-gray-dark form-control" href="teacher/course_aloc_teacher.php">Teacher Course Management</a>
                          </li>
                      </ul>
                    <!-- </nav> -->
                      </div>
                    </li>

                <?php endif; ?>

                <li class="nav-item dropdown btn">
                        <a class="dropdown-toggle btn" style="border:1px solid white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More..
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <!-- <nav class="navbar navbar-default"> -->
                      <ul class="nav-pills list-unstyled">
                        <li class="nav-item">
                          <a href="teacher/evaluation_reports.php" class="btn text-gray-dark form-control">Teacher Evaluation Reports</a>
                        </li>
                        <li class="nav-item">
                          <!-- <a href="teacher/course_evaluation_reports.php" class="btn text-gray-dark form-control">Course Evaluation Reports</a> -->
                          <a href="teacher/course_evaluation_reports.php" class="btn text-gray-dark form-control">Course Evaluation Reports</a>
                        </li>
                        <li class="nav-item">
                          <a href="session/evaluation_session.php" class="btn text-gray-dark form-control">Evaluation Session</a>
                        </li>
                      </ul>
                    <!-- </nav> -->
                      </div>
                    </li>

                <!-- <a href="teachers_page.php" class="btn" style="border:1px solid white;">Teachers</a> -->
              </nav>

            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">PMAS AAUR</h1>
            <h1 class="cover-heading">Gujrat Institute Of Management Sciences</h1>
            <section>
              <a href="user_accounts/user_logout.php" class="btn btn-lg btn-danger">LOG-OUT</a>
            </section>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p style="color:white">&copy;PMAS-AAUR-GIMS <-|-> dev by :)Malangs(: </p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- <script>window.jQuery || document.write('<script src="http://v4-alpha.getbootstrap.com/assets/js/vendor/jquery.min.js"></script>')</script> -->
    <script src="http://v4-alpha.getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>


  </body>
</html>
