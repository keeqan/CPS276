<?php
$output = '';
if (count($_POST) > 0) {
    require_once 'addNameProc.php';
    $addName = new AddNamesProc();
    $output = $addName->addClearNames();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Names ~~~ assignment 4</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Add Names ~~~ assignment 4</h1>
    <form method="POST" action="">
        
    <button type="submit" name="add" class="btn btn-primary">Add Name</button>
    <button type="submit" name="clear" class="btn btn-primary">Clear Names</button>

        <div class="form-group">
            <label for="fullname">Enter Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" >
        </div>
        
        <label for="List of Names">List of Names</label>
        <textarea style="height: 300px;" class="form-control" id="namelist" name="namelist"><?php echo $output; ?></textarea>

    </form>
</div>
</body>
</html>
