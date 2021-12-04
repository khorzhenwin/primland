<?php
session_start();

if (isset($_POST['login'])) {
	include 'dbh.inc.php';

	$uid = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	//error handlers
	if (empty($uid) || empty($pwd)) {
		header("Location: ../reception-page.php");
		exit();
	} else {
		$sql = "SELECT * FROM `member` WHERE Username='$uid'";
		$result = mysqli_query($conn, $sql);

		$resultCheck = mysqli_num_rows($result); //check find if member exist
		if ($resultCheck < 1) {
			echo "<script>
                alert('Member does not exist! Please try again.');
                window.location.href = '../reception-page.php'
                </script>";
			// header("Location: ../reception-page.php?login=wrong");
			// exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) { //check password
				//dehashign the password
				//$hashedPwdCheck = password_verify($pwd, $row['Password']);

				if ($pwd != $row['Password']) { //password wrong
					echo "<script>
                	alert('Username and Password does not match! Please try again.');
                	window.location.href = '../reception-page.php'
                	</script>";
					// header("Location: ../reception-page.php?login=wrong");
					// exit();
				} elseif ($pwd == true) { //password correct
					//starting session for user
					$_SESSION['memberid'] = $row['MemberID'];
					$_SESSION['name'] = $row['Name'];
					$_SESSION['points'] = $row['Points'];
					header("Location: ../redeem-item.php");
					exit();
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
