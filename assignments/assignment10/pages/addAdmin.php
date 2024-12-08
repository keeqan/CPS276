<?php

// addAdmin.php
require_once __DIR__ . '/../classes/Db_conn.php';
require_once __DIR__ .'/../classes/Pdo_methods.php';
require_once __DIR__ .'/../classes/StickyForm.php';
require_once __DIR__ . '/../classes/Validation.php';

$db = (new Db_conn())->dbOpen();
$pdoMethods = new PdoMethods($db);
$formData = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $_POST;
    $rules = [
        'adminName' => ['required' => true, 'minLength' => 3, 'maxLength' => 50],
        'adminEmail' => ['required' => true, 'email' => true],
        'adminPassword' => ['required' => true, 'minLength' => 8], // Add password validation
        'adminStatus' => ['required' => true, 'in' => ['admin', 'staff']] // Validate that status is either 'admin' or 'staff'
    ];

    $errors = Validation::validate($rules, $formData);

    if (empty($errors)) {
        // Hash the password before inserting it
        $hashedPassword = password_hash($formData['adminPassword'], PASSWORD_DEFAULT);

        // SQL to insert the admin with the hashed password and status
        $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";
        $params = [
            ':name' => $formData['adminName'],
            ':email' => $formData['adminEmail'],
            ':password' => $hashedPassword,  // Add hashed password
            ':status' => $formData['adminStatus'] // Use the selected status from the form
        ];

        $result = $pdoMethods->execute($sql, $params);

        if ($result === true) {
            $message = "Admin added successfully!";
        } else {
            $message = "Failed to add admin: $result";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<h1>Add Admin</h1>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php?page=addAdmin">Add Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=addContact">Add Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=deleteAdmins">Delete Admins</a></li>
                <li class="nav-item"><a class="nav-link active" href="index.php?page=deleteContact">Delete Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>
<form method="post">
    <div class="form-group">
        <label for="adminName">Name:</label>
        <input type="text" id="adminName" name="adminName" class="form-control" value="<?php echo StickyForm::setValue('adminName'); ?>">
        <small class="text-danger"><?php echo isset($errors['adminName']) ? $errors['adminName'] : ''; ?></small>
    </div>

    <div class="form-group">
        <label for="adminEmail">Email:</label>
        <input type="email" id="adminEmail" name="adminEmail" class="form-control" value="<?php echo StickyForm::setValue('adminEmail'); ?>">
        <small class="text-danger"><?php echo isset($errors['adminEmail']) ? $errors['adminEmail'] : ''; ?></small>
    </div>

    <div class="form-group">
        <label for="adminPassword">Password:</label>
        <input type="password" id="adminPassword" name="adminPassword" class="form-control">
        <small class="text-danger"><?php echo isset($errors['adminPassword']) ? $errors['adminPassword'] : ''; ?></small>
    </div>

    <div class="form-group">
        <label for="adminStatus">Status:</label>
        <select id="adminStatus" name="adminStatus" class="form-control">
            <option value="admin" <?php echo StickyForm::setSelected('adminStatus', 'admin'); ?>>Admin</option>
            <option value="staff" <?php echo StickyForm::setSelected('adminStatus', 'staff'); ?>>Staff</option>
        </select>
        <small class="text-danger"><?php echo isset($errors['adminStatus']) ? $errors['adminStatus'] : ''; ?></small>
    </div>

    <button type="submit" class="btn btn-primary">Add Admin</button>
</form>
<div class="mt-3">
    <small class="text-success"><?php echo isset($message) ? $message : ''; ?></small>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
