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
    $fileToDelID = $_POST['file'];

    $stud_id = $_SESSION['student_id'];
    $user_id = $_SESSION['user_id'];
    $stmt = $mysqli->prepare("SELECT userid, studentid, studentemail, firstname, lastname, gradyear, num_hours, studentpass FROM users WHERE studentid = ?");
    $stmt->bind_param("i", $stud_id);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($uid, $studid, $studemail, $fname, $lname, $gyear, $numhours, $upass);

    if ($stmt->num_rows == 1){
        $stmt->fetch();
        // Verify the given password
        if (password_verify($pass, $upass)){

            // Delete the file
            $googleDriveUtils = unserialize($_SESSION['driveAPI']);
            $folderName = $_SESSION['student_fname'] . $_SESSION['student_lname'] . '_' . $_SESSION['student_id'];
            $googleDriveUtils->deleteFileUsingID($fileToDelID);

            // Delete selected file for that user from submissions table
            $stmt = $mysqli->prepare("DELETE FROM submissions WHERE id_of_file = ? AND users_id = ?");
            $stmt->bind_param("si", $fileToDelID, $user_id);

            $stmt->execute();
            $stmt->close();
            
            // Success message
            header("Location: ../pages/dashboard.php");
            
            exit;
        } else {
            header("Location: ../pages/dashboard.php?delete=pass&req=" . $fileToDelID);
        }
    } else {
        header("Location: ../pages/dashboard.php?delete=failure&req=" . $fileToDelID);
    }
?>