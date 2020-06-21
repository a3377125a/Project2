<?php

require_once "../config.php";
session_start();
$result = array();
if (!isset($_SESSION["login"])) {
    $result = 0;
} else {
    $imgID = $_POST["imgID"];
    $username = $_SESSION["login"];


    $conn1 = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1="SELECT UID FROM traveluser WHERE UserName='$username'";
    $result1 = $conn1->query($sql1);
    $row1 = $result1->fetch_all();
    $userID = $row1[0][0];

    $sql2 = "SELECT ImageID FROM travelimagefavor WHERE UID='$userID'";
    $result2 = $conn1->query($sql2);
    $row2 = $result2->fetch_all();

    $flag = false;
    for ($i = 0; $i < count($row2); $i++) {
        if ($row2[$i][0] == $imgID) {
            $flag = true;
        }
    }
    if ($flag) {
        $flag = false;
        $sql3 = "DELETE FROM travelimagefavor WHERE ImageID='$imgID' and UID='$userID'";
        $conn1->query($sql3);
        $result = 1;

    } else {
        $sql4 = "INSERT INTO travelimagefavor (UID,ImageID) VALUES ('$userID','$imgID')";
        $conn1->query($sql4);
        $result = 2;

    }

}


echo json_encode($result);
