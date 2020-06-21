<?php

require_once "../config.php";
$imgID = $_POST["imgID"];

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$sql1 = "SELECT PATH FROM travelimage WHERE ImageID='$imgID'";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_all();
$path1 = $row1[0][0];
$path2 = "../../travel-images/large/" . $path1;
if (file_exists($path2)) {
    unlink($path2);
}
$sql2 = "DELETE FROM travelimage WHERE ImageID='$imgID'";
$result2 = $conn->query($sql2);

$sql3 = "DELETE FROM travelimagefavor WHERE ImageID='$imgID'";
$result3 = $conn->query($sql3);


echo json_encode("删除成功");

