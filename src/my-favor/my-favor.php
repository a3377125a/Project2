<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Favor</title>

    <script src="../../jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/favor.css">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">

</head>
<body>
<?php
require "../navbar.php";
?>

<div id="photo">
    <div class="first">
        My Favor
    </div>
    <div class="pics">

    <?php
    require "../config.php";
    error_reporting(5);
    session_start();
    $username = $_SESSION["login"];
    $conn1 = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $sql1 = "SELECT UID FROM traveluser WHERE UserName='$username'";
    $result1 = $conn1->query($sql1);
    $row1 = $result1->fetch_all();
    $userID = $row1[0][0];
    $sql2 = "SELECT ImageID FROM travelimagefavor WHERE UID='$userID'";
    $result2 = $conn1->query($sql2);
    $row2 = $result2->fetch_all();
    $total = count($row2);
    if ($total == 0) {
        ?>
        <div class="tip">
            <h1>您还没有收藏照片，赶紧点击照片详情页内的收藏按钮增加一张吧!</h1>
        </div>
        <?php
    } else {
    $pic_per_page = 4;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $start_from = ($page - 1) * $pic_per_page;
    $sql3 = "SELECT ImageID FROM travelimagefavor WHERE UID='$userID' LIMIT $start_from, $pic_per_page";
    $result3 = $conn1->query($sql3);
    $row3 = $result3->fetch_all();
    for ($i = 0; $i < count($row3); $i++) {
        $imgID = $row3[$i][0];
        $sql4 = "SELECT Title,Description,PATH FROM travelimage WHERE ImageID='$imgID'";
        $result4 = $conn1->query($sql4);
        $row4 = $result4->fetch_all();
        $title = $row4[0][0];
        $text = $row4[0][1];
        $path = $row4[0][2];
        ?>
        <div class="blocks">
            <div class="pic-div">
                    <?php
                    echo "<a href=\"../details/details.php?id=" . "$imgID" . "\">".
                     "<img src=\"http://localhost:1234/Project2/travel-images/large/"."$path"."\" ></a>";
                    ?>
            </div>
            <div class="right">
                <div class="text">
                    <h1> <?php echo $title;?> </h1>
                    <article>
                            <?php echo $text; ?>
                    </article>
                </div>
                <div class="buttons">
                    <?php
                    echo "<a href=\"##\" class=\"delete\" id=\"$imgID\" >"."Delete";
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    $page_num = ceil($total / $pic_per_page);
    if ($page_num > 5) {
        $page_num = 5;
    }
        ?>

        <div class="foot">
        <?php
        echo "<a href='my-favor.php?page=" . ($page > 1 ? $page - 1 : 1) . "'>" . "<<" . "</a> ";
        for ($i = 1; $i <= $page_num; $i++) {
            echo "<a href='my-favor.php?page=" . $i . "'";
            if ($page == $i) {
                echo "class='sp_page_num'";
            }
            echo ">" . $i . "</a> ";
        };
        echo "<a href='my-favor.php?page=" . ($page < $page_num ? $page + 1 : $page_num) . "'>" . ">>" . "</a> ";
        }
        ?>
        </div>

    </div>

    <div id="block">
        <span id="footer"> Copyright @2019-2023 19SS Web fundamental.All Rights Reserved.京ICP备18307110244号</span>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".delete").click(function(e) {
            let x = $(e.target).prop("id");
            $.ajax({
                type: "post",
                url: "cancel-love.php",
                async:false,
                data: {
                    "imgID":x
                },
                dataType: "json",
                cache:true,
                success: function (data) {
                    alert(data);
                    window.location.reload();
                },
                error: function (msg) {
                    alert("shibai!");
                }
            });
        });

    });

</script>


</body>
</html>