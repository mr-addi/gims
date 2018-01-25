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

$param  = $_POST['param1'];
$select_classes_id="SELECT `class_id` FROM `session_classes` WHERE `session_id`= '$param' ORDER BY `class_id` ASC ";
$exe_select_classes_id=mysqli_query($GLOBALS['con'],$select_classes_id) or die(mysqli_error($GLOBALS['con']));
echo "<option> Select Class </option>";
while ($class_id=mysqli_fetch_assoc($exe_select_classes_id)) {
  $class_idd=$class_id['class_id'];
  $select_classes="SELECT `class_id`,`class_name` FROM `classes` WHERE `class_deleted`='0' AND `class_id`='$class_idd'";
  $exe_select_classes=mysqli_query($GLOBALS['con'],$select_classes) or die(mysqli_error($GLOBALS['con']));

  while ($class=mysqli_fetch_assoc($exe_select_classes)) {
    ?>
      <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
    <?php
  }

}

exit;
?>
