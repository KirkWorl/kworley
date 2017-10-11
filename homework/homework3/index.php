<?php
include "inc/functions.php";
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