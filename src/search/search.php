<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/search.css">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
</head>
<body>
<?php
require "../navbar.php";
error_reporting(5);
?>
    <div id="search">
        <div class="first">
            Search
        </div>
        <div class="second">
            <form action="search-action.php" method="post">
                <div class="by-title">
                    <div><input type="radio"  name="radio" value="1" checked><span>Filter by Title</span></div>
                    <input type="text"  name="title-text">
                </div>
                <div class="by-description">
                    <div><input type="radio" name="radio" value="2"><span>Filter by Description</span></div>
                    <textarea type="text"  name="description-text"></textarea>
                </div>
                <input type="submit" name="submit" value="Filter" id="input-btn">
            </form>
        </div>
    </div>
    <div id="result">
        <div class="first">
            Result
        </div>
        <div class="pics">
            <?php
            if (isset($_SESSION["search"])) {
                $pics = $_SESSION["search"];
                $pic_per_page = 5;
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }
                $start = ($page - 1) * $pic_per_page;
                $end = count($pics) - 1 < $start + $pic_per_page - 1 ? count($pics) - 1 : $start + $pic_per_page - 1;
                for ($i = $start; $i <= $end; $i++) {
                    $id = $pics[$i][0];
                    $path = $pics[$i][3];
                    $title = $pics[$i][1];
                    $description = $pics[$i][2];
                    echo "<div class=\"line\">";
                    echo "<div class=\"pic-div\">";
                    echo "<a href=\"../details/details.php?id=" . "$id" . "\"><img src=\"../../travel-images/large/" . "$path" . "\"></a>";
                    echo "</div>";
                    echo "<div class=\"text\">";
                    echo "<h1> " . $title . " </h1>";
                    echo "<article>" . $description . "</article>";
                    echo "</div>";
                    echo "</div>";
                }
                $page_num = ceil(count($pics) / $pic_per_page);
                if ($page_num > 5) {
                    $page_num = 5;
                }
                echo "<div class=\"foot\">";
                echo "<a href='search.php?page=" . ($page > 1 ? $page - 1 : 1) . "'>" . "<<" . "</a> ";
                for ($i = 1; $i <= $page_num; $i++) {
                    echo "<a href='search.php?page=" . $i . "'";
                    if ($page == $i) {
                        echo "class='sp_page_num'";
                    }
                    echo ">" . $i . "</a> ";
                };
                echo "<a href='search.php?page=" . ($page < $page_num ? $page + 1 : $page_num) . "'>" . ">>" . "</a> ";
                echo "</div>";
            }
            else{
                echo "目前没有搜索结果！";
            }
            ?>

        </div>
    </div>

    <div id="block">
        <span id="footer"> Copyright @2019-2023 19SS Web fundamental.All Rights Reserved.京ICP备18307110244号</span>
    </div>
</body>
</html>