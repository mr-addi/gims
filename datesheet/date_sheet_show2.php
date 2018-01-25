<?php

require_once '../sourses/dat_shets_class.php';//including date sheet class


//declaring variables

$paper_title="";
$paper_type="";
$date="";
$time_from="";
$time_to="";
$paper_code="";
$student_data="";
$result_dt_sht="";
if(isset($_GET['term'])){ //checking $_GET setting
  // echo "<pre>";
  //   print_r($_GET);

  $ds_obj=new dates_sheets(); //creating the date sheet object
  $term=$_GET['term'];
  if ($term=='1') {//determing the value of Exam Time
    $term_name="MID";
  }else {
    $term_name="Final";
  }

  //getting the id and Name of session
  $sesion=$_GET['session'];
  $session_data="SELECT `session_type`, `session_year` FROM `sessions` WHERE `session_id`='$sesion'";
  $exe_session_data=mysqli_query($GLOBALS['con'],$session_data) or die(mysqli_error($GLOBALS['con']));
  $session_dt=mysqli_fetch_assoc($exe_session_data);
  $session_name=$session_dt['session_type']." ".$session_dt['session_year'];


  $class=$_GET['select'];
  $section=$_GET['section'];
  // echo $term;
  // echo "$sesion";
  // echo "$class";
  // echo "$section";
  $student_data=get_student($sesion,$class,$section);


  $result_dt_sht=$ds_obj->get_class_date_sheet($term,$sesion,$class,$section);
}



function get_student($session_id,$class_id,$section)
{
  $usection=strtoupper($section);
  $select_query="SELECT s.`student_id`,s.`arid_reg_no`,s.`student_first_name`,s.`student_picture_path`,p.`parent_name`,
                        d.degree_name,d.degree_subject_name
                  FROM `students` AS s, parents AS p,degrees AS d
                  WHERE `student_current_session`='$session_id'
                  AND `student_currunt_semester`='$class_id'
                  AND `student_section`='$usection'
                  AND s.`student_id`=p.`student_id`
                  AND s.`student_picture_path`<>'logo.png'
                  AND s.`degree_id`=d.`degree_id`
                  AND s.`is_deleted`=0
                  ORDER BY s.`arid_reg_no` ASC";
  $exe_select=mysqli_query($GLOBALS['con'],$select_query) or die(mysqli_error($GLOBALS['con']));
  return $exe_select;
}

 while ($res=mysqli_fetch_assoc($result_dt_sht)) {
   $paper_code[] .= $res['paper_code'];
   $paper_title[] .= $res['paper_title'];
   $paper_type[] .= $res['paper_type'];
   $date[] .= $res['date'];
   $time_from[] .= $res['time_from'];
   $time_to[] .= $res['time_to'];
 }

