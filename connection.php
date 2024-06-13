<?php
class Connection {
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "prectice";
    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // echo "Connected successfully";
    }
}

$conn = new Connection();
?>
