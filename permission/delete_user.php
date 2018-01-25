<?php

  // page to delete the user
  require_once 'dbconnection.php';
  $user_id=$_GET['id'];
  $query="UPDATE users SET user_deleted='1' WHERE user_id='$user_id'";
  mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con']));
  redirect("users.php");
  function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
  }
?>