?>
<?php
if (!$result_dt_sht){
    echo(mysqli_error($GLOBALS['con']));
}
if ($result_dt_sht!="") {

if (mysqli_num_rows($result_dt_sht)>0){ ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>roll no slip</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
<?php while ($std=mysqli_fetch_assoc($student_data)) { ?>
  <body style="margin-top:10px;font-family:Times New Roman;">

    <div class="warper" style="width:1005px;border:1px dashed black;height:1450px;margin-top:16px;">
          <header style="height: 150px;">
            <div class="logo-div" style="margin: 5px;width:150px;float: left;">
              <img src="../image/logo.png" alt="images/logo.png" style="width:140px;float:left;margin-left:25px;">
            </div>
            <div class="top-content"  style="width: 1000px;text-align: center;letter-spacing:2px;">
            
              <h2><strong>GUJRAT INSTITUTE OF MANAGEMENT SCIENCES</strong></h3>
              <h3><u>ARID AGRICULTURE UNIVERSITY RWP</u></h3>
              <h4><strong><u>Roll No. Slip <?= $term_name ?> Term Exams <?= ucwords($session_name) ?></u></strong></h4>
            </div>
          </header>
          <section class="std-info" style="width: 825px;float: left;">

            <table class="table-bordered std-info-tbl1"  style="width: 600px;height: 100px;margin:0 auto 10px auto;">

                <tr>
                  <th style="padding-left: 10px;width: 200px;">STUDENT NAME: </th>
                  <td style="border-bottom: 1px solid black;text-align: center;width: 270px;">
                    <?php
                    $std_name=ucwords(strtolower($std['student_first_name']));
                    echo "$std_name";
                    ?>
                  </td>
                </tr>
                <tr>
                  <th style="padding-left: 10px;width: 200px;">FATHER'S NAME: </th>
                  <td style="border-bottom: 1px solid black;text-align: center;width: 270px;"><?php echo ucwords(strtolower($std['parent_name'])); ?></td>
                </tr>
                <tr>
                  <th style="padding-left: 10px;width: 200px;">STUDENT ID: </th>
                  <td style="border-bottom: 1px solid black;text-align: center;width: 270px;" ><?= $std['arid_reg_no'] ?></td>
                </tr>
                <tr>
                  <th style="padding-left: 10px;width: 200px;">DEGREE:</th>
                  <td style="border-bottom: 1px solid black;text-align: center;width: 270px;"><?= $std['degree_name'] ?>(<?= $std['degree_subject_name'] ?>)</td>
                </tr>
            </table>

            <!-- <div class="ds_wrd" style="height:250px;text-align: center;float: left;width: 120px;">
                <p style="margin: 120px 0px;">DATE SHEET:</p>
            </div> -->
            <div style="">
            <table class=" table table-bordered dt_sht_tbl" cellpadding="0" style="height:250px;width: 815px;float: right;font-size:14px;">
              <thead>
              <tr>
                <th class="bg-success text-center" colspan="6">
                  <h3>DATE SHEET</h3>
                </th>
              </tr>
                <tr>
                  <th>Sr. No</th>
                  <th>Course Code</th>
                  <th>Course Title</th>
                  <th>Paper_Type</th>
                  <th>Date</th>
                  <th>Time</th>
                </tr>

              </thead>
              <tbody>
                <?php
                $crs_cd2="";
                $j=1;
                 for ($i=0; $i < count($paper_code) ; $i++) {
                     $crs_cd1=$paper_code[$i];
                  ?>
                  <tr>
                    <?php if ($crs_cd1==$crs_cd2){
                      $j=$j-1;
                      ?>
                        <td></td>
                      <?php
                    } else {
                      ?>
                      <td><?= $j ?></td>
                      <?php
                    }?>
                    <td><?= $paper_code[$i] ?></td>
                    <td><?= $paper_title[$i] ?></td>
                    <td><?php
                        if ($paper_type[$i]=='1') {
                          echo "Theory";
                        } elseif ($paper_type[$i]=='2') {
                          echo "Practical";
                        }
                        ?></td>
                    <td>
                    <?php
                      $date1=date('d-m-Y', strtotime($date[$i]));
                      echo $date1  
                    ?>
                    </td>
                    <td><?= $time_from[$i] ?> / <?= $time_to[$i] ?></td>
                  </tr>

                  <?php ++$j;
                  $crs_cd2=$paper_code[$i];
                } ?>

            </table>
            </div>
            <!-- <div class="ds_wrd"  style="height:250px;text-align: center;float: left;width: 125px;">
              <p style="margin: 120px 0px;">INSTRUCTIONS:</p>
            </div> -->
            <div class="instructions"  style="width: 810px;float: right;font-size:18px;">
            
              <table class="table table-bordered">
                <tr>
                  <td class="text-center bg-success" >
                    <h3>
                      INSTRUCTIONS
                    </h3>
                    <!-- <hr> -->
                  </td>
                </tr>
              </table>
              <ol type="1" style="margin-left: 10px;">
                <li>Candidates are not allowed to sit in examination hall without verifying valid
                  <strong> ID Card </strong>and Roll Number Slip.</li>
                <li>Candidates have to sit on the allocated chair in the examination hall.</li>
                <li>Cheating may lead to Disqualification upto three(3) years.</li>
                <li>Mobile and other Electronic devices are not allowed in examination hall.</li>
                <li>Candidates enrolled but not appeared in exams are considered as fail.</li>
                <li>Candidates are not allowed to borrow any thing. (otherwise, ask the invigilator)</li>
                <li>No candidate will be entered in the examination hall after specified time(ie . 15(fifteen) minutes before the start of paper.</li>
                <li>Candidates must have to rais their hand in case of any query.</li>
                <li>Candidates shall not be allowed to leave the examination hall during the last fifteen (15) minutes of the examination.</li>
              </ol>
            </div>
          </section>
          <section class="img-view"  style="">

              <img src="../student/<?= $std['student_picture_path'] ?>" alt="<?= $std['student_picture_path'] ?>" style="width:168px;height:168px;margin-left:5px;margin-right:0px;">


          </section>
          <br>
          </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
<?php }
 ?>
</html>

<?php } else {
  echo "Record not found !";
  echo "<a href='date_sheet_show.php'> Back</a>";
}
}else {
  echo "Record not found !";
  echo "<a href='date_sheet_show.php'> Back</a>";
}
?>
