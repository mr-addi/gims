<?php
/*
*=================================================
*               EVALUATION REPORTS
*=================================================
*
*This page provide the Interface for teacher Evaluation report
*This page genrate the Teacher Evaluation Reports
*
*/
// For get all session onload
require '../session/manage_session_class.php';//include (1)
$obj1=new Manage_Session();
$get_all_session=$obj1->fetch_all_session();
session_start();
$_SESSION['course_evaluation']="a";
// include Header//
//Set Header Required variables
$title="Evaluation Reports";
$home="../index.php";
$active="Reports";
$next_link="";
$next_content="";
require '../sourses/header.php';
//  ?>
  <div class="container">
    <div class="row">
      <div class="container">
    <form class="" action="" method="post">
      <table class="table table-bordered">
        <tr>
          <th colspan="2" class="text-center bg-success">Teacher Evaluation Report</th>
        </tr>
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
        <tr>
          <th>Select Teacher</th>
          <td>
            <select class="form-control" id="teacher_selected" name="session_report" disabled>
              <option value=""></option>
            </select>
          </td>
        </tr>
        <tr>
          <th>Select Course</th>
          <td>
            <select class="form-control" id="course_selected" name="session_report" disabled>
              <option value=""></option>
            </select>
          </td>
        </tr>
      </table>
    </form><!--Main Form-->
    <table class="table table-bordered" id="report_info_pannale">

    </table>
    <!--Report Pannale  -->
    <table class="table table-bordered" id="exportTable">
      <tbody id="report_table">
      </tbody>
    </table>
    </div>
  </div><!--End of row-->
</div><!--End of container-->
<div class="" id="check">

</div>

<script>

