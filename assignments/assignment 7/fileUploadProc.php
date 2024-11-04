<?php
require 'Pdo_methods.php'; // Include your PDO methods

class FileUploadProc extends PdoMethods {
    public function processUpload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fileName = $_POST['fileName'];
            $pdfFile = $_FILES['pdfFile'];

            // Check for errors in the uploaded file
            if ($pdfFile['error'] !== UPLOAD_ERR_OK) {
                $message = "Error: File upload error code " . $pdfFile['error'];
                header("Location: index.php?message=" . urlencode($message));
                exit;
            }

            // Check file size and type
            if ($pdfFile['size'] > 100000 || $pdfFile['type'] !== 'application/pdf') {
                $message = "Error: The file must be a PDF under 100000 bytes.";
                header("Location: index.php?message=" . urlencode($message));
                exit;
            }

            // Define your upload directory and file path
            $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
            if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
                echo "Upload directory does not exist or is not writable.";
                exit;
            }

            $filePath = $uploadDir . basename($pdfFile['name']);

            // Move the uploaded file to the server
            if (move_uploaded_file($pdfFile['tmp_name'], $filePath)) {
                // Insert into database
                $this->insertFileInfo($fileName, $filePath);
            } else {
                $message = "Error: There was a problem moving the uploaded file.";
                header("Location: index.php?message=" . urlencode($message));
                exit;
            }
        }
    }

    private function insertFileInfo($fileName, $filePath) {
        $pdo = new PdoMethods();
        $sql = "INSERT INTO pdf_files (file_name, file_path) VALUES (:fileName, :filePath)";
        $bindings = [
            [':fileName', $fileName, 'str'],
            [':filePath', $filePath, 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            $message = "Error: Unable to save file information.";
        } else {
            $message = "File uploaded successfully.";
        }

        header("Location: index.php?message=" . urlencode($message));
        exit;
    }
}

// Create an instance and process the upload
$upload = new FileUploadProc();
$upload->processUpload();
?>
