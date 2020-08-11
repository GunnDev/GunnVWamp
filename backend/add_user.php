<?php
    include "db_connect.php";

    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $grad_year = $_POST['grad_year'];
    $studentemail = $_POST['studentemail'];
    $password = $_POST['password'];
    $password_confirm = $_POST['passwordC'];

    // Construct student ID
    $studentid = '950'.substr($studentemail, 2, 5);

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    // Verify first name to make sure it has only letters and has length [1, 19]
    preg_match("/^[a-zA-Z]{1,19}$/", $first_name, $matches);
    if (sizeof($matches) == 0){
        header("Location: ../pages/register.php?register=invalidfirst");
        exit();
    }

    // Verify last name to make sure it has only letters and has length [1, 19]
    preg_match("/^[a-zA-Z]{1,19}$/", $last_name, $matches);
    if (sizeof($matches) == 0){
        header("Location: ../pages/register.php?register=invalidlast");
        exit();
    }

    // Verify graduation year to make sure it is after today and 4 digits
    preg_match("/^20([0-9]){2}$/", $grad_year, $matches);
    if (sizeof($matches) == 0 || $grad_year < date("Y")){
        header("Location: ../pages/register.php?register=invalidgrad");
        exit();
    }

    /*
    Verify Email:
        - beginning before @ has lowercase letters and numbers - 7 chars long
        - ends with @pausd.us
        - beginning before @ has two letters and 5 numbers
    If these fail, its not a valid pausd email
    */

    // Check to see if user exists already - through student id
    $sql2 = "SELECT * FROM users WHERE studentid = '$studentid'";
    $result2 = $mysqli->query($sql2) or die (mysqli_error($mysqli));

    if ($result2->num_rows > 0){
        header("Location: ../pages/register.php?register=invalidemail");
        exit();
    }

    preg_match("/^([a-z0-9]){7}@pausd.us$/", $studentemail, $matches);
    preg_match("/^([a-z]){2}\d{5}$/", substr($studentemail, 0, 7), $frontmatches);
    if (sizeof($matches) == 0 || sizeof($frontmatches) == 0){
        header("Location: ../pages/register.php?register=invalidemail");
        exit();
    }

    // Verify password to make sure length is [8, 19]
    preg_match("/^.{8,19}$/", $password, $matches);
    if (sizeof($matches) == 0){
        header("Location: ../pages/register.php?register=invalidpass");
        exit();
    }

    // If passwords don't match
    if ($password != $password_confirm){
        header("Location: ../pages/register.php?register=matchfailure");
    } else {
        // Check to see if user exists already - through email
        $sql = "SELECT * FROM users WHERE studentemail = '$studentemail'";
        $result = $mysqli->query($sql) or die (mysqli_error($mysqli));
        
        // If num_rows > 0 that means there is a row that exists already
        if ($result->num_rows > 0){
            header("Location: ../pages/register.php?register=emailexists");
        } else {
            // If not, we can add the user into the users database.
            $stmt = $mysqli->prepare("INSERT INTO users (userid, studentid, studentemail, firstname, lastname, gradyear, studentpass) VALUES (null, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssis", $studentid, $studentemail, $first_name, $last_name, $grad_year, $hashed_pass);

            $stmt->execute();
            $stmt->close();

            header("Location: ../pages/register.php?register=success");
        }
    }
?>