<!DOCTYPE html>
<?php
    include 'inc/functions.php';
?>
<html>
    <head>
        <title> The Slot Machine</title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        <div id="main">
            <?php
                play();
            ?>
            
            <form>
                <input type="submit" value="Spin!"/>
            </form>
        </div>
    </body>
</html>