<?php
    session_start();
    include "GoogleDriveUtils.php";

    $pass = $_POST['enterPassToDelete'];
    echo $pass;

    $file = $_POST['file'];
    echo $file;
?>