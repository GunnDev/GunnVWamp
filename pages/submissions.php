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

        <script src="../scripts/showaord.js"></script>
        <meta charset="utf-8">

        <title>Gunn Volunteering | Submissions</title>
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
            <a href="#" style="background-color: #dedede; color: #1a73e8;">
                <i class="fas fa-paper-plane fa-lg"></i>
                &nbsp;
                Submissions
            </a>
            <a href="reviewed.php">
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

            <section class="submissions-admin-dash-section">
                <article>
                    <p class="submissionReviewTitle">
                        Submissions: 
                        <?php
                            include "../backend/db_connect.php";
                            include "../messages/submissionBox.php";

                            $pendingSubmissionsStmt = "SELECT * FROM submissions WHERE reviewed = 0";
                            $pendingSubmissions = $mysqli->query($pendingSubmissionsStmt) or die (mysqli_error($mysqli));
                            $pendingSubmissionsList = $pendingSubmissions->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <span>
                            <?php
                                echo "<span style='color:#1a73e8; font-weight:500'>" .  count($pendingSubmissionsList) . "</span>";
                            ?>
                        </span>
                    </p>
                </article>
                    
                <article>
                    <p class="submissionReviewTitle">
                        Review: 
                        <span id="submitReviewTitleName" style="color:#1a73e8; font-weight:430;">
                            Select a submission on the left.
                        </span>
                    </p>
                </article>

                <article style="max-height: 500px; overflow-y: scroll">
                    <?php
                        $getAllSubmissions = "SELECT * FROM submissions";
                        $submissions = $mysqli->query($getAllSubmissions) or die (mysqli_error($mysqli));
                        $allSubmissions = $submissions->fetch_all(MYSQLI_ASSOC);

                        for($i = 0; $i < count($allSubmissions); $i++){
                            $studentName = "SELECT firstname, lastname FROM users WHERE userid = " . $allSubmissions[$i]['users_id'];
                            $studentNameArr = $mysqli->query($studentName) or die (mysqli_error($mysqli));
                            $fullName = $studentNameArr->fetch_all(MYSQLI_ASSOC);
                            $fileLink = 'https://drive.google.com/open?id=' . $allSubmissions[$i]['id_of_file'];

                            if($allSubmissions[$i]['reviewed'] == 0){
                                $submissionBox = new submissionBox($fullName[0]['firstname'], $fullName[0]['lastname'],  $allSubmissions[$i]['name_of_file'], $allSubmissions[$i]['id_of_file'], $fileLink);
                                $submissionBox->printMessage();
                            }
                        }
                    ?>
                </article>

                <article>
                    <div class="reviewBackground">
                        <section id="rfSection" class="reviewFormSection">
                            <article>
                                <p class="reviewFormTitles" style="padding-top:5px;">
                                    Choose An Option
                                </p>
                                <input onclick="showAOrD()" id="approveSub" class="aodInput" type="radio" name="approveOrReject" value="Approve">
                                    <span class="aodInputText">
                                        Approve Hours
                                    </span> <br>
                                <input onclick="showAOrD()" id="declineSub" class="aodInput" type="radio" name="approveOrReject" value="Reject">
                                    <span class="aodInputText">
                                        Reject Hours
                                    </span> <br>
                            </article>

                            <article id="approvedArticle" style="display: none;">
                                <p class="reviewFormTitles">
                                    Approved:
                                </p>
                                <form action="../backend/approveSubmission.php" method="post">
                                    <div class="group">      
                                        <input name="numHoursApprove" onkeypress="validate(event)" class="gmdInput" type="text" autocomplete="off" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label class="gmdLabel">Number of Hours</label>
                                    </div>
                                    <div class="group">      
                                        <input name="passwordApprove" class="gmdInput" type="password" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label class="gmdLabel">Enter your password</label>
                                    </div>
                                    <input name="fileIDApprove" type="hidden" id="fileForReviewInfoApprove"  value="">
                                    <button class="approveSubmissionBtn" type="submit">
                                        Approve
                                    </button>
                                </form>
                            </article>

                            <article id="declinedArticle" style="display: none;">
                                <p class="reviewFormTitles">
                                    Declined:
                                </p>
                                <form action="../backend/declineSubmission.php" method="post">
                                    <div class="group">      
                                        <input name="declineReason" class="gmdInput" type="text" autocomplete="off" onkeypress="validateTwo(event)" maxlength="100" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label class="gmdLabel">Brief Reason</label>
                                    </div>
                                    <div class="group">      
                                        <input name="passwordDecline" class="gmdInput" type="password" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label class="gmdLabel">Enter your password</label>
                                    </div>
                                    <input name="fileIDDecline" type="hidden" id="fileForReviewInfoDecline" value="">
                                    <button class="approveSubmissionBtn" type="submit">
                                        Decline
                                    </button>
                                </form>
                            </article>
                        </section>
                    </div>
                </article>
            </section>
        </div>

    </body>

</html>