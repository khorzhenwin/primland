<?php
include_once('dbh.inc.php');
include_once('database.php');
session_start();
// print_r($_POST);
error_reporting(0);
$icno = $_POST['icno'];
$roomtype = $_POST['roomtype'];
$duration = $_POST['duration'];
$mid = $_SESSION['memberid'];

$pointsgain = mysqlidb::fetchRow("SELECT * FROM `roomtype` WHERE RoomTypeID = '$roomtype'");
$totalpayment = $pointsgain['PointsGain'] * $duration;

if ($duration <= 0 || $duration > 7) {
    echo "Please select a duration";
} else {
    echo "
    Duration of Stay : $duration Night(s) <br>
    Total Payment : RM $totalpayment <br><br>
    Points Gain : $totalpayment points
    ";
}
