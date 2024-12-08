<?php
// index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Define the base path
define('BASE_PATH', __DIR__);

// Check the "page" parameter
$page = $_GET['page'] ?? 'welcome'; // Default to 'welcome' if no page is specified

// Handle page routing
switch ($page) {
    case 'login':
        require BASE_PATH . '/pages/login.php';
        break;

    case 'welcome':
        // Check if the user is logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header('Location: index.php?page=login');
            exit();
        }
        require BASE_PATH . '/pages/welcome.php';
        break;

    case 'addAdmin':
        // Ensure the user is logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header('Location: index.php?page=login');
            exit();
        }
        require BASE_PATH . '/pages/addAdmin.php';
        break;

    case 'addContact':
        // Ensure the user is logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header('Location: index.php?page=login');
            exit();
        }
        require BASE_PATH . '/pages/addContact.php';
        break;

    case 'deleteAdmins':
        // Ensure the user is logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header('Location: index.php?page=login');
            exit();
        }
        require BASE_PATH . '/pages/deleteAdmins.php';
        break;

    case 'deleteContact':
        // Ensure the user is logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header('Location: index.php?page=login');
            exit();
        }
        require BASE_PATH . '/pages/deleteContact.php';
        break;

    case 'routes':
        // Ensure the user is logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header('Location: index.php?page=login');
            exit();
        }
        require BASE_PATH . '/pages/routes.php';
        break;

    default:
        echo "Page not found.";
        break;
}
