<?php
include_once('includes/dbh.inc.php');

$memberID = $_POST["memberID"];
$result = $conn->query("SELECT * from `member` where MemberID = $memberID");
$row = $result->fetch_assoc();
echo json_encode($row);
