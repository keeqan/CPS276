<?php
require 'Pdo_methods.php'; 

class ListFiles extends PdoMethods {
    public function displayFiles() {
        $pdo = new PdoMethods();
        $sql = "SELECT * FROM pdf_files";
        $records = $pdo->selectNotBinded($sql);

        if ($records == 'error') {
            echo 'Error retrieving files.';
            return;
        }

        echo '<h1>Uploaded PDFs</h1><ul>';
        foreach ($records as $row) {
            echo "<li><a href='{$row['file_path']}' target='_blank'>{$row['file_name']}</a></li>";
        }
        echo '</ul>';
    }
}

$listFiles = new ListFiles();
$listFiles->displayFiles();
?>
