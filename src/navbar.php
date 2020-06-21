
<?php
    session_start();

    echo "
    <div id=\"nav-bar\">
    <div id=\"icon\">
        <a href=\"http://localhost:1234/Project2/index.php\"> <img src=\"http://localhost:1234/Project2/images/home/icons/logo.jpg\" width=\"50px\" height=\"50px\"> </a>
    </div>
    <a  href=\"http://localhost:1234/Project2/index.php\" class=\"link";
    if (strpos($_SERVER['PHP_SELF'], "index.php")) {
        echo " active";
    }
    echo "\">
        Home
    </a>
    <a href=\"http://localhost:1234/Project2/src/browse/browse.php\" class=\"link";
    if (strpos($_SERVER['PHP_SELF'], "browse.php")) {
        echo " active";
    }

    echo "\">
        Browse
    </a>
    <a href=\"http://localhost:1234/Project2/src/search/search.php\" class=\"link";
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
        <img class=\"menu-pic\" src=\"http://localhost:1234/Project2/images/home/icons/menu.png\" alt=\"menu\" height=\"30px\" width=\"30px\">
        <div class=\"menu-content\">
            <a href=\"http://localhost:1234/Project2/src/upload/upload.php\"> <img src=\"http://localhost:1234/Project2/images/home/icons/upload.png\" height=\"30px\" width=\"30px\"> Upload</a>
            <a href=\"http://localhost:1234/Project2/src/my-photos/my-photos.php\"> <img src=\"http://localhost:1234/Project2/images/home/icons/photo.png\" height=\"30px\" width=\"30px\"> My photos</a>
            <a href=\"http://localhost:1234/Project2/src/my-favor/my-favor.php\"> <img src=\"http://localhost:1234/Project2/images/home/icons/collection.png\" height=\"30px\" width=\"30px\"> My Favorite</a>
            <a class=\"sp\" href=\"http://localhost:1234/Project2/src/login/logout.php\"> <img  src=\"http://localhost:1234/Project2/images/home/icons/logout.png\" height=\"28px\" width=\"28px\"> Logout</a>
        </div>
    </div>
        ";
    }
    else{
        echo "    
    <a href=\"http://localhost:1234/Project2/src/login/login.php\" class=\"link right\">
        Login
    </a>
        ";
    }

    echo "</div>";






