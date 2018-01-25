<?php
require_once 'sourses/student_class.php';
session_start();
if ($_SESSION['perm']=="") { //check if user is login
  redirect("permission/login_user.php"); //redirect to the login page
} else {
  require_once 'permission/dbconnection.php'; //addiing the permission system database connection
  require_once 'permission/permission_checker.php';

}
function redirect($url) { //deffining the redirect function
  ob_start();
  header('Location: '.$url);
  ob_end_flush();
  die();
}

if (permission_chcker("Student Manager@Students@Read")=="true") { //check permission to this module

  $obj=new student_class();
  $dataa=$obj->fetch_active_students_records();

  if (isset($_GET['msg'])) {
    echo '<script type="text/javascript">alert("' . $_GET['msg'] . '")</script>';
  }
?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Students</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/header_css.css"> -->
    <link rel="stylesheet" href="css/master.css">


  </head>
  <body>
  <div class="jumbotron text-primary jmbtrn">
        <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../student_portal.php">Student Portal</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Active Students<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="student/freeze_student.php">Freezed Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="student/student_insertion_form_for_ex.php">Add New Student</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <!-- <button class="btn btn-outline-success my-2 my-sm-0">Search</button> -->
                <a href="user_accounts/student_logout.php" class="btn btn-outline-danger my-2 my-sm-0"> LOGOUT  </a>
                </form>
            </div>
        </nav>
        <p class="text-center display-4">Teacher Evatuation <br> <sub><sub>(Proforma-10)</sub></sub> </p>
        </div>

        <!-- main area -->

    <!-- <div class="jumbotron set_logo">
      <div class="pull-left">
        <a href="index.php"><img src="image/logo.png" alt="GIMS logo" width="180px" height="150px" style="padding-bottom:10px;"></a>
      </div>
      <div class="inner pull-right top_ul">
        <ul class="list-inline list-unstyled top_links">
          <li><a href="index.php">Home</a></li>
          <li><a class="active" href="#"><u>Active Students</u></a></li>
          <li><a href="student/freeze_student.php">Freezed Students</a></li>
          <li><a href="student/student_insertion_form_for_ex.php">Add New Student</a></li>
        </ul>
      </div>
    </div> -->
    <div class="container">
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
          <table id="student_data_table" class="table table-bordered  table-striped table-sm">
            <thead class="bg-success">
              <td>ID</td>
              <td>Arid Roll No</td>
              <td>Class</td>
              <td>Name</td>
              <td>Father Name</td>
              <td>Mobile</td>
              <td>City</td>
              <td>Picture</td>
              <td colspan="3">Action</td>
            </thead>
            <tbody class="bg-faded">
              <?php
              $counter=0;
              while ($row=mysqli_fetch_assoc($dataa)) { $counter++ ?>
                <tr>
                  <td><?php echo $counter; ?></td>
                  <td> <?php echo $row['arid_reg_no']; ?></td>
                  <td> <?php echo $row['class_name']; ?></td>
                  <td> <?php echo ucwords($row['student_first_name']); ?></td>
                  <td> <?php echo ucwords(strtolower($row['parent_name'])); ?></td>
                  <td> <?php echo $row['student_contact_mobile_no']; ?></td>

                  <td> <?php echo ucwords($row['student_contact_city']); ?></td>
                  <td> <img src="student/<?php echo $row['student_picture_path']; ?>"   style="height:75px;width: 75px;"/></td>

                  <td>
                    <?php
                    $id=$row['student_id'];
                    ?>
                    <a href="student/detail_view_update.php?nop=<?php echo $id ?>" class="btn btn-info pull-left btn-sm" style="">Update</a>
                  </td>
                  <td>
                    <?php if (permission_chcker("Student Manager@Students@Delete")=="true") {  ?>
                    <a href="student/delete_record.php?del=<?php echo $id ?>" class="btn btn-sm btn-danger pull-right">Delete</a>
                  <?php } ?>
                  </td>
                  <td>
                    <a href="student/admin_student_action?del=<?php echo urlencode(base64_encode($id)) ?>" class="btn btn-sm btn-primary pull-right">More Action..</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="col-md-1">

        </div>
      </div>
    </div>

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">  </script>

    <script>
        $(document).ready(function() {
          $('#student_data_table').DataTable();
        } );
    </script>
  </body>
  </html>
  <?php }else {
    redirect("index.php"); //redirect to the login page

  } ?>
