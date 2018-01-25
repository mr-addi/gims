<?php
require_once 'classes_class.php';
$cls_obj=new classes();

if (isset($_POST['param1'])) {
  $session_id=$_POST['param1'];
  $result=$cls_obj->select_classes_by_function($session_id);
  while ($clas=mysqli_fetch_assoc($result)) {
    ?>
    <option value="<?= $clas['class_id'] ?>"><?= $clas['class_name'] ?></option>
    <?php
  }

}
if (isset($_POST['param_course'])) {
  $session_id=$_POST['param_course'];
  $result=$cls_obj->get_course_by_class($session_id);
  while ($clas=mysqli_fetch_assoc($result)) {
    ?>
    <option value="<?= $clas['course_id'] ?>"><?= "(".$clas['course_code'].")".$clas['course_title']; ?></option>
    <?php
  }
}

exit;
?>
