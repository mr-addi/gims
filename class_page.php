<?php
/**
 * =============================
 * classes complete record
 * =============================
 * 
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

<?php
$sections=section_checker("Academics");
 if (array_search("Classes",$sections)){ //check permission to this module
// print_r($sections);
?>

<?php
if(isset($_GET['msg'])) {
  ?>
     <script type="text/javascript">
      alert('<?= $_GET['msg'] ?>');
     </script>
  <?php
}
require_once 'sourses\classes_class.php';
require_once 'sourses\courses_class.php';
require_once 'sourses\degree_class.php';
$cls_obj=new classes();
$deg_obj=new degree();
$crs_obj=new course();
$classes_result=$cls_obj->get_all_classes_data();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>classes</title>


  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="  https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="css/header_css.css">

</head>
<body>
  <div class="jumbotron set_logo">
    <div class="pull-left">
      <a href="index.php"><img src="image/logo.png" alt="GIMS logo" width="180px" height="150px" style="padding-bottom:10px;"></a>
    </div>
    <div class="inner pull-right top_ul">
      <ul class="list-inline list-unstyled top_links">
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="#"><u>Classes Management</u></a></li>
        <li><a href="class\add_new_classes.php">Add New Class</a></li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-1">

      </div>
      <div class="col-md-10">
        <h1 class="bg-success">classes that the university offers</h1>
        <table class="table table-bordered"  id="example">
          <thead>
            <tr class="text-center">
              <th></th>
              <th>class Id</th>
              <th>class Name</th>
              <th>Degree</th>
              <th>Courses</th>
            </tr>
          </thead>

            <tbody>
              <?php while ($class=mysqli_fetch_assoc($classes_result)) {
                $cls_id     = $class['class_id'];
                $cls_name   = $class['class_name'];
                $get_deg_id = "SELECT degree_id FROM classes_courses WHERE class_id='$cls_id'";
                $exe_deg_id = mysqli_query($GLOBALS['con'],$get_deg_id) or die(mysqli_error($GLOBALS['con']));
                $deg_id     = mysqli_fetch_assoc($exe_deg_id);
                $deg_result = $deg_obj->get_all_degrees_record_by_id($deg_id['degree_id']);
                $degree     = mysqli_fetch_assoc($deg_result);
                ?>
                <tr>
                  <td>
                    <a href="#" class="btn btn-info" onclick="warning()" style="width:40%;float:left;"> EDIT </a>
                    <a href="class\delete_class.php?cls_id=<?= $cls_id ?>" style="width:59%;float:right;" class="btn btn-danger" onclick="return confirm('Are You Sure???')"> DELETE </a>

                    <!-- <a href="class\update_class.php?cls_id=<?= $cls_id ?>" class="btn btn-warning" onclick="warning()"> EDIT </a> -->
                  </td>
                  <td><?=  $cls_id ?></td>
                  <td><?=  $cls_name ?></td>
                  <td><?=  $degree['degree_name'] ?>(<?=  $degree['degree_subject_name'] ?>)</td>
                  <td>
                    <ol>
                      <?php
                        $get_crs_id = "SELECT course_id FROM classes_courses WHERE class_id='$cls_id'";
                        $exe_crs_id = mysqli_query($GLOBALS['con'],$get_crs_id) or die(mysqli_error($GLOBALS['con']));
                        while ($single_crs_id=mysqli_fetch_assoc($exe_crs_id)) {
                          $crs_id=$single_crs_id['course_id'];
                           $crs_data=$crs_obj->get_id_code_name($crs_id);
                           $course=mysqli_fetch_assoc($crs_data);
                           if ($course['course_code']!="") {

                      ?>
                        <li><?= $course['course_title'] ?> [<?=  $course['course_code'] ?>]</li>
                      <?php
                           }
                          }
                      ?>
                    </ol>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
            $('#example').DataTable();
          } );
    </script>
    <script>
      function warning(){
        alert('sorry the page is under development');
        return false;
      }
    </script>
  </body>
  </html>



  <?php }else {
    redirect("index.php"); //redirect to the login page

  } ?>
