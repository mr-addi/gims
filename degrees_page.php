<?php
/**
 * ===================================
 * complete degrees record page
 * ===================================
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
 if (array_search("Degrees",$sections)){ //check permission to this module

?>


<?php
require_once 'sourses\degree_class.php';
$deg_obj=new degree();
$all_record=$deg_obj->get_all_degrees_record();
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Degrees</title>
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
          <a class="navbar-brand" href="#">Degrees</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
              </li>
              
              <li class="nav-item active">
                  <a class="nav-link" href="#">All Degrees</a>
              </li>
              <li class="nav-item ">
                  <a class="nav-link" href="degree/add_new_degrees.php">Add New Degree</a>
              </li>
              </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="user_accounts/user_logout.php" class=" btn btn-default red-font"><b> LOGOUT </b></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
      <h2 class="text-center">Degrees<br> <sub><sub>(All The Degrees)</sub></sub> </h2>
  </div>
    <div class="container ">
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
          <table class="table table-bordered">
            <tr class="bg-success">
              <th colspan="4" class="text-center" ><h3>All Degrees offered by University</h3></th>
            </tr>
          </table>
            <table class="table table-bordered"  id="example">
              <thead>

                <tr class="text-center">

                  <th>Degree Subject</th>
                  <th>Degree Id</th>
                  <th>Degree Title</th>
                  <th>Actions</th>

                </tr>
              </thead>

              <tbody>
                <?php while ($degree=mysqli_fetch_assoc($all_record)) {
                  $id     =$degree['degree_id'];
                  $title  =$degree['degree_name'];
                  $subject=$degree['degree_subject_name'];
                ?>
                <tr>

                  <td><?= $id ?></td>
                  <td><?= $title ?></td>
                  <td><?= $subject ?></td>
                  <td>
                    <a href="degree\degree_update.php?id=<?= $id ?>&name=<?= $title ?>&subject=<?= $subject ?>" class="btn btn-info">
                      EDIT
                    </a>
                    <a href="degree\degree_delete.php?id=<?= $id ?>" class="btn btn-danger" onclick="return confirm('Are you sure');">Delete</a>
                  </td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
        </div>
        <div class="col-md-1">

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
