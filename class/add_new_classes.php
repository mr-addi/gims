<?php
  require_once '..\sourses\classes_class.php';
  require_once '..\sourses\courses_class.php';
  require_once '..\sourses\degree_class.php';
  $deg_obj      =new degree();
  $degree_data  =$deg_obj->get_all_degrees_record();
  $course_obj   =new course();
  $courses_data =$course_obj->get_id_code_name("");
  if (isset($_POST['add_class'])) {
    $name   =$_POST['cls_name'];
    $sem_no =$_POST['cls_sem'];
    $deg_id =$_POST['degree'];
    $courses=$_POST['course'];

    $cls_name    =mysqli_real_escape_string($GLOBALS['con'],$name);
    $cls_sem     =mysqli_real_escape_string($GLOBALS['con'],$sem_no);
    $cls_title   =$cls_name."(".$cls_sem.")";
    $cls_obj     =new classes();
    $cls_lst_id  =$cls_obj->insert_data_rt_id($cls_title);
    foreach ($courses as $key => $value) {
      $insrt_qry ="INSERT INTO classes_courses(degree_id, class_id, course_id) VALUES ('$deg_id', '$cls_lst_id', '$key')";
      $insrt_exe =mysqli_query($GLOBALS['con'],$insrt_qry) or die(mysqli_error($GLOBALS['con']));
    }

  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>classes</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css\header_css.css">
    <style media="screen">
      *{

      }
    </style>
  </head>
  <body>

    <div class="jumbotron set_logo">
      <div class="pull-left">
        <a href="../index.php"><img src="../image/logo.png" alt="GIMS logo" width="180px" height="150px" style="padding-bottom:10px;"></a>
      </div>
      <div class="inner pull-right top_ul">
        <ul class="list-inline list-unstyled top_links">
          <li><a href="../index.php">Home</a></li>
          <li><a class="active" href="#"><u>Add New Class</u></a></li>
          <li><a href="../class_page.php">Show Classes</a></li>
        </ul>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 text-center">
          <h3 class="bg-success">Add New Class</h3>
          <form method="post" action="">
            <table class="table table-bordered">

                <tr>
                  <th>Class Name:</th>
                  <td>
                    <input type="text" name="cls_name" class="form-control" required autofocus>
                  </td>
                </tr>
                <tr>
                  <th>Semester Number:</th>
                  <td><input type="text" class="form-control" name="cls_sem" required></td>
                </tr>
                <tr>
                  <th>Select Degree of semester</th>
                  <td>
                    <select class="form-control" name="degree">
                      <?php while ($degree=mysqli_fetch_assoc($degree_data)) { ?>
                        <option value="<?= $degree['degree_id'] ?>"><?= $degree['degree_name']?>  (<?= $degree['degree_subject_name']?>)</option>
                      <?php } ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>Select Courses</th>
                  <td >
                    <ol class="text-left" style="height:400px;overflow:scroll;">
                      <?php while ($course=mysqli_fetch_assoc($courses_data)) { ?>
                        <li>
                          <label for="course[<?= $course['course_id'] ?>]">
                            <input type="checkbox" name="course[<?= $course['course_id'] ?>]" value="<?= $course['course_id'] ?>">
                             ( <?= $course['course_code'] ?> ) - <?= $course['course_title'] ?>
                          </label>
                        </li>
                      <?php  } ?>
                    </ol>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input type="submit" name="add_class" value="Submit" class="btn btn-success">
                    <a href="../class_page.php" class="btn btn-primary">CANCEL</a>
                  </td>
                </tr>
            </table>
          </form>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
