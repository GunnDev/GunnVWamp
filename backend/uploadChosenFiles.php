<!--

Author: Mihir Rao
© Gunn Volunteering

-->

<?php
    include 'GoogleDriveUtils.php';
    include "db_connect.php";
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

        # If people have file names that are over 40 characters long...
        if (strlen($fileName) > 40) {
            header("Location: ../pages/dashboard.php?upload=filename");
            exit();
        }

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
                    $randName = uniqid('', true). '.' . $fileLoweredExt;
                    $fileDestination = 'uploads/' . $randName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    // Check if the file name exists already
                    $listOfFiles = $googleDriveUtils->getFilesForUser($folderName);
                    $fileNameOccurances = 0;

                    $fileNames = array_keys($listOfFiles);
                    $fileAspects = explode('.', $fileName);
                    $fileNameWithoutExtension = $fileAspects[0];
                    $fileExtension = $fileAspects[1];
                    
                    for($i = 0; $i < count($fileNames); $i++){
                        // If there is a file that has the same name, increment occurances
                        $currentFileInfo = explode('.', $fileNames[$i]);
                        $currentFileExtension = end($currentFileInfo);
                        if (strpos($fileNames[$i], $fileNameWithoutExtension) == 0 && $fileExtension == $currentFileExtension){
                            $fileNameOccurances += 1;
                        }
                    }

                    if($fileNameOccurances != 0){
                        $fileNameWithoutExtension = $fileNameWithoutExtension . "(" . ($fileNameOccurances + 1) . ")";
                        $fileName = $fileNameWithoutExtension . "." . $fileExtension;
                    }

                    # Upload to Google Drive using API and delete from uploads folder
                    $createdFileID = $googleDriveUtils->uploadFiles($fileDestination, $fileName, $folderName);
                    unlink($fileDestination);

                    if (strlen($fileNameWithoutExtension) > 12) {
                        $fileName = substr($fileName, 0, 13) . '...' . $fileLoweredExt;
                    }

                    # Add to submissions table
                    $approved = -1;
                    $declined = '';
                    $user_id = $_SESSION['user_id'];

                    $stmt = $mysqli->prepare("INSERT INTO submissions (submission_id, name_of_file, id_of_file, approved, declined, users_id) VALUES (null, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssisi", $fileName, $createdFileID, $approved, $declined, $user_id);

                    $stmt->execute();
                    $stmt->close();

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