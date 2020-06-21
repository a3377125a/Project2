<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>


    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/register.css">
</head>
<body>

<?php
require "register-action.php";


?>

    <header>
        <img src="../../images/register/icons/github.png">
        <span>Sign up for Island</span>
    </header>
    <div id="register">
        <form id="login-form"  method="POST">

            <span>Username:</span>
            <input type="text"  name="username" placeholder="用户名只能含有字母、数字、下划线、小数点" pattern="^[0-9a-zA-Z_.]{1,}$" required>
            <span>E-mail:</span>
            <input type="text"  name="e-mail" placeholder="合法的邮箱地址" pattern="^[a-zA-Z0-9][a-zA-Z0-9_-]*@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$" required>
            <span>Password:</span>
            <input type="password"  name="password" placeholder="密码长度6-16位，必须同时含有字母与数字" pattern="^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,16}$" required>
            <!-- 6-16位，必须并只能含有字母与数字。 -->
            <span>Confirm Your Password:</span>
            <input type="password" name="confirm" placeholder="确认密码需要与密码相同" required>
            <input id="register-btn" type="submit" value="Sign up">

        </form>
    </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    register();
}

?>
    <script>
        $(document).ready(function () {




        });



    </script>

    <span id="sub"> Have an account? <a href="../login/login.php">Sign in!</a> </span>
    <div id="block">
        <span id="footer"> Copyright @2019-2023 19SS Web fundamental.All Rights Reserved.京ICP备18307110244号.</span>
    </div>
</body>
</html>