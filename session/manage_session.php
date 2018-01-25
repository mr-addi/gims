<?php
session_start();
if ($_SESSION['perm']=="") { //check if user is login
  redirect("../permission/login_user.php"); //redirect to the login page
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
  Include '../sourses/db_connection.php';
  Include 'manage_session_class.php';
  $crrunt_year=date('Y');
  $start=2014;


  /**
   *
   */

  //Manage_Session object
  $obj=new Manage_Session();
  //Onloade Call Function to get all session data
  $all_session_data=$obj->fetch_all_session();
  //onsubmit form call Function INSERt data into sessions tables
  if (isset($_POST['submit_session'])) {
    $insertion_status=$obj->insert_session_data();
    if ($insertion_status!=1) {
      echo '<script type="text/javascript">alert("Data already Exist")</script>';
    }
    else {
      header("location:manage_session.php");
    }
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Manage Session</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header_css.css">
  </head>
  <body>
    <div class="jumbotron set_logo">
      <div class="pull-left">
        <a href="../index.php"><img src="../image/logo.png" alt="GIMS logo" width="180px" height="150px" style="padding-bottom:10px;"></a>
      </div>
      <div class="inner pull-right top_ul">
        <ul class="list-inline list-unstyled top_links">
          <li><a href="../index.php">Home</a></li>
          <li><a href="#"><u>Add Session</u></a></li>
          <li><a class="active" href="../session_class.php">Session classes</a></li>
        </ul>
      </div>
    </div>
    <div class="container">
      <form class="form" action="" method="post">
        <div class="row">
          <div class="col-md-2">

          </div>
          <div class="col-md-8">
              <table class="table table-bordered ">
                <thead>
                  <tr>
                    <th class="bg-success" colspan="3"><h3 class="text-center">Enter New Session</h3></th>
                  </tr>
                  <tr>
                    <td>Session Type</td>
                    <td>Session Year</td>
                    <td>Session Timing</td>
                  </tr>
                </thead>
                <tbody class="bg-info">
                  <tr>
                    <td>
                      <select class="form-control" name="select_session">
                        <option value="spring" selected>Spring</option>
                        <option value="fall">Fall</option>
                        <option value="summer">Summer</option>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="select_year">
                          <?php for ($i=2014; $i <= $crrunt_year ; $i++) { ?>
                          <option value="<?php  echo $i; ?>"><?php  echo $i; ?></option>
                      <?php  } ?>
                      </select>
                    </td>
                    <td>
                      <label for="select_timing">Morning</label>
                      <input type="radio" name="select_timing" value="morning" checked>
                      <label for="">Evening</label>
                      <input type="radio" name="select_timing" value="evening" disabled title="There is no Evening Session">
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3" ><input type="submit" class="btn btn-warning-outline pull-right" name="submit_session" value="Save"></td>
                  </tr>
                </tfoot>
              </table>
          </div>
          <div class="col-md-2">

          </div>

        </div>

      </form>
      <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th colspan="5" class="bg-success"><h3 class="text-center">All Sessions</h3></th>
              </tr>
              <tr>
                <td>Sr NO</td>
                <td>Session Type</td>
                <td>Session Year</td>
                <td>Session Timing</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter=0;
                while ($row=mysqli_fetch_assoc($all_session_data)) {
                  $counter++;
                  ?>
                  <tr>
                    <td><?php echo $counter;  ?></td>
                    <td><?php echo ucwords($row['session_type']); ?></td>
                    <td><?php echo $row['session_year']; ?></td>
                    <td><?php echo ucwords($row['session_timming']); ?></td>
                    <td><input class=" btn btn-danger" type="submit" name="btn_delete" value="Delete">
                       <input class=" btn btn-info" type="submit" name="btn_delete" value="Edit"></td>
                  </tr>
              <?php  } ?>
            </tbody>
          </table>
        </div>
        <div class="col-md-2">

        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>

<?php }else {
  redirect("../index.php"); //redirect to the login page

} ?>
