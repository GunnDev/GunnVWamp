<!DOCTYPE html>
<!--

Author: Mihir Rao
Gunn Volunteering

-->

<html>
    <?php
        include '../backend/GoogleDriveUtils.php';
        session_start();
        if(!isSet($_SESSION['student_id'])){
            header("Location: login.php");
        } else {
            if ($_SESSION['student_id'] == 1){
                header("Location: students.php");
            }
        }
    ?>

    <head>
        <!-- Links, Cool stuff, and Page Specs -->
        <link rel="stylesheet" href="../css/dashStyles.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/81f93d9156.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta charset="utf-8">

        <script src="../scripts/sideNav.js"></script>
        <script src="../scripts/addHourModal.js"></script>
        <script src="../scripts/uploadFile.js"></script>
        <script>
            window.addEventListener('load', (event) => {
                var progBar = document.getElementById("pBar");
                var text = document.getElementById("nhrsDisplay");

                if (progBar.value >= 100) {
                    text.style.color = "#2e944a";
                    progBar.classList.toggle('progressBarGte100')
                }
            });
        </script>

        <title>Gunn Volunteering | Student Dashboard</title>
    </head>

    <body>
        <header class="siteNavHeader">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                
                <button class="btnRipple">
                    My Account
                </button>
                <button class="btnRipple">
                    Option 2
                </button>
                <button class="btnRipple">
                    Option 3
                </button>

                <!-- Button ripple effect -->
                <script src="../scripts/btnRipple.js"></script>
            </div>
            
            <button onclick="openNav()" class="dropdownBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <h1 class="navMainTitle" style="cursor: context-menu;">Gunn Volunteering</h1>
            <nav class="navbarItems">
                <ul class="navbarLinks">
                    <li>
                        <a href="logout.php">
                            <i class="fas fa-sign-out-alt fa-2x"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <section class="mainDashSection">
            <article>
                <section class="userDashSection">
                    <article class="userIconContainer">
                        <div class="userIcon">
                            <img src="../images/user.png">
                        </div>
                    </article>

                    <article>
                        <div class="nameAndGradYear">
                            <h1 class="nameTitle">
                                <?php
                                    echo $_SESSION['student_fname'] . ' ' . $_SESSION['student_lname'];
                                ?>
                            </h1>
                            <h1 class="gradYearDisplay">
                                <?php
                                    echo $_SESSION['student_gyear'];
                                ?>
                            </h1>
                        </div>
                    </article>

                    <article>
                        <h1 class="userProgressTitle">
                            Progress
                        </h1>
                        <div class="userProgress">
                            <?php
                                include "../backend/db_connect.php";
            
                                $totalHoursQuery = "SELECT approved FROM submissions WHERE approved != -1 AND users_id = " . $_SESSION['user_id'];
                                $totalHoursQueryResult = $mysqli->query($totalHoursQuery) or die (mysqli_error($mysqli));
                                $totalHoursList = $totalHoursQueryResult->fetch_all(MYSQLI_ASSOC);

                                $totalHours = 0;
                                for($i = 0; $i < count($totalHoursList); $i++){
                                    $totalHours = $totalHours + $totalHoursList[$i]['approved'];
                                }

                          echo '<div class="progressBarDiv">
                                    <progress id="pBar" class="progressBarStyles" value=' . $totalHours . ' max="100"></progress>
                                    <br>
                                    <span class="completedHrsStatement">You have completed&nbsp;<span id="nhrsDisplay">' . $totalHours . '/100 </span>&nbsp;hours.</span>
                                </div>';
                            ?>
                        </div>
                    </article>
                </section>
            </article>

            <article></article>

            <!-- Pending Submissions -->
            <article>
                <h1 class="hoursTitle">
                    Pending Hours
                </h1>
                <div class="addHoursContainer">
                    <button title="Submit Volunteer Hours" onclick="addHour()" class="addHoursBtn">
                        <i class="fas fa-plus"></i>
                    </button>

                    <?php
                        $numFilesStmt = "SELECT * FROM submissions WHERE reviewed = 0 AND users_id = " . $_SESSION['user_id'];
                        $numFiles = $mysqli->query($numFilesStmt) or die (mysqli_error($mysqli));
                        $numFilesList = $numFiles->fetch_all(MYSQLI_ASSOC);

                        if (count($numFilesList) > 0) {
                            echo '<button title="Delete All Submissions" onclick="deleteAllFiles()" class="deleteAll">
                                    <i class="fas fa-trash"></i>
                                </button>';
                        } else {
                            echo '<button title="No Files To Delete" class="deleteAll-Blocked">
                                    <i class="fas fa-trash"></i>
                                </button>';
                        }
                    ?>

                    <div id="dafm" class="deleteAllFilesModal">
                        <div class="deleteAllFilesContent">
                            <section class="confirmDeleteAll">
                                <form id="deleteAllForm" action="../backend/deleteAllFiles.php" method="post">
                                    <article>
                                        <p class="deleteFileTitle">
                                            Delete All Submissions?
                                        </p>
                                    </article>
                                    <article>
                                        <div class="inputWithIcon">
                                            <input class="passwordRepl" name="passToDeleteAll" type="password" placeholder="Password" required>
                                            <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                        </div>
                                    </article>
                                    <article>
                                        <section class="cancelConfirm">
                                                <article>
                                                    <button id="cancelAllDelete" type="button" class="fileDeleteBtns">
                                                        Cancel
                                                    </button>
                                                </article>
                                                <article>
                                                    <button id="confirmAllDelete" type="submit" class="fileDeleteBtns">
                                                        Delete
                                                    </button>
                                                </article>
                                        </section>
                                    </article>
                                </form>
                                <article>
                                    <?php
                                        include '../messages/delError.php';

                                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                                        if (strpos($fullUrl, "deleteAll=err") == true){
                                            $fileErrorMessage = new delError('No files to delete.');
                                            $fileErrorMessage->printMessage();
                                        }

                                        if (strpos($fullUrl, "deleteAll=pass") == true){
                                            $fileErrorMessage = new delError('Incorrect credentials.');
                                            $fileErrorMessage->printMessage();
                                        }

                                        if (strpos($fullUrl, "deleteAll=failure") == true){
                                            $fileErrorMessage = new delError('An error occured.');
                                            $fileErrorMessage->printMessage();
                                        }
                                    ?>
                                </article>
                            </section>
                        </div>
                    </div>

                    <div id="dtfm" class="deleteThisFileModal">
                        <div class="deleteThisFileContent">
                            <section class="confirmFileDelete">
                                <form id="deleteForm" action="../backend/deleteChosenFile.php" method="post">
                                    <article>
                                        <p class="deleteFileTitle">
                                            Delete &nbsp;
                                            <span id="deleteFileHeading" style="color: #706f6f;">
                                                some file
                                            </span>
                                        </p>
                                    </article>
                                    <article>
                                        <div class="inputWithIcon">
                                            <input class="passwordRepl" name="enterPassToDelete" type="password" placeholder="Password" required>
                                            <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                        </div>
                                    </article>
                                    <article>
                                        <section class="cancelConfirm">
                                            <article>
                                                <button id="cancelFileDelete" type="button" class="fileDeleteBtns">
                                                    Cancel
                                                </button>
                                            </article>
                                            <article>
                                                <button id="deleteFile" type="submit" class="fileDeleteBtns">
                                                    Delete
                                                </button>
                                            </article>
                                        </section>
                                    </article>
                                    <input id="deletingFile" type="hidden" name="file" value="">
                                </form>
                                <article>
                                    <?php
                                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                                        if (strpos($fullUrl, "delete=pass") == true){
                                            $fileErrorMessage = new delError('Incorrect credentials.');
                                            $fileErrorMessage->printMessage();
                                        }

                                        if (strpos($fullUrl, "delete=failure") == true){
                                            $fileErrorMessage = new delError('An error occured.');
                                            $fileErrorMessage->printMessage();
                                        }
                                    ?>
                                </article>
                            </section>
                        </div>
                    </div>

                    <!-- Keep the add hours modal open -->
                    <script src="../scripts/keepHoursOpen.js"></script>

                    <div id="add_h" class="ahp">
                        <div class="ahp-content">
                            <p class="uploadFilesTitle">
                                Upload Your Hours
                            </p>

                            <span>
                                <i class="fas fa-times ahp-close"></i>
                            </span>
                            
                            <section class="fileSelectContent">
                                <article>
                                    <section class="topFileSelectSection">
                                        <article style="display: flex; justify-content: center;">
                                            <div class="iconDiv">
                                                <i class="fas fa-file-upload fa-6x" style="color: #1a73e8;"></i>
                                            </div>
                                        </article>

                                        <article>
                                            <p id="selFTitle" style="margin: 0; padding: 0; font-weight: 400; color: gray;">
                                                Selected File: None
                                            </p>
                                            <div id="show_file_list"></div>
                                        </article>
                                    </section>
                                </article>

                                <article>
                                    <section class="bottomFileSelectSection">
                                        <article>
                                            <form id="addForm" action="../backend/uploadChosenFiles.php" method="POST" enctype="multipart/form-data">
                                                <div class="fileUpload">
                                                    <label for="fileInput" class="selectFilesLabel">
                                                        <span class="fileSelectSpan">Browse</span>
                                                    </label>
                                                    <input name="sFiles" id="fileInput" type="file" onchange="javascript:showfiles()" accept="application/pdf, image/jpeg, image/jpg, image/png, .docx">
                                                </div>

                                                <button name="uFiles" type="submit" class="uploadFilesBtn">
                                                    Upload
                                                </button>
                                            </form>
                                        </article>
                                    </section>
                                </article>

                                <article>
                                    <!-- Display results of file upload -->

                                    <?php
                                        include '../messages/fileSuccess.php';
                                        include '../messages/fileError.php';

                                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                                        if (strpos($fullUrl, "upload=filename") == true){
                                            $fileErrorMessage = new fileError('Please make the file name shorter.');
                                            $fileErrorMessage->printMessage();
                                        }

                                        if (strpos($fullUrl, "upload=max") == true){
                                            $fileErrorMessage = new fileError('Max submissions reached.');
                                            $fileErrorMessage->printMessage();
                                        }

                                        if (strpos($fullUrl, "upload=success") == true){
                                            if (isset($_GET['fName'])) {
                                                $fileName = $_GET['fName'];
                                                $successM = new fileSuccess('Uploaded: ' . $fileName);
                                                $successM->printMessage();
                                            } else {
                                                $successM = new fileSuccess('Your file was uploaded!');
                                                $successM->printMessage();
                                            }
                                        }

                                        if (strpos($fullUrl, "upload=toobig") == true){
                                            $fileErrorMessage = new fileError('This file is too large :(');
                                            $fileErrorMessage->printMessage();
                                        }

                                        if (strpos($fullUrl, "upload=err") == true){
                                            $fileErrorMessage = new fileError('Error uploading file: Check file size.');
                                            $fileErrorMessage->printMessage();
                                        }

                                        if (strpos($fullUrl, "upload=ftype") == true){
                                            $fileErrorMessage = new fileError('Invalid file type.');
                                            $fileErrorMessage->printMessage();
                                        }
                                    ?>
                                </article>

                            </section>
                        </div>
                    </div>
                </div>
            </article>

            <article>
                <?php
                    include "../backend/db_connect.php";
                    include '../messages/pendingFile.php';

                    $pendingSubmissionsStmt = "SELECT * FROM submissions WHERE reviewed = 0 AND users_id = " . $_SESSION['user_id'];
                    $pendingSubmissions = $mysqli->query($pendingSubmissionsStmt) or die (mysqli_error($mysqli));
                    $pendingSubmissionsList = $pendingSubmissions->fetch_all(MYSQLI_ASSOC);

                    for($i = 0; $i < count($pendingSubmissionsList); $i++){
                        $file = new pendingFile($pendingSubmissionsList[$i]['name_of_file'], $pendingSubmissionsList[$i]['id_of_file']);
                        $file->showPendingFile();
                    }

                    // GETS FILES USING GOOGLE DRIVE API
                    // ------------------------------------------------------------
                    //
                    // include '../messages/pendingFile.php';

                    // $googleDriveUtils = unserialize($_SESSION['driveAPI']);
                    // $folderName = $_SESSION['student_fname'] . $_SESSION['student_lname'] . '_' . $_SESSION['student_id'];
                    // $listOfFiles = $googleDriveUtils->getFilesForUser($folderName);
                    
                    // for ($i = 0; $i < count($listOfFiles); $i++) {
                    //     // Create the object and show the file
                    //     $file = new pendingFile(array_keys($listOfFiles)[$i], array_values($listOfFiles)[$i]);
                    //     $file->showPendingFile();
                    // }
                ?>
            </article>

            <!-- Approved Submissions -->
            <article>
                <h1 class="hoursTitle">
                    Approved Hours
                </h1>
                <?php
                    include "../backend/db_connect.php";
                    include "../messages/displayFile.php";

                    $approvedSubmissionsStmt = "SELECT * FROM submissions WHERE approved > -1 AND users_id = " . $_SESSION['user_id'];
                    $approvedSubmissions = $mysqli->query($approvedSubmissionsStmt) or die (mysqli_error($mysqli));
                    $approvedSubmissionsList = $approvedSubmissions->fetch_all(MYSQLI_ASSOC);

                    for($i = 0; $i < count($approvedSubmissionsList); $i++){
                        $file = new displayFile($approvedSubmissionsList[$i]['name_of_file']);
                        $file->showFile();
                    }
                ?>
            </article>

            <!-- Declined Submissions -->
            <article>
                <h1 class="hoursTitle">
                    Declined Hours
                </h1>
                <?php
                    include "../backend/db_connect.php";
                    include "../messages/declinedFile.php";

                    $approvedSubmissionsStmt = "SELECT * FROM submissions WHERE reviewed = 1 AND approved = -1 AND users_id = " . $_SESSION['user_id'];
                    $approvedSubmissions = $mysqli->query($approvedSubmissionsStmt) or die (mysqli_error($mysqli));
                    $approvedSubmissionsList = $approvedSubmissions->fetch_all(MYSQLI_ASSOC);

                    for($i = 0; $i < count($approvedSubmissionsList); $i++){
                        $file = new declinedFile($approvedSubmissionsList[$i]['name_of_file'], $approvedSubmissionsList[$i]['declined']);
                        $file->showFile();
                    }
                ?>
            </article>

            <div id="showDeclineMessage" class="showMessageModal">
                <div class="showMessageContent">
                    <p id="pToShowReason" class="reasonStyles">
                        hi
                    </p>
                </div>
            </div>

        </section>
    </body>

</html>