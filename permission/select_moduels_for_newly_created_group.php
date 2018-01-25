<?php
/*
title:to choose the modules ,section and permissions for group
*/
$hd1=$_GET['name'];
$hd2=$_GET['desc'];
require_once('dbconnection.php');
if(isset($_POST['submit_here'])){
  $inser_group_query="INSERT INTO groups(group_title, group_description) VALUES ('$hd1','$hd2')";
  $quer_exe=mysqli_query($GLOBALS['con'],$inser_group_query) or die("Error in inserting the data");
  $group_id=mysqli_insert_id($GLOBALS['con']);
  //to check the input values
  $data = $_POST['module'];
  foreach( $data as $key => $value ) { //iterate the post

    if( is_array( $value ) ) { //check if the value is another array

      foreach( $value as $ckey => $cvalue ) { //iterate the child array

        if( is_array( $cvalue ) ) { //check if the Cvalue is another Carray

          foreach( $cvalue as $cckey => $ccvalue ) { //iterate the child Carray

            $insert_mg_query = "INSERT INTO group_permissions(group_id, permission_id, module_id, section_id) VALUES ('$group_id','$cckey','$key','$ckey')";
            $insert_mg_query_exe = mysqli_query($GLOBALS['con'],$insert_mg_query) or die("Error in inserting the data");

          }
        }
      }
    }
  }

  redirect("groups_page.php");
}
function redirect($url) { // function to redirect the page
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
  <title>Groups</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->


</head>
<body>
  <div class="jumbotron">
    <h3 class="text-center">GROUPS</h3>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-2">

      </div>
      <div class="col-md-8">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th><h3>Group Id</h3></th>
              <th><h3>Group Name</h3></th>
              <th><h3>Group Description</h3></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php  ?></td>
              <td><?php print_r($hd1); ?></td>
              <td><?php print_r($hd2); ?></td>
            </tr>
          </tbody>
        </table>
        <form method="post" class="module_table">
          <table id="" class="table table-bordered module_table">
            <tr>
              <th style="width:25%;">Select Module</th>
              <th colspan="2">Selct Sections</th>
            </tr>
            <?php
            // php code for showing all available groups in a SELECT tag
            $get_query  ="SELECT * FROM modules WHERE module_deleted=0 ORDER BY module_id DESC";
            $modules    =mysqli_query($GLOBALS['con'],$get_query);
            while ($module=mysqli_fetch_assoc($modules)) {
                $title_name     = str_replace(" ","_",$module['module_title']);
            ?>

              <tr>
                <td>
                  <label for="<?= $title_name?>">
                    <input type="checkbox" name="module[<?= $module['module_id']?>]" value="<?= $module['module_id'] ?>" onclick="get_sections(this.value,<?= $title_name?>)">
                    <?= $module['module_title']?>
                  </label>
                </td>
                <td id="<?= $title_name?>" class="" colspan="2">
                <!-- area to append dynamicaly recived sections and permissions -->
                </td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="2">
                <!-- button for form submittion -->

                <input type="submit" name="submit_here" value="Submit" class="btn btn-success">
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
  <script>

    function get_sections(valuee,area_id) {

      var valu=valuee; //storing the value of selected permission
      console.log(valu);
      if($('input[value="'+valu+'"]').prop('checked')==true) {
      $.ajax({ // sending ajax request to get permissio
        url: 'module_section_return.php',
        type: 'POST',
        data: {param1: valu}
      })
      .done(function(data1) {
        $(area_id).html(data1);
      })
    } else {
      $(area_id).html(" ");
    }

    }
  /*
  ##follwing funtion is used to get all the available permissions
  ##and also manage to embed the
  */
  function get_permission(chk_val,name) {
    console.log(name);
    if($('input[id="'+'a'+chk_val+'"]').prop('checked')==true) { //if the checkbox checked or unchecked
      console.log("checked");
      var data12='';
      $.ajax({
        url: 'get_all_permissions.php',
        type:'POST',
        data: {param1 : chk_val , param2 : name}
      })
      .done(function(data) {
        data12=data;
        $(':input[id="'+'a'+chk_val+'"]').after("<br>"+data);
      })
      console.log(data12);
    } else {
      console.log("unchecked");
      var clas="."+chk_val;
      console.log(clas);
      $(clas).remove();
    }
  }
  </script>

</body>
</html>
