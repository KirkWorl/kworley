<?php
    include '../../dbConnection.php';

    $conn = getDatabaseConnection();
    
    $namedParameters = array(":lat" => $_GET['latitude'], ":lon" => $_GET['longitude']);
    $sql = "INSERT INTO `loc_find` (`latitude`, `longitude`) VALUES (:lat, :lon)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);   // Inserts new record of lat and long searched.
    
    $sql = "SELECT latitude, longitude, COUNT(*) AS ts FROM `loc_find` GROUP BY latitude, longitude ORDER BY ts DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $rDAT = array();
    
    foreach($records as $query) {
        echo $query['latitude'] . ", " . $query['longitude'] . " was searched " . $query['ts'] . " time(s).";
        echo "<br>";
        echo "<strong>Search History:</strong>";
        echo "<br>";
        
        $nsql = "SELECT time FROM `loc_find` WHERE latitude BETWEEN :lat - 0.01 AND :lat + 0.01 
                AND longitude BETWEEN :lon - 0.01 AND :lon + 0.01";
        $nNamedParameters = array(':lat' => $query['latitude'], ':lon' => $query['longitude']);
        
        $nstmt = $conn->prepare($nsql);
        $nstmt->execute($nNamedParameters);
        $nrecords = $nstmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($nrecords as $t) {
            echo $t['time'];
            echo "<br>";
        }
    }
?>