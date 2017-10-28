<?php
    session_start();
    
    include '../../dbConnection.php';
    $conn = getDatabaseConnection();
    
    // Debugging Purposes:
    // print_r($conn);
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    
    $sql = "SELECT * FROM `tc_admin` WHERE username = :userN AND password = :passW";
    $namedParam = array(":userN" => $username, ":passW" => $password);
    
    $stmt = $conn -> prepare($sql);
    $stmt -> execute($namedParam);
    $record = $stmt -> fetch(PDO::FETCH_ASSOC);
    
    if(empty($record)) {
        header("Location: index.php?login=Error");
    } else {
        $_SESSION['username'] = $record['username'];
        $_SESSION['adminFullName'] = $record['firstName'] . " " . $record['lastName'];
        
        header("Location: admin.php"); // Redirects to admin portal.
    }
?>