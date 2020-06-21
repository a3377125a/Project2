<?php

require "select.php";
if (isset($_POST["countryName"])) {
    if ($_POST["countryName"] == "Filter By Country") {
        $a = ["Beijing", "Kyoto", "Tokyo", "Shanghai", "Zhumadian", "New York City", "San Francisco", "Jakarta", "Moscow", "Dhaka"];
    } else {
        $a = get10City($_POST["countryName"]);
    }
    echo json_encode($a);
}
