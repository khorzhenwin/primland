<?php include_once('template/header.php'); ?>
<?php include_once('includes/dbh.inc.php'); ?>

<link rel="stylesheet" href="css/Admin.css">
<script src="javascript/PopUp.js"></script>
<script src="javascript/AddTime.js"></script>
<script src="javascript/Admin.js"></script>
<script src="javascript/member_read.js"></script>
<script src="javascript/jquery-3.5.1.min.js"></script>

<nav>
    <div class="topnav-container">
        <ul>
            <li><a class="current">Member List</a></li>
            <li><a href="BookingList.php">Booking List</a></li>
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

        <div class="modal-background modal hidden">
            <div class="modal-content">
                <div class="modal-body">
                    ADDING MEMBER...
                </div>
            </div>
        </div>

        <div class="modal-background modal hidden">
            <div class="modal-content">
                <div onclick="dismiss(1)" class="material-icons modal-close-button">close</div>
                <div class="modal-body">
                    <form action="member_process.php" method="post" id="Add" onsubmit="event.preventDefault(); add_member(event);">
                        <h2>Member Details</h2> <br>
                        <input type="hidden" name="add" value="add">
                        <div><input type="text" placeholder="IC Number" name="memberIC" maxlength="12" required> </div> <br>
                        <div><input type="text" placeholder="Name" name="memberName" required></div> <br>
                        <div><input type="email" placeholder="Email" name="memberEmail" required></div> <br>
                        <div><input type="text" placeholder="Contact Number" name="memberCont" maxlength="10" required></div> <br>
                        <div><input type="text" placeholder="Username" name="memberUser" required></div> <br>
                        <div><input type="password" placeholder="Password" name="memberPass" required></div> <br>
                        <input class="button" type="submit" value="Add Member">
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-background modal hidden">
            <div class="modal-content">
                <div class="modal-body">
                    <h3>DELETING MEMBER...</h3>
                </div>
            </div>
        </div>

        <div class="modal-background modal hidden">
            <div class="modal-content">
                <div onclick="dismiss(3)" class="material-icons modal-close-button">close</div>
                <div class="modal-body">
                    <form action="member_process.php" method="post" id="Edit" onsubmit="event.preventDefault(); edit_member(event);">
                        <h2>Edit Member Details</h2> <br>
                        <input type="hidden" name="edit" value="edit">
                        <input type="hidden" name="memberId" id="edit_id" value="">
                        <div><input type="text" placeholder="IC Number" name="memberIC" id="edit_ic" maxlength="12" readonly> </div> <br>
                        <div><input type="text" placeholder="Name" name="memberName" id="edit_Name" required></div> <br>
                        <div><input type="email" placeholder="Email" name="memberEmail" id="edit_email" required></div> <br>
                        <div><input type="text" placeholder="Contact Number" name="memberCont" id="edit_cont" maxlength="10" required></div> <br>
                        <div><input type="text" placeholder="Username" name="memberUser" id="edit_username" required></div> <br>
                        <div><input type="password" placeholder="Password" name="memberPass" id="edit_pass" required></div> <br>
                        <input class="button" type="submit" value="Edit Member">
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-background modal hidden">
            <div class="modal-content">
                <div class="modal-body">
                    <h3>UPDATING MEMBER...</h3>
                </div>
            </div>
        </div>

        <br><br><br>

        <p class="member-title">Member List</p>

        <br><br>
        <form action="MemberDetails.php" class="search" method="post">
            Search: <input type="text" name="member_name">
            <input class="btn" type="submit" value="Search" name="searchBtn">
        </form>

        <br><br>

        <div class=outer>
            <table class="table1">
                <tr>
                    <th>MemberID</th>
                    <th>ICNo</th>
                    <th>MemberName</th>
                    <th>MemberEmail</th>
                    <th>ContactNo</th>
                    <th>Username</th>
                    <th>Points</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tbody>
                    <?php
                    if (isset($_POST['searchBtn'])) {
                        $member_name = $_POST["member_name"];
                        $sql = "SELECT * FROM `member` WHERE Name LIKE '%" . $member_name . "%' or ICNo LIKE '%" . $member_name . "%'";
                    } else {
                        $sql = "SELECT * FROM `member`";
                    }

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["MemberID"] . "</td>
                                <td>" . $row["ICNo"] . "</td>
                                <td>" . $row["Name"] . "</td>
                                <td>" . $row["Email"] . "</td>
                                <td>" . $row["ContactNo"] . "</td>
                                <td>" . $row["Username"] . "</td>
                                <td>" . $row["Points"] . "</td>
                                <td>" . "<a onclick=\"member_edit({$row["MemberID"]})\"><button class =\"button_table\"><span>Edit<span></button></a>" . "</td>
                                <td>" . "<a onclick=\"show(2);LateRedirect('member_process.php?delete=" . $row["MemberID"] . "');\"><button class =\"button_table\"><span>Delete<span></button></a>" . "</td>
                                </tr>";
                        }
                        echo "</table";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <br><br>

        <div class="add">
            <a id="btn-add-member">
                <button onclick="show(1)" class="button"><span>Add Member</span></button>
            </a>
        </div>

    </body>

    </html>

</main>

<?php include_once('template/footer.php'); ?>