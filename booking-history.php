<?php include_once('template/header.php'); ?>
<?php include_once('template/top-nav.php'); ?>

<?php if (isset($_SESSION['usertype'])) {

    //DATABASE QUERY CODES 
    //Display & Delete
    $user = $_SESSION['memberid'];
    //filter the table
    if (isset($_GET['roomtype'])) {
        $roomtype = $_GET['roomtype'];
        $DateRoomBooked = $_GET['DateRoomBooked'];

        //the filter conditions for the query
        $a = "AND roomtype.RoomType = '$roomtype'";
        $c = "AND roombooking.BookingDate = '$DateRoomBooked'";

        //add all GET value into array
        $filterEmpty = array("a"=>$roomtype,"c"=>$DateRoomBooked);
        $finalfilter = array_filter($filterEmpty); //filter if there is any empty variable in array
        $filterArray = array();

        if (array_key_exists("a",$finalfilter)) {
            array_push($filterArray, $a);
        } 
        if (array_key_exists("c",$finalfilter)) {
            array_push($filterArray, $c);
        }

        $filterString = implode(" ", $filterArray);
            
        $sql = "SELECT roombooking.RoomBookingID, roombooking.RoomNo, roombooking.BookingDate, roombooking.Duration,
                roomtype.PricePerNight, (roomtype.PricePerNight * Duration) as 'TotalPrice' FROM `roombooking` 
                JOIN room ON roombooking.RoomNo = room.RoomNo JOIN roomtype ON room.RoomTypeID = roomtype.RoomTypeID AND roombooking.MemberID = '$user' $filterString
                ORDER BY BookingDate ASC";
    } else {
        $sql = "SELECT roombooking.RoomBookingID, roombooking.RoomNo, roombooking.BookingDate, roombooking.Duration,
                roomtype.PricePerNight, (roomtype.PricePerNight * Duration) as 'TotalPrice' FROM `roombooking` 
                JOIN room ON roombooking.RoomNo = room.RoomNo JOIN roomtype ON room.RoomTypeID = roomtype.RoomTypeID AND roombooking.MemberID = '$user'
                ORDER BY BookingDate ASC";
    }

    $result = mysqli_query($conn, $sql);
?>

    <main>
        <h2 class="pagetitle">Booking History</h2>
        <div class="center">
            <form action="booking-history.php" class="search-form">
                Room Type
                <select name="roomtype" id="">
                    <option value="">No Room</option>
                    <option value="Single-Stay">Single Room</option>
                    <option value="Couple">Couple Room</option>
                    <option value="Family">Family Room</option>
                </select>
                Booking Date
                <input type="date" name="DateRoomBooked">
                <input type="submit" value="Search">
                <a href="booking-history.php" style="margin-top: 3em;"><img src="images/refresh.png" height="30" width="30"></a>
            </form>
        </div>

        <?php
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
        ?>
            <!--Booking History Table Structure-->
            <div class="booking-history-table">
                <table class="booking-history">
                    <tr>
                        <th>RoomBookingID</th>
                        <th>RoomNo</th>
                        <th>BookingDate</th>
                        <th>Duration</th>
                        <th>Total Price</th>
                        <th>Clear Record</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <tr>
                            <td><?php echo $row['RoomBookingID']; ?></td>
                            <td><?php echo $row['RoomNo']; ?></td>
                            <td><?php echo $row['BookingDate']; ?></td>
                            <td><?php echo $row['Duration']; ?> Days</td>
                            <td>RM <?php echo $row['TotalPrice']; ?></td>
                            <td><a onclick="return confirm('Are you sure you want to delete record for booking ID : <?php echo $row['RoomBookingID']; ?> on <?php echo $row['BookingDate']; ?>?');" id="delete-history" class="delete-button" href="booking-history.php?delete=<?php echo $row['RoomBookingID']; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        <?php   } else {
            echo "<p class='booking-history-warning'>Chirp Chirp there is no such thing :( Try harder next time!</p>";
        }
        ?>
    
    </main>
        <br>
        <br>
        <br>
        <br>
<?php } else {
    header('Location: index.php');
} ?>

<?php include_once('template/footer.php'); ?>


<?php
// delete booking history

if (isset($_GET['delete'])) {

    $bookingid = $_GET['delete'];
    $deletesql = "DELETE FROM roombooking WHERE RoomBookingID = $bookingid";

    if ($conn->query($deletesql) === TRUE) {
        echo "
        <script>alert('Record Has Been Successfully Deleted! Please refresh the table or the page')</script>
        ";
    } else {
        echo "<script>alert('There Was An Error Deleting Record $conn->error')</script>";
    }
}
?>