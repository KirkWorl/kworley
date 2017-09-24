<?php

$start = microtime(true);

session_start(); //start or resume a session

if (!isset($_SESSION['matchCount'])) { //checks whether the session exists
    $_SESSION['matchCount'] = 1;
    $_SESSION['totalElapsedTime'] = 0;
}

class Card {
   public $cardValue;
   public $cardFace;
}

$suits = array("clubs","spades","hearts","diamonds");
$names= array("Jared","Kirk","Jeremy","Victor");

$deck = array();
for ($i=0; $i<=3; $i++) {
    for ($j=1; $j<=13; $j++) {
        $card = new Card;
        $card->cardSuit = $suits[$i];
        $card->cardValue = $j;
        $deck[] = $card;
    }
}

shuffle($deck);
shuffle($names);

// Adjusted player class to hold name --Kirk
class player
{
    public $fileString = array();
    public $playCardTotal = 0;
    public $pName = "";
}

function getHand($player,&$deck)
{
    $player->playCardTotal += $deck[0]->cardValue;
    $tempString = "/" . $deck[0]->cardSuit . "/" . $deck[0]->cardValue . ".png";
   // array_push($play->fileString, $tempString);
    $player->fileString[] = $tempString;
    array_shift($deck);
    if ($player->playCardTotal <= 34)
    {
        getHand($player,$deck);
    }
    return $player->playCardTotal;
}

$player1 = new player;
$player1->pName = $names[0];
$player1Total = getHand($player1,$deck);//gets the player's hand as a string
// tried putting this code from 55 to 62 in a function, it wasn't happy with it

// @above: I managed to put them all into functions. Left your code but just
// put them into their own functions. --Kirk
function showP1() {
    global $player1, $player1Total;
    
    $playerNum = 1;
    $play = ${"player" . $playerNum . ""};
    for($i=0;$i<count($play->fileString);$i++)
    {
        $display = ${"player" . $playerNum . ""}->fileString[$i];
        echo "<img src = 'img$display'/>";//displays the cards from the player's hand
    
    }
}

// echo $player1Total; //points for player 1
// echo "<hr>";
//code repeats for each player
$player2 = new player;
$player2->pName = $names[1];
$player2Total = getHand($player2,$deck);

function showP2() {
    global $player2, $player2Total;
    
    $playerNum = 2;
    $play = ${"player" . $playerNum . ""};
    for($i=0;$i<count($play->fileString);$i++)
    {
        $display = ${"player" . $playerNum . ""}->fileString[$i];
        echo "<img src = 'img$display'/>";
    
    }
}
// echo $player2Total;
// echo "<hr>";
$player3 = new player;
$player3->pName = $names[2];
$player3Total = getHand($player3,$deck);

function showP3() {
    global $player3, $player3Total;
    
    $playerNum = 3;
    $play = ${"player" . $playerNum . ""};
    for($i=0;$i<count($play->fileString);$i++)
    {
        $display = ${"player" . $playerNum . ""}->fileString[$i];
        echo "<img src = 'img$display'/>";
    
    }
}
// echo $player3Total;
// echo "<hr>";
$player4 = new player;
$player4Total = getHand($player4,$deck);
$player4->pName = $names[3];
function showP4() {
    global $player4, $player4Total;
    
    $playerNum = 4;
    $play = ${"player" . $playerNum . ""};
    for($i=0;$i<count($play->fileString);$i++)
    {
        $display = ${"player" . $playerNum . ""}->fileString[$i];
        echo "<img src = 'img$display'/>";
    
    }
}
// echo $player4Total;
// echo "<hr>";
$playerTotals = array();
for($ii=1;$ii<5;$ii++)
{
    $playerTotals[$ii] = ${"player" . $ii . "Total"};//puts all of the player totals into an array
}

rsort($playerTotals);
$winnerScore = 0; //points the winning player(s) will get
$highScore = 0; //score of the winning player(s)
$winnersNames = array();

//lines 111 to 121 determines the winning player(s) and the points they get. It accounts for ties
foreach($playerTotals as $k => $v)
{
    if($v >= $highScore && $v <= 42)
    {
        $highScore = $v;
    }
    else
    {
        $winnerScore = $winnerScore + $v;
    }
}

// Lines 152-174 Written by Kirk W.
$allPlayers = array($player1, $player2, $player3, $player4);

foreach($allPlayers as $p) {
    if($p->playCardTotal == $highScore) {
        $winnersNames[] = $p->pName;
    }
}

function printWinners() {
    global $highScore, $winnerScore, $winnersNames;
    
    echo "<h4>Winner(s):</h4>";
    for($i = 0; $i < count($winnersNames); $i++) {
        if($i == count($winnersNames)-1) {
            echo $winnersNames[$i];
        } else {
            echo $winnersNames[$i] . ", "; 
        }
    }
    
    echo "<h4>Points won: $winnerScore </h4>";
}

// echo "<hr>";
// echo $winnerScore;
// echo "<hr>";
// echo $highScore;

// elapsedTime();

function elapsedTime()
{
global $start;
     echo "<hr>";
     $elapsedSecs = microtime(true) - $start;
     echo "This match elapsed time: " . $elapsedSecs . " secs <br /><br/>";

     echo "Matches played:"  . $_SESSION['matchCount'] . "<br />";

     $_SESSION['totalElapsedTime'] += $elapsedSecs;
     
     echo "Total elapsed time in all matches: " .  $_SESSION['totalElapsedTime'] . "<br /><br />";
     
     echo "Average time: " . ( $_SESSION['totalElapsedTime']  / $_SESSION['matchCount']);
     
     $_SESSION['matchCount']++;
} //elapsedTime

?>

