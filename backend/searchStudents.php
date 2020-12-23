<?php
    session_start();

    include "db_connect.php";

    $lname = $_POST['lastNameToSearch'];
    $fname = $_POST['firstNameToSearch'];
    $studentid = $_POST['studentIDToSearch'];

    echo $lname;
    echo $fname;
    echo $studentid;
?>