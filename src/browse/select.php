<?php


require_once "../config.php";
error_reporting(5);

function get10Country()
{
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1 = "SELECT ISO,Population FROM geocountries_regions";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();
    $arr1 = array();
    for ($i = 0; $i < count($row1); $i++) {
        $arr1[$row1[$i][0]] = $row1[$i][1];
    }
    arsort($arr1);
    $arr2 = array();
    $k = 0;
    foreach ($arr1 as $key => $value) {
        $arr2[$k] = $key;
        $k++;
        if ($k == 10) {
            break;
        }
    }
    $result = array();
    for ($i = 0; $i < 10; $i++) {
        $sql2 = "SELECT Country_RegionName FROM geocountries_regions WHERE ISO='$arr2[$i]'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_all();
        $result[$i] = $row2[0][0];
    }
    return $result;
}
function get10City($country)
{
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1 = "SELECT ISO FROM geocountries_regions WHERE Country_RegionName='$country'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();
    $ISO = $row1[0][0];

    $sql2 = "SELECT AsciiName,Population FROM geocities WHERE Country_RegionCodeISO='$ISO'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_all();

    $arr1 = array();
    for ($i = 0; $i < count($row2); $i++) {
        $arr1[$row2[$i][0]] = $row2[$i][1];
    }
    arsort($arr1);
    $arr2 = array();
    $k = 0;
    foreach ($arr1 as $key => $value) {
        $arr2[$k] = $key;
        $k++;
        if ($k == 10) {
            break;
        }
    }
    return $arr2;


}



