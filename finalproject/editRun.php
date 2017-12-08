<?php
include '../dbConnection.php';
session_start();

$conn = getDatabaseConnection();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}

function getGameList() {
    global $conn;
    
    $sql = "SELECT gameCode, gameName FROM `sr_games` WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $games;
}

function getCategoryList() {
    global $conn;
    
    $sql = "SELECT * FROM `sr_category` WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $categories;
}

function getRunInfo($runId) {
    global $conn;
    
    $sql = "SELECT * FROM `sr_runs` WHERE runID = :run";
    $namedParameters = array(":run" => $runId);
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    return $record;
}

if(isset($_GET['updateRun'])) {
    $sql = "UPDATE `sr_runs` SET 
            runner = :runner, 
            country = :ctry, 
            gameCode = :gc, 
            runtime = :rt, 
            categoryId = :cat 
            WHERE runId = :rId";
            
    $namedParameters = array(
        ":runner" => $_GET['runner'],
        ":ctry" => $_GET['country'],
        ":gc" => $_GET['game'],
        ":rt" => $_GET['hours'] . ":" . $_GET['mins'] . ":" . $_GET['sec'],
        ":cat" => $_GET['category'],
        ":rId" => $_GET['runsId']
        );
        
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    header("Location: admin.php");
    exit;
}

if(isset($_GET['runId'])) {
    $runInfo = getRunInfo($_GET['runId']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Speedrun</title>
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
        <h1>Edit A Run</h1>
        <img id="decbr" src="img/hr.png" alt="decorative hr">
        <br>
        
        <fieldset>
            <legend>Update run details:</legend>
            <form>
                <input type="hidden" name="runsId" value="<?=$runInfo['runId']?>">
                <table>
                    <tr>
                        <td>Runner Username:</td>
                        <td><input type="text" name="runner" placeholder="Runner" value="<?=$runInfo['runner']?>" required/></td>
                    </tr>
                    <tr>
                        <td>Runner Country:</td>
                        <td><input type="text" name="country" placeholder="Country" value="<?=$runInfo['country']?>" required/></td>
                    </tr>
                    <tr>
                        <td>Game Ran:</td>
                        <td><select name="game" required>
                            <?php
                                $gs = getGameList();
                                foreach($gs as $g) {
                                    echo "<option " . (($runInfo['gameCode'] == $g['gameCode']) ? 'selected':'') . " value='" . $g['gameCode'] . "'>" . $g['gameName'] . "</option>";
                                }
                            ?>    
                        </select></td>
                    </tr>
                    <tr>
                        <td>Run Time:</td>
                        <td>
                            <?php
                                $times = explode(":", $runInfo['runtime']);
                            ?>
                            <input class="timeinput" type="number" name="hours" max="24" min="0" value="<?=$times[0]?>" step="1" required/> :
                            <input class="timeinput" type="number" name="mins" max="59" min="0" value="<?=$times[1]?>" step="1" required/> :
                            <input class="timeinput" type="number" name="sec" max="59" min="0" value="<?=$times[2]?>" step="1" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><select name="category">
                            <?php
                                $categories = getCategoryList();
                                foreach($categories as $c) {
                                    echo "<option " . (($runInfo['categoryId'] == $c['categoryId']) ? 'selected':'') . " value='" . $c['categoryId'] . "'>" . $c['categoryName'] . ", " . $c['completion'] . "</option>";
                                }
                            ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="updateRun" value="Update Run!"></td>
                    </tr>
                </table>
            </form>
        </fieldset>
        
        <br>
        
        <button id="back" class="fancytext" onclick="location.href='admin.php'; return false;">Back</button>
    </body>
</html>