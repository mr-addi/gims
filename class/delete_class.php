<?php
  $cls_id=$_GET['cls_id'];

  require_once '..\sourses\classes_class.php';
  $cls_obj=new classes();
  $cls_obj->delete_class($cls_id);
?>
