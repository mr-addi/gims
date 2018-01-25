<?php
session_start();
if ($_SESSION['perm']=="") { //check if user is login
  redirect("permission/login_user.php"); //redirect to the login page
} else {
        require_once 'permission/dbconnection.php'; //addiing the permission system database connection
        require_once 'permission/module_manager.php';//Getting the available modilules;
        $_SESSION['module_names']=permission_checker();

    }


    function redirect($url) { //deffining the redirect function
      ob_start();
      header('Location: '.$url);
      ob_end_flush();
      die();
    }
if (array_search("Teacher Manager",$_SESSION['module_names'])){
?>

<?php
  /*
    #title : teacher basic information CRUD
  */

  require_once 'sourses/teachers_class.php';//including the teachers class
  $cls_obj=new teacher();//object of the teacher
  $results=$cls_obj->display_all_teachers_basic(); //getting the basic info of teacheer to show

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teachers</title>
  <!-- including the bootstrap,  git bootstrap ,/dataTables.bootstrap.min.css  -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="  https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="css/header_css.css">

</head>
<body>
  <!-- body start -->
  <div class="jumbotron set_logo">
    <div class="pull-left">
      <a href="index.php"><img src="image/logo.png" alt="GIMS logo" width="180px" height="150px" style="padding-bottom:10px;"></a>
    </div>
    <div class="inner pull-right top_ul">
      <ul class="list-inline list-unstyled top_links">
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="#"><u>Teacher Management</u></a></li>
        <li><a href="teacher\add_teacher.php">Add Teacher</a></li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-1">

      </div>
      <div class="col-md-10">
        <h1 class="bg-success">All Teachers in the University</h1>
        <!-- table to show record -->
        <table class="table table-bordered" id="example">
          <thead>
            <th>ID</th>
            <th>Employee Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Designation</th>
            <th>Mobile no</th>
            <th>Email</th>
            <th>Bank Account no</th>
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

          </tfoot>
          <tbody>
            <?php
             while ($result=mysqli_fetch_assoc($results)) {
                ?>
                  <tr>
                    <td><?= $result['teacher_id'] ?></td>
                    <td><?=  $result['teacher_CNIC'] ?></td>
                    <td><?= ucwords($result['teacher_first_name']) ?></td>
                    <td><?= ucwords($result['teacher_last_name']) ?></td>
                    <td><?= ucwords($result['teacher_designation']) ?></td>
                    <td><?= $result['teacher_contact_mobile_no'] ?></td>
                    <td><?= $result['teacher_contact_email'] ?></td>
                    <td><?= $result['account_no'] ?></td>
                    <td>
                      <a href="#" class="btn btn-warning" >Update</a>
                      <a href="teacher/delete_teacher.php?emp_id=<?= $result['teacher_id'] ?>" class="btn btn-danger">Delete</a>
                      </td>
                  </tr>
                <?php
            } ?>
          </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() { //calling the datable function
            $('#example').DataTable();
          } );
    </script>
  </body>
  </html>
<?php }else {
  redirect("index.php"); //redirect to the login page

} ?>
