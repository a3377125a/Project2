<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Details</title>

    <script src="../../jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/details.css">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">

</head>
<body>
   <?php
   require "../navbar.php";
   require "get-detail.php";
   $imgDetails = getDetail();
   ?>
    <div id="details">
        <div class="first">
            Details
        </div>
        <div class="main">
            <?php
            echo "<h1> "."$imgDetails[1]"."  <span>by "."$imgDetails[11]"."</span>  </h1>";
            ?>
            <div class="pic">
                <div class="left">
                    <?php
                    echo "<img class=\"scene\" src=\"../../travel-images/large/" . $imgDetails[8] . "\">";
                    ?>
                </div>
                <div class="right">
                    <div class="right1">
                        <div class="first">
                            Like Number
                        </div>
                        <div class="blocks">
                            <?php
                            echo $imgDetails[10];
                            ?>
                        </div>
                    </div>
                    <div class="right2">
                        <div class="first">
                            Image Details
                        </div>
                        <div class="blocks">
                            Content:
                            <?php
                            echo $imgDetails[9];
                            ?>
                        </div>
                        <div class="blocks">
                            Country:
                            <?php
                            echo $imgDetails[12];
                            ?>
                        </div>
                        <div class="blocks">
                            City:
                            <?php
                            echo $imgDetails[13];
                            ?>
                        </div>
                    </div>
                    <?php
                    echo "<a href=\"##\" class=\"love-btn\" id=\"$imgDetails[0]\" >";
                    ?>
                        <div class="right3">
                            <img src="../../images/details/icons/love.png">
                            <span id="love-text">收藏</span>
                        </div>
                    </a>
                    <article>
                        <?php
                        echo $imgDetails[2];
                        ?>
                    </article>
                </div>
            </div>
        </div>
    </div>

   <script>
       $(document).ready(function(){
           let z = $(".love-btn").prop("id");
           $.ajax({
               type: "post",
               url: "isLove.php",
               async:false,
               data: {
                   "imgID":z
               },
               dataType: "json",
               cache:true,
               success: function (data) {
                   $("#love-text").text(data);
               },
               error: function (msg) {
                   alert("shibai!");
               }
           });

           $(".love-btn").click(function() {
               let x = $(".love-btn").prop("id");
               $.ajax({
                   type: "post",
                   url: "love-action.php",
                   async:false,
                   data: {
                       "imgID":x
                   },
                   dataType: "json",
                   cache:true,
                   success: function (data) {
                       if (data === 0) {
                           window.location.replace("../login/login.php");
                       } else if (data === 1) {
                           $("#love-text").text("收藏");
                           window.location.reload();
                       } else if (data === 2) {
                           $("#love-text").text("取消收藏");
                           window.location.reload();
                       }
                   },
                   error: function (msg) {
                       alert("shibai!");
                   }
               });
           });

       });
   </script>


    <div id="block">
        <span id="footer"> Copyright @2019-2023 19SS Web fundamental.All Rights Reserved.京ICP备18307110244号</span>
    </div>

</body>
</html>