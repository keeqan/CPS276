<?php

    $main_items = 4;  // Main List Items
    $sub_items = 5;   // Sub List Items

    $list_html = '<ul>';

    // Loop Main Items
    for ($i = 1; $i <= $main_items; $i++) {

        $list_html .= '<li>' . $i; // Open Main List Item

        $list_html .= '<ul>';  // Sub List
        for ($j = 1; $j <= $sub_items; $j++) {
            $list_html .= '<li>' . $j . '</li>';  // Add Too Sub List Item
        }
        $list_html .= '</ul>';  // Close Sub List Item
        
        $list_html .= '</li>';  // Close Main List Item
    }
    
    $list_html .= '</ul>';  // Close The Main List

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nested Loop</title>
</head>
<body>
    <h1>Exercise 1 ~~~ Nested Loop </h1>
    
    <!-- DISPLAY THE LIST -->
    <?php echo $list_html; ?>
</body>
</html>
