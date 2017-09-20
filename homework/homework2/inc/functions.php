<?php
    $images = array("d1", "d2", "d3", "d4", "d5", "d6");
    
    $p1dice = array();
    $p2dice = array();
    
    $p1score = 0;
    $p2score = 0;
    
    // Gets dice and score.
    function getRollScore() {
        global $images, $p1dice, $p1score, $p2dice, $p2score;
        
        for($i = 0; $i < 5; $i++) {
            $num1 = rand(0, count($images)-1);
            $num2 = rand(0, count($images)-1);
            
            array_push($p1dice, $images[$num1]);
            array_push($p2dice, $images[$num2]);
            
            $p1score += $num1+1;
            $p2score += $num2+1;
        }
        
        shuffle($p1dice);
        shuffle($p2dice);
    }
    
    function displayDie($imgName) {
        echo "<img class='rnb' src='img/$imgName.png' alt='die face'>";   
    }
    
    function displayP1() {
        global $p1dice;
        
        foreach($p1dice as $name) {
            displayDie($name);
            echo " ";
        }
    }
    
    function displayP2() {
        global $p2dice;
        
        foreach($p2dice as $name) {
            displayDie($name);
            echo " ";
        }
    }
    
    function displayScore1() {
        global $p1score;
        
        echo "<span class='color-secondary-1-1'>$p1score</span>";
    }
    
    function displayScore2() {
        global $p2score;
        
        echo "<span class='color-secondary-1-1'>$p2score</span>";
    }
    
    function displayWinner() {
        global $p1score, $p2score;
        
        if($p1score == $p2score) {
            echo "<span class='color-secondary-2-1'>It's a tie on the fly.</span>";
        }
        else if($p1score > $p2score) {
            echo "<span class='color-secondary-2-1'>Winner winner chicken entree.</span>";
        } else {
            echo "<span class='color-secondary-2-1'>Better luck next time, windchime.</span>";
        }
    }
?>