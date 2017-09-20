<?php
    include 'inc/functions.php';
    
    getRollScore();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cool Man Dice Game</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://rlv.zcache.com.au/retro_dice_classic_round_sticker-r7aae03d7756a4f6caf62e40400810521_v9waf_8byvr_324.jpg" rel="icon">
    </head>
    
    <body>
        <main>
            <a href="https://goo.gl/reEqJH"><h1 class="color-secondary-2-2">Thats a gold hat, cool cat.</h1></a>
            <hr>
            
            <div class="banner">
                <img class="bannerImg" src="img/vaporwavebanner.png" alt="woah man" width=150 height=150 title="Hey thing, I'm just a palm tree.">
            </div>
            
            <div id="player1">
                <h2 class="color-secondary-1-1">Your dice:</h3>
                <?php
                    displayP1();
                    displayScore1();
                ?>
            </div>
            
            <div class="banner">
                <img class="bannerImg" src="img/vaporwavebanner.png" alt="woah man" width=150 height=150 title="Just make sure you forgive yourself.">
            </div><br>
            
            <div id="player2">
                <h2 class="color-secondary-1-1">Skynet's dice:</h3>
                <?php
                    displayP2();
                    displayScore2();
                ?>
            </div><br>
            
            <div id="winner">
                <?php
                    displayWinner();
                ?>
            </div><br>
            
            <form>
                <input class="color-secondary-2-0" type="submit" value="Blend the Cubes"/>
            </form>
        </main>
    </body>
</html>