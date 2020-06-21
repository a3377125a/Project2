
<?php

require_once "../config.php";

$title = addslashes($_POST["title-text"]);
$description = addslashes($_POST["description-text"]);
$content = addslashes($_POST["content"]);
$country = addslashes($_POST["country"]);
$city = addslashes($_POST["city"]);


if ($_POST["title-text"]==null||$_POST["description-text"]==null||ctype_space($_POST["title-text"])||ctype_space($_POST["description-text"])) {
    header("Location: upload.php");
    echo "<script>alert(\"请补全图片信息！\");</script>";
}
else {
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 20480000)    // 图片大小小于20mb。
        && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            $sql1 = "SELECT GeoNameID FROM geocities WHERE AsciiName='$city'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_all();
            $cityID = $row1[0][0];

            $sql2 = "SELECT ISO FROM geocountries_regions WHERE Country_RegionName='$country'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_all();
            $countryID = $row2[0][0];

            session_start();
            $username = $_SESSION["login"];
            $sql3 = "SELECT UID FROM traveluser WHERE UserName='$username'";
            $result3 = $conn->query($sql3);
            $row3 = $result3->fetch_all();
            $UID = $row3[0][0];

            $path = mt_rand(1000000000, 9999999999).".".$extension;         //生成文件名随机数。

            move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/" . $path);

            $sql4 = "INSERT INTO travelimage (Title,Description,CityCode,Country_RegionCodeISO,UID,PATH,Content) VALUES ('$title','$description','$cityID','$countryID','$UID','$path','$content')";
            $result4 = $conn->query($sql4);
            if ($result4) {
                echo "成功插入数据库！" . "<br>";
                echo $content;
            }else{
                echo "插入失败！" . "<br>";
            }
            echo "成功！";
        }
    }
    else
    {
        echo "文件格式不合法!";
        header("Location: upload.php");
    }
}



