<?php
include_once('includes/dbh.inc.php');

$UserID = $_POST["UserID"];
$result = $conn->query("SELECT * from `admin` where AdminID = '$UserID'");
$row = $result->fetch_assoc();
echo json_encode($row);
