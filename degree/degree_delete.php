<?php
require_once '..\sourses\degree_class.php';
$deg_obj=new degree();
$deg_obj->delete_degree($_GET['id']);

?>
