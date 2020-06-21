<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

</head>
<body>
    <?php
    session_start();

    echo "
    <div id=\"nav-bar\">
    <div id=\"icon\">
        <a href=\"index.php\"> <img src=\"images/home/icons/logo.jpg\" width=\"50px\" height=\"50px\"> </a>
    </div>
    <a  href=\"index.php\" class=\"link";
    if (strpos($_SERVER['PHP_SELF'], "index.php")) {
        echo " active";
    }
    echo "\">
        Home
    </a>
    <a href=\"src/browse/browse.php\" class=\"link";
    if (strpos($_SERVER['PHP_SELF'], "browse.php")) {
        echo " active";
    }

    echo "\">
        Browse
    </a>
    <a href=\"src/search/search.php\" class=\"link";
    if (strpos($_SERVER['PHP_SELF'], "search.php")) {
        echo " active";
    }
    echo "\">
        Search
    </a>
    ";
    if (isset($_SESSION["login"])) {
        echo "    
    <div class=\"menu\">
        <a href=\"#\" class=\"menu-btn\">My account</a>
        <img class=\"menu-pic\" src=\"images/home/icons/menu.png\" alt=\"menu\" height=\"30px\" width=\"30px\">
        <div class=\"menu-content\">
            <a href=\"src/upload/upload.php\"> <img src=\"images/home/icons/upload.png\" height=\"30px\" width=\"30px\"> Upload</a>
            <a href=\"src/my-photos/my-photos.php\"> <img src=\"images/home/icons/photo.png\" height=\"30px\" width=\"30px\"> My photos</a>
            <a href=\"src/my-favor/my-favor.php\"> <img src=\"images/home/icons/collection.png\" height=\"30px\" width=\"30px\"> My Favorite</a>
            <a class=\"sp\" href=\"src/login/logout.php\"> <img  src=\"images/home/icons/logout.png\" height=\"28px\" width=\"28px\"> Logout</a>
        </div>
    </div>
        ";
    }
    else{
        echo "    
    <a href=\"src/login/login.php\" class=\"link right\">
        Login
    </a>
        ";
    }
    echo "</div>";

    ?>
    <div id="big-image">
        <img src="images/home/scenes/home1.jpg" width="100%">
    </div>

    <?php
        require "src/home/get-hotpic.php";
        require "src/home/get-randompic.php";
        if (isset($_GET['refresh'])) {
            $images = get_random_pic();
        }
        else{
            $images = get_hot_pic();
        }
    ?>
    <div id="small-image">
        <div class="line1">
            <div class="col1">
                <div class="pic1">
                    <?php echo "<a href=\"src/details/details.php?id=".$images[0][3]."\">"?>
                        <?php
                        echo "<img src=\"travel-images/large/".$images[0][2]."\">";
                        ?>
                    </a>
                </div>
                <div class="text">
                    <h1><?php echo $images[0][0]; ?></h1>
                    <span><?php echo $images[0][1]; ?></span>
                </div>
            </div>
            <div class="col2">
                <div class="pic1">
                    <?php echo "<a href=\"src/details/details.php?id=".$images[1][3]."\">"?>
                        <?php
                        echo "<img src=\"travel-images/large/".$images[1][2]."\">";
                        ?>
                    </a>
                </div>
                <div class="text">
                    <h1><?php echo $images[1][0]; ?></h1>
                    <span><?php echo $images[1][1]; ?></span>
                </div>
            </div>
            <div class="col3">
                <div class="pic1">
                    <?php echo "<a href=\"src/details/details.php?id=".$images[2][3]."\">"?>
                        <?php
                        echo "<img src=\"travel-images/large/".$images[2][2]."\">";
                        ?>
                    </a>
                </div>
                <div class="text">
                    <h1><?php echo $images[2][0]; ?></h1>
                    <span><?php echo $images[2][1]; ?></span>
                </div>
            </div>
        </div>
        <div class="line2">
            <div class="col1">
                <div class="pic1">
                    <?php echo "<a href=\"src/details/details.php?id=".$images[3][3]."\">"?>
                        <?php
                        echo "<img src=\"travel-images/large/".$images[3][2]."\">";
                        ?>
                    </a>
                </div>
                <div class="text">
                    <h1><?php echo $images[3][0]; ?></h1>
                    <span><?php echo $images[3][1]; ?></span>
                </div>
            </div>
            <div class="col2">
                <div class="pic1">
                    <?php echo "<a href=\"src/details/details.php?id=".$images[4][3]."\">"?>
                        <?php
                        echo "<img src=\"travel-images/large/".$images[4][2]."\">";
                        ?>
                    </a>
                </div>
                <div class="text">
                    <h1><?php echo $images[4][0]; ?></h1>
                    <span><?php echo $images[4][1]; ?></span>
                </div>
            </div>
            <div class="col3">
                <div class="pic1">
                    <?php echo "<a href=\"src/details/details.php?id=".$images[5][3]."\">"?>
                        <?php
                        echo "<img src=\"travel-images/large/".$images[5][2]."\">";
                        ?>
                    </a>
                </div>
                <div class="text">
                    <h1><?php echo $images[5][0]; ?></h1>
                    <span><?php echo $images[5][1]; ?></span>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="foot-col1">
            <a href="##">使用条款</a><br><br><br><br>
            <a href="##">隐私保护</a><br><br><br><br>
            <a href="##">Cookie</a>
        </div>
        <div class="foot-col2">
            <a href="##">关于</a><br><br><br><br>
            <a href="##">联系我们</a><br>
        </div>
        <div class="foot-col3">
            <div>
                <a href="##"><img src="images/home/icons/wechat.png"></a>
                <a href="##"><img src="images/home/icons/twitter.png"></a>
            </div>
            <div>
                <a href="##"><img src="images/home/icons/QQ.png"></a>
                <a href="##"><img src="images/home/icons/github.png"></a>
            </div>
        </div>
        <img id="QR-code" src="images/home/icons/code.png">

        <div id="copyright"> Copyright @2019-2023 19SS Web fundamental.All Rights Reserved.<br>京ICP备18307110244号  </div>
    </footer>
    <div id="fixed-icon">
        <a href="index.php?refresh=1">
            <img src="images/home/icons/refresh.png" width="50" onclick="alert('图⽚已刷新!')">
        </a>
        <a href="index.php#nav-bar">
            <img id="first" src="images/home/icons/totop.png" width="56">
        </a>
    </div>




</body>
</html>