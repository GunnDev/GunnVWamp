<?php
    include "db_connect.php";
    include "GoogleDriveUtils.php";
    session_start();

    # If not logged in
    if(!isSet($_SESSION['student_id'])){
        header("Location: login.php");
    }

    # Get entered password and file which we want to delete
    $pass = $_POST['enterPassToDelete'];
    $fileToDel = $_POST['file'];

    $stud_id = $_SESSION['student_id'];
    $stmt = $mysqli->prepare("SELECT userid, studentid, studentemail, firstname, lastname, gradyear, studentpass FROM users WHERE studentid = ?");
    $stmt->bind_param("i", $stud_id);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($uid, $studid, $studemail, $fname, $lname, $gyear, $upass);

    if ($stmt->num_rows == 1){
        $stmt->fetch();
        // Verify the given password
        if (password_verify($pass, $upass)){

            // Delete the file
            $googleDriveUtils = unserialize($_SESSION['driveAPI']);
            $folderName = $_SESSION['student_fname'] . $_SESSION['student_lname'] . '_' . $_SESSION['student_id'];
            $deletionResult = $googleDriveUtils->deleteFile($folderName, $_SESSION['student_fname'] . $_SESSION['student_lname'] . "-" . $fileToDel);
            
            if ($deletionResult == true){
                header("Location: ../pages/dashboard.php?delete=success");
            } else {
                header("Location: ../pages/dashboard.php?delete=nonexistent");
            }
            exit;
        } else {
            header("Location: ../pages/dashboard.php?delete=incorrectpass");
        }
    } else {
        header("Location: ../pages/dashboard.php?delete=failure");
    }
    header("Location: ../pages/dashboard.php?delete=failure");
?>