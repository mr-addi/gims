<?php

/**
 * complete acadamic links
 * 
 */

session_start();
if ($_SESSION['perm']=="") { //check if user is login
  redirect("permission/login_user.php"); //redirect to the login page
} else {
        require_once 'permission/dbconnection.php'; //addiing the permission system database connection
        require_once 'permission/module_manager.php';//Getting the available modilules;
        require_once 'permission/section_manager.php';//Getting the available modilules;section_manager
        $_SESSION['module_names']=permission_checker(); //get all the module names permitted

    }
    function redirect($url) { //deffining the redirect function
      ob_start();
      header('Location: '.$url);
      ob_end_flush();
      die();
    }

?>
<?php if (array_search("Academics",$_SESSION['module_names'])){ //check permission to this module
$sections=section_checker("Academics");

?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title></title>

      <!-- Bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    </head>
    <body>

      <nav class="navbar navbar-default">
        <ul class="nav nav-pills">
          <li class="nav-item active">
            <a href="#">Acadamics</a>
          </li>
          <?php if (array_search("Degrees",$sections)): ?>
            <li class="nav-item">
              <a class="btn" href="degrees_page.php">Degrees</a>
            </li>
          <?php endif; ?>
          <?php if (array_search("Courses",$sections)): ?>
            <li class="nav-item">
              <a class="btn" href="courses_page.php">Courses</a>
            </li>
          <?php endif; ?>
          <?php if (array_search("Classes",$sections)): ?>
            <li class="nav-item">
              <a class="btn" href="class_page.php">Classes</a>
            </li>
          <?php endif; ?>
          <?php if (array_search("Sessions",$sections)): ?>
            <li class="nav-item">
              <a class="btn" href="session\manage_session.php">Sessions</a>
            </li>
          <?php endif; ?>
          <?php if (array_search("Date Sheet",$sections)): ?>
            <li class="nav-item">
              <a href="date_sheet.php" class="btn">Create Date Sheet</a>
            </li>
          <?php endif; ?>
            <li class="nav-item">
              <a href="allocate_course_update_classes/allocate_course.php" class="btn">Update Class Session</a>
            </li>
            <li class="nav-item">
              <a href="student/freeze_students.php" class="btn">Manage Freeze Students</a>
            </li>

          <li class="nav-item">
            <a href="teacher/evaluation_reports.php" class="btn">Teacher Evaluation Reports</a>
          </li>
          <li class="nav-item">
            <a href="teacher/course_evaluation_reports.php" class="btn">Course Evaluation Reports</a>
          </li>
        </ul>
      </nav>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
  </html>


<?php }else {
  redirect("index.php"); //redirect to the login page

} ?>
