<?php

require_once "../config.php";
error_reporting(5);

session_start();
if ($_POST["title"]) {
    $a = $_POST["title"];
    $_POST["title"] = null;
    $b = trim($a);
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql = "SELECT ImageID,PATH FROM travelimage WHERE Title LIKE '%$b%' ";

    $result = $conn->query($sql);
    $row = $result->fetch_all();


    $_SESSION["browse"] = $row;
    echo json_encode(count($row));
} elseif ($_POST["content-label"]) {
    $a = $_POST["content-label"];
    $_POST["content-label"] = null;
    $b = strtolower(trim($a));

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql = "SELECT ImageID,PATH FROM travelimage WHERE Content='$b'";

    $result = $conn->query($sql);
    $row = $result->fetch_all();


    $_SESSION["browse"] = $row;
    echo json_encode(count($row));

} elseif ($_POST["country-label"]) {
    $a = $_POST["country-label"];
    $_POST["country-label"] = null;
    $b = strtolower(trim($a));

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql1 = "SELECT ISO FROM geocountries_regions WHERE Country_RegionName='$b'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();

    $ISO = $row1[0][0];

    $sql = "SELECT ImageID,PATH FROM travelimage WHERE Country_RegionCodeISO='$ISO'";

    $result = $conn->query($sql);
    $row = $result->fetch_all();


    $_SESSION["browse"] = $row;
    echo json_encode(count($row));
} elseif ($_POST["city-label"]) {
    $a = $_POST["city-label"];
    $_POST["city-label"] = null;
    $b = strtolower(trim($a));

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql1 = "SELECT GeoNameID FROM geocities WHERE AsciiName='$b'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();

    $ID = $row1[0][0];

    $sql = "SELECT ImageID,PATH FROM travelimage WHERE CityCode='$ID'";

    $result = $conn->query($sql);
    $row = $result->fetch_all();

    $_SESSION["browse"] = $row;
    echo json_encode(count($row));
} else {
    $a = $_POST["content"];
    $b = $_POST["country"];
    $c = $_POST["city"];
    $_POST = array();
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    if ($a == "Filter By Content") {
        $sql1 = "SELECT ImageID,PATH FROM travelimage";
    } else {
        $sql1 = "SELECT ImageID,PATH FROM travelimage WHERE Content='$a'";
    }

    if ($b == "Filter By Country") {
        $sql2 = "SELECT ImageID,PATH FROM travelimage";
    } else {
        $sql = "SELECT ISO FROM geocountries_regions WHERE Country_RegionName='$b'";
        $result = $conn->query($sql);
        $row = $result->fetch_all();
        $ISO = $row[0][0];
        $sql2 = "SELECT ImageID,PATH FROM travelimage WHERE Country_RegionCodeISO='$ISO'";
    }

    if ($c == "Filter By City") {
        $sql3 = "SELECT ImageID,PATH FROM travelimage";
    } else {
        $sql = "SELECT GeoNameID FROM geocities WHERE AsciiName='$c'";
        $result = $conn->query($sql);
        $row = $result->fetch_all();
        $cityID = $row[0][0];
        $sql3 = "SELECT ImageID,PATH FROM travelimage WHERE CityCode='$cityID'";
    }
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();
    $arr1 = array();
    for ($i = 0; $i < count($row1); $i++) {
        $arr1[$row1[$i][0]] = $row1[$i][1];
    }


    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_all();
    $arr2 = array();
    for ($i = 0; $i < count($row2); $i++) {
        $arr2[$row2[$i][0]] = $row2[$i][1];
    }

    $result3 = $conn->query($sql3);
    $row3 = $result3->fetch_all();
    $arr3 = array();
    for ($i = 0; $i < count($row3); $i++) {
        $arr3[$row3[$i][0]] = $row3[$i][1];
    }

    $x = array_intersect($arr1, $arr2, $arr3);
    $y = array();
    $k = 0;
    foreach ($x as $key => $value) {
        $y[$k][0] = $key;
        $y[$k][1] = $value;
        $k++;
    }


    $_SESSION["browse"] = $y;
    echo json_encode(count($y));



}













//echo json_encode($row);
