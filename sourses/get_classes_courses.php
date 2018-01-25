<?php
/*
** this page recievs the ajax request
** returns the permissions;
*/
check_is_ajax( __FILE__ ); //function to check if the request is ajax
function check_is_ajax( $script = '' ) { //defination of function to check ajax call
  $is_ajax = isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) AND
  strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) === 'xmlhttprequest';
  if( !$is_ajax ) {
    trigger_error( 'Access denied - not an AJAX request...' . ' (' . $script . ')', E_USER_ERROR );
  }
}
require_once('dbconnection.php');
require_once('courses_class.php');
$crs_obj=new course();
$param      = $_POST['param1'];
$term_id  =$_POST['param2'];
$crs_id_qry="SELECT `course_id` FROM `classes_courses` WHERE `class_id`='$param'";
$exe_crs_id_qry=mysqli_query($GLOBALS['con'],$crs_id_qry) or die(mysqli_error($GLOBALS['con']));
if($term_id!="check_box"){
?>
<thead>
  <tr>
    <th>Paper Type</th>
    <th>Course Code</th>
    <th>Course Title</th>
    <th>Date</th>
    <th>Time From</th>
    <th>Time To</th>
  </tr>
</thead>
<tfoot>
  <td colspan="6"><input type="submit" name="sumbit" value="Submit" class="form-control btn btn-success"></td>
</tfoot>
<tbody>
<?php
$i=0;
while ($crs_id=mysqli_fetch_assoc($exe_crs_id_qry)) {
  $id=$crs_id['course_id'];
  $result=$crs_obj->get_all_courses_by_id($id);
  $res=mysqli_fetch_assoc($result);
  ?>
<?php if ($term_id==1 || $res['course_lab']==1){ ?>
  <tr>
    <td>
      Theory
      <input type="hidden" name="date_sheet[<?= $i ?>][]" value="1">
    </td>
    <td>
      <?= $res['course_code'] ?>
      <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $res['course_code'] ?>">
    </td>
    <td>
      <?= $res['course_title'] ?>
      <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $res['course_title'] ?>">
    </td>
    <td><input type="date" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
    <td><input type="time" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
    <td><input type="time" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
  </tr>
<?php $i=$i+1; } elseif ($term_id==2 && $res['course_lab']==2 || $res['course_lab']==3) { ?>
  <tr>
    <td colspan="6">
        <tr>
          <td>
            Theory
            <input type="hidden" name="date_sheet[<?= $i ?>][]" value="1">
          </td>
          <td>
            <?= $res['course_code'] ?>
            <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $res['course_code'] ?>">
          </td>
          <td>
            <?= $res['course_title'] ?>
            <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $res['course_title'] ?>">
          </td>
          <td><input type="date" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
          <td><input type="time" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
          <td><input type="time" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
        </tr>
        <?php $i=$i+1; ?>
        <tr>
          <td>
            Practical
            <input type="hidden" name="date_sheet[<?= $i ?>][]" value="2">
          </td>
          <td>
            <?= $res['course_code'] ?>
            <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $res['course_code'] ?>">
          </td>
          <td>
            <?= $res['course_title'] ?>
            <input type="hidden" name="date_sheet[<?= $i ?>][]" value="<?= $res['course_title'] ?>">
          </td>
          <td><input type="date" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
          <td><input type="time" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
          <td><input type="time" name="date_sheet[<?= $i ?>][]" class="form-control" required></td>
        </tr>
    </td>
  </tr>
<?php
$i=$i+1;
}
}
?>
</tbody>

<?php
}
else{
  while($cor_id=mysqli_fetch_assoc($exe_crs_id_qry)){
    $cid=$cor_id['course_id'];
    $result1=$crs_obj->get_all_courses_by_id($cid);
    $res1=mysqli_fetch_assoc($result1);
    ?>
      <label for="course_code" class="form-control"><input type="checkbox" name="course_code[]" value="<?= $cid ?>"> <?= $res1['course_title'] ?> / <?= $res1['course_code'] ?> </label><br>
    <?php
  }
}
exit;
?>
