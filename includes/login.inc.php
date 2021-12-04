<?php 
session_start();

if (isset($_POST['submit'])) {
	include 'dbh.inc.php'; 

	$uid = mysqli_real_escape_string($conn, $_POST['username']); 
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);
	
	//error handlers
	if (empty($uid) || empty($pwd)) {
		header("Location: ../login.php?login=empty");
		exit();
	} else{
		$sql = "SELECT * FROM `member` WHERE Username='$uid'"; 
		$result = mysqli_query($conn, $sql);

		$resultCheck = mysqli_num_rows($result); //check find if member exist
		if ($resultCheck < 1) {
			header("Location: ../login.php?login=wrong");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) { //check password
			    //dehashign the password
				//$hashedPwdCheck = password_verify($pwd, $row['Password']);
				
				if ($pwd != $row['Password']) { //password wrong
			    	header("Location: ../login.php?login=wrong");
					exit();
			    } elseif ($pwd == true) { //password correct
			    	//starting session for user
					$_SESSION['username'] = $row['Username'];
					$_SESSION['usertype'] = 'members';
					$_SESSION['name'] = $row['Name'];
					$_SESSION['profilepic'] = $row['ProfilePicture'];
					$_SESSION['memberid'] = $row['MemberID'];
					$_SESSION['icno'] = $row['ICNo'];
			    	header("Location: ../index.php");
					exit();
			    }
			}
		}
	}
} else {
	header("Location: ../login.php?login=error");
	exit();
}