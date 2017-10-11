<?php
function isChecked($option, $question) {
    if($option == $_POST[$question]) {
        return "checked='checked'";
    }
}

function checkIfSelected($option, $question) {
    if ($option == $_POST[$question]) {
        return "selected";
    }
}
    
function postdata() {
    $required = array('name', 'q1', 'q2', 'q3', 'q4', 'q5');
        
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = false;
        foreach($required as $field) {
            if(empty($_POST[$field])) {
                $error = true;
            }
        }
            
        if ($error) {
            echo "<h1 id='fError'>The form was not filled out correctly!</h1>";
        } else {
            // Process data.
            $uName = $_POST['name'];
            $answer1 = $_POST['q1'];
            $answer2 = $_POST['q2'];
            $answer3 = $_POST['q3'];
            $answer4 = $_POST['q4'];
            $answer5 = $_POST['q5'];
            
            $traits = array(
                "hardy" => 0,
                "docile" => 0,
                "relaxed" => 0,
                "naive" => 0
                );
                
            // Name processing:
            $nameLength = strlen($uName);
            if($nameLength <= 3) {
                $traits['hardy'] += 1;
            } else if($nameLength > 3 && $nameLength <= 5) {
                $traits['docile'] += 1;
            } else if($nameLength > 5 && $nameLength <= 7) {
                $traits['naive'] += 1;
            } else if($nameLength > 7) {
                $traits['relaxed'] += 1;
            }
            
            // Question 1 processing:
            if($answer1 == "q1hardy") {
                $traits['hardy'] += 2;
            } else if($answer1 == "q1docile") {
                $traits['docile'] += 2;
            } else if($answer1 == "q1relaxed") {
                $traits['relaxed'] += 3;
            }
            
            // Question 2 processing:
            if($answer2 == "q2docile") {
                $traits['docile'] += 3;
            } else if($answer2 == "q2naive") {
                $traits['naive'] += 3;
            } else if($answer2 == "q2relaxed") {
                $traits['relaxed'] += 2;
            }
            
            // Question 3 processing:
            if($answer3 == "q3hardy") {
                $traits['hardy'] += 3;
            } else if($answer3 == "q3docile") {
                $traits['docile'] += 2;
            } else if($answer3 == "q3relaxed") {
                $traits['relaxed'] += 2;
            }
         
            // Question 4 processing:
            if($answer4 == "q4naive") {
                $traits['naive'] += 4;
            } else if($answer4 == "q4hardy") {
                $traits['hardy'] += 2;
            } else if($answer4 == "q4relaxed") {
                $traits['relaxed'] += 2;
            }
            
            // Question 5 processing:
            if($answer5 == "q5naive") {
                $traits['naive'] += 3;
            } else if($answer5 == "q5hardy") {
                $traits['hardy'] += 2;
            } else if($answer5 == "q5docile") {
                $traits['docile'] += 2;
            }
            
            $maxTrait = "";
            $maxVal = 0;
            foreach($traits as $trait => $value) {
                if($value > $maxVal) {
                    $maxVal = $value;
                    $maxTrait = $trait;
                }
            }
            
            displayPicture($maxTrait);
        }
    }
}

function displayPicture($traitToShow) {
    if($traitToShow == "hardy") {
        echo "<img id='starter' src='img/char.png' alt='charmander' width=500 height=500/>";
        echo "<h3 id='chosen'>You are a <span id='char'>Charmander</span>!</h3>";
        echo "<h4>Charmanders have a hardy nature; they are robust and capable of dealing with difficult conditions.</h4>";
    } else if($traitToShow == "docile") {
        echo "<img id='starter' src='img/bulba.png' alt='bulbasaur' width=500 height=500/>";
        echo "<h3 id='chosen'>You are a <span id='bulba'>Bulbasaur</span>!</h3>";
        echo "<h4>Bulbasaurs have a docile-like nature; they are great at following instructions.</h4>";
    } else if($traitToShow == "relaxed") {
        echo "<img id='starter' src='img/pika.png' alt='pickachu' width=500 height=500/>";
        echo "<h3 id='chosen'>You are a <span id='pika'>Pikachu</span>!</h3>";
        echo "<h4>Pikachus have a relaxed nature; they are always free from anxiety and stress-- unless they're in college.</h4>";
    } else if($traitToShow == "naive") {
        echo "<img id='starter' src='img/squirtle.png' alt='squirtle' width=500 height=500/>";
        echo "<h3 id='chosen'>You are a <span id='squirtle'>Squirtle</span>!</h3>";
        echo "<h4>Squirtles have a naive-like nature; they sometimes lack judgement but retain their naturality and innocence.</h4>";
    }
}
?>