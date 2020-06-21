<?php
require_once "src/config.php";
error_reporting(5);


function get_random_pic()
{
    $conn1 = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);


    $sql2 = "SELECT Title,Description,PATH,ImageID FROM travelimage";
    $result2 = $conn1->query($sql2);
    $row = $result2->fetch_all();
    $img_num = count($row);

    $images = array();
    $IDs = array();
    $length = 0;
    $flag = false;
    while ($length < 6) {

        $index = rand(0, $img_num - 1);
        if ($length > 0) {
            for ($i = 0; $i < $length; $i++) {
                if ($IDs[$i] == $index) {
                    $flag = true;
                }
            }
            if ($flag == false) {
                $IDs[$length] = $index;
                $ans = $row[$index];
                $images[$length][0] = $ans[0];
                $images[$length][1] = $ans[1];
                $images[$length][2] = $ans[2];
                $images[$length][3] = $ans[3];
                $length++;
            } else {
                $flag = false;
            }
        }
        else{
            $IDs[$length] = $index;
            $ans = $row[$index];
            $images[$length][0] = $ans[0];
            $images[$length][1] = $ans[1];
            $images[$length][2] = $ans[2];
            $images[$length][3] = $ans[3];
            $length++;
        }

    }

    return $images;
}



