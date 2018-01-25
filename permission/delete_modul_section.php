<?php
/*
**Page:THis page Delete the record according to request (actulayy updat status)
**File include:dbconnection
*/
require_once('dbconnection.php');
if(isset($_GET['delete_section']))
{
 $id=$_GET['delete_section'];
 $sql1="UPDATE `sections` SET `section_deleted`=1 WHERE `section_id`=$id";
 mysqli_query($GLOBALS['con'],$sql1) or die(mysqli_error($GLOBALS['con']));
 header("location:add_module_section.php");
}
if(isset($_GET['delete_module']))
{
 $id=$_GET['delete_module'];
 $sql1="UPDATE `modules` SET `module_deleted`=1 WHERE `module_id`=$id";
 mysqli_query($GLOBALS['con'],$sql1) or die(mysqli_error($GLOBALS['con']));
 header("location:add_module_section.php");
}
if(isset($_GET['delete_permission']))
{
 $id=$_GET['delete_permission'];
 $sql1="UPDATE `permissions` SET `permission_deleted`=1 WHERE `permission_id`=$id";
 mysqli_query($GLOBALS['con'],$sql1) or die(mysqli_error($GLOBALS['con']));
 header("location:manage_permissions.php");
}
?>
