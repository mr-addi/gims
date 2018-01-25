<?php
session_start();
if ($_SESSION['perm']=="") { //check if user is login
  redirect("../permission/login_user.php"); //redirect to the login page
} else {
  require_once '../permission/dbconnection.php'; //addiing the permission system database connection
  require_once '../permission/permission_checker.php';
}
function redirect($url) { //deffining the redirect function
  ob_start();
  header('Location: '.$url);
  ob_end_flush();
  die();
}

?>
<!-- <pre>
  <?php print_r($_SESSION['perm']); ?>
</pre> -->

<?php
if (permission_chcker("Student Manager@Students@Create")=="true") {

/*
**File Name:student Registration Form
***********Dependent Files***********
**upload_images.php(For Insert Form Record)
**
*******************API's**********
**File API for Show Iamge
*/
Include "upload_images.php";

Include "../session/manage_session_class.php";
// echo "string 1";

require_once("../sourses/classes_class.php");
$class_obj=new classes();
$class_res=$class_obj->get_all_classes_data();
$obj=new Student();
$obj1=new Manage_Session();
$session_data=$obj1->fetch_all_session();

$data=$obj->fetch_onload();
if (isset($_POST['submit_student_form'])) {
  $actual_last_id=$obj->insert_student_form_data();
  $uploade_message=$obj->upload_image($actual_last_id);
  }
if (isset($_GET['msg'])) {
  echo '<script type="text/javascript">alert("' . $_GET['msg'] . '")</script>';
 }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Students</title>

  <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- data table file library -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
      <!-- custom css  -->
      <link rel="stylesheet" href="../css/master.css">

  <style media="screen">
  .bb{
    border: 1px solid black;
  }
  .verticaltext {
    position: relative;
    padding-left:50px;
    margin:1em 0;
    min-height:120px;
  }
.abc
{
  float: right;
}
  .verticaltext_content {
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    left: -40px;
    top: 20px;
    position: absolute;
    text-transform: uppercase;
    font-size:18px;
    font-weight:bold;
  }
  .first_cat_width_table{
    width: 75px !important;
  }
  .second_cat_width_table{
    width: 62px !important;
  }
  #fileselector {
    margin: 10px;
}
#upload-file-selector {
    display:none;
}
.margin-correction {
    margin-right: 10px;
}

  </style>
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

              <li class="nav-item">
                  <a class="nav-link" href="../student_show_data.php">All Students</a>
              </li>
              <li class="nav-item ">
                  <a class="nav-link" href="freeze_student.php">Freezed Students</a>
              </li>
              <li class="nav-item active">
                  <a class="nav-link" href="student_insertion_form_for_ex.php">Add New Student<span class="sr-only">(current)</span></a>
              </li>
              </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="../user_accounts/user_logout.php" class=" btn btn-danger-outline">logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

      <h2 class="text-center">Students<br> <sub><sub>(Add new students)</sub></sub> </h2>
      </div>

  <div class="container bb bg-info">
    <!-- Devide Page in Two main Divs Name:Page1,Page2 -->
    <div class="row page_one">
      <br>
      <div class="col-md-1">

      </div>
      <div class="col-md-10">
        <!-- Form Start Here -->
        <form class="form-inline" action="" method="post" enctype="multipart/form-data">
          <div class="row">

            <div class="col-md-3">
              <!-- Logo -->
              <img src="../image/logo.png" alt="GIMS Logo" width="200px" height="170px" title="GIMS Logo">
            </div>
            <div class="col-md-7">
              <!-- Header Content -->
              <h5 class="text-center"><u><strong>PIR MEHR ALI SHAH</strong></u></h5>
              <h4 class="text-center"><u><strong>ARID AGRICLUTURE UNIVERSITY RAWALPINDI</strong></u></h4>
              <h4 class="text-center"><u><strong>AMISSION FORM</strong></u></h4>
              <!-- <p class="text-center">(Please fill in neatly in Block Letters)</p> --><br>
              <div class="form-group">
                <label for="degree">Degree</label>
                <!-- Fetch All the degrees onload page -->
                <select class="form-control input-sm" id="deg_id1" name="degree_selected" style = "width:200px;" required>
                  <option value=""></option>
                  <?php while ($row=mysqli_fetch_assoc($data)) { ?>

                    <option value="<?php echo $row['degree_id'] ?>"><?php echo $row['degree_name'] ?> ( <?php echo $row['degree_subject_name'] ?> )</option>
                  <?php } ?>
                </select>
              </div>
              <!-- <div class="form-group">
                <label for="subject"> Subject</label>
                <select class="form-control input-sm" id="deg_id2" name="student_subject" style = "width:80px;" required>
                  <option value=""></option>
                  <php
                  // Call Function Class Student_Insertion
                  $data=$obj->fetch_onload();
                  //Fetch All the Subjects
                  while ($row=mysqli_fetch_assoc($data)) { ?>
                    <option value="<php echo $row['degree_id'] ?>"><php echo $row['degree_subject_name'] ?></option>
                  <php } ?>
                </select>
              </div> -->
              <div class=" pull-right">
                <label for="">Joining Session</label>
                <select class="form-control input-sm" name="student_joining_session" style="width:130px" required>
                  <option value=""></option>
                  <?php

                   while ($row=mysqli_fetch_assoc($session_data)) {
                     $get_last=ucwords($row['session_type'])."_".$row['session_year'];
                     ?>
                    <option value="<?php echo $get_last ?>"><?php echo $get_last ?></option>
                  <?php } ?>
                </select>
              </div>
              <!-- <div class="form-group">
                <label for="">Semester: </label>
              </div>
              <div class="form-group">
                <label for="semester_radio"> Fall </label>
                <input required class="" type="radio" name="student_admission_session_name" value="fall" required>
              </div>
              <div class="form-group">
                <label for="semester_radio"> Spring </label>
                <input required class="" type="radio" name="student_admission_session_name" value="spring" required>
              </div> -->
            </div>
            <div id="holder" class="col-md-2 bb " style="height:152px;width:152px;padding:0px;" title="Select Image">
              <p class="status"></p>
              <!--  Show Iamge Block-->
            </div>
            <div class="pull-right">
              <!-- Choose Image Block  -->
              <!-- <button class="btn btn-info btn-sm" type="button" name="button" onclick="choose_file_click()"> Select Your Image</button>
              <input required class="pull-right choose_attached" type="file" name="fileToUpload" id="file_uploded" width="150px"> -->
                <span id="fileselector">
               <label class="btn btn-default" for="upload-file-selector">
                   <input required id="upload-file-selector" class="choose_attached " name="fileToUpload" type="file">
                   <i class="fa_icon icon-upload-alt margin-correction"></i> &nbsp;Select your Image
               </label>
                </span>
            </div>
            <div class="pull-left">
              <label for="semester_no">&nbsp;&nbsp; Sem No</label>
              <select class="form-control input-sm" id="class_dd" name="semester_no" required style="width:100px">
                <option value=""></option>
              </select>
            </div>
            <div class=" pull-left">
              <label for="student_section">Section </label>
              <select class="form-control input-sm" name="student_section" input-sm required style="width:80px">

                <option selected value="A">A</option>
                <option value="B">B</option>
                <option value="B">C</option>
              </select>
            </div>

            <div class="pull-left">
              <label for="">&nbsp; Crrunt Session&nbsp;&nbsp;</label>

              <select class="form-control input-sm" name="student_crrunt_session" style="width:130px">
                <option value=""></option>
                 <?php
                 $session_data=$obj1->fetch_all_session();
                  while ($row=mysqli_fetch_assoc($session_data)) {
                    $get_last=ucwords($row['session_type'])."_".$row['session_year'];
                    ?>
                   <option value="<?php echo $row['session_id'] ?>"><?php echo $get_last ?></option>
                 <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <br>
                <label for="form_no">Form No</label>
                <input required class="form-control input-sm"  type="number" name="student_form_no" min="0" style="width:150px" value="" required>
                <br/><label for="arid_reg_no"> Arid No</label>
                <input required class="form-control input-sm"  type="number" name="arid_reg_year" min="14"  style="width:50px;margin:0" value="" required>
                <input required type="text" name="arid_text" value="-Arid-" style="width:40px;margin:0" disabled>
                <input required class="form-control input-sm"  type="number" name="arid_roll_no" min="0"  style="width:60px;margin:0" value="" required>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row b">
                <div class="col-md-3 bg-warning" style="background-color:smokey_gray">
                  <br>
                  <small>Category<br>(See Prospectus)</small>
                  <br>
                  <small>To be Filled by<br>B Sc (Hons)Agri DVM</small>
                </div>
                <div class="col-md-9 ">
                  <br>
                  <div class="form-group">
                    <div class="form-group" >
                      <label for="categorey_radio"> Open Merit </label>
                      <input required type="radio" name="seat_categorey" value="open merit" onclick="my2()" required checked>
                    </div>
                    <div class="form-group" >
                      <label for="categorey_radio">District Quota </label>
                      <input required type="radio" name="seat_categorey" value="district quota" onclick="my2()" >
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="categorey_radio">Reserved Seats </label>
                      <input required type="radio" name="seat_categorey" value="reserved seats" onclick="my()" required>
                    </div>
                    <div class="form-group">
                      <label for=""> Catagory of Reserved Seats  </label>
                      <input required id="reserved_categorey" class="form-control input-sm" type="text" name="categorey_reserved_seats" value="" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!--End of row 2 -->
          <div class="row">
            <div class="col-md-1 verticaltext">
              <div class="verticaltext_content">
                Domicile
              </div>
            </div>
            <div class="col-md-4 ">
              <table class="table table-22">
                <td>
                  <label for="domicile_district">&nbsp;&nbsp;&nbsp;District:</label>
                  <input required class="form-control input-sm" type="text" name="domicile_district" value="Gujrat" required maxlength="20"  title="Only 20 Characters allowed"  style="width:163px;"><br>
                  <label for="domicile_province">Province:</label>
                  <!-- <input required class="input-sm form-control" type="text" name="domicile_province" value="Punjab" required  maxlength="25" > -->
                  <select class="form-control input-sm" name="domicile_province" title="Select Provnice" required>
                    <option value="punjab" selected>Punjab</option>
                    <option value="sindh">Sindh</option>
                    <option value="balochistan">Balochistan</option>
                    <option value="khayber pakhtunkhah">Khayber Pakhtunkhah</option>
                      <option value="AJK">AJK</option>
                  </select>
                </td>
              </table>
            </div>
            <div class="col-md-7 ">
              <table class="table table-22">
                <tr>
                  <th>
                    <label for="morning_evening_radio">Morning </label>
                    <input required type="radio" name="morning_evening_radio" value="morning" checked required><br>
                    <label for="morning_evening_radio">Evening </label>
                    <input required type="radio" name="morning_evening_radio" value="evening" disabled title="Evening Session is not Available">
                  </th>
                  <th>
                    <label for="rural_urban_radio">Rural </label>
                    <input required type="radio" name="rural_urban_radio" value="rural" checked><br>
                    <label for="rural_urban_radio">Urban </label>
                    <input required type="radio" name="rural_urban_radio" value="urban">
                  </th>
                  <th>
                    <label for="male_female_radio">Male &nbsp;&nbsp;&nbsp;</label>
                    <input required type="radio" name="male_female_radio" value="male" checked><br>
                    <label for="male_female_radio">Female </label>
                    <input required type="radio" name="male_female_radio" value="female">
                  </th>
                </tr>
              </table>
            </div>

          </div><!--End of row 3-->
          <div class="row">
            <div class="col-sm-1 col-md-1 col-lg-1  verticaltext">
              <div class="verticaltext_content ">
                Student
              </div>
            </div>
            <div class=" col-sm-10 col-md-5 col-lg-5">
              <table class="table table-bordered table-responsive table-sm table-22">
                <tr>
                  <th>Name</th>
                  <td><input required  class="form-control input-sm" type="text" name="student_name" value="" required title="Only Characters Allowed" ></td>
                </tr>
                <tr>
                  <th>CNIC</th>
                  <td><input id="cnic_dash2" required  class="form-control input-sm cnic" type="text" name="student_cnic" value="" placeholder="" required title="Only Numbers Allowed" pattern="[0-9 -]*" ><br></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><input   class="form-control input-sm"type="email" name="student_email" value=""></td>
                </tr>
                <tr>
                  <th>Registration #</th>
                  <td><input required  class="form-control input-sm"type="number" disabled name="student_registration_no" value="" placeholder="For Ex Student(00-Arid-99)"></td>
                </tr>
                <tr>
                  <th>Previous Degree</th>
                  <td><input required disabled class="form-control input-sm"type="text" name="student_degree" value=""  placeholder="For Ex Student">

                  </td>
                </tr>
              </table>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1">

            </div>
            <div class="col-sm-10 col-md-5 col-lg-5">
              <table class="table table-bordered table-responsive table-22">
                <tr>
                  <th>Date of Birth</th>
                  <td><input required class="form-control input-sm" type="date" name="student_dob" value="" style="width:168px" required></td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td><input required class="form-control input-sm" type="text" name="student_phone_no" value="" maxlength="11" pattern="[0-9]*"></td>
                </tr>
                <tr>
                  <th>Mobile</th>
                  <td><input required class="form-control input-sm" type="text" name="student_mobile_no" value="" maxlength="11" pattern="[0-9]*"></td>
                </tr>
                <tr>
                  <th>Religion</th>
                  <td><input required id="ad" class="form-control input-sm"type="text" name="religion" value="Islam" maxlength="15" pattern="[a-zA-Z ]*" title="Only Characters Allowed"></td>
                </tr>
                <tr>
                  <th>Nationality</th>
                  <td><input id="ac" required disabled class="form-control input-sm " type="text" name="student_nationality" value="Pakistan" maxlength="9" pattern="[a-zA-Z ]*" title="For change Double Click" ondblclick="this.disabled=false;"></td>
                </tr>
              </table>
            </div>


          </div><!--End of row 4-->
          <div class="row">
            <div class=" col-sm-1 col-md-1 col-lg-1 verticaltext">
              <div class="verticaltext_content ">
                Father
              </div>
            </div>
            <div class="col-sm-10 col-md-5 col-lg-5 ">
              <table class="table table-22 table-bordered table-responsive">
                <tr>
                  <th style="width:152px">Name: </th>
                  <td><input required   class="form-control input-sm"type="text" name="father_name" value="" maxlength="40" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                </tr>
                <tr>
                  <th>CNIC:</th>
                  <td><input required id="cnic_dash"    class="form-control input-sm"type="text" name="father_cnic" value="" maxlength="15"  title="Only number allowed"><br></td>
                </tr>
              </table>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1">

            </div>
            <div class="col-sm-10 col-md-5 col-lg-5">
              <table class="table table-22 table-bordered table-responsive">

                <tr>
                  <th style="width:132px">Occupation</th>
                  <td><input required s class="form-control input-sm"type="text" name="father_occupation" value="" maxlength="30" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                </tr>
                <tr>
                  <th>Annual Income</th>
                  <td><input required  class="form-control input-sm" type="number" name="father_annual_income" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                </tr>
              </table>
            </div>
          </div><!--End of row 5-->
          <div class="row">
            <div class="col-md-1 verticaltext">
              <div class="verticaltext_content ">
                NAT/GAT/GRE
                <p style="font-size:10px;">If Applicable</p>
              </div>
            </div>
            <div class="col-md-6">
              <table class="table table-bordered">
                <tr>
                  <th style="width:152px">Test Name</th>
                  <td><input  class="form-control input-sm"type="text" name="test_name" value="" placeholder="Optional" maxlength="6" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                </tr>
                <tr>
                  <th>Test Date</th>
                  <td><input class="form-control input-sm"type="date" style="width:168px" name="test_date" value=""><br></td>
                </tr>
                <tr>
                  <th>Marks</th>
                  <td><input class="form-control input-sm"type="number" name="test_marks" value="" placeholder="Optional"></td>
                </tr>

              </table>

            </div>
            <div class="col-md-5">
              <table class="table table-22">
                <tr>
                  <th style="width:132px">Detail of previous Disciplinary Action (if any)</th>
                  <td>
                    <textarea style="width:168px;height:84px" class="form-control input-sm" name="disciplinary_action" rows="6" ></textarea>
                  </td>
                </tr>

              </table>
            </div>
          </div><!--End of row 6-->
          <div class="row">
            <div class="col-md-1 verticaltext">
              <div class="verticaltext_content ">
                Address
              </div>
            </div>
            <div class="col-md-6">
              <table class="table table-22">
                <tr>
                  <th style="width:152px">Address (Parmanent)</th>
                  <td>
                    <textarea id="address_area_copy" style="width:168px" class="form-control input-sm" name="student_parmanent_address" rows="4" maxlength="150" pattern="[a-zA-Z ]*" title="Only Characters allowed"></textarea>
                  </td>
                </tr>
                <tr>
                  <th>City</th>
                  <td>
                    <input id="address_city_copy" required class="form-control input-sm" type="text" name="student_parmanent_city" value="">
                  </td>
                </tr>
                <tr>
                  <th>Same Postal</th>
                  <td class="text-center">
                      <input type="checkbox" class="" name="" id="same_address" value="" onclick="same_add()">
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-5">
              <table class="table table-22">
                <tr>
                  <th style="width:132px">Address (Postal)</th>
                  <td>
                    <textarea id="address_area_paste" style="width:168px" class="form-control input-sm" name="student_postal_address" rows="4" ></textarea>
                  </td>
                </tr>
                <tr>
                  <th>City</th>
                  <td>
                    <input id="address_city_paste" required class="form-control input-sm" type="text" name="address_city" value="">
                  </td>
                </tr>
              </table>
            </div>
          </div><!--end of row 7-->
          <div class="row">
            <div class="col-md-1 verticaltext">
              <div class="verticaltext_content ">
                Guardian
                <p style="font-size:10px;">if other than Father</p>
              </div>
            </div>
            <div class="col-md-5">
              <table class="table table-bordered">
                <tr>
                  <th>Guardian Name</th>
                  <td><input required  class="form-control input-sm"type="text" name="guardian_name" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                </tr>
                <tr>
                  <th style="width:152px">Guardian Relation</th>
                  <td><input required  class="form-control input-sm"type="text" name="guardian_relation" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"><br></td>
                </tr>
                <tr>
                  <th>Guardian Contact</th>
                  <td><input required  class="form-control input-sm"type="text" name="guardian_contact_no" value="" pattern="[0-9]*" title="Only numbeers allowed" ><br></td>
                </tr>
              </table>

            </div>
            <div class="col-md-1 verticaltext">
              <div class="verticaltext_content ">
                Emergancy
              </div>
            </div>
            <div class="col-md-5">
              <table class="table table-bordered">

                <tr>
                  <th style="width:132px">Name</th>
                  <td><input  class="form-control input-sm"type="text" name="emergancey_guardian_name" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                </tr>
                <tr>
                  <th>Relation</th>
                  <td><input  class="form-control  input-sm"type="text" name="emergancey_guardian_relation" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                </tr>
                <tr>
                  <th>Phone  No</th>
                  <td><input class="form-control  input-sm" type="number" name="emergancey_guardian_contact_no" value=""  title="Only numbers allowed"></td>
                </tr>
              </table>
            </div>
          </div><!--End of row 8-->
          <div class="col-md-1 col-lg-1 col-sm-1 verticaltext">
            <div class="verticaltext_content ">
              Academic
            </div>
          </div>
          <div class="col-md-11 col-lg-11 col-sm-11">
            <table class="table table-responsive table-bordered">
              <tr>
                <th></th>
                <th>Degree/<br>Certificate</th>
                <th>Year of<br>Passing</th>
                <th>Borad/<br>University</th>
                <th>Marks<br>Obtained</th>
                <th>Marks<br>Total</th>
                <th>Grade</th>
                <th>CGPA</th>
                <th>Main<br>Subjects</th>
              </tr>
              <tr>
                <th>SSC</th>
                <td><input required class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="SSC" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input  class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input  class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="BISE GRW" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value=""></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="" maxlength="2" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="cgpa[]" value="0"></td>
                <td><input  class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="" placeholder="Comma Separated"></td>
              </tr>
              <tr>
                <th>HSSC</th>
                <td><input required class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="HSSC" pattern="[a-zA-Z ]*" title="Only Characters allowed" ></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="BISE GRW" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value=""></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="" maxlength="2" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="cgpa[]" value="0"></td>
                <td><input class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="" placeholder="Comma Separated"></td>
              </tr>
              <tr>
                <th>Bachelor</th>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value=""></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="" maxlength="2" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="cgpa[]" value="0"></td>
                <td><input class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="" placeholder="Comma Separated"></td>
              </tr>
              <tr>
                <th>Master</th>
                <td><input  class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input  class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input  class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input  class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input   class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value=""></td>
                <td><input   class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="" maxlength="2" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input   class="form-control input-sm second_cat_width_table" type="text" name="cgpa[]" value="0"></td>
                <td><input   class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="" placeholder="Comma Separated"></td>
              </tr>
              <tr>
                <th>M.Phil</th>
                <td><input   class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input   class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input   class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input   class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="" pattern="[0-9]*" title="Only numbers allowed"></td>
                <td><input   class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value=""></td>
                <td><input   class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="" maxlength="2" pattern="[a-zA-Z ]*" title="Only Characters allowed"></td>
                <td><input   class="form-control input-sm second_cat_width_table" type="text" name="cgpa[]" value="0"></td>
                <td><input   class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="" placeholder="Comma Separated"></td>
              </tr>

              <tr>
                <td colspan="9">
                  <input required class="btn btn-primary" type="submit" name="submit_student_form" value="Save">
                    <!-- <button class="btn btn-default pull-right " type="button" name="button" onclick="back_to_page_one()">Page 1</button> -->

                  <!--<button class="btn btn-default pull-right" type="button" name="button" onclick="move_page()">Page 2</button> -->
                </td>
              </tr>
            </table>
          </div>
        </form>
      </div>
      <div class="col-md-1">
      </div>

    </div>
    <!-- front form page start
    Back page row div start -->
    <!-- <div class=" page_two">
    <div class="row">
      <div class="col-md-1"><!-- left space -->
    <!--  </div> -->
      <!-- back page details -->
      <!-- <div class="col-md-10 bg-info">
        <br><br>
        <p>
          <ol>
            <li>
              I,_______________________________________ Son/ Daughter of _____________________________________________
                 do hereby solemnly declare that i am applying for admission to the PMAS-AAUR with the consent of my father/
                 gaurdian and the particulars given by me cverleaf are correct. I have read the rules and regulations of the Universty and
                 fully understand them.
            </li>
            <li>
              I do undertake that during my stay at universty, I shall conduct myself with honor and refrain from taking part in any activity
              which may be considered by the universty authorities as prejudicial to interest of the instituation, It's descipline or to my own interest.
            </li>
            <li>
              I further undertake that i shall abide by the instructions, rules and regulations issued by the universty from time to time with record to residence
              , studies, conduct, etc.
            </li>
            <li>
              If I am found involved in any unlawful activity, or providing incorrect information at any stage of the studies, the University shall have the right to cancel
              my admission without assigning any reson.
            </li>
            <li>
              If any of the information/documents/certificates/degrees provided by me or found to be false at any stage of my studies, my addmission my be canceled forthwith
              without giving any show cause notice.
            </li>
            <li>
              Not employed/employed with _______________________________________ w.e.f._____________________________
            </li>
          </ol>
        </p>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-3">
        <br><br><br>
        <div class="col-md-12" style="border-top:1px solid black">
          <p>Signature of the Applicant</p>
          <p>CNIC No.<input required type="text" name="aplicnt_segn_cnic" class="form-control"></p>
        </div>
      </div>
      <div class="col-md-4"></div>
      <div class="col-md-3">
        <br><br><br>
        <div class="col-md-12" style="border-top:1px solid black">
          <p>Countersigned
              <small>(Father/Gaurdian)</small>
          </p>
          <p>CNIC No.<input required type="text" name="guard_segn_cnic" class="form-control"></p>
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <h4 class="text-center"><u><strong>IMPORTANT INSTRUCTIONS</strong></u></h4>
        <ol>
          <li>
            <strong>2 attested coppies</strong> of the following documents must accompany the applicational form:
            <ol type="i">
              <li>
                SSC Certificate & Detailed Marks Certificate.
              </li>
              <li>
                HSSC Certificate & Detailed Marks Certificate.
              </li>
              <li>
                Bachelor's Degree & Detailed Marks Certificate.
              </li>
              <li>
                M.Sc/M.Sc(Hons.)M.S/M.Phil Degree & Detailed Marks Certificate.
              </li>
              <li>
                Character Certificate From The Institution Last Attended.
              </li>
              <li>
                4 Recent Photographs (1.5<sup>"</sup> X 1.5<sup>"</sup>).
              </li>
              <li>
                National Identity Card Of The Father Or Guardian.
              </li>
              <li>
                National Identity Card Of The Candidate.
              </li>
              <li>
                Domicile Of Candidate.
              </li>
              <li>
                NOC From Employer required (if applicable).
              </li>
              <li>
                Attested Copy Of Result Card Of GRE/GAT/NAT(where applicable)
              </li>
            </ol>
          </li>
          <li>
            <strong><u>Selected Candidates are required to produce orignal documents at the time of addmision/enrollement</u></strong>
          </li>
          <li>
            <strong><u>Incomltete Application shall not be Entertained.</u></strong>
          </li>
        </ol>
      </div>
      <div class="col-md-1">

      </div>
    </div>
    <div class="">
      <input required class="btn btn-primary" type="submit" name="submit_student_form" value="Save">
      <!-- <button class="btn btn-default pull-right " type="button" name="button" onclick="back_to_page_one()">Page 1</button> -->
    <!--</div>
    </form>
  </div> -->
  </div>

  <br><br>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  <script >
    // $('.page_two').hide();

    function my()
    {
      var form = document.getElementById("reserved_categorey");
        form.disabled=false;
    }

    function my2()
    {
      var form = document.getElementById("reserved_categorey");
        form.disabled=true;
    }
    function move_page()
    {
      $('.page_one').hide();
      $('.page_two').show();
    }
    function back_to_page_one()
    {
      $('.page_one').show();
      $('.page_two').hide();
    }

    //file api

    var upload = document.getElementById('upload-file-selector'),
        holder = document.getElementById('holder'),
        state = document.getElementsByClassName('status');

    if (typeof window.FileReader === 'undefined') {
      state.className = 'fail';
    } else {
      state.className = 'success';
      state.innerHTML = '';
    }
     
    upload.onchange = function (e) {
      e.preventDefault();

      var file = upload.files[0],
          reader = new FileReader();
      reader.onload = function (event) {
        var img = new Image();
        img.src = event.target.result;
        // note: no onload required since we've got the dataurl...I think! :)
       img.width=150;
       img.height=150;
       img.media_right=20;
        holder.innerHTML = '';
        holder.appendChild(img);
      };
      console.log(reader.readAsDataURL(file));
      return false;
    };
    $(document).ready(function(){
            $("#cnic_dash").keyup (function () {
                var a=$(this).val().length;
                var value=$(this).val();
                if(a==5||a==13)
                {
                  $(this).val(value+"-");
                }
            });
        });

        $(document).ready(function(){
                $("#cnic_dash2").keyup (function () {
                    var a=$(this).val().length;
                    var value=$(this).val();
                    if(a==5||a==13)
                    {
                      $(this).val(value+"-");
                    }
                });
            });


        (function() {
            $("#deg_id1").change(function() {
              $("#class_dd").html("");
              var ses_id=$(this).val();
              $.ajax({
                url: '../sourses/get_sess_class.php',
                type: 'POST',
                data: {param1: ses_id}
              })
              .done(function(data) {
                $("#class_dd").append(data);
              })
              .fail(function(data) {
                console.log(data);
              })
              .always(function() {
                console.log("complete");
              });

            });
        }) ();

        function same_add() {
          var x = document.getElementById("same_address");
            if(x.checked)
            {

              var xy = document.getElementById("address_area_copy").value;
              var xz= document.getElementById('address_city_copy').value;

               document.getElementById("address_area_paste").value=xy;
               document.getElementById('address_city_paste').value=xz;
          }
          else {
            document.getElementById("address_area_paste").value="";
            document.getElementById('address_city_paste').value="";
          }
  }
  </script>
</body>
</html>

<?php }else {
  redirect("index.php"); //redirect to the login page

} ?>
