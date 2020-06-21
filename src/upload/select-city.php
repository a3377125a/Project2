<?php

require "../browse/select.php";
if (isset($_POST["countryName"])) {
    $a = get10City($_POST["countryName"]);
    echo json_encode($a);
}
