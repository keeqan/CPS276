<?php

class Db_conn {
    private $conn;

    public function dbOpen() {
        try {
            $dbHost = 'localhost'; 
            $dbName = 'kjmiles';  // Replace with your database name if different
            $dbUser = 'kjmiles';  // Replace with your username
            $dbPass = 'b9b7VeqqaF7e'; // Replace with your password

            // Set up the connection
            $this->conn = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName, $dbUser, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
            $this->conn->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}

?>
