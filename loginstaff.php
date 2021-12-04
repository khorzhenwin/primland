<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="images/jpg" href="images/icon.jpeg">
    <title>Login Staff</title>
</head>

<body>

    <link rel="stylesheet" href="css/login.css">


    <div class="main-container">
        <div class="logo-container" id="Logo">
            <a href="index.php"><img src="images/PrimlandLogo.jpg" alt="Primeland-Logo"></a>
        </div>
        <div id="form-login">
            <h1>Login</h1>
            <form action="includes/loginstaff.inc.php" method="POST">
                <p class="label">Usertype :</p>
                <select name="usertype" required>
                    <option value="Admin">Admin</option>
                    <option value="Receptionist">Receptionist</option>
                </select>
                <p class="label">Username :</p>
                <input type="text" name="username" placeholder="Username" required id="username">
                <p class="label">Password :</p>
                <input type="password" name="password" placeholder="Password" required id="password">
                <input type="submit" name="submit">
            </form>
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
} elseif (strpos($fullUrl, "login=wrongusertype") == true) {
    echo "<center><p class='error'>Wrong user type</p></center>
			<script type='text/javascript'>alert('Wrong user type')</script>";
    exit();
}
?>

</html>