<?php
  //**this page has the class of permissions
  //file included for database connection
  require_once('dbconnection.php');

class permissions
{
  protected $permission_id;
  protected $permission_name;
  protected $permission_description;
  function __construct()
  {

  }
  public function add_permission($per_name ,$per_desc) { //function for data insertion
    echo "string <br>";
    $per_title        =mysqli_real_escape_string($GLOBALS['con'],$per_name);//escaping the unauthorized enteries
    $per_description  =mysqli_real_escape_string($GLOBALS['con'],$per_desc);//escaping the unauthorized enteries
    echo $per_title ."<br>" ;
    echo $per_description . "<br>";
    $perm_query       ="INSERT INTO permissions ( permission_title , permission_description ) VALUES ('$per_title' , '$per_description')";  //query to imsert only new permissons
    mysqli_query($GLOBALS['con'],$perm_query) or die("Error in inserting the data"); //executing the query
  }
  public function get_all_permissions() { //function for getting all permissions
    $get_query  ="SELECT * FROM permissions WHERE permission_deleted='0'";
    $get_data   =mysqli_query($GLOBALS['con'],$get_query) or die(mysqli_error($GLOBALS['con']));
    return $get_data;
  }
  public function perm_title($value)
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
}


 ?>
