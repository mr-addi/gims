<?php

session_start();
if ($_SESSION['perm']=="") {
  redirect("login_user.php");
} else {
    require_once 'dbconnection.php';
    require_once 'module_manager.php';
    $modules="";
    $select_modules="SELECT module_id , module_title FROM modules WHERE module_deleted=0";
    $result_modules=mysqli_query($GLOBALS['con'],$select_modules) or die(mysqli_error($GLOBALS['con']));
    if (mysqli_num_rows($result_modules)>0) {
      $modules = permission_checker();
    }
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
    <title>INDEX</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
  </head>
  <body>
    <div class="jumbotron">
      <h3 class="text-center">USERS INDEX</h3>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-3 bg-inverse">

            <?php
              echo $modules;
             ?>
        </div>
      </div>

    </div>

<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
  </body>
</html>
