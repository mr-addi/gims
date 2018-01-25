<?php
  /*
    ** this page recievs the ajax request
    ** returns the section related to the sepecific module;
  */
  require_once 'dbconnection.php';
  check_is_ajax( __FILE__ ); //function to check if the request is ajax
  function check_is_ajax( $script = '' ) { //defination of function to check ajax call
      $is_ajax = isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) AND
      strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) === 'xmlhttprequest';
      if( !$is_ajax ) {
          trigger_error( 'Access denied - not an AJAX request...' . ' (' . $script . ')', E_USER_ERROR );
      }
  }

  $module_id=$_POST['param1']; //ajaxically sent data
  $get_data ="SELECT section_id, section_title FROM sections WHERE module_id = '$module_id' AND section_deleted='0'";
  $sections  =  mysqli_query($GLOBALS['con'],$get_data) or die(mysqli_error($GLOBALS['con']));
  while ($section=mysqli_fetch_assoc($sections)) {
?>
    <label for="chbx"><?=$section['section_title']?></label>
    <input class="checkbox-inline section<?=$section['section_id']?>"  id="a<?=$section['section_id']?>" type="checkbox" name="module[<?=$module_id?>][<?=$section['section_id']?>]" style="float:left;" onclick="get_permission(this.value,this.name)" value="<?=$section['section_id']?>">
    <br><hr>
<?php
}

exit;
  /*return_back($string_data);
  function return_back($value='')
  {
    echo $value;
    exit;
  }
*/


?>
