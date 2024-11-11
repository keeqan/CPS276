<?php
require_once '../classes/Pdo_methods.php';

$response = new stdClass();
$pdo = new PdoMethods();

$sql = "SELECT name FROM names ORDER BY name ASC";
$result = $pdo->selectNotBinded($sql);

if ($result === 'error') {
    $response->masterstatus = 'error';
    $response->msg = 'Failed to retrieve names';
} else {
    $response->masterstatus = 'success';
    $names = '';
    foreach ($result as $row) {
        $names .= "<p>{$row['name']}</p>";
    }
    $response->names = $names;
}

echo json_encode($response);


?>