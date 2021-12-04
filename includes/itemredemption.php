<?php
include "member-session.php";
include("database.php");
$memberid = $_SESSION["memberid"]; // USE SESSIONS

if (isset($_POST['redeem'])) {
    $rows = mysqlidb::fetchRow("SELECT * FROM item
    WHERE ItemID = $_POST[itemid]");
    $date = date("Y-m-d");

    // Update stock amount (-1)
    mysqlidb::query("UPDATE `item` SET Stock = ($rows[Stock] - 1) WHERE ItemID = $_POST[itemid]");

    // Insert as Redeem history
    mysqlidb::query("INSERT INTO `redeem` (MemberID, ItemID, RedeemDate, RedeemTime)
                VALUES ($memberid, '$_POST[itemid]', '$date', NOW())");

    // Update Member Points according to Item Points subtracted
    mysqlidb::query("UPDATE `member` SET Points = (Points - $rows[ItemPoints])
                WHERE MemberID=$memberid");

    echo "<script>
    alert('Item redeemed');
    window.location.href = '../redeem-item.php'
    </script>";
}
?>