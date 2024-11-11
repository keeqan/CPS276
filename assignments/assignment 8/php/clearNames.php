<?php
require_once '../classes/Pdo_methods.php';

$response = new stdClass();
$pdo = new PdoMethods();

$sql = "DELETE FROM names";
$result = $pdo->otherNotBinded($sql);

if ($result === 'noerror') {
    $response->masterstatus = 'success';
    $response->msg = 'All names cleared successfully';
} else {
    $response->masterstatus = 'error';
    $response->msg = 'Failed to clear names';
}

echo json_encode($response);

?>