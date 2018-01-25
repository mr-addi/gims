<?php

require_once '..\sourses\courses_class.php';
$id=$_GET['id'];
$course_obj=new course();
$result=$course_obj->get_all_courses_by_id($id);
if (isset($_POST['submit_course'])) {
  $course_code    =mysqli_real_escape_string($GLOBALS['con'],$_POST['course_code']);
  $course_title   =mysqli_real_escape_string($GLOBALS['con'],$_POST['course_title']);
  $course_cr_hr   =mysqli_real_escape_string($GLOBALS['con'],$_POST['crs_cr_hr']);
  $course_lab     =mysqli_real_escape_string($GLOBALS['con'],$_POST['crs_lab']);
  $course_type    =mysqli_real_escape_string($GLOBALS['con'],$_POST['crs_type']);
  $course_obj->update_course($id,$course_code,$course_title,$course_cr_hr,$course_lab,$course_type);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Courses</title>
  <link rel="stylesheet" href="..\css\bootstrap.min.css">
</head>
<body>
  <div class="jumbotron">
    <h3 class="text-center">COURSES</h3>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <ul>
          <li><a href="..\index.php">HOME</a></li>
          <li><a href="..\courses_page.php">All Courses</a></li>
        </ul>
      </div>
      <div class="col-md-8">

        <form method="post" action="">
          <table class="table">
            <?php while ($course=mysqli_fetch_assoc($result)) {
              ?>
              <tr>
                <th class="text-left">Course Code:</th>
                <td><input type="text" name="course_code" class="form-control" required value="<?= $course['course_code'] ?>"></td>
              </tr>
              <tr>
                <th class="text-left">Course Title:</th>
                <td><input type="text" name="course_title" class="form-control" required value="<?= $course['course_title'] ?>"></td>
              </tr>
              <tr>
                <th class="text-left">Course Credit-Hours:</th>
                <td>
                  <input type="number" name="crs_cr_hr" required value="<?= $course['course_credit_hours'] ?>">
                </td>
              </tr>
              <tr>
                <th class="text-left">Course Lab:</th>
                <td>
                  <label for="crs_lab" class="form-control">
                    <input type="radio" name="crs_lab"
                    <?php if ($course['course_lab'] == 1): ?>
                        checked
                    <?php endif; ?>
                     value="1" >
                    No Lab</label>
                    <label for="crs_lab" class="form-control">
                      <input type="radio" name="crs_lab"
                      <?php if ($course['course_lab'] == 2): ?>
                          checked
                      <?php endif; ?>
                       value="2">
                      Computer Lab
                    </label>

                    <label for="crs_lab" class="form-control">
                      <input type="radio" name="crs_lab"
                      <?php if ($course['course_lab'] == 3): ?>
                          checked
                      <?php endif; ?>
                       value="3">
                      Other Lab
                    </label>

                  </td>
                </tr>
                <tr>
                  <th class="text-left">Course Type:</th>
                  <td>
                    <label for="crs_type" class="form-control">
                      <input type="radio" name="crs_type"
                      <?php if ($course['course_type'] == "major"): ?>
                          checked
                      <?php endif; ?>
                      value="major">
                      Major</label>
                      <label for="crs_type" class="form-control">
                        <input type="radio" name="crs_type"
                        <?php if ($course['course_type'] == "minor"): ?>
                            checked
                        <?php endif; ?>
                         value="minor">
                        Minor</label>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  <tr>
                    <td colspan="2">
                      <input type="submit" name="submit_course" value="Update Course" class="btn btn-success">
                      <a href="../courses_page.php" class="btn btn-primary">CANCEL</a>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="..\js\bootstrap.min.js"></script>
      </body>
      </html>
