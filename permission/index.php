<?php
// if ($_SESSION['perm']=="") {
//   redirect("login_user.php");
//
// }
// require_once 'permission_manager.php';
//   echo "<pre>";
//   print_r(  $_SESSION['perm']);
//   echo "</pre>";
//
//   function redirect($url) { //deffining the redirect function
//     ob_start();
//     header('Location: '.$url);
//     ob_end_flush();
//     die();
//   }
//


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>IndexPage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <h2 class="text-center text-primary">This is index Page</h2>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">Users</div>
          <div class="panel-body"><a class="text-center" href="users.php">Manage Users</a></div>
          <div class="panel-footer"></div>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading text-center">Groups</div>
          <div class="panel-body"><a href="groups_page.php">Manage Groups</a></div>
          <div class="panel-footer"></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">Modules Section</div>
          <div class="panel-body"><a href="add_module_section.php">Manage Module and Section</a></div>
          <div class="panel-footer"></div>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading text-center">Permissions</div>
          <div class="panel-body"><a href="manage_permissions.php">Manage Permissions</a></div>
          <div class="panel-footer"></div>
        </div>
      </div>
      <div class="col-md-3">
      </div>
    </div>
  </div>
</div>

</body>
</html>
