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

<!DOCTYPE html>
<html>
    <head>
        <title>Starter Pokemon Quiz</title>
        <meta charset="utf-8">
        <style>
            @import url("css/style.css");
        </style>
        <link href="https://maxcdn.icons8.com/Share/icon/color/Gaming//pokeball1600.png" rel="icon">
    </head>
    <body>
        <div id="title">
            <img src="https://maxcdn.icons8.com/Share/icon/color/Gaming//pokeball1600.png" width=100 height=100>
            <div id="woah"><span id="intro">What Starter Pokemon Are You?</span></div>
            <img src="https://maxcdn.icons8.com/Share/icon/color/Gaming//pokeball1600.png" width=100 height=100>
        </div>
        
        <hr>
        
        <div id="content">
            <form method="POST">
                <h2>1. What is your first name?</h2>
                <input type="text" name="name" placeholder="Your name" value=<?=$_POST['name']?>>
                
                <!-- Radio -> Selected -> Radio -> Selected etc -->
                <h2>2. A test is coming up. How do you study for it?</h2>
                <ul>
                    <li><input type="radio" name="q1" id="q1a1" value="q1hardy" <?=isChecked("q1hardy", "q1")?>><label for="q1a1">Study hard.</label> <div class="check"></div></li>
                    <li><input type="radio" name="q1" id="q1a2" value="q1docile" <?=isChecked("q1docile", "q1")?>><label for="q1a2">At the last second.</label> <div class="check"> <div class="inside"></div></div></li>
                    <li><input type="radio" name="q1" id="q1a3" value="q1relaxed" <?=isChecked("q1relaxed", "q1")?>><label for="q1a3">Ignore it and play video games.</label> <div class="check"><div class="inside"></div></div></li>
                </ul>
                
                <h2>3. There is a wallet on the side of the road.</h2>
                <select name="q2">
                    <option value="">-- Pick One --</option>
                    <option <?=checkIfSelected("q2docile", "q2")?> value="q2docile">Turn it in to the police!</option>
                    <option <?=checkIfSelected("q2naive", "q2")?> value="q2naive">Yay!</option>
                    <option <?=checkIfSelected("q2relaxed", "q2")?> value="q2relaxed">Look to see if anyone is watching.</option>
                </select>
                
                <h2>4. There's an alien invasion! What do you do?</h2>
                <ul>
                    <li><input type="radio" name="q3" id="q3a1" value="q3hardy" <?=isChecked("q3hardy", "q3")?>><label for="q3a1">Fight.</label> <div class="check"></div></li>
                    <li><input type="radio" name="q3" id="q3a2" value="q3docile" <?=isChecked("q3docile", "q3")?>><label for="q3a2">Run.</label> <div class="check"> <div class="inside"></div></div></li>
                    <li><input type="radio" name="q3" id="q3a3" value="q3relaxed" <?=isChecked("q3relaxed", "q3")?>><label for="q3a3">Ignore it.</label> <div class="check"> <div class="inside"></div></div></li>
                </ul>
                
                <h2>5. It's the summer holiday! Where would you like to go?</h2>
                <select name="q4">
                    <option value="">-- Pick One --</option>
                    <option <?=checkIfSelected("q4naive", "q4")?> value="q4naive">The beach.</option>
                    <option <?=checkIfSelected("q4hardy", "q4")?> value="q4hardy">A spa.</option>
                    <option <?=checkIfSelected("q4relaxed", "q4")?> value="q4relaxed">Anywhere.</option>
                </select>
                
                <h2>6. You win the lottery! What do you do with the money?</h2>
                <ul>
                    <li><input type="radio" name="q5" id="q5a1" value="q5naive" <?=isChecked("q5naive", "q5")?>><label for="q5a1">Spend it.</label> <div class="check"></div></li>
                    <li><input type="radio" name="q5" id="q5a2" value="q5hardy" <?=isChecked("q5hardy", "q5")?>><label for="q5a2">Save it.</label> <div class="check"> <div class="inside"></div></div></li>
                    <li><input type="radio" name="q5" id="q5a3" value="q5docile" <?=isChecked("q5docile", "q5")?>><label for="q5a3">Give it away.</label> <div class="check"> <div class="inside"></div></div></li>
                </ul>
                
                <br><br>
                <input type="submit" value="Go!">
            </form>
            
            <?=postdata()?>
        </div>
    </body>
</html>