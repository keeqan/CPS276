<?php
class DatabaseConn {
    protected $conn;

    public function dbOpen() {
        try {
            $dbHost = 'localhost'; 
            $dbName = 'kjmiles'; 
            $dbUsr = 'kjmiles'; 
            $dbPass = 'b9b7VeqqaF7e'; 

            $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsr, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}
?>
