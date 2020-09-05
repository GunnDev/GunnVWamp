<?php
    session_start();

    include "db_connect.php";

    // Login using prepare to prevent injection attacks
    $numHours = $_POST['numHoursApprove'];
    $adminPass = $_POST['passwordApprove'];
    $fileID = $_POST['fileIDApprove'];

    echo $numHours . " " . $adminPass . " " . $fileID;
?>