<!DOCTYPE html>

<?php
    function getRandomColor() {
        return "rgba(" .rand(0,255). ", " .rand(0,255). ", " .rand(0,255). ", " .(rand(0,100)/50). ");";
    }
?>
<html>
    <head>
        <title>Random BG Color</title>
        <meta charset="utf-8">
        <style>
            body {
                background-color: <?=getRandomColor()?>;
            }
            
            h1 {
                color: <?=getRandomColor()?>;
                background-color: <?=getRandomColor()?>;
            }
            
            h2 {
                color: <?=getRandomColor()?>;
                background-color: <?=getRandomColor()?>;
            }
        </style>
    </head>
    
    <body>
        <h1>Welcome Spinners!</h1>
        <h2>Spin2Win</h2>
    </body>
</html>