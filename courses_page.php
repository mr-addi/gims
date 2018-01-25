<?php
/**
 * ===========================
 * Show all the available courses
 * ===========================
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
 if (array_search("Courses",$sections)){ //check permission to this module

?>

<?php
if(isset($_GET['msg'])) {
  ?>
     <script type="text/javascript">
      alert('<?= $_GET['msg'] ?>');
     </script>
  <?php
}
require_once 'sourses\courses_class.php';
$course_obj=new course();
$all_record=$course_obj->get_all_courses_record();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="  https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="#">All Courses</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="course/add_new_courses.php">Add New Course</a>
                </li>
              </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="user_accounts/user_logout.php" class=" btn btn-default red-font"><b> LOGOUT </b></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
      <h2 class="text-center">Courses<br> <sub><sub>(All Courses)</sub></sub> </h2>
  </div>

    <div class="container">
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-11">
            <table class="table table-bordered"  id="example">
              <thead>
                <tr class="text-center">

                  <th>Course Id</th>
                  <th>Course Code</th>
                  <th>Course Title</th>
                  <th>Course Credit-Hours</th>
                  <th>Course Lab</th>
                  <th>Course Type</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                <?php while ($course=mysqli_fetch_assoc($all_record)) {
                  $id    =$course['course_id'];
                  $code  =$course['course_code'];
                  $title =$course['course_title'];
                  $cr_hr =$course['course_credit_hours'];
                  $lab   =$course['course_lab'];
                  $type  =$course['course_type'];
                ?>
                <tr>

                  <td><?= $id ?></td>
                  <td><?= $code ?></td>
                  <td><?= $title ?></td>
                  <td><?= $cr_hr ?></td>
                  <td><?= $lab ?></td>
                  <td><?= $type ?></td>
                  <td>
                    <a href="course\course_update.php?id=<?= $id ?>" class="btn btn-info" style="float-left;width:48%;">
                      EDIT
                    </a>
                    <a href="course\course_delete.php?id=<?= $id ?>" class="btn btn-danger" style="float-right;width:48%;" onclick="return confirm('Are you sure');">Delete</a>
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
  </body>
</html>


<?php }else {
  redirect("index.php"); //redirect to the login page

} ?>
