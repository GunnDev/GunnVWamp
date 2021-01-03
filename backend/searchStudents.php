<?php
    session_start();

    include "db_connect.php";

    $lname = $_POST['lastNameToSearch'];
    $fname = $_POST['firstNameToSearch'];
    $studentid = $_POST['studentIDToSearch'];

    // Advanced
    $g1 = isset($_POST['grade1']) ? $_POST['grade1'] : false;
    $g2 = isset($_POST['grade2']) ? $_POST['grade2'] : false;
    $g3 = isset($_POST['grade3']) ? $_POST['grade3'] : false;
    $g4 = isset($_POST['grade4']) ? $_POST['grade4'] : false;

    $sortType = isset($_POST['alphabetical']) ? $_POST['alphabetical'] : false;

    echo $lname;
    echo $fname;
    echo $studentid;
    echo $g1;
    echo $g2;
    echo $g3;
    echo $g4;
    echo $sortType;
?>