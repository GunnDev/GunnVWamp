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
        <script>
            $(document).ready(function(){
                $("#searchStudentsField").focus(function() {
                    $(this).attr("origPlaceholder", $(this).attr("placeholder"));
                    $(this).attr("placeholder", "Ex. FirstLast or 950 number.");
                });

                $("#searchStudentsField").blur(function() {
                    if ($(this).attr("origPlaceholder")) {
                    $(this).attr("placeholder", $(this).attr("origPlaceholder"));
                    }
                });
            });
        </script>
        <meta charset="utf-8">
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
            <a href="#" style="background-color: #dedede; color: #1a73e8;">
                <i class="fas fa-users fa-lg"></i>
                &nbsp;
                Students
            </a>
            <a href="submissions.php">
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
            <header class="siteNavHeader" style="background-color: #1a73e8; height: 62px; box-shadow:none;">
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

            <section class="students-admin-dash-section">
                <article>
                    <div class="searchForStudentsDiv">
                        <form action="#">
                            <section class="searchForm">
                                <article>
                                    <input id="searchStudentsField" type='text' class="searchBox" placeholder='Search Students'>
                                </article>

                                <article>
                                    <button type="submit" class="searchBtn">
                                        Search
                                        <span>
                                            <i class="fas fa-search fa-sm"></i>
                                        </span>
                                    </button>
                                </article>
                            </section>
                        </form>
                    </div>
                </article>

                <article>
                    <?php
                        include "../backend/db_connect.php";
                        include "../messages/studentBox.php";

                        $getAllUsers = "SELECT studentid, firstname, lastname FROM users WHERE studentid != 1";
                        $resultGetAll = $mysqli->query($getAllUsers) or die (mysqli_error($mysqli));
                        $allUsers = $resultGetAll->fetch_all(MYSQLI_ASSOC);

                        for($i = 0; $i < count($allUsers); $i++){
                            $newStudentBox = new studentBox($allUsers[$i]['firstname'], $allUsers[$i]['lastname'],  $allUsers[$i]['studentid']);
                            $newStudentBox->printMessage();
                        }
                    ?>
                </article>
            </section>
        </div>

    </body>

</html>