<?php 

    include_once('dbh.inc.php');


    $currentpass = mysqli_real_escape_string($conn, $_POST['current-password']);
    $useric = mysqli_real_escape_string($conn, $_POST['icno']);
    $newpass = mysqli_real_escape_string($conn, $_POST['new-password']);
    $confirmpass = mysqli_real_escape_string($conn, $_POST['confirm-password']);


    if (empty($currentpass) || empty($newpass) || empty($confirmpass)) {
        echo "<span class='form-error'>Fill in all fields</span>";
    } elseif ($newpass != $confirmpass) {
            echo "<span class='form-eror'>Password Does not match</span>";
    } else {
        $sql = "SELECT * FROM `member` WHERE ICNo = '$useric' AND `Password` = '$currentpass'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck < 1) {
            echo "<span class'form-error'>Your current password is wrong</span>";
        } else {
            $sqlupdate = "UPDATE `member` SET `Password` = '$confirmpass' WHERE ICNo = '$useric'";

            if ($conn->query($sqlupdate) === TRUE) {
                echo "<span class='form-success'>Password changed successfully</span>";
            } else {
                echo "Error Changeing password" . $conn->error;
            }
        }
    }
$conn->close();
?>

