<?php

function displayCheckoutHistory() {
    include "../../dbConnection.php";
    
    $conn = getDatabaseConnection();
    
    $sql = "SELECT * FROM `tc_checkout`
            NATURAL JOIN tc_device
            NATURAL JOIN tc_user
            WHERE deviceId = :deviceId";
            
    $namedParam = array(":deviceId" => $_GET['deviceId']);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table>";
    echo "<tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>User ID</th>
            <th>Gender</th>
            <th>Checkout Date</th>
            <th>Due Date</th>
         </tr>";
             
    foreach($records as $r) {
        echo "<tr>";
        echo "<td>" .$r['firstName']. "</td>";
        echo "<td>" .$r['lastName']. "</td>";
        echo "<td>" .$r['userId']. "</td>";
        echo "<td>" .$r['gender']. "</td>";
        echo "<td>" .$r['checkoutDate']. "</td>";
        echo "<td>" .$r['dueDate']. "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Checkout History </title>
        <meta charset="utf-8">
        <style>
            @import url("css/style.css");
        </style>
    </head>
    <body>
        
        <?=displayCheckoutHistory()?>

    </body>
</html>