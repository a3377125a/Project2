<?php
require_once "../config.php";


function register()
{
    $username = $_POST["username"];
    $email = $_POST["e-mail"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    if ($password != $confirm) {
        echo '<script>alert("确认密码需与密码一致");history.go(-1);</script>';
    } else {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql1 = "select UserName from traveluser where UserName = '$username'";
        $statement1 = $pdo->prepare($sql1);
        $statement1->execute();
        if($statement1->rowCount()>0){
            echo '<script>alert("用户名已经存在");history.go(-1);</script>';
        } else {
            $date = date("Y-m-d H:i:s");
            $hash=password_hash($password,PASSWORD_DEFAULT);

            $sql2="insert into traveluser (Email,UserName,Pass,State,DateJoined,DateLastModified) values('$email','$username','$hash','1','$date','$date')";
            $statement2 = $pdo->prepare($sql2);
            $statement2->execute();

            if ($statement2) {
                session_start();
                $_SESSION['login'] = $username;
                echo '<script>alert("注册成功！");window.location.href="../../index.php";</script>';

            }
        }
    }
}


