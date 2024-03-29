<?php
    session_start();

    include "db_connect.php";

    // Login using prepare to prevent injection attacks
    $reason = $_POST['declineReason'];
    $adminPass = $_POST['passwordDecline'];
    $fileID = $_POST['fileIDDecline'];

    // Get Submisison Entry
    $getEntrystmt= $mysqli->prepare("SELECT * FROM submissions WHERE id_of_file = ?");
    $getEntrystmt->bind_param("s", $fileID);
    $getEntrystmt->execute();
    $getEntrystmt->store_result();
    $getEntrystmt->bind_result($subid, $nameOfFile, $id_of_file, $approved, $declined, $reviewed, $usersID);

    // For Verifying Password
    $getEntrystmt = $mysqli->prepare("SELECT studentpass FROM users WHERE studentid = 1");
    $getEntrystmt->execute();
    $getEntrystmt->store_result();
    $getEntrystmt->bind_result($apass);

    if ($getEntrystmt->num_rows == 1){
        $getEntrystmt->fetch();

        if (password_verify($adminPass, $apass)){
            $stmt = $mysqli->prepare("UPDATE submissions SET approved = ?, reviewed = ?, declined = ? WHERE id_of_file = ?");
            $reviewedFile = 1;
            $approvedField = -1;
            $stmt->bind_param("iiss", $approvedField, $reviewedFile, $reason, $fileID);

            $stmt->execute();
            $stmt->close();

            header("Location: ../pages/submissions.php");
        } else {
            header("Location: ../pages/submissions.php?decline=pass");
        }
    } else {
        header("Location: ../pages/submissions.php?decline=failed");
    }
    
?>