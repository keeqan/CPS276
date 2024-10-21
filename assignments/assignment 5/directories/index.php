<?php
require_once 'Directories.php';
$dirError = '';
$filePath = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $directoryName = $_POST['directory_name'];
    $fileContent = $_POST['file_content'];

    $dirManager = new Directories();
    $result = $dirManager->createDirectoryAndFile($directoryName, $fileContent);

    if ($result['success']) {
        $filePath = $result['path'];
    } else {
        $dirError = $result['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Directory and File</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">File and Directory Assignment ~~~ assigment 5</h1>

    <?php if ($filePath): ?>
        <div class="alert alert-success">
            <a href="<?php echo $filePath; ?>">Path where file is located</a>
        </div>
    <?php endif; ?>

    <?php if ($dirError): ?>
        <div class="alert alert-danger">
            <?php echo $dirError; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="directory_name">Directory Name</label>
            <input type="text" class="form-control" id="directory_name" name="directory_name" required>
        </div>

        <div class="form-group">
            <label for="file_content">File Content</label>
            <textarea class="form-control" id="file_content" name="file_content" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
