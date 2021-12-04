<?php
include_once('includes/dbh.inc.php');

// delete process
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE from `member` WHERE MemberID=$id") or die($conn->error);
    die(header("Location: MemberDetails.php"));
}

// add process
if (isset($_POST['add'])) {
        $conn->query("INSERT INTO `member` (ICNo, Name, Email, ContactNo, Username, Password) VALUES
                ('$_POST[memberIC]',
                 '$_POST[memberName]',
                 '$_POST[memberEmail]',
                 '$_POST[memberCont]',
                 '$_POST[memberUser]',
                 '$_POST[memberPass]')
                 ")
            or die($conn->error);
        die(header("Location: MemberDetails.php"));
    }


// edit process
if (isset($_POST["edit"])) {
    $conn->query("UPDATE `member` SET 
ICNo='{$_POST['memberIC']}',
Name='{$_POST['memberName']}',
Email='{$_POST['memberEmail']}',
ContactNo='{$_POST['memberCont']}',
Username='{$_POST['memberUser']}',
`Password`='{$_POST['memberPass']}' WHERE MemberID={$_POST['memberId']}") or die($conn->error);
    die(header("Location: MemberDetails.php"));
}
