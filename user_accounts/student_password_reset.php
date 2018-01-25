<?php 
session_start();

//if user is logged in
if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=NULL) {

    if ($_SESSION['reset_status']==0) {

        if (isset($_POST['rest_pass'])) {
            //both passwords are not empty
            if($_POST['password']!="" && $_POST['re_password']!=""){

                //passwords are same
                if ($_POST['password']==$_POST['re_password']) {
                    // print_r($_POST);
                    $user_name = $_SESSION['user_name'];
                    $password  = $_POST['re_password'];

                    require_once('../sourses/student_login_class.php');
                    $std_lgn_obj1=new students_logins();

                    $result=$std_lgn_obj1->reset_login_password($user_name,$password);
                    if ($result) {
                        redirect("../student_portal.php");
                        
                    }
                } else{
                    echo '<div class="alert alert-danger" style="position:absolute;" role="alert">
                    <strong>Oh snap!</strong> Password did not match / enter same and try submitting again.
                </div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Change a few things up and try submitting again.
                </div>';
            }
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
    
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/normalize.css">
</head>
<body>
    <div class="jumbotron" >
        <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">GIMS</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0"> -->
                <a class="btn btn-outline-danger my-2 my-sm-0" href="student_logout.php">Logout</a>
                <!-- </form> -->
            </div>
        </nav>
        <h2 class="display-3 text-center" >Reset Password</h2>
    </div>
    <div class="container">
    <div class=" row " >
        <div class="col-2"></div>
            <div class="col-8" >

            
                <form class="form-signin" method="post" action="">
                    <table class="table" >
                        <tr>
                            <td>
                                <h5>User :</h5>
                            </td>
                            <td>
                                <h4><?= $_SESSION['user_name'] ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Enter New Password:</h5>
                            </td>
                            <td>
                            <label for="inputPassword" class="sr-only">New Password</label>
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                            
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Retype Password:</h5>
                            </td>
                            <td>
                            <label for="inputPassword" class="sr-only">Retype New Password</label>
                            <input type="password" name="re_password" id="reinputPassword" class="form-control" placeholder="Password" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-lg btn-success btn-block" type="submit" name="rest_pass">Reset Password</button>
                            </td>
                        </tr>
                    </table>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
     } else {//if user loged in and passsword is reseted
          
        redirect("../student_portal.php");
      }
    }else { //if user is not logrd in
        redirect('../student_login.php');
    }

      function redirect($url) { //deffining the redirect function
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
      }
      
?>