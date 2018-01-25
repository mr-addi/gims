<?php
// this manuplate the sections related to differnt modules
// including the database connection
require_once('dbconnection.php');

require_once('modules.php');
/*
this class manuplate all the sections
*/
class sections
{
    protected $section_id;
    protected $section_title;
    protected $section_description;
    protected $module_id;
    function __construct(){
    }
    public function get_section_all_data() { //function to get all data of sections
        $get_data =  "SELECT * FROM sections"; //query to get data
        $get_exe  =  mysqli_query($GLOBALS['con'],$select_data);
        return $get_exe;
    }
    public function get_id_title_section($mid) { //get all the ids and titles only
        $get_data ="SELECT section_id, section_title FROM sections WHERE module_id = '$mid' AND section_deleted='0'";
        $get_exe  =  mysqli_query($GLOBALS['con'],$get_data);
        return $get_exe;
    }

}


?>
