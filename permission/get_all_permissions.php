<?php
/*
** this page recievs the ajax request
** returns the permissions;
*/
check_is_ajax( __FILE__ ); //function to check if the request is ajax
function check_is_ajax( $script = '' ) { //defination of function to check ajax call
  $is_ajax = isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) AND
  strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) === 'xmlhttprequest';
  if( !$is_ajax ) {
    trigger_error( 'Access denied - not an AJAX request...' . ' (' . $script . ')', E_USER_ERROR );
  }
}
require_once('dbconnection.php');

$param      = $_POST['param1'];
$param2     = $_POST['param2']; //parameters send by ajax request
$query      = "SELECT permission_id FROM module_section_permissions WHERE section_id='$param'";
$query_exe  = mysqli_query($GLOBALS['con'],$query) or die(mysqli_error($GLOBALS['con']));


function perm_title($value)
{
  $get_query  ="SELECT permission_title FROM permissions WHERE permission_deleted='0' AND permission_id='$value'";
  $get_data   = mysqli_query($GLOBALS['con'],$get_query) or die(mysqli_error($GLOBALS['con']));
  $count=mysqli_num_rows($get_data);
  if($count>0) {
    return $get_data;
  } else {
    return 0;
  }
}
while ($permission_id=mysqli_fetch_assoc($query_exe)) {

  $data = perm_title($permission_id['permission_id']);
  if ($data) {
    $permission_title = mysqli_fetch_assoc($data); //creatting the prmissions checkboxs
    ?>
    <div class="<?= $param ?>" style="display:inline;float:right;padding:3px;">
      <label for="permission[]">
        <input type="checkbox" class="checkbox-inline" name="<?=$param2?>[<?= $permission_id['permission_id'] ?>]" value="<?= $permission_id['permission_id'] ?>" />
        <?= $permission_title['permission_title']; ?>
      </label>
    </div>

    <?php
  }
}

exit;
?>
