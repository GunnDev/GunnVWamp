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
            if($_SESSION['student_id'] != 1){
                header("Location: dashboard.php");
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

        <title>Gunn Volunteering | Reviewed Submissions</title>
    </head>

    <body>
        <div class="sidenavadmin">
            <h2 class="sideNavAdminTitle">
                Options
            </h2>
            <div class="sidenav-separator">
                <div style="background-color: #e8e8e8; width: 90%; height: 1px;">
                    <!-- Blank -->
                </div>
            </div>
            <a href="students.php?&g1=1&g2=1&g3=1&g4=1&adv=t">
                <i class="fas fa-users fa-lg"></i>
                &nbsp;
                Students
            </a>
            <a href="submissions.php">
                <i class="fas fa-paper-plane fa-lg"></i>
                &nbsp;
                Submissions
            </a>
            <a href="#"  style="background-color: #dedede; color: #1a73e8;">
                <i class="far fa-eye fa-lg"></i>
                &nbsp;
                Reviewed
            </a>
        </div>

        <div class="main">
            <header class="siteNavHeader" style="background-color: #1a73e8; height: 62px;">
                <h1 class="navMainTitle" style="cursor: context-menu;">Welcome, Administrator</h1>
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

            <section class="reviewed-admin-dash-section">
                <article>
                    <p class="submissionReviewTitle">
                        Reviewed Submissions:
                    </p>
                </article>

                <article>
                    <?php
                        include "../backend/db_connect.php";
                        include "../messages/reviewBox.php";

                        $getAllSubmissions = "SELECT * FROM submissions WHERE reviewed = 1";
                        $submissions = $mysqli->query($getAllSubmissions) or die (mysqli_error($mysqli));
                        $allSubmissions = $submissions->fetch_all(MYSQLI_ASSOC);

                        for($i = 0; $i < count($allSubmissions); $i++){
                            $studentName = "SELECT firstname, lastname FROM users WHERE userid = " . $allSubmissions[$i]['users_id'];
                            $studentNameArr = $mysqli->query($studentName) or die (mysqli_error($mysqli));
                            $fullName = $studentNameArr->fetch_all(MYSQLI_ASSOC);

                            $reviewBox = new reviewBox($fullName[0]['firstname'], $fullName[0]['lastname'],  $allSubmissions[$i]['name_of_file'], $allSubmissions[$i]['id_of_file'], $allSubmissions[$i]['approved'], $allSubmissions[$i]['declined']);
                            $reviewBox->printMessage();
                        }
                    ?>
                </article>
            </section>

            <div id="rcm" class="reviewConfirmModal">
                <div class="reviewConfirmModalContent">
                    <section class="mainRevisionConfirmationSection">
                        <article style="text-align: center; font-weight: 430;">
                            <p style="margin:0;padding-bottom:10px;">
                                This file will move back into the submissions tab for editing.
                            </p>
                        </article>

                        <article>
                            <form id="revForm" action="../backend/reviseFile.php" method="post">
                                <button type="submit" class="editSubmissionBtnR">
                                    Confirm
                                </button>

                                <input type="hidden" id="fileIDReviseInput" name="firi" value="">
                            </form>
                        </article>
                    </section>
                </div>
            </div>
        </div>

    </body>

</html>