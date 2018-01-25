<?php
/**
 * =========================================
 * LOGIN PAGE FOR THE STUDENT
 * =========================================
 * if user exists it will be have access
 * if password is not reseted redirted to resaet password page
 * else to home page
 * 
 * if already loged in then redirect to home page
 * 
 * 
 * 
 */


session_start();

 //check if the user is already loged in
if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=NULL) {

  if ($_SESSION['reset_status']== 1) {  //password rseted or not
    redirect("student_portal.php"); 
    exit();
  } else {
    redirect('user_accounts/student_password_reset.php');
    exit();
  }// end of password rseted or not

} else { //if not loged in
      require_once('sourses/student_login_class.php');

      if (isset($_POST['log_in'])) {

        $user_name = $_POST['email'];
        $password = $_POST['password'];
        $std_lgn_obj1 = new students_logins();

        //checking the login acces
        $result = $std_lgn_obj1->check_login_access($user_name,$password);

        $reset_status = $result['password_reset_status'];
        $_SESSION['reset_status'] = $reset_status; //password reset status
        //if login success
        if ($result!= 0 && $result['student_login_id']>0) {
          $_SESSION['user_id'] = $result['student_id'];
          $_SESSION['user_name'] = $user_name;

          if ($reset_status==0) { //if password in not reseted
            redirect('user_accounts/student_password_reset.php');
          exit();
          } elseif( $reset_status==1 ){
            redirect("student_portal.php");
            exit();
          }

          

        } elseif($result==0) { //if login denied
          echo '<div class="alert alert-danger" style="position:absolute;" role="alert">
                  <strong>Oh snap!</strong> invalid user name or password.
                </div>';
        }
        
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

<!-- form for user login  -->
      <form class="form-signin" method="post" action=""> 
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">User Name</label>
        <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-success btn-block" type="submit" name="log_in">Sign in</button>
      </form>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

<?php }

function redirect($url) { //deffining the redirect function
  ob_start();
  header('Location: '.$url);
  ob_end_flush();
  die();
}

?>