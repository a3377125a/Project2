<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>

    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/upload.css">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
    <script src="../../jquery-3.3.1.min.js"></script>

</head>
<body>
<?php
require "../navbar.php";
require "../browse/select.php";
require_once "../config.php";
$select_country = get10Country();

if ($_GET["imgID"]) {
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $imgID_now = $_GET["imgID"];

    $sql1 = "SELECT Title,Description,PATH FROM travelimage WHERE ImageID='$imgID_now'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_all();
    $title_now = $row1[0][0];
    $description_now = $row1[0][1];
    $path_now = $row1[0][2];

}



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = addslashes($_POST["title-text"]);
    $description = addslashes($_POST["description-text"]);
    $content = addslashes(strtolower($_POST["content"]));
    $country = addslashes($_POST["country"]);
    $city = addslashes($_POST["city"]);

    $flag = $_POST["imgID"];
    if ($_POST["title-text"]==null||$_POST["description-text"]==null||ctype_space($_POST["title-text"])||ctype_space($_POST["description-text"])) {
        echo "<script>alert(\"请补全图片信息！\");</script>";
        $_POST = array();
    }
    else {
        if (isset($_POST["imgID"])) {
            $imgID = $_POST["imgID"];
            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            $sql1 = "SELECT GeoNameID FROM geocities WHERE AsciiName='$city'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_all();
            $cityID = $row1[0][0];

            $sql2 = "SELECT ISO FROM geocountries_regions WHERE Country_RegionName='$country'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_all();
            $countryID = $row2[0][0];

            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);

            if (($_FILES["file"]["type"])!=="") {                                       //判断是否上传了新的图片文件。
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
                        echo "<script>alert(\"发生错误！\");</script>";
                    }
                    else{                                                               //替换原来的图片。
                        $sql3 = "SELECT PATH FROM travelimage WHERE ImageID='$imgID'";
                        $result3 = $conn->query($sql3);
                        $row3 = $result3->fetch_all();
                        $path1 = $row3[0][0];
                        $path2="../../travel-images/large/" . $path1;
                        if (file_exists($path2)) {
                            unlink($path2);
                        }
                        move_uploaded_file($_FILES["file"]["tmp_name"], "../../travel-images/large/" . $path1);
                    }
                }
                else{
                    echo "<script>alert(\"文件大小或格式不合法！\\n只允许上传20mb以内的图片文件。\");</script>";
                }
                $_FILES = array();
            }



            $sql4 = "UPDATE travelimage SET Title='$title',Description='$description',CityCode='$cityID',
                    Country_RegionCodeISO='$countryID',Content='$content' WHERE ImageID='$imgID'";
            $result4 = $conn->query($sql4);
            if ($result4) {
                echo "<script>alert(\"图片修改成功！\");</script>";
            }else{
                echo "<script>alert(\"发生错误！\");</script>";
            }
        }
        else{
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
                    echo "<script>alert(\"发生错误！\");</script>";
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

                    move_uploaded_file($_FILES["file"]["tmp_name"], "../../travel-images/large/" . $path);

                    $sql4 = "INSERT INTO travelimage (Title,Description,CityCode,Country_RegionCodeISO,UID,PATH,Content) VALUES ('$title','$description','$cityID','$countryID','$UID','$path','$content')";
                    $result4 = $conn->query($sql4);
                    if ($result4) {
                        echo "<script>alert(\"图片上传成功！\");</script>";
                    }else{
                        echo "<script>alert(\"发生错误！\");</script>";
                    }
                }
            }
            else
            {
                echo "<script>alert(\"文件大小或格式不合法！\\n只允许上传20mb以内的图片文件。\");</script>";
            }
        }

        $_POST = array();
    }
}


?>

<div id="upload">
    <div class="first">
        Upload
    </div>
    <div class="main">
        <form class="container" action="upload.php" enctype="multipart/form-data" method="post" id='formBox'
              name="form">
            <div class="button">
                <?php
                if ($_GET["imgID"]) {
                    echo "<img id=\"cropedBigImg\" src='../../travel-images/large/" . $path_now . "'>";
                } else {
                    echo "<img id=\"cropedBigImg\">";
                }
                ?>
                <input type="file" id="chooseImage" name="file">
                <script>
                    $('#chooseImage').on('change', function () {
                        var filePath = $(this).val(),
                            fileFormat = filePath.substring(filePath.lastIndexOf(".")).toLowerCase(),
                            src = window.URL.createObjectURL(this.files[0]);
                        if (fileFormat.match(/.png|.jpg|.jpeg/)) {
                            $('#cropedBigImg').attr('src', src);
                        }
                    });
                </script>

            </div>
            <script>
                $(document).ready(function () {
                    $("#country").change(function () {
                        let x = $("#country").find("option:selected").text();
                        $.ajax({
                            type: "post",
                            url: "select-city.php",
                            async: false,
                            data: {
                                "countryName": x
                            },
                            dataType: "json",
                            cache: true,
                            success: function (data) {
                                $("#city").empty();
                                for (let i = 0; i < 10; i++) {
                                    $("#city").append($('<option value="' + data[i] + '">' + data[i] + '</option>'));
                                }
                            },
                            error: function (msg) {
                                alert("shibai!");
                            }
                        });
                    });
                });
            </script>
            <div class="text">
                <div class="title">
                    <span>图片标题：</span><br>
                    <?php
                    if ($_GET["imgID"]) {
                        echo "<input type=\"text\" value='" . $title_now . "' name=\"title-text\">";
                    } else {
                        echo "<input type=\"text\"  name=\"title-text\">";
                    }
                    ?>
                </div>
                <div class="description">
                    <span>图片描述：</span><br>
                    <textarea type="text" name="description-text"><?php
                        if ($_GET["imgID"]) {
                            echo $description_now;
                        }
                        ?></textarea>
                </div>
                <div class="content">
                    <span>图片主题：</span><br>
                    <select id="content" name="content">
                        <option value="Scenery">Scenery</option>
                        <option value="City">City</option>
                        <option value="People">People</option>
                        <option value="Animal">Animal</option>
                        <option value="Building">Building</option>
                        <option value="Wonder">Wonder</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="country">
                    <span>拍摄国家：</span><br>
                    <select id="country" name="country">
                        <?php
                        for ($i = 0; $i < 10; $i++) {
                            echo "<option value=\"$select_country[$i]\">" . "$select_country[$i]" . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="city">
                    <span>拍摄城市：</span><br>
                    <select id="city" name="city">
                        <option value="Shanghai">Shanghai</option>
                        <option value="Zhumadian">Zhumadian</option>
                        <option value="Beijing">Beijing</option>
                        <option value="Nanchong">Nanchong</option>
                        <option value="Tai'an">Tai'an</option>
                        <option value="Yueyang">Yueyang</option>
                        <option value="Kaifeng">Kaifeng</option>
                        <option value="Wuhan">Wuhan</option>
                        <option value="Chongqing">Chongqing</option>
                        <option value="Chengdu">Chengdu</option>
                    </select>
                </div>

                <?php
                if ($_GET["imgID"]) {
                    echo "<input type=\"text\" value='".$imgID_now."' style=\"display: none\" name=\"imgID\"/>";
                }
                ?>
                <button><?php
                    if ($_GET["imgID"]) {
                        echo "Modify";
                    } else {
                        echo "Submit";
                    }
                    ?></button>
            </div>
        </form>
    </div>

</div>
<div id="block">
    <span id="footer"> Copyright @2019-2023 19SS Web fundamental.All Rights Reserved.京ICP备18307110244号.</span>
</div>
</body>
</html>