<?php
/*
page about details of group
*/
session_start();
if ($_SESSION['perm']=="") {
  redirect("login_user.php");
} else {
        require_once 'dbconnection.php';
        require_once 'permission_checker.php';
      print_r(permission_chcker("User Manager@users data@upate"));
    }
    $group_id=$_GET['id'];
    $group_name=$_GET['name'];
    //function for secting sing column
    function single_column_query($column_name,$table_name,$condition_column,$condition_value)
    {
      $query="SELECT $column_name FROM $table_name WHERE $condition_column='$condition_value'";
      $query_exe=mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con']));
      return $query_exe;
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
  <title>Details</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.1.0/octicons.min.css"> -->
  <style media="screen">
  .diff-font{
    font-family: monospace;
  }
  </style>
</head>
<body>
  <div class="jumbotron">
    <h3 class="text-center">Groups</h3>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th></th>
              <th> Group Name </th>
              <th> Modules </th>
              <th> Sections </th>
              <th> Permissions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <!-- edid and delete buttons for groups -->
                <?php
                  $check=permission_chcker("User Manager@groups data@update");
                 // if ($check=="true"): ?>
                 <a href="select_moduels_for_newly_created_group.php?name=<?= strtoupper($group_name) ?>&desc=<?= $group_id?>" class="btn btn-primary">Edit</a>
                <?php //endif; ?>
                <?php
                $check1=permission_chcker("User Manager@groups data@Delete");
                // if ($check1=="true"): ?>
                    <a href="delete_group.php?id=<?= $group_id?>" class="btn btn-danger">Delete</a>
                <?php //endif; ?>

              </td>
              <td><?= strtoupper($group_name) #displaying the group name ?></td>
              <td>
                <?php
                $query="SELECT module_id FROM group_permissions WHERE group_id='$group_id' GROUP BY module_id";
                $modules=mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con'])); //selecting the module__id of the specific group

                while ($module=mysqli_fetch_assoc($modules)) {
                  $modul_id=$module['module_id'];
                  $select_exe = single_column_query("module_title","modules","module_id",$modul_id); //call to single_column_query function
                  $module_name=mysqli_fetch_assoc($select_exe);//getting the module title
                  ?>

                  <tr>
                    <td colspan="3" class="text-right">
                      <strong>
                        <?= strtoupper($module_name['module_title'])?>
                      </strong>
                    </td>

                    <?php
                    $query1="SELECT section_id FROM group_permissions WHERE group_id='$group_id' AND module_id='$modul_id' GROUP BY section_id";
                    $sections=mysqli_query($GLOBALS['con'],$query1) or die(mysqli_error($GLOBALS['con'])); //getting the section-id from for specific group and module
                    while ($section=mysqli_fetch_assoc($sections)) {
                      $section_id=$section['section_id'];
                      $select_exe1 = single_column_query("section_title","sections","section_id",$section_id);
                      $section_name=mysqli_fetch_assoc($select_exe1); //section title slection
                      ?>

                      <tr>
                        <td colspan="4" class="text-right">
                          <em>
                            <?= ucwords($section_name['section_title'])?>
                          </em>
                        </td>
                      </tr>

                      <?php
                      $query2="SELECT permission_id FROM group_permissions WHERE group_id='$group_id' AND module_id='$modul_id' AND section_id='$section_id' GROUP BY permission_id";
                      $permis=mysqli_query($GLOBALS['con'],$query2) or die(mysqli_error($GLOBALS['con'])); //perrmission id selection
                      while ($perm=mysqli_fetch_assoc($permis)) {;
                        $permission_id=$perm['permission_id'];
                        $select_exe2=$select_exe1 = single_column_query("permission_title","permissions","permission_id",$permission_id);
                        $perm_name=mysqli_fetch_assoc($select_exe2); //permission title selection
                        ?>

                        <tr>
                          <td colspan="5" class="text-right" class="diff-font">
                            <?= $perm_name['permission_title'] ?>
                          </td>
                        </tr>
                      </tr>

                      <?php
                    }
                  }
                }
                ?>

              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
</body>
</html>
