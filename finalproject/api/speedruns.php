<?php
include '../../dbConnection.php';
$conn = getDatabaseConnection();

if(isset($_GET['func'])) {
    $functionCode = $_GET['func'];
} else {
    header("Location: ../index.html");
}


switch ($functionCode) {
    case '1':
        initRunData();
        break;
        
    case '2':
        updateRunData();
        break;
    
    case '3':
        generateReports();
        break;
        
    default:
        echo "Unknown error!";
        break;
}

function initRunData() {
    global $conn;
    
    $sql = "SELECT runId, runner, country, runtime, gameName, gameGenre, gameRating, categoryName, completion 
            FROM `sr_runs` 
            NATURAL JOIN `sr_games` 
            NATURAL JOIN `sr_category`";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
    return;
}

function updateRunData() {
    global $conn;
  
    if(!empty($_GET['title']) || isset($_GET['title'])) {
        $gameName = $_GET['title'];
    }
  
    if($_GET['cat'] != '--') {
        $runCat = $_GET['cat'];
    }
  
    $sql = "SELECT runId, runner, country, runtime, gameName, gameGenre, gameRating, categoryName, completion 
            FROM `sr_runs`
            NATURAL JOIN `sr_games`
            NATURAL JOIN `sr_category` WHERE";
    
    if(isset($gameName) && isset($runCat)) {
        $sql .= " gameName LIKE :name AND categoryName = :category";
        $namedParameters = array(":name" => "%".$gameName."%", ":category" => $runCat);
    } 
    else if(isset($gameName) && !isset($runCat)) {
        $sql .= " gameName LIKE :name";
        $namedParameters = array(":name" => "%".$gameName."%");
    } 
    else if(!isset($gameName) && isset($runCat)) {
        $sql .= " categoryName = :category";
        $namedParameters = array(":category" => $runCat);
    } else {
        $sql .= " 1";
        $namedParameters = array();
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
    return;
}

function generateReports() {
    global $conn;
    
    // Generate count of runs and per category count.
    $sql = "SELECT COUNT(*) AS a FROM `sr_runs`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sql2 = "SELECT categoryName, COUNT(*) AS counts 
            FROM `sr_runs` NATURAL JOIN `sr_category` 
            GROUP BY categoryId";
            
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $counts = $stmt2->fetchAll(PDO::FETCH_ASSOC);
   
    $sql3 = "SELECT * FROM `sr_runs` 
            NATURAL JOIN `sr_games` 
            NATURAL JOIN `sr_category` 
            WHERE runtime = (SELECT MIN(runtime) FROM `sr_runs`)";
            
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();
    $min = $stmt3->fetch(PDO::FETCH_ASSOC);
    
    $sql4 = "SELECT * FROM `sr_runs` 
            NATURAL JOIN `sr_games` 
            NATURAL JOIN `sr_category` 
            WHERE runtime = (SELECT MAX(runtime) FROM `sr_runs`)";
            
    $stmt4 = $conn->prepare($sql4);
    $stmt4->execute();
    $max = $stmt4->fetch(PDO::FETCH_ASSOC);
    
    $sql5 = "SELECT gameName, COUNT(*) as gct 
            FROM `sr_runs` NATURAL JOIN `sr_games` 
            GROUP BY gameName";
            
    $stmt5 = $conn->prepare($sql5);
    $stmt5->execute();
    $gamecounts = $stmt5->fetchAll(PDO::FETCH_ASSOC);
    
    $data = array("single" => $count,
                "categories" => $counts,
                "gamecount" => $gamecounts,
                "min" => $min,
                "max" => $max);
                
    echo json_encode($data);
    return;
}

?>