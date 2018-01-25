<?php
//file included for database connection
require_once('dbconnection.php');
/*
its the class about all modules
 */
class modules
{
  protected $modul_name;
  protected $modul_discription;
  function __construct(){
  }
  public function add_module($name,$desc) { // creating new module
    $mod_title        =mysqli_real_escape_string($GLOBALS['con'],$name);//escaping the unauthorized enteries
    $mod_description  =mysqli_real_escape_string($GLOBALS['con'],$desc);//escaping the unauthorized enteries
    echo $mod_title;
    echo "<br>".$mod_description;

  }
  public function get_all_modules() { //getting all modules data
    $get_query  ="SELECT * FROM modules WHERE module_deleted=0 ORDER BY module_id DESC";
    $get_exe    =mysqli_query($GLOBALS['con'],$get_query) or die(mysqli_error($GLOBALS['con']));
    return $get_exe;
  }
}

 ?>
