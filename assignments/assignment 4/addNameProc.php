<?php
class AddNamesProc {
    private $names = [];

    public function __construct() {
        // Initialize The Name Array
        session_start();
        if (isset($_SESSION['names'])) {
            $this->names = $_SESSION['names'];
        }
    }

    public function addClearNames() {
        if (isset($_POST['add'])) {
            $this->addName();
        } elseif (isset($_POST['clear'])) {
            $this->clearNames();
        }

        // Save Name Array
        $_SESSION['names'] = $this->names;

        // Return Formatted Names
        return implode("\n", $this->names);
    }

    private function addName() {
        // Get Name
        $fullname = trim($_POST['fullname']);

        // Name Check
        if (strpos($fullname, ' ') !== false) {
            // Split Name
            list($first, $last) = explode(' ', $fullname, 2);

            // Format Name
            $formattedName = "$last, $first";

            // Add To Array
            $this->names[] = $formattedName;

            // Sort Names
            sort($this->names);
        }
    }

    private function clearNames() {
        // Clear Name List
        $this->names = [];
        // Clear Session Names
        $_SESSION['names'] = [];
    }
}
