<?php
    session_start();
    include "../dbConnection.php";
    $conn = getDatabaseConnection();
    
    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
    
    $sql = "DELETE FROM `sr_runs` 
            WHERE runId = " . $_GET['runId'];

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: admin.php");
?>