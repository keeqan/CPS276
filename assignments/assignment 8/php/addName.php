<?php
require_once '../classes/Pdo_methods.php';

$response = new stdClass();
if (isset($_POST['data'])) {
    $data = json_decode($_POST['data']);
    $fullName = trim($data->name);
    
    // Split the name into first and last
    if (strpos($fullName, ' ') !== false) {
        list($first, $last) = explode(' ', $fullName, 2);
        $formattedName = "$last, $first";

        $pdo = new PdoMethods();
        $sql = "INSERT INTO names (name) VALUES (:name)";
        $bindings = [
            [':name', $formattedName, 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'noerror') {
            $response->masterstatus = 'success';
            $response->msg = 'Name added successfully';
        } else {
            $response->masterstatus = 'error';
            $response->msg = 'Failed to add name';
        }
    } else {
        $response->masterstatus = 'error';
        $response->msg = 'Please enter both first and last names';
    }
} else {
    $response->masterstatus = 'error';
    $response->msg = 'No name data received';
}

echo json_encode($response);


?>