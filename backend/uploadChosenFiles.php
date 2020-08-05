<!--

Author: Mihir Rao
© Gunn Volunteering

-->

<?php
    include 'GoogleDriveUtils.php';
    session_start();

    # If not logged in
    if(!isSet($_SESSION['student_id'])){
        header("Location: login.php");
    }

    # If file is selected
    if(isSet($_POST['uFiles'])){

        # Get the file
        $file = $_FILES['sFiles'];

        # File info
        $fileName = $_FILES['sFiles']['name'];
        $fileTmpName = $_FILES['sFiles']['tmp_name'];
        $fileSize = $_FILES['sFiles']['size'];
        $fileError = $_FILES['sFiles']['error'];
        $fileType = $_FILES['sFiles']['type'];

        # File extension
        $fileExt = explode('.', $fileName);
        $fileLoweredExt = strtolower(end($fileExt));

        # Allowed file types - this isn't actually necessary bc the input limits this
        $allowedExts = array('pdf', 'jpeg', 'jpg', 'png', 'docx');

        # If chosen file is acceptable
        if (in_array($fileLoweredExt, $allowedExts)) {

            # No errors
            if ($fileError === 0) {

                # File meets size req
                if ($fileSize < 1000000) {

                    # Prevent file overriding by renaming using uniqid()
                    $fileNameNew = uniqid('', true). '.'. $fileLoweredExt;

                    # Move the file temporarily to uploads folder
                    $fileDestination = 'uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    # Upload to Google Drive using API and delete from uploads folder
                    $googleDriveUtils = $_SESSION['driveAPI'];
                    $googleDriveUtils->uploadFiles($fileDestination);
                    unlink($fileDestination);

                    # Send the user back to dashboard with success message
                    header("Location: ../pages/dashboard.php?upload=success");
                } else {
                    header("Location: ../pages/dashboard.php?upload=toobig");
                }
            } else {
                header("Location: ../pages/dashboard.php?upload=err");
            }
        } else {
            header("Location: ../pages/dashboard.php?upload=ftype");
        }
    }
?>