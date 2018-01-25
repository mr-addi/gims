<?php

  // page to delete the user
  require_once 'dbconnection.php';
  $group_id=$_GET['id'];
  $query="UPDATE groups SET group_deleted='1' WHERE group_id='$group_id'";
  mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con']));
  redirect("groups_page.php");
  function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
  }
?>
