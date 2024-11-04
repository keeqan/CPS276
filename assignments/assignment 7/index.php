<?php
$output = '';
if (isset($_GET['message'])) {
    $output = htmlspecialchars($_GET['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Upload a PDF</h1>
    <form method="POST" enctype="multipart/form-data" action="fileUploadProc.php">
        <div class="form-group">
            <label for="fileName">Enter File Name</label>
            <input type="text" class="form-control" id="fileName" name="fileName" required>
        </div>
        <div class="form-group">
            <label for="pdfFile">Select PDF</label>
            <input type="file" class="form-control" id="pdfFile" name="pdfFile" accept="application/pdf" required>
        </div>
        <button type="submit" name="upload" class="btn btn-primary">Upload</button>
    </form>

    <?php
    if ($output) {
        echo "<div class='mt-3 alert alert-info'>$output</div>";
    }
    ?>

    <?php include 'displayFiles.php'; ?>
</div>
</body>
</html>
