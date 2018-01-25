<?php
    session_start(); ##starting Session
    Include '../sourses/db_connection.php'; ##Including database connection
    Include '../session/manage_session_class.php';##including sessions class
    include '../sourses/teachers_class.php';##including teachers class
    $tech_obj = new teacher();
    $sess_obj = new Manage_Session();
    $all_sess_raw_data=$sess_obj->fetch_all_session();## calling thr function
if (isset($_GET)) { ##check if the value of get variable is set
    $teacher_id = $_GET['tech_id'];
    $result_data = $tech_obj->fn_ln_by_id($teacher_id);
    $teach_data = mysqli_fetch_assoc($result_data);
    $teacher_fname = $teach_data['teacher_first_name'];
    $teacher_lname = $teach_data['teacher_last_name'];
}
   if (isset($_GET['msg'])) {
       echo "<script> alert('".$_GET['msg']."'); </script>";
   }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Courses</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/master.css" />
</head>
<body>
   <div class="jumbotron jmbtrn"> <!-- div for navbar -->
     <nav class="navbar navbar-inverse">
      <div class="container-fluid">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
           <a class="navbar-brand" href="#">Teacher</a>
         </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <ul class="nav navbar-nav">
             <li class="active"><a href="course_aloc_teacher.php">Teacher Course Management <span class="sr-only">(current)</span></a></li>
             <li><a href="../index.php">Home</a></li>
             <li> <a href="add_teacher.php">Add New Teacher</a> </li>
           </ul>
           <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Link</a></li>
           </ul>
         </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
     </nav>
     <h2 class="text-center">Teacher Courses Allocation</h2>
   </div>

    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h1 class="text-center">Teacher Data</h1>
            <table class="table table-bordered">
            <thead>
                <tr>
                <th>Teacher Id</th>
                <th>Teacher First Name</th>
                <th>Teacher Last Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td><?= $teacher_id ?></td>
                <td><?= ucwords($teacher_fname) ?></td>
                <td><?= ucwords($teacher_lname) ?></td>
                </tr>
            </tbody>
            </table>

            <form action="" method="post">
                <table class="table dtat_table" style="width:50%">
                <thead>
                    <tr>
                    <th>Select Session <input type="hidden" value="<?= $teacher_id ?>" id="tec_id" /> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        <select class="form-control" name="selected_session" id="selected_session">
                        <option value=""></option>
                        <?php
                            while ($sess_data=mysqli_fetch_assoc($all_sess_raw_data)) {
                            ?>
                            <option value="<?= $sess_data['session_id'] ?>"><?= ucwords($sess_data['session_type']." - ".$sess_data['session_year']." - ".$sess_data['session_timming']) ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </td>
                    </tr>
                </tbody>
                </table>
            </form>
            <div id="class_selected"></div>
        </div>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
         $('#selected_session').change(function() {
            $("#class_selected").html("");
            var tec_id=$('#tec_id').val();
           var sess_val=$(this).val();
           console.log(sess_val+tec_id);
           $.ajax({
                url: '../sourses/get_teacher_crs.php',
                type:'POST',
                data: {param1 : tec_id,param2 : sess_val}
              })
              .done(function(data) {
                  $("#class_selected").append(data);
              })
            });
     </script>
</body>
</html>
