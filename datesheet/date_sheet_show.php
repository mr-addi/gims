<?php
require_once '../sourses/dat_shets_class.php';
$session_select="SELECT * FROM `sessions`";
$session_slct_exe=mysqli_query($GLOBALS['con'],$session_select) or die(mysqli_error($GLOBALS['con']));
if (isset($_POST['sumbit'])) {
    $term=$_POST['term_type'];
    $session=$_POST['session_select'];
    $select=$_POST['select_class'];
    $section=$_POST['section'];
    header("location: date_sheet_show2.php?term=$term&session=$session&select=$select&section=$section");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>



 <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->

 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- data table file library -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
      <!-- custom css  -->
      <link rel="stylesheet" href="../css/master.css">


  </head>
  <body>
  <div class="jumbotron jmbtrn">
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
            <a class="navbar-brand" href="#">Student</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../date_sheet.php">Create Date-Sheet<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="date_sheet_show.php">Print Date-Sheet</a></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="date_sheet_edit.php" >Edit Date-Sheet</a>
                </li>
                </ul>
            <ul class="nav navbar-nav navbar-right">
               <li><a href="../user_accounts/user_logout.php" class=" btn btn-default red-font"><b> LOGOUT </b></a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

        <h2 class="text-center">Date Sheet<br> <sub><sub>(View and Print the Date-Sheet)</sub></sub> </h2>
        </div>

    <div class="container">
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
          <form action="" method="post">
            <table class="table table-bordered">

                <tr>
                  <th>Roll No. Slip Term: </th>
                  <td>
                    <select class="form-control" name="term_type" id="term" required>
                      <option>select term</option>
                      <option value="1">Mid Term</option>
                      <option value="2">Final Term</option>
                    </select>
                </td>
                </tr>
                <tr>
                  <th>select session: </th>
                  <td id="session_append">
                    <select class="form-control" id="session_select" name="session_select" required>
                      <option >Select Session</option>
                      <?php
                        while ($session=mysqli_fetch_assoc($session_slct_exe)) { ?>
                          <option value="<?= $session['session_id'] ?>"><?= $session['session_type'] ."-". $session['session_year']?></option>
                        <?php }
                       ?>
                    </select>

                  </td>
                </tr>
                <tr>
                  <th>Select Class: </th>
                  <td>
                    <select class="form-control" id="class_select" name="select_class">

                    </select>
                    <select class="form-control" name="section" required>
                      <option value="a">A</option>
                      <option value="b">B</option>
                      <option value="c">C</option>
                      <option value="d">D</option>
                      <option value="e">E</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"><input type="submit" name="sumbit" value="Genrate Slip" class="btn btn-success-outline"></td>
                </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script>
    $("#session_select").attr('disabled','true');
    $("#term").change(function(event) {
      term_value=this.value;
      console.log(term_value);
        $("#session_select").removeAttr('disabled');
    });
    $("#session_select").change(function() {
      console.log(this.value);
      $("#class_select").html("");
      var chk_val=this.value;
      $.ajax({
        url: '../sourses/get_sessions_class.php',
        type:'POST',
        data: {param1 : chk_val}
      })
      .done(function(data) {
          $("#class_select").append(data);
      })
    });
    </script>
    </body>
</html>
