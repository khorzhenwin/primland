<?php include_once('template/header.php'); ?>
<?php include_once('includes/dbh.inc.php'); ?>

<link rel="stylesheet" href="css/Admin.css">

<nav>
    <div class="topnav-container">
        <ul>
            <li><a href="MemberDetails.php">Member List</a></li>
            <li><a class="current">Booking List</a></li>
            <li><a href="StaffList.php">Staff List</a></li>
            <li><a href="Room_single.php">View Room</a>
                <div class="dropdown">
                    <ul>
                        <li><a href="Room_single.php">Single</a></li>
                        <li><a href="Room_couple.php">Couple</a></li>
                        <li><a href="Room_family.php">Family</a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <form action="includes/logout.php" method="POST">
            <button type="submit" name="submit">LogOut</button>
        </form>
    </div>
</nav>

<main>

    <!DOCTYPE html>
    <html>

    <body>
        <br><br><br>

        <p class="member-title">Booking List</p>

        <br><br>
        <form action="BookingList.php" class="search" method="post">
            Search: <input type="text" name="book_name">
            <input class="btn" type="submit" value="Search" name="BookSearchBtn">
        </form>

        <br><br>

        <div class=outer>
            <table class="table1">
                <thead>
                    <tr>
                        <th>RoomBookingID</th>
                        <th>MemberID</th>
                        <th>RoomNo</th>
                        <th>BookingDate</th>
                        <th>Duration</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    if (isset($_POST['BookSearchBtn'])) {
                        $book_name = $_POST["book_name"];
                        $sql = "SELECT * FROM roombooking WHERE RoomBookingID LIKE '%" . $book_name . "%' or MemberID LIKE '%" . $book_name . "%'";
                    }
                    else {
                        $sql = "SELECT * FROM roombooking";
                    }

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["RoomBookingID"] . "</td>
                                <td>" . $row["MemberID"] . "</td>
                                <td>" . $row["RoomNo"] . "</td>
                                <td>" . $row["BookingDate"] . "</td>
                                <td>" . $row["Duration"] . "</td>
                                <td>" . $row["CheckIN"] . "</td>
                                <td>" . $row["CheckOUT"] . "</td>
                    </tr>";
                        }
                        echo "</table";
                    }

                    $conn->close();
                    ?>

                </tbody>

            </table>
        </div>
                    <br>
                    <br>
                    <br>
    </body>
    </html>

</main>

<?php include_once('template/footer.php'); ?>