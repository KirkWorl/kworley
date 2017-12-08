<?php
include '../dbConnection.php';
session_start();

$conn = getDatabaseConnection();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if(isset($_GET['submit'])) {
    $rname = $_GET['runner'];
    $rcountry = $_GET['country'];
    $game = $_GET['game'];
    $runtime = $_GET['hours'] . ":" . $_GET['mins'] . ":" . $_GET['sec'];
    $category = $_GET['category'];
    
    $sql = "INSERT INTO `sr_runs`
            (runner, country, gameCode, runtime, categoryId)
            VALUES
            (:run, :country, :gc, :rt, :cat)";
    
    $namedParameters = array(
        ":run" => $rname,
        ":country" => $rcountry,
        ":gc" => $game,
        ":rt" => $runtime,
        ":cat" => $category
        );
        
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    echo "<h3 style='color:gold;'>New Run Added!</h3>";
}

function getGameList() {
    global $conn;
    
    $sql = "SELECT gameCode, gameName FROM `sr_games` WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($games as $g) {
        echo "<option value='" . $g['gameCode'] . "'>" . $g['gameName'] . "</option>";
    }
}

function getCategoryList() {
    global $conn;
    
    $sql = "SELECT * FROM `sr_category` WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($categories as $c) {
        echo "<option value='" . $c['categoryId'] . "'>" . $c['categoryName'] . ", " . $c['completion'] . "</option>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add New Speedrun</title>
        <meta charset="utf-8">
        <meta name="author" value="Kirk Worley">
        <link href="img/ico.png" rel="icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto|Vollkorn+SC" rel="stylesheet">
        <!-- Lobster = 'cursive', Roboto = 'san-serif', Vollkorn SC = 'serif' -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
            @import url("css/style.css");
            
            #content {
                text-align: center;
            }
            
            form {
                display: inline-block;
            }
            
            table {
                width: auto;
            }
            
            input[type=text] {
                border-radius: 20px;
                color: black;
                width: 280px;
                padding-left: 13px;
                margin-bottom: 6px;
                font-family: "Roboto", sans-serif;
            }
            
            .timeinput, select {
                color: black;
            }
            
            h1, legend, h3 {
                font-family: "Lobster", cursive;
            }
            
            #decbr {
                width: 300px;
            }
            
            input[type=submit] {
                border-radius: 20px;
                width: 125px;
                height: 41px;
                padding: 4px 7px;
                font-family: "Roboto", sans-serif;
                background-color: lightgrey;
                color: black;
            }
            
            input[type=submit]:hover {
                color: white;
                background-color: grey;
                transition: .2s;
            }
        </style>
    </head>
    
    <body id="content">
        <h1>Add A New Speedrun</h1>
        <img id="decbr" src="img/hr.png" alt="decorative hr">
        <br>
        
        <fieldset>
            <legend>Add new run details:</legend>
            <form>
                <table>
                    <tr>
                        <td>Runner Username:</td>
                        <td><input type="text" name="runner" placeholder="Runner" required/></td>
                    </tr>
                    <tr>
                        <td>Runner Country:</td>
                        <td><input type="text" name="country" placeholder="Country" required/></td>
                    </tr>
                    <tr>
                        <td>Game Ran:</td>
                        <td><select name="game" required>
                            <?=getGameList()?>    
                        </select></td>
                    </tr>
                    <tr>
                        <td>Run Time:</td>
                        <td>
                            <input class="timeinput" type="number" name="hours" max="24" min="0" value="0" step="1" required/> :
                            <input class="timeinput" type="number" name="mins" max="59" min="0" value="0" step="1" required/> :
                            <input class="timeinput" type="number" name="sec" max="59" min="0" value="0" step="1" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><select name="category">
                            <?=getCategoryList()?>
                        </select></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Add Run!"></td>
                    </tr>
                </table>
            </form>
        </fieldset>
        
        <br>
        
        <button id="back" class="fancytext" onclick="location.href='admin.php'; return false;">Back</button>
    </body>
</html>