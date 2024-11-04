<?php
class DatabaseConn {
    protected $conn;

    public function dbOpen() {
        try {
            $dbHost = 'localhost'; // Update with your DB host
            $dbName = 'kjmiles'; // Update with your DB name
            $dbUsr = 'kjmiles'; // Update with your DB user
            $dbPass = 'b9b7VeqqaF7e'; // Update with your DB password

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
