<?php

/**
 * This class validate form data according to situation
 */
class validate
{
  public function validate_required($post_filldes,$_required)
  {
      $error= array();
      $len_required_array=sizeof($_required);
      for ($i=0; $i <$len_required_array ; $i++) {
          if (isset($post_filldes[$_required[$i]])) {
          }else {
            $error="error";
            return $error;
            break;
          }
      }
  }

}

// $obj=new validate();
// $res=$obj->validate_required();
// if (isset($res)) {
//   echo "Error";
// }else {
//   echo "Okkk";
// }

 ?>
