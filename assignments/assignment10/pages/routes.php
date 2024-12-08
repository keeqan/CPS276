<?php
// routes.php
require_once '../classes/Db_conn.php';
require_once '../classes/Pdo_methods.php';

// Start the session at the very beginning
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // If not logged in, redirect to the login page
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Routes</h1>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php?page=addAdmin">Add Admin</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=addContact">Add Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=deleteAdmins">Delete Admins</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=deleteContact">Delete Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
        </ul>
    </nav>
</body>
</html>