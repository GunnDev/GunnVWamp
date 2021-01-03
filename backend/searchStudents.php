<?php
    session_start();

    include "db_connect.php";

    $lname = $_POST['lastNameToSearch'];
    $fname = $_POST['firstNameToSearch'];
    $studentid = $_POST['studentIDToSearch'];

    // Advanced
    $g1 = $_POST['grade1'];
    $g2 = $_POST['grade2'];
    $g3 = $_POST['grade3'];
    $g4 = $_POST['grade4'];

    $sortType = $_POST['alphabetical'];

    echo $lname;
    echo $fname;
    echo $studentid;
    echo $g1;
    echo $g2;
    echo $g3;
    echo $g4;
    echo $sortType;
?>