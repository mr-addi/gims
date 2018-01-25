<?php
  require_once '../student/upload_images.php';//for student Class loade degrees ONLOAD
  require_once  '../session/manage_session_class.php';
  include_once  'class_course.php';
  //Manage_Session object
  $obj=new Manage_Session();
  $obj1=new Student();
  //Onloade Call Function to get all session data
  $all_session_data=$obj->fetch_all_session();
  $data=$obj1->fetch_onload();
  $counter=0;
  $passout=0;
  //Submit Data Form
  if(isset($_POST['submit_session_form'])){
     $obj2=new class_course_student();
     $session_from=$_POST['session_selected_from'];
     $session_to=$_POST['session_selected_to'];
     $class_from=$_POST['class_from'];
     $class_to=$_POST['class_to'];
     $degree_id=$_POST['degree_selected'];
     $data_array=$obj2->validate_data($session_from,$session_to,$class_from,$class_to,$degree_id);
     // ////////////////////////////
     $counter=1;
     $course=$obj2->class_courses($class_to);
     $dataa=$obj2->student_of_class_by_id($class_from);
     while ($row=mysqli_fetch_assoc($course)) {
       $course_id[]=$row['course_id'];
     }
     $course=$obj2->class_courses($class_to);

    /*
    *error=>0-> Session Error,1-> NO Error,2-> Class Error
    *session
    *classs
    */
     // $data_array['session'];
     // $data_array['class'];
     // switch ($data_array['error']) {
     //  case 0:
     //    echo "<script>alert('Please Select the Write Session')</script>";
     //  break;
     //  case 1:
     //    $counter=1;
     //    $course=$obj2->class_courses($class_to);
     //    $dataa=$obj2->student_of_class_by_id($class_from);
     //    while ($row=mysqli_fetch_assoc($course)) {
     //      $course_id[]=$row['course_id'];
     //    }
     //    $course=$obj2->class_courses($class_to);
     //  break;
     //  case 2:
     //    echo "<script>alert('Please Select the Write Classes')</script>";
     //  break;
     //  case 3:
     //    $counter=1;
     //    $dataa=$obj2->student_of_class_by_id($class_from);
     //    $passout=1;
     //  break;
     //  case 4:
     //    echo "<script>alert('This Class is not Eligible For Passout')</script>";
     //  break;
     //  }
    }
    // Submit submit_course_allocation_form FORM
    $obj3=new class_course_student();
    if (isset($_POST['submit_course_allocation_form'])) {
        $session=$_POST['session'];
        $class=$_POST['class'];
        $student_cout=sizeof($_POST['student']);
        for ($i=0; $i <$student_cout ; $i++) {

          $student_id=$_POST['student'][$i];
          $course=sizeof($_POST["$student_id"]);
          for ($j=0; $j<$course ; $j++) {

            $course_id=$_POST["$student_id"][$j];
            settype($course_id, "integer");
            settype($student_id, "integer");
            settype($session, "integer");
            settype($class, "integer");
            settype($student_id, "integer");
            $filldes=array("student_id","class_id","session_id","course_id");
            $val=array($student_id,$class,$session,$course_id);

            $obj3->set_insert_query("students_classes_courses",$filldes,$val);

            $filldes=array("student_current_session","student_currunt_semester");
            $val=array($session,$class);
            $cond_par= array("student_id","is_deleted");
            $cod_par_val= array($student_id,0);
            $obj3->set_update_query("students",$filldes,$val,$cond_par,$cod_par_val);
          }//internal for
        }//external for
        $filldes=array("class_id","session_id");
        $val=array($class,$session);
        $obj3->set_insert_query("session_classes",$filldes,$val);
      }//main condition
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <title></title>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
   </head>
   <body>
     <div class="jumbotron">
       <h2 class="text-center text-primary">Student Course Allocation</h2>
     </div>
     <!--Open(URL Filter data)  -->
     <div class="container">
       <form class="" action="" method="post">

       <table class="table table-bordered">
         <thead>

           <tr>
             <th colspan="1">Select Degree</th>
             <td colspan="1">
               <!-- Fetch All the degrees onload page -->
               <select class="form-control input-sm" id="deg_id1" name="degree_selected"  required>
                 <option value=""></option>
                 <?php while ($row=mysqli_fetch_assoc($data)) { ?>
                   <option value="<?php echo $row['degree_id'] ?>"><?php echo $row['degree_name'] ?> ( <?php echo $row['degree_subject_name'] ?> )</option>
                 <?php } ?>
               <!--close( Fetch All the degrees onload page )-->
               </select>
             </td>
             <td colspan="2">
               <a title=" Help" id="tooltip" class="btn btn-sm btn-outline-primary rounded-circle float-right " href="#"  data-toggle="modal" data-target="#myModal"   ><span class="glyphicon glyphicon-print"><strong>?</strong></span></a>
             </td>
           </tr>
           <tr>
             <th>Update From</th>
             <td>
               <!--Show Session From URl  -->
               <select class="form-control" name="session_selected_from" id="session_id" required>
                 <option value=""></option>
                 <?php while ($row=mysqli_fetch_assoc($all_session_data)) { ?>
                   <option value="<?php echo $row['session_id']; ?>" ><?php  echo ucwords($row['session_type'])."-".$row['session_year']; ?></option>
                 <?php } ?>
               </select>
             </td>
             <th>To</th>
             <td>
               <!--Show All Sessions (USer Selected)  -->
               <select class="form-control" name="session_selected_to" id="session_id" required>
                 <option value=""></option>
                 <?php
                   $all_session_data=$obj->fetch_all_session();
                 while ($row=mysqli_fetch_assoc($all_session_data)) { ?>
                   <option value="<?php echo $row['session_id']; ?>" ><?php  echo ucwords($row['session_type'])."-".$row['session_year']; ?></option>
                 <?php } ?>
               </select>
             </td>
           </tr>
           <tr>
             <th>From Semester</th>
             <td>
               <!-- Previous Session Get from URL  -->
               <select class="form-control float-left class_dd" name="class_from" required>

               </select>
             </td>
             <th>To</th>
             <td>
               <!-- show Next Semester calculate by____ -->
                <select class="form-control class_dd" id="class_to" name="class_to" required>

                </select>
             </td>
           </tr>
           <tr>
             <td colspan="4" class="">
               <input class="btn active btn-outline-success  form-control"  type="submit" name="submit_session_form" onclick="" value="GO">
             </td>
           </tr>
         </thead>
       </table>
     </form>
     </div>
     <div class="container">
       <hr>
       <hr>
     </div>
     <!--Closed(URL Filter data)  -->
     <!--Open(Show All Students and Subjects of URL Class Data)  -->
    <div class="container">
      <form class="" action="" method="post">
        <?php if ($counter>0) { $counter=0; ?>
          <table class="table table-bordered table-stripped" >
            <tr>
              <?php
                echo "<th class='bg-secondary'>Arid NO</th>
                      <th class='bg-secondary'>Name</th>
                      <th class='bg-secondary'>Eligible For Next Class</th>";
                if ($passout==0) {
                  while ($row=mysqli_fetch_assoc($course)) { ?>
                    <td class="mx-auto"><?php echo $row['course_title']."</br>".$row['course_code']; ?></td>
                  <?php }  } ?>
            </tr>
            <?php
            $class=0;
              while ($row=mysqli_fetch_assoc($dataa)) {
                $class++;
                 ?>
                <tr>
                  <th class="bg-secondary"><?php echo $row['arid_reg_no']; ?></th>
                  <th class="bg-secondary">
                    <?php echo ucwords($row['student_first_name']); ?>
                    <!-- <input type="hidden" name="student[]" value="" checked> -->
                  </th>
                  <td class="bg-secondary">
                     <input class="text-center eligible_student" id="eligible_student_<?php echo $class; ?>" type="checkbox" name="student[]" value="<?php echo $row['student_id'] ?>" checked>
                  </td>
                  <?php
                    if ($passout==0) {
                      $len=sizeof($course_id);
                      for ($i=0; $i <$len ; $i++) { ?>
                        <td>
                          <input type="checkbox" class="eligible_student_<?php echo $class; ?>" name="<?php echo $row['student_id']."[]"; ?>" checked value="<?php echo $course_id[$i];  ?>">
                        </td>
                      <?php } } ?>
                </tr>
              <?php } ?>
          </table>
          <table class="table">
            <tr class="">
              <td class="">
                <input type="hidden" name="session" value="<?php echo $data_array['session'] ?>">
                <input type="hidden" name="class" value="<?php echo $data_array['class'] ?>">
                <input class="active form-control mx-100 btn btn-outline-success" type="submit" name="submit_course_allocation_form" value="Submit">
              </td>
            </tr>
            <tr>
            </tr>
          </table>
        <?php } ?>
      </form>
    </div>
    <!-- Closed(Show All Students and Subjects of URL Class Data)  -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            Modal body..
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
     <script>
     var counter=0;
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
             $(".class_dd").html("");
             $(".class_dd").append(data);
             $("#class_to").append("<option value='1111'>Passout</option>");
             counter++;
           })
           .fail(function(data) {
             console.log(data);
           })
           .always(function() {
             console.log("complete");
           });
         });
     }) ();

     $('.eligible_student').change(
    function (e) {
      var id=$(this).attr('id');
        if ($(this).is(':checked')) {
            $('.'+id).prop('checked',true);
            $('.'+id).prop('disabled',false);
        }
        else {
            $('.'+id).prop('checked',false);
            $('.'+id).prop('disabled',true);
        }
});
$(document).ready(function(){
    $("#tooltip").tooltip();
});
     </script>
   </body>
 </html>
