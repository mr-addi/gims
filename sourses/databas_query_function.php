<?php
  /**
   *
   */
  if (!class_exists('Db_Connection')) {
    include 'db_connection.php';
    # code...
  }
  class Db_Query extends Db_Connection
  {

    public function execute($query)
    {
      $data=mysqli_query($this->con,$query);
      return $data;
    }
    public function set_fecth_query($tb,$_filldes,$cond_par,$cond_val)
    {
        $sql="";
        $sql.="SELECT ";
        $len=sizeof($_filldes);
        for ($i=0; $i <$len ; $i++) {
          $_filldes[$i];
          $sql.="`$_filldes[$i]` ";
          $sql.=",";
        }
        $sql=substr($sql, 0, -1);
        $sql.=" FROM ";
        $sql.=" `$tb` "."WHERE ";
        $con_len=sizeof($cond_par);
        if ($con_len==sizeof($cond_val) && $con_len>0) {
          for ($i=0; $i <$con_len ; $i++) {
            if ($con_len>1 && $i>0) {
              $sql.=" AND ";
            }
          $sql.="`$cond_par[$i]`"."="."$cond_val[$i]";
          }
        }
        $data=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
        return $data;
    }

    public function set_insert_query($tb,$_filldes,$values){
        $sql="";
        $sql.="INSERT INTO ";
        $sql.="`$tb`"."(";
        $len_fild=sizeof($_filldes);
        for ($i=0; $i <$len_fild ; $i++) {
          $_filldes[$i];
          $sql.="`$_filldes[$i]` ";
          $sql.=",";
        }
        $sql=substr($sql, 0, -1);
        $sql.=") VALUES (";
        $len_val=sizeof($values);
        if ($len_fild==$len_val) {
          for ($i=0; $i <$len_val ; $i++) {
            $type=gettype($values[$i]);
            if ($type=="string") {
              $sql.="`$values[$i]`".",";
            }else {
              $sql.=$values[$i].",";
            }
          }
        }else {
          echo "query Error";
          exit;
        }
        $sql=substr($sql, 0, -1);
        $sql.=")";
        $response=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
    }

    public function set_update_query($tb,$_filldes,$values,$cond_par,$cond_val){
        $sql="";
        $sql.=" UPDATE ";
        $sql.="`$tb`";
        $len_fild=sizeof($_filldes);
        $len_val=sizeof($values);
        if ($len_fild==$len_val) {
          $sql.=" SET ";
          for ($i=0; $i <$len_val ; $i++) {
            $sql.="`$_filldes[$i]`"."=";
            $type=gettype($values[$i]);
            if ($type=="string") {
              $sql.="`$values[$i]`".",";
            }else {
              $sql.=$values[$i].",";
            }
          }
        }else {
          echo "Parameter Error";
          exit;
        }
        $sql=substr($sql, 0, -1);
         $sql.=" WHERE ";
        $con_len=sizeof($cond_par);
        if ($con_len==sizeof($cond_val) && $con_len>0) {
          for ($i=0; $i <$con_len ; $i++) {
            if ($con_len>1 && $i>0) {
              $sql.=" AND ";
            }
          $sql.=" `$cond_par[$i]`"."="."$cond_val[$i]";
          }
        }

  }
}

 ?>
