<?php require_once 'addNote.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Note</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Add Note</h1>
    <p class="text-info"><?php echo htmlspecialchars($message); ?></p>
    <form method="POST" action="">
        <div class="form-group">
            <label for="dateTime">Date and Time</label>
            <input type="datetime-local" class="form-control" id="dateTime" name="dateTime" required>
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <textarea id="note" name="note" rows="4" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
        <a href="displayNotesForm.php" class="btn btn-secondary">View Notes</a>
    </form>
</div>
</body>
</html>
