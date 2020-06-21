<?php

require_once "../config.php";

function testUser()
{


    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    $sql1 = "SELECT UserName,Pass FROM traveluser ";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();
    $flag = false;
    for ($i = 0; $i < count($row1); $i++) {
        if ($row1[$i][0] == $username) {
            if($password==$row1[$i][1]) {
                $flag = true;
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql2 = "UPDATE traveluser SET Pass='$hash' WHERE UserName='$username' ";
                $result2 = $conn->query($sql2);
            } elseif (password_verify($password, $row1[$i][1])) {
                $flag = true;
            }
        }
    }
    if($flag){
        $_SESSION["login"] = $username;
        return true;
    } else {
        return false;
    }
}