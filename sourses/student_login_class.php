<?php 
@session_start();
require_once('pdo_db_class.php');
class students_logins{
    private $student_login_id;
    private $student_login_name;
    private $student_login_password;
    private $password_reset_status;
    private $student_id;
    private $is_deleted;
    private $creation_date;
    private $updation_date;
    public static $connection;
    public function __construct()
    {
        students_logins::$connection=NULL;  
        students_logins::$connection = new Database();
        //  print_r(students_logins::$connection);
    }
    public function check_login_access($user_name,$password)
    {
        $result=0;
        $quer=students_logins::$connection->query("SELECT `student_login_id`,`student_id`,`password_reset_status` 
                    FROM `students_logins`  WHERE `student_login_name` = '$user_name'
                    AND `student_login_password` = '$password'
                     AND `is_deleted` = 0 ");
        // students_logins::$connection->bind(':user_name',$user_name);
        // students_logins::$connection->bind(':password',"16-Arid-2");
        $res=students_logins::$connection->resultset();
       foreach ($res as $key => $value) {
           $result=$value;
           
       }

        return $result;
    }
    public function reset_login_password($user_name,$password)
    {
        $update_query=students_logins::$connection->query("UPDATE `students_logins` 
                        SET `student_login_password`='$password',`password_reset_status`= 1 
                        WHERE `student_login_name`='$user_name'");
        $responce = students_logins::$connection->execute();
        $_SESSION['reset_status']=1;
        return $responce;
    }

}

?>