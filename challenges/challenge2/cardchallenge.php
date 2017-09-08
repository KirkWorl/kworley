<!DOCTYPE html>
<?php
    function getFolder($randomValue1) {
        
        switch($randomValue1) {
            case 0:
                return "clubs";
                break;
            case 1:
                return "diamonds";
                break;
            case 2:
                return "hearts";
                break;
            case 3:
                return "spades";
                break;
        }
    }
    
    function getCard($randomValue2) {
        
        switch($randomValue2) {
            case 0:
                return "ace";
                break;
            case 1:
                return "king";
                break;
            case 2:
                return "queen";
                break;
            case 3:
                return "jack";
                break;
            case 4:
                return "ten";
                break;
        }
    }

    function playCard() {
        $humanCardSuit = rand(0,3);
        $humanCardValue = rand(0,4);
        
        $compCardSuit = rand(0,3);
        $compCardValue = rand(0,4);
        
        while($humanCardSuit == $compCardSuit && $humanCardValue == $compCardValue) {
            $compCardSuit = rand(0,3);
            $compCardValue = rand(0,4);
        }
        
        echo "<img id=human src=img/cards/".getFolder($humanCardSuit)."/".getCard($humanCardValue).".png alt='playing card'>";
        echo "<img id=comp src=img/cards/".getFolder($compCardSuit)."/".getCard($compCardValue).".png alt='playing card'>";
        if($humanCardValue == $compCardValue) {
            echo "<h3>It's a Tie!</h3>";
        } else if($humanCardValue < $compCardValue) {
            echo "<h3>Human Wins</h3>";
        } else {
            echo "<h3>Computer Wins</h3>";
        }
    }
?>

<html>
    <head>
        <title>Random Card Game</title>
        <meta charset="utf-8"/>
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <header>
            <h1>Random Card Game</h1>
        </header>
        <main>
            <div id = titles>
                <span id=humanT> Human</span><span id=compT>Computer</span>
            </div>
            <br>
            <div>
                <?=playCard();?>
            </div>
            <div>
            </div>
        </main>
    </body>
</html>