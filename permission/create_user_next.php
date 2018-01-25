<?php
// this is used to choose the groups for newly created user and
// also use to update the users data
require_once 'dbconnection.php'; //including the database connection
$key=$_GET['key']; //getting the query string key value to check the update or create
//receiving user data by query string
$first_name=mysqli_real_escape_string($GLOBALS['con'],$_GET['fn']);
$last_name=mysqli_real_escape_string($GLOBALS['con'],$_GET['ln']);
$email=mysqli_real_escape_string($GLOBALS['con'],$_GET['em']);
if($_GET['key']==0){ //check for update or create
  $password=md5($_GET['ps']);
}

if(isset($_POST['done_btn'])) { // create new user submit

  $insert_into_users="INSERT INTO users(user_email, user_password, user_first_name, user_last_name)
  VALUES ('$email','$password','$first_name','$last_name')"; //insert int useers table_name
  mysqli_query($GLOBALS['con'],$insert_into_users) or die(mysqli_error($GLOBALS['con']));
  $u_id=mysqli_insert_id($GLOBALS['con']); //getting the newly inserted id
  $groups=$_POST['group'];
  foreach ($groups as $key => $value) { //insertion in user_groups table
    $inser_into_ug="INSERT INTO user_groups(user_id, group_id) VALUES ('$u_id','$value')";
    mysqli_query($GLOBALS['con'],$inser_into_ug) or die(mysqli_error($GLOBALS['con']));
  }
  redirect("users.php"); //calling the redirct function

}
if (isset($_POST['edit_btn'])) { //checking the update submit

  /*
  getting the data from update form
  */
  $first_name=mysqli_real_escape_string($GLOBALS['con'],$_POST['first_name']);
  $last_name=mysqli_real_escape_string($GLOBALS['con'],$_POST['last_name']);
  $email=mysqli_real_escape_string($GLOBALS['con'],$_POST['email']);
  $pasword=md5($_POST['password']);
  $user_id=$_GET['id']; //query string value
  $update_query="UPDATE users SET user_email='$email',user_password='$pasword',user_first_name='$first_name',user_last_name='$last_name',user_deleted='0'
  WHERE user_id='$user_id'";// update user data
  mysqli_query($GLOBALS['con'],$update_query) or die(mysqli_error($GLOBALS['con']));
  $query="DELETE FROM user_groups WHERE user_id='$user_id'";
  mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con'])); //deleting the old record from user_groups
  $groups=$_POST['group'];
  foreach ($groups as $key => $value) {
    $inser_into_ug="INSERT INTO user_groups(user_id, group_id) VALUES ('$user_id','$value')";
    mysqli_query($GLOBALS['con'],$inser_into_ug) or die(mysqli_error($GLOBALS['con'])); //inserting the new record in user_groups
  }
  redirect("users.php");//calling the redirct function
  exit;
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
  <title>Create Users</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

</head>
<body>
  <!-- header for page -->
  <div class="jumbotron">
    <h3 class="text-center">USER</h3>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-2">

      </div>
      <div class="col-md-8">
        <h1 class="bg-primary text-center">SELECT GROUPS</h1>
        <form action="" method="post">
          <table class="table">
            <tr>
              <th class="text-right" style="width:50%"> User First Name : </th>
              <td>
                <?php if ($key==0){ //check for update or create ?>
                  <?= $first_name ?>
                <?php } else { ?>
                  <input type="text" name="first_name" class="form-control" required value="<?= $first_name ?>">
                <?php } ?>


              </td>
            </tr>
            <tr>
              <th class="text-right"> User Last Name : </th>
              <td>
                <?php if ($key==0){ //check for update or create ?>
                  <?= $last_name ?>
                <?php } else { ?>
                  <input type="text" name="last_name" class="form-control" required value="<?= $last_name ?>">
                <?php } ?>


              </td>
            </tr>
            <tr>
              <th class="text-right"> User E-mail : </th>
              <td>
                <?php if ($key==0){ //check for update or create ?>
                  <?= $email ?>
                <?php } else { ?>
                  <input type="email" name="email" class="form-control" required value="<?= $email ?>">
                <?php } ?>
              </td>
            </tr>
            <?php if ($key!=0){ //check for update or create ?>
              <tr>
                <th class="text-right">
                  Password :
                </th>
                <td>
                  <input type="password" name="password" class="form-control" required value="">
                </td>
              </tr>

            <?php }?>

            <tr>
              <td>
                <h3>SELECT GROUPS</h3>
              </td>
              <td class="text-left">
                <?php
                $query="SELECT group_id,group_title FROM groups WHERE group_deleted='0'";
                $result=mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con']));
                //displaying the user's groups
                while ($group=mysqli_fetch_assoc($result)) { ?>
                  <label for="group[<?= $group['group_id']?>]">
                    <input type="checkbox" name="group[<?= $group['group_id']?>]" value="<?= $group['group_id']?>">
                    <?= $group['group_title']?>
                  </label><br>
                <?php } ?>
              </td>
            </tr>
            <tr>

              <td>
                <?php
                if($key==0) { //check for update or create ?>
                  <a href="create_user.php" class="btn btn-warning form-control">&lt; BACK</a>
                <?php  } else { ?>
                  <a href="users.php" class="btn btn-warning form-control">&lt; BACK</a>
                <?php  }
                ?>

              </td>
              <td>
                <?php
                if($key==0) { //check for update or create ?>
                  <input type="submit" name="done_btn" value="SUBMIT" class="btn btn-primary form-control" >
                <?php  } else { ?>
                  <input type="submit" name="edit_btn" value="Update" class="btn btn-warning form-control" >
                <?php  }
                ?>

              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
