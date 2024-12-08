<?php

// addContact.php
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
        'contactName' => ['required' => true, 'minLength' => 3, 'maxLength' => 50],
        'contactEmail' => ['required' => true, 'email' => true],
        'contactPhone' => ['required' => true, 'pattern' => '/^\d{3}-\d{3}-\d{4}$/'],
        'address' => ['required' => true, 'minLength' => 5, 'maxLength' => 255],
        'city' => ['required' => true, 'minLength' => 2, 'maxLength' => 100],
        'state' => ['required' => true, 'minLength' => 2, 'maxLength' => 50],
        'dob' => ['required' => true, 'pattern' => '/^\d{4}-\d{2}-\d{2}$/'],
        'contacts' => ['required' => true],
        'age' => ['required' => true, 'number' => true]
    ];
    
    $errors = Validation::validate($rules, $formData);

    if (empty($errors)) {
        $sql = "INSERT INTO contacts (name, email, phone, address, city, state, dob, contacts, age) 
                VALUES (:name, :email, :phone, :address, :city, :state, :dob, :contacts, :age)";
        $params = [
            ':name' => $formData['contactName'],
            ':email' => $formData['contactEmail'],
            ':phone' => $formData['contactPhone'],
            ':address' => $formData['address'],
            ':city' => $formData['city'],
            ':state' => $formData['state'],
            ':dob' => $formData['dob'],
            ':contacts' => $formData['contacts'],
            ':age' => $formData['age']
        ];
    
        $result = $pdoMethods->execute($sql, $params);
    
        if ($result === true) {
            $message = "Contact added successfully!";
        } else {
            $message = "Failed to add contact: $result";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Contact</title>
    <!-- Navigation Bar -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Add Contact</h1>
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

    <?php if (isset($message)): ?>
        <div class="alert alert-info"> <?php echo $message; ?> </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="contactName">Name</label>
            <input type="text" class="form-control <?php echo isset($errors['contactName']) ? 'is-invalid' : ''; ?>" id="contactName" name="contactName" value="<?php echo StickyForm::setValue('contactName'); ?>">
            <div class="invalid-feedback"> <?php echo $errors['contactName'] ?? ''; ?> </div>
        </div>

        <div class="form-group">
            <label for="contactEmail">Email</label>
            <input type="email" class="form-control <?php echo isset($errors['contactEmail']) ? 'is-invalid' : ''; ?>" id="contactEmail" name="contactEmail" value="<?php echo StickyForm::setValue('contactEmail'); ?>">
            <div class="invalid-feedback"> <?php echo $errors['contactEmail'] ?? ''; ?> </div>
        </div>

        <div class="form-group">
            <label for="contactPhone">Phone (format: 123-456-7890)</label>
            <input type="text" class="form-control <?php echo isset($errors['contactPhone']) ? 'is-invalid' : ''; ?>" id="contactPhone" name="contactPhone" value="<?php echo StickyForm::setValue('contactPhone'); ?>">
            <div class="invalid-feedback"> <?php echo $errors['contactPhone'] ?? ''; ?> </div>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>" id="address" name="address" value="<?php echo StickyForm::setValue('address'); ?>">
            <div class="invalid-feedback"> <?php echo $errors['address'] ?? ''; ?> </div>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control <?php echo isset($errors['city']) ? 'is-invalid' : ''; ?>" id="city" name="city" value="<?php echo StickyForm::setValue('city'); ?>">
            <div class="invalid-feedback"> <?php echo $errors['city'] ?? ''; ?> </div>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control <?php echo isset($errors['state']) ? 'is-invalid' : ''; ?>" id="state" name="state" value="<?php echo StickyForm::setValue('state'); ?>">
            <div class="invalid-feedback"> <?php echo $errors['state'] ?? ''; ?> </div>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth (YYYY-MM-DD)</label>
            <input type="text" class="form-control <?php echo isset($errors['dob']) ? 'is-invalid' : ''; ?>" id="dob" name="dob" value="<?php echo StickyForm::setValue('dob'); ?>">
            <div class="invalid-feedback"> <?php echo $errors['dob'] ?? ''; ?> </div>
        </div>

        <div class="form-group">
            <label for="contacts">Contacts</label>
            <textarea class="form-control <?php echo isset($errors['contacts']) ? 'is-invalid' : ''; ?>" id="contacts" name="contacts"> <?php echo StickyForm::setValue('contacts'); ?> </textarea>
            <div class="invalid-feedback"> <?php echo $errors['contacts'] ?? ''; ?> </div>
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control <?php echo isset($errors['age']) ? 'is-invalid' : ''; ?>" id="age" name="age" value="<?php echo StickyForm::setValue('age'); ?>">
            <div class="invalid-feedback"> <?php echo $errors['age'] ?? ''; ?> </div>
        </div>

        <button type="submit" class="btn btn-primary">Add Contact</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9ScQrjtj6aW9c2iYV/hAdhVH+8abGFpkvY8a" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
