<?php
/**
 *
 */
class fetch_record
{

  function __construct()
  {

  }
  public function fetch_complete_table($table)
  {
    $con=mysqli_connect("localhost","root","","mydbums") or die("unable to connet");
    $sql="SELECT * FROM ".$table;
    $data=mysqli_query($con,$sql) or die(mysqli_error($con));
    return $data;
  }
}
$s="modules";
$obj=new fetch_record;
$row=$obj->fetch_complete_table($s);
foreach ($row as $a) {
echo $a['module_title']."<br>";
}

 ?>
