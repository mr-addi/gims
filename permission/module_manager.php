<?php
//title: function to check the permissions of the user

if ($_SESSION['perm']=="") {
  redirect("login_user.php");
} else {
    function permission_checker() {
      $i=0;
      foreach ($_SESSION['perm'] as $key => $value) {
        $temp=explode("@", $value);
        $array[$i]=$temp[0];
        $i=$i+1;
      }
      $module=array_unique($array);
      // $links='<ul type="square">';
      // foreach ($array1 as $key => $value) {
      //   $query="SELECT module_url FROM modules WHERE module_title='$value'";
      //   $res=mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con']));
      //   while ($row=mysqli_fetch_assoc($res)) {
      //     $links .= "<li><a href=\"$row[module_url]?name=$value\" style=\"color:white\">$value</a></li>";
      //   }
      // }
      // $links .= "</ul>";
      return $module;
    }
}

?>
