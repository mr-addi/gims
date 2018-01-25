<?php
  //page to show all available users
  session_start();
  if (!isset($_SESSION['perm'])) {
     redirect("login_user.php");
    
  } else {
      require_once 'dbconnection.php';
      require_once 'permission_checker.php';
    print_r(permission_chcker("users@Manage Users@Read"));
    if (permission_chcker("users@Manage Users@Read")!="true") {
      ?>
      <script>
        alert("you dont have permission");
      </script>
      <?php
      redirect("index2.php");
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
<html>
  <head>
    <meta charset="utf-8">
    <title>users</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>
    <div class="jumbotron">
        <h3 class="text-center">USERS</h3>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
          <h1 class="text-center">ALL USERS</h1>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th></th>
                <th>User ID</th>
                <th>User First Name</th>
                <th>User Last Name</th>
                <th>User Discription</th>
                <th>User Module</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $user_query="SELECT * FROM users WHERE user_deleted='0'";
                $result=mysqli_query($GLOBALS['con'],$user_query);
                while ($user=mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <td>
                      <!-- buttons to edit and delete the user data -->
                      <?php
                      $check1=(permission_chcker("users@Manage Users@Delete"));
                       if ($check1=="true"): ?>
                        <a href="delete_user.php?id=<?= $user['user_id'] ?>" class="btn btn-danger " onclick="return confirm('Are you sure?');">DELETE</a>
                      <?php endif;
                        $check2=(permission_chcker("users@Manage Users@Update"));
                       if ($check2=="true"): ?>
                        <a href="create_user_next.php?id=<?=$user['user_id']?>&fn=<?=$user['user_first_name']?>&ln=<?=$user['user_last_name']?>&em=<?=$user['user_email']?>&key=1" class="btn btn-warning">EDIIT</a>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?= $user['user_id'] ?>
                    </td>
                    <td>
                      <?= $user['user_first_name'] ?>
                    </td>
                    <td>
                      <?= $user['user_last_name'] ?>
                    </td>
                    <td>
                      <?= $user['user_email'] ?>
                    </td>
                    <td>
                      <?php
                      $user_ID=$user['user_id'];
                        $group_query="SELECT a1.group_title
                                      FROM groups as a1
                                      JOIN user_groups as a2 ON a1.group_id=a2.group_id
                                      WHERE a2.user_id='$user_ID'";
                        $result1=mysqli_query($GLOBALS['con'],$group_query);
                        /*
                          displaying users groups
                        */
                        while ($group=mysqli_fetch_assoc($result1)) { ?>
                            <tr>
                              <td colspan="6" class="text-right"><?= $group['group_title']?></td>
                            </tr>
                    <?php
                        }
                       ?>
                    </td>

                  </tr>

                  <?php
                }
               ?>
               <?php
                  $check=(permission_chcker("users@Manage Users@Create"));
                 if ($check=="true"): ?>
                <tr>
                  <td colspan="6">
                     <a href="create_user.php" class="btn btn-success form-control">Create User</a>
                  </td>
                </tr>
               <?php endif; ?>

            </tbody>
          </table>
        </div>
      </div>

    </div>
  </body>
</html>
