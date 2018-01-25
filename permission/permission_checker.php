<?php
// session_start();
// $_SESSION['perm']=[1,2,3,4,5];
function permission_chcker($permission)
{
  foreach ($_SESSION['perm'] as $key => $value) {
    if ($value==$permission) {
      return "true";
    }
  }
  return "false";
}



?>
