<?php
session_start();
if ($_SESSION['perm']=="") {
  redirect("login_user.php");
} else {
    $modue_name=$_GET['name'];
    echo "$modue_name";
    require_once 'dbconnection.php';
    require_once 'section_manager.php';
      $sections = permission_checker($modue_name);
}
function redirect($url) { //deffining the redirect function
  ob_start();
  header('Location: '.$url);
  ob_end_flush();
  die();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>manage users</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

  </head>
  <body>

    <div class="">

    </div>
    <div class="jumbotron">

    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-3 bg-inverse">
          <?php
          echo $sections;
           ?>
        </div>
        <div class="col-md-10">

        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
