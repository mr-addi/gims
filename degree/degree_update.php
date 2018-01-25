<?php

require_once '..\sourses\degree_class.php';
$id=$_GET['id'];
$title=$_GET['name'];
$subject=$_GET['subject'];
if (isset($_POST['submit_deg'])) {
    $deg_title=mysqli_real_escape_string($GLOBALS['con'],$_POST['deg_title']);
    $deg_subj=mysqli_real_escape_string($GLOBALS['con'],$_POST['deg_subject']);
    $deg_obj=new degree();
    $deg_obj->update_degree($id,$deg_title,$deg_subj);
}
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
    <link rel="stylesheet" href="../css/master.css">
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
                  <a class="nav-link" href="../index.php">Home</a>
              </li>
              
              <li class="nav-item active">
                  <a class="nav-link" href="../degrees_page.php">All Degrees</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="degree/add_new_degrees.php">Add New Degree</a>
              </li>
              </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="user_accounts/user_logout.php" class=" btn btn-default red-font"><b> LOGOUT </b></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
      <h2 class="text-center">Degrees<br> <sub><sub>(Update)</sub></sub> </h2>
  </div>

    <div class="container">
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
          <form method="post" action="">
            <table class="table table-bordered">
                <tr>
                  <th class="text-left">Degree Title:</th>
                  <td><input type="text" name="deg_title" class="form-control" value="<?= $title ?>" required></td>
                </tr>
                <tr>
                  <th class="text-left">Degree Title:</th>
                  <td><input type="text" name="deg_subject" class="form-control" value="<?= $subject ?>" required></td>
                </tr>
                <tr>
                  <td colspan="2"><input type="submit" name="submit_deg" value="UPDATE" class="btn btn-success pull-right"></td>
                </tr>
        </div>
        <div class="col-md-1">

        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="..\js\bootstrap.min.js"></script>
  </body>
</html>
