<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse</title>

    <script src="../../jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/browse.css">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">


</head>
<body>
<?php
require "../navbar.php";
require "get-hot.php";
require "select.php";
$hot_content = gethotcontent();
$hot_country = gethotcountry();
$hot_city = gethotcity();
$select_country = get10Country();

session_start();

?>

    <aside>
        <div id="search">
            <div class="first">
                Search by Title
            </div>
            <div class="second">
                <input id="search-input" type="text">
                <a href="##" id="search-btn" >
                    <div>
                        <img src="../../images/browse/icons/search.png" width="16px">
                    </div>
                </a>
            </div>
        </div>
        <div class="tabs">
            <div class="first">
                Hot Content
            </div>
            <div class="item">
                <a href="##" class="content-label"> <?php echo ucfirst($hot_content[0]);?> </a>
            </div>
            <div class="item">
                <a href="##" class="content-label"><?php echo ucfirst($hot_content[1]);?> </a>
            </div>
            <div class="item">
                <a href="##" class="content-label"><?php echo ucfirst($hot_content[2]);?> </a>
            </div>
            <div class="item">
                <a href="##" class="content-label"> <?php echo ucfirst($hot_content[3]);?> </a>
            </div>
        </div>
        <div class="tabs">
            <div class="first">
                Hot Country
            </div>
            <div class="item">
                <a href="##" class="country-label"><?php echo ucfirst($hot_country[0]);?> </a>
            </div>
            <div class="item">
                <a href="##" class="country-label"> <?php echo ucfirst($hot_country[1]);?></a>
            </div>
            <div class="item">
                <a href="##" class="country-label"> <?php echo ucfirst($hot_country[2]);?> </a>
            </div>
            <div class="item">
                <a href="##" class="country-label"><?php echo ucfirst($hot_country[3]);?> </a>
            </div>

        </div>
        <div class="tabs">
            <div class="first">
                Hot City
            </div>
            <div class="item">
                <a href="##" class="city-label"> <?php echo ucfirst($hot_city[0]);?> </a>
            </div>
            <div class="item">
                <a href="##" class="city-label"> <?php echo ucfirst($hot_city[1]);?></a>
            </div>
            <div class="item">
                <a href="##" class="city-label"><?php echo ucfirst($hot_city[2]);?> </a>
            </div>
            <div class="item">
                <a href="##" class="city-label"> <?php echo ucfirst($hot_city[3]);?> </a>
            </div>
        </div>

    </aside>


    <div id="main">
        <div class="first">
            Filter
        </div>

        <script>
            $(document).ready(function(){
                $("#country").change(function () {
                    let x = $("#country").find("option:selected").text();
                    $.ajax({
                        type: "post",
                        url: "select-city.php",
                        async:false,
                        data: {
                            "countryName": x
                        },
                        dataType: "json",
                        cache:true,
                        success: function (data) {
                            $("#city")
                                .empty()
                                .append($('<option>Filter By City</option>'));
                            for (let i = 0; i < 10; i++) {
                                $("#city").append($('<option>' + data[i] + '</option>'));
                            }
                        },
                        error: function (msg) {
                            alert("shibai!");
                        }
                    });

                });
            });
        </script>
        <div class="filter">
            <select id="content">
                <option>Filter By Content</option>
                <option value="0">Scenery</option>
                <option value="1">City</option>
                <option value="2">People</option>
                <option value="3">Animal</option>
                <option value="4">Building</option>
                <option value="5">Wonder</option>
            </select>
            <select id="country">
                <option value="-1">Filter By Country</option>
                <?php
                for ($i = 0; $i < 10; $i++){
                    echo "<option value=\"$i\">"."$select_country[$i]"."</option>";
                }
                ?>
            </select>
            <select id="city">
                <option>Filter By City</option>
                <option value="0">Beijing</option>
                <option value="1">Kyoto</option>
                <option value="2">Tokyo</option>
                <option value="3">Shanghai</option>
                <option value="4">Zhumadian</option>
                <option value="5">New York City</option>
                <option value="6">San Francisco</option>
                <option value="7">Jakarta</option>
                <option value="8">Moscow</option>
                <option value="9">Dhaka</option>
            </select>
            <button id="select-btn">  Filter </button>
        </div>

        <div class="pics">
            <?php
            if (isset($_SESSION["browse"])) {
                $pics = $_SESSION["browse"];
                $pic_per_page = 9;
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }
                $start = ($page - 1) * $pic_per_page;
                $end = count($pics) - 1 < $start + $pic_per_page - 1 ? count($pics) - 1 : $start + $pic_per_page - 1;
                for ($i = $start; $i <= $end; $i++) {
                    $id = $pics[$i][0];
                    $path = $pics[$i][1];
                    echo "<div class=\"pic-div\">";
                    echo "<a href=\"../details/details.php?id="."$id"."\"><img src=\"../../travel-images/large/"."$path"."\"></a>";
                    echo "</div>";
                }
                $page_num = ceil(count($pics) / $pic_per_page);
                if ($page_num > 5) {
                    $page_num = 5;
                }
            ?>
            <div class="foot">
                <?php
                echo "<a href='browse.php?page=" . ($page > 1 ? $page - 1 : 1) . "'>" . "<<" . "</a> ";
                for ($i = 1; $i <= $page_num; $i++) {
                    echo "<a href='browse.php?page=" . $i . "'";
                    if ($page == $i) {
                        echo "class='sp_page_num'";
                    }
                    echo ">" . $i . "</a> ";
                };
                echo "<a href='browse.php?page=" . ($page < $page_num ? $page + 1 : $page_num) . "'>" . ">>" . "</a> ";
                }
                ?>
            </div>
        </div>
    </div>
    <div id="block">
        <span id="footer"> Copyright @2019-2023 19SS Web fundamental.All Rights Reserved.京ICP备18307110244号</span>
    </div>

