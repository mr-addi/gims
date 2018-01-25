<?php
/*
# on this page the user can create new groups
*/
?>
<?php
// this page is about permissions,
// only the developer can add the new permission
// the basic permissions are 'create' , 'read' , 'update' , 'delete'

//file included for database connection
require_once('dbconnection.php');
require_once('modules.php');

//getting group data from form
  if(isset($_POST['group_sumbit'])){
    $group_name=mysqli_real_escape_string($GLOBALS['con'],$_POST['group_name']);
    $group_desc=mysqli_real_escape_string($GLOBALS['con'],$_POST['group_description']);
    $url="select_moduels_for_newly_created_group.php?name=".urlencode($group_name)."&desc=".$group_desc;
    redirect($url);
    echo $group_name."<br>".$group_desc;
  }
  function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>New groups</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous"> -->
  <style media="screen">
    .module_table{
      min-height: 500px !important;
    }
  </style>
</head>
<body>
  <div class="jumbotron text-center">
    <h3 class="text-center">Groups</h3>
  </div>
  <div class="col-md-2 col-sm-1">  </div><!-- div for left side spacing -->
  <div class="col-md-9 col-sm-10">
    <!-- form for group submition -->
    <form method="post" action="">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Group Name</th>
            <th>Group Discription</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <td colspan="2">

                <input type="submit" name="group_sumbit" value="NEXT" class="btn btn-primary"> <!-- button for form submittion -->

            </td>
          </tr>
        </tfoot>
        <tbody>
          <tr>
            <td>
              <!-- input feild for group_name -->
              <input type="text" name="group_name" class="form-control" required autofocus placeholder="Group Name Here">
            </td>
            <td>
              <!-- text area for group description -->
              <textarea name="group_description" rows="5" class="form-control" required placeholder="group discription"></textarea>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <!--
        Ending of form only group submittion
        starting of form module slection for the newly created group
    -->
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script> -->
</body>
</html>
