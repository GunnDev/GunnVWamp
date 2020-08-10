<?php
    session_start();

    include "db_connect.php";
    include "GoogleDriveUtils.php";

    // Login using prepare to prevent injection attacks
    $stud_id = $_POST['student_id'];
    $stud_pass = $_POST['student_pass'];

    $stmt = $mysqli->prepare("SELECT userid, studentid, studentemail, firstname, lastname, gradyear, studentpass FROM users WHERE studentid = ?");
    $stmt->bind_param("i", $stud_id);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($uid, $studid, $studemail, $fname, $lname, $gyear, $upass);

    // Check if a row exists. If it doesn't return failure and destroy session
    if ($stmt->num_rows == 1){
        $stmt->fetch();
        // Verify the given password with the hashed password and add to session; else, failure
        if (password_verify($stud_pass, $upass)){
            $_SESSION['student_id'] = $studid;
            $_SESSION['student_email'] = $studemail;
            $_SESSION['student_fname'] = $fname;
            $_SESSION['student_lname'] = $lname;
            $_SESSION['student_gyear'] = $gyear;

            $utils = new GoogleDriveUtils();
            $_SESSION['driveAPI'] = serialize($utils);
            
            header("Location: ../pages/dashboard.php");
            
            exit;
        } else {
            header("Location: ../pages/login.php?login=failure");
            $_SESSION = [];
            session_destroy();
        }
    } else {
        header("Location: ../pages/login.php?login=failure");
        $_SESSION = [];
        session_destroy();
    }
    header("Location: ../pages/login.php?login=failure");
?>