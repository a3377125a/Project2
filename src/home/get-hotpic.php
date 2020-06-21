<?php
require_once "src/config.php";
error_reporting(5);


function get_hot_pic()
{
    $conn1 = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1="SELECT * FROM travelimagefavor";
    $result1 = $conn1->query($sql1);

    $favor = array();
    $row = $result1->fetch_all();
    foreach($row as $v) {
        $favor["$v[2]"]++;
    }

    arsort($favor);

    $favor_result = array();
    $k = 0;
    foreach ($favor as $x => $x_val) {
        $favor_result[$k] = $x;
        $k++;
    }
    $sql2 = "SELECT * FROM travelimage ";
    $result2 = $conn1->query($sql2);
    $img_num = count(($result2->fetch_all()));
    $images = array();

    for ($i = 0; $i < 6; $i++) {
        if ($i < count($favor_result)) {
            $imgID = $favor_result[$i];
        }
        else{
            $imgID = rand(1, $img_num);
        }
        $sql3 = "SELECT Title,Description,PATH FROM travelimage WHERE ImageID='$imgID';";
        $result3 = $conn1->query($sql3);
        $row = $result3->fetch_all();
        $images[$i][0] = $row[0][0];
        $images[$i][1] = $row[0][1];
        $images[$i][2] = $row[0][2];
        $images[$i][3] = $imgID;
    }
    return $images;
}


