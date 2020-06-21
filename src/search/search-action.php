<?php

require "../config.php";
error_reporting(5);
session_start();

if ($_POST['radio'] == 1) {
    $text = $_POST['title-text'];
    $b = trim($text);
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql = "SELECT ImageID,Title,Description,PATH FROM travelimage WHERE Title LIKE '%$b%'; ";
    $result = $conn->query($sql);
    $row = $result->fetch_all();

}else{
    $text = $_POST['description-text'];
    $b = trim($text);
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql = "SELECT ImageID,Title,Description,PATH FROM travelimage WHERE Description LIKE '%$b%'; ";
    $result = $conn->query($sql);
    $row = $result->fetch_all();
}
$_SESSION["search"] = $row;
header("location:search.php");




