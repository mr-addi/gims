<?php
/**
 * ===================================
 * select the session for the evaluation
 * ===================================
 * 
 */


session_start();
if ($_SESSION['perm']=="") { //check if user is login
  redirect("permission/login_user.php"); //redirect to the login page
} else {
        require_once '../permission/dbconnection.php'; //addiing the permission system database connection
        require_once '../permission/module_manager.php';//Getting the available modilules;
        require_once '../permission/section_manager.php';//Getting the available modilules;section_manager
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
 if (array_search("Sessions",$sections)){ //check permission to this module
// print_r($sections);
?>


<?php

  Include 'manage_session_class.php';
  $session_obj= new Manage_Session();
  $session_result=$session_obj->fetch_all_session();
  if (isset($_POST['sess_chng'])) {
    // print_r($_POST);
    // die;
  $session_obj->set_eval_session($_POST['eval_session']);
}
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sessions</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="  https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> -->
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
          <a class="navbar-brand" href="#">Sessions</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item ">
                  <a class="nav-link" href="manage_session.php">Session</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../session_class.php">Session classes</a>
              </li>
              
              <li class="nav-item active">
                  <a class="nav-link" href="#">Evaluation Session</a>
              </li>
              </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="user_accounts/user_logout.php" class=" btn btn-danger-outline">logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
      <h2 class="text-center">Evaluation Session<br> <sub><sub>(Select Evalution Current Session)</sub></sub> </h2>
  </div>
    <!-- <pre> -->

    
     
    <!-- </pre> -->
    <!-- [session_id] => 4
    [session_type] => spring
    [session_year] => 2016
    [session_timming] => morning
    [crrunt_session] => 0
    [eval_status] => 0 -->
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
        <table class="table table-bordered">
        <tr>
        <th>
            <h3>
                Select Evaluation Session
            </h3>
        </th>
        <td>
        <form action="" method="post">
        <select name="eval_session" class="form-control">
        <option value="">select Evaluation Session</option>

                <?php
                $eval_sess="";
                $crrunt_session="";
                    while ($data_sess= mysqli_fetch_assoc($session_result) ) {
                        if ($data_sess['eval_status']==1) {
                            $eval_sess=$data_sess['session_type']." ( ".$data_sess['session_year'] ."  ) - ".$data_sess['session_timming'];
                        }
                        if ($data_sess['crrunt_session']==1) {
                            $crrunt_session=$data_sess['session_type']." ( ".$data_sess['session_year'] ."  ) - ".$data_sess['session_timming'];
                        }
                    ?>
                        <option value="<?= $data_sess['session_id'] ?> ">
                        <?= $data_sess['session_type'] ?> 
                        ( <?= $data_sess['session_year'] ?> )
                        - <?= $data_sess['session_timming'] ?>
                        
                        
                        </option>
                    <?php   
                    }
                ?>
            </select>
            <br>
            <input type="submit" value="Change Session" name="sess_chng" class="btn btn-success form-control">
            </form>
            </td>
        </tr>
        <tr>
            <th><h3>Current Session</h3></th>
            <td>
                <?= $crrunt_session ?> 
            </td>
        </tr>
        <tr>
            <th><h3>Evaluation Session</h3></th>
            <td>
                <?= $eval_sess ?> 
            </td>
        </tr>
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
