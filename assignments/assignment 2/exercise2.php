<?php
    // Define Variables 
    $title = "My Web page";
    $heading1 = "My Web page";
    $name = "Keegan Miles";
    $footer_content = "My Web page © 2024 ";

    // Define The Paragraph
    $paragraph_text = "This is a sample paragraph to show that I am able to generate three paragraphs using a loop! :) ";
    
    // Initialize To Store the Paragraph
    $paragraphs = '';

    // Loop for Three Paragraphs
    for ($i = 1; $i <= 3; $i++) {
        $paragraphs .= "<p>$paragraph_text</p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        * {margin: 0; padding: 0;}
        body {font: 120%/1.5 sans-serif;}
        #wrapper {width: 1000px; margin: 0 auto; border: 1px solid black;}
        header {background: green; height: 150px; padding: 20px;}
        header h1 {color: white;}
        main {padding: 10px;}
        main h2 {margin: 15px 0;}
        main p {margin-bottom: 15px;}
        footer {background: #eee; padding: 10px 0; text-align: center}
        footer p {font-size: .8em;}
    </style>
</head>
<body>
    <div id="wrapper">
        <header>
            <h1><?php echo $heading1; ?></h1>
        </header>
        <main>
            <h2>My name is <?php echo $name; ?></h2>
            
            <!-- Echo The Generated Paragraphs -->
            <?php echo $paragraphs; ?>
            
        </main>
        <footer>
            <p><?php echo $footer_content; ?></p>
        </footer>
    </div>
</body>
</html>
