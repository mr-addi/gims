<?php
// this page is about permissions,
// only the developer can add the new permission
// the basic permissions are 'create' , 'read' , 'update' , 'delete'

//file included for database connection
require_once('dbconnection.php');
/*
including a class of permissions
*/
require_once('permissions.php');

if(isset($_POST['submit1'])){
  $per_name = $_POST['per_title'];
  $per_desc = $_POST['per_description'];
  echo "string <br>";
  $obj = new permissions();
  $obj->add_permission($per_name,$per_desc);
}

mysqli_close($GLOBALS['con']);//closing off connection
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Permissions</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
</head>
<body>
  <div class="jumbotron ">
    <img src="image/test.png" alt="page logo" />
    <h3 class="text-primary text-center">Permissions</h3>
  </div>
  <div class="col-md-2 col-sm-1">

  </div>
  <div class="col-md-8 col-sm-10">
    <caption><h1>Current Permissions</h1></caption>
    <table class="table table-bordered">
      <thead>
        <th>Permission id</th>
        <th>Permission Title</th>
        <th>Permission Description</th>
      </thead>
      <tbody>
        <?php
        $all_permission = new permissions();
        $all_permissions=$all_permission->get_all_permissions();
        while ($row=mysqli_fetch_assoc($all_permissions)) { ?>
          <tr>
            <td><?php echo $row['permission_id']; ?></td>
            <td><?php echo $row['permission_title']; ?></td>
            <td><?php echo $row['permission_description']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <br>

    <form method="post" action="">
      <caption><h1>Add New Permissions</h1></caption>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th><h3>PERMISSION TITLE</h3></th>
            <th><h3>PERMISSION DESCRIPTION</h3></th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><input type="text" name="per_title" class="form-control" maxlength="48" required></td>
            <td><textarea name="per_description" rows="5" cols="60" class="form-control" required></textarea></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"><input type="submit" name="submit1" value="INSERT PERMISSION" class="btn btn-success"></td>
          </tr>
        </tfoot>
      </table>
    </form>
  </div>
  <script>

  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>
</html>
