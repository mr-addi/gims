<?php
require_once 'sourses/db_connection.php';
require_once 'session/manage_session_class.php';
require_once 'sourses/classes_class.php';
$sesion_obj=new Manage_Session();
$res_sess=$sesion_obj->fetch_all_session();
$clas_obj=new classes();
$class_data=$clas_obj->get_all_classes_data();
if (isset($_POST['submit'])) {
  $session_id=$_POST['sessio_id'];
  // mysqli_query($GLOBALS['con'],"DELETE FROM `session_classes` WHERE `session_id`='$session_id'") or die(mysqli_error($GLOBALS['con']));
  $clas_id=$_POST['clas_id'];
  foreach ($clas_id as $key => $value) {

    $ins_query="INSERT INTO `session_classes`(`session_id`, `class_id`) VALUES ('$session_id','$value')";
    $exe_ins= mysqli_query($GLOBALS['con'],$ins_query) or die(mysqli_error($GLOBALS['con']));
  }
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Session Class</title>
<style media="screen">
  *{

  }
</style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  </head>
  <body>
    <div class="jumbotron">
        <h3 class="text-center">Session Classes</h3>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
          <form class="" action="" method="post">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Select Session</th>
                <th>Select Classes</th>
              </tr>
            </thead>
            <tfoot>
              <td colspan="2">
                <input type="submit" name="submit" value="Submit Record" class="btn btn-success" />
              </td>
            </tfoot>
            <tbody>
              <tr>
                <td>
                  <select class="form-control" name="sessio_id">
                    <?php
                    while ($sessions=mysqli_fetch_assoc($res_sess)) {
                      ?>
                        <option value="<?= $sessions['session_id'] ?>"><?= $sessions['session_type'] ?>-<?= $sessions['session_year'] ?></option>
                      <?php
                    } ?>
                  </select>
                </td>
                <td >
                  <div style="height:300px;overflow: scroll;">
                    <?php
                    while ($classes=mysqli_fetch_assoc($class_data)) {
                      ?>
                      <label for="<?= $classes['class_name'] ?>" class="form-control">
                        <input type="checkbox" name="clas_id[<?= $classes['class_id'] ?>]" value="<?= $classes['class_id'] ?>">
                        <?= $classes['class_name'] ?></label>
                        <?php
                    } ?>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
