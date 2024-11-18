<?php
require_once '../classes/Db_conn.php';

$message = '';
$notes = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $begDate = $_POST['begDate'];
        $endDate = $_POST['endDate'];

        if (empty($begDate) || empty($endDate)) {
            $message = "Please select both a beginning and ending date.";
        } else {
            $db = new Db_conn();
            $pdo = $db->dbOpen();

            // Query 
            $sql = "SELECT date_time, note 
                    FROM note 
                    WHERE date_time >= :begDate 
                      AND date_time < DATE_ADD(:endDate, INTERVAL 1 DAY)
                    ORDER BY date_time DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':begDate' => $begDate,
                ':endDate' => $endDate,
            ]);

            $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($notes)) {
                $message = "No notes found for the selected date range.";
            }
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

