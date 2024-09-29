<?php
    // Set The Number of Rows and Cells
    $num_rows = 15;
    $num_cells = 5;

    // Empty String for Tables HTML
    $table_html = '<table>';

    // Loop Through Rows
    for ($row = 1; $row <= $num_rows; $row++) {
        $table_html .= '<tr>';  // Start A New Row

            // Loop Through Cells
        for ($cell = 1; $cell <= $num_cells; $cell++) {
            $table_html .= '<td>Row ' . $row . ' Cell ' . $cell . '</td>';  // Add Cell With Label
        }

        $table_html .= '</tr>';  // Close Row
    }

    $table_html .= '</table>';  // Close Tabel
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <style>
        table {
            width: 30%; 
            border-collapse: collapse;
            border: 3px solid black; 
        }
        td {
            width: 20%; 
            border: 3px solid black; 
        }
    </style>
</head>
<body>
    <h1>Dynamic Table ~~~ Exercise 3</h1>
    
    <!-- Display Generated Results -->
    <?php echo $table_html; ?>
</body>
</html>
