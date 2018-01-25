<?php
/*
  page to show all the available groups
*/
  session_start();
  if ($_SESSION['perm']=="") {
    redirect("login_user.php");
  } else {
      require_once 'dbconnection.php';
      require_once 'permission_checker.php';
    print_r(permission_chcker("User Manager@users data@upate"));
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Groups </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

  </head>
  <body>
    <div class="jumbotron">
      <h2 class="text-center">GROUPS</h2>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <h3>List of all groups</h3>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th></th>
                <th>Group ID</th>
                <th>Group Name</th>
                <th>Group Discription</th>
              </tr>
            </thead>

            <?php
              $check=permission_chcker("User Manager@groups data@Create");
            //  if ($check=="true"): ?>
             <tfoot>
               <td colspan="4">
                   <a href="create_groups.php" class="btn btn-large btn-block btn-success">ADD ANOTHER GROUP</a>
               </td>
             </tfoot>
            <?php //endif; ?>

            <tbody>
              <?php
                $select_groups="SELECT * FROM groups WHERE group_deleted=0";
                $select_groups_exe=mysqli_query($GLOBALS['con'],$select_groups) or die(mysqli_error($GLOBALS['con']));
                while ($group=mysqli_fetch_assoc($select_groups_exe)) {  ?>
                  <!-- displaying all the groups -->
                    <tr>
                      <td><a href="group_details.php?id=<?= $group['group_id']?>&name=<?= $group['group_title']?>"  class="btn btn-primary">Details</a></td>
                      <td><?= $group['group_id']?></td>
                      <td><?= $group['group_title']?></td>
                      <td><?= $group['group_description']?></td>
                    </tr>

              <?php }
              ?>
            </tbody>
          </table>
        </div>
      </div>



    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
  </body>
</html>
