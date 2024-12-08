<?php

// pdo_methods.php
class PdoMethods {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function select($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function execute($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

?>
