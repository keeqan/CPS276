<?php

// deleteContact.php
require_once __DIR__ . '/../classes/Db_conn.php';
require_once __DIR__ .'/../classes/Pdo_methods.php';

$db = (new Db_conn())->dbOpen();
$pdoMethods = new PdoMethods($db);
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $contactId = $_POST['delete'];
        $sql = "DELETE FROM contacts WHERE id = :id";
        $params = [':id' => $contactId];

        $result = $pdoMethods->execute($sql, $params);

        $message = $result === true ? "Contact deleted successfully!" : "Failed to delete contact: $result";
    }
}

$sql = "SELECT * FROM contacts";
$contacts = $pdoMethods->select($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="bg-light">



<div class="container mt-5">
    <h1 class="mb-4">Delete Contacts</h1>
    <!-- Navigation Bar -->
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

    <?php if ($message): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($contacts && count($contacts) > 0): ?>
                        <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contact['name']); ?></td>
                                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                <td><?php echo htmlspecialchars($contact['phone']); ?></td>
                                <td><?php echo htmlspecialchars($contact['address']); ?></td>
                                <td>
                                    <button type="submit" name="delete" value="<?php echo $contact['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No contacts found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
