<?php
class Directories
{
    private $baseDir = 'directories';

    public function createDirectoryAndFile($directoryName, $fileContent)
    {
        // Define The Path For directory
        $dirPath = $this->baseDir . '/' . $directoryName;

        // Check If Directory Exists
        if (file_exists($dirPath)) {
            return ['success' => false, 'error' => 'A directory already exists with that name.'];
        }

        // Try to create 
        if (!mkdir($dirPath, 0777, true)) {
            return ['success' => false, 'error' => 'Failed to create directory.'];
        }

        // Create a File
        $filePath = $dirPath . '/readme.txt';
        if (!file_put_contents($filePath, $fileContent)) {
            return ['success' => false, 'error' => 'Failed to create the file.'];
        }

        // Return Success
        return ['success' => true, 'path' => $filePath];
    }
}
?>
