<?php
/*
**File Name:student Registration Form
***********Dependent Files***********
**upload_images.php(For Insert Form Record)
**
*******************API's**********
**File API for Show Iamge
*/
Include "upload_images.php";
$obj=new Student;
$data=$obj->fetch_onload();
if (isset($_POST['submit_student_form'])) {
  echo "this is testing";
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
  <title></title>

  <!-- Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
  <div class="jumbotron">
    <p>Category of reserved seats</p>
    <p>Genrate input filled in course allocation for section</p>
  </div>
    <a href="../index.php">Home</a>
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
              <p class="text-center">(Please fill in neatly in Block Letters)</p>
              <div class="form-group">
                <label for="degree">Degree</label>
                <!-- Fetch All the degrees onload page -->
                <select class="form-control input-sm" name="degree_selected" style = "width:100px;">
                  <?php while ($row=mysqli_fetch_assoc($data)) { ?>
                    <option value="<?php echo $row['degree_id'] ?>"><?php echo $row['degree_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="subject"> Subject</label>
                <select class="form-control input-sm" name="subject" style = "width:100px;">
                  <?php
                  // Call Function Class Student_Insertion
                  $data=$obj->fetch_onload();
                  //Fetch All the Subjects
                  while ($row=mysqli_fetch_assoc($data)) { ?>
                    <option value="<?php echo $row['degree_id'] ?>"><?php echo $row['degree_subject_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="">Semester: </label>
              </div>
              <div class="form-group">
                <label for="semester_radio"> Fall </label>
                <input class="" type="radio" name="student_admission_session_name" value="fall" required>
              </div>
              <div class="form-group">
                <label for="semester_radio"> Spring </label>
                <input class="" type="radio" name="student_admission_session_name" value="spring" required>
              </div>
            </div>
            <div id="holder" class="col-md-2 bb " style="height:152px;width:152px;padding:0px;" title="Select Image">
              <p class="status"></p>
              <!--  Show Iamge Block-->
            </div>
            <div class="pull-right">
              <!-- Choose Image Block  -->
              <!-- <button class="btn btn-info btn-sm" type="button" name="button" onclick="choose_file_click()"> Select Your Image</button>
              <input class="pull-right choose_attached" type="file" name="fileToUpload" id="file_uploded" width="150px"> -->
                <span id="fileselector">
               <label class="btn btn-default" for="upload-file-selector">
                   <input id="upload-file-selector" class="choose_attached " name="fileToUpload" type="file">
                   <i class="fa_icon icon-upload-alt margin-correction"></i>Select your Image
               </label>
                </span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <br>
                <label for="form_no">Form No. </label>
                <input class="form-control input-sm"  type="number" name="student_form_no" min="0" style="width:90px" value="1">
                <br /><label for="arid_reg_no"> Arid No</label>
                <input class="form-control input-sm"  type="number" name="arid_reg_no" min="13"  style="width:50px;margin:0" value="15">
                <input type="text" name="arid_constant" value="-Arid-" style="width:40px;margin:0" disabled>
                <input class="form-control input-sm"  type="number" name="arid_reg_n" min="0"  style="width:50px;margin:0" value="374">
              </div>
            </div>
            <div class="col-md-9">
              <div class="row b">
                <div class="col-md-3 bg-warning" style="background-color:smokey_gray">
                  <br>
                  <small>Category<br>(See Prospectus)</small>
                  <br>
                  <small>To be Filled by<br>B Sc (Hons)Agri&DVM</small>
                </div>
                <div class="col-md-9 ">
                  <br>
                  <div class="form-group">
                    <div class="form-group" >
                      <label for="categorey_radio"> Open Merit </label>
                      <input type="radio" name="seat_categorey" value="open merit" onclick="my2()" required>
                    </div>
                    <div class="form-group" >
                      <label for="categorey_radio">District Quota </label>
                      <input type="radio" name="seat_categorey" value="district quota" onclick="my2()" >
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="categorey_radio">Reserved Seats </label>
                      <input type="radio" name="seat_categorey" value="reserved seats" onclick="my()" required>
                    </div>
                    <div class="form-group">
                      <label for=""> Catagory of Reserved Seats  </label>
                      <input id="reserved_categorey" class="form-control input-sm" type="text" name="categorey_reserved_seats" value="" disabled>
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
                  <input class="form-control input-sm" type="text" name="domicile_district" value="Gujrat" required   title="Only Characters allowed"><br>
                  <label for="domicile_province">Province:</label>
                  <input class="input-sm form-control" type="text" name="domicile_province" value="Punjab" required  maxlength="25" title="Only Characters allowed">
                </td>
              </table>
            </div>
            <div class="col-md-7 ">
              <table class="table table-22">
                <tr>
                  <th>
                    <label for="morning_evening_radio">Morning </label>
                    <input type="radio" name="morning_evening_radio" value="morning" checked><br>
                    <label for="morning_evening_radio">Evening </label>
                    <input type="radio" name="morning_evening_radio" value="evening" disabled>
                  </th>
                  <th>
                    <label for="rural_urban_radio">Rural </label>
                    <input type="radio" name="rural_urban_radio" value="rural" checked><br>
                    <label for="rural_urban_radio">Urban </label>
                    <input type="radio" name="rural_urban_radio" value="urban">
                  </th>
                  <th>
                    <label for="male_female_radio">Male &nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" name="male_female_radio" value="male" checked><br>
                    <label for="male_female_radio">Female </label>
                    <input type="radio" name="male_female_radio" value="female">
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
                  <td><input  class="form-control input-sm" type="text" name="student_name" value="Hassan Raza"></td>
                </tr>
                <tr>
                  <th>CNIC</th>
                  <td><input  class="form-control input-sm"type="number" name="student_cnic" value="000000000000000" required placeholder="In case of foreign pasport No"><br></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><input  class="form-control input-sm"type="email" name="student_email" value="A@gmail.com"></td>
                </tr>
                <tr>
                  <th>Registration #</th>
                  <td><input  class="form-control input-sm"type="number" name="student_registration_no" value="" placeholder="For Ex Student(00-Arid-99)"></td>
                </tr>
                <tr>
                  <th>Previous Degree</th>
                  <td><input  class="form-control input-sm"type="text" name="student_degree" value=""  placeholder="For Ex Student">

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
                  <td><input class="form-control input-sm" type="date" name="student_dob" value="2017-09-12"></td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td><input class="form-control input-sm" type="number" name="student_phone_no" value="03411416200"></td>
                </tr>
                <tr>
                  <th>Mobile</th>
                  <td><input class="form-control input-sm" type="number" name="student_mobile_no" value="03411416200"></td>
                </tr>
                <tr>
                  <th>Religion</th>
                  <td><input  class="form-control input-sm"type="text" name="religion" value="Islam"></td>
                </tr>
                <tr>
                  <th>Nationality</th>
                  <td><input class="form-control input-sm" type="text" name="student_nationality" value="Pakistan"></td>
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
                  <th>Name: </th>
                  <td><input  style="margin-left:108px;" class="form-control input-sm"type="text" name="father_name" value="Muhammed Sadique"></td>
                </tr>
                <tr>
                  <th>CNIC:</th>
                  <td><input  style="margin-left:108px;"   class="form-control input-sm"type="number" name="father_cnic" value="000000000000"><br></td>
                </tr>
              </table>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1">

            </div>
            <div class="col-sm-10 col-md-5 col-lg-5">
              <table class="table table-22 table-bordered table-responsive">

                <tr>
                  <th>Occupation</th>
                  <td><input style="margin-left:-19px;" class="form-control input-sm"type="text" name="father_occupation" value="aaaaaaaa"></td>
                </tr>
                <tr>
                  <th>Annual Income</th>
                  <td><input style="margin-left:-19px;" class="form-control input-sm" type="number" name="father_annual_income" value="2000000"></td>
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
              <table class="table table-22">
                <tr>
                  <th>Test Name</th>
                  <td><input  class="form-control input-sm"type="text" name="test_name" value="" placeholder="Optional"></td>
                </tr>
                <tr>
                  <th>Test Date</th>
                  <td><input  class="form-control input-sm"type="date" name="test_date" value=""><br></td>
                </tr>
                <tr>
                  <th>Marks</th>
                  <td><input  class="form-control input-sm"type="number" name="test_marks" value="" placeholder="Optional"></td>
                </tr>

              </table>

            </div>
            <div class="col-md-5">
              <table class="table table-22">
                <tr>
                  <th>Detail of previous Disciplinary Action (if any)</th>
                  <td>
                    <textarea class="form-control input-sm" name="disciplinary_action" rows="6" ></textarea>
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
                  <th>Address (Parmanent)</th>
                  <td>
                    <textarea class="form-control input-sm" name="student_parmanent_address" rows="4" ></textarea>
                  </td>
                </tr>
                <tr>
                  <th>City</th>
                  <td>
                    <input class="form-control input-sm" type="text" name="student_parmanent_city" value="">
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-5">
              <table class="table table-22">
                <tr>
                  <th>Address (Postal)</th>
                  <td>
                    <textarea class="form-control input-sm" name="student_postal_address" rows="4" ></textarea>
                  </td>
                </tr>
                <tr>
                  <th>City</th>
                  <td>
                    <input class="form-control input-sm" type="text" name="address_city" value="">
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
              <table class="table table-22">
                <tr>
                  <th>Guardian Name</th>
                  <td><input  class="form-control input-sm"type="text" name="guardian_name" value="Ali"></td>
                </tr>
                <tr>
                  <th>Relation with Guardian</th>
                  <td><input  class="form-control input-sm"type="text" name="guardian_relation" value="Son"><br></td>
                </tr>
                <tr>
                  <th>Contact No. of Guardian</th>
                  <td><input  class="form-control input-sm"type="number" name="guardian_contact_no" value="000000000"><br></td>
                </tr>
              </table>

            </div>
            <div class="col-md-1 verticaltext">
              <div class="verticaltext_content ">
                Emergancy
              </div>
            </div>
            <div class="col-md-5">
              <table class="table table-22">

                <tr>
                  <th>Name</th>
                  <td><input class="form-control input-sm"type="text" name="emergancey_guardian_name" value="Zia"></td>
                </tr>
                <tr>
                  <th>Relation</th>
                  <td><input class="form-control  input-sm"type="text" name="emergancey_guardian_relation" value="father"></td>
                </tr>
                <tr>
                  <th>Phone  No</th>
                  <td><input class="form-control  input-sm" type="number" name="emergancey_guardian_contact_no" value="9999999999999"></td>
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
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="A"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="B"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="C"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="100"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value="10"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="D"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="cgpa[]" value="00"></td>
                <td><input class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="DSKLKL"></td>
              </tr>
              <tr>
                <th>HSSC</th>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="A"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="B"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="C"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="100"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value="10"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="D"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="cgpa[]" value="00"></td>
                <td><input class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="DSKLKL"></td>
              </tr>
              <tr>
                <th>Bachelor</th>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="A"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="B"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="C"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="100"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value="10"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="D"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="cgpa[]" value="00"></td>
                <td><input class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="DSKLKL"></td>
              </tr>
              <tr>
                <th>Master</th>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="A"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="B"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="C"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="100"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value="10"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="D"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="cgpa[]" value="00"></td>
                <td><input class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="DSKLKL"></td>
              </tr>
              <tr>
                <th>M.Phil</th>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="degree[]" value="A"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="year_of_passing[]" value="B"></td>
                <td><input class="form-control input-sm first_cat_width_table" type="text" name="borad_university[]" value="C"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="obtained_marks[]" value="100"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="total_marks[]" value="10"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="text" name="grade[]" value="D"></td>
                <td><input class="form-control input-sm second_cat_width_table" type="number" name="cgpa[]" value="00"></td>
                <td><input class="form-control input-sm third_cat_width_table" type="text" name="main_subjects[]" value="DSKLKL"></td>
              </tr>

              <tr>
                <td colspan="9">

                  <!-- <button class="btn btn-default pull-right" type="button" name="button" onclick="move_page()">Page 2</button> -->
                </td>
              </tr>
            </table>
          </div>
      </div>
      <div class="col-md-1"></div>
    </div>
    <!-- front form page start
    Back page row div start -->
    <div class=" page_two">
    <div class="row">
      <div class="col-md-1"><!-- left space --></div>
      <!-- back page details -->
      <div class="col-md-10 bg-info">
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
          <p>CNIC No.<input type="text" name="aplicnt_segn_cnic" class="form-control"></p>
        </div>
      </div>
      <div class="col-md-4"></div>
      <div class="col-md-3">
        <br><br><br>
        <div class="col-md-12" style="border-top:1px solid black">
          <p>Countersigned
              <small>(Father/Gaurdian)</small>
          </p>
          <p>CNIC No.<input type="text" name="guard_segn_cnic" class="form-control"></p>
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
                NOC From Employer Required (if applicable).
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
      <input class="btn btn-primary" type="submit" name="submit_student_form" value="Save">
      <!-- <button class="btn btn-default pull-right " type="button" name="button" onclick="back_to_page_one()">Page 1</button> -->
    </div>
    </form>
  </div>
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

  </script>
</body>
</html>
