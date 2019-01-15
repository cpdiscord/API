<?php
class Database{

//connection details
    //--- REMOVE BEFORE PUSHING TO GITHUB ----
    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root";
    private $password = "";
    //--- REMOVE BEFORE PUSHING TO GITHUB ----\\


    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
