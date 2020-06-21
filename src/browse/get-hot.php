<?php
require_once "../config.php";
error_reporting(5);


function gethotcontent()
{
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1 = "SELECT Content FROM travelimage";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();

    $a = array();
    for ($i = 0; $i < count($row1);$i++) {
        $a[$i] = $row1[$i][0];
    }
    $b = array_count_values($a);
    arsort($b);
    $result = array();
    $k = 0;
    foreach ($b as $key => $value) {
        $result[$k] = $key;
        $k++;
    }
    return $result;
}

function gethotcountry()
{
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1 = "SELECT Country_RegionCodeISO FROM travelimage";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();

    $a = array();
    for ($i = 0; $i < count($row1);$i++) {
        $a[$i] = $row1[$i][0];
    }
    $b = array_count_values($a);
    arsort($b);
    $result = array();
    $k = 0;
    foreach ($b as $key => $value) {
        $result[$k] = $key;
        $k++;
    }
    $q = array();
    for ($i = 0; $i < count($result); $i++) {
        $sql2 = "SELECT Country_RegionName FROM geocountries_regions WHERE ISO='$result[$i]'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_all();
        $q[$i] = $row2[0][0];
    }

    return $q;
}
function gethotcity()
{
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1 = "SELECT CityCode FROM travelimage";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();

    $a = array();
    for ($i = 0; $i < count($row1);$i++) {
        $a[$i] = $row1[$i][0];
    }
    $b = array_count_values($a);
    arsort($b);
    $result = array();
    $k = 0;
    foreach ($b as $key => $value) {
        $result[$k] = $key;
        $k++;
    }
    $q = array();
    for ($i = 0; $i < count($result); $i++) {
        $sql2 = "SELECT AsciiName FROM geocities WHERE GeoNameID='$result[$i]'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_all();
        $q[$i] = $row2[0][0];
    }
    return $q;
}