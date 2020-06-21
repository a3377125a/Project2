<?php
session_start();
$_SESSION["login"] = null;
header("location:http://localhost:1234/Project2/index.php");

