<?php
include '../../dbConnection.php';

$conn = getDatabaseConnection();

$sql = "SELECT * FROM `tc_user` WHERE username = :username";
$namedParameters[":username"] = $_GET['username'];

$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($record);
?>