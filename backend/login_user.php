<?php
    session_start();

    include "db_connect.php";
    include "GoogleDriveUtils.php";

    // Login using prepare to prevent injection attacks
    $stud_id = $_POST['student_id'];
    $stud_pass = $_POST['student_pass'];

    $stmt = $mysqli->prepare("SELECT userid, studentid, studentemail, firstname, lastname, gradyear, num_hours, studentpass FROM users WHERE studentid = ?");
    $stmt->bind_param("i", $stud_id);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($uid, $studid, $studemail, $fname, $lname, $gyear, $numhours, $upass);

    // Check if a row exists. If it doesn't return failure and destroy session
    if ($stmt->num_rows == 1){
        $stmt->fetch();
        // Verify the given password with the hashed password and add to session; else, failure
        if (password_verify($stud_pass, $upass)){
            $_SESSION['user_id'] = $uid;
            $_SESSION['student_id'] = $studid;
            $_SESSION['student_email'] = $studemail;
            $_SESSION['student_fname'] = $fname;
            $_SESSION['student_lname'] = $lname;
            $_SESSION['student_gyear'] = $gyear;
            $_SESSION['student_numhours'] = $numhours;

            $utils = new GoogleDriveUtils();
            try {
                $_SESSION['driveAPI'] = serialize($utils);
            } catch (\Exception $e) {
                $_SESSION = [];
                session_destroy();
                header("Location: ../pages/login.php?login=failure");
            }
            
            header("Location: ../pages/dashboard.php");
            
            exit;
        } else {
            $_SESSION = [];
            session_destroy();
            header("Location: ../pages/login.php?login=failure");
        }
    } else {
        $_SESSION = [];
        session_destroy();
        header("Location: ../pages/login.php?login=failure");
    }
    header("Location: ../pages/login.php?login=failure");
?>