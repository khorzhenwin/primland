<?php
if (isset($_POST['submit'])) {
    include_once('dbh.inc.php');

    $BookDate = $_POST['start-date']; //the start date the member wants to book
    $icno = $_POST['icno'];
    $memberid = $_POST['memberid'];
    $roomtype = $_POST['roomtype'];
    $duration = $_POST['duration'];
    $cardno = $_POST['card_no'];
    $cardexp = $_POST['card_exp'];
    $cardsec = $_POST['card_secret'];

    if (isset($_POST['roomno'])) {
        $roomno = $_POST['roomno'];
    }





    if (empty($BookDate) || empty($icno) || empty($roomtype) || empty($roomtype) || empty($duration) || empty($roomno) || empty($cardno) || empty($cardexp) || empty($cardsec)) {
        echo "<span class='form-error'>Please fill in all fields</span>";
    } else {
        $TodayDate = date('Y-m-d');
        $myDateTime = DateTime::createFromFormat('Y-m-d', $BookDate);
        $checkoutdate = date_add($myDateTime, date_interval_create_from_date_string("$duration days"));
        $formatteddate = $checkoutdate->format('Y-m-d');
        $today = strtotime($TodayDate);
        $else = strtotime($BookDate);

        if ($else < $today) {
            echo "<span class='form-error'>Date cannot be before today !</span>";
        } else {
            $sql = "INSERT INTO `roombooking`(`MemberID`, `RoomNo`, `BookingDate`, `Duration`, `CheckOutDate`) 
                VALUES ('$memberid', '$roomno', '$BookDate' , '$duration', '$formatteddate');";
            $result = $conn->query($sql);


            if ($result == true) {

                $sqlupdatepoints = "UPDATE `member` SET 
                member.Points = (member.Points + ((SELECT roomtype.PointsGain FROM roomtype WHERE roomtype.RoomTypeID = '$roomtype') * $duration))
                WHERE member.ICNo = '$icno'";
                $resultUpdatePoints = $conn->query($sqlupdatepoints);

                echo "<span class='form-success'>Booking added successfully</span>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
} else {
    header('Location: ../index.php');
}
