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


    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- data table file library -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
      <!-- custom css  -->
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
            <a class="navbar-brand" href="#">Student</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
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
            <ul class="nav navbar-nav navbar-right ">
            <li><a href="../user_accounts/user_logout.php" class=" btn btn-default red-font"><b> LOGOUT </b></a></li>
                <!-- <li class=""><a href="user_accounts/user_logout.php" class=" btn btn-default red-font">LOGOUT</a></li> -->
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

        <h2 class="text-center">Students<br> <sub><sub>(All active students)</sub></sub> </h2>
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

    <div class=" container">
      <div class="row">
        <div class=" col-md-1" ></div>
        <div class="col-md-10">

          <table id="student_data_table" class="table table-bordered">
            <thead class="bg-success">
              <th>ID</th>
              <th class="text-nowrap" >Arid Roll No</th>
              <th>Class</th>
              <th>Name</th>
              <th>Father Name</th>
              <th>Mobile</th>
              <th>City</th>
              <th>Picture</th>
              <td></td>
              <td></td>
              <td></td>

            </thead>
            <tbody class="bg-faded">
              <?php
              $counter=0;
              while ($row=mysqli_fetch_assoc($dataa)) {
                 $counter++;
              ?>
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
      </div>
    </div>

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">  </script>
    <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> -->

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
