<?php
  /**
   *
   */
  class Db_Connection
  {
    protected $con;
    public function __construct()
    {
       $this->con =mysqli_connect("localhost","root","","masterdb2") or die("unable to connet");
    }
  }
 ?>
