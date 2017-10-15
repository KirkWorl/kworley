<?php

include '../../dbConnection.php';

$conn = getDatabaseConnection();

function getDeviceTypes() {
    global $conn;
    $sql = "SELECT DISTINCT(deviceType)
            FROM `tc_device` 
            ORDER BY deviceType";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        echo "<option> "  . $record['deviceType'] . "</option>";
        
    }
}


function displayDevices(){
    global $conn;
    
    $sql = "SELECT * FROM tc_device WHERE 1";
    
    if(isset($_GET['submit'])){
        $namedParameters = array();
        
        if(!empty($_GET['deviceName'])) {
            // The following query allows SQL injection due to the single quotes:
            // $sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND deviceName LIKE :deviceName"; //using named parameters
            $namedParameters[':deviceName'] = "%" . $_GET['deviceName'] . "%";
        }
         
        if(!empty($_GET['deviceType'])) {
            // The following query allows SQL injection due to the single quotes:
            // $sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
 
            $sql .= " AND deviceType = :dType"; //using named parameters
            $namedParameters[':dType'] = $_GET['deviceType'];
        }     
         
        if(isset($_GET['available'])) {
            $sql .= " AND status = 'A'";
        }
    
        if($_GET['orderBy'] == 'name') {
            $sql .= " ORDER BY deviceName";
        }
    
        if($_GET['orderBy'] == 'price') {
            $sql .= " ORDER BY price";
        }
        
    }
    
    if(!isset($_GET['orderBy'])) {
        $sql .= " ORDER BY deviceName"; 
    }
    
    
    /* 
    If user types a deviceName
       "AND deviceName LIKE '%$_GET['deviceName']%'";
    if user selects device type
       "AND deviceType = '$_GET['deviceType']";
    */
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table>";
    
    echo "<tr>
            <th>Device Name</th>
            <th>Device Type</th>
            <th>Price</th>
            <th>Status</th>
            <th>History</th>
         </tr>";

    foreach($records as $record) {
        echo "<tr>";
        echo "<td>" .$record['deviceName']. "</td>";
        echo "<td>" .$record['deviceType']. "</td>";
        echo "<td>" .$record['price']. "</td>";
        echo "<td>" .$record['status']. "</td>";
        echo "<td><a target='checkoutHistory' href='checkoutHistory.php?deviceId=".$record['deviceId']."'>Checkout History</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            @import url("css/style.css");
        </style>
        
        <title>Lab 5: Device Search</title>
    </head>
    
    <body>
        <h1>Technology Checkout Page</h1>
        <hr>
        
        <div id="content">
            <div id="theForm">
                <form>
                    Device: <input type="text" name="deviceName" placeholder="Device Name">
                    Type: 
                    <select name="deviceType">
                        <option value="">-- Select One --</option>
                        <?=getDeviceTypes()?>
                    </select>
                    
                    <input type="checkbox" name="available" id="available">
                    <label for="available">Available</label>
                    
                    <br>
                    Order by:
                    <input type="radio" name="orderBy" id="orderByName" value="name"/><label for="oderByName">Name</label>
                    <input type="radio" name="orderBy" id="orderByPrice" value="price"/><label for="oderByPrice">Price</label>
                    
                    <input type="submit" value="Search!" name="submit">
                </form>
                
                <hr>
                
                <?=displayDevices()?>
            </div>
        
    
            <div id="history">
                <h2> Checkout History </h2>
                <iframe name="checkoutHistory" width=525 height=400></iframe>
            </div>
        </div>
        
    </body>
</html>