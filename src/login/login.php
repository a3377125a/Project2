<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
</head>
<body>
<?php
require "login-action.php";
session_start();
$lifeTime = 24 * 3600;
setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
    <header>
        <img src="../../images/register/icons/github.png">
        <span>Sign in for Island</span>
    </header>
    <div id="login">
        <form id="login-form"  method="POST">
            <span>Username/E-mail:</span>
            <input type="text"  name="username">
            <span>Password:</span>
            <input type="password"  name="password">
            <input id="login-btn" type="submit" value="Sign in">
            <?php
            if (isset($_SESSION["login"])) {
                header("location:../../index.php");
            }
            else{
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (testUser()) {
                        $_POST = array();
                        header("location:../../index.php");
                    }
                    else{
                        $_SESSION = array();
                        echo '<script>alert("用户名或密码错误！");</script>';
                    }
                }
            }

            ?>
        </form>

    </div>
    <?php

    ?>


    <span id="sub"> New to Island? <a href="../register/register.php">Create a new account!</a> </span>

    <div id="block">
        <span id="footer"> Copyright @2019-2023 19SS Web fundamental.All Rights Reserved.京ICP备18307110244号.</span>
    </div>
</body>
</html>