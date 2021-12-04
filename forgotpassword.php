<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
</head>
<link rel="icon" type="images/jpg" href="images/icon.jpeg">
<link href="css/khor.css" type="text/css" rel="stylesheet">

<body>
    <link rel="stylesheet" href="css/login.css">

    <div class="main-container">
        <div class="logo-container" id="Logo">
            <a href="index.php"><img src="images/PrimlandLogo.jpg" alt="Primeland-Logo"></a>
        </div>
        <div id="form-login" class="m-t-2">
            <h1 class="m-a">Forgot Password</h1>
            <form action="reset_password.php" method="POST">
                <div class="p-y">
                    <label for="email">Please enter your email :</label>
                    <input type="email" name="email" placeholder="Email" required id="email">
                </div> 
                <input type="submit" name="submit">
            </form>
        </div>
</body>