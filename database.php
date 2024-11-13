<?php
class DBConnection{
 
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'student_awareness_db';
 
    public $conn;

    public function __construct(){
 
        if (!isset($this->conn)) {
 
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
 
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            } 
              // Set character set and charset here
        $this->conn->set_charset("utf8");          
        }    
 
    }
    public function __destruct(){
        $this->conn->close();
    }
}
?>
