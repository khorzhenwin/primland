<?php
include_once('dbh.inc.php');
include_once('database.php');
session_start();
// print_r($_POST);

$BookDate = $_POST['start-date']; //the start date the member wants to book
$icno = $_POST['icno'];
$roomtype = $_POST['roomtype'];
$duration = $_POST['duration'];
$mid = $_SESSION['memberid'];
$EndDate = date('Y-m-d', strtotime('+1 day', strtotime($BookDate))); //the end date the member wants to book

$RoomNo = mysqlidb::fetchAllRows("SELECT RoomNo FROM room where RoomTypeID = '$roomtype'");
$roomsbooked = mysqlidb::fetchAllRows("SELECT RoomBookingID, MemberID, roombooking.RoomNo, BookingDate, CheckoutDate, Duration, roomtype.RoomTypeID
                                        FROM `roombooking` 
                                        JOIN room ON roombooking.RoomNo = room.RoomNo 
                                        JOIN roomtype ON room.RoomTypeID = roomtype.RoomTypeID
                                        WHERE room.RoomTypeID = '$roomtype' AND BookingDate BETWEEN '$BookDate' AND '$EndDate'");
$arrayRoomNo = array();
$arrayRoomsBooked = array();

if (count($roomsbooked) <= 0) {
    //all room fields can be shown
    foreach ($RoomNo as $roomchecked) {
        echo "<option value='{$roomchecked['RoomNo']}'>RoomNo {$roomchecked['RoomNo']}</option>";
    }
} else {

    foreach ($RoomNo as $Rooms) { //changing the array in array to single
        $arrayRoomNo[] = $Rooms['RoomNo']; //
    }

    foreach ($roomsbooked as $bookedRooms) { //changing the array in array to single
        $arrayRoomsBooked[] = $bookedRooms['RoomNo']; //
        // echo "<option value='{$bookedRooms['RoomNo']}'>{$bookedRooms['RoomNo']}</option>";
    }

    $availableRooms = array_diff($arrayRoomNo, $arrayRoomsBooked);
    foreach ($availableRooms as $rooms) {
        echo "<option value='$rooms'>RoomNo $rooms</option>";
    }
}

