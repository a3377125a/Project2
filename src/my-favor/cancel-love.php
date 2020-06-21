<?php

require_once "../config.php";

session_start();


if (!isset($_SESSION["login"])) {
    $result = "请登录！";
} else {
    $username = $_SESSION["login"];
    $imgID = $_POST["imgID"];

    $conn1 = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1="SELECT UID FROM traveluser WHERE UserName='$username'";
    $result1 = $conn1->query($sql1);
    $row1 = $result1->fetch_all();
    $userID = $row1[0][0];

    $sql3 = "DELETE FROM travelimagefavor WHERE ImageID='$imgID' and UID='$userID'";
    $conn1->query($sql3);

    $result = "删除成功！";



}
echo json_encode($result);
