<?php
    session_start();

    include "db_connect.php";

    // Login using prepare to prevent injection attacks
    $numHours = $_POST['numHoursApprove'];
    $adminPass = $_POST['passwordApprove'];
    $fileID = $_POST['fileIDApprove'];

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
            $stmt = $mysqli->prepare("UPDATE submissions SET approved = ?, declined = ?, reviewed = ? WHERE id_of_file = ?");
            $reviewedFile = 1;
            $declinedField = "";
            $stmt->bind_param("isis", $numHours, $declinedField, $reviewedFile, $fileID);

            $stmt->execute();
            $stmt->close();

            header("Location: ../pages/submissions.php");
        } else {
            header("Location: ../pages/submissions.php?approval=pass");
        }
    } else {
        header("Location: ../pages/submissions.php?approval=failed");
    }
    
?>