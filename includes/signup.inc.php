<?php

if (isset($_POST['submit'])) {
	include_once 'dbh.inc.php'; 

	$icno = mysqli_real_escape_string($conn, $_POST['ICno']);
	$name = mysqli_real_escape_string($conn, $_POST['Name']);
	$email = mysqli_real_escape_string($conn, $_POST['Email']);
	$phone = mysqli_real_escape_string($conn, $_POST['Phoneno']);
	$username = mysqli_real_escape_string($conn, $_POST['Username']);
	$password = mysqli_real_escape_string($conn, $_POST['Password']);


	if (empty($icno) || empty($name) ||  empty($email) || empty($phone) || empty($username) || empty($password)) {
		header("Location: ../signup.php?signup=empty");
		exit();
		} else {
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signup.php?signup=email");
			exit();
			} else {
				$sql = "SELECT * FROM `member` WHERE ICNo ='$icno'"; 
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					header("Location: ../signup.php?signup=IC");
					exit();
				} else { 
					$sql1 = "SELECT * FROM `member` WHERE Email ='$email'"; 
					$result1 = mysqli_query($conn, $sql1);
					$resultCheck1 = mysqli_num_rows($result1);
					
					if ($resultCheck1 > 0) {
						header("Location: ../signup.php?signup=ETaken");
						exit();
					} else {
					
					$sql = "INSERT INTO `member` (`ICNo`, `Name`, `Email`, `ContactNo`, `Username`, `Password`) VALUES ('$icno', '$name', '$email', '$phone', '$username', '$password');";
					mysqli_query($conn, $sql);
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
			}
		}
	}


 else{
	header("Location: ../signup.php?nopressbutton");
	exit();
}

?>