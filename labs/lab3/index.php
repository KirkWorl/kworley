<?php
    include 'functions.php';
?>

<!--
Authors: Jared, Jeremy, Kirk, Victor
Lab 3: Silverjack Game
-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Silverjack Super Game of Winning</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <div id="title">
            <!--Contains title.. probably. -->
            <h1>Silverjack Card Game</h1>
        </div>
        
        <!-- Break for first two players -->
        <br>
        
        <div id="player1">
            <!-- Contains player 1's photo, cards and score -->
            <?php
                echo "<h3>" .$names[0]. "</h3>";
                echo "<img src='img/players/" .$names[0]. ".gif' width=125 height=125>";
                echo "<br>";
                showP1();
                echo "<br>";
                echo "<h4>Total: $player1Total</h4>";
            ?>
        </div>
        
        <div id="player2">
            <!-- Contains player 2's photo, cards and score -->
            <?php
                echo "<h3>" .$names[1]. "</h3>";
                echo "<img src='img/players/" .$names[1]. ".gif' width=125 height=125>";
                echo "<br>";
                showP2();
                echo "<br>";
                echo "<h4>Total: $player2Total</h4>";
            ?>
        </div>
        
        <!-- Break for last two players -->
        <br>
        
        <div id="player3">
            <!-- Contains player 3's photo, cards and score -->
            <?php
                echo "<h3>" .$names[2]. "</h3>";
                echo "<img src='img/players/" .$names[2]. ".gif' width=125 height=125>";
                echo "<br>";
                showP3();
                echo "<br>";
                echo "<h4>Total: $player3Total</h4>";
            ?>
        </div>
        
        <div id="player4">
            <!-- Contains player 4's photo, cards and score -->
            <?php
                echo "<h3>" .$names[3]. "</h3>";
                echo "<img src='img/players/" .$names[3]. ".gif' width=125 height=125>";
                echo "<br>";
                showP4();
                echo "<br>";
                echo "<h4>Total: $player4Total</h4>";
            ?>
        </div>
        
        <!-- Break for result div at bottom -->
        <br>
        <div id="result">
            <hr>
            <?=printWinners()?>
            
            <!-- Contains winner, points, and button to "play again" -->
            <input type="button" value="Play Again" onClick="reload()">
            
            <?=elapsedTime()?>
        </div>
    </body>
</html>