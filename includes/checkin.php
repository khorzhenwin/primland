<?php
session_start();

if (isset($_POST['checkin'])) {
	include 'dbh.inc.php';

	$bookid = mysqli_real_escape_string($conn, $_POST['inroombook']);
	$icno = mysqli_real_escape_string($conn, $_POST['inicno']);

	//error handlers
	if (empty($icno) || empty($bookid)) {
		header("Location: ../reception-page.php");
		exit();
	} else {
		$sql = "SELECT * FROM `member`
        INNER JOIN roombooking ON roombooking.MemberID = member.MemberID
        WHERE member.ICNo='$icno' AND roombooking.RoomBookingID = '$bookid'";
		$result = mysqli_query($conn, $sql);

		$resultCheck = mysqli_num_rows($result); //check find if member exist
		if ($resultCheck < 1) {
			echo "<script>
                alert('Room Booking ID or IC No. does not exist! Please try again.');
				window.location.href = '../reception-page.php'
                </script>";
			// header("Location: ../reception-page.php?login=wrong");
			// exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) { //check password
				//dehashign the password
				//$hashedPwdCheck = password_verify($pwd, $row['Password']);

				if ($bookid != $row['RoomBookingID']) { //password wrong
					echo "<script>
                	alert('Room Booking ID and IC No. does not match! Please try again.');
					window.location.href = '../reception-page.php'
                	</script>";
					// header("Location: ../reception-page.php?login=wrong");
					// exit();
				} elseif ($bookid == true) { //password correct
					//starting session for user
					include("database.php");
					$date = date("Y-m-d");
					if ($date == $row['BookingDate']) {
						if (is_null($row['CheckIN'])) {
							mysqlidb::query("UPDATE roombooking SET CheckIN = 'In'
							WHERE RoomBookingID = $bookid");
							echo "<script>
							alert('Checked In');
							window.location.href = '../reception-page.php'
							</script>";
						} else {
							echo "<script>
							alert('User already checked in for this room booking.');
							window.location.href = '../reception-page.php'
							</script>";
						}
					} else {
						echo "<script>
						alert('Wrong date to check in.');
						window.location.href = '../reception-page.php'
						</script>";
					}
				}
			}
		}
	}
} else {
	echo "<script>
    alert('An error has occured! Please try again.');
    window.location.href = '../reception-page.php'
	</script>";
	// header("Location: ../reception-page.php?login=error");
	// exit();
}
?>