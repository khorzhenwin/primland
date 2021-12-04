<!--Script area for drop down list-->
<link rel="stylesheet" href="css/main.css">
<nav>
    <script src="javascript/main.js"></script>
    <div class="topnav-container">
        <?php

        if (isset($_SESSION['usertype'])) {
            switch ($_SESSION['usertype']) {
                case 'members': ?>
                    <!-- html code here -->

                    <ul>
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a href="facilities.php">Facilities</a></li>
                        <li><a id="rooms">Accommodation</a>
                            <div class="dropdown" id="dropdown-rooms">
                                <?php
                                include_once('includes/database.php');
                                $roomvalues = mysqlidb::fetchAllRows("SELECT * FROM `roomtype`");
                                foreach ($roomvalues as $roomvalue) {
                                    echo "<ul>
                                        <li><a href=\"rooms.php?roomtypeid={$roomvalue['RoomTypeID']}\">{$roomvalue['RoomType']}</a></li>
                                    </ul>";
                                }
                                ?>
                            </div>
                        </li>
                        <li><a href="attractions.php">Attractions</a></li>
                        <li><a href="profile.php" id="profile">Profile</a>
                            <div class="dropdown" id="dropdown-profile">
                                <ul>
                                    <li><a href="profile.php">Change Profile</a></li>
                                    <li><a href="booking-history.php">Booking History</a></li>
                                    <li><a href="redeem-history.php">Redemption History</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <?php
                    //get the most updated profile image
                    include_once('includes/dbh.inc.php');

                    $icno = $_SESSION['icno'];
                    $result = $conn->query("SELECT ProfilePicture FROM `member` WHERE ICNo = $icno;");
                    $row = $result->fetch_assoc();

                    ?>
                    <img style="object-fit:contain; border-radius: 50%; margin-right:1em; padding-top: 2px" src="<?php echo "images/profilepictures/" . $row['ProfilePicture']; ?>" alt="profile-picture" height="40" width="40">
                    <p class="topnav-username"><?php echo $_SESSION['name']; ?></p>
                    <form action="includes/logout.php" method="POST">
                        <button type="submit" name="submit">LogOut</button>
                    </form>
                <?php break;
                case 'Admin';
                    header('Location: MemberDetails.php'); ?>
                    <!-- html code here -->


                    <p class="topnav-username"><?php echo $_SESSION['username']; ?></p>
                    <form action="includes/logout.php" method="POST">
                        <button type="submit" name="submit">LogOut</button>
                    </form>
                <?php break;
                case 'Receptionist'; ?>
                    <!--html code here-->
                    <p class="topnav-username"><?php echo $_SESSION['username']; ?></p>
                    <form action="includes/logout.php" method="POST">
                        <button type="submit" name="submit">LogOut</button>
                    </form>
            <?php break;
                default: //no default value
                    break;
            }
        } else { ?>
            <ul>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="facilities.php">Facilities</a></li>
                <li><a id="rooms">Accommodation</a>
                    <div class="dropdown" id="dropdown-rooms">
                        <?php
                        include_once('includes/database.php');
                        $roomvalues = mysqlidb::fetchAllRows("SELECT * FROM `roomtype`");
                        foreach ($roomvalues as $roomvalue) {
                            echo "<ul>
                                        <li><a href=\"rooms.php?roomtypeid={$roomvalue['RoomTypeID']}\">{$roomvalue['RoomType']}</a></li>
                                    </ul>";
                        }
                        ?>
                    </div>
                </li>
                <li><a href="attractions.php">Attractions</a></li>
            </ul>

            <div class="topnav-loginsignup">
                <a href="login.php" id="Login">Login</a>
                <button onclick="location.href = 'signup.php'">Sign Up</button>
            </div>
        <?php
        }
        ?>
    </div>
</nav>