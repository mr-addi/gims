<?php
/*
**Page:add_module_section
**File include:dbconnectio
*/
require_once('dbconnection.php');
$sql="SELECT module_id,module_title FROM modules WHERE module_deleted=0";
$fetch_module=mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));

if(isset($_POST['submit_module']))//Execute when submit is click
{
  if ($_POST['hidden_module_update']>0) {
    $moduleid=$_POST['hidden_module_update'];
    $moduletitle=$_POST['module_title'];//value of Moduel Title
    $modulediscription=$_POST['module_discription'];//value of Moduel discription
    $sql="UPDATE `modules` SET `module_title`='$moduletitle',`module_description`='$modulediscription' WHERE `module_id`='$moduleid'";
    mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));
  }else {
    $moduletitle=$_POST['module_title'];//value of Moduel Title
    $modulediscription=$_POST['module_discription'];//value of Moduel discription
    $sql="INSERT INTO modules (module_title,module_description,module_deleted) VALUES('$moduletitle','$modulediscription','0')";
    mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));
  }
}
//Submit Section  form
if (isset($_POST['submit_section'])) {
  //update section data
  if ($_POST['hidden_update']>0) {
    $sectiontitle=$_POST['section_title'];
    $sectiondiscription=$_POST['section_discription'];
    $sectionmoduleid=$_POST['module_title_for_setion'];
    $sectionid=$_POST['hidden_update'];
    $sql="UPDATE `sections` SET `section_title`='$sectiontitle',`section_description`='$sectiondiscription',`module_id`='$sectionmoduleid' WHERE `section_id`='$sectionid'";
    mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));
  }else {//insert section data
    $sectiontitle=$_POST['section_title'];
    $sectiondiscription=$_POST['section_discription'];
    $sectionmoduleid=$_POST['module_title_for_setion'];
    $sql="INSERT INTO `sections`( `section_title`, `section_description`, `module_id`,section_deleted) VALUES ('$sectiontitle','$sectiondiscription','$sectionmoduleid','0')";
    mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Module and sections</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
  <div class="jumbotron">
    <h2 class="text-primary text-center">Here you can add module and their sections</h2>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <!--left space for content-->
      </div>
      <div class="col-md-4">
        <form  method="post">
          <table class="table table-bordered">
            <thead >
              <tr class="bg-success"> <!--Table header-->
                <th colspan="" class="text-center">Add Module</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <label for="module_title">Module Title:</label>
                  <input id="update_module_title" class="form-control" type="text" name="module_title" value="" maxlength="48" required>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="module_title">Module Description:</label>
                  <textarea id="update_module_description" class="form-control" name="module_discription" rows="5" cols="" maxlength="250" required></textarea>
                  <input id="hidden_module_update" type="hidden" name="hidden_module_update" value="">
                  <br><br><br><br>
                </td>
              </tr>
              <tr>
                <!--Submit module and section data -->
                <th colspan=""><input class="btn btn-primary pull-right" type="submit" name="submit_module" value="Submit"></th>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="col-md-4">

        <form  method="post">
          <table class="table table-bordered">
            <thead>
              <tr class="bg-success">
                <th class="text-center">Add Section</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <label for="module_title_for_setion">Select Section:</label>
                  <select id="" class="form-control" name="module_title_for_setion">
                    <!--Print All module in Dropdwon Dynamically-->
                    <?php while ($row=mysqli_fetch_assoc($fetch_module)) { ?>
                      <option id="module_section" value="<?php echo $row['module_id'] ?>"><?php echo $row['module_title'] ?></option>
                    <?php  } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="section_title">Section Title:</label>
                  <input id="section_title" class="form-control" type="text" name="section_title" value="" required maxlength="48">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="section_discription">Section Discription</label>
                  <textarea id="section_description" class="form-control" name="section_discription" rows="5" required></textarea>
                  <input id="hidden_update" type="hidden" name="hidden_update" value="">
                </td>
              </tr>
              <tr>
                <td><input class=" btn btn-primary pull-right" type="submit" name="submit_section" value="Submit"></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="col-md-2">
        <!--Right space for content-->
      </div>
    </div>
  </div>
  <!--All data-->
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <!--Right space for content-->
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-striped">
          <!--Table Header-->
          <thead>
            <tr class="btn-success">
              <th>ID</th>
              <th colspan="2" id="23">Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $counter=1;//use for Id just 1,2,3,4,5 Numbring
            $sql="SELECT `module_id`, `module_title`,`module_description` FROM `modules` WHERE `module_deleted`=0";
            $fetch_all_module=mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));
            while ($row=mysqli_fetch_assoc($fetch_all_module)) { //Fetch All modules
              $moduleid=$row['module_id'];?>
              <tr>
                <th><?php echo $counter++; ?></th>
                <th colspan="2" id="<?php echo $moduleid; ?>">
                  <?php  echo $row['module_title']; ?>
                  <input id="<?php echo $moduleid+100 ?>" type="hidden" name="moduleee" value="<?php echo $row['module_description'] ?>">
                </th>
                <td>
                  <button class="btn btn-outline-primary btn-sm" type="button" name="button" onclick="update_module_form(<?php echo $moduleid ?>)">Update</button>
                  <button class="btn btn-outline-danger btn-sm" type="button" name="button"><a style="margin:4px" class="text-danger" href="delete_modul_section.php?delete_module=<?php echo $moduleid ?>" >Delete</a></button>
                </td>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <td>
                  <ol>
                    <?php
                    $sql1="SELECT  `section_id`,`section_title` FROM `sections` WHERE `module_id`=$moduleid AND `section_deleted`=0";
                    $fetch_all_sections=mysqli_query($GLOBALS['con'],$sql1) or die(mysqli_error($GLOBALS['con']));//Execute Query
                    while ($row1=mysqli_fetch_assoc($fetch_all_sections))
                    { ?>
                      <li id="<?php echo $row1['section_id'] ?>"><?php echo $row1['section_title'] ?></li><br>
                    <?php } ?>
                  </ol>
                </td>
                <td>
                  <?php
                  $sql1="SELECT  `section_id`,`section_description` FROM `sections` WHERE `module_id`=$moduleid AND `section_deleted`=0";
                  $fetch_all_sections=mysqli_query($GLOBALS['con'],$sql1) or die(mysqli_error($GLOBALS['con']));//Execute Query
                  while ($row2=mysqli_fetch_assoc($fetch_all_sections))
                  { ?>
                    <button class="btn btn-outline-primary btn-sm" type="button" name="button" onclick="update_section_form(<?php echo $moduleid.",".$row2['section_id'] ;?>)">Update</button>
                    <a style="margin:4px" class="btn btn-outline-danger btn-sm" href="delete_modul_section.php?delete_section=<?php echo $row2['section_id']?>" >Delete</a><br>
                    <input id="<?php echo $row2['section_id']+100 ?>" type="hidden" name="" value="<?php echo $row2['section_description'] ?>">
                  <?php } ?>
                </td>
              </tr>
            <?php  } ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-2">

      </div>

    </div>
  </div>
  <script>

  function update_section_form(module_id,section_id)//This function get the value of related rows from table and insert in form
  {
    var param1=module_id;
    var param2=section_id;
    var add=100;
    var yy=1;
    var hide_input_id=param2+add;
    var module_text=document.getElementById(param1).innerText;
    var section_text=document.getElementById(param2).innerText;
    var return_hide_description=document.getElementById(hide_input_id).value;
    document.getElementById('module_section').text=module_text;
    document.getElementById('module_section').value=param1;
    document.getElementById('section_title').value=section_text;
    document.getElementById('section_description').value=return_hide_description;
    document.getElementById('hidden_update').value=param2;
    $('html,body').scrollTop(0);
  }

  function update_module_form(id)
  {
    var get_id_add=id+100;

    var a=document.getElementById(id).innerText;
    var c=document.getElementById(get_id_add).value;
    document.getElementById('update_module_title').value=a;
    document.getElementById('update_module_description').value=c;
    document.getElementById('hidden_module_update').value=id;
    $('html,body').scrollTop(0);
  }
  </script>
</body>
</html>
