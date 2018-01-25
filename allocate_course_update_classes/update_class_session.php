<?php
require_once  '../session/manage_session_class.php';
//Manage_Session object
$obj=new Manage_Session();
//Onloade Call Function to get all session data
$all_session_data=$obj->fetch_all_session();
require_once '../sourses/classes_class.php';
$cls_obj=new classes();
// $session_id=$_POST['param1'];
$result=$cls_obj->get_classes_courses_by_session(17);
if(isset($_POST['submit_session']))
{
  $cls_obj=new classes();
  // $session_id=$_POST['param1'];
  $id=$_POST['session_selected'];
  $result=$cls_obj->get_classes_courses_by_session($id);
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title></title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="../css/header_css.css">
</head>
<body>
  <div class="jumbotron set_logo">
    <div class="pull-left">
      <a href="index.php"><img src="../image/logo.png" alt="GIMS logo" width="180px" height="150px" style="padding-bottom:10px;"></a>
    </div>
    <div class="inner pull-right top_ul">
      <ul class="list-inline list-unstyled top_links">
        <li><a href="../index.php">Home</a></li>
        <!-- <li><a class="active" href="#"><u>.......</u></a></li> -->
        <!-- <li><a href="student/student_insertion_form_for_ex.php">........</a></li> -->
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-1">

      </div>
      <div class="col-md-10">
        <div class="">
        <form class="" action="" method="post">
          <table class="table table-bordered">
            <tr>
              <th>Update Student Class</th>
              <td>
                    <select class="form-control" name="session_selected" id="session_id">
                      <option value=""></option>
                      <?php while ($row=mysqli_fetch_assoc($all_session_data)) { ?>
                        <option value="<?php echo $row['session_id']; ?>" ><?php  echo ucwords($row['session_type'])."-".$row['session_year']; ?></option>
                      <?php } ?>
                    </select>
              </td>
              <td>
                <input class="btn btn-primary" type="submit" name="submit_session" value="GO">
              </td>

            </tr>

          </table>
        </form>
        </div>
        <table id="student_data_table" class="table table-bordered  table-striped table-sm">
          <thead class="bg-success">
            <td>ID</td>
            <td>Class</td>
            <td class="text-center " colspan="6">Courses</td>
          </thead>
          <tbody class="show_data_body">
            <?php
            $counter=0;
            while ($clas=mysqli_fetch_assoc($result)) {

               if ($clas['class_id']!=$counter) { ?>
               </tr>
                <tr>

                    <?php
                  if ($clas['class_id']!=$counter) { ?>
                    <td><a class="btn btn-primary" href="allocate_course.php?alo=<?php echo $clas['class_id'] ?> ">Allocate Courses</a> </td>
                    <th><?php echo $clas['class_name']; ?></th>

                  <?php }
                   $counter=$clas['class_id'];
                    ?>
                    <td><?php echo $clas['course_title']; ?></td>

            <?php   }
            else { ?>
            <td><?php echo $clas['course_title']; ?></td>
            <?php } ?>


            <?php } ?>

          </tbody>
        </table>
      </div>
      <div class="col-md-1">

      </div>
    </div>
  </div>

  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">  </script>

  <script>
  $(document).ready(function() {
    $('#student_data_table').DataTable();
  } );

  (function() {
      $("#session_id").change(function() {
        $("#show_data_body").html("");
        var ses_id=$(this).val();
        $.ajax({
          url: '../sourses/get_sess_class.php',
          type: 'POST',
          data: {param1: ses_id}
        })
        .done(function(data) {
          $("#show_data_body").append(data);
        })
        .fail(function(data) {
          console.log(data);
        })
        .always(function() {
          console.log("complete");
        });

      });
  }) ();

  </script>
</body>
</html>
