
<?php
//title: function to check the permissions of the user

if ($_SESSION['perm']=="") {
  redirect("login_user.php");
} else {
    function section_checker($module_name) {
      $array=null;
      $i=0;
      foreach ($_SESSION['perm'] as $key => $value) {
        $temp=explode("@", $value);
        if($temp[0]==$module_name){
          $array[$i]=$temp[1];
        }
        $i=$i+1;
      }
       $all_sections=array_unique($array);

       // $links='<ul type="square" class=" bg-inverse"> ';
       // foreach ($array1 as $key => $value) {
       //   $query="SELECT section_url FROM sections WHERE section_title='$value'";
       //   $res=mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con']));
       //   while ($row=mysqli_fetch_assoc($res)) {
       //     $links .= "<li><a href=\"$row[section_url]?\" style=\"color:white;\">$value</a></li>";
       //   }
       // }
       // $links .= "</ul>";
       return $all_sections;
    }
}

?>