<script>

    $(document).ready(function(){

        $("#search-btn").click(function() {
            let x = $("#search-input").val();
            $.ajax({
                type: "post",
                url: "searchpic.php",
                async:false,
                data: {
                    "title":x
                },
                dataType: "json",
                cache:true,
                success: function (data) {
                    window.location.href = "browse.php";
                },
                error: function (msg) {
                    alert("shibai!");
                }
            });
        });
        $(".content-label").click(function(e) {
            let x = $(e.target).text();
            $.ajax({
                type: "post",
                url: "searchpic.php",
                async:false,
                data: {
                    "content-label":x
                },
                dataType: "json",
                cache:true,
                success: function (data) {
                    window.location.href = "browse.php";  //进行刷新。但不能用reload，因为要使页码重置。
                },
                error: function (msg) {
                    alert("shibai!");
                }


            });
        });
        $(".country-label").click(function(e) {
            let x = $(e.target).text();
            $.ajax({
                type: "post",
                url: "searchpic.php",
                async:false,
                data: {
                    "country-label":x
                },
                dataType: "json",
                cache:true,
                success: function (data) {
                    window.location.href = "browse.php";  //进行刷新。但不能用reload，因为要使页码重置。
                },
                error: function (msg) {
                    alert("shibai!");
                }


            });
        });
        $(".city-label").click(function(e) {
            let x = $(e.target).text();
            $.ajax({
                type: "post",
                url: "searchpic.php",
                async:false,
                data: {
                    "city-label":x
                },
                dataType: "json",
                cache:true,
                success: function (data) {
                    window.location.href = "browse.php";  //进行刷新。但不能用reload，因为要使页码重置。
                },
                error: function (msg) {
                    alert("shibai!");
                }


            });
        });
        $("#select-btn").click(function() {
            let x = $("#content").find("option:selected").text();
            let y = $("#country").find("option:selected").text();
            let z = $("#city").find("option:selected").text();
            $.ajax({
                type: "post",
                url: "searchpic.php",
                async:false,
                data: {
                    "content": x,
                    "country": y,
                    "city": z
                },
                dataType: "json",
                cache:true,
                success: function (data) {
                    window.location.href = "browse.php";
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