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

    $googleDriveUtils = unserialize($_SESSION['driveAPI']);
    $folderName = $_SESSION['student_fname'] . $_SESSION['student_lname'] . '_' . $_SESSION['student_id'];

    # If the user has already submitted max number of files
    $filesList = $googleDriveUtils->getFilesForUser($folderName);
    if (count($filesList) == 4) {
        header("Location: ../pages/dashboard.php?upload=max");
        exit();
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
        $fileAspects = explode('.', $fileName);
        $fileNameWithoutExtension = $fileAspects[0];
        $fileLoweredExt = strtolower(end($fileAspects));

        # Allowed file types - this isn't actually necessary bc the input limits this
        $allowedExts = array('pdf', 'jpeg', 'jpg', 'png', 'docx');

        # If chosen file is acceptable
        if (in_array($fileLoweredExt, $allowedExts)) {

            # No errors
            if ($fileError === 0) {

                # File meets size req
                if ($fileSize < 1000000) {

                    # Prevent file overriding by renaming using uniqid()
                    $randName = uniqid('', true). '.' . $fileLoweredExt;

                    # Move the file temporarily to uploads folder
                    $fileDestination = 'uploads/' . $randName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    # Upload to Google Drive using API and delete from uploads folder
                    $createdFileID = $googleDriveUtils->uploadFiles($fileDestination, $fileName, $folderName);
                    unlink($fileDestination);

                    # Reduce file name length if necessary
                    if (strlen($fileNameWithoutExtension) > 12) {
                        $fileName = substr($fileName, 0, 13) . '...' . $fileLoweredExt;
                    }

                    # Send the user back to dashboard with success message
                    header("Location: ../pages/dashboard.php?upload=success&fName=" . $fileName);
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