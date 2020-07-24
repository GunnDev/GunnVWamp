<?php
    session_start();
    if(!isSet($_SESSION['student_id'])){
        header("Location: login.php");
    } else {
        $_SESSION = [];
        session_destroy();
        header("location: login.php"); 
        exit();
    }
?>