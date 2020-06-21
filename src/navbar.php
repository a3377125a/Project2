
<?php
    session_start();

    echo "
    <div id=\"nav-bar\">
    <div id=\"icon\">
        <a href=\"../../index.php\"> <img src=\"../../images/home/icons/logo.jpg\" width=\"50px\" height=\"50px\"> </a>
    </div>
    <a  href=\"../../index.php\" class=\"link";
    if (strpos($_SERVER['PHP_SELF'], "index.php")) {
        echo " active";
    }
    echo "\">
        Home
    </a>
    <a href=\"../../src/browse/browse.php\" class=\"link";
    if (strpos($_SERVER['PHP_SELF'], "browse.php")) {
        echo " active";
    }

    echo "\">
        Browse
    </a>
    <a href=\"../../src/search/search.php\" class=\"link";
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
        <img class=\"menu-pic\" src=\"../../images/home/icons/menu.png\" alt=\"menu\" height=\"30px\" width=\"30px\">
        <div class=\"menu-content\">
            <a href=\"../../src/upload/upload.php\"> <img src=\"../../images/home/icons/upload.png\" height=\"30px\" width=\"30px\"> Upload</a>
            <a href=\"../../src/my-photos/my-photos.php\"> <img src=\"../../images/home/icons/photo.png\" height=\"30px\" width=\"30px\"> My photos</a>
            <a href=\"../../src/my-favor/my-favor.php\"> <img src=\"../../images/home/icons/collection.png\" height=\"30px\" width=\"30px\"> My Favorite</a>
            <a class=\"sp\" href=\"../../src/login/logout.php\"> <img  src=\"../../images/home/icons/logout.png\" height=\"28px\" width=\"28px\"> Logout</a>
        </div>
    </div>
        ";
    }
    else{
        echo "    
    <a href=\"../../src/login/login.php\" class=\"link right\">
        Login
    </a>
        ";
    }

    echo "</div>";






