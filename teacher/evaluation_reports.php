<?php
/*
*=================================================
*               TEACHER EVALUATION REPORTS
*=================================================
*
*This page provide the Interface for Teacher Evaluation Report
*This page genrate the Teacher Evaluation Reports
*
*/
// For get all session onload
require '../session/manage_session_class.php';//include (1)
$obj1=new Manage_Session();
$get_all_session=$obj1->fetch_all_session();

// include Header//
//Set Header Required variables
$title="Evaluation Reports";
$home="../index.php";
$active="Reports";
$next_link="";
$next_content="";
// INclude Header
require '../sourses/header.php';
  ?>
  <!--
  ***********************HTML START FROM HERE ********************
  -->
  <div class="container">
    <div class="row">
      <div class="container">
    <form class="" action="" method="post">
      <table class="table table-bordered">
        <!-- Header -->
        <tr>
          <th colspan="2" class="text-center bg-success text-white">Teacher Evaluation Report</th>
        </tr>
        <!--SESSION BLOCK  -->
        <tr>
          <th>Select Session</th>
          <td>
            <select class="form-control" id="session_selected" name="session_report">
              <option value=""></option>
              <?php while($row=mysqli_fetch_assoc($get_all_session)) { ?>
                <option value="<?=$row['session_id']; ?>"><?=ucwords($row['session_type'])."_".$row['session_year']; ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <!-- Teacher BLOCK -->
        <tr>
          <th>Select Teacher</th>
          <td>
            <select class="form-control" id="teacher_selected" name="session_report" disabled>
              <option value=""></option>
            </select>
          </td>
        </tr>
        <!-- Class BLOCK -->
        <tr>
          <th>Select Class</th>
          <td>
            <select class="form-control" id="class_selected" name="session_rep" disabled>
              <option value=""></option>
            </select>
          </td>
        </tr>
        <!--COURSE BLOCK  -->
        <tr>
          <th>Select Course</th>
          <td>
            <select class="form-control" id="course_selected" name="session_report" disabled>
              <option value=""></option>
            </select>
          </td>
        </tr>
        <!--Comments check BLOCK  -->
        <tr>
          <th>Allow Comments</th>
          <td>
            <input class="form-control" type="checkbox" name="comments_check" id="comments_check" value="">
          </td>
        </tr>
        <!--
          ***************PDF REPORT AREA****************
        -->
        <tr>
          <td colspan="2">
            <button id="pdf_printin" disabled class="form-control btn btn-primary " type="button" name="button">Print PDF in Tabular Form</button>
          </td>
        </tr>
        <tr>
          <th colspan="2" >
            <!-- <button disabled class="form-control btn btn-primary" type="button" name="button">Print PDF in Chart Form</button> -->
          </th>
        </tr>
      </table>
    </form><!--Main Form-->
    <!--
      ******************System Report Printing***********
   -->
    <!-- Report Header Information Table -->
    <hr><hr>
    <table class="table table-bordered" id="report_info_pannale">
    </table>
    <!--Report Pannale  -->
    <table class="table table-bordered" id="exportTable">
      <tbody id="report_table">
      </tbody>
    </table>
    </div><!--End of container-->
  </div><!--End of row-->
</div><!--End of container-->
<div class="abcd">

</div>
<!--
  ********************Script Start From Here ********************
 -->
<script>
//***********************PDF CALL*********************
(function() {
    $("#pdf_printin").click(function() {
      var pdf_ses_text=$( "#teacher_selected option:selected" ).text();
      var pdf_tea_text=$( "#session_selected option:selected" ).text();
      var pdf_cls_text=$( "#class_selected option:selected" ).text();
      var pdf_cou_text=$( "#course_selected option:selected" ).text();

      var pdf_ses_id=$("#session_selected").val();
      var pdf_tea_id=$("#teacher_selected").val();
      var pdf_cls_id=$("#class_selected").val();
      var pdf_cou_id=$("#course_selected").val();

      var comments=0;
      if ($('#comments_check').is(':checked')) {
        comments=1;
      }
      $.ajax({
        url: '../printing/teacher_evaluation_print.php',
        type: 'POST',
        data: {pdf_ses:pdf_ses_id,pdf_tea:pdf_tea_id,pdf_cls:pdf_cls_id,pdf_cou:pdf_cou_id,pdf_ses_tx:pdf_ses_text,pdf_tea_tx:pdf_tea_text,pdf_cou_tx:pdf_cou_text,pdf_cla_tx:pdf_cls_text,pdf_com:comments }
      })
      .done(function(data) {

        $(".abcd").html(data);
        console.log(data);
      })
      .fail(function(data) {
        console.log(data);
      })
      .always(function() {
        console.log("complete");
      });
    });
}) ();
//***********************END PDF CALL***********************

// AJAX Request for Teacher IN Selected Session
(function() {
    $("#session_selected").change(function() {
      $("#teacher_selected").html("");
      var ses_id=$(this).val();
      $.ajax({
        url: '../sourses/manage_evaluation_reports.php',
        type: 'POST',
        data: {param1: ses_id}
      })
      .done(function(data) {
        $("#abcd")
        $("#teacher_selected").removeAttr('disabled');
        $("#teacher_selected").html("");
        var ret_data="<option></option>"+data;
        $("#teacher_selected").append(ret_data);
      })
      .fail(function(data) {
        console.log(data);
      })
      .always(function() {
        console.log("complete");
      });
    });
}) ();
// AJAX Request for Teacher IN Selected Session
(function() {
    $("#teacher_selected").change(function() {
      $("#class_selected").html("");
      $("#course_selected").html("");
      var ses_id=$(this).val();
      var tec_id=$("#session_selected").val();
      $.ajax({
        url: '../sourses/manage_evaluation_reports.php',
        type: 'POST',
        data: {session:ses_id,teacher:tec_id}
      })
      .done(function(data) {
        $("#class_selected").html("");

        var ret_data="<option></option>"+data;
        $("#class_selected").append(ret_data);
        $("#class_selected").removeAttr('disabled');
      })
      .fail(function(data) {
        console.log(data);
      })
      .always(function() {
        console.log("complete");
      });
    });
}) ();
// AJAX Request for Course IN Selected Teacher
(function() {
    $("#class_selected").change(function() {
      $("#course_selected").html("");

      var ses_id=$("#session_selected").val();
      var tec_id=$("#teacher_selected").val();
      var cls_id=$(this).val();

      $.ajax({
        url: '../sourses/manage_evaluation_reports.php',
        type: 'POST',
        data: {session_n:ses_id,teacher_r:tec_id,class_s:cls_id}

      })
      .done(function(data) {
        $("#course_selected").html("");
        // $(".abcd").append(data);
        var ret_data="<option></option>"+data;
        $("#course_selected").append(ret_data);
        $("#course_selected").removeAttr('disabled');
      })
      .fail(function(data) {
        console.log(data);
      })
      .always(function() {
        console.log("complete");
      });
    });
}) ();
// AJAX Request for Compile Report IN Selected Session,Teacher,Course
/*
 * Get the final report Data
 */
(function() {
    $("#course_selected").change(function() {
      // Enable Report Printing Buttons
      $('button').removeAttr('disabled');
      $("#report_table").html("");
      var cou_id=$(this).val();
      var ses_id=$("#session_selected").val();
      var tea_id=$("#teacher_selected").val();
      $.ajax({
        url: '../sourses/manage_evaluation_reports.php',
        type: 'POST',
        data: {ses:ses_id,tea:tea_id,cou:cou_id}
      })
      .done(function(data) {
        // // Empty Table for each Request
        // $("#report_info_pannale").html("");
        // //Summary Header
        // var tr=$('<tr>').append($('<th>').text('Teacher Evaluation Summery').attr('class','text-center').attr('colspan','4'),);
        // tr.attr('class','bg-success');
        // $("#report_info_pannale").append(tr);
        // // Localize Veriable
        // var tech=$( "#teacher_selected option:selected" ).text();
        // var sess=$( "#session_selected option:selected" ).text();
        // var cour=$( "#course_selected option:selected" ).text();
        // // Append Summary Data
        // var tr=$('<tr>').append(
        //   $('<th>').text('Instructer Name').attr('class','text-center'),
        //   $('<td>').text('Mr. '+tech).attr('class','text-center'),
        //
        //   $('<th>').text('Session').attr('class','text-center'),
        //   $('<td>').text(sess).attr('class','text-center'),
        // );
        // $("#report_info_pannale").append(tr);
        //
        // var tr=$('<tr>').append(
        //   $('<th>').text('Course').attr('class','text-center'),
        //   $('<td>').text(cour).attr('class','text-center'),
        //
        //   $('<th>').text('').attr('class','text-center'),
        //   $('<td>').text('').attr('class','text-center'),
        // );
        // $("#report_info_pannale").append(tr);
        //
        // // Append Header of the Report Table
        // var tr=$('<tr>').append(
        //   $('<th>').text('Question').attr('class','text-center'),
        //   $('<th>').text('S.D').attr('class','text-center'),
        //   $('<th>').text('Disagree').attr('class','text-center'),
        //   $('<th>').text('Uncertain').attr('class','text-center'),
        //   $('<th>').text('Agree').attr('class','text-center'),
        //   $('<th>').text('S.A').attr('class','text-center'),
        // );
        // tr.attr('class','bg-success');
        // $("#report_table").append(tr);
        // /**
        //  * Return Data Compile From Here
        //  */
        // var report_data=$.parseJSON(data);
        // counter=0;
        // for (var i = 0; i < report_data[1].length; i++) {
        // counter=i+1;
        // var tr=$('<tr>').append(
        // $('<th>').text(report_data[0][i]),
        // $('<td>').text(report_data[1][i][counter][0]+"%"),
        // $('<td>').text(report_data[1][i][counter][1]+"%"),
        // $('<td>').text(report_data[1][i][counter][2]+"%"),
        // $('<td>').text(report_data[1][i][counter][3]+"%"),
        // $('<td>').text(report_data[1][i][counter][4]+"%"),
        //  ); //.appendTo('#records_table');
        //  $("#report_table").append(tr);
        //   counter=0
        // }
        // /**
        //  * Comments Block
        //  *Apply if comments_check is checked
        //  */
        //
        // if($('#comments_check').is(':checked'))
        // {
        //   var tr=$('<tr>').append($('<th>').text("Comments").attr('colspan','6').attr('class','text-center').attr('class','bg-success'),);
        //    $("#report_table").append(tr);
        //   for (var i = 0; i < report_data[2].length; i++) {
        //     if (report_data[2][i]!='no comments') {
        //       var tr=$('<tr>').append(
        //       $('<td>').text(report_data[2][i]).attr('colspan','6'), ); //.appendTo('#records_table');
        //        $("#report_table").append(tr);
        //     }
        //   }
        // }
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
<!-- GOOD LUCK -->
</html>
