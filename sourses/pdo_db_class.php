<?php
// require('../constant_defined\db_constants.php');
class Database {
    private $host      = "localhost";
    private $user      = "root";
    private $pass      = "";
    private $dbname    = "masterdb2";

    private $dbh;
    private $error;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);

        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
        return $this->dbh;
    }

    //preparing a query
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }


    //binding the values with the preoared $query
    public function bind($param, $value, $type = null){
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }


    //execute prepared query
        public function execute(){
                return $this->stmt->execute();
            }

    //geting multiple rows the result set
        public function resultset(){
                $this->execute();
                return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            }

    //getting sigle row result record
        public function single(){
                $this->execute();
                return $this->stmt->fetch(PDO::FETCH_BOTH);
            }

    //count the no of effected rows
        public function rowCount(){
                return $this->stmt->rowCount();
            }

    //get the last inserted id
        public function lastInsertId(){
                return $this->dbh->lastInsertId();
            }
    //to real escape any input string
    public function qoute_string($var)
    {
        return $this->dbh->quote($var);
    }

        // //To begin a transaction:
        // public function beginTransaction(){
        //         return $this->dbh->beginTransaction();
        //     }

        // //To end a transaction and commit your changes:
        // public function endTransaction(){
        //         return $this->dbh->commit();
        //     }

        // //To cancel a transaction and roll back your changes:
        // public function cancelTransaction(){
        //         return $this->dbh->rollBack();
        //     }

        // //geting dump pdo parameter
        // public function debugDumpParams(){
        //         return $this->stmt->debugDumpParams();
        //     }


}


// $database = new Database();
// $database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');
// $database->bind(':fname', 'John');
// $database->bind(':lname', 'Smith');
// $database->bind(':age', '24');
// $database->bind(':gender', 'male');
// $database->execute();
 ?>
