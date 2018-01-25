<?php
require_once('dbconnection.php');
$sql="SELECT * FROM `permissions` WHERE `permission_deleted`=0";
$fetch_all_permission_table=mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));

$sql="SELECT * FROM `modules` WHERE `module_deleted`=0";
$fetch_all_module=mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));

if (isset($_POST['Submit_permission_dorm'])) {
  $permissiontitle=$_POST['permission_title'];
  $permissiondescription=$_POST['permission_description'];
  $sql="INSERT INTO `permissions`( `permission_title`, `permission_description`) VALUES ('$permissiontitle','$permissiondescription')";
  mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));
}

if(isset($_POST['submit_module_section_permission']))
{
  $selectedmodule=$_POST['select_module_for_permission'];
  $selectedsecction=$_POST['select_section_for_permission'];

  $sql1="SELECT `module_title` FROM `modules` WHERE `module_id`=$selectedmodule AND `module_deleted`=0";
  $moduletitle=mysqli_query($GLOBALS['con'],$sql1) or die(mysqli_error($GLOBALS['con']));
  $sql2="SELECT `section_title` FROM `sections` WHERE `section_id`=$selectedsecction AND `section_deleted`=0";
  $sectiontitle=mysqli_query($GLOBALS['con'],$sql2) or die(mysqli_error($GLOBALS['con']));

  $row1=mysqli_fetch_assoc($moduletitle);
  //echo $row['module_title'];
  $row2=mysqli_fetch_assoc($sectiontitle);
  //echo $row['section_title'];

  foreach ($_POST['permission_allowed'] as $ok) {

    $sql3="SELECT  `permission_title` FROM `permissions` WHERE `permission_id`=$ok AND `permission_deleted`=0";
    $permissionttle=mysqli_query($GLOBALS['con'],$sql3) or die(mysqli_error($GLOBALS['con']));
    $row3=mysqli_fetch_assoc($permissionttle);
    $pwermission_key=$row1['module_title']."@".$row2['section_title']."@".$row3['permission_title'];
    $sql4="INSERT INTO `module_section_permissions`( `module_id`, `section_id`, `permission_id`, `permission_key`) VALUES ('$selectedmodule','$selectedsecction','$ok','$pwermission_key')";
    mysqli_query($GLOBALS['con'],$sql4) or die(mysqli_error($GLOBALS['con']));
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <!-- Bootstrap -->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  
  <style>
  .bs-example{
    margin: 20px;
  }
  </style>

</head>

<body class="bg-default">
  <!--Top Header-->
  <div class="jumbotron">
    <h2 class="text-center text-primary">Here you can Manage Permissions</h2>
  </div>
  <div class="container">
    <!--Top Header Buttons-->
    <div class="row">
      <!-- <div class="bs-example">
        <ul class="nav nav-tabs">
          <li> <button id="add_permission" class="btn btn-outline-success" type="button" name="button">Add Permission</button></li>
          <li> <button id="module_section_permissions" class="btn btn-outline-success" type="button" name="button">Module->section->permission</button></li>
        </ul>
      </div> -->
      <div class="col-md-2">
        <!--Left Right Spaces-->
      </div>
      <div class="col-md-8">
        <form class="" action="" method="post">
          <table class="table">
          <tr>
            <th><button id="add_permission" class="form-control btn btn-outline-success" type="button" name="button">Add Permission</button></th>
            <th><button id="module_section_permissions" class="form-control btn btn-outline-success" type="button" name="button">Module->section->permission</button></th>
          </tr>
          </table>
        </form>
      </div>
      <div class="col-md-2">
        <!--Left Right Spaces-->
      </div>
    </div>

    <div class="row permission_form">
      <div class="col-md-2">
        <!--Left Right Spaces-->
      </div>
      <!--Permission form-->
      <div class="col-md-8">
        <hr>
        <form class="" action="" method="post">
          <table class="table table-bordered">
            <tr class="bg-success">
              <th colspan="2" class="text-center ">Add Permissions</th>
            </tr>
            <div class="">
              <tr>
                <th><label for="permission_title">Permission Title:</label></th>
                <td>
                  <input class="form-control" type="text" name="permission_title" value="" required maxlength="48">
                </td>
              </tr>
              <tr>
                <th><label for="permission_description">Permission Description:</label></th>
                <td>
                  <textarea class="form-control" name="permission_description" rows="5" ></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="2" ><input class="btn btn-primary pull-right" type="submit" name="Submit_permission_dorm" value="Submit"></td>
              </tr>
            </div>
          </table>
        </form>
      </div>
      <div class="col-md-2">
        <!-- Right Spaces for form -->
      </div>
    </div>
    <!-- Show permission Table -->
    <div class="row permission_form">
      <div class="col-md-2">
        <!-- left  Spaces for permission table -->
      </div>
      <div class="col-md-8">
        <hr>
        <table class="table table-bordered">
          <tr class="bg-success">
            <th>ID</th>
            <th>Permission</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
          <?php while ($row=mysqli_fetch_assoc($fetch_all_permission_table)) { ?>
            <tr>
              <th><?php echo $row['permission_id'] ?></th>
              <th><?php echo $row['permission_title'] ?></th>
              <td><?php echo $row['permission_description'] ?></td>
              <td>
                <a class="btn btn-danger" href="delete_modul_section.php?delete_permission=<?php echo $row['permission_id'] ?>">Delete</a>
                <input class="bnt btn-primary btn btn-primary" type="submit" name="" value="Update">
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div class="col-md-2">

      </div>
    </div>
    <div class="row module_section_permissions_divs">
      <div class="col-md-2">

      </div>
      <div class="col-md-8">
        <hr>
        <form class="" action="" method="post">
          <table class="table table-bordered">
            <tr class="bg-success">
              <th colspan="2" class="text-center">Module->Section->Permissin</th>
            </tr>
            <tr>
              <th>Select Module</th>
              <th>
                <select class="form-control" name="select_module_for_permission" onchange="showsection(this.value)">
                  <option selected></option>
                  <?php while ($row=mysqli_fetch_assoc($fetch_all_module)) { ?>
                    <option value="<?php echo $row['module_id'] ?>"><?php echo $row['module_title'] ?></option>
                  <?php } ?>
                </select>
              </th>
            </tr>
            <tr>
              <th>Select Section</th>
              <th>
                <select id="get_all_section" class="form-control" name="select_section_for_permission">
                </select>
              </th>
            </tr>
            <tr>
              <th>Select Permissions</th>
              <td>
                <?php
                $sql="SELECT * FROM `permissions` WHERE `permission_deleted`=0";
                $fetch_all_permission_table=mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));
                while ($row=mysqli_fetch_assoc($fetch_all_permission_table)) { ?>
                  <label for=""><?php echo $row['permission_title']; ?></label>
                  <input type="checkbox" name="permission_allowed[]" value="<?php echo $row['permission_id']; ?>">
                <?php } ?>
              </td>
            </tr>
            <tr>
              <th colspan="2" class="pull-right"><input class="btn btn-primary pull-right" type="submit" name="submit_module_section_permission" value="Submit"></th>
            </tr>
          </table>
        </form>
      </div>
      <div class="col-md-2">

      </div>
    </div>
  </div>
  <script>
  // var x=document.getElementsByClassName('permission_form')[0].display="none";

  $(document).ready(function(){
    $(".module_section_permissions_divs").hide();
    $("#add_permission").click(function(){
      $(".permission_form").show();
      $(".module_section_permissions_divs").hide();
    });
    $("#module_section_permissions").click(function(){
      $(".permission_form").hide();
      $(".module_section_permissions_divs").show();
    });
  });



  function showsection(str) {
    //console.log(str);
    if (str=="") {
      document.getElementById("txtHint").innerHTML="";
      return;
    }
    $.ajax({
      url: "getsection.php",
      type:"post",
      data: {param1:str}
    })
    .done(function(data){
      document.getElementById("get_all_section").innerHTML=data;
    });
  }

  </script>

</body>
</html>
