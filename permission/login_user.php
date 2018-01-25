<?php
/*
  title: user login page
      also check the permissions of users
*/
require_once 'dbconnection.php'; //database connection

  if (isset($_POST['log_in'])) { //login form submition
    $user_name      =$_POST['email'];
    $user_password  =md5($_POST['password']);

    $login_query    ="SELECT user_id FROM users WHERE user_email='$user_name' AND user_password='$user_password'";
    $user_data      =mysqli_query($GLOBALS['con'],$login_query) or die(mysqli_errno($GLOBALS['con']));

    $user           =mysqli_fetch_assoc($user_data);
    $user_id        =$user['user_id'];

    if($user_id>0){
        $permission_key = "SELECT DISTINCT a1.permission_key
                            FROM module_section_permissions AS a1,
                                  group_permissions AS a2,
                                  user_groups AS a3
                            WHERE a1.module_id=a2.module_id
                            AND a1.section_id=a2.section_id
                            AND a1.permission_id=a2.permission_id
                            AND a2.group_id=a3.group_id
                            AND a3.user_id='$user_id'";

        $keys = mysqli_query($GLOBALS['con'],$permission_key) or die(mysqli_errno($GLOBALS['con']));

        while ($key=mysqli_fetch_assoc($keys)) {
              $permissions[]=$key['permission_key'];
          }
          // print_r($permissions);
           session_start();
          $_SESSION['perm']=$permissions;
          redirect("../index.php");



    } else {
      echo "email and password did'nt match";
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
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title> Signin </title>
    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
     <link href="http://v4-alpha.getbootstrap.com/examples/signin/signin.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="log_in">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


  </body>
</html>
