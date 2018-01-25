<?php
require_once('dbconnection.php');
 $moduleid=$_POST['param1'];
 $sql="SELECT `section_id`, `section_title` FROM `sections` WHERE `module_id`='$moduleid' AND `section_deleted`=0";
 $fetch_all_sections=mysqli_query($GLOBALS['con'],$sql) or die(mysqli_error($GLOBALS['con']));
 while ($row=mysqli_fetch_assoc($fetch_all_sections)) {
    ?>
    <option value="<?=$row['section_id'] ?>"><?=$row['section_title'] ?></option>
    <?php
 }
 exit;
 ?>
