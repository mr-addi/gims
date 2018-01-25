<?php
require_once '..\sourses\courses_class.php';
$deg_obj=new course();
$deg_obj->delete_course($_GET['id']);

?>
