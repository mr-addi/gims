<?php

require_once '../sourses/teachers_class.php';
$tech_obj=new teacher();
if (isset($_POST['submit'])) {
    $tech_obj->teacher_insertion();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teachers</title>


  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="..\css\header_css.css">
  <style media="screen">
  .wid-inpt{
    float:right;
  }
  .th-width{
    width: 40%;
  }
  </style>
</head>
<body>
  <div class="jumbotron set_logo">
    <div class="pull-left">
      <a href="../index.php"><img src="../image/logo.png" alt="GIMS logo" width="180px" height="150px" style="padding-bottom:10px;"></a>
    </div>
    <div class="inner pull-right top_ul">
      <ul class="list-inline list-unstyled top_links">
        <li><a href="../index.php">Home</a></li>
        <li><a href="#"><u>Add Teacher</u></a></li>
        <li><a class="active" href="../teachers_page.php">All Teachers</a></li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-1">

      </div>
      <div class="col-md-10 bg-info"  style="border:1px solid black;">
        <h1 class="bg-success text-center">Employee Details Form</h1>
        <form action="" method="post">
          <div class="row">
            <div class="col-md-12">
              <table class="table">

                  <tr>
                    <th>Employee Id: </th>
                    <td><input type="text" name="emp_id" pattern="[0-9]*" maxlength="11" class="form-control wid-inpt" placeholder="11-digit-no-e.g(1245691011)"></td>
                  </tr>

              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">First Name: </th>
                  <td>
                    <input type="text" name="tec_frst_nm" maxlength="30" class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Last Name: </th>
                  <td>
                    <input type="text" name="tec_lst_nm" maxlength="30" class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Start Date:</th>
                  <td>
                    <input type="date" name="tec_strt_date" class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Designation: </th>
                  <td>
                    <input type="text" name="tec_desg" maxlength="30" class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Gender: </th>
                  <td>
                    <label for="tec_gender" class="form-control wid-inpt">
                      <input type="radio" name="tec_gender" value="male" checked required>
                      Male
                    </label>

                    <label for="tec_gender" class="form-control wid-inpt">
                      <input type="radio" name="tec_gender" value="female" required>
                      Female
                    </label>
                    <br>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Date of Birth: </th>
                  <td>
                    <input type="date" name="tec_dob" class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Address: </th>
                  <td>
                    <textarea name="tec_addrs" maxlength="198" class="form-control wid-inpt" required></textarea>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Suburb: </th>
                  <td>
                    <input type="text" maxlength="19" name="tec_subrb" class="form-control wid-inpt" required  placeholder="nearest city name">
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">State: </th>
                  <td>
                    <input type="text" name="tec_state" maxlength="19" class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Postcode: </th>
                  <td>
                    <input type="text" pattern="[0-9]*" maxlength="10"  name="tec_postcode"   class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Mobile: </th>
                  <td>
                    <input type="number" maxlength="15" name="tec_mbl_no" class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Email</th>
                  <td>
                    <input type="email" name="tec_email" maxlength="40" class="form-control wid-inpt" required>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width"><h1 class="bg-success text-center">Employee Bank Details</h1></th>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Bank Name: </th>
                  <td>
                    <input type="text" name="tec_bnk_name" maxlength="38" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Branch: </th>
                  <td>
                    <input type="text" pattern="[0-9]*" name="tec_bnk_brnch" min="0" max="10"  class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Account Name: </th>
                  <td>
                    <input type="text"  name="tec_acnt_name"  class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Social Security Number:</th>
                  <td>
                    <input type="text" pattern="[0-9]*" maxlength="11" name="tec_ssn" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Account Number</th>
                  <td>
                    <input type="text"[0-9]* maxlength="20" name="tec_bnk_acnt_no" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width"><h1 class="bg-success text-center">Next of Kin Details</h1></th>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Kin Name: </th>
                  <td>
                    <input type="text" maxlength="48" name="kin_ful_nm" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Relation:</th>
                  <td>
                    <input type="text" name="kin_rel" maxlength="19" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Address: </th>
                  <td>
                    <textarea name="kin_adrs" maxlength="70" class="form-control wid-inpt" cols="80"></textarea>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Subrub:</th>
                  <td>
                    <input type="text" maxlength="30" name="kin_suburb" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">State: </th>
                  <td>
                    <input type="text" maxlength="15" name="kin_state" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Postcode:</th>
                  <td>
                    <input type="text" pattern="[0-9]*" maxlength="10" name="kin_pst_cd" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Mobile no: </th>
                  <td>
                    <input type="text" maxlength="15" pattern="[0-9]*" name="kin_mbl_no" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width">Work no:</th>
                  <td>
                    <input type="text" pattern="[0-9]*" maxlength="15" name="kin_work_no" class="form-control wid-inpt">
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <!-- <div class="row">
            <div class="col-md-12 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width"><h1 class="bg-success text-center">only for office use</h1></th>
                </tr>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width"><h2>Employee:</h2> </th>
                  <td>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width" colspan="2">STATUS:</th>
                </tr>
                <tr>
                  <td colspan="2">
                  <label for="tec_status"  class="form-control" ><input type="radio" name="tec_status" value="1" checked requiredi>
                  Full Time:
                  </label>
                </td>
                </tr>
                <tr>
                  <td colspan="2">
                  <label for="tec_status"  class="form-control" ><input type="radio" name="tec_status" value="2" requiredi>
                  Part Time:
                  </label>
                </td>
                </tr>
                <tr>
                  <td colspan="2">
                  <label for="tec_status"  class="form-control" ><input type="radio" name="tec_status" value="2" requiredi>
                  Casual:
                  </label>
                </td>
              </tr>
              </table>
            </div>


            <div class="col-md-6 col-sm-12">
              <table class="table">
                <tr>
                  <th class="th-width" colspan="2">Pay Rate:</th>
                </tr>
                <tr>
                  <th>Annual</th>
                  <td><input type="number" name="pay_rate_annual" class="form-control wid-inpt"></td>
                </tr>
                <tr>
                  <th>Monthly</th>
                  <td><input type="number" name="pay_rate_monthly" class="form-control wid-inpt"></td>
                </tr>
                  <th>Hourly Rate</th>
                  <td><input type="number" name="pay_rate_hourly" class="form-control wid-inpt"></td>
              </tr>
              </table>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <table class="table">

                    <tr>
                      <th>Date of first pay review</th>
                      <td><input type="date" name="tec_frst_pay_date" class="form-control wid-inpt"></td>
                    </tr>

                </table>
              </div>
            </div> -->

        <div class="row">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary form-control">
          </div>
        </div>

        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script>

  </script>
</body>
</html>
