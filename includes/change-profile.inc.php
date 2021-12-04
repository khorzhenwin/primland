<?php
if (isset($_POST['submit'])) {
    include('dbh.inc.php');


    $currentpic = mysqli_real_escape_string($conn, $_POST['currentpic']);
    $icno = mysqli_real_escape_string($conn, $_POST['icno']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phoneno']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    if (empty($icno) || empty($name) ||  empty($email) || empty($phone) || empty($username)) {
        header("Location: ../profile.php?profile=empty");
        exit();
    } else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../profile.php?profile=email");
            exit();
        } else {
            $fileName =  $_FILES['profilepic']['name'];

            if (empty($fileName)) {
                $sql = "UPDATE `member` SET Name = '$name', Email ='$email', 
                ContactNo = '$phone', Username = '$username' WHERE ICNo = '$icno';";
                mysqli_query($conn, $sql);
                header("Location: ../profile.php?success");
                exit();
            } else {
                //upload file to database
                
                $fileTempName =  $_FILES['profilepic']['tmp_name'];
                $fileError =  $_FILES['profilepic']['error'];
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                if ($fileError === 0) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDir = "../images/profilepictures/";
                    $fullFileDir = "../images/profilepictures/" . $fileNameNew;
                    
                    move_uploaded_file($fileTempName, $fullFileDir); //upload the temp file into the file directory
                    
                    if ($currentpic != 'default.jpg') {
                        unlink($fileDir.$currentpic);// delete the current profile image that are no defaut to save space
                    } 
                } else {
                    header('Location: ../profile.php?file-error');
                }

                //update memberdetails table including profile picture
                $sql = "UPDATE `member` SET Name = '$name', Email ='$email', ContactNo = '$phone', 
                Username = '$username', ProfilePicture = '$fileNameNew' WHERE ICNo = '$icno';";
                mysqli_query($conn, $sql);
                header("Location: ../profile.php?success");
                exit();
            }
        }
    }
} else {
    header('Location: ../profile.php');
    exit();
}
