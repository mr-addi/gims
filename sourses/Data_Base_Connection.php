<?php 
    class database_connection {
        private static $server_name='localhost'; 
        private static $user='root';
        private static $password="";
        private static $database="masterdb2";
        private $connection;
        private function __construct(){
            $this->connection=mysqli_connect(database_connection::$server_name,database_connection::$user,database_connection::$password,database_connection::$database);
        }

        public static function get_connection(){
            $conn = new database_connection();
            return $conn;
        }
    private function __distruct()
    {
        $this->connection=NULL;
    }



    }
    
?>