<?php
    session_start();

    include "db_connect.php";

    $lname = $_POST['lastNameToSearch'];
    $fname = $_POST['firstNameToSearch'];
    $studentid = $_POST['studentIDToSearch'];

    $g1 = isset($_POST['grade1']) ? $_POST['grade1'] : false;
    $g2 = isset($_POST['grade2']) ? $_POST['grade2'] : false;
    $g3 = isset($_POST['grade3']) ? $_POST['grade3'] : false;
    $g4 = isset($_POST['grade4']) ? $_POST['grade4'] : false;

    $sortType = isset($_POST['alphabetical']) ? $_POST['alphabetical'] : false;

    // ---------------------- Advanced Search ----------------------

    $urlStr = "?";
    $isAdvanced = false;

    // Sort type
    if($sortType == "alphabeticalF") {
        $urlStr = $urlStr . "st=F";
        $isAdvanced = true;
    } else if ($sortType == "alphabeticalL") {
        $urlStr = $urlStr . "st=L";
        $isAdvanced = true;
    }

    // Grade selections
    if($g1) {
        $urlStr = $urlStr . "&g1=1";
        $isAdvanced = true;
    }

    if ($g2) {
        $urlStr = $urlStr . "&g2=1";
        $isAdvanced = true;
    }

    if ($g3) {
        $urlStr = $urlStr . "&g3=1";
        $isAdvanced = true;
    }

    if ($g4) {
        $urlStr = $urlStr . "&g4=1";
        $isAdvanced = true;
    }

    // ---------------------- Name Search ----------------------

    if($fname || $lname || $studentid) {
        $isAdvanced = false;
        $urlStr = "?";
    }

    if($fname) {
        $urlStr = $urlStr . "fname=" . $fname;
    }

    if($lname) {
        $urlStr = $urlStr . "&lname=" . $lname;
    }

    if($studentid) {
        $urlStr = $urlStr . "&studid=" . $studentid;
    }

    // Set adv variable based on input
    if($isAdvanced) {
        $urlStr = $urlStr . "&adv=t";
    } else {
        $urlStr = $urlStr . "&adv=f";
    }

    header("Location: ../pages/students.php" . $urlStr);
?>