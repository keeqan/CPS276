<?php
// login.php
require_once dirname(__DIR__) . '/classes/Db_conn.php';
require_once dirname(__DIR__) . '/classes/Pdo_methods.php';
require_once dirname(__DIR__) . '/classes/Validation.php';

$db = (new Db_conn())->dbOpen();
$pdoMethods = new PdoMethods($db);
$message = "";

// Initialize database with hardcoded test accounts
$testAdmins = [
    [
        'name' => 'Admin User',
        'email' => 'kjmiles@admin.com',
        'password' => password_hash('password', PASSWORD_DEFAULT),
        'status' => 'admin',
    ]
];

// Check and insert accounts if they do not exist
foreach ($testAdmins as $admin) {
    $sql = "SELECT * FROM admins WHERE email = :email";
    $params = [':email' => $admin['email']];
    $result = $pdoMethods->select($sql, $params);

    if (!$result) {
        // Account does not exist, insert into database
        $sql = "INSERT INTO admins (name, email, password, status) 
                VALUES (:name, :email, :password, :status)";
        $params = [
            ':name' => $admin['name'],
            ':email' => $admin['email'],
            ':password' => $admin['password'],
            ':status' => $admin['status'],
        ];
        $insertResult = $pdoMethods->execute($sql, $params);

        // Check for execution error
        if ($insertResult !== true) {
            die("Error inserting admin account: " . $insertResult);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $email = trim($email);
    $password = trim($password);

    if (Validation::checkRequired([$email, $password])) {
        $sql = "SELECT * FROM admins WHERE email = :email";
        $params = [':email' => $email];

        $admin = $pdoMethods->select($sql, $params);

        if ($admin && password_verify($password, $admin[0]['password'])) {
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['admin_name'] = $admin[0]['name'];
            $_SESSION['status'] = $admin[0]['status'];

            header("Location: index.php?page=welcome");
            exit;
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "Both fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Login</h1>
    </div>

    <form method="post" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" 
                   placeholder="Enter kjmiles@admin.com or kjmiles@staff.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <?php if ($message): ?>
        <div class="alert alert-danger mt-3"> <?php echo htmlspecialchars($message); ?> </div>
    <?php endif; ?>
</body>
</html>