function print_data(){
var table_data=document.getElementById('exportTable');

var mywindow = window.open('');
       mywindow.document.write('<html><head><title>my div</title>');
       mywindow.document.write('<link rel="stylesheet" href="main.css" />');
       mywindow.document.write('</head><body >');
       mywindow.document.write(table_data.outerHTML);
       mywindow.document.write('</body></html>');
       mywindow.ducument.close();
       mywindow.focus();
       mywindow.print();
       mywindow.close();
}
//AJAX Request for Teacher in session
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
        $("#teacher_selected").removeAttr('disabled');
        $("#teacher_selected").html("");

        $("#teacher_selected").append(data);
      })
      .fail(function(data) {
        console.log(data);
      })
      .always(function() {
        console.log("complete");
      });
    });
}) ();
// AJAX request for Courses for a teacher
(function() {
    $("#teacher_selected").change(function() {
      $("#course_selected").html("");
      var ses_id=$(this).val();
      var tec_id=$("#session_selected").val();
      $.ajax({
        url: '../sourses/manage_evaluation_reports.php',
        type: 'POST',
        data: {session:ses_id,teacher:tec_id}
      })
      .done(function(data) {
        $("#course_selected").html("");

        $("#course_selected").append(data);
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
// AJAX Request for Complete report
/*
 * Get the final report Data
 */
(function() {//Call for final report Print
    $("#course_selected").change(function() {
      $("#report_table").html("");//Table to be feeded
      // Localize the Selected value
      var cou_id=$(this).val();
      var ses_id=$("#session_selected").val();
      var tea_id=$("#teacher_selected").val();
      // POST Request
      $.ajax({
        url: '../sourses/manage_evaluation_reports.php',
        type: 'POST',
        data: {ses:ses_id,tea:tea_id,cou:cou_id}
      })
      //Get Response From Request
      .done(function(data) {
        $("#report_info_pannale").html("");
        var tr=$('<tr>').append(
          $('<th>').text('Teacher Evaluation Summery').attr('class','text-center').attr('colspan','4'),
        );
        tr.attr('class','bg-success');
        $("#report_info_pannale").append(tr);
        // Localize The Variable (Get text of Selected option)
        var tech=$( "#teacher_selected option:selected" ).text();
        var sess=$( "#session_selected option:selected" ).text();
        var cour=$( "#course_selected option:selected" ).text();
        var tr=$('<tr>').append(
          $('<th>').text('Instructer Name').attr('class','text-center'),
          $('<td>').text('Mr. '+tech).attr('class','text-center'),

          $('<th>').text('Session').attr('class','text-center'),
          $('<td>').text(sess).attr('class','text-center'),
        );
        $("#report_info_pannale").append(tr);

        var tr=$('<tr>').append(
          $('<th>').text('Course').attr('class','text-center'),
          $('<td>').text(cour).attr('class','text-center'),

          $('<th>').text('').attr('class','text-center'),
          $('<td>').text('').attr('class','text-center'),
        );
        $("#report_info_pannale").append(tr);

        // Append Header of the Table
        var tr=$('<tr>').append(
          $('<th>').text('Question').attr('class','text-center'),
          $('<th>').text('S.D').attr('class','text-center'),
          $('<th>').text('Disagree').attr('class','text-center'),
          $('<th>').text('Uncertain').attr('class','text-center'),
          $('<th>').text('Agree').attr('class','text-center'),
          $('<th>').text('S.A').attr('class','text-center'),
        );
        tr.attr('class','bg-success');
        $("#report_table").append(tr);

        // Create the Report Information Pannale
        //
        /*
         * Report Dynamic Data Printing Start
         */
         //Parese To Jason
        var report_data=$.parseJSON(data);
        console.log(report_data);
        // Report Record Manupulation
        counter=0;
        for (var i = 0; i < report_data[1].length; i++) {
        counter=i+1;
        if (i<29) {
          var tr=$('<tr>').append(
          $('<th>').text(report_data[0][i]),
          $('<td>').text(report_data[1][i][counter][0]+"%"),
          $('<td>').text(report_data[1][i][counter][1]+"%"),
          $('<td>').text(report_data[1][i][counter][2]+"%"),
          $('<td>').text(report_data[1][i][counter][3]+"%"),
          $('<td>').text(report_data[1][i][counter][4]+"%"),
           ); //.appendTo('#records_table');
        }else{
          switch (i) {
            case 29:
            var tr=$('<tr>').append(
              $('<th>').text(report_data[0][i]),
              $('<td>').text("Full Time "+" "+report_data[1][i][counter][0]+"%"),
              $('<td>').text("Part Time"+report_data[1][i][counter][1]+"%"),
              $('<td>').text(''),
              $('<td>').text(''),
              $('<td>').text(''),
            );
              break;
            case 30:
            var tr=$('<tr>').append(
              $('<th>').text(report_data[0][i]),
              $('<td>').text("Yes"+" "+report_data[1][i][counter][0]+"%"),
              $('<td>').text("No "+" "+report_data[1][i][counter][1]+"%"),
              $('<td>').text(''),
              $('<td>').text(''),
              $('<td>').text(''),
            );
              break;
              case 31:
              var tr=$('<tr>').append(
                $('<th>').text(report_data[0][i]),
                $('<td>').text("Gujrat"+" "+report_data[1][i][counter][0]+"%"),
                $('<td>').text("Other "+" "+report_data[1][i][counter][1]+"%"),
                $('<td>').text(''),
                $('<td>').text(''),
                $('<td>').text(''),
              );
                break;
              case 32:
              var tr=$('<tr>').append(
                $('<th>').text(report_data[0][i]),
                $('<td>').text("Male"+" "+report_data[1][i][counter][0]+"%"),
                $('<td>').text("Female"+" "+report_data[1][i][counter][1]+"%"),
                $('<td>').text(''),
                $('<td>').text(''),
                $('<td>').text(''),
              );
                break;
              case 33:
              var tr=$('<tr>').append(
                $('<th>').text(report_data[0][i]),
                $('<td>').text("Less than "+"22 "+report_data[1][i][counter][0]+"%"),
                $('<td>').text("22-29"+" "+report_data[1][i][counter][1]+"%"),
                $('<td>').text("over"+" 29"+report_data[1][i][counter][1]+"%"),
                $('<td>').text(''),
                $('<td>').text(''),
              );
                break;
              case 34:
              var tr=$('<tr>').append(
                $('<th>').text(report_data[0][i]),
                $('<td>').text("Collaborative"+report_data[1][i][counter][0]+"%"),
                $('<td>').text(''),
                $('<td>').text(''),
                $('<td>').text(''),
                $('<td>').text(''),
              );
                break;
            }
        }

         $("#report_table").append(tr);
          counter=0
        }

        // Comment section heading
        var tr=$('<tr>').append(
        $('<th>').text("Comments").attr('colspan','6').attr('class','text-center').attr('class','').addClass('text-white').addClass('bg-primary'),
         );
         $("#report_table").append(tr);

        // Cooments Manupulation


          for ( var j = 0; j <8; j++) {
            switch (j) {
              case 0:
              var tr=$('<tr>').append($('<th>').text("Course Content and Organization").attr('colspan','6').attr('class','bg-warning'),);
                  $("#report_table").append(tr);
                break;
                case 1:
                var tr=$('<tr>').append($('<th>').text("Student Contribution").attr('colspan','6').attr('class','bg-warning'),);
                    $("#report_table").append(tr);
                  break;
                case 2:
                var tr=$('<tr>').append($('<th>').text("Learning Environment and Teaching Methods ").attr('colspan','6').attr('class','bg-warning'),);
                    $("#report_table").append(tr);
                  break;
                case 3:
                var tr=$('<tr>').append($('<th>').text("Learning Resources ").attr('colspan','6').attr('class','bg-warning'),);
                    $("#report_table").append(tr);
                  break;
                case 4:
                var tr=$('<tr>').append($('<th>').text("Learning Resources ").attr('colspan','6').attr('class','bg-warning'),);
                    $("#report_table").append(tr);
                  break;
                case 5:
                var tr=$('<tr>').append($('<th>').text("Assessment").attr('colspan','6').attr('class','bg-warning'),);
                    $("#report_table").append(tr);
                  break;
                case 6:
                var tr=$('<tr>').append($('<th>').text("Instructor / Teaching Assistant Evaluation").attr('colspan','6').attr('class','bg-warning'),);
                    $("#report_table").append(tr);
                  break;
                case 7:
                var tr=$('<tr>').append($('<th>').text("Tutorial").attr('colspan','6').attr('class','bg-warning'),);
                    $("#report_table").append(tr);
                  break;
              default:
            }
            for (var k = 0; k <6; k++) {
              if (report_data[2][j][k]!="no comment") {
                var tr=$('<tr>').append($('<td>').text(report_data[2][j][k]).attr('colspan','6'),);
                 $("#report_table").append(tr);
              }

            }
          }


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
</html>
