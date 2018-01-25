<?php

// delete table
if (isset($_GET['emp_id'])) {
  require_once '../sourses/teachers_class.php';
  $tec_obj=new teacher();
  $tec_obj->delete_teacher($_GET['emp_id']);
}else {
  echo "Sorry";
}

 ?>
