<?php

session_start();

if (isset($_POST['submit'])) {
	include 'dbh.inc.php'; //connection to database

	$utype = mysqli_real_escape_string($conn, $_POST['usertype']);
	$uid = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	//error handlers
	if (empty($uid) || empty($pwd) || empty($utype)) {
		header("Location: ../loginstaff.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM `admin` WHERE AdminUsername='$uid'"; //find if member exist
		$result = mysqli_query($conn, $sql);

		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../loginstaff.php?login=wrong");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) { //check password
				//dehashign the password
				//$hashedPwdCheck = password_verify($pwd, $row['Password']);

				if ($pwd != $row['AdminPassword']) { //password wrong
					header("Location: ../loginstaff.php?login=wrong");
					exit();
				} elseif ($pwd == true) { //password correct
					//starting session for user
					$_SESSION['username'] = $row['AdminUsername'];
					$_SESSION['usertype'] = 'Admin';
					header('Location: ../memberdetails.php');
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../loginstaff.php?login=error");
	exit();
}
