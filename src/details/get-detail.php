<?php
require_once "../config.php";
function getDetail()
{
    $conn1 = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $imgID = $_GET["id"];
    $sql1="SELECT * FROM travelimagefavor WHERE ImageID='$imgID'";
    $result1 = $conn1->query($sql1);
    $row1 = $result1->fetch_all();
    $loveNum = count($row1);

    $sql2="SELECT * FROM travelimage WHERE ImageID='$imgID'";
    $result2 = $conn1->query($sql2);
    $row2 = $result2->fetch_all();

    $UID = $row2[0][7];
    $sql3="SELECT UserName FROM traveluser WHERE UID='$UID'";
    $result3 = $conn1->query($sql3);
    $row3 = $result3->fetch_all();

    $a = $row2[0][6];
    $sql4 = "SELECT Country_RegionName FROM geocountries_regions WHERE ISO='$a'";
    $result4 = $conn1->query($sql4);
    $row4 = $result4->fetch_all();

    $b = $row2[0][5];
    $sql5 = "SELECT AsciiName FROM geocities WHERE GeoNameID='$b'";
    $result5 = $conn1->query($sql5);
    $row5 = $result5->fetch_all();

    $imgDetails = $row2[0];
    $imgDetails[10] = $loveNum;
    $imgDetails[11] = $row3[0][0];
    $imgDetails[12] = $row4[0][0];
    $imgDetails[13] = $row5[0][0];

    return $imgDetails;
}




//echo "<script>alert(\"$imgID\");</script>";

