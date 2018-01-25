<?php
// session_start();
// if ($_SESSION['perm']=="") { //check if user is login
//   redirect("permission/login_user.php"); //redirect to the login page
// } else {
//         require_once 'permission/dbconnection.php'; //addiing the permission system database connection
//         require_once 'permission/module_manager.php';//Getting the available modilules;
//         require_once 'permission/section_manager.php';//Getting the available modilules;section_manager
//         $_SESSION['module_names']=permission_checker(); //get all the module names permitted
//
//     }
//     function redirect($url) { //deffining the redirect function
//       ob_start();
//       header('Location: '.$url);
//       ob_end_flush();
//       die();
//     }

?>
<?php
// if (array_search("Academics",$_SESSION['module_names'])){ //check permission to this module
// $sections=section_checker("Academics");

?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title></title>

      <!-- Bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    </head>
    <body>

      <nav class="navbar navbar-default">
        <ul class="nav nav-pills">
          <li class="nav-item active">
            <a href="#">Teacher Module</a>
          </li>
          <!-- <?php //if (array_search("Degrees",$sections)): ?> -->
            <li class="nav-item">
              <a class="btn" href="teacher/course_aloc_teacher.php">Alocate courses to Teachers</a>
            </li>
          <?php //endif; ?>
        </ul>
      </nav>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
  </html>


<?php
    // }else {
    //   redirect("index.php"); //redirect to the login page
    //
    // }
 ?>
