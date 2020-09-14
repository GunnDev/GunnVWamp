<?php
    session_start();

    include "db_connect.php";

    // Login using prepare to prevent injection attacks
    $fileToChange = $_POST['firi'];

    $stmt = $mysqli->prepare("UPDATE submissions SET reviewed = ? WHERE id_of_file = ?");
    $reviewedFile = 0;
    $stmt->bind_param("is", $reviewedFile, $fileToChange);

    $stmt->execute();
    $stmt->close();

    header("Location: ../pages/reviewed.php");
?>