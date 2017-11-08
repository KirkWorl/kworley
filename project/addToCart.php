<?php
session_start();
if(!isset($_SESSION['currentCart'])) {
    $arr = array();
    array_push($arr, $_GET['addCart']);
    $_SESSION['currentCart'] = $arr;
}
else {
    $arr = array();
    $arr = $_SESSION['currentCart'];
    array_push($arr, $_GET['addCart']);
    $_SESSION['currentCart'] = $arr;
}
header('Location: index.php');
?>