<?php
    $host = 'localhost';
    $dbname = 'tcp';
    $username = 'root';
    $password = '';
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    function getUsersAndDepartments() {
        global $dbConn;
        
        $sql = "SELECT * FROM `tc_user` INNER JOIN `tc_department` ON tc_user.deptId = tc_department.departmentId";
        
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        $records = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        // print_r($records);
        
        foreach($records as $r) {
            echo $r['firstName'] . '  ' . $r['lastName'] . '  ' . $r['deptName'] . "<br/>";
        }
    }
    
    function getUsersWithTablets() {
        global $dbConn;
        
        $sql = "";
        
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>SQL Joins</title>
    </head>
    <body>
        <h2>Users and their corresponding departments (order by last name)</h2>
        
        <?=getUsersAndDepartments()?>

    </body>
</html>