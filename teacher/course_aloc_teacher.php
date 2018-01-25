
<?php
if (isset($_GET['msg'])) { ##show the recieved message
    echo "<script> alert('".$_GET['msg']."'); </script>";
}
require_once '../sourses/teachers_class.php';//including the teachers class
$teach_obj=new teacher();//object of the teacher
$results=$teach_obj->display_all_teachers_basic(); //getting the basic info of teacheer to show
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Alocation</title>
<!-- bootstrap  -->
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- data table file library -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="../css/master.css">

  </head>
  <body>

    <div class="jumbotron jmbtrn"> <!-- div for navbar -->
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
            <a class="navbar-brand" href="#">Teacher</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="../index.php">Home</a></li>
              <li> <a href="../teachers_page.php">All Teacher</a> </li>
              
              <li class="active"><a href="#">Teacher Course Management <span class="sr-only">(current)</span></a></li>

              <li> <a href="add_teacher.php">Add New Teacher</a> </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li><a href="../user_accounts/user_logout.php" class=" btn btn-danger-outline">logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
      <h2 class="text-center">Teacher Courses Allocation</h2>
    </div>

    <div class="container">
      <div class="col-md-2">

      </div>
      <div class="col-md-8">
        <table class="table table-bordered" id="show_teachers">
          <thead>
            <th>ID</th>
            <th>Employee Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th></th>
            <!-- [teacher_CNIC] => 1212
            [teacher_first_name] => adsd
            [teacher_last_name] => sdasds
            [teacher_designation] => hid
            [teacher_contact_mobile_no] => 3338405819
            [teacher_contact_email] => a@b.c
            [account_no] => 21323 -->
          </thead>
          <tfoot>
            <td colspan="5"> <a href="add_teacher.php" class="btn btn-success form-control" >Add New Teacher</a> </td>
          </tfoot>
          <tbody>
            <?php
             while ($result=mysqli_fetch_assoc($results)) {
                ?>
                  <tr>
                    <td><?= $result['teacher_id'] ?></td>
                    <td><?= $result['teacher_CNIC'] ?></td>
                    <td><?= $result['teacher_first_name'] ?></td>
                    <td><?= $result['teacher_last_name'] ?></td>
                    <td><a href="select_crs_aloc_teach.php?tech_id=<?= $result['teacher_id'] ?>& tech_fname=<?= $result['teacher_first_name'] ?>& tech_lname=<?= $result['teacher_last_name'] ?>" class="btn btn-success">Allocate Courses</a>
                    <a href="courses_teacher.php?tech_id=<?= $result['teacher_id'] ?>& tech_fname=<?= $result['teacher_first_name'] ?>& tech_lname=<?= $result['teacher_last_name'] ?>" class="btn btn-success">View Courses</a></td>
                  </tr>
                <?php
            } ?>
          </tbody>
          </table>
      </div>

    </div>




    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() { //calling the datable function
            $('#show_teachers').DataTable();
          } );
    </script>
  </body>
</html>
