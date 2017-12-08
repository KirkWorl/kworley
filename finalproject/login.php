<?php
include '../dbConnection.php';
session_start();
$conn = getDatabaseConnection();

if(isset($_GET['logout'])) {
    unset($_SESSION['username']);
    header("Location: index.html");
}

if(isset($_POST['submit'])) {
    $user = $_POST['auser'];
    $pass = sha1($_POST['apass']);
    
    $sql = "SELECT * FROM `sr_admin` WHERE username = :u AND password = :p";
    $namedParameters = array(":u" => $user, ":p" => $pass);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(empty($record)) {
        echo "<h3>Credentials Incorrect!</h3>";
    } else {
        $_SESSION['username'] = $record['username'];
        header("Location: admin.php");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <meta charset="utf-8">
        <meta name="author" value="Kirk Worley">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto|Vollkorn+SC" rel="stylesheet">
        <!-- Lobster = 'cursive', Roboto = 'san-serif', Vollkorn SC = 'serif' -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
            @import url("css/style.css");
            
            body {
                text-align: center;
            }
            
            #content2 {
                padding-top: 50px;
            }
            
            form {
                display: inline-block;
                padding: 5px;
            }
            
            input[type=text], input[type=password] {
                border-radius: 25px;
                color: black;
                width: 225px;
                padding-left: 26px;
                margin-bottom: 6px;
            }
            
            input[type=submit] {
                border-radius: 20px;
                width: 85px;
                height: 36px;
                padding: 4px 7px;
                font-family: "Roboto", sans-serif;
                background-color: lightgrey;
            }
            
            input[type=submit]:hover {
                color: white;
                background-color: grey;
                transition: .2s;
            }
            
            h1 {
                font-size: 40px;
                font-family: "Lobster", cursive;
            }
            
            h3 {
                font-family: "Lobster", cursive;
            }
            
            #back {
                margin-left: 0px;
            }
            
            #kuser {
                position: absolute;
                top: 136px;
                left: 730px;
            }
            
            #kpass {
                position: absolute;
                top: 170px; 
                left: 729px;
            }
        </style>
    </head>
    
    <body id="content">
        <div id="content2">
            <h1>Admin Login</h1>
            <i id="kuser" class="fa fa-keyboard-o" aria-hidden="true"></i>
            <i id="kpass" class="fa fa-key" aria-hidden="true"></i>
            <form method="POST">
                <span class="fancytext"> Username: </span><input type="text" name="auser" id="adminuser"/><br>
                <span class="fancytext"> Password: </span><input type="password" name="apass" id="adminpass"/><br>
                <input type="submit" name="submit" value="Login" id="loginsubmit"/>
            </form>
            
            <br>
            <button id="back" class="fancytext" onclick="location.href='index.html'; return false;">Back</button>
        </div>
    </body>
</html>