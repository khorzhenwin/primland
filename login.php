<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
</head>
<link rel="icon" type="images/jpg" href="images/icon.jpeg">

<body>
	<link rel="stylesheet" href="css/login.css">


	<div class="main-container">
		<div class="logo-container" id="Logo">
			<a href="index.php"><img src="images/PrimlandLogo.jpg" alt="Primeland-Logo"></a>
		</div>
		<div id="form-login">
			<h1>Login</h1>
			<form action="includes/login.inc.php" method="POST">
				<label for="username">Username :</label>
				<input type="text" name="username" placeholder="Username" required id="username">
				<label for="password">Password :</label>
				<input type="password" name="password" placeholder="Password" required id="password">
				<input type="submit" name="submit">
			</form>
			<div class="center"><a href="forgotpassword.php">Forgot Your Password?</a></div> <br />
			<div class="center"><a class="link" href="signup.php">Sign Up</a></div>
		</div>
</body>

<?php
$fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; //getting the end of url for javascript pop up

if (strpos($fullUrl, "login=empty") == true) {
	echo "<center><p class='error'>Please fill in all the fields</p></center>
			<script type='text/javascript'>alert('Please fill in all the fields')</script>";
	exit();
} elseif (strpos($fullUrl, "login=wrong") == true) {
	echo "<center><p class='error'>Invalid Username or Password</p></center>
			<script type='text/javascript'>alert('Invalid Username or Password')</script>";
	exit();
} elseif (strpos($fullUrl, "login=wrong") == true) {
	echo "<center><p class='error'>Invalid Username or Password</p></center>
			<script type='text/javascript'>alert('Invalid Username or Password')</script>";
	exit();
}
?>

</html>