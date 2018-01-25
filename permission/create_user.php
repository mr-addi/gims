<?php
/*
titile:  User creation form

*/
require_once 'dbconnection.php';

if(isset($_POST['submit_btn'])){
  //collecting data from form
  $first_name=mysqli_real_escape_string($GLOBALS['con'],$_POST['first_name']);
  $last_name=mysqli_real_escape_string($GLOBALS['con'],$_POST['last_name']);
  $email=mysqli_real_escape_string($GLOBALS['con'],$_POST['email']);
  $pasword=$_POST['password'];
  $url="create_user_next.php?fn=".urlencode($first_name)."&ln=".urlencode($last_name)."&em=".urlencode($email)."&ps=".$first_name."&key=0";
  redirect($url); //rediricting to create_user_next.php with all data
}

function redirect($url) {
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
  <title>Create User</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
  <div class="jumbotron">
    <h3 class="text-center">Users</h3>
  </div>
  <div class="container">
    <div class="row" id="first_div">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
        <h1 class="bg-primary text-center"> CREATE USER</h1>
        <form method="post" action="" id="contactForm">
          <table class="table">
            <tr>
              <th class="text-right"> User First Name : </th>
              <td>
                <input type="text" name="first_name" class="form-control" autofocus required>
              </td>
            </tr>
            <tr>
              <th class="text-right"> User Last Name : </th>
              <td>
                <input type="text" name="last_name" class="form-control" required>
              </td>
            </tr>
            <tr>
              <th class="text-right"> User E-mail : </th>
              <td>
                <input type="email" name="email" class="form-control" required>
              </td>
            </tr>
            <tr>
              <th class="text-right"> Password : </th>
              <td>
                <input type="password" name="password" class="form-control" required>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" id="next_btn" name="submit_btn" value="NEXT>" class="btn btn-primary form-control"></td>
              </tr>
            </table>
          </form>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
  </html>
