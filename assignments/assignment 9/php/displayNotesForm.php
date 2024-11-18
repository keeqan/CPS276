<?php require_once 'displayNotes.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Notes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Display Notes</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="begDate">Start Date</label>
            <input type="date" class="form-control" id="begDate" name="begDate" required>
        </div>
        <div class="form-group">
            <label for="endDate">End Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate" required>
        </div>
        <button type="submit" class="btn btn-primary">Get Notes</button>
        <a href="addNoteForm.php" class="btn btn-secondary">Add Notes</a>
    </form>

    <?php if (!empty($message)): ?>
        <p class="text-info mt-4"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php if (!empty($notes)): ?>
        <h2 class="mt-5">Notes</h2>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($note['date_time']); ?></td>
                        <td><?php echo htmlspecialchars($note['note']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
